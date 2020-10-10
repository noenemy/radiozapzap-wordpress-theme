<?php
    get_header();

    while(have_posts()) {
        the_post(); 
        pageBanner(); ?>

    <div class="container container--narrow page-section">
        <div class="metabox metabox--position-up metabox--with-home-link">
            <p>
                <a class="metabox__blog-home-link" href="<?php echo site_url('/blog'); ?>">
                <i class="fa fa-home" aria-hidden="true"></i> Blog Home</a> 
                <span class="metabox__main">Posted by <?php the_author_posts_link(); ?> on <?php the_time('n.j.y'); ?> in <?php echo get_the_category_list(', '); ?></span>
            </p>
        </div>

        <div class="generic-content"><?php the_content() ?></div>

        <?php
        /** @var string|false|WP_Error $tag_list */
        //$tag_list = get_the_tag_list( '<ul class="tag_keyword"><li>', '</li><li>', '</li></ul>' );
        $tag_list = get_the_tag_list( '<p><span class="tag-button">', '</span><span class="tag-button">', '</span></p>' );
        
        if ( $tag_list && ! is_wp_error( $tag_list ) ) {
            echo $tag_list;
        }
        ?>
        <?php if (get_the_author_meta('description')) : // Checking if the user has added any author descript or not. If it is added only, then lets move ahead ?>
        <div class="author-box">
            <div class="author-img"><?php echo get_avatar(get_the_author_meta('user_email'), '100'); // Display the author gravatar image with the size of 100 ?></div>
            <h3 class="author-name"><?php esc_html(the_author_meta('display_name')); // Displays the author name of the posts ?></h3>
            <p class="author-description"><?php esc_textarea(the_author_meta('description')); // Displays the author description added in Biographical Info ?></p>
        </div>
        <?php endif; ?>

    </div>

    <?php
    }

    get_footer();
?>