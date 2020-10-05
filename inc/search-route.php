<?php

function radiozapzapRegisterSearch() {
    register_rest_route('radiozapzap/v1', 'search', array(
        'methods' => WP_REST_SERVER::READABLE,
        'callback' => 'radiozapzapSearchResult'
    ));
}

add_action('rest_api_init', 'radiozapzapRegisterSearch');

function radiozapzapSearchResult($data) {
    $projects = new WP_Query(array(
        'post_type' => array('post', 'page', 'project'),
        's' => sanitize_text_field($data['keyword'])
    ));

    $results = array(
        'generalInfo' => array(),
        'projects' => array()
    );

    while ($projects->have_posts()) {
        $projects->the_post();

        if (get_post_type() == 'post' OR get_post_type() == 'page') {
            array_push($results['generalInfo'], array(
                'title' => get_the_title(),
                'permalink' => get_permalink(),
                'postType' => get_post_type(),
                'authorName' => get_the_author()
            ));
        }

        if (get_post_type() == 'project') {
            array_push($results['projects'], array(
                'title' => get_the_title(),
                'permalink' => get_permalink()
            ));
        }
    }

    return $results;
}

?>