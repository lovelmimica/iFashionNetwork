          



            <div class="widget">

                <h5 class="widget-title"><span>Popular Posts</span></h5>

                <div class="popular-posts">

                    <?php 

                        $popular_posts = get_posts( array( 'tag' => 'popular', 'numberposts' => 5, 'exclude' => $_SESSION["displayed_posts"] ) );

                        

                        $i = 0;

                        foreach( $popular_posts as $popular_post ){

                            if( $i == 0 ) {

                                do_shortcode( "[featured_popular_post_card id={$popular_post->ID}/]" );

                                echo "<ol class='rp-items'>";

                            }else do_shortcode( "[popular_post_card id={$popular_post->ID}/]" );



                            $i++;

                        }

                        echo "</ol>";



                    ?>

                </div>

            </div>





            <div class="widget widget-subscribe">

                <div class="entry-subscribe">

                    <h2>Daily News about</h2>

                    <h3>FASHION</h3>

                    <div class="seperator"><span></span></div>

                    <form action="https://ifashionnetwork.us14.list-manage.com/subscribe/post?u=8c5b4ff962d401eef4b2eced2&amp;id=9b0e54920c" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank">

                        <input type="email" value="" name="EMAIL" class="required email" id="mce-EMAIL" placeholder='Your e-mail'>

                        <button type="submit">Subscribe</button>

                    </form>

                </div>

            </div>



            <div class="widget">

                <h5 class="widget-title"><span>Advertising</span></h5>

                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4790709439893469"

                    crossorigin="anonymous"></script>

                <!-- IFN Sidebar Ad -->

                <ins class="adsbygoogle"

                    style="display:block"

                    data-ad-client="ca-pub-4790709439893469"

                    data-ad-slot="6560784744"

                    data-ad-format="auto"

                    data-full-width-responsive="true"></ins>

                <script>

                window.addEventListener("DOMContentLoaded", () => {

                    (adsbygoogle = window.adsbygoogle || []).push({});

                });                </script>

            </div>



            <div class="widget">

                <h5 class="widget-title"><span>Tag Cloud</span></h5>

                <div class="widget-tags">
                    <a href="<?php echo get_tag_link( 29 ) ?>">NYFW</a>
                    <a href="<?php echo get_tag_link( 37 ) ?>">Spring/Summer '20</a>
                    <a href="<?php echo get_tag_link( 30 ) ?>">CAAFD</a>
                    <a href="<?php echo get_tag_link( 6 ) ?>">Fall '19</a>
                    <a href="<?php echo get_tag_link( 7 ) ?>">Couture Collection</a>
                    <a href="<?php echo get_tag_link( 15 ) ?>">Venice Film Festival</a>
                    <a href="<?php echo get_tag_link( 14 ) ?>">Red Carpet</a>
                    <a href="<?php echo get_tag_link( 195 ) ?>">Fall '20</a>
                </div>

            </div>





            <div class="widget">

                <form class="search_form" action="<?php echo get_home_url() . "/"; ?>">

                    <input type="text" name="s" placeholder="Search...">

                    <button type="submit"><i class="fa fa-search"></i></button>

                </form>

            </div>



