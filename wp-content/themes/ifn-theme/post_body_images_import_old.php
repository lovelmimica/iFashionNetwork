<?php  
    require_once("../../../wp-load.php");
    $posts = get_posts( array( 'numberposts' => -1 ) );
    $i = 0;
    foreach( $posts as $post ){
        $content = get_the_content( false, false, $post );
        print_r( $content );
        echo "<br>";
        error_log( $i . ". " . $post->post_name . " content length: " . substr_count( $content, "ifashionnetworks.com/" ) );
        $i++;
    }
?>