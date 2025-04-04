<?php
/*
Plugin Name: WP Blog Export to TXT (PHP Array)
Description: Exports blog posts to a TXT file as a PHP array (title, thumbnail, date, URL, full image, content).
Version: 1.4
Author: WP Panda
*/

// Add admin menu
add_action('admin_menu', 'wbet_add_admin_menu');
function wbet_add_admin_menu() {
    add_submenu_page(
        'tools.php',
        'Export Blog to TXT (PHP Array)',
        'Export Blog (PHP)',
        'manage_options',
        'wp-blog-export-txt',
        'wbet_export_page'
    );
}

// Export page
function wbet_export_page() {
    if (!current_user_can('manage_options')) {
        wp_die('Access denied!');
    }

    if (isset($_POST['wbet_export'])) {
        wbet_export_posts_to_txt();
    }

    ?>
    <div class="wrap">
        <h1>Export Blog Posts to TXT (PHP Array)</h1>
        <form method="post">
            <p>Click the button to export all posts from the "Blog" category to a TXT file (PHP array format).</p>
            <input type="submit" name="wbet_export" class="button button-primary" value="Export">
        </form>
    </div>
    <?php
}

// Export function (PHP array → TXT)
function wbet_export_posts_to_txt() {
    $args = array(
        'post_type'      => 'post',
        'category_name'  => 'blog', // Change to your category slug
        'posts_per_page' => -1,
        'post_status'   => 'publish',
    );

    $blog_posts = get_posts($args);
    $export_data = array();

    foreach ($blog_posts as $post) {
        setup_postdata($post);

        // Get thumbnail URL
        $thumbnail_url = get_the_post_thumbnail_url($post->ID, 'full');

        // Extract first image from content (if no thumbnail)
        $content = $post->post_content;
        preg_match('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $content, $matches);
        $full_image_url = !empty($matches[1]) ? $matches[1] : '';

        // Build the array
        $export_data[] = array(
            'ID'         => $post->ID,
            'title'     => get_the_title($post->ID),
            'permalink' => get_permalink($post->ID),
            'date'      => get_the_date('', $post->ID),
            'thumbnail' => $thumbnail_url ?: null,
            'full_image' => $full_image_url ?: null,
            'content'   => wp_strip_all_tags($content),
        );
    }

    wp_reset_postdata();

    // Generate TXT content (PHP array syntax)
    $txt_content = "<?php\n\n";
    $txt_content .= "// WordPress Blog Export (PHP Array)\n";
    $txt_content .= "// Generated on: " . date('Y-m-d H:i:s') . "\n\n";
    $txt_content .= "return " . var_export($export_data, true) . ";\n";

    // Save to file
    $upload_dir = wp_upload_dir();
    $file_path = $upload_dir['basedir'] . '/blog_export_array.txt'; // .txt file
    file_put_contents($file_path, $txt_content);

    // Download link
    $file_url = $upload_dir['baseurl'] . '/blog_export_array.txt';
    echo '<div class="notice notice-success"><p>Export complete! <a href="' . esc_url($file_url) . '" download>Download TXT file</a></p></div>';
}