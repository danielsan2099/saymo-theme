<?php
/**
 * The loop that displays posts.
 *
 * The loop displays the posts and the post content. See
 * http://codex.wordpress.org/The_Loop to understand it and
 * http://codex.wordpress.org/Template_Tags to understand
 * the tags used in it.
 *
 * This can be overridden in child themes with loop.php or
 * loop-template.php, where 'template' is the loop context
 * requested by a template. For example, loop-index.php would
 * be used if it exists and we ask for the loop with:
 * <code>get_template_part( 'loop', 'index' );</code>
 *
 * @package WordPress
 * @subpackage Gmk_Theme
 * @since Gmk Theme 0.29
 */
?>

<section id="loop">
	<h1>
        LOOP	
    </h1>
	<?php
	$my_query = new WP_Query('cat=2&order=DESC&posts_per_page=3&paged=' . intval($_GET['d']));
	$total = $wp_query->post_count;
	$tags = get_tags();

	while ( $my_query->have_posts() ) : $my_query->the_post(); ?>
		<div class="noticia">
			<div class="Fl imagen_historia">
				<div class="img_noticia" style="background-image:url(<?php thumb() ?>);"></div>
			</div>
			<div class="Fr txt_noticia">
				<div class="tit_noticia"><?php the_title(); ?> | <span class="tag_not">	<?php echo($tags[0]->name) ?></span></div>
				<?php $cont = get_the_content(); echo substr($cont, 0, 800 ); ?>
			</div>
			<div class="clear"></div>
			<div class="link_noticia Fr">
				<a href="<?php the_permalink(); ?>">VER MÁS > </a>
			</div>
			<div class="clear"></div>
			<div class="Fr linea_noticia"></div>
			<div class="clear"></div>
		</div>
	<?php endwhile; ?>
</div>

<div class="paginacion">
	<?php 
		$pagina = '';// siempre colocal al final el slash /
		$content .= '<div class="paginacionProductos Fr">';
		if(!isset($_GET['d'])){
			$_GET['d'] = 1;
		}
		if(intval($_GET['d']) != 1){
		$content .= '   <a href="/'.$pagina.'?d='. (intval($_GET['d']) - 1).'" class="linkPaginadorPage"><div class="btnPaginador anteriorPage Fl">&laquo; P&aacute;gina anterior</div></a>';
		}
		for ($i=1; $i <= $my_query->max_num_pages; $i++) { 
		$classBold = "";
		if (intval($_GET['d']) == $i) {
		  $classBold = "bold";
		}
		$content .= '   <a class="linkPaginadorPage" href="/'.$pagina.'?d='. ($i) .'"><div class="btnPaginador paginaPage '.$classBold.' Fl">' . ($i) . '</div></a>';
		}
		if (intval($_GET['d']) != $my_query->max_num_pages) {
		$content .= '   <a href="/'.$pagina.'?d='. (intval($_GET['d']) + 1).'" class="linkPaginadorPage"><div class="btnPaginador Fl">P&aacute;gina siguiente &raquo;</div></a>';
		}

		$content .= '   <div class="clear"></div>';
		$content .= '</div>';
		echo($content);
	?>
	<div class="clear"></div>
</div>