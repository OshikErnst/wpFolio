<?php
/*
Template Name: Portfolio
*/
?>
<?php get_header(); ?>
<div id="content_portfolio">
<div id="portfolio_meta">
			<h2><?php the_title(); ?></h2>
			
			</div>	
<?php query_posts('category_name=Portfolio') ?>
<div id="portfolio_loop">
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
<div class="work_title">
    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php $key="p_image"; echo get_post_meta($post->ID, $key, true); ?>" class="portfolio" alt="" title="<?php the_title() ?>" /></a>
    <div class="work_t">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">    
    <?php the_title() ?>
    </a>
    </div>
    </div>
     <?php 
	endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
</div>


</div>


<?php get_footer(); ?>

