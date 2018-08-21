</div> <!-- end of main -->
</div> <!-- end of wrapper -->
<div id="footer">
<?php do_action('wp_footer'); ?>
<div class="credit">
	<p><?php echo sprintf(__("Powered by <a href='http://wordpress.org/' title='%s'><strong>WordPress</strong></a>"), __("Powered by WordPress, state-of-the-art semantic personal publishing platform.")); ?> | Theme by <a href="http://www.wpfeed.com">wpfeed.com</a></p>
</div>
<ul id="footerbar">
	<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
	<?php 
	$hp_id = get_page_by_title('homepage');
	wp_list_pages('exclude='.$hp_id->ID.'&title_li=&depth=1'); 
	?>
</ul>
</div>

</body>
</html>
