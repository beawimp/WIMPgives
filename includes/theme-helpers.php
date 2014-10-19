<?php

/**
 * Fetches the appropriate title
 */
function wimpgives_get_title() {
	global $post, $shortname;

	$get_title = unserialize( get_post_meta( $post->ID, '_' . $shortname . '-meta-boxes', true ) );
	$paged     = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
	$s         = ( get_query_var( 's' ) ) ? get_query_var( 's' ) : '';
	$title     = $get_title[0];

	//check if a title is not set, then set a value
	if ( empty( $title ) ) {
		if ( is_home() || is_front_page() ) {
			$title = bloginfo( 'name' );
		} else {
			$title = wp_title( '' );
		}
	}

	if ( function_exists( 'is_tag' ) && is_tag() ) {
		single_tag_title( 'Tag Archive for &quot;' );
		echo '&quot; - ';
	} elseif ( is_archive() ) {
		wp_title( '' );
		echo ' Archive - ';
	} elseif ( is_search() ) {
		echo 'Search for &quot;' . sanitize_text_field( $s ) . '&quot; - ';
	} elseif ( ! ( is_404() ) && ( is_single() ) || ( is_page() ) ) {
		echo esc_html( $title );
	} elseif ( is_404() ) {
		echo 'Not Found - ';
	}

	if ( is_home() ) {
		echo esc_html( $title );
	}

	if ( $paged > 1 ) {
		echo ' - page ' . intval( $paged );
	}
}


/**
 * Return meta keywords if set
 */
function wimpgives_get_meta_keywords() {
	global $post, $shortname;

	$get_description = unserialize( get_post_meta( $post->ID, '_' . $shortname . '-meta-boxes', true ) );

	echo sanitize_text_field( $get_description[1] );
}

/*****
 * Description: Return the ID of home or interior
 * Since: 0.1
 * Author: Cole Geissinger
 * /*****/
function wimpgives_page_id() {
	if ( is_front_page() ) {
		$page_id = 'home';
	} else {
		$page_id = 'interior';
	}

	echo esc_html( $page_id );
}

/**
 * Appends a class called 'is-mobile' if a visitor is looking at the site on a mobile phone.
 *
 * @uses   jetpack_is_mobile()
 * @filter body_class
 *
 * @param array $classes An array of body classes
 *
 * @return array
 */
function wimpgives_body_classes( $classes ) {
	if ( function_exists( 'jetpack_is_mobile' ) ) {
		if ( jetpack_is_mobile() ) {
			$classes[] = 'is-mobile';
		}
	}

	return $classes;
}
add_filter( 'body_class', 'wimpgives_body_classes' );

/**
 * Retrieve the font option selected and set it in the wp_head.
 *
 * @global $shortname , $fw_general_settings
 * @uses wp_enqueue_style()
 * @return void
 */
function get_frameworker_typography_styles() {
	global $shortname, $fw_general_settings;

	$font = $fw_general_settings[ $shortname . '-font1' ];

	if ( ! empty( $font ) && $font != '-- Select A Font --' ) {
		wp_enqueue_style( 'fw-font', ( 'http://fonts.googleapis.com/css?family=' . $font ) );
	}
}
add_action( 'wp_print_styles', 'get_frameworker_typography_styles' );


/*****
 * Description: Format the layout of our comments list
 * Since: 0.1
 * Author: Cole Geissinger
 * /*****/
function wimpgives_list_comments( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	?>

	<li id="li-comment-<?php comment_ID(); ?>" <?php comment_class( 'group' ); ?>>
		<div class="gravatar alignleft">
			<?php echo get_avatar( $comment->comment_author_email, '50' ); ?>
		</div>
		<div class="comment alignright">
			<div class="comment-meta">
				<strong><?php echo esc_url( get_comment_author() ); ?></strong> - <?php printf( __( '%1$s' ), get_comment_date(), get_comment_time() ); ?>
			</div>

			<?php if ( $comment->comment_approved == '0' ) : ?>
				<em><?php esc_html_e( 'your comment is awaiting moderation.', 'wg2014' ); ?></em><br />
			<?php endif; ?>

			<?php comment_text(); ?>

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array(
							'reply_text' => 'Reply',
							'add_below'  => $add_below,
							'depth'      => $depth,
							'max_depth'  => $args['max_depth']
						) ) ); ?>
			</div>
		</div>
	</li>
<?php
}


/**
 * Filter the title to a set number of characters when using the previous and next_post_link function
 *
 * @param string $linkstring The link
 *
 * @return mixed
 */
function wimpgives_shorten_linktext( $linkstring ) {
	$characters = 35;

	preg_match( '/<a.*?>(.*?)<\/a>/is', $linkstring, $matches );
	$display_title = $matches[1];
	$new_title     = shorten_with_ellipsis( $display_title, $characters );

	return str_replace( '>' . $display_title . '<', '>' . esc_html( $new_title ) . '<', $linkstring );
}

/**
 * Reduces the length of a string and appends an ellipsis
 *
 * @param $inputstring
 * @param $characters
 *
 * @return string
 */
function shorten_with_ellipsis( $inputstring, $characters ) {
	return ( strlen( $inputstring ) >= $characters ) ? substr( $inputstring, 0, ( $characters - 3 ) ) . '...' : $inputstring;
}
add_filter( 'previous_post_link', 'wimpgives_shorten_linktext' );
add_filter( 'next_post_link', 'wimpgives_shorten_linktext' );


/*****
 * Description: Set our Shortcodes below
 * Since: 0.1
 * Author: Cole Geissinger
 * /*****/
function wimpcamp_two_column( $atts, $content = null ) {
	return '<div class="two-column">' . do_shortcode( $content ) . '</div>';
}

add_shortcode( 'two-column', 'wimpcamp_two_column' );

function wimpcamp_clear() {
	return '<div class="clear"></div>';
}

add_shortcode( 'clear', 'wimpcamp_clear' );

function wimpcamp_eventbrite_widget() {
	return '<div style="width:100%; text-align:left;" ><iframe  src="https://www.eventbrite.com/tickets-external?eid=4321012264&ref=etckt" frameborder="0" height="306" width="100%" vspace="0" hspace="0" marginheight="5" marginwidth="5" scrolling="auto" allowtransparency="true"></iframe><div style="font-family:Helvetica, Arial; font-size:10px; padding:5px 0 5px; margin:2px; width:100%; text-align:left;" ><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com/r/etckt">Event management</a><span style="color:#ddd;"> for </span><a style="color:#ddd; text-decoration:none;" target="_blank" href="http://http://wimpcamp2012.eventbrite.com?ref=etckt">WIMPcamp 2012</a> <span style="color:#ddd;">powered by</span> <a style="color:#ddd; text-decoration:none;" target="_blank" href="http://www.eventbrite.com?ref=etckt">Eventbrite</a></div></div>';
}

add_shortcode( 'eventbrite-widget', 'wimpcamp_eventbrite_widget' );

function wimpcamp_facebook_widget() {
	return '<iframe src="//www.facebook.com/plugins/likebox.php?href=https%3A%2F%2Fwww.facebook.com%2FWebInteractiveMediaProfessionals&amp;width=328&amp;height=558&amp;colorscheme=light&amp;show_faces=true&amp;border_color&amp;stream=true&amp;header=false&amp;appId=126246364174319" scrolling="no" frameborder="0" style="border:none; overflow:hidden; width:328px; height:558px;" allowTransparency="true"></iframe>';
}

add_shortcode( 'facebook-likebox', 'wimpcamp_facebook_widget' );


/*****
 * Description: Stop the wpautop wptexturize filters from parsing our shortcodes and then reactivate them after
 * Since: 0.1
 * Author: Cole Geissinger
 * /*****/
function wimpcamp_formatter( $content ) {
	$new_content = '';

	//matches the contents and the open and closing tags
	$pattern_full = '{(\[raw\].*?\[/raw\])}is';

	//matches just the contents
	$pattern_contents = '{\[raw\](.*?)\[/raw\]}is';

	//divide content into pieces
	$pieces = preg_split( $pattern_full, $content, - 1, PREG_SPLIT_DELIM_CAPTURE );

	foreach ( $pieces as $piece ) {
		//look for presence of the shortcode
		if ( preg_match( $pattern_contents, $piece, $matches ) ) {

			//append to content (no formatting)
			$new_content .= $matches[1];

		} else {

			//format and append to content
			$new_content .= wptexturize( wpautop( $piece ) );
		}
	}

	return $new_content;
}

// Remove the 2 main auto-formatters
remove_filter( 'the_content', 'wpautop' );
remove_filter( 'the_content', 'wptexturize' );

// Before displaying for viewing, apply this function
add_filter( 'the_content', 'wimpcamp_formatter', 99 );
add_filter( 'widget_text', 'wimpcamp_formatter', 99 );


//fix the backtrack_limit bug - if too many shortcodes are used, the content disappears.
//long posts should require a higher limit, see http://core.trac.wordpress.org/ticket/8553
@ini_set( 'pcre.backtrack_limit', 500000 );