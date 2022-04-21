<?php

    session_start();

    add_theme_support( 'post-thumbnails' );

    function check_attempted_login( $user, $username, $password ) {

        if ( get_transient( 'attempted_login' ) ) {

            $datas = get_transient( 'attempted_login' );

    

            if ( $datas['tried'] >= 3 ) {

                $until = get_option( '_transient_timeout_' . 'attempted_login' );

                $time = time_to_go( $until );

    

                return new WP_Error( 'too_many_tried',  sprintf( __( '<strong>ERROR</strong>: You have reached authentication limit, you will be able to try again in %1$s.' ) , $time ) );

            }

        }

    

        return $user;

    }

    add_filter( 'authenticate', 'check_attempted_login', 30, 3 ); 

    function login_failed( $username ) {

        if ( get_transient( 'attempted_login' ) ) {

            $datas = get_transient( 'attempted_login' );

            $datas['tried']++;

    

            if ( $datas['tried'] <= 3 )

                set_transient( 'attempted_login', $datas , 300 );

        } else {

            $datas = array(

                'tried'     => 1

            );

            set_transient( 'attempted_login', $datas , 300 );

        }

    }

    add_action( 'wp_login_failed', 'login_failed', 10, 1 ); 

    

    function time_to_go($timestamp)

    {

    

        // converting the mysql timestamp to php time

        $periods = array(

            "second",

            "minute",

            "hour",

            "day",

            "week",

            "month",

            "year"

        );

        $lengths = array(

            "60",

            "60",

            "24",

            "7",

            "4.35",

            "12"

        );

        $current_timestamp = time();

        $difference = abs($current_timestamp - $timestamp);

        for ($i = 0; $difference >= $lengths[$i] && $i < count($lengths) - 1; $i ++) {

            $difference /= $lengths[$i];

        }

        $difference = round($difference);

        if (isset($difference)) {

            if ($difference != 1)

                $periods[$i] .= "s";

                $output = "$difference $periods[$i]";

                return $output;

        }

    }

    

    function admin_bar(){

        if(is_user_logged_in()){

          add_filter( 'show_admin_bar', '__return_true' , 1000 );

        }

      }

      add_action('init', 'admin_bar' );



    function enqueue_scripts(){

        wp_enqueue_script('core_js', get_stylesheet_directory_uri() . '/js/core.js');
        wp_enqueue_script('sticky_header_js', get_stylesheet_directory_uri() . '/js/sticky-header.js');
        if( is_single() ) wp_enqueue_script('gallery_modal_js', get_stylesheet_directory_uri() . '/js/gallery-modal.js');
        if( is_single() ) wp_enqueue_script('disqus_js', get_stylesheet_directory_uri() . '/js/disqus.js');
        if( is_archive() ) wp_enqueue_script('runway_filter_js', get_stylesheet_directory_uri() . '/js/runway-filter.js');
        if( is_admin() ) wp_enqueue_script('post_validation_js', get_stylesheet_directory_uri() . '/js/runway-filter.js');
    }

    add_action( 'wp_enqueue_scripts', 'enqueue_scripts' ); 

    /* Admin CSS styles */
    add_action( 'admin_enqueue_scripts', 'admin_style_css' );
    function admin_style_css(){
        $url = get_option('siteurl');
        $url = $url . '/wp-content/themes/ifn-theme/css/wp-admin.css';

        echo '<link rel="stylesheet" type="text/css" href="' . $url . '" />';
        

    }

    add_action( 'wp_loaded', 'admin_scripts' );
    function admin_scripts(){
        wp_enqueue_script('core_js', get_stylesheet_directory_uri() . '/js/core.js');
        if( is_admin() ) wp_enqueue_script('post_validation_js', get_stylesheet_directory_uri() . '/js/post-validation.js');
    }

    /* Slider post card */

    function slider_post_card_shortcode( $atts ){

        $a = shortcode_atts( array( 'id' => null ), $atts );
        if( $a['id'] == null ) return;

        $post = get_post( $a['id'] );
        $date = get_the_date( "F d Y", $post );
        $category = get_the_category( $post )[0]->name; 
        $word_count = str_word_count( $post->post_content );
        $reading_time = ( round( $word_count / 200 ) + 1 ) . " min";
        $excerpt = get_the_excerpt( $post );

        if( isset($_SESSION["displayed_posts"]) ) array_push( $_SESSION["displayed_posts"], $post->ID );

        ?>

        <div class="swiper-slide">
                <div class="blog-item-boxed style-active-meta">
                    <div class="entry-media">
                        <img src="<?php echo get_the_post_thumbnail_url( $post ); ?>" alt="blog image">
                        <div class="entry-overlay"></div>
                    </div>
                    <div class="entry-info">
                        <div class="entry-date">
                            <span><?php echo $date . " - <b>" . $category . "</b>" ?></span>
                        </div>

                        <h3 class="post-title">
                            <a href="<?php echo get_permalink( $post->ID ) ?>"><?php echo $post->post_title; ?></a>
                        </h3>

                        <div class="read-more">
                            <a href="<?php echo get_permalink( $post->ID ) ?>" class="button button-fill">Read More</a>
                        </div>

                        <div class="seperator with-colored"><span></span></div>
                    </div>
                </div>
        </div>

    <?php }



    add_shortcode( 'slider_post_card', 'slider_post_card_shortcode' );



    /* Grid post card */

    function grid_post_card_shortcode( $atts ){

        $a = shortcode_atts( array( 'id' => null ), $atts );
        if( $a['id'] == null ) return;

        $post = get_post( $a['id'] );
        $date = get_the_date( "F d Y", $post );
        //$category = get_the_category( $post )[0]->name; 
        $word_count = str_word_count( $post->post_content );
        $reading_time = ( round( $word_count / 200 ) + 1 ) . " min";
        $excerpt = get_the_excerpt( $post );

        if( isset($_SESSION["displayed_posts"]) ) array_push( $_SESSION["displayed_posts"], $post->ID );

        ?>

        <div class="col-sm-4 masonry-item grid-post-card">
            <article class="blog-item">

                <div class="entry-date">
                    <span><?php echo $date ?></span>
                </div>

                <h3 class="post-title">
                    <a href="<?php echo get_permalink( $post->ID ) ?>"><?php echo $post->post_title; ?></a>
                </h3>

                <div class="entry-media">
                    <a href="<?php echo get_permalink( $post->ID ); ?>" class="el-link">
                        <img src="<?php echo get_the_post_thumbnail_url( $post ); ?>" alt="blog image">
                        <div class="entry-overlay"></div>
                    </a>
                </div>

                <div class="entry-meta">
                    <span>
                        <svg color='white' version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43 43" enable-background="new 0 0 43 43" xml:space="preserve">                                
                            <circle stroke='rgba(119, 119, 119, 1)' fill="none" stroke="#444444" stroke-width="2" stroke-miterlimit="10" cx="21.5" cy="21.5" r="20"/>
                            <polyline fill="rgba(119, 119, 119, 1)" stroke="#444444" stroke-width="2" stroke-miterlimit="10" points="21.5,9.5 21.5,21.5 29.5,25.5 "/>
                        </svg>
                        <span><?php echo $reading_time; ?></span>
                    </span>
                </div>

                <div class="entry-excerpt text-center">
                    <p>
                        <?php echo $excerpt ?>
                    </p>
                    <br>
                    <a href="<?php echo get_permalink( $post->ID ) ?>" class="button button-fill button-bordered button-small">Read More</a>
                </div>

                <div class="seperator"><span></span></div>

            </article>
        </div>
        <?php

    }

    add_shortcode( 'grid_post_card', 'grid_post_card_shortcode' );


    /* Archive post card */

    function archive_grid_post_card_shortcode( $atts ){
        $a = shortcode_atts( array( 'id' => null ), $atts );

        if( $a['id'] == null ) return;

        $post = get_post( $a['id'] );
        $date = get_the_date( "F d Y", $post );
        $category = get_the_category( $post )[0]->name; 
        $word_count = str_word_count( $post->post_content );
        $reading_time = ( round( $word_count / 200 ) + 1 ) . " min";
        $excerpt = get_the_excerpt( $post );

        $season = sanitize_title( get_field( 'year', $post->ID ) . " " . get_field( 'season', $post->ID ) );
        $city = sanitize_title( get_field( 'city', $post->ID ) );
        $designer = sanitize_title( get_field( 'designer', $post->ID ) );

        if( isset($_SESSION["displayed_posts"]) ) array_push( $_SESSION["displayed_posts"], $post->ID );
        ?>
            <article class="blog-item grid-post-card" data-season="<?php echo $season; ?>" data-city="<?php echo $city; ?>" data-designer="<?php echo $designer; ?>" >

                <div class="entry-date">
                    <span><?php echo $date; ?></span>
                </div>

                <div class="entry-media">
                    <a href="<?php echo get_permalink( $post->ID ) ?>" class="el-link">
                        <img src="<?php echo get_the_post_thumbnail_url( $post ); ?>" alt="blog image">
                        <div class="entry-overlay"></div>
                    </a>
                </div>

                <h2 class="post-title">
                    <a href="<?php echo get_permalink( $post->ID ) ?>"><?php echo $post->post_title; ?></a>
                </h2>

                <div class="entry-meta">
                    <span>
                        <svg color='white' version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43 43" enable-background="new 0 0 43 43" xml:space="preserve">                                
                            <circle stroke='grey' fill="none" stroke="#444444" stroke-width="2" stroke-miterlimit="10" cx="21.5" cy="21.5" r="20"/>
                            <polyline fill="grey" stroke="#444444" stroke-width="2" stroke-miterlimit="10" points="21.5,9.5 21.5,21.5 29.5,25.5 "/>
                        </svg>
                        <span><?php echo $reading_time; ?></span>
                    </span>
                </div>

            </article>
        <?php
    }

    add_shortcode( 'archive_grid_post_card', 'archive_grid_post_card_shortcode' );

    function archive_row_post_card_shortcode( $atts ){
        $a = shortcode_atts( array( 'id' => null ), $atts );

        if( $a['id'] == null ) return;

        $post = get_post( $a['id'] );
        $date = get_the_date( "F d Y", $post );
        $category = is_category() ? get_the_category( $post )[0]->name : "Runway"; 
        $word_count = str_word_count( $post->post_content );
        $reading_time = ( round( $word_count / 200 ) + 1 ) . " min";
        $excerpt = get_the_excerpt( $post );

        $season = sanitize_title( get_field( 'year', $post->ID ) . " " . get_field( 'season', $post->ID ) );
        $city = sanitize_title( get_field( 'city', $post->ID ) );
        $designer = sanitize_title( get_field( 'designer', $post->ID ) );

        if( isset( $_SESSION["displayed_posts"]) ) array_push( $_SESSION["displayed_posts"], $post->ID );
        ?>
        <article class="blog-item style-horizontal row-post-card" data-season="<?php echo $season; ?>" data-city="<?php echo $city; ?>" data-designer="<?php echo $designer; ?>">

            <div class="row">
                <div class="col-sm-6 media-wrapper">
                    <div class="entry-media">
                        <a href="<?php echo get_permalink( $post->ID ) ?>" class="el-link">
                            <img src="<?php echo get_the_post_thumbnail_url( $post ); ?>" alt="blog image">
                            <div class="entry-overlay"></div>
                        </a>
                    </div>
                </div>
                <div class="col-sm-6 content-wrapper">
                    <div class="entry-date">
                        <span><?php echo $date; ?></span>
                    </div>

                    <h2 class="post-title">
                        <a href="<?php echo get_permalink( $post->ID ) ?>"><?php echo $post->post_title; ?></a>
                    </h2>

                    <div class="entry-meta">
                        <span>
                            <svg color='white' version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 43 43" enable-background="new 0 0 43 43" xml:space="preserve">                                
                                <circle stroke='grey' fill="none" stroke="#444444" stroke-width="2" stroke-miterlimit="10" cx="21.5" cy="21.5" r="20"/>
                                <polyline fill="grey" stroke="#444444" stroke-width="2" stroke-miterlimit="10" points="21.5,9.5 21.5,21.5 29.5,25.5 "/>
                            </svg>
                            <span><?php echo $reading_time; ?></span>
                        </span>
                    </div>
                </div>
            </div>

        </article>
        <?php 
    }

    add_shortcode( 'archive_row_post_card', 'archive_row_post_card_shortcode' );

    //Featured popular post cart
    function featured_popular_post_card_shortcode( $atts ){

        $a = shortcode_atts( array( 'id' => null ), $atts );

        if( $a['id'] == null ) return;

        $post = get_post( $a['id'] );
        $date = get_the_date( "F d Y", $post );
        $category = get_the_category( $post )[0]->name; 
        $word_count = str_word_count( $post->post_content );
        $reading_time = ( round( $word_count / 200 ) + 1 ) . " min";
        $excerpt = get_the_excerpt( $post );

        if( isset($_SESSION["displayed_posts"]) ) array_push( $_SESSION["displayed_posts"], $post->ID );

        ?>

        <div class="rp-featured">

            <div class="rp-media">

                <a href="<?php echo get_permalink( $post->ID ) ?>"><img src="<?php echo get_the_post_thumbnail_url( $post ); ?>" alt="thumb"></a>

                <span>1</span>

            </div>

            <div class="rp-category"><span><?php echo $date . " - <b>" . $category . "</b>" ?></span></div>

            <h5><a href="<?php echo get_permalink( $post->ID ) ?>"><?php echo $post->post_title; ?></a></h5>

            <div class="seperator"><span></span></div>
        </div>

        <?php
    }

    add_shortcode( 'featured_popular_post_card', 'featured_popular_post_card_shortcode' );

    function popular_post_card_shortcode( $atts ){
        $a = shortcode_atts( array( 'id' => null ), $atts );

        if( $a['id'] == null ) return;

        $post = get_post( $a['id'] );
        $date = get_the_date( "F d Y", $post );
        $category = get_the_category( $post )[0]->name; 
        $word_count = str_word_count( $post->post_content );
        $reading_time = ( round( $word_count / 200 ) + 1 ) . " min";
        $excerpt = get_the_excerpt( $post );
        ?>

        <li>
            <a href="<?php echo get_permalink( $post->ID ) ?>" class="link-post"><?php echo $post->post_title; ?></a>
            <span class="link-cat"> - <?php echo $category; ?></span>
        </li>

        <?php
    }

    add_shortcode( 'popular_post_card', 'popular_post_card_shortcode' );

    /* Header image */
    //add_action( 'init', 'register_header_image_post_type' );
    function register_header_image_post_type(){
        $args = array(
            'labels' => array(
                'name' => 'Header Image List',
                'singular_name' => 'Header Image'
            ),
            'menu_icon' => 'dashicons-images-alt2',
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_position' => 9
        );
        register_post_type( 'header_image', $args );
    }

    add_action( 'admin_menu', 'header_images_settings_page' );
    function header_images_settings_page(){
        add_menu_page(
            'Header Image Settings', // page <title>Title</title>
            'Header Image Settings', // menu link text
            'manage_options', // capability to access the page
            'header-images', // page URL slug
            'header_images_content', // callback function /w content
            'dashicons-images-alt2', // menu icon
            6 // priority
        );
    }

    function header_images_content(){

        echo '<div class="wrap">
                <h1>Header Image Settings</h1>
                    <form method="post" action="options.php">';

                    settings_fields( 'header_image_setting' );
                    do_settings_sections( 'header-images' );
                    submit_button();

        echo '</form></div>';
    }

    
    add_action( 'admin_init',  'header_image_register_settings' );
    function header_image_register_settings(){
        
        add_settings_section( 
            'header_image_settings_section_id',
            '',
            '',
            'header-images'
        );

        //Default Change Frequency
        register_setting( 
            'header_image_setting',
            'change_frequency',
            'sanitize_text_field'
        );

        add_settings_field( 
            'change_frequency',
            'Change Frequency',
            'header_images_change_frequency_html',
            'header-images',
            'header_image_settings_section_id',
            array( 'label_for' => 'change_frequency' )
        );
        //TODO: Add 'Default' keyword to the field title, add default current image, default next image, default next switch, OPTIONAL: default upcoming images, default upcoming switches

        //Header Image URLs
        register_setting( 
            'header_image_setting',
            'header_image_url',
            'sanitize_text_field'
        );

        add_settings_field( 
            'header_image_url',
            'Header Image',
            'header_images_url_html',
            'header-images',
            'header_image_settings_section_id',
            array( 'label_for' => 'header_image_url' )
        );
        //TODO: Foreach category and page insert related settings fields (current image, next image, next switch, OPTIONAL: upcoming images, upcoming switches)
    }

    function header_images_change_frequency_html(){
        $value = get_option( 'change_frequency' );

        $none_selected = $value == "none" ? 'selected="selected"' : "";
        $hourly_selected = $value == "hourly" ? 'selected="selected"' : "";
        $twicedaily_selected = $value == "twicedaily" ? 'selected="selected"' : "";
        $daily_selected = $value == "daily" ? 'selected="selected"' : "";

        printf(
            '<select name="change_frequency" id="change_frequency">
                <option name="none" value="none" %s>None</option>
                <option name="hourly" value="hourly" %s>Hourly</option>
                <option name="twicedaily" value="twicedaily" %s>Twice Daily</option>
                <option name="daily" value="daily" %s>Daily</option>
            </select>', $none_selected, $hourly_selected, $twicedaily_selected, $daily_selected
        );
    }
    
    function header_images_url_html(){
            $value = get_option( 'header_image_url' );
            //$header_images = get_posts( array( 'numbeposts' => -1, 'post_type' => 'header_image' ) );
            $categories = get_categories( array( "hide_empty" => 0 ) );

            foreach( $categories as $cat ){
                $image_url = get_field( 'header_image', $cat );
                if( $image_url ){
                    $checked = "";
                    if( $image_url == $value ) $checked = "checked";
                    echo "<div class='header-image-url-input-wrapper'><input class='header-image-url-input' type='radio' id='{$image_url}' name='header_image_url' value='{$image_url}' {$checked}><label class='header-image-url-input-label' for='{$image_url}'>{$cat->name}<img class='header-image-url-input-img' src='{$image_url}'/></label></div>";    
                }
            }

            // foreach( $header_images as $header_image_post ){
            //     $image_url = get_field( 'header_image', $header_image_post->ID);

            //     $checked = "";
            //     if( $image_url == $value ) $checked = "checked";

            //     echo "<div class='header-image-url-input-wrapper'><input class='header-image-url-input' type='radio' id='{$image_url}' name='header_image_url' value='{$image_url}' {$checked}><label class='header-image-url-input-label' for='{$image_url}'><img class='header-image-url-input-img' src='{$image_url}'/></label></div>";
            // }
    }

    

    function add_last_change_frequency_option(){
        if( !get_option( 'last_change_frequency' ) ) add_option( 'last_change_frequency', '' );
    }
    add_action( 'init', 'add_last_change_frequency_option' );

    $change_frequnecy = get_option( 'change_frequency' );
    $last_change_frequency = get_option( 'last_change_frequency' );
    //wp_clear_scheduled_hook( 'periodically_change_header_image' );
    if( $change_frequnecy && $change_frequnecy != 'none' ){
        if( !wp_next_scheduled( "periodically_change_header_image" ) ){

            wp_schedule_event( time(), $change_frequnecy, "periodically_change_header_image" );
    
        }else if( $change_frequnecy != $last_change_frequency  ){
            update_option( 'last_change_frequency', $change_frequnecy );
            wp_reschedule_event( time(), $change_frequnecy, "periodically_change_header_image" );
        }
    }


    add_action( "periodically_change_header_image", "change_header_image" );

    function change_header_image(){
        error_log( "Starting change_header_image: " . get_option( 'header_image_url' ) );
        $current_image_url = get_option( 'header_image_url' );
        $header_image_posts = get_posts( array( 'numbeposts' => -1, 'post_type' => 'header_image' ) );

        $i = 0;
        foreach( $header_image_posts as $image_post ){
            $image_url = get_field( 'header_image', $image_post->ID );

            if( $image_url == $current_image_url ){
                $next_image_index = ($i + 1)  == count( $header_image_posts ) ? 0 : $i + 1;
                $next_image_url = get_field( 'header_image', $header_image_posts[$next_image_index]->ID );
 
                error_log( "Current index: " . $i . " , next index: " . $next_image_index );
                error_log( "Changing Header Image from {$current_image_url} to {$next_image_url}" );
                error_log( get_option( 'header_image_url' ) );
                update_option( 'header_image_url', $next_image_url );
                error_log( get_option( 'header_image_url' ) );

                break;
            }
            $i++;
        }
    }

    /* Runway posts filter form */
    add_shortcode( 'runway_posts_filter_form', 'runway_posts_filter_form_shortcode' );
    function runway_posts_filter_form_shortcode(){
        $runway_posts = get_posts( array( 'numberposts' => -1, 'post_type' => 'runway' ) );
        $season_options = array();
        $designer_options = array();
        foreach( $runway_posts as $post ){
            $season = get_field( 'season', $post->ID );
            $year = get_field( 'year', $post->ID );
            $designer = get_field( 'designer', $post->ID );
            if( !in_array( $year . " " . $season, $season_options ) ) array_push( $season_options, $year . " " . $season );
            if( !in_array( $designer, $designer_options ) ) array_push( $designer_options, $designer );
        }
        rsort( $season_options );
        sort( $designer_options );
        ?>                    
        <form class='runway-filter-form'>
            <label>View By</label>
            <select name='season'>
                <option value=''>Season</option>
                <?php 
                    foreach( $season_options as $season ){
                        if( $season && $season != "" ){
                            $season_slug = sanitize_title( $season );
                            echo "<option value='{$season_slug}'>{$season}</option>" ;
                        }
                    } 
                ?>
            </select>

            <select name='city'>
                <option value=''>City</option>
                <option value='milan'>Milan</option>
                <option value='paris'>Paris</option>
                <option value='london'>London</option>
                <option value='new-york'>New York</option>
            </select>

            <select name='designer'>
                <option value=''>Designer</option>
                <?php 
                    foreach( $designer_options as $designer ){
                        if( $designer && $designer != "" ){
                            $designer_slug = sanitize_title( $designer );
                            echo "<option value='{$designer_slug}'>{$designer}</option>" ;
                        }
                    } 
                ?>
            </select>
        </form>

        <?php
    }

    function season_sort( $a, $b ){

    }

    add_action( 'init', 'register_runway_post_type' );
    function register_runway_post_type(){
        $args = array(
            'labels' => array(
                'name' => 'Runway Posts',
                'singular_name' => 'Runway Post' 
            ),
            'menu_icon' => 'dashicons-admin-post',
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true,
            'has_archive' => true,
            'menu_position' => 4,
            'rewrite' => array(
                'slug' => 'runway',
                'with_front' => false
            ),
            'supports' => array( 'title', 'editor', 'custom-fields', 'thumbnail', 'author' )
        );

        register_post_type( 'runway', $args );
    }

    /* Contact form backend */
    function send_email( $request ){

        $name = filter_form_input( $request['name'] );
        $email = filter_form_input( $request['email'] );
        $subject = filter_form_input( $request['subject'] );
        $message = filter_form_input( $request['message'] );
        $message = str_replace( "\n.", "\n..", $message );

        if( mail( "info@ifashionnetwork.com", $subject, $message, "From: {$name} {$email} \r\n" ) ){
            $url = get_site_url() . '/contact-us?email-sent=true';
        }else{
            $url = get_site_url() . '/contact-us?email-sent=false';
        }
        
        if( wp_redirect( $url ) ) exit;
    }

    function filter_form_input( $str ){
        $str = addslashes( $str );
        $str = preg_replace("/<script>|<\/script>/i", "", $str);
        $str = preg_replace("/<|>/i", "", $str);

        return $str;    
    }

    function register_sent_email_route(){
        $args = array( 
            'methods' => 'POST',
            'callback' => 'send_email'
        );
        register_rest_route( 'v1', '/send-email', $args );
    }

    add_action( 'rest_api_init', 'register_sent_email_route' );

    /* Fashion quote post type */
    function add_fashion_quote_post_type(){
        $args = array(
            'labels' => array(
                'name' => 'Fashion Quotes',
                'singular_name' => 'Fashion Quote' 
            ),
            'menu_icon' => 'dashicons-format-quote',
            'public' => true,
            'show_ui' => true,
            'show_in_menu' => true
        );
    
        register_post_type( 'fashion_quote', $args );
    }
    add_action( 'init', 'add_fashion_quote_post_type' );

?>
