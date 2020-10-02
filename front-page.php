<?php get_header(); ?>


<div class="page-banner">
      <div class="page-banner__bg-image" style="background-image: url(<?php echo get_theme_file_uri('images/site-main-bg-01.jpg'); ?>);"></div>
      <div class="page-banner__content container t-center c-white">
        <h2 class="headline headline--medium"><strong>radio</strong>zapzap</h2>
        <p></p>
        <h3 class="headline headline--small">아직은 뭐라고 정의하기 어려운 가내수공업 밴드</h3>
        <a href="<?php echo site_url('/about-us'); ?>" class="btn btn--large btn--blue">Learn more</a>
      </div>
    </div>

    <div class="full-width-split group">
      <div class="full-width-split__one">
        <div class="full-width-split__inner">
          <h2 class="headline headline--small-plus t-center">Recent Projects</h2>

          <?php 
            $recentProjects = new WP_Query(array(
              'posts_per_page' => 3,
              'post_type' => 'project'
            ));
            
            while ($recentProjects->have_posts()) {
              $recentProjects->the_post(); ?>
          
            <div class="event-summary">
              <a class="event-summary__date t-center" href="#">
                <span class="event-summary__month">Mar</span>
                <span class="event-summary__day">25</span>
              </a>
              <div class="event-summary__content">
                <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
                <p><?php echo wp_trim_words(get_the_content(), 15); ?><a href="<?php the_permalink(); ?>" class="nu gray">Learn more</a></p>
              </div>
            </div>

            <?php } ?>      

          <p class="t-center no-margin"><a href="#" class="btn btn--blue">View All Projects</a></p>
        </div>
      </div>
      <div class="full-width-split__two">
        <div class="full-width-split__inner">
          <h2 class="headline headline--small-plus t-center">From Our Blogs</h2>
          <?php
            $newBlogPosts = new WP_Query(array(
              'posts_per_page' => 3
            ));

            while ($newBlogPosts->have_posts()) {
              $newBlogPosts->the_post(); ?>

          <div class="event-summary">
            <a class="event-summary__date event-summary__date--beige t-center" href="#">
              <span class="event-summary__month"><?php the_time('M'); ?></span>
              <span class="event-summary__day"><?php the_time('d'); ?></span>
            </a>
            <div class="event-summary__content">
              <h5 class="event-summary__title headline headline--tiny"><a href="<?php the_permalink(); ?>"><?php the_title() ?></a></h5>
              <p><?php echo wp_trim_words(get_the_content(), 20); ?> <a href="<?php the_permalink(); ?>" class="nu gray">Read more</a></p>
            </div>
          </div>

          <?php } wp_reset_postdata();
          ?>      

          <p class="t-center no-margin"><a href="<?php echo site_url('/blog'); ?>" class="btn btn--yellow">View All Blog Posts</a></p>
        </div>
      </div>
    </div>

    <div class="hero-slider">
      <div data-glide-el="track" class="glide__track">
        <div class="glide__slides">
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/radio.jpg'); ?>">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Radiohead Tribute Band</h2>
                <p class="t-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/tape.jpg'); ?>">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Home Recording</h2>
                <p class="t-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/livestreaming.jpg'); ?>">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Live Streaming</h2>
                <p class="t-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>
          <div class="hero-slider__slide" style="background-image: url(<?php echo get_theme_file_uri('images/writing.jpg'); ?>">
            <div class="hero-slider__interior container">
              <div class="hero-slider__overlay">
                <h2 class="headline headline--medium t-center">Team Blogging</h2>
                <p class="t-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit.</p>
                <p class="t-center no-margin"><a href="#" class="btn btn--blue">Learn more</a></p>
              </div>
            </div>
          </div>          
        </div>
        <div class="slider__bullets glide__bullets" data-glide-el="controls[nav]"></div>
      </div>
    </div>

<?php get_footer(); ?>
