<?php get_header(); ?>
<div id="content">
<?php if (have_posts()) : ?>
		
	<?php while (have_posts()) : the_post(); ?>
		<?php if (in_category(featured)) continue; ?>
		<?php if (in_category(portfolio)) continue; ?>
			<div class="post_hp" id="post-<?php the_ID(); ?>">
				<div id="post_image"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img src="<?php $key="post_image"; echo get_post_meta($post->ID, $key, true); ?>" alt="<?php the_title(); ?>"></a></div>
				
				<div class="post_content">
				<h2><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
				<small>By <?php the_author_posts_link() ?> Posted on <?php the_time('F jS, Y') ?> In <?php the_category(', ') ?></small>
				<ul class="postmetadata">
				<li class="pm_comments"><?php comments_popup_link('Add a comment', '1 Comment', '% Comments '); ?></li>
				<li class="pm_tags"><?php the_tags('', ', ', '<br />'); ?></li>
				<li class="pm_edit"><?php edit_post_link('<b>Edit</b>', '', ''); ?></li>
				</ul>
				

				<div class="hp_entry">
					<?php the_excerpt(); ?>
				</div>

				
			</div>
			</div>

		<?php endwhile; ?>
		<div class="navigation">
			<div class="alignleft"><?php next_posts_link('&laquo; Older Entries') ?></div>
			<div class="alignright"><?php previous_posts_link('Newer Entries &raquo;') ?></div>
		</div>
	<?php else : ?>
	<?php endif; ?>
</div>
<?php get_sidebar();?>
<?php get_footer(); ?>
