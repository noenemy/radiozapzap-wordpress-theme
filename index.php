<?php

    get_header(); 
    pageBanner(array(
        'title' => 'Welcome to our blog!',
        'subtitle' => '낙서가 글이 되는 공간'
    ));
    ?>

    <div class="container container--narrow page-section">
    <?php 
      while(have_posts()) {
          the_post(); ?>
        <div class="post-item">
          <h2 class="headline headline--medium headline--post-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
          <div class="metabox">
            <p>Posted by <?php the_author_posts_link(); ?> | <?php the_time('M d, Y'); ?> in <?php echo get_the_category_list(', '); ?></p>
          </div>
          <div class="generic-content">
            <?php the_excerpt(); ?>
            <p><a class="btn btn--medium btn--blue" href="<?php the_permalink(); ?>">Continue reading &raquo;</a></p>
          </div>          
        </div>
      <?php } 
    
      echo paginate_links();
    ?>
    </div>


<?php
    get_footer();
?>