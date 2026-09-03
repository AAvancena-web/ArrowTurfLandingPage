<?php
/**
 * Arrow Turf landing page: ACF field group.
 *
 * Registered in code rather than the UI so it travels with the theme and
 * cannot be edited away by accident. Shows only on pages using the
 * "Arrow Turf Landing Page" template.
 *
 * @package siteorigin-corp-child
 */

defined( 'ABSPATH' ) || exit;

add_action( 'acf/init', 'atf_lp_register_fields' );

/**
 * @return void
 */
function atf_lp_register_fields() {

	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	/**
	 * Small helpers so the group below stays readable.
	 */
	$text = function ( $name, $label, $extra = array() ) {
		return array_merge( array(
			'key'   => 'field_atf_' . $name,
			'label' => $label,
			'name'  => 'atf_' . $name,
			'type'  => 'text',
		), $extra );
	};
	$area = function ( $name, $label, $rows = 3, $extra = array() ) {
		return array_merge( array(
			'key'   => 'field_atf_' . $name,
			'label' => $label,
			'name'  => 'atf_' . $name,
			'type'  => 'textarea',
			'rows'  => $rows,
			'new_lines' => '',
		), $extra );
	};
	$image = function ( $name, $label, $extra = array() ) {
		return array_merge( array(
			'key'           => 'field_atf_' . $name,
			'label'         => $label,
			'name'          => 'atf_' . $name,
			'type'          => 'image',
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'library'       => 'all',
		), $extra );
	};
	$tab = function ( $name, $label ) {
		return array(
			'key'       => 'field_atf_tab_' . $name,
			'label'     => $label,
			'type'      => 'tab',
			'placement' => 'top',
		);
	};

	$service_icons = array(
		'truck'   => 'Delivery truck',
		'box'     => 'Box / pickup',
		'roll'    => 'Roll',
		'terrain' => 'Terrain / laying',
		'tool'    => 'Tool / installation',
		'advice'  => 'Advice / location pin',
	);
	$why_icons = array(
		'medal' => 'Medal',
		'clock' => 'Clock',
		'team'  => 'Team',
		'home'  => 'Home',
	);
	$contact_icons = array(
		'phone' => 'Phone',
		'mail'  => 'Email',
		'pin'   => 'Map pin',
		'clock' => 'Clock',
	);

	acf_add_local_field_group( array(
		'key'      => 'group_atf_landing_page',
		'title'    => 'Arrow Turf Landing Page',
		'location' => array(
			array(
				array(
					'param'    => 'page_template',
					'operator' => '==',
					'value'    => 'page-arrow-turf-lp.php',
				),
			),
		),
		'menu_order'            => 0,
		'position'              => 'normal',
		'style'                 => 'default',
		'label_placement'       => 'top',
		'hide_on_screen'        => array( 'the_content' ),
		'active'                => true,
		'description'           => 'Content for the Google Ads landing page. Anything left blank falls back to the copy shipped with the template.',
		'show_in_rest'          => 0,
		'fields'                => array(

			/* ---------------- Global ---------------- */
			$tab( 'global', 'Global' ),
			$text( 'phone', 'Phone number (digits, for tel: links)', array( 'placeholder' => '0490779707' ) ),
			$text( 'phone_display', 'Phone number (as displayed)', array( 'placeholder' => '0490 779 707' ) ),
			$text( 'email', 'Email address' ),
			$text( 'callbar_call_label', 'Sticky mobile bar: call label', array( 'wrapper' => array( 'width' => 50 ) ) ),
			$text( 'callbar_cta_label', 'Sticky mobile bar: enquiry label', array( 'wrapper' => array( 'width' => 50 ) ) ),
			$text( 'thanks_title', 'Thank-you heading', array( 'wrapper' => array( 'width' => 50 ) ) ),
			$text( 'thanks_text', 'Thank-you message', array( 'wrapper' => array( 'width' => 50 ) ) ),

			/* ---------------- Hero ---------------- */
			$tab( 'hero', 'Hero' ),
			$image( 'hero_image', 'Background image' ),
			$text( 'hero_eyebrow', 'Eyebrow' ),
			$text( 'hero_heading', 'H1' ),
			$area( 'hero_lede', 'Intro paragraph' ),
			array(
				'key'          => 'field_atf_hero_ticks',
				'label'        => 'Trust ticks',
				'name'         => 'atf_hero_ticks',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Add tick',
				'sub_fields'   => array(
					array( 'key' => 'field_atf_tick_text', 'label' => 'Text', 'name' => 'text', 'type' => 'text' ),
				),
			),
			$text( 'hero_cta_label', 'CTA button label' ),
			$text( 'hero_rating', 'Rating line' ),
			$text( 'hero_form_title', 'Form card heading' ),
			$text( 'hero_form_sub', 'Form card subheading' ),
			$text( 'hero_form_shortcode', 'Contact Form 7 shortcode', array(
				'instructions' => 'e.g. [contact-form-7 id="2794"]. Leave blank to use the built-in fallback form.',
			) ),
			$text( 'hero_form_note', 'Note under the form' ),

			/* ---------------- Facts ---------------- */
			$tab( 'facts', 'Facts bar' ),
			array(
				'key'          => 'field_atf_facts',
				'label'        => 'Facts',
				'name'         => 'atf_facts',
				'type'         => 'repeater',
				'layout'       => 'table',
				'button_label' => 'Add fact',
				'sub_fields'   => array(
					array( 'key' => 'field_atf_fact_k', 'label' => 'Headline', 'name' => 'k', 'type' => 'text' ),
					array( 'key' => 'field_atf_fact_v', 'label' => 'Supporting line', 'name' => 'v', 'type' => 'text' ),
				),
			),

			/* ---------------- Varieties ---------------- */
			$tab( 'varieties', 'Turf varieties' ),
			$text( 'varieties_eyebrow', 'Eyebrow' ),
			$text( 'varieties_heading', 'Heading' ),
			$area( 'varieties_intro', 'Intro' ),
			array(
				'key'          => 'field_atf_varieties',
				'label'        => 'Varieties',
				'name'         => 'atf_varieties',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add variety',
				'sub_fields'   => array(
					array( 'key' => 'field_atf_var_image', 'label' => 'Image', 'name' => 'image', 'type' => 'image', 'return_format' => 'array', 'preview_size' => 'medium' ),
					array( 'key' => 'field_atf_var_tag',   'label' => 'Best-for tag', 'name' => 'tag', 'type' => 'text', 'wrapper' => array( 'width' => 50 ) ),
					array( 'key' => 'field_atf_var_title', 'label' => 'Name', 'name' => 'title', 'type' => 'text', 'wrapper' => array( 'width' => 50 ) ),
					array( 'key' => 'field_atf_var_text',  'label' => 'Description', 'name' => 'text', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ),
					array( 'key' => 'field_atf_var_specs', 'label' => 'Spec bullets', 'name' => 'specs', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '', 'instructions' => 'One per line.' ),
					array( 'key' => 'field_atf_var_link',  'label' => 'Detail page URL', 'name' => 'link', 'type' => 'text', 'instructions' => 'Optional. Leave blank to link the card to the form.' ),
				),
			),

			/* ---------------- Services ---------------- */
			$tab( 'services', 'Services' ),
			$text( 'services_eyebrow', 'Eyebrow' ),
			$text( 'services_heading', 'Heading' ),
			$area( 'services_intro', 'Intro' ),
			array(
				'key'          => 'field_atf_services',
				'label'        => 'Services',
				'name'         => 'atf_services',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add service',
				'sub_fields'   => array(
					array( 'key' => 'field_atf_svc_icon',  'label' => 'Icon', 'name' => 'icon', 'type' => 'select', 'choices' => $service_icons, 'wrapper' => array( 'width' => 30 ) ),
					array( 'key' => 'field_atf_svc_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'wrapper' => array( 'width' => 70 ) ),
					array( 'key' => 'field_atf_svc_text',  'label' => 'Description', 'name' => 'text', 'type' => 'textarea', 'rows' => 3, 'new_lines' => '' ),
				),
			),
			$text( 'services_cta_label', 'CTA button label' ),

			/* ---------------- Why us ---------------- */
			$tab( 'why', 'Why Arrow Turf' ),
			$text( 'why_eyebrow', 'Eyebrow' ),
			$text( 'why_heading', 'Heading' ),
			$area( 'why_intro', 'Intro' ),
			$image( 'why_image', 'Image' ),
			array(
				'key'          => 'field_atf_why_items',
				'label'        => 'Points',
				'name'         => 'atf_why_items',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add point',
				'sub_fields'   => array(
					array( 'key' => 'field_atf_why_icon',  'label' => 'Icon', 'name' => 'icon', 'type' => 'select', 'choices' => $why_icons, 'wrapper' => array( 'width' => 30 ) ),
					array( 'key' => 'field_atf_why_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text', 'wrapper' => array( 'width' => 70 ) ),
					array( 'key' => 'field_atf_why_text',  'label' => 'Description', 'name' => 'text', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '' ),
				),
			),
			$text( 'why_cta_label', 'CTA button label' ),

			/* ---------------- How it works ---------------- */
			$tab( 'how', 'How it works' ),
			$text( 'how_eyebrow', 'Eyebrow' ),
			$text( 'how_heading', 'Heading' ),
			array(
				'key'          => 'field_atf_how_items',
				'label'        => 'Steps',
				'name'         => 'atf_how_items',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add step',
				'sub_fields'   => array(
					array( 'key' => 'field_atf_step_title', 'label' => 'Title', 'name' => 'title', 'type' => 'text' ),
					array( 'key' => 'field_atf_step_text',  'label' => 'Description', 'name' => 'text', 'type' => 'textarea', 'rows' => 2, 'new_lines' => '' ),
				),
			),

			/* ---------------- Projects ---------------- */
			$tab( 'projects', 'Recent work' ),
			$text( 'projects_eyebrow', 'Eyebrow' ),
			$text( 'projects_heading', 'Heading' ),
			$area( 'projects_intro', 'Intro' ),
			array(
				'key'           => 'field_atf_projects_gallery',
				'label'         => 'Gallery',
				'name'          => 'atf_projects_gallery',
				'type'          => 'gallery',
				'return_format' => 'array',
				'preview_size'  => 'medium',
				'instructions'  => 'Six images works best.',
			),

			/* ---------------- Reviews ---------------- */
			$tab( 'reviews', 'Reviews' ),
			$text( 'reviews_eyebrow', 'Eyebrow' ),
			$text( 'reviews_heading', 'Heading' ),
			array(
				'key'          => 'field_atf_reviews',
				'label'        => 'Reviews',
				'name'         => 'atf_reviews',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add review',
				'sub_fields'   => array(
					array( 'key' => 'field_atf_rev_quote',  'label' => 'Quote', 'name' => 'quote', 'type' => 'textarea', 'rows' => 4, 'new_lines' => '' ),
					array( 'key' => 'field_atf_rev_name',   'label' => 'Name', 'name' => 'name', 'type' => 'text', 'wrapper' => array( 'width' => 50 ) ),
					array( 'key' => 'field_atf_rev_source', 'label' => 'Source', 'name' => 'source', 'type' => 'text', 'wrapper' => array( 'width' => 50 ) ),
				),
			),

			/* ---------------- Contact ---------------- */
			$tab( 'contact', 'Contact' ),
			$text( 'contact_eyebrow', 'Eyebrow' ),
			$text( 'contact_heading', 'Heading' ),
			$area( 'contact_intro', 'Intro' ),
			$text( 'contact_form_title', 'Form heading' ),
			$text( 'contact_form_sub', 'Form subheading' ),
			$text( 'contact_form_shortcode', 'Contact Form 7 shortcode', array(
				'instructions' => 'e.g. [contact-form-7 id="5659"]. Leave blank to use the built-in fallback form.',
			) ),
			$text( 'contact_form_note', 'Note under the form' ),
			$area( 'contact_map_src', 'Google Maps embed src', 3, array(
				'instructions' => 'The src URL from the Google Maps embed code, not the whole iframe.',
			) ),
			array(
				'key'          => 'field_atf_contact_rows',
				'label'        => 'Contact rows',
				'name'         => 'atf_contact_rows',
				'type'         => 'repeater',
				'layout'       => 'block',
				'button_label' => 'Add row',
				'instructions' => 'Shown beside the form, above the map. Leave the link blank for a row that should not be clickable.',
				'sub_fields'   => array(
					array( 'key' => 'field_atf_crow_icon',  'label' => 'Icon', 'name' => 'icon', 'type' => 'select', 'choices' => $contact_icons ),
					array( 'key' => 'field_atf_crow_label', 'label' => 'Label', 'name' => 'label', 'type' => 'text' ),
					array( 'key' => 'field_atf_crow_value', 'label' => 'Value', 'name' => 'value', 'type' => 'text' ),
					array( 'key' => 'field_atf_crow_url',   'label' => 'Link', 'name' => 'url', 'type' => 'text' ),
				),
			),
		),
	) );
}
