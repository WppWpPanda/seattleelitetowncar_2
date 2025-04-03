<?php
/*
Plugin Name: Advanced User Data Exporter
Description: Exports user data with proper handling of serialized HTML and split meta fields
Version: 3.0
Author: WP Panda
*/

defined('ABSPATH') or die('Direct access denied!');

class AdvancedUserDataExporter {
    private $filename;
    private $filepath;
    private $fileurl;

    // Define all possible _wpp_user_info fields
    private $info_fields = [
        'address',
        'company',
        'mobile',
        'daytime_phone',
        'card_name',
        'card_number',
        'exp_date',
        'cvv',
        'city',
        'state',
        'zip',
        'mobile_phone'
    ];

    public function __construct() {
        add_action('admin_menu', [$this, 'add_admin_menu']);
        add_action('admin_init', [$this, 'handle_export']);
        add_action('admin_init', [$this, 'handle_download']);
    }

    public function add_admin_menu() {
        add_users_page(
            'User Data Export',
            'Export to CSV',
            'manage_options',
            'user-data-export',
            [$this, 'render_admin_page']
        );
    }

    public function render_admin_page() {
        if (!current_user_can('manage_options')) {
            wp_die('Insufficient permissions');
        }

        echo '<div class="wrap">';
        echo '<h1>User Data Export</h1>';

        if (isset($_GET['export_status'])) {
            $this->show_export_status($_GET['export_status']);
        }

        echo '<form method="post" action="'.admin_url('users.php?page=user-data-export').'">';
        wp_nonce_field('user_data_export_action');
        echo '<p>Export users with detailed meta information</p>';
        submit_button('Export to CSV', 'primary', 'submit_export');
        echo '</form>';
        echo '</div>';
    }

    public function handle_export() {
        if (!isset($_POST['submit_export']) || !check_admin_referer('user_data_export_action')) {
            return;
        }

        $result = $this->generate_export_file();
        $status = $result ? 'success' : 'error';

        wp_redirect(add_query_arg(
            'export_status',
            $status,
            admin_url('users.php?page=user-data-export')
        ));
        exit;
    }

    private function generate_export_file() {
        $this->setup_filepaths();

        $users = $this->get_users_with_meta();
        if (empty($users)) {
            return false;
        }

        $file = fopen($this->filepath, 'w');
        if (!$file) {
            error_log('Failed to create file: '.$this->filepath);
            return false;
        }

        // Add UTF-8 BOM for Excel compatibility
        fwrite($file, "\xEF\xBB\xBF");

        // Prepare CSV headers
        $headers = array_merge(
            ['User ID', 'Email'],
            $this->info_fields,
            ['User Orders']
        );
        fputcsv($file, $headers, ';');

        foreach ($users as $user) {
            $user_info = $this->get_meta_value($user->ID, '_wpp_user_info');
            $user_orders = $this->get_meta_value($user->ID, '_wpp_user_orders');

            // Start building the row
            $row = [
                $user->ID,
                $user->user_email
            ];

            // Add each info field
            foreach ($this->info_fields as $field) {
                $value = '';
                if (is_array($user_info) && isset($user_info[$field])) {
                    $value = $this->sanitize_for_csv($user_info[$field]);
                }
                $row[] = $value;
            }

            // Handle HTML orders data
            $row[] = $this->process_orders_data($user_orders);

            fputcsv($file, $row, ',');
        }

        fclose($file);
        return true;
    }

    private function process_orders_data($orders) {
        if (is_array($orders)) {
            $processed = [];
            foreach ($orders as $order) {
                $processed[] = $this->sanitize_html_content($order);
            }
            return implode("\n---\n", $processed);
        }
        return $this->sanitize_html_content($orders);
    }

    private function sanitize_html_content($html) {
        // First unserialize if needed
        $html = maybe_unserialize($html);

        // Convert to plain text if HTML
        if ($html !== strip_tags($html)) {
            $html = wp_strip_all_tags($html);
        }

        // Remove line breaks and extra spaces
        $html = preg_replace('/\s+/', ' ', $html);
        return trim($this->sanitize_for_csv($html));
    }

    private function sanitize_for_csv($data) {
        if (is_array($data) || is_object($data)) {
            $data = json_encode($data, JSON_UNESCAPED_UNICODE);
        }

        // Escape CSV special characters
        $data = str_replace('"', '""', $data);
        $data = str_replace("\n", " ", $data);
        $data = str_replace("\r", " ", $data);

        return $data;
    }

    private function get_users_with_meta() {
        return get_users([
            'fields' => ['ID', 'user_email'],
            'meta_query' => [
                'relation' => 'OR',
                ['key' => '_wpp_user_orders', 'compare' => 'EXISTS'],
                ['key' => '_wpp_user_info', 'compare' => 'EXISTS']
            ]
        ]);
    }

    private function get_meta_value($user_id, $meta_key) {
        $value = get_user_meta($user_id, $meta_key, true);
        return maybe_unserialize($value);
    }

    private function setup_filepaths() {
        $upload_dir = wp_upload_dir();
        $this->filename = 'user_export_'.date('Ymd_His').'.csv';
        $this->filepath = $upload_dir['path'].'/'.$this->filename;
        $this->fileurl = $upload_dir['url'].'/'.$this->filename;
    }

    public function handle_download() {
        if (!isset($_GET['download_export']) || !wp_verify_nonce($_GET['_wpnonce'], 'download_export')) {
            return;
        }

        $filepath = $this->get_latest_export_path();
        if (!$filepath || !file_exists($filepath)) {
            wp_die('Export file not found or has been deleted');
        }

        header('Content-Type: text/csv; charset=UTF-8');
        header('Content-Disposition: attachment; filename="'.basename($filepath).'"');
        header('Content-Length: ' . filesize($filepath));
        readfile($filepath);
        exit;
    }

    private function get_latest_export_path() {
        $upload_dir = wp_upload_dir();
        $pattern = $upload_dir['path'].'/user_export_*.csv';
        $files = glob($pattern);

        if (empty($files)) {
            return false;
        }

        // Sort by modification time (newest first)
        usort($files, function($a, $b) {
            return filemtime($b) - filemtime($a);
        });

        return $files[0];
    }

    private function show_export_status($status) {
        if ($status === 'success') {
            $download_url = wp_nonce_url(
                admin_url('users.php?page=user-data-export&download_export=1'),
                'download_export'
            );

            echo '<div class="notice notice-success">';
            echo '<p>File successfully generated! <a href="'.$download_url.'">Download CSV</a></p>';

            $filepath = $this->get_latest_export_path();
            if ($filepath) {
                echo '<p><small>File size: '.size_format(filesize($filepath)).'</small></p>';
            }

            echo '</div>';
        } else {
            echo '<div class="notice notice-error">';
            echo '<p>Error generating export file. Please check error logs.</p>';
            echo '</div>';
        }
    }
}

new AdvancedUserDataExporter();