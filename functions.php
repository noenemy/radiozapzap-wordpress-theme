<?php 

function pageBanner($args = NULL) {
    
    if (!$args['title']) {
        $args['title'] = get_the_title();
    }
    if (!$args['subtitle']) {
        $args['subtitle'] = get_field('page_banner_subtitle');
    }
    if (!$args['photo']) {
        if (get_field('page_banner_background_image') AND !is_archive() AND !is_home()) {
            $args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
        } else {
            $args['photo'] = get_theme_file_uri('/images/stage.jpg');
        }
    } ?>
    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php echo $args['title']; ?></h1>
        <div class="page-banner__intro">
            <p><?php echo $args['subtitle']; ?>&nbsp;</p>
        </div>
        </div>  
    </div>    
<?php 
    }

function radiozapzap_files() {
    wp_enqueue_script('radiozapzap-search-js', get_theme_file_uri('/js/search.js'), array('jquery'), '1.0.0', true);    
    wp_enqueue_script('radiozapzap-main-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);
    wp_enqueue_style('custom-google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
    wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');
    wp_enqueue_style('radiozapzap_main_styles', get_stylesheet_uri());

    wp_localize_script('radiozapzap-main-js', 'radiozapzapData', array(
        'root_url' => get_site_url()
    ));
}

add_action('wp_enqueue_scripts', 'radiozapzap_files');

function radiozapzap_features() {
    register_nav_menu('headerMenu', 'Header Menu');
    register_nav_menu('footerMenu1', 'Footer Menu 1');
    register_nav_menu('footerMenu2', 'Footer Menu 2');
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_image_size('pageBanner', 1500, 350, true);
}

add_action('after_setup_theme', 'radiozapzap_features');

function radiozapzap_adjust_queries($query) {
    if (!is_admin() AND is_post_type_archive('project') AND $query->is_main_query()) {
        $query->set('posts_per_page', '10');
    }
}

add_action('pre_get_posts', 'radiozapzap_adjust_queries');
?>