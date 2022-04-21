<?php get_header(); ?>

<?php $_SESSION["displayed_posts"] = array(); ?>



<section class="section-content">



<div class="container main-container">

    <div class="row">

        

        <div class="col-sm-12">



            <article class="blog-item blog-single">



                <h1 class="post-title">

                    We Love to Hear from You

                </h1>



                <div class="entry-excerpt">



                    <form class='contact-us-form' method='post' action='<?php echo get_home_url() ?>/wp-json/v1/send-email'>

                        <div class="row">

                            <div class="col-sm-6">

                                <p><input type="text" name="name" placeholder="Your Name *" required></p>

                                <p><input type="email" name="email" placeholder="Your E-mail *" required></p>

                                <p><input type="text" name="subject" placeholder="Subject *" required></p>

                            </div>

                            <div class="col-sm-6">

                                <textarea name='message' placeholder="Message" required></textarea>


                            </div>

                            <div class='col-sm-6'>
                                <button type="submit" class="button-full button-fill">Send Message</button>

                            </div>

                        </div>

                    </form>
                    <?php 
                        if( isset( $_REQUEST['email-sent'] ) && $_REQUEST['email-sent'] == "true" ){
                            echo "<p class='email-message success'>Thank you! We have received your message</p>";
                        }else if( isset( $_REQUEST['email-sent'] ) && $_REQUEST['email-sent'] == "false" ){
                            echo "<p class='email-message error'>Oops! Something went wrong. Please refresh the page, and try again.</p>";
                        }
                    ?>


                    <br><br>

                    <div id="tt-google-map" class="tt-google-map" data-lat="47.919311" data-lng="106.917643" data-zoom="16" data-saturation="-100" data-color="#333" data-marker="images/svg/marker.svg">

                        <div id="gmap_content">

                            <div class="gmap-item">

                                <label class="label-title">Keep in touch</label>

                            </div>

                            <div class="gmap-item">

                                <label>

                                    <i class="fa fa-map-marker"></i>

                                </label>

                                <span>Address : 44 New Design Street, Melbourne 005</span>

                            </div>

                            <div class="gmap-item">

                                <label>

                                    <i class="fa fa-phone"></i>

                                </label>

                                <span>Phone: (01) 800 433 633</span>

                            </div>

                            <div class="gmap-item">

                                <label>

                                    <i class="fa fa-envelope"></i>

                                </label>

                                <span>Email: info@Example.com</span>

                            </div>

                        </div>

                    </div>



                </div>



                <br><br>





            </article>





        </div>





    </div>

</div>

</section>





<?php get_footer(); ?>