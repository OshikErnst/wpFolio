<?php
/*
Template Name: Homepage
*/
?>
<?php get_header(); ?>
<div id="content_hp_left">
<div id="more_about">
<h2>more about me</h2>
<p>
<?php $wpfolio_moreaboutme = get_option('wpFolio_moreaboutme'); 
	if ($wpfolio_moreaboutme != "") { ?>
		<?php echo $wpfolio_moreaboutme; ?>
	<?php } else { ?>
		<a href="<?php bloginfo('url'); ?>/wp-admin/themes.php?page=functions.php">
		Click Here To Enter More About Me Text
		</a>
	<?php } ?>  
</p>
</div>

<div id="latest_posts">
<h2>latest posts</h2>
<div class="lastest_posts_box">
<?php query_posts('showposts=3&category_name=Latest'); ?>

<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
	<div class="hp_title">
	<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>">
	<?php the_title() ; ?>
	</a>
	</div>
	<div class="hp_excerpt">
	<?php the_excerpt() ;?>
	</div>
	<ul class="latest_postmetadata">
	<li><?php the_time('F jS, Y') ?></li>
	<li class="l_p"><?php the_category(', ') ?></li>
	<li class="l_p"><?php comments_popup_link('Add a comment', '1 Comment', '% Comments '); ?></li>
	<li class="l_p"><?php edit_post_link('<b>Edit</b>', '', ''); ?></li>
	</ul>
	<?php endwhile; ?>
<?php else : ?>
<?php endif; ?>
</div>
</div>
</div>

<div id="content_hp_right">
<div id="hp_contact">
<h2>contact</h2>
<p>
<?php $wpfolio_address = get_option('wpFolio_address'); 
	if ($wpfolio_address != "") { ?>
		<strong>Address:</strong> <?php echo $wpfolio_address; ?><br />
	<?php } else { ?>
		<strong>Address:</strong>
		<a href="<?php bloginfo('url'); ?>/wp-admin/themes.php?page=functions.php">
		 Please Enter<br />
		</a>
	<?php } ?>  
	
	
<?php $wpfolio_country = get_option('wpFolio_country'); 
	if ($wpfolio_country != "") { ?>
		<strong>Country:</strong> <?php echo $wpfolio_country; ?><br />
	<?php } else { ?>
		<strong>Country:</strong>
		<a href="<?php bloginfo('url'); ?>/wp-admin/themes.php?page=functions.php">
		 Please Enter<br />
		</a>
	<?php } ?>  
	
	<br />
<?php $wpfolio_phone = get_option('wpFolio_phone'); 
	if ($wpfolio_phone != "") { ?>
		<strong>Phone:</strong> <?php echo $wpfolio_phone; ?><br />
	<?php } else { ?>
		<strong>Phone:</strong>
		<a href="<?php bloginfo('url'); ?>/wp-admin/themes.php?page=functions.php">
		 Please Enter<br />
		</a>
	<?php } ?>  	
	
	
<?php $wpfolio_email = get_option('wpFolio_email'); 
	if ($wpfolio_email != "") { ?>
		
		<strong>Email:</strong> 
		<span class="email_bitmap">
		<?php echo $wpfolio_email; ?><br />
		</span>
	<?php } else { ?>
		
	<?php } ?>  		


</p>
</div>

<div id="hp_twitter">
<h2>twitter</h2>
<p>
<?php $wpfolio_twitterun = get_option('wpFolio_twitterun'); 
	if ($wpfolio_twitterun != "") { ?>
		<?php twitter_messages('', 5, false, true, false, true, true, false); ?>
	<?php } else { ?>
		
		<a href="<?php bloginfo('url'); ?>/wp-admin/themes.php?page=functions.php">
		 Click Here To Enter Your Twitter User Name
		</a>
	<?php } ?>  	



</p>
</div>
</div>
<?php get_footer(); ?>

