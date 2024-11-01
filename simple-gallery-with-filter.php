<?php
/*
	Plugin Name: Simple Gallery with Filter
	Plugin URI: https://come2theweb.com/plugins/sgwf/
	Description: Create simple gallery with filter option, very simple create isotop filter gallery it will use your post name as filter navingation, very simpl to use by shortcode and widgets
	Author: Come2theweb
	Version: 2.0
	Author URI: https://come2theweb.com
	Text Domain: come2theweb
 */


function sgef_load_plugin_css() {
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'sgef_style', $plugin_url . 'assets/css/style.css' );
	if(get_option('activelb')=='yes'){
 	wp_enqueue_style( 'sgef_swipebox', $plugin_url . 'assets/css/lightbox.css' );
	wp_enqueue_script( 'sgef_swipebox', $plugin_url . 'assets/js/lightbox.js', array(), false, true );
	}
	if(get_option('c2twsg_type')=='mesonry'){
	wp_enqueue_script('masonry');
	}
	wp_enqueue_script( 'sgef_main', $plugin_url . 'assets/js/sgwf.js', array(), false, true );
}
add_action( 'wp_enqueue_scripts', 'sgef_load_plugin_css' );

function sgef_load_adminplugin_scripts() {
    $plugin_url = plugin_dir_url( __FILE__ );
    wp_enqueue_style( 'sgef_style', $plugin_url . 'assets/css/sgef_admin.css' );
}
add_action( 'admin_enqueue_scripts', 'sgef_load_adminplugin_scripts' );

/* ==== Load script and style here ======= */


function sgwfMenu() {
	//create new top-level menu
	$page = add_menu_page('Simple Gallery with Filter', 'Simple Gallery with Filter', 'administrator', 'simple-gallery-with-filter', 'sgwfMenu_option' );
}

if ( is_admin() ){ // admin actions
	add_action('admin_menu', 'sgwfMenu');
	add_action( 'admin_init', 'register_sgwfsettings' );
} 


function sgwfMenu_option() {
?>
<div class="wrap about-wrap">
	<div id="wdc-style">
	<div class="row">
  <div class="col-md-12">
    <div class="boxed-content">
		<h2 class="about-title"><strong>Simple Gallery with Filter by Come2theweb</strong></h2>
	<p>
    Create simple gallery with filter option by using this plugin, very simple create isotop filter gallery it will use for <br />
    gallery, portfolio, team, services by category, simply use by shortcode and widgets<br />
    You will get shortcode to use this anywhere, as well as you will get widget too.<br /><br />
    This plugin is Free to use developed by <a href="https://come2theweb.com" target="_blank">Come2theweb</a>
    </p>

    <h3>Shortcode for gallery with filter</h3>
	<p>Shortcode - <em class="shortcode_highlight">[c2tw_sgwf]</em></p>
	<p>Shortcode with specified width - <em class="shortcode_highlight">[c2tw_sgwf width='_WIDTH_IN_PX_']</em></p>
	<p>Shortcode with 2 coloum - <em class="shortcode_highlight">[c2tw_sgwf cols='2']</em></p>

    <h3>Shortcode for gallery without filter</h3>
	<p>Shortcode - <em class="shortcode_highlight">[c2twsg id="_GALLERY_ID_"]</em></p>
	<p>Shortcode with specified width - <em class="shortcode_highlight">[c2twsg id="_GALLERY_ID_" width='_WIDTH_IN_PX_']</em></p>
	<p>Shortcode with 2 coloum - <em class="shortcode_highlight">[c2twsg id="_GALLERY_ID_" cols='2']</em></p>
	<p>Shortcode with masonry - <em class="shortcode_highlight">[c2twsg id="_GALLERY_ID_" cols='2' style="masonry"]</em><br />
    Note: Individual gallery masonry style will only work if you enable Gallery Style "masonry" from below global option tab</p>
    
    <hr />
    <h3 align="left">Global Options</h3>
    <form method="post" action="options.php">
		<?php settings_fields( 'sgwf-group' ); ?>
        <?php do_settings_sections( 'sgwf-group' ); ?>
    <div class="sgtb_formrow highlighted" style="text-align:left;">
        <label>Enable Lightbox popup ?</label>
        <label class="radiolabel">
        	<input type="radio" checked="checked" name="activelb" <?php if(get_option('activelb')=='no'){ echo 'checked="checked"'; } ?> value="no" /> No
        </label>
        <label class="radiolabel">
        	<input type="radio" name="activelb" <?php if(get_option('activelb')=='yes'){ echo 'checked="checked"'; } ?> value="yes" /> Yes
        </label>
    </div>
    
    <div class="sgtb_formrow highlighted" style="text-align:left;">
        <label>Gallery Style?</label>
        <label class="radiolabel">
        	<input type="radio" checked="checked" name="c2twsg_type" <?php if(get_option('c2twsg_type')=='simple'){ echo 'checked="checked"'; } ?> value="simple" /> Simple
        </label>
        <label class="radiolabel">
        	<input type="radio" name="c2twsg_type" <?php if(get_option('c2twsg_type')=='mesonry'){ echo 'checked="checked"'; } ?> value="mesonry" /> Masonry
        </label>
    </div>
    
    <?php submit_button(); ?>
    
    </form>
    
<br /><br />
<hr />
<p>If my plugin has been helpful to you and you're happy with it, If you want to donate for this plugin</p>

<form action="https://www.paypal.com/cgi-bin/webscr" method="post" target="_top" style="display:inline-block;">
<input type="hidden" name="cmd" value="_xclick">
<input type="hidden" name="business" value="tomjark74@gmail.com">
<input type="hidden" name="lc" value="US">
<input type="hidden" name="item_name" value="Simple Gallery with Filter Plugin Support">
$<input type="number" name="amount" min="1" value="5" style="width: 55px;">
<input type="hidden" name="currency_code" value="USD">
<input type="hidden" name="button_subtype" value="services">
<input type="hidden" name="no_note" value="0">
<input type="hidden" name="bn" value="PP-BuyNowBF:btn_buynowCC_LG.gif:NonHostedGuest">
<input type="submit" style="cursor:pointer;" value="DONATE NOW" border="0" name="submit" alt="PayPal - The safer, easier way to pay online!">
<img alt="" border="0" src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" width="1" height="1">
</form>


	</div>
</div>

</div>
</div>
</div>
<?php
}

function register_sgwfsettings() { // whitelist options
  register_setting( 'sgwf-group', 'activelb' );
  register_setting( 'sgwf-group', 'c2twsg_type' );
}

/* ==== Gallery Post Type ==== */
function sgwf_gallery_post_type() {
register_post_type( 'sgwf_gallery',
	array(
		'labels' => array(
			'name' => 'Gallery',
			'singular_name' => 'Gallery',
			'add_new' => 'Add New',
			'add_new_item' => 'Add New Gallery',
			'edit_item' => 'Edit Gallery',
			'new_item' => 'New Gallery',
			'view_item' => 'View Gallery',
			'search_items' => 'Search Gallery',
			'not_found' =>  'Nothing Found',
			'not_found_in_trash' => 'Nothing found in the Trash',
			'parent_item_colon' => ''
		),
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'query_var' => true,
		//'menu_icon' => get_stylesheet_directory_uri() . '/images/patner_icon.png',
		'rewrite' => true,
		'capability_type' => 'post',
		'hierarchical' => false,
		'menu_position' => null,
		'supports' => array('title', 'thumbnail')
	)
);

}
add_action( 'init', 'sgwf_gallery_post_type' );



// Add Meta Box to post
add_action( 'add_meta_boxes', 'multi_media_uploader_meta_box' );
function multi_media_uploader_meta_box() {
	add_meta_box( 'sgwf_custom_field', 'Gallery Pictures', 'sgwf_box_callback', 'sgwf_gallery', 'normal', 'high' );
	add_meta_box( 'sgwf_shortcode_field', 'Individual Shortcode', 'sgwf_shortcode_callback', 'sgwf_gallery', 'side', 'high' );
}

function sgwf_box_callback($post) {
	$banner_img = get_post_meta($post->ID,'sgwf_galpic',true);
	?>
	<style type="text/css">
		.sgwf_uploaded_pics ul li .delete-img { position: absolute; right: 3px; top: 2px; background: aliceblue; border-radius: 50%; cursor: pointer; font-size: 14px; line-height: 20px; color: red; }
		.sgwf_uploaded_pics ul li { width: 20%; display: inline-block; vertical-align: middle; padding: 5px; position: relative; box-sizing: border-box;}
		.sgwf_uploaded_pics ul li img { width: 100%; height: 150px;object-fit: cover;display: block;}
	
.sgwf_uploaded_pics ul li input {
  width: 100%;
  margin: 0;
  border-radius: 0;
}
.sgwf_uploaded_pics ul li a {
  display: block;
}
	</style>

	<div class="sgwf_gallerymeta">
    	<label>Select Gallery Pictures</label>
        <div class="sgwf_gallerypics"><?php echo sgwf_media_ufield( 'sgwf_galpic', $banner_img ); ?></div>
	</div>

	<script type="text/javascript">
		jQuery(function($) {

			$('.sgwf_uploaded_pics ul').sortable({
				update: function(event, ui) {
					// When the order changes, update the hidden input field with the new order
					updateGalleryOrder();
				}
			});
		
			function updateGalleryOrder() {
				var ids = [];
				$('.sgwf_uploaded_pics ul li').each(function() {
					ids.push($(this).attr('data-attechment-id'));
				});
				$('.sgwf_uploaded_pics').find('input[type="hidden"]').val(ids.join(','));
			}
		

			$('body').on('click', '.sgwf_upload_picbtn', function(e) {
				e.preventDefault();

				var button = $(this),
				custom_uploader = wp.media({
					title: 'Insert image',
					button: { text: 'Use this image' },
					multiple: true 
				}).on('select', function() {
					var attech_ids = '';
					attachments
					var attachments = custom_uploader.state().get('selection'),
					attachment_ids = new Array(),
					i = 0;
					attachments.each(function(attachment) {
						attachment_ids[i] = attachment['id'];
						attech_ids += ',' + attachment['id'];
						if (attachment.attributes.type == 'image') {
							$(button).siblings('ul').append('<li data-attechment-id="' + attachment['id'] + '"><a href="javascript:" target="_blank"><img class="true_pre_image" src="' + attachment.attributes.url + '" /></a><i class=" dashicons dashicons-no delete-img"></i></li>');
						} else {
							$(button).siblings('ul').append('<li data-attechment-id="' + attachment['id'] + '"><a href="javascript:" target="_blank"><img class="true_pre_image" src="' + attachment.attributes.icon + '" /></a><i class=" dashicons dashicons-no delete-img"></i></li>');
						}

						i++;
					});

					var ids = $(button).siblings('.attechments-ids').attr('value');
					if (ids) {
						var ids = ids + attech_ids;
						$(button).siblings('.attechments-ids').attr('value', ids);
					} else {
						$(button).siblings('.attechments-ids').attr('value', attachment_ids);
					}
					$(button).siblings('.sgwf_remove_picsbtn').show();
				})
				.open();
			});

			$('body').on('click', '.sgwf_remove_picsbtn', function() {
				var s = confirm('Are you sure you want to remove all images?');
				if(s){
				$(this).hide().prev().val('').prev().addClass('button').html('Add Media');
				$(this).parent().find('ul').empty();
				}
				return false;
			});

		});

		jQuery(document).ready(function() {
			jQuery(document).on('click', '.sgwf_uploaded_pics ul li i.delete-img', function() {
			var s = confirm('Are you sure you want to remove this images?');
				if(s){
				var ids = [];
				var this_c = jQuery(this);
				jQuery(this).parent().remove();
				jQuery('.sgwf_uploaded_pics ul li').each(function() {
					ids.push(jQuery(this).attr('data-attechment-id'));
				});
				jQuery('.sgwf_uploaded_pics').find('input[type="hidden"]').attr('value', ids);
				}
			});
		})
	</script>

	<?php
}

function sgwf_shortcode_callback($post) {
	?>
	<div class="sgwf_indishortcode">
    <span style="display: block;background: #ececec;font-size: 15px;padding: 5px;font-weight: bold;border: 1px #ccc solid;">[c2twsg id="<?php echo $post->ID; ?>"]</span>
	</div>

	<?php
}


function sgwf_media_ufield($name, $value = '') {
	$image = '">Add Media';
	$image_str = '';
	$image_size = 'full';
	$display = 'none';
	$value = explode(',', $value);
	
	

	if (!empty($value)) {
	
	foreach ($value as $values) {
    if ($image_attributes = wp_get_attachment_image_src($values, $image_size)) {
        $image_str .= '<li data-attechment-id=' . $values . '><a href="' . $image_attributes[0] . '" target="_blank"><img src="' . $image_attributes[0] . '" /></a>';
        $image_str .= '<input type="text" class="image-caption" name="image_captions[]" value="' . esc_attr(get_post_meta($values, 'image_caption', true)) . '" placeholder="Add Caption">';
        $image_str .= '<i class="dashicons dashicons-no delete-img"></i></li>';
    }
}

	}

	if($image_str){
		$display = 'inline-block';
	}

	return '<div class="sgwf_uploaded_pics"><ul>' . $image_str . '</ul><a href="#" class="sgwf_upload_picbtn button' . $image . '</a><input type="hidden" class="attechments-ids ' . $name . '" name="' . $name . '" id="' . $name . '" value="' . esc_attr(implode(',', $value)) . '" /><a href="#" class="sgwf_remove_picsbtn button" style="display:' . $display . '">Remove All</a></div>';
}

// Save Meta Box values.
add_action( 'save_post', 'sgwf_meta_box_save' );

function sgwf_meta_box_save( $post_id ) {
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }

    if ( ! current_user_can( 'edit_post', $post_id ) ) {
        return;
    }

    if ( isset( $_POST['sgwf_galpic'] ) ) {
        $gallery_images = explode(',', sanitize_text_field( $_POST['sgwf_galpic'] ));
        $captions = isset( $_POST['image_captions'] ) ? $_POST['image_captions'] : array();

        foreach ($gallery_images as $index => $attachment_id) {
            update_post_meta( $attachment_id, 'image_caption', sanitize_text_field( $captions[$index] ) );
        }

        update_post_meta( $post_id, 'sgwf_galpic', implode(',', $gallery_images) );
    }
}
/* === linkad Add Custom Field Post === */




// Gallery Shortcode Generated
function sfwf_generate_shortcode($atts = [], $tag = ''){
	$atts = array_change_key_case((array)$atts, CASE_LOWER);
	$ids = shortcode_atts([ 'width' => '', ], $atts, $tag);
	$cls = shortcode_atts([ 'col' => '', ], $atts, $tag);
	
	$width=$ids['width'];
	$col=$cls['col'];
	
	if($col=='1'){ $cols = "itemwith_col1"; }
	if($col=='2'){ $cols = "itemwith_col2"; }
	if($col=='3'){ $cols = "itemwith_col3"; }
	if($col=='4'){ $cols = "itemwith_col4"; }
	if($col=='5'){ $cols = "itemwith_col5"; }
	if($col=='6'){ $cols = "itemwith_col6"; }
	if($col=='7'){ $cols = "itemwith_col7"; }
	if($col=='8'){ $cols = "itemwith_col8"; }
	if($col=='9'){ $cols = "itemwith_col9"; }
	if($col=='10'){ $cols = "itemwith_col10"; }

	ob_start();
?>

<div class="sgwf_come2theweb " <?php if($width){ ?> style="width:<?php echo $width; ?>" <?php } ?> >

    <div class="sgwf_filter">
    <ul>
        <li><a data="all" href="javascript:" >All</a></li>
    <?php 
	
		$args = array('post_type' => 'sgwf_gallery', 'posts_per_page' => -1);
    $loop = new WP_Query($args);
    while ($loop->have_posts()) : $loop->the_post();
	global $post;
    ?>
        <li><a data="<?php echo $post->post_name;; ?>" href="javascript:" ><?php echo the_title(); ?></a></li>
    <?php endwhile; ?>
    </ul>
    </div>
    
    <?php if(get_option('c2twsg_type')=='mesonry'){
		$mesonry_grid = 'c2twsg_mesonry_grid';
		$mesonry_item = 'c2twsg_mesonry_item';
	}
	?>
    <div class="sgwf_come2thewe_cnt <?php echo $cols.' '.$mesonry_grid; ?>">
    <?php if(get_option('c2twsg_type')=='mesonry'){?>
    <div class="<?php echo $mesonry_item; ?> sgwf_spacer"></div>
    <?php } ?>
    
    <div class="loading"></div>
    	
<?php
	
    $args = array('post_type' => 'sgwf_gallery', 'posts_per_page' => -1);
    $loop = new WP_Query($args);
    while ($loop->have_posts()) : $loop->the_post();
    global $post;
	
    $id = get_the_ID();
	$banner_img = get_post_meta($id,'sgwf_galpic',true);
	$banner_img = explode(',', $banner_img);
	if(!empty($banner_img)) {
	 foreach ($banner_img as $attachment_id) {
	$image = get_post($attachment_id);
	 
	$image_caption = get_post_meta($attachment_id, 'image_caption', true);
	if($image_caption) { 
	$image_title = $image_caption;
	} else{
	$image_title = $image->post_title;
	}
    ?>
    <div class="sgwf_c2tw_item all <?php echo $post->post_name; ?> <?php echo $mesonry_item; ?>">
    <div class="sgwf_c2tw_iteminr">
    <a href="<?php echo wp_get_attachment_url( $attachment_id );?>" title="<?php echo $image_title; ?>" class="sgwf_lb">
        <img src="<?php echo wp_get_attachment_url( $attachment_id );?>" alt="<?php echo $image_title; ?>" />
        <h3><?php echo $image_title; ?></h3>
    </a>
    </div>
    </div>
    <?php
	 }; // End foreach
	};
	 endwhile; ?>
    
    <div class="sgwf_clear"></div>
    </div>
    
    </div>



<?php 
$htmret = ob_get_contents();
ob_clean();
return $htmret;}
add_shortcode('c2tw_sgwf', 'sfwf_generate_shortcode');

// Gallery Individual Shortcode Generated
function sfwf_individual_generate_shortcode($atts = [], $tag = ''){
	$atts = array_change_key_case((array)$atts, CASE_LOWER);
	$ids = shortcode_atts([ 'width' => '', ], $atts, $tag);
	$cls = shortcode_atts([ 'col' => '', ], $atts, $tag);
	$id = shortcode_atts([ 'id' => '', ], $atts, $tag);
	$style = shortcode_atts([ 'style' => '', ], $atts, $tag);
	
	$width=$ids['width'];
	$col=$cls['col'];
	$postid=$id['id'];
	$style=$style['style'];
	
	if($col=='1'){ $cols = "itemwith_col1"; }
	if($col=='2'){ $cols = "itemwith_col2"; }
	if($col=='3'){ $cols = "itemwith_col3"; }
	if($col=='4'){ $cols = "itemwith_col4"; }
	if($col=='5'){ $cols = "itemwith_col5"; }
	if($col=='6'){ $cols = "itemwith_col6"; }
	if($col=='7'){ $cols = "itemwith_col7"; }
	if($col=='8'){ $cols = "itemwith_col8"; }
	if($col=='9'){ $cols = "itemwith_col9"; }
	if($col=='10'){ $cols = "itemwith_col10"; }

	ob_start();
?>

<div class="sgwf_come2theweb " <?php if($width){ ?> style="width:<?php echo $width; ?>" <?php } ?> >
	
	<?php if(get_option('c2twsg_type')=='mesonry'){
	if($style=='mesonry'){
		$mesonry_grid = 'c2twsg_mesonry_grid';
		$mesonry_item = 'c2twsg_mesonry_item';
	}
	}
	?>
    <div class="sgwf_come2thewe_cnt <?php echo $cols.' '.$mesonry_grid; ?>">
    <?php if(get_option('c2twsg_type')=='mesonry'){ 
	if($style=='masonry'){?>
    <div class="<?php echo $mesonry_item; ?> sgwf_spacer"></div>
    <?php } 
	}?>

    <div class="loading"></div>
    	
<?php
	
    $args = array('post_type' => 'sgwf_gallery', 'p' => $postid);
    $loop = new WP_Query($args);
    while ($loop->have_posts()) : $loop->the_post();
    global $post;
	
    $id = get_the_ID();
	$banner_img = get_post_meta($id,'sgwf_galpic',true);
	$banner_img = explode(',', $banner_img);
	if(!empty($banner_img)) {
	 foreach ($banner_img as $attachment_id) {
	$image = get_post($attachment_id);
	 
	$image_caption = get_post_meta($attachment_id, 'image_caption', true);
	if($image_caption) { 
	$image_title = $image_caption;
	} else{
	$image_title = $image->post_title;
	}
    ?>
    <div class="sgwf_c2tw_item all <?php echo $post->post_name; ?> <?php echo $mesonry_item; ?>">
    <div class="sgwf_c2tw_iteminr">
    <a href="<?php echo wp_get_attachment_url( $attachment_id );?>" title="<?php echo $image_title; ?>" class="sgwf_lb">
        <img src="<?php echo wp_get_attachment_url( $attachment_id );?>" alt="<?php echo $image_title; ?>" />
        <h3><?php echo $image_title; ?></h3>
    </a>
    </div>
    </div>
    <?php
	 }; // End foreach
	};
	 endwhile; ?>
    
    <div class="sgwf_clear"></div>
    </div>
    
    </div>



<?php 
$htmret = ob_get_contents();
ob_clean();
return $htmret;}
add_shortcode('c2twsg', 'sfwf_individual_generate_shortcode');


/* ==== Gallery Widget ==== */
class sfwf_gallery_widget extends WP_Widget{

function __construct() {
	parent::__construct(
	'sfwf_gallerymain_widget', // Base ID
	'Simple Gallery with Filter Widget', // Name
	array('description' => __( 'Show gallery with filter anywhere, created by Come2theweb'))
	);
}
function widget($args, $instance) {
	echo $before_widget;
	$width = $instance['width'];
	$col = $instance['cols'];
	
	if($col=='1'){ $cols = "itemwith_col1"; }
	if($col=='2'){ $cols = "itemwith_col2"; }
	if($col=='3'){ $cols = "itemwith_col3"; }
	if($col=='4'){ $cols = "itemwith_col4"; }
	if($col=='5'){ $cols = "itemwith_col5"; }
	if($col=='6'){ $cols = "itemwith_col6"; }
	if($col=='7'){ $cols = "itemwith_col7"; }
	if($col=='8'){ $cols = "itemwith_col8"; }
	if($col=='9'){ $cols = "itemwith_col9"; }
	if($col=='10'){ $cols = "itemwith_col10"; }

?>

	<div class="sgwf_come2theweb " <?php if($width){ ?> style="width:<?php echo $width; ?>" <?php } ?> >

    <div class="sgwf_filter">
    <ul>
        <li><a data="all" href="javascript:" >All</a></li>
    <?php 
	
		$args = array('post_type' => 'sgwf_gallery', 'posts_per_page' => -1);
    $loop = new WP_Query($args);
    while ($loop->have_posts()) : $loop->the_post();
	global $post;
    ?>
        <li><a data="<?php echo $post->post_name;; ?>" href="javascript:" ><?php echo the_title(); ?></a></li>
    <?php endwhile; ?>
    </ul>
    </div>
    
    <?php if(get_option('c2twsg_type')=='mesonry'){
		$mesonry_grid = 'c2twsg_mesonry_grid';
		$mesonry_item = 'c2twsg_mesonry_item';
	}
	?>
    <div class="sgwf_come2thewe_cnt <?php echo $cols.' '.$mesonry_grid; ?>">
    <?php if(get_option('c2twsg_type')=='mesonry'){?>
    <div class="<?php echo $mesonry_item; ?> sgwf_spacer"></div>
    <?php } ?>
    
    <div class="loading"></div>
    	
<?php
	
    $args = array('post_type' => 'sgwf_gallery', 'posts_per_page' => -1);
    $loop = new WP_Query($args);
    while ($loop->have_posts()) : $loop->the_post();
    global $post;
	
    $id = get_the_ID();
	$banner_img = get_post_meta($id,'sgwf_galpic',true);
	$banner_img = explode(',', $banner_img);
	if(!empty($banner_img)) {
	 foreach ($banner_img as $attachment_id) {
	$image = get_post($attachment_id);
	 
	$image_caption = get_post_meta($attachment_id, 'image_caption', true);
	if($image_caption) { 
	$image_title = $image_caption;
	} else{
	$image_title = $image->post_title;
	}
    ?>
    <div class="sgwf_c2tw_item all <?php echo $post->post_name; ?> <?php echo $mesonry_item; ?>">
    <div class="sgwf_c2tw_iteminr">
    <a href="<?php echo wp_get_attachment_url( $attachment_id );?>" title="<?php echo $image_title; ?>" class="sgwf_lb">
        <img src="<?php echo wp_get_attachment_url( $attachment_id );?>" alt="<?php echo $image_title; ?>" />
        <h3><?php echo $image_title; ?></h3>
    </a>
    </div>
    </div>
    <?php
	 }; // End foreach
	};
	 endwhile; ?>
    
    <div class="sgwf_clear"></div>
    </div>
    
    </div>
    


<?php
        echo $after_widget;

    }

function update($new_instance, $old_instance) {
	$instance = $old_instance;
	$instance['width'] = $new_instance['width'];
	$instance['cols'] = $new_instance['cols'];
	return $instance;
}

function form($instance) {
?>


<p>
	<label for="<?php echo $this->get_field_id('width'); ?>">Width</label><br />
	<input type="text" name="<?php echo $this->get_field_name('width'); ?>" id="<?php echo $this->get_field_id('width'); ?>" class="widefat" value="<?php echo $instance['width']; ?>" />
    <em style="font-size:11px; color:#ccc;">Ex : 500px or 100%</em>
</p>


<p>
	<label for="<?php echo $this->get_field_id('cols'); ?>">Coloms</label><br />
	<input type="number" name="<?php echo $this->get_field_name('cols'); ?>" id="<?php echo $this->get_field_id('cols'); ?>" class="widefat" value="<?php echo $instance['cols']; ?>" />
    <em style="font-size:11px; color:#ccc;">Ex : 2 or 3 or 4...</em>
</p>


<br /><br />
<?php
}

}

function register_sgwfwidget(){
	register_widget('sfwf_gallery_widget'); 
}
add_action( 'widgets_init', 'register_sgwfwidget');



// Register activation hook
register_activation_hook(__FILE__, 'sgwf_plugin_activation');
function sgwf_plugin_activation() {
	$siteurl = get_site_url();
	$sdate = date('d M Y');
	$autmail ='jitendra.wd@gmail.com';
	$authsub='A user activated plugin - Simple Gallery with Filter';
	$autmsg='Dear Author, A user activate your plugin url is - '. $siteurl.' | Date - '.$sdate;
	wp_mail($autmail, $authsub, $autmsg);
}

?>