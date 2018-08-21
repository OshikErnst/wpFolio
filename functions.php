<?php

// Display Twitter messages
function twitter_messages($username = '', $num = 1, $list = false, $update = true, $linked  = '#', $hyperlinks = true, $twitter_users = true, $encode_utf8 = false) {

	global $twitter_options;
	include_once(ABSPATH . WPINC . '/rss.php');

	$username = get_option('wpFolio_twitterun');


	$messages = fetch_rss('http://twitter.com/statuses/user_timeline/'.$username.'.rss');

	if ($list) echo '<ul class="twitter">';

	if ($username == '') {
		if ($list) echo '<li>';
		echo 'RSS not configured';
		if ($list) echo '</li>';
	} else {
			if ( empty($messages->items) ) {
				if ($list) echo '<li>';
				echo 'No public Twitter messages.';
				if ($list) echo '</li>';
			} else {
        $i = 0;
				foreach ( $messages->items as $message ) {
					$msg = " ".substr(strstr($message['description'],': '), 2, strlen($message['description']))." ";
					if($encode_utf8) $msg = utf8_encode($msg);
					$link = $message['link'];

					if ($list) echo '<li class="twitter-item">'; elseif ($num != 1) echo '<p class="twitter-message">';

          if ($hyperlinks) { $msg = hyperlinks($msg); }
          if ($twitter_users)  { $msg = twitter_users($msg); }

					if ($linked != '' || $linked != false) {
            if($linked == 'all')  {
              $msg = '<a href="'.$link.'" class="twitter-link">'.$msg.'</a>';  // Puts a link to the status of each tweet
            } else {
              $msg = $msg . '<a href="'.$link.'" class="twitter-link">'.$linked.'</a>'; // Puts a link to the status of each tweet

            }
          }

          echo $msg;


        if($update) {
          $time = strtotime($message['pubdate']);

          if ( ( abs( time() - $time) ) < 86400 )
            $h_time = sprintf( __('%s ago'), human_time_diff( $time ) );
          else
            $h_time = date(__('Y/m/d'), $time);

          echo sprintf( __('%s', 'twitter-for-wordpress'),' <span class="twitter-timestamp"><span title="' . date(__('Y/m/d H:i:s'), $time) . '">' . $h_time . '</span></span>' );
         }

					if ($list) echo '</li>'; elseif ($num != 1) echo '</p>';

					$i++;
					if ( $i >= $num ) break;
				}
			}
		}
		if ($list) echo '</ul>';
	}

// Link discover stuff

function hyperlinks($text) {
    // Props to Allen Shaw & webmancers.com
    // match protocol://address/path/file.extension?some=variable&another=asf%
    //$text = preg_replace("/\b([a-zA-Z]+:\/\/[a-z][a-z0-9\_\.\-]*[a-z]{2,6}[a-zA-Z0-9\/\*\-\?\&\%]*)\b/i","<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
    $text = preg_replace('/\b([a-zA-Z]+:\/\/[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"$1\" class=\"twitter-link\">$1</a>", $text);
    // match www.something.domain/path/file.extension?some=variable&another=asf%
    //$text = preg_replace("/\b(www\.[a-z][a-z0-9\_\.\-]*[a-z]{2,6}[a-zA-Z0-9\/\*\-\?\&\%]*)\b/i","<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);
    $text = preg_replace('/\b(?<!:\/\/)(www\.[\w_.\-]+\.[a-zA-Z]{2,6}[\/\w\-~.?=&%#+$*!]*)\b/i',"<a href=\"http://$1\" class=\"twitter-link\">$1</a>", $text);

    // match name@address
    $text = preg_replace("/\b([a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]*\@[a-zA-Z][a-zA-Z0-9\_\.\-]*[a-zA-Z]{2,6})\b/i","<a href=\"mailto://$1\" class=\"twitter-link\">$1</a>", $text);
        //mach #trendingtopics. Props to Michael Voigt
    $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)#{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/#search?q=$2\" class=\"twitter-link\">#$2</a>$3 ", $text);
    return $text;
}

function twitter_users($text) {
       $text = preg_replace('/([\.|\,|\:|\¡|\¿|\>|\{|\(]?)@{1}(\w*)([\.|\,|\:|\!|\?|\>|\}|\)]?)\s/i', "$1<a href=\"http://twitter.com/$2\" class=\"twitter-user\">@$2</a>$3 ", $text);
       return $text;
}



$themename = "wpFolio";
$shortname = "wpFolio";

$color_options = array("Select a color:","purple","blue","green","red","black");

$options = array (

	array(	"name" => "Your wpFolio Style",
			"type" => "title"),
			
	array(	"type" => "open"),

	array(	"name" => "Theme Stylesheet",
						"desc" => "Please select your colour scheme here.",
					    "id" => $shortname."_alt_color",
					    "std" => "Select color:",
					    "type" => "select",
					    "options" => $color_options),			
			
	
	array(	"type" => "close"),
	
	
	array(	"name" => "Your Intro Text",
			"type" => "title"),
			
	array(	"type" => "open"),
	
	array(	"name" => "Intro Text",
			"desc" => "Enter your Intro Text.",
			"id" => $shortname."_introText",
			"std" => "",
			"type" => "textarea"),
			


	array(	"type" => "close"),

	array(	"name" => "Your Facebook and Twitter Links",
			"type" => "title"),
			
	array(	"type" => "open"),
	
	array(	"name" => "Facebook",
			"desc" => "Enter your facebook URL.",
			"id" => $shortname."_facebook",
			"std" => "",
			"type" => "text"),
			
	array(	"name" => "Twitter",
			"desc" => "Enter your Twitter URL.",
			"id" => $shortname."_twitter",
			"std" => "",
			"type" => "text"),
	
	array(	"type" => "close"),
	
	
	array(	"name" => "Your Homepage Info",
			"type" => "title"),
			
	array(	"type" => "open"),
	
	array(	"name" => "More About Me",
			"desc" => "Enter your More About Me Text.",
			"id" => $shortname."_moreaboutme",
			"std" => "",
			"type" => "textarea"),
			
	array(	"name" => "Address",
			"desc" => "Enter your Address.",
			"id" => $shortname."_address",
			"std" => "",
			"type" => "text"),
			
			
	array(	"name" => "Country",
			"desc" => "Enter your Country.",
			"id" => $shortname."_country",
			"std" => "",
			"type" => "text"),	
			
	array(	"name" => "Phone",
			"desc" => "Enter your Phone.",
			"id" => $shortname."_phone",
			"std" => "",
			"type" => "text"),
			
	array(	"name" => "Email",
			"desc" => "Enter your Email. (do not worry, it will turn into an image)",
			"id" => $shortname."_email",
			"std" => "",
			"type" => "text"),
			
	array(	"name" => "Twitter User Name",
			"desc" => "Your Twitter UserName. (for the twitter feed)",
			"id" => $shortname."_twitterun",
			"std" => "",
			"type" => "text"),			
			
			
							
	
	array(	"type" => "close")
	
	
	
	
	
);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> settings</h2>

<form method="post">



<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table width="100%" border="0" style="background-color:#eef5fb; padding:10px;">
		
        
        
		<?php break;
		
		case "close":
		?>
		
        </table><br />
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="background-color:#dceefc; padding:5px 10px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;

		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;border-bottom:1px dotted #000000;">&nbsp;</td></tr><tr><td colspan="2">&nbsp;</td></tr>
            
        <?php 		break;
	
 
} 
}
?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<?php
}

add_action('admin_menu', 'mytheme_add_admin'); ?>
<?php

if ( function_exists('register_sidebar') )
	register_sidebar(array(
		'name' => 'Right Sidebar',
		'before_widget' => '<li id="%1$s" class="widget %2$s">',
		'after_widget' => '</li>',
		'before_title' => '<h2><span>',
		'after_title' => '</span></h2>',
	));
	



?>
