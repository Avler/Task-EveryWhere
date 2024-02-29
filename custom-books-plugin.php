<?php
/**
 * Plugin Name: Custom Books Plugin
 * Description: A custom plugin for managing a 'Books' post type.
 * Version: 1.0
 * Author: Kamil Sikora
 */

function custom_books_enqueue_styles() {
    wp_enqueue_style('custom-books-tailwind', plugin_dir_url(__FILE__) . 'css/output.css');
}
add_action('wp_enqueue_scripts', 'custom_books_enqueue_styles');


 function custom_books_register_post_type() {
    $args = array(
        'public' => true,
        'label'  => 'Books',
        'supports' => array('title', 'editor', 'thumbnail'),
        'has_archive' => true,
    );
    register_post_type('books', $args);
}
add_action('init', 'custom_books_register_post_type');

function custom_books_template_include($template) {
    if (is_singular('books')) {
        $new_template = plugin_dir_path(__FILE__) . 'templates/single-books.php';
        if (file_exists($new_template)) {
            return $new_template;
        }
    } elseif (is_post_type_archive('books')) {
        $new_template = plugin_dir_path(__FILE__) . 'templates/archive-books.php';
        if (file_exists($new_template)) {
            return $new_template;
        }
    }
    return $template;
}
add_filter('template_include', 'custom_books_template_include');

