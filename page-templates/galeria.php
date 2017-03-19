<?php
/**
 * Template Name: Galeria
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage SAYMO-Theme
 * @since SAYMO THEME WORDPRESS 0.42
 */
global $wpdb;
$results = $wpdb->get_results( 'SELECT * FROM wp_bwg_gallery', OBJECT );
$count = 0;

get_header(); ?>
<script>	
	$(document).ready(function(){
		$(".fancy").fancybox();
		$("#galeria").addClass("link-active");
		$("#galeria").next().addClass("link-active");
	});
</script>
	
<section>
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-sm-offset-1 col-sm-offset-1 col-lg-offset-1" style = "margin-top : 3rem;">
			<div class="row">
				<div class="col-sm-3 col-md-3 col-lg-3 hidden-xs">
					<?php include_once 'wp-content/themes/SAYMO-theme/sidebar.php'; ?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<div class="">
							<div class="row" style = "margin-bottom: 2rem;">

									<div class = "trans-title white-bg">
										<div class = "gal-green">	
											GALERÍA
										</div>

									</div>
									<img src="<?php echo get_bloginfo('stylesheet_directory');?>/images/top_gal.jpg" alt="" style="width:100%;margin-top:1rem;" />
									<div style = "height: 1rem;">	</div>

									<div class="white-bg" style = "overflow: auto; padding-top: 2rem;">	
									<?php foreach($results as $key => $value): ?>
											<div class="col-xs-12 col-sm-6 col-md-4 col-lg-4 caja_gal_i">
												<a style = "" title="<?php echo $value->name;?>" href="/vista-galeria?galeria=<?php echo $value->id."&album=".$value->name ?>">
														<div class="ddd">
																<div class="not-img" style="background-image:url(/wp-content/uploads/photo-gallery/<?php echo url_bgi($value->random_preview_image); ?>)"></div>
														</div><!-- end |.ddd -->
														<div class = "title title2"><?php echo $value->name;?></div>
												</a>
											
											</div>
									<?php endforeach ?>
									</div>
								</div>
							</div><!-- end .row -->
						<div class="white-bg">	
							<?php include_once 'wp-content/themes/SAYMO-theme/contacto.php'; ?>
						</div>
						<div class="fake-footer-img">	
						<a href="#"><img src="<?php echo get_bloginfo('stylesheet_directory');?>/images/contacto/top.png" alt=""></a>
					</div>
					</div>
				</div>
			</div>
		</div><!--  -->
	</div>
</section>

<?php get_footer(); ?>

<?php function SetSlidersNum ($var, $num_vistas) {
	$rows = count( $var );
	if ($rows % $num_vistas == 0) {
		return $rows / $num_vistas;
	}elseif (round($rows / $num_vistas, 0) > 0){
		return (round($rows / $num_vistas, 0));
	}else {
		return 1;
	}
	}?>
