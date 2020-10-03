<?php
/*
This is a plugin file for custom post type 'project'.
This file should be placed in /wp-content/mu-plugins folder.
*/

function radiozapzap_post_types() {
    register_post_type('project', array(
        'show_in_rest' => true,
        'supports' => array('title', 'editor', 'excerpt', 'thumbnail'),
        'rewrite' => array('slug' => 'projects'),
        'has_archive' => true,
        'public' => true,
        'labels' => array(
            'name' => 'Projects',
            'add_new_item' => 'Add New Project',
            'edit_item' => 'Edit Project',
            'all_items' => 'All Projects',
            'singular_name' => 'Project'
        ),
        'menu_icon' => 'dashicons-admin-generic'
    ));
}

add_action('init', 'radiozapzap_post_types');

?>