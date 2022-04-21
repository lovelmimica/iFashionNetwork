<?php get_header(); ?>

<?php $_SESSION["displayed_posts"] = array(); ?>



<section class="section-content">



<div class="container main-container">

    <div class="row">

        

        <div class="col-sm-8 col-md-8">



            <article class="blog-item blog-single">



                <h1 class="post-title">

                    Privacy and Cookie Policy

                </h1>



                <div class="entry-excerpt">



                <?php 

                    $content = get_the_content();

                    $content = apply_filters( 'the_content', $content );

                    echo do_shortcode( html_entity_decode( $content ) );

                ?>



                </div>



            </article>

        

        </div>





        <div class="col-sm-4 sidebar">

            <?php get_sidebar() ?>

        </div>



    </div>

</div>

</section>





<?php get_footer(); ?>