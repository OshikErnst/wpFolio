<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/featured.css" type="text/css" media="screen" />

<?php $wpfolio_color = get_option('wpFolio_alt_color'); 
	if ($wpfolio_color != "") { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/<?php echo $wpfolio_color; ?>/style.css" type="text/css" media="screen" />
	<?php } else { ?>
		<link rel="stylesheet" href="<?php bloginfo('template_url'); ?>/css/purple/style.css" type="text/css" media="screen" />
	<?php } ?>    
	
	

<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />



  <script type="text/javascript">var _siteRoot='index.php',_root='index.php';</script>


  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/jquery.js"></script>
  <script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/scripts.js"></script>
  <script>
// Javascript originally by Patrick Griffiths and Dan Webb.
// http://htmldog.com/articles/suckerfish/dropdowns/
sfHover = function() {
	var sfEls = document.getElementById("navbar").getElementsByTagName("li");
	for (var i=0; i<sfEls.length; i++) {
		sfEls[i].onmouseover=function() {
			this.className+=" hover";
		}
		sfEls[i].onmouseout=function() {
			this.className=this.className.replace(new RegExp(" hover\\b"), "");
		}
	}
}
if (window.attachEvent) window.attachEvent("onload", sfHover);
</script>

<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/cufon.js"></script>
<script type="text/javascript" src="<?php bloginfo('template_url'); ?>/js/Sansation_400-Sansation_700.font.js"></script>
<script type="text/javascript">

Cufon('#about p');
Cufon('#more_about h2');
Cufon('#latest_posts h2');
Cufon('#hp_contact h2');
Cufon('#hp_twitter h2');

Cufon('#post_meta h2');
Cufon('#portfolio_meta h2');
Cufon('#sidebar h2');
Cufon('#post_content h2')
Cufon(".post_content h2")
Cufon('.work_t a');
Cufon('.email_bitmap');

		</script>


  <?php wp_head(); ?>
  	<!--[if IE 6]>
    		<link href="<?php bloginfo('template_url'); ?>/styleIE6.css" rel="stylesheet" type="text/css" />
		<![endif]-->

</head>
<body>

<div id="wrapper">

<div id="header">
<div id="header_left">
<div id="logo"><h1><a href="<?php bloginfo('url'); ?>" title="Home"><span><?php bloginfo('name'); ?></span></a></h1></div>
</div>

<div id="header_right">
<div id="search">
<?php get_search_form(); ?>
</div>
<div id="nav_wrapper">
<ul id="navbar">
	<li><a href="<?php echo get_option('home'); ?>">Home</a></li>
	
	<?php 
	$hp_id = get_page_by_title('homepage');
	wp_list_pages('exclude='.$hp_id->ID.'&title_li=&depth=2'); 
	?>
</ul>
</div>
</div>
</div>

<div id="featured">
<div id="about">
<p>
<?php $wpfolio_intro = get_option('wpFolio_introText'); 
	if ($wpfolio_intro != "") { ?>
		<?php echo $wpfolio_intro; ?>
	<?php } else { ?>
		<a href="<?php bloginfo('url'); ?>/wp-admin/themes.php?page=functions.php">
		Click Here To Enter An Intro Text
		</a>
	<?php } ?>  
</p>
<ul id="social">
	
<?php
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<li><a href="<?php echo $wpFolio_twitter ?>"><img src="<?php bloginfo('template_url'); ?>/img/bt_twitter.gif"/></a></li>
<li><a href="<?php echo $wpFolio_facebook ?>"><img src="<?php bloginfo('template_url'); ?>/img/bt_facebook.gif"/></a></li>
<li><a href="<?php bloginfo('url'); ?>/feed=rss2"><img src="<?php bloginfo('template_url'); ?>/img/bt_rss.gif"/></a></li>
</ul>
</div>

  <div id="slide-holder">
<div id="slide-runner">
<?php query_posts('category_name=Featured') ?>
   <?php $cnt = '1'; ?>
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>

    <a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><img id="slide-img-<?php echo $cnt; ?>" src="<?php $key="f_image"; echo get_post_meta($post->ID, $key, true); ?>" class="slide" alt="" /></a>
     <?php 
	$cnt++;
	endwhile; ?>
	<?php endif; ?>
	<?php wp_reset_query(); ?>
    <div id="slide-controls">
     <p id="slide-client" class="text"><strong>work: </strong><span></span></p>
     <p id="slide-desc" class="text"></p>
     <p id="slide-nav"></p>
    </div>
</div>
	
	<!--content featured gallery here -->
	
   </div>
   <!--Loop for javascript -->
   <?php query_posts('category_name=Featured') ?>
   <?php $cnt = '1'; ?>
   <?php $jsstring = ''; ?>
   
	<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); 
	
	$my_id = get_the_ID();
	$post_id_7 = get_post($my_id); 
	$title = $post_id_7->post_title;
	
	$jsstring .= "{'id':'slide-img-";
	$jsstring .= $cnt;
	$jsstring .= "','client':'";
	$jsstring .= $title;
	$jsstring .= "','desc':''},";
	
    
	$cnt++;
	endwhile; 
	
	$str=$jsstring;
	$len=strlen($str);
	$sendtojavascript=substr($str,0,($len-1));

	?>
	<?php endif; ?>
   
   <script type="text/javascript">
	if(!window.slider) var slider={};slider.data=[<?php echo $sendtojavascript; ?>];
   </script>
   <?php wp_reset_query(); ?>
   
   
</div>

<div id="main">


