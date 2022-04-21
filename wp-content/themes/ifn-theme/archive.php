<?php get_header(); ?>

<section class="section-content archive">

<div class="container main-container">
    <div class='row'>
        <div class='col-sm-12'>
            <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4790709439893469"
                crossorigin="anonymous"></script>
            <!-- IFN Archive Top Ad -->
            <ins class="adsbygoogle"
                style="display:block"
                data-ad-client="ca-pub-4790709439893469"
                data-ad-slot="1920425442"
                data-ad-format="auto"
                data-full-width-responsive="true">
            </ins>
            <script>
                window.addEventListener("DOMContentLoaded", () => {
                (adsbygoogle = window.adsbygoogle || []).push({});});
           </script>
        </div>
        <?php if( is_category() ): ?>
            <div class='col-sm-12'>
                <nav class="main-nav" >
                    <ul class='subcategory-links'>
                        <?php 
                            $parent = get_queried_object( 'cat' )->parent == 0 ? get_queried_object( 'cat' )->term_id : get_queried_object( 'cat' )->parent;
                            $subcategories = get_categories( array( 'parent' => $parent, 'hide_empty' => false ) );

                            foreach( $subcategories as $subcat ): ?>
                                <li class="<?php echo is_category( get_category_by_slug( $subcat->slug )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( $subcat ); ?>"><?php echo $subcat->name; ?></a></li>
                        <?php endforeach; ?>    
                    </ul>
                </nav>
            </div>
        <?php endif; ?>
    </div>
    <div class="row blog-grid-row">
        <!-- <div class="col-sm-8 col-md-8">

        </div> -->
        <div class="col-sm-8 col-md-8">
                <?php if( is_post_type_archive( 'runway' ) ): 
                    do_shortcode( '[runway_posts_filter_form/]' );
                endif; ?>
            
                <?php
                    if( is_category() ) $posts = get_posts( array( 'numberposts' => -1, 'category' => get_queried_object( 'cat' )->term_id, 'post_status' => 'publish' ) );
                    else if( is_tag() )  $posts = get_posts( array( 'numberposts' => -1, 'tag' => get_queried_object( 'tag' )->slug, 'post_status' => 'publish' ) );

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

