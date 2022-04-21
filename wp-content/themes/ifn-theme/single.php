<?php get_header(); ?>

<section class="section-content">
<div class="container main-container">
    <div class="row">
        <div class="col-sm-8 col-md-8">
            <article class="blog-item blog-single" data-permalink=<?php echo get_permalink(); ?> data-slug=<?php echo get_post()->post_name; ?>>
                <?php
                    $date = get_the_date( "F d Y", $post );                
                ?>

                <div class="entry-date">
                    <span><?php echo $date ?></span>
                </div>

                <h1 class="post-title">
                    <?php echo get_the_title(); ?>
                </h1>
                <?php if( has_post_thumbnail() ): ?>
                    <div class="entry-media">
                        <a class="el-link">
                            <img src="<?php echo get_the_post_thumbnail_url(); ?>" alt="blog image">
                            <div class="entry-overlay"></div>
                        </a>
                    </div>
                <?php endif; ?>
                <?php 
                    $word_count = str_word_count( get_the_content() );
                    $reading_time = ( round( $word_count / 200 ) + 1 ) . " min";
                ?>

                <div class="entry-meta">
                    <span>
                        <img src="<?php echo get_home_url(); ?>/wp-content/themes/ifn-theme/images/svg/clock.svg" alt="clock icon" class="icon-clock">
                        <span class="reading-time"><?php echo $reading_time; ?></span>
                    </span>
                </div>

                <div class="entry-excerpt">
                    <?php 
                        $content = get_the_content();
                        $content = apply_filters( 'the_content', $content );
                        echo do_shortcode( $content );
                    ?>
                </div>

                <div class="widget-tags">
                    <?php 
                        $tags = get_the_tags( get_the_ID() ); 

                        if( is_array( $tags ) ) {
                            foreach( $tags as $tag ){
                                echo "<a href='" . get_tag_link( $tag->term_id ) . "'>" . $tag->name . "</a>"; 
                            }
                        }
                    ?>
                </div>

                <div class="entry-social">
                    <a href="https://facebook.com/sharer.php?u=<?php echo get_permalink(); ?>"><i class="fa fa-facebook"></i></a>
                    <a href="https://twitter.com/intent/tweet?url=<?php echo get_permalink(); ?>"><i class="fa fa-twitter"></i></a>
                    <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this article <?php echo get_permalink(); ?>"><i class="fa fa-envelope"></i></a>
                </div>

                <div class="seperator"><span></span></div>
                
                <br>
                
                <?php if( get_the_author_meta( 'description', get_post()->post_author ) != null && get_the_author_meta( 'description', get_post()->post_author ) != "" ): ?>
                    <div class="author-info">
                        <a href="javascript:;" class="author-image">
                            <img src="<?php echo get_avatar_url( get_post()->post_author ); ?>" alt="avatar">
                        </a>

                        <div class="info-entry">
                            <div class="info-title">
                                <h5><a href="javascript:;"><?php echo get_the_author_meta( 'display_name', get_post()->post_author ); ?></a></h5>
                                <p>
                                    <?php echo get_the_author_meta( 'description', get_post()->post_author ); ?>
                                </p>
                            </div>
                        </div>
                    </div> 
                <?php endif; ?>
                <h3 class='post-title read-more'>Read more</h3>
                <div class='blog-grid-row'>
                    <?php 
                        $related_posts = get_posts( array( 'numberposts' => 3, 'exclude' => $_SESSION["displayed_posts"], 'orderby' => 'rand', 'post_status' => 'publish' ) );
                        echo "<div class='article-grid'>";
                        foreach( $related_posts as $post ){
                            do_shortcode( "[archive_grid_post_card id={$post->ID}/]" );
                        }
                        echo "</div>";
                    ?>
                </div>

                <div class='gallery-modal'>
                    <div class='gallery-modal__header'>
                        <a class='gallery-modal__back'><i class="fa fa-long-arrow-left fa-xl" aria-hidden="true"></i>&nbsp;Back to article</a>
                        <!-- <img class='gallery-modal__logo' src='/ifashionnetwork/wp-content/themes/ifn-theme/images/ifashion-network-logo-dark.png'> -->
                        <!-- <h2 class='post-title category-title brand-title'><?php echo get_field("designer"); ?></h2> -->
                        <span class='entry-social'>
                            <a href="https://facebook.com/sharer.php?u="><i class="fa fa-facebook"></i></a>
                            <a href="https://twitter.com/intent/tweet?url="><i class="fa fa-twitter"></i></a>
                            <a href="mailto:?subject=I wanted you to see this site&amp;body=Check out this image "><i class="fa fa-envelope"></i></a>
                        </span> 
                    </div>

                    <div class='gallery-modal__body row'>
                        <div class='col-md-3 col-sm-12 gallery-modal__navigation-column'>
                            <div class='gallery-modal__title'>
                                <span class='gallery-modal__designer'>
                                    Christian Siriano
                                </span>
                                <span class='gallery-modal__season'>
                                    Summer 2020
                                </span>
                            </div>
                            <span class='gallery-modal__navigation'>
                                <i class="fa fa-caret-left previous-image" aria-hidden="true"></i>
                                <span class='current-image-num'>3/11</span>
                                <i class="fa fa-caret-right next-image" aria-hidden="true"></i>
                            </span>
                        </div>

                        <div class='col-md-6 col-sm-12 gallery-modal__image-column'>
                            <img class='gallery-modal__image' src='https://localhost/ifashionnetwork/wp-content/uploads/2019/11/CAAFD-RS20-0316.jpg'>
                        </div>

                        <div class='col-md-3 col-sm-12 gallery-modal__add-column'>
                        </div>
                    </div>
                </div>

            </article>

			<div id='disqus_thread'></div>
            <noscript>
                Please enable JavaScript to view the 
                <a href="https://disqus.com/?ref_noscript" rel="nofollow">
                    comments powered by Disqus.
                </a>
            </noscript>

        </div>

        <div class="col-sm-4 sidebar">
          <?php 
            get_sidebar();
          ?>
        </div>
    </div>
</div>
</section>


<script>
    /**
     *  RECOMMENDED CONFIGURATION VARIABLES: EDIT AND UNCOMMENT 
     *  THE SECTION BELOW TO INSERT DYNAMIC VALUES FROM YOUR 
     *  PLATFORM OR CMS.
     *  
     *  LEARN WHY DEFINING THESE VARIABLES IS IMPORTANT: 
     *  https://disqus.com/admin/universalcode/#configuration-variables
     */
    /*
    var disqus_config = function () {
        // Replace PAGE_URL with your page's canonical URL variable
        this.page.url = PAGE_URL;  
        
        // Replace PAGE_IDENTIFIER with your page's unique identifier variable
        this.page.identifier = PAGE_IDENTIFIER; 
    };
    */
    
    (function() {  // REQUIRED CONFIGURATION VARIABLE: EDIT THE SHORTNAME BELOW
        console.log("Hello from disqus ");

        var d = document, s = d.createElement('script');
        
        // IMPORTANT: Replace EXAMPLE with your forum shortname!
        s.src = 'https://ifashionnetwork2.disqus.com/embed.js';
        
        s.setAttribute('data-timestamp', +new Date());
        (d.head || d.body).appendChild(s);
    })();
</script>


<?php get_footer(); ?>

