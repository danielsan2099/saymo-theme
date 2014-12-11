<?php
/**
 * Template Name: Vista Galeria
 *
 * A custom page template without sidebar.
 *
 * The "Template Name:" bit above allows this to be selectable
 * from a dropdown menu on the edit page screen.
 *
 * @package WordPress
 * @subpackage GMK-Theme
 * @since GMK Wordpress Theme 0.42
 */
global $wpdb;
$id = $_GET["galeria"];
$album = $_GET["album"];
$results = $wpdb->get_results( 'SELECT * FROM wp_bwg_image WHERE gallery_id ='.$id.'', OBJECT );
$count = 0;

get_header(); ?>
<!-- Add fancyBox main JS and CSS files -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-54653e9b57eecc2b" async="async"></script>
<script>
	var addthis_config={data_track_clickback:false};
	

	$(document).ready(function(){
		$(".fancy").fancybox({
         beforeShow : function() {
             this.title = '<div class="clear"></div><div class="Fl tit_fancy_txt">'+ this.title +'</div><div class="Fr"><div class="addthis addthis_default_style addthis_32x32_style"><a href="' + this.href + '" addthis:url="' + this.href + '" addthis:title="' + this.title + '" class="addthis_button_facebook"></a><a href="' + this.href + '" addthis:url="' + this.href + '" addthis:title="' + this.title + '" class="addthis_button_twitter"></a><a href="' + this.href + '" addthis:url="' + this.href + '" addthis:title="' + this.title + '" class="addthis_button_email"></a><a href="' + this.href + '" addthis:url="' + this.href + '" addthis:title="' + this.title + '" class="addthis_button_print "></a><a href="' + this.href + '" addthis:url="' + this.href + '" addthis:title="' + this.title + '" class="addthis_button_compact"></a><a href="' + this.href + '" addthis:url="' + this.href + '" addthis:title="' + this.title + '" class="addthis_counter addthis_bubble_style"></a></div></div><div class="clear"></div>';
console.log(this);
         },
         afterShow : function() {
              addthis.toolbox(
                 $(".addthis").get()
             );
             addthis.counter(
                 $(".addthis_counter").get()
             );
         },
         helpers : {
             title : {
                 type : 'inside'
             }   
         }
     });
		$("#galeria").addClass("link-active");
		$("#galeria").next().addClass("link-active");
	});
</script>


<section id = "vista_galeria">
	<div class="row">
		<div class="col-xs-12 col-sm-10 col-md-10 col-lg-10 col-sm-offset-1 col-sm-offset-1 col-lg-offset-1" style = "margin-top : 3rem;">
			<div class="row">
				<div class="col-sm-3 col-md-3 col-lg-3 hidden-xs">
					<?php include_once 'wp-content/themes/gmk-theme/sidebar.php'; ?>
				</div>
				<div class="col-xs-12 col-sm-9 col-md-9 col-lg-9">
					<div class="white-bg trans-title">
						<div style = "font-weight: bold; text-align: center;">
							<span class = "green-title">Galería	"<?php echo $album; ?>" </span>
						</div><!-- end |.tit -->
					</div>
					
					<img src="<?php echo get_bloginfo('stylesheet_directory');?>/images/top_gal.jpg" alt="" style="width:100%;margin-top:1rem;" />
									<div style = "height: 1rem;">	</div>

					<div class="white-bg">
						<div id="carousel-example-gallery" class="carousel slide" data-ride="carousel"  data-interval = "8000" style = "padding-top: 2rem; margin-bottom: 5rem; background-color: #fff;">
							<!-- Indicators -->
							<ol class="carousel-indicators">
								<?php for ($i=0; $i < SetSlidersNum($results, 8); $i++): ?>
									<li data-target="#carousel-example-gallery" data-slide-to="<?php echo $i;?>" class="<?php if ($i == 0) echo "active"; ?>"><?php echo $i + 1;?></li>
								<?php endfor ?>
							</ol>
							<div class="carousel-inner" role="listbox">
							<?php for ($i=0; $i < SetSlidersNum($results, 8); $i++): ?>
								<div class="item <?php if ($i == 0) {echo "active";} ?>">
									<div class="row">
										<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
											<div class="row">
												<?php 
												$limit = $count + 8;
												for($count; $count < $limit; $count++): 
													if($results[$count]->image_url != NULL):?>
													<div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
														<a class="fancy" title="<?php echo $results[$count]->alt." "; ?>" gal="http://pvemsonora.org.mx/vista-galeria/?galeria=2&album=Nuestro%20Dirigente%20PVEM%20Sonora" rel = "gal" href="http://pvemsonora.org.mx/wp-content/uploads/photo-gallery/<?php echo $results[$count]->image_url; ?>">
															<div class="gal-img">
																<div class="not-img" style="background-image:url(http://pvemsonora.org.mx/wp-content/uploads/photo-gallery/<?php echo url_bgi($results[$count]->thumb_url); ?>)"></div>
															</div><!-- end |. -->
														</a>
														<p class = "gal-foot-img"><?php echo $results[$count]->alt." "; ?></p>
													</div>
													<?php endif ?>
												<?php endfor ?>
											</div>
										</div>
									</div>
								</div>
							<?php endfor ?>
							</div>
								<!-- Controls --> 
								<a class="left carousel-control" href="#carousel-example-gallery" role="button" data-slide="prev">
						    		<span class="glyphicon glyphicon-chevron-left"></span>
						    		<span class="sr-only">Previous</span>
						  		</a>
						  		<a class="right carousel-control" href="#carousel-example-gallery" role="button" data-slide="next">
						    		<span class="glyphicon glyphicon-chevron-right"></span>
						    		<span class="sr-only">Next</span>
						  		</a>
					<!-- end Controls -->
						</div>
						<div class="clear">	</div><!-- end |.clear -->
						<div class="Fr">
							<div class="form-group">
								<a href="/galeria"><input  value="REGRESAR" class="btn btn-default btn-md form-control btn_dddd"></a>
							</div>
						</div><!-- end |.Fr -->
						<div class="clear"></div><!-- end |.clear -->
						<?php include_once 'wp-content/themes/gmk-theme/contacto.php'; ?>
					</div>
					<div class="fake-footer-img">	
						<a href="#"><img src="<?php echo get_bloginfo('stylesheet_directory');?>/images/contacto/top.png" alt=""></a>
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
	}elseif (ceil($rows / $num_vistas) > 0){
		return (ceil($rows / $num_vistas));
	}else {
		return 1;
	}
	}

	function showdate($date){
		return $date["mday"]."-".$date["mon"]."-".$date["year"];
	}
	?>