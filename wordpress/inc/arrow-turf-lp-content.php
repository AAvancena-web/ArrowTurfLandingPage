<?php
/**
 * Arrow Turf landing page: default content.
 *
 * Single source of truth for the page copy. The template falls back to this
 * when a field is empty, and the seeder writes it into ACF on first run, so
 * the page renders correctly whether or not it has been seeded yet.
 *
 * @package siteorigin-corp-child
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'atf_lp_default_content' ) ) :
/**
 * @return array
 */
function atf_lp_default_content() {

	$uploads = 'https://www.arrowturf.com.au/wp-content/uploads/2026/07/';

	return array(

		'phone'         => '0490779707',
		'phone_display' => '0490 779 707',
		'email'         => 'info@arrowturf.com.au',

		'hero' => array(
			'image'          => $uploads . '002-cover-photo-1536x672-1.webp',
			'image_alt'      => 'Premium instant turf supplied and installed across Sydney by Arrow Turf',
			'eyebrow'        => 'Sydney turf supplier & installer',
			'heading'        => 'Premium instant turf, grown on our own Sydney farm',
			'lede'           => 'Farm-fresh turf cut to order and delivered, or fully installed, right across Greater Sydney. Family owned and operated for over 45 years, with honest advice and pricing that stacks up.',
			'ticks'          => array(
				'Free, no-obligation consultation and quote',
				'Cut to order, most jobs ready within 1-2 days',
				'Supply only, or supplied and professionally laid',
			),
			'cta_label'      => 'BOOK YOUR CONSULTATION HERE',
			'rating'         => 'Rated 5.0 by Sydney homeowners, builders & landscapers on Google',
			'form_title'     => 'Book Your Consultation',
			'form_sub'       => 'Free &middot; No obligation &middot; 1 business day reply',
			'form_shortcode' => '[contact-form-7 id="fa9bd4f" title="Google Ads Form"]',
			'form_note'      => 'Prefer to talk it through? Call the farm on',
		),

		'facts' => array(
			array( 'k' => '45+ years',      'v' => 'Family owned &amp; operated' ),
			array( 'k' => 'Our own farm',   'v' => 'Grown on the Hawkesbury River' ),
			array( 'k' => '1-2 days',       'v' => 'Cut to order, delivered fresh' ),
			array( 'k' => 'Greater Sydney', 'v' => 'Delivery &amp; installation coverage' ),
		),

		'varieties' => array(
			'eyebrow' => 'Our turf varieties',
			'heading' => 'Choose the right grass for your place',
			'intro'   => 'Five premium varieties, all grown on our own farm. Not sure which one suits your soil, shade and foot traffic? Book a consultation and we&rsquo;ll recommend the best fit, with no upselling.',
			'items'   => array(
				array(
					'image' => $uploads . 'Sir-Walter.webp',
					'tag'   => 'Families &middot; Kids &middot; Pets',
					'title' => 'Sir Walter Soft Leaf Buffalo',
					'text'  => 'Australia&rsquo;s most trusted buffalo. Luxuriously soft underfoot, hard-wearing and low maintenance all year round.',
					'specs' => "Excellent shade tolerance\nSoft, non-scratch leaf\nGreat for busy backyards",
					'link'  => '/sir-walter-soft-leaf-buffalo-turf-sydney/',
				),
				array(
					'image' => $uploads . 'Matilda.webp',
					'tag'   => 'Lawns &middot; Landscapes',
					'title' => 'Matilda Soft Leaf Buffalo',
					'text'  => 'Proudly Australian-bred with finer stems and stolons. Beautifully soft to walk on, yet tough on wear and tear.',
					'specs' => "Fine, dense leaf\nStrong wear tolerance\nSuits all lawn types",
					'link'  => '/matilda-soft-leaf-buffalo-turf-sydney/',
				),
				array(
					'image' => $uploads . 'Kikuyu.webp',
					'tag'   => 'Schools &middot; Parks &middot; Fields',
					'title' => 'Kikuyu',
					'text'  => 'Hard-wearing, fast-repairing and easy to care for. The go-to for high-traffic areas that still need to feel good underfoot.',
					'specs' => "Fast self-repair\nBudget friendly\nLoves full sun",
					'link'  => '/kikuyu-turf-sydney/',
				),
				array(
					'image' => $uploads . 'WinterGreen.webp',
					'tag'   => 'Stadiums &middot; Golf courses',
					'title' => 'Wintergreen Couch',
					'text'  => 'A thick mat with a fine blade, used on top sports stadiums and golf courses, and equally at home on a premium lawn.',
					'specs' => "Fine blade, dense mat\nExcellent drought tolerance\nSports-field proven",
					'link'  => '/wintergreen-couch-turf-sydney/',
				),
				array(
					'image' => $uploads . 'Greenless.webp',
					'tag'   => 'Golf &middot; Bowling greens',
					'title' => 'Greenlees Park Couch',
					'text'  => 'A darker green, fine-textured premium couch, ideal for bowling greens, showpiece front lawns and commercial landscapes.',
					'specs' => "Deep green colour\nVery fine texture\nPremium finish",
					'link'  => '/greenlees-park-couch-sydney/',
				),
			),
		),

		'services' => array(
			'eyebrow'   => 'Our services',
			'heading'   => 'However you want it done, we&rsquo;ve got it covered',
			'intro'     => 'From a single pallet picked up at the farm gate to a fully prepped and installed commercial landscape. One team, start to finish.',
			'cta_label' => 'BOOK YOUR CONSULTATION HERE',
			'items'     => array(
				array( 'icon' => 'truck',   'title' => 'Turf Delivery Sydney-wide', 'text' => 'Cut fresh the morning it leaves the farm and delivered straight to your site, right across Greater Sydney.' ),
				array( 'icon' => 'box',     'title' => 'Turf Pickup',               'text' => 'Collect your order from our Hawkesbury River farm at a time that suits. Often the most cost-effective option for smaller jobs.' ),
				array( 'icon' => 'roll',    'title' => 'Maxi Roll Turf',            'text' => 'Large-format rolls that cover big areas fast with fewer seams, ideal for sports fields, parks and developments.' ),
				array( 'icon' => 'terrain', 'title' => 'Maxi Roll Turf Laying',     'text' => 'Our machinery and crew lay maxi rolls quickly and evenly, so large sites are green and usable in a fraction of the time.' ),
				array( 'icon' => 'tool',    'title' => 'Full Turf Installation',    'text' => 'Old lawn removal, levelling, underlay and laying, so your new lawn goes onto a properly prepared base and roots evenly.' ),
				array( 'icon' => 'advice',  'title' => 'Expert Turf Advice',        'text' => 'Free guidance on variety selection, quantities, soil prep and aftercare, so you only buy what you actually need.' ),
			),
		),

		'why' => array(
			'eyebrow'   => 'Why Arrow Turf',
			'heading'   => 'Straight from the farm, no middlemen, no markups',
			'intro'     => 'We grow it, we cut it, we deliver it and we lay it. That means fresher turf, sharper pricing and one accountable team for the whole job.',
			'image'     => $uploads . 'who-are-we-773x1024.webp',
			'image_alt' => 'The Arrow Turf family farm on the Hawkesbury River',
			'cta_label' => 'BOOK YOUR CONSULTATION HERE',
			'items'     => array(
				array( 'icon' => 'medal', 'title' => 'Premium quality at fair prices',  'text' => 'The best varieties our industry has to offer, priced so they don&rsquo;t blow the budget.' ),
				array( 'icon' => 'clock', 'title' => 'Cut to order, delivered fresh',   'text' => 'Nothing sits in a yard. Your turf is harvested for your job and on site within a day or two.' ),
				array( 'icon' => 'team',  'title' => '45+ years of hands-on experience', 'text' => 'Friendly, respectful crews who turn up when they say they will and finish the job properly.' ),
				array( 'icon' => 'home',  'title' => 'Local, family owned and run',     'text' => 'Trusted by homeowners, builders, developers, property managers and councils across Sydney.' ),
			),
		),

		'how' => array(
			'eyebrow' => 'How it works',
			'heading' => 'From first call to a lawn you can walk on',
			'items'   => array(
				array( 'title' => 'Book your consultation', 'text' => 'Send the form or call the farm. Tell us the suburb, rough size and what you&rsquo;re after.' ),
				array( 'title' => 'Get your free quote',    'text' => 'We recommend the right variety and send back a clear, itemised price with no obligation.' ),
				array( 'title' => 'We cut &amp; deliver',   'text' => 'Your turf is harvested to order and delivered, or picked up, on your chosen day.' ),
				array( 'title' => 'Laid &amp; ready to enjoy', 'text' => 'Our crew preps and lays it, then hands over simple watering and aftercare instructions.' ),
			),
		),

		'projects' => array(
			'eyebrow' => 'Recent work',
			'heading' => 'Lawns we&rsquo;ve delivered across Sydney',
			'intro'   => 'Residential lawns, commercial landscapes and sports surfaces, all grown and laid by our own team.',
			'images'  => array(
				$uploads . '1.webp',
				$uploads . '2.webp',
				$uploads . '3.webp',
				$uploads . '4.webp',
				$uploads . '5.webp',
				$uploads . '6.webp',
			),
		),

		'reviews' => array(
			'eyebrow' => 'What our customers say',
			'heading' => 'Rated 5.0 on Google',
			'items'   => array(
				array(
					'quote'  => 'Trevor was fantastic from the very first time I spoke to him. He informed me on every detail: delivery time, watering and care instructions. He marked out my block perfectly, making sure the turf layers got the job done correctly first time. The turf looks beautiful.',
					'name'   => 'Sallyanne H.',
					'source' => 'Google review',
				),
				array(
					'quote'  => 'I can highly recommend Zak and the whole team. I ordered 170sqm of Sir Walter Buffalo for my front lawn. Very happy with the organisation, delivery and price. Look forward to dealing with them again for my back yard project.',
					'name'   => 'Thomas R.',
					'source' => 'Google review',
				),
				array(
					'quote'  => 'Turf delivered today and extremely happy with the grass and the customer service. Highly recommend Arrow Turf: good quality and even better prices.',
					'name'   => 'Cat &amp; Haylee G.',
					'source' => 'Google reviews',
				),
			),
		),

		'contact' => array(
			'eyebrow'        => 'Get in touch',
			'heading'        => 'Book your free consultation',
			'intro'          => 'Send us a few details and we&rsquo;ll get straight back to you with advice and a no-obligation price.',
			'form_title'     => 'Tell us about your project',
			'form_sub'       => 'We reply to every enquiry within one business day.',
			'form_shortcode' => '[contact-form-7 id="fa9bd4f" title="Google Ads Form"]',
			'form_note'      => 'Free, no-obligation quote. We never share your details.',
			'rows'           => array(
				array( 'icon' => 'phone', 'label' => 'Phone',         'value' => '0490 779 707',                              'url' => 'tel:0490779707' ),
				array( 'icon' => 'mail',  'label' => 'Email',         'value' => 'info@arrowturf.com.au',                     'url' => 'mailto:info@arrowturf.com.au' ),
				array( 'icon' => 'pin',   'label' => 'The farm',      'value' => '104 Cornwallis Road, Cornwallis, NSW 2756', 'url' => 'https://maps.app.goo.gl/uE4DkVwdd2g9nsHBA' ),
				array( 'icon' => 'clock', 'label' => 'Opening hours', 'value' => 'Mon-Fri 7:30am-4pm &middot; Sat 7:30am-12pm', 'url' => '' ),
			),
			'map_src'        => 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3323.3422458211644!2d150.8133642!3d-33.5964234!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x6b0d6393ae064ec3%3A0x69b8604d19b759c7!2sArrow%20Turf%20Supplier%20Sydney!5e0!3m2!1sen!2sau!4v1783902309632!5m2!1sen!2sau',
		),

		'callbar' => array(
			'call_label' => 'Call the farm',
			'cta_label'  => 'Book a consultation',
		),

		'thanks' => array(
			'title' => 'Thanks, we&rsquo;ve got it.',
			'text'  => 'One of the team will be in touch within one business day with your free quote.',
		),
	);
}
endif;

/* -------------------------------------------------------------------------
 * Helpers shared by the template and the seeder.
 * ---------------------------------------------------------------------- */

if ( ! function_exists( 'atf_lp_get' ) ) :
/**
 * A field value, or the supplied default when the field is empty.
 *
 * @param string $name    Field name without the atf_ prefix.
 * @param mixed  $default Fallback.
 * @return mixed
 */
function atf_lp_get( $name, $default = '' ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}
	$value = get_field( 'atf_' . $name );
	if ( is_string( $value ) ) {
		$value = trim( $value );
	}
	if ( '' === $value || null === $value || false === $value || array() === $value ) {
		return $default;
	}
	return $value;
}
endif;

if ( ! function_exists( 'atf_lp_rows' ) ) :
/**
 * Repeater rows, or the supplied default when the repeater is empty.
 *
 * @param string $name    Field name without the atf_ prefix.
 * @param array  $default Fallback.
 * @return array
 */
function atf_lp_rows( $name, $default = array() ) {
	if ( ! function_exists( 'get_field' ) ) {
		return $default;
	}
	$rows = get_field( 'atf_' . $name );
	return ( is_array( $rows ) && ! empty( $rows ) ) ? $rows : $default;
}
endif;

if ( ! function_exists( 'atf_lp_image' ) ) :
/**
 * Normalise an ACF image value, falling back to a plain URL.
 *
 * @param mixed  $value        ACF image array, attachment ID, URL or empty.
 * @param string $fallback_url Used when $value is empty.
 * @param string $fallback_alt Used when the attachment has no alt text.
 * @param string $size         Registered image size to prefer.
 * @return array{url:string,alt:string,w:string,h:string}
 */
function atf_lp_image( $value, $fallback_url = '', $fallback_alt = '', $size = 'large' ) {

	$out = array( 'url' => $fallback_url, 'alt' => $fallback_alt, 'w' => '', 'h' => '' );

	if ( is_numeric( $value ) ) {
		$value = function_exists( 'acf_get_attachment' ) ? acf_get_attachment( $value ) : $value;
	}

	if ( is_array( $value ) && ! empty( $value['url'] ) ) {
		$out['url'] = ! empty( $value['sizes'][ $size ] ) ? $value['sizes'][ $size ] : $value['url'];
		$out['alt'] = ! empty( $value['alt'] ) ? $value['alt'] : $fallback_alt;
		$out['w']   = ! empty( $value['sizes'][ $size . '-width' ] ) ? $value['sizes'][ $size . '-width' ] : ( isset( $value['width'] ) ? $value['width'] : '' );
		$out['h']   = ! empty( $value['sizes'][ $size . '-height' ] ) ? $value['sizes'][ $size . '-height' ] : ( isset( $value['height'] ) ? $value['height'] : '' );
	} elseif ( is_string( $value ) && '' !== trim( $value ) ) {
		$out['url'] = $value;
	}

	return $out;
}
endif;

if ( ! function_exists( 'atf_lp_lines' ) ) :
/**
 * Split a textarea into trimmed, non-empty lines.
 *
 * @param string $text Raw textarea value.
 * @return string[]
 */
function atf_lp_lines( $text ) {
	$lines = preg_split( '/\r\n|\r|\n/', (string) $text );
	return array_values( array_filter( array_map( 'trim', $lines ), 'strlen' ) );
}
endif;

if ( ! function_exists( 'atf_lp_icon' ) ) :
/**
 * Inline SVG by key. Returns an empty string for an unknown key.
 *
 * @param string $key Icon key.
 * @return string
 */
function atf_lp_icon( $key ) {

	$paths = array(
		'check'   => '<polyline points="20 6 9 17 4 12"/>',
		'arrow'   => '<path d="M5 12h14"/><path d="m13 6 6 6-6 6"/>',
		'phone'   => '<path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72c.13.96.36 1.9.7 2.81a2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45c.91.34 1.85.57 2.81.7A2 2 0 0 1 22 16.92z"/>',
		'mail'    => '<path d="M4 4h16a2 2 0 0 1 2 2v12a2 2 0 0 1-2 2H4a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2z"/><polyline points="22,6 12,13 2,6"/>',
		'pin'     => '<path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>',
		'clock'   => '<circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>',
		'truck'   => '<rect x="1" y="3" width="15" height="13"/><polygon points="16 8 20 8 23 11 23 16 16 16 16 8"/><circle cx="5.5" cy="18.5" r="2.5"/><circle cx="18.5" cy="18.5" r="2.5"/>',
		'box'     => '<path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"/><polyline points="3.27 6.96 12 12.01 20.73 6.96"/><line x1="12" y1="22.08" x2="12" y2="12"/>',
		'roll'    => '<circle cx="12" cy="12" r="9"/><circle cx="12" cy="12" r="3.2"/>',
		'terrain' => '<path d="M2 20h20"/><path d="M4 20v-5l6-4 5 3 5-4v10"/><circle cx="7" cy="7" r="2.5"/>',
		'tool'    => '<path d="M14.7 6.3a1 1 0 0 0 0 1.4l1.6 1.6a1 1 0 0 0 1.4 0l3.77-3.77a6 6 0 0 1-7.94 7.94l-6.91 6.91a2.12 2.12 0 0 1-3-3l6.91-6.91a6 6 0 0 1 7.94-7.94l-3.76 3.76z"/>',
		'advice'  => '<path d="M12 22s8-4.5 8-11a8 8 0 1 0-16 0c0 6.5 8 11 8 11z"/><path d="M12 15V8"/><path d="M9 10.5c1.5 0 3 1 3 2.5"/><path d="M15 9c-1.5 0-3 1-3 2.5"/>',
		'medal'   => '<circle cx="12" cy="8" r="7"/><polyline points="8.21 13.89 7 23 12 20 17 23 15.79 13.88"/>',
		'team'    => '<path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"/><circle cx="9" cy="7" r="4"/><path d="M23 21v-2a4 4 0 0 0-3-3.87"/><path d="M16 3.13a4 4 0 0 1 0 7.75"/>',
		'home'    => '<path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"/><polyline points="9 22 9 12 15 12 15 22"/>',
	);

	if ( empty( $paths[ $key ] ) ) {
		return '';
	}

	return '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">' . $paths[ $key ] . '</svg>';
}
endif;

if ( ! function_exists( 'atf_lp_stars' ) ) :
/**
 * Five filled stars.
 *
 * @param string $label Accessible label, or empty to hide from assistive tech.
 * @return string
 */
function atf_lp_stars( $label = '' ) {
	$star = '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14l-5-4.87 6.91-1.01L12 2z"/></svg>';
	$attr = $label ? ' aria-label="' . esc_attr( $label ) . '"' : ' aria-hidden="true"';
	return '<span class="stars"' . $attr . '>' . str_repeat( $star, 5 ) . '</span>';
}
endif;

/* ---------------------------------------------------------------------------
 * Fallback form and thank-you panel.
 *
 * Only used when no Contact Form 7 shortcode is set, so the page is never
 * shipped without a visible form. It posts nowhere: wire up CF7 before this
 * goes live on paid traffic.
 * ------------------------------------------------------------------------ */

if ( ! function_exists( 'atf_lp_fallback_form' ) ) :
/**
 * @param string $prefix     Unique id prefix, e.g. 'h' or 'c'.
 * @param string $cta        Submit button label.
 * @param bool   $with_extra Include the variety select and message textarea.
 * @return void
 */
function atf_lp_fallback_form( $prefix, $cta, $with_extra = false ) {
	$p = sanitize_html_class( $prefix );
	?>
	<form class="atf-form" novalidate>
		<div class="f2">
			<div class="frow">
				<label for="<?php echo esc_attr( $p ); ?>-name">Your name <span class="req">*</span></label>
				<input type="text" id="<?php echo esc_attr( $p ); ?>-name" name="name" autocomplete="name" required>
				<span class="err-msg">Please enter your name.</span>
			</div>
			<div class="frow">
				<label for="<?php echo esc_attr( $p ); ?>-phone">Phone <span class="req">*</span></label>
				<input type="tel" id="<?php echo esc_attr( $p ); ?>-phone" name="phone" autocomplete="tel" required>
				<span class="err-msg">Please enter a contact number.</span>
			</div>
		</div>
		<div class="f2">
			<div class="frow">
				<label for="<?php echo esc_attr( $p ); ?>-email">Email <span class="req">*</span></label>
				<input type="email" id="<?php echo esc_attr( $p ); ?>-email" name="email" autocomplete="email" required>
				<span class="err-msg">Please enter a valid email address.</span>
			</div>
			<div class="frow">
				<label for="<?php echo esc_attr( $p ); ?>-suburb">Suburb <span class="req">*</span></label>
				<input type="text" id="<?php echo esc_attr( $p ); ?>-suburb" name="suburb" autocomplete="address-level2" required>
				<span class="err-msg">Please enter your suburb.</span>
			</div>
		</div>
		<div class="f2">
			<div class="frow">
				<label for="<?php echo esc_attr( $p ); ?>-area">Approx. area (m&sup2;)</label>
				<input type="text" id="<?php echo esc_attr( $p ); ?>-area" name="area" inputmode="numeric" placeholder="e.g. 120">
			</div>
			<div class="frow">
				<label for="<?php echo esc_attr( $p ); ?>-variety">Turf variety</label>
				<select id="<?php echo esc_attr( $p ); ?>-variety" name="variety">
					<option value="">Not sure, please advise</option>
					<option>Sir Walter Soft Leaf Buffalo</option>
					<option>Matilda Soft Leaf Buffalo</option>
					<option>Kikuyu</option>
					<option>Wintergreen Couch</option>
					<option>Greenlees Park Couch</option>
				</select>
			</div>
		</div>
		<div class="frow">
			<label for="<?php echo esc_attr( $p ); ?>-service">What do you need?</label>
			<select id="<?php echo esc_attr( $p ); ?>-service" name="service">
				<option value="">Select an option</option>
				<option>Turf supplied &amp; installed</option>
				<option>Turf delivered (supply only)</option>
				<option>Pick up from the farm</option>
				<option>Maxi roll turf</option>
				<option>Not sure, please advise</option>
			</select>
		</div>
		<?php if ( $with_extra ) : ?>
			<div class="frow">
				<label for="<?php echo esc_attr( $p ); ?>-message">Your project</label>
				<textarea id="<?php echo esc_attr( $p ); ?>-message" name="message" placeholder="Anything else we should know about access, timing or site condition?"></textarea>
			</div>
		<?php endif; ?>
		<button class="btn btn-primary btn-block<?php echo $with_extra ? ' btn-lg' : ''; ?>" type="submit">
			<?php echo wp_kses_post( $cta ); ?>
			<span class="btn-arrow" aria-hidden="true"><?php echo atf_lp_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
		</button>
	</form>
	<?php
}
endif;

if ( ! function_exists( 'atf_lp_thanks' ) ) :
/**
 * @param string $title     Heading.
 * @param string $text      Body copy.
 * @param string $tel       tel: link.
 * @param string $phone_txt Phone number as displayed.
 * @return void
 */
function atf_lp_thanks( $title, $text, $tel, $phone_txt ) {
	?>
	<div class="form-success" role="status" aria-live="polite">
		<div class="tick"><?php echo atf_lp_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
		<h3><?php echo wp_kses_post( $title ); ?></h3>
		<p><?php echo wp_kses_post( $text ); ?>
			Need it sooner? Call us on <a href="<?php echo esc_url( $tel ); ?>"><?php echo esc_html( $phone_txt ); ?></a>.</p>
	</div>
	<?php
}
endif;
