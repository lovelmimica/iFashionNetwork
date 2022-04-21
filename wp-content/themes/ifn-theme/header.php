<!DOCTYPE html>
<?php $_SESSION["displayed_posts"] = array(); ?>

<html>

<head>

    <meta charset="utf-8">

    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=no">

    <title>iFashion Network - Online Magazine and Web Portal for Innovative Fashion and Style</title>

    <meta name="keywords" content="HTML5,CSS3,HTML,Template,Themeton" >

    <meta name="description" content="iFashion Network - Online Magazine and Web Portal for Innovative Fashion and Style">

    <meta name="author" content="Themeton">



    <!-- Favicon -->

    <link rel="shortcut icon" type="image/x-icon" href="<?php echo get_home_url(); ?>/wp-content/uploads//2022/02/ifn-4.png"/>



    <!-- Fonts -->

    <link href='https://fonts.googleapis.com/css?family=Merriweather:400,300,300italic,400italic,700,700italic,900,900italic%7CPlayball%7CMontserrat:400,700' rel='stylesheet' type='text/css'>

    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic' rel='stylesheet' type='text/css'>

    

    <!-- Bootstrap -->

    <link rel="stylesheet" type="text/css" href="<?php echo get_home_url(); ?>/wp-content/themes/ifn-theme/vendors/bootstrap/css/bootstrap.min.css">

    <link rel="stylesheet" type="text/css" href="<?php echo get_home_url(); ?>/wp-content/themes/ifn-theme/vendors/bootstrap/css/bootstrap-theme.min.css">



    <!-- Fontawesome -->

    <link rel="stylesheet" type="text/css" href="<?php echo get_home_url(); ?>/wp-content/themes/ifn-theme/vendors/font-awesome/css/font-awesome.min.css">



    <!-- Swiper -->

    <link rel="stylesheet" type="text/css" href="<?php echo get_home_url(); ?>/wp-content/themes/ifn-theme/vendors/swiper/css/swiper.min.css">



    <!-- Magnific-popup -->

    <link rel="stylesheet" type="text/css" href="<?php echo get_home_url(); ?>/wp-content/themes/ifn-theme/vendors/magnific-popup/magnific-popup.css">



    <!-- Stylesheet -->

    <link rel="stylesheet" type="text/css" href="<?php echo get_home_url(); ?>/wp-content/themes/ifn-theme/style.css">

    <link rel="stylesheet" type="text/css" href="<?php echo get_home_url(); ?>/wp-content/themes/ifn-theme/css/welcome.css">



    <!-- set options before less.js script -->

    <link rel="stylesheet/less" type="text/css" href="<?php echo get_home_url(); ?>/wp-content/themes/ifn-theme/less/style.less" />

    <script>

    less = {

        env: "development",

        async: false,

        fileAsync: false,

        poll: 1000,

        functions: {},

        dumpLineNumbers: "comments",

        relativeUrls: false,

        rootpath: "http://themeton/html/katharine/"

    };

    </script>

    <script src="<?php echo get_home_url(); ?>/wp-content/themes/ifn-theme/js/less.min.js"></script>

    <?php 

        wp_head();

    ?>

</head>



<body>



    <div class="wrapper">
        <?php 
            $cat_id = null;
            if( is_category() ){
                $cat_id = get_queried_object( 'cat' )->term_id;                
                if( !get_field( 'header_image', get_term( $cat_id ) ) ) $cat_id = get_queried_object( 'cat' )->parent;
            }else if( is_post_type_archive( 'runway' ) || is_singular( 'runway' ) ){
                $cat_id = get_category_by_slug( 'runway' )->term_id;
            }else if( is_single() ){
                $categories = get_the_category();
                
                foreach( $categories as $cat ){
                    if(  get_field( 'header_image', $cat ) ){
                        $cat_id = $cat->term_id;
                        break;
                    }else if( get_field( 'header_image', get_term( $cat->parent ) ) ){
                        $cat_id = $cat->parent;
                        break;
                    }
                }
            }

            $header_image_url = $cat_id && get_field( 'header_image', get_term( $cat_id ) ) ? get_field( 'header_image', get_term( $cat_id ) ) : get_option( 'header_image_url' );
        ?>
        
        <header id="header" class="menu-full-bg" >

            <div class="topbar" data-bg-image="<?php echo $header_image_url; ?>">
               
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12 topbar-column">


                        </div>
                    </div>
                </div>
            </div>
            
            <div class="menu-container header-upper">
                
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            
                            <div class="header-wrapper">
                                
                                <div class="topbar-left-content">
                                    <div class="social-links">
                                        <a href="https://www.facebook.com/ifashionnetwork/"><i class="fa fa-facebook"></i></a>
                                        <a href="https://mobile.twitter.com/ifashionnetwork"><i class="fa fa-twitter"></i></a>
                                        <a href="https://www.pinterest.com/ifashionnetwork/_saved/"><i class="fa fa-pinterest"></i></a>
                                        <a href="https://instagram.com/ifashionnetwork/"><i class="fa fa-instagram"></i></a>
                                    </div>
                                </div>
                                
                                <?php if( is_category() ): ?><h1 class='post-title category-title'><?php echo get_queried_object( 'cat' )->name ?></h1>
                                <?php elseif( is_tag() ): ?><h1 class='post-title category-title'><?php echo "Tag: " . get_queried_object( 'tag' )->name ?></h1>
                                <?php elseif( ( is_single() && get_post_type() == 'runway' ) || is_post_type_archive( 'runway' ) ): ?><h1 class='post-title category-title'>Runway</h1>    
                                <?php elseif( is_single() ): ?><h1 class='post-title category-title'><?php echo get_the_category()[0]->name; ?></h1>
                                <?php elseif( is_404() ): ?><h1 class='post-title category-title'><?php echo "Page not Found" ?></h1>
                                <?php elseif( is_search() ): ?><h1 class='post-title category-title'><?php echo "Search Results"; ?></h1>
                                <?php elseif( is_page() ): ?><h1 class='post-title category-title'><?php echo get_the_title(); ?></h1>
                                <?php else: ?><h1 class='post-title category-title' style='opacity: 0'>iFashion Network</h1>
                                <?php endif; ?>
                                
                                <!-- <div class="topbar-right-content"> -->
                                    <a href="javascript:;" id="header-search">
                                        <span>Search</span>
                                        <i class="fa fa-search"></i>
                                    </a>
                                <!-- </div> -->

                            </div>

                        </div>
                    </div>
                </div>

            </div>

            <div class="menu-container header-lower">
                
                <div class="container">
                    <div class="row">
                        <div class="col-sm-12">
                            
                            <div class="header-wrapper">
                                <a href="<?php echo get_home_url(); ?>" id="logo" title="iFashion Network" class="logo-image" data-bg-image="<?php echo get_home_url(); ?>/wp-content/themes/ifn-theme/images/ifn_logo_light.jpg">Katharine</a>
                                <nav class="main-nav">
                                    <ul>
                                        <li class="menu-item-has-children <?php echo is_category( get_category_by_slug( 'fashion' )->term_id ) ? 'current-menu-item' : ''; ?>">
                                            <a href="<?php echo get_category_link( get_category_by_slug( 'fashion' )->term_id ) ?>">Fashion</a>
                                            <ul>
                                                <li class="<?php echo is_category( get_category_by_slug( 'fashion-news' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'fashion-news' )->term_id ) ?>">Fashion News</a></li>
                                                <li class="<?php echo is_category( get_category_by_slug( 'fashion-features' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'fashion-features' )->term_id ) ?>">Fashion Features</a></li>
                                                <li class="<?php echo is_category( get_category_by_slug( 'designers-luxury' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'designers-luxury' )->term_id ) ?>">Designers & Luxury</a></li>
                                            </ul>
                                        </li>
                                        <li class="<?php echo is_post_type_archive( 'runway' ) ? 'current-menu-item' : ''; ?>">
                                            <a href="<?php echo get_post_type_archive_link( 'runway' ); ?>">Runway</a>
                                        </li>
                                        <li class="menu-item-has-children <?php echo is_category( get_category_by_slug( 'beauty' )->term_id ) ? 'current-menu-item' : ''; ?>">
                                            <a href="<?php echo get_category_link( get_category_by_slug( 'beauty' )->term_id ) ?>">Beauty</a>
                                            <ul>
                                                <li class="<?php echo is_category( get_category_by_slug( 'makeup' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'makeup' )->term_id ) ?>">Makeup</a></li>
                                                <li class="<?php echo is_category( get_category_by_slug( 'skincare' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'skincare' )->term_id ) ?>">Skincare</a></li>
                                                <li class="<?php echo is_category( get_category_by_slug( 'hair' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'hair' )->term_id ) ?>">Hair</a></li>
                                                <li class="<?php echo is_category( get_category_by_slug( 'nails' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'nails' )->term_id ) ?>">Nails</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children <?php echo is_category( get_category_by_slug( 'entertainment' )->term_id ) ? 'current-menu-item' : ''; ?>">
                                            <a href="<?php echo get_category_link( get_category_by_slug( 'entertainment' )->term_id ) ?>">Entertainment</a>
                                            <ul>
                                                <li class="<?php echo is_category( get_category_by_slug( 'celebrity-news' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'celebrity-news' )->term_id ) ?>">Celebrity News</a></li>
                                                <li class="<?php echo is_category( get_category_by_slug( 'movies-tv' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'movies-tv' )->term_id ) ?>">Movies & TV</a></li>
                                                <li class="<?php echo is_category( get_category_by_slug( 'music' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'music' )->term_id ) ?>">Music</a></li>
                                            </ul>
                                        </li>
                                        <li class="menu-item-has-children <?php echo is_category( get_category_by_slug( 'lifestyle' )->term_id ) ? 'current-menu-item' : ''; ?>">
                                            <a href="<?php echo get_category_link( get_category_by_slug( 'lifestyle' )->term_id ) ?>">Lifestyle</a>
                                            <ul>
                                                <li class="<?php echo is_category( get_category_by_slug( 'travel' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'travel' )->term_id ) ?>">Travel</a></li>
                                                <li class="<?php echo is_category( get_category_by_slug( 'food' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'food' )->term_id ) ?>">Food</a></li>
                                                <li class="<?php echo is_category( get_category_by_slug( 'health-lifestyle' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'health-lifestyle' )->term_id ) ?>">Health</a></li>
                                                <li class="<?php echo is_category( get_category_by_slug( 'fitness' )->term_id ) ? 'current-menu-item' : ''; ?>"><a href="<?php echo get_category_link( get_category_by_slug( 'fitness' )->term_id ) ?>">Fitness</a></li>
                                            </ul>
                                        </li>
                                    </ul>

                                    <a href="javascript:;" id="close-menu"><i class="fa fa-close"></i></a>
                                </nav>
                            
                            </div>

                        </div>
                    </div>
                </div>

            </div>

        </header>