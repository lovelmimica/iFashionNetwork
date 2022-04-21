<?php get_header(); ?>

<section class="section-content">



<div class="content-full">


<div class="carousel-posts mvt0">

    <div class="swiper-container">
        <div class="swiper-wrapper">
        <?php
            $breaking_posts = get_posts( array( 'tag' => 'nyfw', 'numberposts' => 5, 'exclude' => $_SESSION["displayed_posts"], 'post_status' => 'publish' ) );
            foreach( $breaking_posts as $breaking_post ){
                do_shortcode( "[slider_post_card id={$breaking_post->ID}/]" );
            }
        ?>
        </div>
    </div>
        <div class="swiper-button-prev"></div>
        <div class="swiper-button-next"></div>
    </div>

    <div class="container main-container">
        <h2 class='post-title category-title'><a href="<?php echo get_category_link( 32 ) ?>">Fashion</a></h2>
        <div class="seperator wide-seperator"><span></span></div>
        <div class="blog-masonry-container">
            <div class="row">
                <?php 
                    $latest_posts = get_posts( array( 'numberposts' => 3, 'category' => 32, 'exclude' => $_SESSION["displayed_posts"], 'post_status' => 'publish' ) );

                    foreach( $latest_posts as $latest_post ){
                        do_shortcode( "[grid_post_card id={$latest_post->ID}/]" );
                    }
                ?>
            </div>
        </div>

        <h2 class='post-title category-title'><a href="<?php echo get_post_type_archive_link( 'runway' ) ?>">Runway</a></h2>
        <div class="seperator wide-seperator"><span></span></div>
        <div class="blog-masonry-container">
            <div class="row">
                <?php 
                    $latest_posts = get_posts( array( 'numberposts' => 3, 'post_type' => 'runway', 'exclude' => $_SESSION["displayed_posts"], 'post_status' => 'publish' ) );

                    foreach( $latest_posts as $latest_post ){
                        do_shortcode( "[grid_post_card id={$latest_post->ID}/]" );
                    }
                ?>
            </div>
        </div>

        <h2 class='post-title category-title'><a href="<?php echo get_category_link( 81 ) ?>">Beauty</a></h2>
        <div class="seperator wide-seperator"><span></span></div>
        <div class="blog-masonry-container">
            <div class="row">
                <?php 
                    $latest_posts = get_posts( array( 'numberposts' => 3, 'category' => 81, 'exclude' => $_SESSION["displayed_posts"], 'post_status' => 'publish' ) );

                    foreach( $latest_posts as $latest_post ){
                        do_shortcode( "[grid_post_card id={$latest_post->ID}/]" );
                    }
                ?>
            </div>
        </div>

        <h2 class='post-title category-title'><a href="<?php echo get_category_link( 208 ) ?>">Entertainment</a></h2>
        <div class="seperator wide-seperator"><span></span></div>
        <div class="blog-masonry-container">
            <div class="row">
                <?php 
                    $latest_posts = get_posts( array( 'numberposts' => 3, 'category' => 208, 'exclude' => $_SESSION["displayed_posts"], 'post_status' => 'publish' ) );

                    foreach( $latest_posts as $latest_post ){
                        do_shortcode( "[grid_post_card id={$latest_post->ID}/]" );
                    }
                ?>
            </div>
        </div>

        <h2 class='post-title category-title'><a href="<?php echo get_category_link( 155 ) ?>">Lifestyle</a></h2>
        <div class="seperator wide-seperator"><span></span></div>
        <div class="blog-masonry-container">
            <div class="row">
                <?php 
                    $latest_posts = get_posts( array( 'numberposts' => 3, 'category' => 155, 'exclude' => $_SESSION["displayed_posts"], 'post_status' => 'publish' ) );

                    foreach( $latest_posts as $latest_post ){
                        do_shortcode( "[grid_post_card id={$latest_post->ID}/]" );
                    }
                ?>
            </div>
        </div>
        
    </div>
</div>



<div class="blog-item-quote-wrapper">

        <article class="blog-item blog-item-quote">

            <div class="entry-media">

                <blockquote class="quote-element">
                    <?php 
                        $day = intval( date( 'd' ) );
                        $quotes = get_posts( array( 'order' => 'ASC', 'post_type' => 'fashion_quote', 'numberposts' => -1 ) );
                        $index = $day % count( $quotes ); 
                    ?>
                    <?php echo $quotes[$index]->post_content; ?>                        
                    <cite>by <strong><?php echo get_field( 'quote_author', $quotes[$index]->ID ); ?></strong></cite>

                </blockquote>

            </div>

        </article>

    </div>



</section>



<?php get_footer(); ?>