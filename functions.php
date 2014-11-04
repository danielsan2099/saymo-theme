<?php


/*Quitar barra de admin */
add_filter( 'show_admin_bar', '__return_false' );

function thumb($url = 1,$tamano = 'full',$html=''){
    
    if(has_post_thumbnail()){
        if ($url==1) {
            $url_image = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), $tamano);
            echo ($url_image[0]);
        }else{
            echo get_the_post_thumbnail(get_the_ID(),$tamano);
        }
    } else {// Recuperamos el post
 
        $html = strtolower($html);
 
        // Extraemos todas las imagenes
        $extrae = '/<img .*src=["\']([^ ^"^\']*)["\']/';
 
        // Extraemos todas las imágenes
        if (preg_match_all( $extrae  , $Html , $matches )) {
            // donde
            // [1] -> segundo elemento del array "texto/imagenes"
            // [0] -> primera imagen del array de "imagenes"
            $image = $matches[1][0];
            
            echo $image;
        }else{
            if ($url==1) {
                echo "/wp-content/uploads/2013/01/inicioOCG.jpg";
            }else{
                echo "<img  sadga src='/wp-content/uploads/2013/01/inicioOCG.jpg' style='width:' />";
            }
        }
        
    }
}

function fancybox($dir,$gal,$rel){
	?>
	<script src="<?php echo get_bloginfo('stylesheet_directory');?>/js/fancybox/source/jquery.fancybox.js?v=2.1.5"></script>
	<link rel="stylesheet" type="text/css" href="<?php echo get_bloginfo('stylesheet_directory');?>/js/fancybox/source/jquery.fancybox.css?v=2.1.5" media="screen" />
	<script>
		/*var galerias = [
			<?php 
				echo "'/'";
				foreach ($dir as $k => $v) {
					echo ",'" . $v . "'";
				}
			?>
		];*/
		$(document).ready(function(){
		    $(".<?php echo $gal ?>").fancybox();
		});
	</script>
	<?php  
		foreach ($dir as $k => $v) {
			$directorio = opendir($v); //ruta actual
			$i=0;
			while ($archivo = readdir($directorio)) {
				$i++;
				if ($archivo != '.' && $archivo != '..') { 
					
					?>
			<a href="/<?php echo $v . $archivo ?>" class="<?php echo $gal ?>" rel="<?php echo $rel ?>">
				<div class="<?php echo $gal ?>_img" style="background-image: url('/<?php echo $v . $archivo ?>')" ></div>
			</a>
					<?php
				}
			}
			echo "<div class='clear'></div>";
		}
	?>
	
	<?php
}

add_theme_support( 'post-thumbnails' );
add_theme_support( 'post-thumbnails', array( 'post' ) );          // Posts only
add_theme_support( 'post-thumbnails', array( 'page' ) );          // Pages only
add_theme_support( 'post-thumbnails', array( 'post', 'movie' ) ); // Posts and Movies