<?php get_header(); ?>


<div id="content">



	<?php if (have_posts()) : ?>

		<h2 class="pagetitle">Search Result for <?php /* Search Count */ $allsearch = &new WP_Query("s=$s&showposts=-1"); $key = wp_specialchars($s, 1); $count = $allsearch->post_count; _e(''); _e('<span class="search-terms">'); echo $key; _e('</span>'); _e(' &mdash; '); echo $count . ' '; _e('articles'); wp_reset_query(); ?></h2>


		<?php while (have_posts()) : the_post(); ?>
		
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

		<h2 class="center">No posts found. Try a different search?</h2>
		<div id="search">
				<?php get_search_form(); ?>
		</div>

	<?php endif; ?>

	</div>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
