<?php 

function radiozapzap_files() {
    wp_enqueue_style('radiozapzap_main_styles', get_stylesheet_uri());
}

add_action('wp_enqueue_scripts', 'radiozapzap_files');

?>