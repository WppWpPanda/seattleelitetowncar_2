<?php
/*
Plugin Name: User Data Array Exporter
Description: Exports user data to file via array processing
Version: 3.1
Author: WP Panda
*/

defined('ABSPATH') or die('Direct access denied!');

class UserDataArrayExporter {
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
    }

    public function add_admin_menu() {
        add_users_page(
            'User Data Export',
            'Export to File',
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

        if (isset($_GET['export_result'])) {
            $this->show_export_result($_GET['export_result']);
        }

        echo '<form method="post" action="'.admin_url('users.php?page=user-data-export').'">';
        wp_nonce_field('user_data_export_action');
        echo '<p>Export users with detailed meta information</p>';
        submit_button('Export Data', 'primary', 'submit_export');
        echo '</form>';
        echo '</div>';
    }

    public function handle_export() {
        if (!isset($_POST['submit_export']) || !check_admin_referer('user_data_export_action')) {
            return;
        }

        $data = $this->prepare_export_data();
        $result = $this->write_to_file($data);

        wp_redirect(add_query_arg(
            'export_result',
            $result ? 'success' : 'error',
            admin_url('users.php?page=user-data-export')
        ));
        exit;
    }

    private function prepare_export_data() {
        $users = get_users([
            'fields' => ['ID', 'user_email'],
            'meta_query' => [
                'relation' => 'OR',
                ['key' => '_wpp_user_orders', 'compare' => 'EXISTS'],
                ['key' => '_wpp_user_info', 'compare' => 'EXISTS']
            ]
        ]);

        $export_data = [];

        // Add headers
        $export_data[] = array_merge(
            ['User ID', 'Email'],
            $this->info_fields,
            ['User Orders']
        );

        foreach ($users as $user) {
            $user_info = maybe_unserialize(get_user_meta($user->ID, '_wpp_user_info', true));
            $user_orders = maybe_unserialize(get_user_meta($user->ID, '_wpp_user_orders', true));

            $row = [
                'User ID' => $user->ID,
                'Email' => $user->user_email
            ];

            // Process info fields
            foreach ($this->info_fields as $field) {
                $row[$field] = $this->get_safe_value($user_info, $field);
            }

            // Process orders
            $row['User Orders'] = $this->process_orders($user_orders);

            $export_data[] = $row;
        }

        return $export_data;
    }

    private function get_safe_value($data, $key) {
        if (!is_array($data) || !isset($data[$key])) {
            return '';
        }

        $value = $data[$key];

        if (is_array($value) || is_object($value)) {
            return json_encode($value, JSON_UNESCAPED_UNICODE);
        }

        return $this->sanitize_text($value);
    }

    private function process_orders($orders) {
        if (is_array($orders)) {
            $processed = [];
            foreach ($orders as $order) {
                $processed[] = $this->process_single_order($order);
            }
            return implode("\n---\n", $processed);
        }
        return $this->process_single_order($orders);
    }

    private function process_single_order($order) {
        $order = maybe_unserialize($order);

        if (is_array($order) || is_object($order)) {
            $order = print_r($order, true);
        }

        return $this->sanitize_text($order);
    }

    private function sanitize_text($text) {
        $text = html_entity_decode($text);
        $text = wp_strip_all_tags($text);
        $text = preg_replace('/\s+/', ' ', $text);
        return trim($text);
    }

    private function write_to_file($data) {
        $upload_dir = wp_upload_dir();
        $filename = 'user_export_'.date('Ymd_His').'.txt';
        $filepath = $upload_dir['path'].'/'.$filename;

        $content = "User Data Export\n";
        $content .= "Generated: ".date('Y-m-d H:i:s')."\n\n";

        foreach ($data as $row) {
            if (is_array($row)) {
                $content .= "--- USER RECORD ---\n";
                foreach ($row as $key => $value) {
                    $content .= sprintf("%-15s: %s\n", $key, $value);
                }
            } else {
                // Headers row
                $content .= implode(" | ", $row)."\n";
            }
            $content .= "\n";
        }

        $bytes = file_put_contents($filepath, $content);
        return $bytes !== false;
    }

    private function show_export_result($result) {
        if ($result === 'success') {
            $upload_dir = wp_upload_dir();
            $files = glob($upload_dir['path'].'/user_export_*.txt');

            if (!empty($files)) {
                usort($files, function($a, $b) {
                    return filemtime($b) - filemtime($a);
                });

                $latest_file = $files[0];
                $file_url = $upload_dir['url'].'/'.basename($latest_file);

                echo '<div class="notice notice-success">';
                echo '<p>File successfully generated! <a href="'.$file_url.'" download>Download Export File</a></p>';
                echo '<p><small>Path: '.esc_html($latest_file).'</small></p>';
                echo '</div>';
            }
        } else {
            echo '<div class="notice notice-error">';
            echo '<p>Error generating export file. Please check error logs.</p>';
            echo '</div>';
        }
    }
}

new UserDataArrayExporter();