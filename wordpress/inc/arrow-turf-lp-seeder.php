<?php
/**
 * Arrow Turf landing page: one-time seeder.
 *
 * Creates the landing page, assigns the template and writes every ACF field
 * from inc/arrow-turf-lp-content.php so the client has editable content
 * rather than a page full of empty boxes.
 *
 * Runs once. The ATF_LP_SEED_VERSION option guards it, so loading admin again
 * does nothing. Delete this file once you have run it.
 *
 * Manual re-run:  /wp-admin/?atf_lp_seed=force   (administrators only)
 * WP-CLI:         wp atf-lp seed [--force]
 *
 * @package siteorigin-corp-child
 */

defined( 'ABSPATH' ) || exit;

defined( 'ATF_LP_SEED_VERSION' )  || define( 'ATF_LP_SEED_VERSION', '1.0.0' );
defined( 'ATF_LP_SEED_OPTION' )   || define( 'ATF_LP_SEED_OPTION', 'atf_lp_seeded' );
defined( 'ATF_LP_SEED_SLUG' )     || define( 'ATF_LP_SEED_SLUG', 'instant-turf-sydney' );
defined( 'ATF_LP_SEED_TITLE' )    || define( 'ATF_LP_SEED_TITLE', 'Instant Turf Sydney' );
defined( 'ATF_LP_SEED_TEMPLATE' ) || define( 'ATF_LP_SEED_TEMPLATE', 'page-arrow-turf-lp.php' );

/* Created as a draft so you can review it before it takes paid traffic.
   Change to 'publish' if you would rather it go straight up. */
defined( 'ATF_LP_SEED_STATUS' )   || define( 'ATF_LP_SEED_STATUS', 'draft' );

/* -------------------------------------------------------------------------
 * Triggers
 * ---------------------------------------------------------------------- */

add_action( 'admin_init', 'atf_lp_maybe_seed' );

/**
 * @return void
 */
function atf_lp_maybe_seed() {

	$force = ( isset( $_GET['atf_lp_seed'] ) && 'force' === sanitize_key( wp_unslash( $_GET['atf_lp_seed'] ) ) ); // phpcs:ignore WordPress.Security.NonceVerification.Recommended

	if ( $force && ! current_user_can( 'manage_options' ) ) {
		return;
	}
	if ( ! $force && ATF_LP_SEED_VERSION === get_option( ATF_LP_SEED_OPTION ) ) {
		return;
	}
	if ( ! function_exists( 'update_field' ) ) {
		add_action( 'admin_notices', function () {
			echo '<div class="notice notice-error"><p><strong>Arrow Turf landing page:</strong> Advanced Custom Fields is not active, so the seeder did nothing. Activate ACF and reload.</p></div>';
		} );
		return;
	}

	$result = atf_lp_seed( $force );

	add_action( 'admin_notices', function () use ( $result ) {
		if ( is_wp_error( $result ) ) {
			printf(
				'<div class="notice notice-error"><p><strong>Arrow Turf landing page:</strong> %s</p></div>',
				esc_html( $result->get_error_message() )
			);
			return;
		}
		printf(
			'<div class="notice notice-success is-dismissible"><p><strong>Arrow Turf landing page seeded.</strong> %1$s content fields and %2$s repeater rows written. <a href="%3$s">Edit the page</a> &middot; <a href="%4$s" target="_blank" rel="noopener">Preview</a><br><em>You can delete inc/arrow-turf-lp-seeder.php and its require line now.</em></p></div>',
			esc_html( $result['fields'] ),
			esc_html( $result['rows'] ),
			esc_url( get_edit_post_link( $result['post_id'] ) ),
			esc_url( get_permalink( $result['post_id'] ) )
		);
	} );
}

if ( defined( 'WP_CLI' ) && WP_CLI ) {
	WP_CLI::add_command( 'atf-lp seed', function ( $args, $assoc ) {
		$result = atf_lp_seed( isset( $assoc['force'] ) );
		if ( is_wp_error( $result ) ) {
			WP_CLI::error( $result->get_error_message() );
		}
		WP_CLI::success( sprintf(
			'Seeded page %d: %d fields, %d repeater rows.',
			$result['post_id'],
			$result['fields'],
			$result['rows']
		) );
	} );
}

/* -------------------------------------------------------------------------
 * The seeder
 * ---------------------------------------------------------------------- */

/**
 * @param bool $force Overwrite fields that already hold a value.
 * @return array{post_id:int,fields:int,rows:int}|WP_Error
 */
function atf_lp_seed( $force = false ) {

	require_once get_stylesheet_directory() . '/inc/arrow-turf-lp-content.php';
	$d = atf_lp_default_content();

	/* ---- 1. The page ---- */

	$page = get_page_by_path( ATF_LP_SEED_SLUG, OBJECT, 'page' );

	if ( $page ) {
		$post_id = $page->ID;
	} else {
		$post_id = wp_insert_post( array(
			'post_title'   => ATF_LP_SEED_TITLE,
			'post_name'    => ATF_LP_SEED_SLUG,
			'post_type'    => 'page',
			'post_status'  => ATF_LP_SEED_STATUS,
			'post_content' => '',
		), true );

		if ( is_wp_error( $post_id ) ) {
			return $post_id;
		}
	}

	update_post_meta( $post_id, '_wp_page_template', ATF_LP_SEED_TEMPLATE );

	$fields = 0;
	$rows   = 0;

	/**
	 * Write a field unless it already holds a value.
	 */
	$set = function ( $key, $value ) use ( $post_id, $force, &$fields ) {
		if ( '' === $value || 0 === $value || array() === $value ) {
			return; /* nothing to seed; the template falls back on its own */
		}
		if ( ! $force ) {
			$existing = get_field( $key, $post_id );
			if ( ! empty( $existing ) ) {
				return;
			}
		}
		update_field( $key, $value, $post_id );
		$fields++;
	};

	/**
	 * Write a repeater and count its rows.
	 */
	$set_rows = function ( $key, $value ) use ( $post_id, $force, &$fields, &$rows ) {
		if ( empty( $value ) ) {
			return;
		}
		if ( ! $force ) {
			$existing = get_field( $key, $post_id );
			if ( ! empty( $existing ) ) {
				return;
			}
		}
		update_field( $key, $value, $post_id );
		$fields++;
		$rows += count( $value );
	};

	/* ---- 2. Plain fields ---- */

	$set( 'field_atf_phone', $d['phone'] );
	$set( 'field_atf_phone_display', $d['phone_display'] );
	$set( 'field_atf_email', $d['email'] );
	$set( 'field_atf_callbar_call_label', $d['callbar']['call_label'] );
	$set( 'field_atf_callbar_cta_label', $d['callbar']['cta_label'] );
	$set( 'field_atf_thanks_title', $d['thanks']['title'] );
	$set( 'field_atf_thanks_text', $d['thanks']['text'] );

	$set( 'field_atf_hero_image', atf_lp_seed_attachment( $d['hero']['image'] ) );
	$set( 'field_atf_hero_eyebrow', $d['hero']['eyebrow'] );
	$set( 'field_atf_hero_heading', $d['hero']['heading'] );
	$set( 'field_atf_hero_lede', $d['hero']['lede'] );
	$set( 'field_atf_hero_cta_label', $d['hero']['cta_label'] );
	$set( 'field_atf_hero_rating', $d['hero']['rating'] );
	$set( 'field_atf_hero_form_title', $d['hero']['form_title'] );
	$set( 'field_atf_hero_form_sub', $d['hero']['form_sub'] );
	$set( 'field_atf_hero_form_shortcode', $d['hero']['form_shortcode'] );
	$set( 'field_atf_hero_form_note', $d['hero']['form_note'] );

	$set( 'field_atf_varieties_eyebrow', $d['varieties']['eyebrow'] );
	$set( 'field_atf_varieties_heading', $d['varieties']['heading'] );
	$set( 'field_atf_varieties_intro', $d['varieties']['intro'] );

	$set( 'field_atf_services_eyebrow', $d['services']['eyebrow'] );
	$set( 'field_atf_services_heading', $d['services']['heading'] );
	$set( 'field_atf_services_intro', $d['services']['intro'] );
	$set( 'field_atf_services_cta_label', $d['services']['cta_label'] );

	$set( 'field_atf_why_eyebrow', $d['why']['eyebrow'] );
	$set( 'field_atf_why_heading', $d['why']['heading'] );
	$set( 'field_atf_why_intro', $d['why']['intro'] );
	$set( 'field_atf_why_image', atf_lp_seed_attachment( $d['why']['image'] ) );
	$set( 'field_atf_why_cta_label', $d['why']['cta_label'] );

	$set( 'field_atf_how_eyebrow', $d['how']['eyebrow'] );
	$set( 'field_atf_how_heading', $d['how']['heading'] );

	$set( 'field_atf_projects_eyebrow', $d['projects']['eyebrow'] );
	$set( 'field_atf_projects_heading', $d['projects']['heading'] );
	$set( 'field_atf_projects_intro', $d['projects']['intro'] );

	$set( 'field_atf_reviews_eyebrow', $d['reviews']['eyebrow'] );
	$set( 'field_atf_reviews_heading', $d['reviews']['heading'] );

	$set( 'field_atf_contact_eyebrow', $d['contact']['eyebrow'] );
	$set( 'field_atf_contact_heading', $d['contact']['heading'] );
	$set( 'field_atf_contact_intro', $d['contact']['intro'] );
	$set( 'field_atf_contact_form_title', $d['contact']['form_title'] );
	$set( 'field_atf_contact_form_sub', $d['contact']['form_sub'] );
	$set( 'field_atf_contact_form_shortcode', $d['contact']['form_shortcode'] );
	$set( 'field_atf_contact_form_note', $d['contact']['form_note'] );
	$set( 'field_atf_contact_map_src', $d['contact']['map_src'] );

	/* ---- 3. Repeaters. All nine of them. ---- */

	/* 3.1 Hero trust ticks */
	$ticks = array();
	foreach ( $d['hero']['ticks'] as $tick ) {
		$ticks[] = array( 'field_atf_tick_text' => $tick );
	}
	$set_rows( 'field_atf_hero_ticks', $ticks );

	/* 3.2 Facts bar */
	$facts = array();
	foreach ( $d['facts'] as $fact ) {
		$facts[] = array(
			'field_atf_fact_k' => $fact['k'],
			'field_atf_fact_v' => $fact['v'],
		);
	}
	$set_rows( 'field_atf_facts', $facts );

	/* 3.3 Turf varieties */
	$varieties = array();
	foreach ( $d['varieties']['items'] as $item ) {
		$varieties[] = array(
			'field_atf_var_image' => atf_lp_seed_attachment( $item['image'] ),
			'field_atf_var_tag'   => $item['tag'],
			'field_atf_var_title' => $item['title'],
			'field_atf_var_text'  => $item['text'],
			'field_atf_var_specs' => $item['specs'],
			'field_atf_var_link'  => $item['link'],
		);
	}
	$set_rows( 'field_atf_varieties', $varieties );

	/* 3.4 Services */
	$services = array();
	foreach ( $d['services']['items'] as $item ) {
		$services[] = array(
			'field_atf_svc_icon'  => $item['icon'],
			'field_atf_svc_title' => $item['title'],
			'field_atf_svc_text'  => $item['text'],
		);
	}
	$set_rows( 'field_atf_services', $services );

	/* 3.5 Why Arrow Turf */
	$why = array();
	foreach ( $d['why']['items'] as $item ) {
		$why[] = array(
			'field_atf_why_icon'  => $item['icon'],
			'field_atf_why_title' => $item['title'],
			'field_atf_why_text'  => $item['text'],
		);
	}
	$set_rows( 'field_atf_why_items', $why );

	/* 3.6 How it works */
	$how = array();
	foreach ( $d['how']['items'] as $item ) {
		$how[] = array(
			'field_atf_step_title' => $item['title'],
			'field_atf_step_text'  => $item['text'],
		);
	}
	$set_rows( 'field_atf_how_items', $how );

	/* 3.7 Reviews */
	$reviews = array();
	foreach ( $d['reviews']['items'] as $item ) {
		$reviews[] = array(
			'field_atf_rev_quote'  => $item['quote'],
			'field_atf_rev_name'   => $item['name'],
			'field_atf_rev_source' => $item['source'],
		);
	}
	$set_rows( 'field_atf_reviews', $reviews );

	/* 3.8 Contact rows */
	$crows = array();
	foreach ( $d['contact']['rows'] as $item ) {
		$crows[] = array(
			'field_atf_crow_icon'  => $item['icon'],
			'field_atf_crow_label' => $item['label'],
			'field_atf_crow_value' => $item['value'],
			'field_atf_crow_url'   => $item['url'],
		);
	}
	$set_rows( 'field_atf_contact_rows', $crows );

	/* 3.9 Project gallery. A gallery field, so this one takes attachment IDs. */
	$gallery = array();
	foreach ( $d['projects']['images'] as $url ) {
		$id = atf_lp_seed_attachment( $url );
		if ( $id ) {
			$gallery[] = $id;
		}
	}
	$set_rows( 'field_atf_projects_gallery', $gallery );

	update_option( ATF_LP_SEED_OPTION, ATF_LP_SEED_VERSION );

	return array(
		'post_id' => $post_id,
		'fields'  => $fields,
		'rows'    => $rows,
	);
}

/**
 * Resolve a media library URL to its attachment ID.
 *
 * The seed URLs point at images already in this site's library, so this
 * normally hits. Sized URLs (foo-768x1024.webp) are retried against the
 * original filename, which is what attachment_url_to_postid() indexes.
 *
 * @param string $url Full image URL.
 * @return int Attachment ID, or 0 when it cannot be resolved.
 */
function atf_lp_seed_attachment( $url ) {

	if ( ! $url ) {
		return 0;
	}

	$id = attachment_url_to_postid( $url );
	if ( $id ) {
		return $id;
	}

	/* Strip a -WIDTHxHEIGHT suffix and try the original. */
	$original = preg_replace( '/-\d+x\d+(\.[a-zA-Z0-9]+)$/', '$1', $url );
	if ( $original !== $url ) {
		$id = attachment_url_to_postid( $original );
		if ( $id ) {
			return $id;
		}
	}

	/* Last resort: match on the filename alone, in case the site has moved
	   domains since these URLs were written. */
	global $wpdb;
	$file = basename( parse_url( $original, PHP_URL_PATH ) );
	$id   = (int) $wpdb->get_var( $wpdb->prepare(
		"SELECT post_id FROM {$wpdb->postmeta}
		 WHERE meta_key = '_wp_attached_file' AND meta_value LIKE %s
		 LIMIT 1",
		'%' . $wpdb->esc_like( $file )
	) );

	return $id;
}
