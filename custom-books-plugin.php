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

function custom_books_enqueue_scripts() {
    if (is_post_type_archive('books') || is_singular('books')) {
        wp_enqueue_script('custom-books-script', plugin_dir_url(__FILE__) . 'js/script.js', array(), false, true);
    }
}
add_action('wp_enqueue_scripts', 'custom_books_enqueue_scripts');

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

function handle_add_book_form() {
    if (!current_user_can('publish_posts')) {
        wp_die('Nie masz uprawnień do wykonania tej operacji');
    }
 
    $title = sanitize_text_field($_POST['book_title']);
    $author = sanitize_text_field($_POST['book_author']);
    $year = intval($_POST['book_year']);
    $genre = sanitize_text_field($_POST['book_genre']);
    $description = sanitize_textarea_field($_POST['book_description']);

    // Utwórz nową książkę
    $post_id = wp_insert_post([
        'post_title'    => $title,
        'post_content'  => $description,
        'post_status'   => 'publish',
        'post_type'     => 'books',
    ]);

    if ($post_id) {
        update_post_meta($post_id, 'autor_ksiazki', $author);
        update_post_meta($post_id, 'rok_wydania', $year);
        update_post_meta($post_id, 'gatunek', $genre);
    }
    
    if ($post_id && !empty($_FILES['book_cover']['name'])) {
        require_once(ABSPATH . 'wp-admin/includes/image.php');
        require_once(ABSPATH . 'wp-admin/includes/file.php');
        require_once(ABSPATH . 'wp-admin/includes/media.php');
        
        $attachment_id = media_handle_upload('book_cover', $post_id);

        // Ustaw jako miniaturkę postu, jeśli przesłanie się powiedzie
        if (!is_wp_error($attachment_id)) {
            set_post_thumbnail($post_id, $attachment_id);
        }
    }
    $redirect_url = add_query_arg('book_added', 'true', get_post_type_archive_link('books'));
    wp_safe_redirect($redirect_url);
    exit;
}
add_action('admin_post_add_book', 'handle_add_book_form');
add_action('admin_post_nopriv_add_book', 'handle_add_book_form'); 

function custom_books_filter($query) {
    if (!is_admin() && $query->is_main_query() && is_post_type_archive('books')) {
        $meta_query = array('relation' => 'AND');

        if (!empty($_GET['author'])) {
            $meta_query[] = array(
                'key' => 'autor_ksiazki',
                'value' => sanitize_text_field($_GET['author']),
                'compare' => 'LIKE'
            );
        }

        if (!empty($_GET['genre'])) {
            $meta_query[] = array(
                'key' => 'gatunek',
                'value' => sanitize_text_field($_GET['genre']),
                'compare' => 'LIKE'
            );
        }

        if (count($meta_query) > 1) { 
            $query->set('meta_query', $meta_query);
        }
    }
}
add_action('pre_get_posts', 'custom_books_filter');

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