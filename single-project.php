<?php
    get_header();

    while(have_posts()) {
        the_post(); ?>

    <div class="page-banner">
        <div class="page-banner__bg-image" style="background-image: url(
            <?php $pageBannerImage = get_field('page_banner_background_image');
            if ($pageBannerImage) {
                echo $pageBannerImage['sizes']['pageBanner'];
            } else {
                echo get_theme_file_uri('/images/stage.jpg');
            } ?>
        );"></div>
        <div class="page-banner__content container container--narrow">
        <h1 class="page-banner__title"><?php the_title(); ?></h1>
        <div class="page-banner__intro">
            <p><?php the_field('page_banner_subtitle'); ?></p>
        </div>
        </div>  
    </div>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('project'); ?>">
                <i class="fa fa-home" aria-hidden="true"></i> Project Home</a> 
                <span class="metabox__main"><?php the_title(); ?> (Current Status : <?php the_field('project_status'); ?>)</span>
            </p>
        </div>    
        
        <div class="generic-content"><?php the_content() ?></div>
    </div>

    <?php
    }

    get_footer();
?>