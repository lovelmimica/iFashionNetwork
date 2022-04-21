<?php get_header(); ?>

<section class="section-content archive">

<div class="container main-container">
    <div class="row blog-grid-row">
    <div class="col-sm-12">

        <div class="entry-date archive-title search-results-subtitle">

            <span><b>Search results for:</b> <?php echo $_GET['s']; ?></span>

        </div>

        </div>
        <div class="col-sm-8 col-md-8">            
                <?php
                    $posts = get_posts( array( 'numberposts' => -1, 'post_status' => 'publish', 's' => $_GET['s'] ) );
                    if( count( $posts ) < 12 ){
                        foreach( $posts as $post ){
                            do_shortcode( "[archive_row_post_card id={$post->ID}/]" );
                        }
                    }else{
                        echo "<div class='article-grid'>";
                        foreach( $posts as $post ){
                            do_shortcode( "[archive_grid_post_card id={$post->ID}/]" );
                        }
                        echo "</div>";
                    }

                ?>
            
        </div>

        <div class="col-sm-4 sidebar">
            <?php get_sidebar(); ?>
        </div>
    </div>
</div>

</section>

<?php get_footer(); ?>



<!-- <?php get_header(); ?>


<section class="section-content">



<div class="container main-container">





    <div class="row">



        <div class="col-sm-12">

            <div class="entry-date archive-title">

                <span><b>Search results for:</b> <?php echo $_GET['s']?></span>

            </div>

        </div>

        

        <div class="col-sm-8 col-md-8">



            <?php            
                echo count($posts);

                foreach( $posts as $post ){

                    do_shortcode( "[category_post_card id={$post->ID}/]" );

                }

            ?>



        </div>





        <div class="col-sm-4 sidebar">

            

            <?php get_sidebar(); ?>

            

        </div>



    </div>

</div>

</section>







<?php get_footer(); ?>
 -->
