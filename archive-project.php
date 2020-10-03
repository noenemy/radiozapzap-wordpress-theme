<?php

    get_header(); 
    pageBanner(array(
        'title' => 'All Projects',
        'subtitle' => 'See how we rock the world.'
    ));
    ?>

    <div class="container container--narrow page-section">
    <?php 
      while(have_posts()) {
          the_post(); 
          get_template_part('template-parts/content', 'event'); 
      }

      echo paginate_links();
    ?>
    </div>

<?php
    get_footer();
?>