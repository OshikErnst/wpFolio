<?php get_header(); ?>
<div id="content">
<?php if (have_posts()) : ?>
		
	<?php while (have_posts()) : the_post(); ?>
			
	<div class="post" id="post-<?php the_ID(); ?>">
			<div id="post_meta">
			<h2><?php the_title(); ?></h2>
			
			</div>	
			<div class="entry">
				<?php the_content(); ?>

				<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>

				

			</div>
		</div>

	
	<?php endwhile; ?>
		
	<?php else : ?>
	<?php endif; ?>
</div>
<?php get_sidebar();?>
<?php get_footer(); ?>

