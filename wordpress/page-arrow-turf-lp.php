<?php
/**
 * Template Name: Arrow Turf Landing Page
 *
 * Landing page for Google Ads traffic. Renders inside the site header and
 * footer via get_header() / get_footer(), so navigation, GTM, Contact Form 7
 * and anything else the theme hooks in all behave as they do site-wide.
 *
 * The page CSS is printed into <head> from a wp_head hook registered at the
 * top of this file, because get_header() is what fires wp_head, and the
 * template executes before that call.
 *
 * Every field falls back to the copy in inc/arrow-turf-lp-content.php, so the
 * page renders correctly before the seeder has run.
 *
 * @package siteorigin-corp-child
 */

defined( 'ABSPATH' ) || exit;

require_once get_stylesheet_directory() . '/inc/arrow-turf-lp-content.php';

$atf_d = atf_lp_default_content();

/* ---------------------------------------------------------------------------
 * Resolve content once, up front, so the markup below stays readable.
 * ------------------------------------------------------------------------ */

$atf_phone     = atf_lp_get( 'phone', $atf_d['phone'] );
$atf_phone_txt = atf_lp_get( 'phone_display', $atf_d['phone_display'] );
$atf_email     = atf_lp_get( 'email', $atf_d['email'] );

$atf_hero = array(
	'image'     => atf_lp_image( atf_lp_get( 'hero_image', '' ), $atf_d['hero']['image'], $atf_d['hero']['image_alt'], 'full' ),
	'eyebrow'   => atf_lp_get( 'hero_eyebrow', $atf_d['hero']['eyebrow'] ),
	'heading'   => atf_lp_get( 'hero_heading', $atf_d['hero']['heading'] ),
	'lede'      => atf_lp_get( 'hero_lede', $atf_d['hero']['lede'] ),
	'cta'       => atf_lp_get( 'hero_cta_label', $atf_d['hero']['cta_label'] ),
	'rating'    => atf_lp_get( 'hero_rating', $atf_d['hero']['rating'] ),
	'f_title'   => atf_lp_get( 'hero_form_title', $atf_d['hero']['form_title'] ),
	'f_sub'     => atf_lp_get( 'hero_form_sub', $atf_d['hero']['form_sub'] ),
	'f_code'    => atf_lp_get( 'hero_form_shortcode', $atf_d['hero']['form_shortcode'] ),
	'f_note'    => atf_lp_get( 'hero_form_note', $atf_d['hero']['form_note'] ),
);

$atf_ticks = array();
foreach ( atf_lp_rows( 'hero_ticks' ) as $row ) {
	if ( ! empty( $row['text'] ) ) {
		$atf_ticks[] = $row['text'];
	}
}
if ( ! $atf_ticks ) {
	$atf_ticks = $atf_d['hero']['ticks'];
}

$atf_facts    = atf_lp_rows( 'facts', $atf_d['facts'] );
$atf_thanks_t = atf_lp_get( 'thanks_title', $atf_d['thanks']['title'] );
$atf_thanks_x = atf_lp_get( 'thanks_text', $atf_d['thanks']['text'] );

$atf_var      = $atf_d['varieties'];
$atf_var_rows = atf_lp_rows( 'varieties', $atf_var['items'] );
$atf_svc      = $atf_d['services'];
$atf_svc_rows = atf_lp_rows( 'services', $atf_svc['items'] );
$atf_why      = $atf_d['why'];
$atf_why_rows = atf_lp_rows( 'why_items', $atf_why['items'] );
$atf_how      = $atf_d['how'];
$atf_how_rows = atf_lp_rows( 'how_items', $atf_how['items'] );
$atf_prj      = $atf_d['projects'];
$atf_rev      = $atf_d['reviews'];
$atf_rev_rows = atf_lp_rows( 'reviews', $atf_rev['items'] );
$atf_con      = $atf_d['contact'];

$atf_gallery = atf_lp_get( 'projects_gallery', array() );
if ( ! is_array( $atf_gallery ) || ! $atf_gallery ) {
	$atf_gallery = array();
	foreach ( $atf_prj['images'] as $url ) {
		$atf_gallery[] = array( 'url' => $url, 'alt' => '' );
	}
}

$atf_why_img = atf_lp_image( atf_lp_get( 'why_image', '' ), $atf_why['image'], $atf_why['image_alt'] );

$atf_crows = atf_lp_rows( 'contact_rows', $atf_con['rows'] );

$atf_tel  = 'tel:' . preg_replace( '/[^0-9+]/', '', $atf_phone );
$atf_icon = 'atf_lp_icon';

/* -----------------------------------------------------------------------
 * The page renders inside the site header and footer, so two things have
 * to be registered before get_header() runs: get_header() is what fires
 * both wp_head and body_class, and the template file executes before it.
 * -------------------------------------------------------------------- */

add_filter( 'body_class', function ( $classes ) {
	$classes[] = 'atf-lp';
	return $classes;
} );

add_action( 'wp_head', function () {
	?>
<style id="atf-lp-styles">

/* ============================================================
   ARROW TURF GOOGLE ADS LANDING PAGE
   Printed into <head> from the wp_head hook registered in the
   template, so it lands after the theme's stylesheets and wins
   the cascade without a flash of unstyled content.
   ============================================================ */

:root{
  --brand:#2C6E3F;
  --brand-deep:#1B4428;
  --ink:#16301F;
  --ink-soft:#4A5C50;
  --ink-faint:#7C8A81;
  --clay:#8E4B24;
  --paper:#F4F6F1;
  --paper-2:#FFFFFF;
  --line:#DCE3D8;
  --line-soft:#E9EEE5;
  --tint:#E7F0E6;
  --display:"Bricolage Grotesque", system-ui, sans-serif;
  --body:"Instrument Sans", system-ui, sans-serif;
  --mono:"IBM Plex Mono", ui-monospace, monospace;
  --wrap:1440px;
  --r:10px;
}

/* Desktop / laptop caps at 1440px, larger screens open up to 1880px */
@media (min-width:1700px){ :root{ --wrap:1880px; } }

.atf-lp-page, .atf-lp-page *, .atf-lp-page *::before, .atf-lp-page *::after{ box-sizing:border-box; }

html{ scroll-behavior:smooth; -webkit-text-size-adjust:100%; }

/* Typography lives on .atf-lp-page, not body, so the theme's header and
   footer keep their own type. Only the page background is global. */
body{
  background:var(--paper);
  -webkit-font-smoothing:antialiased;
}
.atf-lp-page{
  color:var(--ink);
  font-family:var(--body);
  font-size:18.7px;
  line-height:1.65;
}

.atf-lp-page img{ max-width:100%; display:block; }
.atf-lp-page a{ color:inherit; }

.atf-lp-page h1,
.atf-lp-page h2,
.atf-lp-page h3,
.atf-lp-page h4{
  font-family:var(--display);
  overflow-wrap:break-word;
  font-weight:800;
  line-height:1.06;
  letter-spacing:-.025em;
  margin:0;
}
.atf-lp-page h2{ font-size:clamp(30.8px,3.52vw,47.52px); }
.atf-lp-page h3{ font-size:20.24px; font-weight:600; letter-spacing:-.01em; line-height:1.25; }
.atf-lp-page p{ margin:0 0 16px; }
.atf-lp-page p:last-child{ margin-bottom:0; }

.wrap{ max-width:var(--wrap); margin:0 auto; padding:0 24px; }
@media (max-width:640px){ .wrap{ padding:0 20px; } }

.atf-lp-page section{ padding:clamp(48px,5.5vw,80px) 0; }

.eyebrow{
  font-family:var(--mono);
  font-size:12.672px;
  letter-spacing:.15em;
  text-transform:uppercase;
  color:var(--brand);
  margin:0 0 12.8px;
}

.head{ max-width:70ch; }
.head.center{ margin:0 auto clamp(32px,4vw,48px); text-align:center; }
.head-p{ color:var(--ink-soft); font-size:clamp(17.6px,1.485vw,19.888px); margin:14.4px 0 0; }

.band-white{ background:var(--paper-2); }
.band-tint{ background:var(--tint); }

/* ---------- Buttons ---------- */
.atf-lp-page .btn{
  display:inline-flex; align-items:center; justify-content:center; gap:14px;
  cursor:pointer; text-decoration:none; text-align:center;
  font-family:var(--body); font-size:17.6px; font-weight:700;
  letter-spacing:.01em; line-height:1.2;
  padding:16.8px 30.4px;
  border-radius:var(--r);
  border:1.5px solid transparent;
  transition:transform .25s ease, box-shadow .25s ease, color .35s ease, background .25s ease;
}
.atf-lp-page .btn:active{ transform:translateY(1px); }
.atf-lp-page .btn svg{ flex:none; width:20px; height:20px; }

.atf-lp-page .btn-light{ background:#fff; color:var(--ink); border-color:#fff; }
.atf-lp-page .btn-light:hover{ background:var(--tint); border-color:var(--tint); transform:translateY(-2px); }

.atf-lp-page .btn-ghost{ background:transparent; color:var(--ink); border-color:var(--ink); }
.atf-lp-page .btn-ghost:hover{ background:var(--ink); color:#fff; }

/* ============================================================
   PRIMARY CTA
   Rest: the gradient fills the pill and the glow swells once per
   cycle, a slow beacon rather than a constant breathe.
   Hover: the gradient retracts into the arrow circle, revealing
   the white pill underneath, and the label turns green.
   ============================================================ */
.atf-lp-page .btn-primary{
  position:relative; isolation:isolate; overflow:hidden;
  justify-content:space-between;
  background:#fff; color:#fff;
  border:0;
  padding:9.5px 9.5px 9.5px 33.5px;
  box-shadow:
    0 0 18px -3px rgba(90,174,110,.58),
    0 0 38px -6px rgba(44,110,63,.44),
    0 12px 30px -14px rgba(27,68,40,.85);
  animation:atfGlow 4.2s ease-in-out infinite;
}
@keyframes atfGlow{
  0%,58%,100%{ box-shadow:
    0 0 13px -4px rgba(90,174,110,.42),
    0 0 28px -9px rgba(44,110,63,.30),
    0 12px 30px -14px rgba(27,68,40,.82); }
  79%        { box-shadow:
    0 0 26px -1px rgba(122,199,140,.82),
    0 0 62px -3px rgba(44,110,63,.62),
    0 14px 34px -12px rgba(27,68,40,.92); }
}
.atf-lp-page .btn-primary::before{
  content:""; position:absolute; z-index:-1;
  /* overshoot so the button's own overflow:hidden defines the edge; matching
     the two rounded rects exactly leaves an antialiased white fringe */
  top:-2px; right:-2px; bottom:-2px; left:-2px;
  background:var(--brand); border-radius:calc(var(--r) + 2px);
  transition:left .5s cubic-bezier(.65,.05,.25,1), top .5s cubic-bezier(.65,.05,.25,1),
             right .5s cubic-bezier(.65,.05,.25,1), bottom .5s cubic-bezier(.65,.05,.25,1),
             border-radius .5s cubic-bezier(.65,.05,.25,1);
}
.atf-lp-page .btn-primary:hover,
.atf-lp-page .btn-primary:focus-visible{
  color:var(--brand); transform:translateY(-2px); animation:none;
  box-shadow:
    0 0 26px -2px rgba(122,199,140,.75),
    0 0 56px -4px rgba(44,110,63,.60),
    0 18px 38px -14px rgba(27,68,40,.95);
}
.atf-lp-page .btn-primary:hover::before,
.atf-lp-page .btn-primary:focus-visible::before{
  /* 46px square centred on the arrow, whatever height the button ends up:
     deriving it from the padding made it an ellipse as soon as the label wrapped */
  left:calc(100% - 55.5px); right:9.5px;
  top:calc(50% - 23px); bottom:calc(50% - 23px);
  border-radius:50%;
}

.atf-lp-page .btn-arrow{
  width:46px; height:46px; border-radius:50%; flex:none;
  display:grid; place-items:center; color:#fff;
}
.atf-lp-page .btn-arrow svg{ width:18px; height:18px; transition:transform .4s cubic-bezier(.65,.05,.25,1); }
.atf-lp-page .btn-primary:hover .btn-arrow svg{ transform:translateX(2px); }

.atf-lp-page .btn-block{ width:100%; }
.atf-lp-page .btn-lg{ font-size:18.656px; }
.atf-lp-page .btn-lg:not(.btn-primary){ padding:19.2px 33.6px; }

/* Long CTA copy needs room to breathe on narrow screens */
@media (max-width:560px){
  .atf-lp-page .btn{ font-size:16.192px; gap:10px; }
  .atf-lp-page .btn-lg:not(.btn-primary){ padding:16px 19.2px; }
  .atf-lp-page .btn-primary{ padding:8.5px 8.5px 8.5px 23.5px; }
  .atf-lp-page .btn-primary:hover::before,
  .atf-lp-page .btn-primary:focus-visible::before{
    left:calc(100% - 48.5px); right:8.5px;
    top:calc(50% - 20px); bottom:calc(50% - 20px);
    border-radius:50%;
  }
  .atf-lp-page .btn-arrow{ width:40px; height:40px; }
}

/* ============================================================
   HERO: copy + CTA left, lead form right
   ============================================================ */
.hero{ position:relative; overflow:hidden; background:var(--brand-deep); }
.hero-bg{ position:absolute; inset:0; width:100%; height:100%; object-fit:cover; }
.hero::after{
  content:""; position:absolute; inset:0;
  background:linear-gradient(100deg, rgba(11,26,16,.90) 0%, rgba(11,26,16,.74) 45%, rgba(11,26,16,.52) 100%);
}
.hero-in{ position:relative; z-index:2; padding:clamp(40px,5vw,72px) 0; }
.hero-grid{
  display:grid;
  grid-template-columns:1.08fr .92fr;
  gap:clamp(32px,4vw,56px);
  align-items:center;
}
@media (max-width:1000px){ .hero-grid{ grid-template-columns:1fr; gap:32px; } }

.hero .eyebrow{ color:#9FD3AE; }
.hero h1{
  color:#fff;
  font-size:clamp(37.84px,4.73vw,65.12px);
  max-width:17ch;
}
.hero-lede{
  color:#DCEBE0;
  font-size:clamp(18.128px,1.485vw,21.12px);
  max-width:52ch;
  margin:18.4px 0 0;
}

.hero-ticks{ list-style:none; margin:25.6px 0 0; padding:0; display:grid; gap:9.6px; max-width:46ch; }
.hero-ticks li{ display:flex; align-items:flex-start; gap:10.4px; color:#fff; font-size:17.6px; font-weight:500; }
.hero-ticks svg{ flex:none; width:20px; height:20px; margin-top:2px; color:#9FD3AE; }

.hero-cta{ display:flex; flex-wrap:wrap; gap:12.8px; margin-top:32px; }
.hero-cta .btn{ min-width:250px; }
@media (max-width:560px){
  .hero-cta{ flex-direction:column; }
  .hero-cta .btn{ min-width:0; width:100%; }
}

.hero-rating{
  display:flex; align-items:center; gap:11.2px;
  margin-top:25.6px; color:#DCEBE0; font-size:16.192px;
}
.stars{ display:inline-flex; gap:2px; color:#F5B60D; }
.stars svg{ width:17px; height:17px; }

/* ---------- Lead form card ---------- */
.lead-card{
  background:var(--paper-2);
  border-radius:14px;
  overflow:hidden;
  box-shadow:0 24px 60px rgba(0,0,0,.32);
}
.lead-card .lc-top{
  background:var(--brand);
  color:#fff;
  padding:18.4px 24px;
  text-align:center;
}
.lead-card .lc-top h2{ font-size:26.4px; color:#fff; }
.lead-card .lc-top .sub{
  font-family:var(--mono); font-size:12.672px; letter-spacing:.13em; text-transform:uppercase;
  color:#BFE0C8; margin:7.2px 0 0;
}
.lead-card .lc-body{ padding:24px; }

.f2{ display:grid; grid-template-columns:1fr 1fr; gap:13.6px; }
@media (max-width:440px){ .f2{ grid-template-columns:1fr; } }

.frow{ margin-bottom:13.6px; }
.frow label{
  display:block; font-size:13.728px; font-weight:600; color:var(--ink-soft);
  margin-bottom:5.6px; letter-spacing:.01em;
}
.frow label .req{ color:var(--clay); }
.frow input,.frow select,.frow textarea{
  width:100%;
  font-family:var(--body); font-size:17.6px; color:var(--ink);
  padding:12.8px 14.4px;
  background:var(--paper);
  border:1.5px solid var(--line);
  border-radius:8px;
  transition:border-color .15s ease, box-shadow .15s ease;
  -webkit-appearance:none; appearance:none;
}
.frow select{
  background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='none' stroke='%234A5C50' stroke-width='2' stroke-linecap='round'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
  background-repeat:no-repeat; background-position:right 12.8px center; background-size:16px;
  padding-right:38.4px;
}
.frow textarea{ min-height:92px; resize:vertical; }
.frow input:focus,.frow select:focus,.frow textarea:focus{
  outline:0; border-color:var(--brand); box-shadow:0 0 0 3px rgba(44,110,63,.14);
}
.frow input.err,.frow select.err,.frow textarea.err{ border-color:#B3261E; background:#FDF4F3; }
.err-msg{ display:none; font-size:13.376px; color:#B3261E; margin-top:4.8px; }
.frow.has-err .err-msg{ display:block; }

.fnote{ font-size:13.728px; color:var(--ink-faint); text-align:center; margin:14.4px 0 0; }
.fnote a{ color:var(--brand); font-weight:600; text-decoration:none; }
.fnote a:hover{ text-decoration:underline; }

.form-success{
  display:none;
  text-align:center;
  padding:24px 8px;
}
.form-success.on{ display:block; }
.form-success .tick{
  width:58px; height:58px; border-radius:50%;
  background:var(--tint); color:var(--brand);
  display:flex; align-items:center; justify-content:center;
  margin:0 auto 16px;
}
.form-success .tick svg{ width:28px; height:28px; }
.form-success h3{ font-family:var(--display); font-size:24.64px; font-weight:800; margin-bottom:8px; }
.form-success p{ color:var(--ink-soft); font-size:16.72px; }
form.sent{ display:none; }

/* ============================================================
   FACTS BAR
   ============================================================ */
.facts{ background:var(--ink); color:#fff; }
.facts .wrap{
  display:grid; grid-template-columns:repeat(4,1fr);
  padding-top:clamp(25.6px,3vw,36.8px); padding-bottom:clamp(25.6px,3vw,36.8px);
}
.fact{ text-align:center; padding:3.2px clamp(9.6px,1.6vw,25.6px); border-right:1px solid rgba(255,255,255,.15); }
.fact:last-child{ border-right:0; }
.fact .k{
  display:block; font-family:var(--display); font-weight:800;
  font-size:clamp(23.76px,2.31vw,33.44px); letter-spacing:-.025em; line-height:1.15; color:#fff;
}
.fact .v{ display:block; font-size:clamp(14.608px,1.1vw,16.72px); color:#9FD3AE; margin-top:5.6px; }
@media (max-width:820px){
  .facts .wrap{ grid-template-columns:1fr 1fr; gap:22.4px 0; }
  .fact{ border-right:0; }
  .fact:nth-child(odd){ border-right:1px solid rgba(255,255,255,.15); }
}

/* ============================================================
   TURF VARIETIES
   ============================================================ */
.variety-grid{
  display:grid;
  grid-template-columns:repeat(auto-fit,minmax(258px,1fr));
  gap:18px;
}
.v-card{
  background:var(--paper-2);
  border:1px solid var(--line);
  border-radius:14px;
  overflow:hidden;
  display:flex; flex-direction:column;
  transition:border-color .2s ease, transform .2s ease, box-shadow .2s ease;
}
.v-card:hover{ border-color:var(--brand); transform:translateY(-4px); box-shadow:0 18px 40px rgba(22,48,31,.12); }
.v-card .v-img{ position:relative; aspect-ratio:4/3; background:var(--tint); overflow:hidden; }
.v-card .v-img img{ width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
.v-card:hover .v-img img{ transform:scale(1.06); }
.v-tag{
  position:absolute; left:12px; top:12px; z-index:2;
  background:rgba(11,26,16,.82); color:#9FD3AE;
  font-family:var(--mono); font-size:10.912px; letter-spacing:.11em; text-transform:uppercase;
  padding:6.4px 9.6px; border-radius:99px;
}
.v-body{ padding:19.2px 20.8px 22.4px; display:flex; flex-direction:column; flex:1; }
.v-body h3{ margin-bottom:8.8px; }
.v-body p{ font-size:16.192px; color:var(--ink-soft); margin-bottom:16px; }
.v-specs{ list-style:none; margin:0 0 19.2px; padding:0; display:grid; gap:6.4px; }
.v-specs li{ display:flex; gap:8px; align-items:flex-start; font-size:15.136px; color:var(--ink-soft); }
.v-specs svg{ flex:none; width:15px; height:15px; margin-top:4px; color:var(--brand); }
.v-link{
  margin-top:auto;
  display:inline-flex; align-items:center; gap:6.4px;
  font-family:var(--mono); font-size:13.024px; letter-spacing:.1em; text-transform:uppercase;
  font-weight:500; color:var(--brand); text-decoration:none;
}
.v-link:hover{ color:var(--brand-deep); text-decoration:underline; }

/* ============================================================
   SERVICES
   ============================================================ */
.svc-grid{ display:grid; grid-template-columns:repeat(3,1fr); gap:16px; }
@media (max-width:1000px){ .svc-grid{ grid-template-columns:repeat(2,1fr); } }
@media (max-width:640px){ .svc-grid{ grid-template-columns:1fr; } }
.svc{
  background:var(--paper-2);
  border:1px solid var(--line);
  border-radius:14px;
  padding:28.8px 24px;
  text-align:center;
  transition:border-color .2s ease, transform .2s ease, box-shadow .2s ease;
}
.svc:hover{ border-color:var(--brand); transform:translateY(-4px); box-shadow:0 16px 38px rgba(22,48,31,.1); }
.svc-ico{
  width:54px; height:54px; border-radius:12px;
  background:var(--tint); color:var(--brand);
  display:flex; align-items:center; justify-content:center;
  margin:0 auto 17.6px;
  transition:background .2s ease, color .2s ease;
}
.svc:hover .svc-ico{ background:var(--brand); color:#fff; }
.svc-ico svg{ width:26px; height:26px; }
.svc h3{ margin-bottom:8px; }
.svc p{ font-size:16.192px; color:var(--ink-soft); margin:0; }

/* ============================================================
   STEPS
   ============================================================ */
.steps{ display:grid; grid-template-columns:repeat(auto-fit,minmax(230px,1fr)); gap:16px; counter-reset:step; }
.step{
  background:var(--paper-2); border:1px solid var(--line); border-radius:14px;
  padding:27.2px 22.4px; position:relative;
}
.step .n{
  font-family:var(--display); font-size:36.96px; font-weight:800; letter-spacing:-.03em;
  color:var(--brand); opacity:.28; line-height:1; display:block; margin-bottom:11.2px;
}
.step h3{ margin-bottom:7.2px; }
.step p{ font-size:15.84px; color:var(--ink-soft); margin:0; }

/* ============================================================
   GALLERY
   ============================================================ */
.mosaic{ display:grid; grid-template-columns:repeat(3,1fr); gap:12px; }
.mosaic figure{ margin:0; border-radius:10px; overflow:hidden; background:var(--tint); aspect-ratio:4/3; }
.mosaic img{ width:100%; height:100%; object-fit:cover; transition:transform .5s ease; }
.mosaic figure:hover img{ transform:scale(1.05); }
@media (max-width:900px){ .mosaic{ grid-template-columns:repeat(2,1fr); } }
@media (max-width:520px){ .mosaic{ grid-template-columns:1fr; } }

/* ============================================================
   WHY US (split)
   ============================================================ */
.split{ display:grid; grid-template-columns:1fr 1fr; gap:clamp(28.8px,4vw,56px); align-items:center; }
@media (max-width:900px){ .split{ grid-template-columns:1fr; } }
.split-img{ border-radius:14px; overflow:hidden; background:var(--tint); }
.split-img img{ width:100%; height:clamp(320px,42vw,540px); object-fit:cover; }
.why-list{ list-style:none; margin:28.8px 0 0; padding:0; display:grid; gap:19.2px; justify-items:stretch; }
.why-list li{ display:flex; gap:16px; align-items:flex-start; justify-content:flex-start; width:100%; text-align:left; }
.why-list li > div{ flex:1 1 auto; min-width:0; text-align:left; }
.why-ico{
  flex:none; width:44px; height:44px; border-radius:50%;
  background:var(--tint); color:var(--brand);
  display:flex; align-items:center; justify-content:center;
}
.why-ico svg{ width:21px; height:21px; }
.why-list h3{ margin-bottom:4px; }
.why-list p{ font-size:16.192px; color:var(--ink-soft); margin:0; }

/* ============================================================
   REVIEWS
   ============================================================ */
.reviews{ display:grid; grid-template-columns:repeat(auto-fit,minmax(280px,1fr)); gap:16px; }
.review{
  background:var(--paper-2); border:1px solid var(--line); border-radius:14px;
  padding:25.6px 24px; display:flex; flex-direction:column;
}
.review .stars{ margin-bottom:14.4px; }
.review p{ font-size:16.72px; color:var(--ink-soft); margin-bottom:19.2px; }
.review .who{ margin-top:auto; font-weight:600; font-size:16.192px; }
.review .src{ font-family:var(--mono); font-size:11.616px; letter-spacing:.11em; text-transform:uppercase; color:var(--ink-faint); margin-top:3.2px; }

/* ============================================================
   CONTACT (contact info + map + form)
   ============================================================ */
#contact{ background:var(--brand-deep); }
#contact h2{ color:#fff; }
#contact .eyebrow{ color:#9FD3AE; }
#contact .head-p{ color:#DCEBE0; }

.contact-grid{
  display:grid; grid-template-columns:1.05fr .95fr;
  gap:clamp(19.2px,2.4vw,28.8px);
  align-items:start;
}
@media (max-width:900px){ .contact-grid{ grid-template-columns:1fr; } }

.contact-side{ display:flex; flex-direction:column; gap:10px; }
.crow{
  display:flex; align-items:center; gap:14px; text-decoration:none;
  background:var(--paper-2); border:1px solid var(--line); border-radius:12px;
  padding:16.8px 19.2px;
  transition:transform .2s ease, border-color .2s ease;
}
.crow:hover{ transform:translateY(-2px); border-color:var(--brand); }
.crow-ico{
  flex:none; width:44px; height:44px; border-radius:50%;
  background:var(--tint); color:var(--brand);
  display:flex; align-items:center; justify-content:center;
  transition:background .2s ease, color .2s ease;
}
.crow:hover .crow-ico{ background:var(--brand); color:#fff; }
.crow-ico svg{ width:20px; height:20px; }
.crow-k{ display:block; font-family:var(--mono); font-size:11.088px; letter-spacing:.13em; text-transform:uppercase; color:var(--brand); }
.crow-v{ display:block; font-size:17.6px; font-weight:500; margin-top:2.4px; }
.map{ border:0; width:100%; height:300px; border-radius:12px; margin-top:4px; }

.form-card{
  background:var(--paper-2); border:1px solid var(--line); border-radius:14px;
  padding:clamp(24px,3vw,35.2px);
}
.form-card h3{ font-family:var(--display); font-weight:800; font-size:26.4px; margin-bottom:6.4px; }
.form-card .fc-sub{ font-size:16.192px; color:var(--ink-soft); margin-bottom:22.4px; }

/* ============================================================
   STICKY MOBILE CALL BAR
   ============================================================ */
.callbar{ display:none; }
@media (max-width:760px){
  .callbar{
    display:flex; position:fixed; left:0; right:0; bottom:0; z-index:90;
    background:var(--brand); box-shadow:0 -6px 20px rgba(0,0,0,.18);
  }
  .callbar a{
    flex:1; text-align:center; padding:16px 9.6px;
    color:#fff; text-decoration:none; font-weight:700; font-size:16.72px;
    display:flex; align-items:center; justify-content:center; gap:7.2px;
  }
  .callbar a svg{ width:18px; height:18px; }
  .callbar a + a{ border-left:1px solid rgba(255,255,255,.28); background:var(--brand-deep); }
  body{ padding-bottom:60px; }
}

/* ---------- Reveal on scroll ---------- */
.rv{ opacity:0; transform:translateY(18px); transition:opacity .6s ease, transform .6s ease; }
.rv.in{ opacity:1; transform:none; }

@media (prefers-reduced-motion:reduce){
  *{ animation:none !important; transition:none !important; }
  html{ scroll-behavior:auto; }
  .rv{ opacity:1; transform:none; }
}

/* ============================================================
   CONTACT FORM 7 COMPATIBILITY
   CF7 wraps every field in a <p>, which fights the .frow grid.
   Build your CF7 form with the same .f2 / .frow wrappers used by
   the fallback form and these few rules do the rest.
   ============================================================ */
.lead-card .wpcf7 form.wpcf7-form,
.form-card .wpcf7 form.wpcf7-form{ margin:0; }
.lead-card .frow p,
.form-card .frow p,
.lead-card .wpcf7-form > p,
.form-card .wpcf7-form > p{ margin:0; }
/* CF7 runs the form content through autop, which drops a <br> after every
   row and, fatally, between the submit and its arrow span, stacking them. */
.lead-card .wpcf7-form br,
.form-card .wpcf7-form br{ display:none; }
.atf-lp-page .cf7-submit p{ display:contents; margin:0; }
.lead-card .wpcf7-form-control-wrap,
.form-card .wpcf7-form-control-wrap{ display:block; }
.lead-card .wpcf7-not-valid-tip,
.form-card .wpcf7-not-valid-tip{ font-size:12.672px; color:#B3261E; margin-top:4.8px; display:block; }
.lead-card .wpcf7-form-control.wpcf7-not-valid,
.form-card .wpcf7-form-control.wpcf7-not-valid{ border-color:#B3261E; background:#FDF4F3; }
.lead-card .wpcf7 .wpcf7-response-output,
.form-card .wpcf7 .wpcf7-response-output{
  margin:16px 0 0; padding:11.2px 14.4px; border-radius:8px;
  font-size:13.728px; border-width:1px;
}
.lead-card .wpcf7-spinner,
.form-card .wpcf7-spinner{ margin:9.6px auto 0; display:block; }
/* CF7 renders the submit as an <input>, which cannot hold the arrow span.
   Keep the fill, the glow and the lift; the arrow is dropped on these. */
.lead-card input.wpcf7-submit,
.form-card input.wpcf7-submit{
  width:100%; justify-content:center;
  padding:21.12px 33.6px;
  border:0; border-radius:var(--r);
  background:var(--brand); color:#fff;
  font-family:var(--body); font-size:17.248px; font-weight:700; letter-spacing:.01em;
  cursor:pointer;
  animation:atfGlow 4.2s ease-in-out infinite;
  transition:transform .25s ease, box-shadow .25s ease, background .25s ease;
}
.lead-card input.wpcf7-submit:hover,
.form-card input.wpcf7-submit:hover{
  background:var(--brand-deep); transform:translateY(-2px); animation:none;
  box-shadow:
    0 0 26px -2px rgba(122,199,140,.75),
    0 0 56px -4px rgba(44,110,63,.60),
    0 18px 38px -14px rgba(27,68,40,.95);
}

/* ---------- CF7: label wrapping its own control ----------
   The same form is output twice on this page (hero + contact), so the
   fields cannot carry id: attributes; duplicate ids would make a label
   in the contact form focus the hero field. Wrapping the control inside
   its <label> associates them implicitly, with no ids at all. */
.lead-card .frow label,
.form-card .frow label{ margin-bottom:0; font-weight:600; }
.lead-card .frow label .wpcf7-form-control-wrap,
.form-card .frow label .wpcf7-form-control-wrap{ display:block; margin-top:5.6px; font-weight:400; }

/* ---------- CF7 submit ----------
   CF7 renders the submit as an <input>, and an <input> renders no
   ::before and can hold no arrow span. Left to itself it would inherit
   .btn-primary's white background AND white text, so the label would
   vanish. The wrapper becomes the button instead: it carries the fill,
   the glow, the retract and the arrow, and the input sits inside as
   nothing but the label text. */
.atf-lp-page .cf7-submit{
  position:relative; isolation:isolate; overflow:hidden;
  display:flex; align-items:center; justify-content:space-between; gap:14px;
  width:100%; margin-top:6.4px;
  padding:9.5px 9.5px 9.5px 33.5px;
  border-radius:var(--r);
  background:#fff;
  cursor:pointer;
  box-shadow:
    0 0 18px -3px rgba(90,174,110,.58),
    0 0 38px -6px rgba(44,110,63,.44),
    0 12px 30px -14px rgba(27,68,40,.85);
  animation:atfGlow 4.2s ease-in-out infinite;
  transition:transform .25s ease, box-shadow .25s ease;
}
.atf-lp-page .cf7-submit::before{
  content:""; position:absolute; z-index:-1;
  top:-2px; right:-2px; bottom:-2px; left:-2px;
  background:var(--brand); border-radius:calc(var(--r) + 2px);
  transition:left .5s cubic-bezier(.65,.05,.25,1), top .5s cubic-bezier(.65,.05,.25,1),
             right .5s cubic-bezier(.65,.05,.25,1), bottom .5s cubic-bezier(.65,.05,.25,1),
             border-radius .5s cubic-bezier(.65,.05,.25,1);
}
.atf-lp-page .cf7-submit:hover,
.atf-lp-page .cf7-submit:focus-within{
  transform:translateY(-2px); animation:none;
  box-shadow:
    0 0 26px -2px rgba(122,199,140,.75),
    0 0 56px -4px rgba(44,110,63,.60),
    0 18px 38px -14px rgba(27,68,40,.95);
}
.atf-lp-page .cf7-submit:hover::before,
.atf-lp-page .cf7-submit:focus-within::before{
  /* 46px square centred on the arrow, whatever height the button ends up:
     deriving it from the padding made it an ellipse as soon as the label wrapped */
  left:calc(100% - 55.5px); right:9.5px;
  top:calc(50% - 23px); bottom:calc(50% - 23px);
  border-radius:50%;
}
.lead-card .cf7-submit input.wpcf7-submit,
.form-card .cf7-submit input.wpcf7-submit{
  flex:0 1 auto; width:auto;
  background:none; border:0; padding:0; margin:0;
  box-shadow:none; animation:none;
  font-family:var(--body); font-size:18.656px; font-weight:700;
  letter-spacing:.01em; line-height:1.2;
  color:#fff; text-align:left; cursor:pointer;
  transition:color .35s ease;
}
.lead-card .cf7-submit:hover input.wpcf7-submit,
.form-card .cf7-submit:hover input.wpcf7-submit{
  color:var(--brand); background:none; transform:none;
}
.atf-lp-page .cf7-submit:hover .btn-arrow svg{ transform:translateX(2px); }
.lead-card .cf7-submit .wpcf7-spinner,
.form-card .cf7-submit .wpcf7-spinner{
  position:absolute; right:64px; top:50%; transform:translateY(-50%); margin:0;
}
@media (max-width:560px){
  .atf-lp-page .cf7-submit{ padding:8.5px 8.5px 8.5px 23.5px; }
  .atf-lp-page .cf7-submit:hover::before,
  .atf-lp-page .cf7-submit:focus-within::before{
    left:calc(100% - 48.5px); right:8.5px;
    top:calc(50% - 20px); bottom:calc(50% - 20px);
  }
  .lead-card .cf7-submit input.wpcf7-submit,
  .form-card .cf7-submit input.wpcf7-submit{ font-size:16.192px; }
  .atf-lp-page .cf7-submit .btn-arrow{ width:40px; height:40px; }
}

/* ============================================================
   THEME RESET

   The parent and child themes style headings, paragraphs and the
   root font size globally, and some of their selectors outrank a
   bare element selector. These rules win those specific fights
   without outranking the landing page's own section styles.

   Colour and paragraph rules use :where(), which contributes zero
   specificity, so `.hero h1 { color:#fff }` and friends still win.
   Getting this wrong turns the hero heading dark on a dark image.
   ============================================================ */

/* The child theme sets a fluid root font-size that the site header and
   footer are built on. Overriding it here inflated the nav until it
   wrapped, so every length on this page is absolute instead and the
   root is left exactly as the theme set it. */

/* .custom-background outranks a bare body selector */
body.atf-lp{ background:var(--paper); }

/* the child theme's `body h1` outranks a bare `h1`, so match its weight */
.atf-lp-page h1, .atf-lp-page h2, .atf-lp-page h3, .atf-lp-page h4{ font-family:var(--display); }
.atf-lp-page a, .atf-lp-page p, .atf-lp-page li, .atf-lp-page label,
.atf-lp-page input, .atf-lp-page select, .atf-lp-page textarea, .atf-lp-page button{ font-family:var(--body); }
.atf-lp-page .eyebrow, .atf-lp-page .sub, .atf-lp-page .crow-k,
.atf-lp-page .v-tag, .atf-lp-page .v-link, .atf-lp-page .review .src,
.atf-lp-page .lc-top .sub{ font-family:var(--mono); }

/* zero-specificity defaults: they beat the theme, and lose to everything of ours */
:where(.atf-lp-page) h1, :where(.atf-lp-page) h2,
:where(.atf-lp-page) h3, :where(.atf-lp-page) h4{ color:var(--ink); margin:0; }
:where(.atf-lp-page) p{ color:inherit; font-size:inherit; line-height:inherit; margin:0 0 16px; }
:where(.atf-lp-page) ul, :where(.atf-lp-page) ol{ margin:0; padding:0; list-style:none; }
:where(.atf-lp-page) li{ font-size:inherit; line-height:inherit; color:inherit; }
:where(.atf-lp-page) a{ color:inherit; text-decoration:none; }
:where(.atf-lp-page) figure{ margin:0; }
:where(.atf-lp-page) img{ height:auto; }

/* The theme may wrap page content in #content > .corp-container, which is
   width-limited. Our sections run full bleed and handle their own gutters.
   Scoped to #content so the header and footer keep their own containers. */
body.atf-lp #content,
body.atf-lp #content .corp-container,
body.atf-lp #content .site-content{
  max-width:none; width:auto; margin:0; padding:0;
}
/* Same again keyed on :has(), so a missing body class cannot leave the
   page trapped in the theme's 87.8%-wide .corp-container. Only containers
   that actually hold this page match, so the header and footer keep theirs. */
#content:has(.atf-lp-page),
.site-content:has(.atf-lp-page),
.corp-container:has(.atf-lp-page){
  max-width:none; width:auto;
  margin-left:0; margin-right:0;
  padding-left:0; padding-right:0;
}

/* ============================================================
   CHILD THEME COLLISIONS

   arrow-turf-home.css is enqueued site-wide and was written for the
   homepage build, which uses these same class names. Two of its rules
   outrank this page's:

     .hero-cta .btn { justify-content:center; ... }   (0,2,0)
     .atf-lp-page .btn-primary{ color:#fff !important }

   The first centred the banner CTA's label and arrow while the fill
   still collapsed to the right edge, so the arrow sat off the circle.
   The second kept the label white on hover instead of turning green.

   Re-asserted here with enough specificity to win. Everything else on
   the page is unaffected, which is why only the banner CTA misbehaved.
   ============================================================ */
.atf-lp-page .hero-cta .btn-primary{
  justify-content:space-between;
  min-width:250px;
  padding:9.5px 9.5px 9.5px 33.5px;
  border-radius:var(--r);
  font-size:18.656px;
  letter-spacing:.01em;
}
/* A :hover pseudo-class carries class weight, so the child theme's
   .atf-lp-page .btn-primary:hover{ background:var(--ink) } at (0,2,0) outranks this
   page's base .btn-primary at (0,1,0) and the pill revealed under the
   retracting fill comes back dark green. */
.atf-lp-page .btn-primary{
  background:#fff;
}
.atf-lp-page .btn-primary:hover,
.atf-lp-page .btn-primary:focus-visible{
  background:#fff;
  color:var(--brand) !important;
}
.atf-lp-page .hero-cta .btn-primary:hover,
.atf-lp-page .hero-cta .btn-primary:focus-visible{
  transform:translateY(-2px);
  box-shadow:
    0 0 26px -2px rgba(122,199,140,.75),
    0 0 56px -4px rgba(44,110,63,.60),
    0 18px 38px -14px rgba(27,68,40,.95);
}
@media (max-width:560px){
  .atf-lp-page .hero-cta .btn-primary{
    min-width:0; width:100%;
    padding:8.5px 8.5px 8.5px 23.5px;
    font-size:16.192px;
  }
}

/* The note under the hero form sits too close to the button. */
.atf-lp-page .hf-note{
  font-size:13.728px; color:var(--ink-faint); text-align:center;
  margin:22.4px 0 0;
}
.atf-lp-page .hf-note a{ color:var(--brand); font-weight:600; text-decoration:none; }
.atf-lp-page .hf-note a:hover{ text-decoration:underline; }

/* ============================================================
   ADDITIONAL CSS (Customiser) COLLISIONS

   The site's Additional CSS carries a block written for the inner
   pages that this landing page matches by accident, because it is
   body:not(.home) and its contact section is #contact:

     body:not(.home) #contact .form-card p     { margin:0 0 16px !important }
     body:not(.home) #contact .form-card label { line-height:36px !important }

   CF7 wraps every row in a <p>, so that margin stacked on top of
   .frow's own 13.6px and left a large gap between every field. The
   36px line-height did the same above each input.

   Those selectors are (1,2,2). These are (1,3,1), which outranks them.
   ============================================================ */
.atf-lp-page #contact .form-card .wpcf7-form p,
.atf-lp-page #contact .lead-card .wpcf7-form p,
.atf-lp-page #contact .form-card .wpcf7-form br{
  margin:0 !important;
}
.atf-lp-page #contact .form-card .frow label,
.atf-lp-page #contact .form-card .wpcf7-form label{
  line-height:1.3 !important;
  margin-bottom:0 !important;
}
.atf-lp-page #contact .form-card .frow label .wpcf7-form-control-wrap{
  margin-top:5.6px !important;
}
/* and the same for the hero card, which sits outside #contact */
.atf-lp-page .lead-card .wpcf7-form p{ margin:0 !important; }
.atf-lp-page .lead-card .wpcf7-form label{ line-height:1.3 !important; margin-bottom:0 !important; }

/* Their block also pins the contact form's type smaller than the hero's,
   and hits the submit with padding:19.2px 88px. That selector is
   body:not(.home) #contact .form-card .wpcf7-submit = (1,3,1) !important,
   so the override below is (1,4,1) to clear it. */
.atf-lp-page #contact .form-card .frow label,
.atf-lp-page #contact .form-card .wpcf7-form label{
  font-size:13.728px !important;
}
.atf-lp-page #contact .form-card .wpcf7-form input:not([type=submit]),
.atf-lp-page #contact .form-card .wpcf7-form select,
.atf-lp-page #contact .form-card .wpcf7-form textarea{
  font-size:17.6px !important;
  padding:12.8px 14.4px !important;
}
.atf-lp-page #contact .form-card .cf7-submit input.wpcf7-submit,
.atf-lp-page #contact .form-card .cf7-submit input[type=submit]{
  font-size:18.656px !important;
  line-height:1.2 !important;
  padding:0 !important;
  border-radius:0 !important;
  background:none !important;
  width:auto !important;
}
</style>
	<?php
}, 999 ); /* after wp_custom_css_cb, which WordPress hooks at 101 */

get_header();
?>

<div class="atf-lp-page">


<!-- ============================ HERO ============================ -->
<header class="hero">
	<?php if ( $atf_hero['image']['url'] ) : ?>
		<img class="hero-bg" src="<?php echo esc_url( $atf_hero['image']['url'] ); ?>"
		     alt="<?php echo esc_attr( $atf_hero['image']['alt'] ); ?>"
		     <?php if ( $atf_hero['image']['w'] ) : ?>width="<?php echo esc_attr( $atf_hero['image']['w'] ); ?>" height="<?php echo esc_attr( $atf_hero['image']['h'] ); ?>"<?php endif; ?>
		     fetchpriority="high" decoding="async">
	<?php endif; ?>

	<div class="hero-in">
		<div class="wrap hero-grid">

			<div>
				<?php if ( $atf_hero['eyebrow'] ) : ?>
					<p class="eyebrow"><?php echo wp_kses_post( $atf_hero['eyebrow'] ); ?></p>
				<?php endif; ?>

				<h1><?php echo wp_kses_post( $atf_hero['heading'] ); ?></h1>

				<?php if ( $atf_hero['lede'] ) : ?>
					<p class="hero-lede"><?php echo wp_kses_post( $atf_hero['lede'] ); ?></p>
				<?php endif; ?>

				<?php if ( $atf_ticks ) : ?>
					<ul class="hero-ticks">
						<?php foreach ( $atf_ticks as $tick ) : ?>
							<li><?php echo $atf_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
								<span><?php echo wp_kses_post( $tick ); ?></span></li>
						<?php endforeach; ?>
					</ul>
				<?php endif; ?>

				<div class="hero-cta">
					<a class="btn btn-primary btn-lg" href="#lead-form">
						<?php echo wp_kses_post( $atf_hero['cta'] ); ?>
						<span class="btn-arrow" aria-hidden="true"><?php echo $atf_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
					</a>
					<a class="btn btn-light btn-lg" href="<?php echo esc_url( $atf_tel ); ?>">
						<?php echo $atf_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<?php echo esc_html( $atf_phone_txt ); ?>
					</a>
				</div>

				<?php if ( $atf_hero['rating'] ) : ?>
					<div class="hero-rating">
						<?php echo atf_lp_stars(); // phpcs:ignore WordPress.Security.EscapeOutput ?>
						<span><?php echo wp_kses_post( $atf_hero['rating'] ); ?></span>
					</div>
				<?php endif; ?>
			</div>

			<div class="lead-card" id="lead-form">
				<div class="lc-top">
					<h2><?php echo wp_kses_post( $atf_hero['f_title'] ); ?></h2>
					<?php if ( $atf_hero['f_sub'] ) : ?>
						<p class="sub"><?php echo wp_kses_post( $atf_hero['f_sub'] ); ?></p>
					<?php endif; ?>
				</div>

				<div class="lc-body">
					<?php if ( $atf_hero['f_code'] ) : ?>
						<?php echo do_shortcode( $atf_hero['f_code'] ); ?>
					<?php else : ?>
						<?php atf_lp_fallback_form( 'h', $atf_hero['cta'] ); ?>
					<?php endif; ?>

					<?php if ( $atf_hero['f_note'] ) : ?>
						<p class="hf-note">
							<?php echo wp_kses_post( $atf_hero['f_note'] ); ?>
							<a href="<?php echo esc_url( $atf_tel ); ?>"><?php echo esc_html( $atf_phone_txt ); ?></a>
						</p>
					<?php endif; ?>

					<?php atf_lp_thanks( $atf_thanks_t, $atf_thanks_x, $atf_tel, $atf_phone_txt ); ?>
				</div>
			</div>

		</div>
	</div>
</header>

<!-- ============================ FACTS ============================ -->
<?php if ( $atf_facts ) : ?>
<div class="facts">
	<div class="wrap">
		<?php foreach ( $atf_facts as $fact ) : ?>
			<div class="fact">
				<span class="k"><?php echo wp_kses_post( $fact['k'] ); ?></span>
				<span class="v"><?php echo wp_kses_post( $fact['v'] ); ?></span>
			</div>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>

<!-- ============================ VARIETIES ============================ -->
<section id="varieties">
	<div class="wrap">
		<div class="head center rv">
			<p class="eyebrow"><?php echo wp_kses_post( atf_lp_get( 'varieties_eyebrow', $atf_var['eyebrow'] ) ); ?></p>
			<h2><?php echo wp_kses_post( atf_lp_get( 'varieties_heading', $atf_var['heading'] ) ); ?></h2>
			<p class="head-p"><?php echo wp_kses_post( atf_lp_get( 'varieties_intro', $atf_var['intro'] ) ); ?></p>
		</div>

		<div class="variety-grid rv">
			<?php foreach ( $atf_var_rows as $item ) :
				$img  = atf_lp_image( isset( $item['image'] ) ? $item['image'] : '', '', isset( $item['title'] ) ? $item['title'] : '', 'medium_large' );
				$href = ! empty( $item['link'] ) ? $item['link'] : '#lead-form';
				?>
				<article class="v-card">
					<?php if ( $img['url'] ) : ?>
						<div class="v-img">
							<?php if ( ! empty( $item['tag'] ) ) : ?>
								<span class="v-tag"><?php echo wp_kses_post( $item['tag'] ); ?></span>
							<?php endif; ?>
							<img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" loading="lazy" decoding="async">
						</div>
					<?php endif; ?>
					<div class="v-body">
						<h3><?php echo wp_kses_post( $item['title'] ); ?></h3>
						<p><?php echo wp_kses_post( $item['text'] ); ?></p>
						<?php $specs = atf_lp_lines( isset( $item['specs'] ) ? $item['specs'] : '' ); ?>
						<?php if ( $specs ) : ?>
							<ul class="v-specs">
								<?php foreach ( $specs as $spec ) : ?>
									<li><?php echo $atf_icon( 'check' ); // phpcs:ignore WordPress.Security.EscapeOutput ?><?php echo wp_kses_post( $spec ); ?></li>
								<?php endforeach; ?>
							</ul>
						<?php endif; ?>
						<a class="v-link" href="<?php echo esc_url( $href ); ?>">Get a price &rarr;</a>
					</div>
				</article>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============================ SERVICES ============================ -->
<section id="services" class="band-white">
	<div class="wrap">
		<div class="head center rv">
			<p class="eyebrow"><?php echo wp_kses_post( atf_lp_get( 'services_eyebrow', $atf_svc['eyebrow'] ) ); ?></p>
			<h2><?php echo wp_kses_post( atf_lp_get( 'services_heading', $atf_svc['heading'] ) ); ?></h2>
			<p class="head-p"><?php echo wp_kses_post( atf_lp_get( 'services_intro', $atf_svc['intro'] ) ); ?></p>
		</div>

		<div class="svc-grid rv">
			<?php foreach ( $atf_svc_rows as $item ) : ?>
				<div class="svc">
					<div class="svc-ico"><?php echo $atf_icon( isset( $item['icon'] ) ? $item['icon'] : 'truck' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></div>
					<h3><?php echo wp_kses_post( $item['title'] ); ?></h3>
					<p><?php echo wp_kses_post( $item['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>

		<div style="display:flex; justify-content:center; margin-top:2.2rem;">
			<a class="btn btn-primary btn-lg" href="#lead-form">
				<?php echo wp_kses_post( atf_lp_get( 'services_cta_label', $atf_svc['cta_label'] ) ); ?>
				<span class="btn-arrow" aria-hidden="true"><?php echo $atf_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
			</a>
		</div>
	</div>
</section>

<!-- ============================ WHY US ============================ -->
<section id="why">
	<div class="wrap split rv">
		<?php if ( $atf_why_img['url'] ) : ?>
			<div class="split-img">
				<img src="<?php echo esc_url( $atf_why_img['url'] ); ?>" alt="<?php echo esc_attr( $atf_why_img['alt'] ); ?>" loading="lazy" decoding="async">
			</div>
		<?php endif; ?>

		<div>
			<p class="eyebrow"><?php echo wp_kses_post( atf_lp_get( 'why_eyebrow', $atf_why['eyebrow'] ) ); ?></p>
			<h2><?php echo wp_kses_post( atf_lp_get( 'why_heading', $atf_why['heading'] ) ); ?></h2>
			<p class="head-p"><?php echo wp_kses_post( atf_lp_get( 'why_intro', $atf_why['intro'] ) ); ?></p>

			<ul class="why-list">
				<?php foreach ( $atf_why_rows as $item ) : ?>
					<li>
						<span class="why-ico"><?php echo $atf_icon( isset( $item['icon'] ) ? $item['icon'] : 'medal' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<div>
							<h3><?php echo wp_kses_post( $item['title'] ); ?></h3>
							<p><?php echo wp_kses_post( $item['text'] ); ?></p>
						</div>
					</li>
				<?php endforeach; ?>
			</ul>

			<div style="margin-top:2rem;">
				<a class="btn btn-primary btn-lg" href="#lead-form">
					<?php echo wp_kses_post( atf_lp_get( 'why_cta_label', $atf_why['cta_label'] ) ); ?>
					<span class="btn-arrow" aria-hidden="true"><?php echo $atf_icon( 'arrow' ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
				</a>
			</div>
		</div>
	</div>
</section>

<!-- ============================ HOW IT WORKS ============================ -->
<section id="how" class="band-tint">
	<div class="wrap">
		<div class="head center rv">
			<p class="eyebrow"><?php echo wp_kses_post( atf_lp_get( 'how_eyebrow', $atf_how['eyebrow'] ) ); ?></p>
			<h2><?php echo wp_kses_post( atf_lp_get( 'how_heading', $atf_how['heading'] ) ); ?></h2>
		</div>

		<div class="steps rv">
			<?php foreach ( $atf_how_rows as $i => $item ) : ?>
				<div class="step">
					<span class="n"><?php echo esc_html( str_pad( $i + 1, 2, '0', STR_PAD_LEFT ) ); ?></span>
					<h3><?php echo wp_kses_post( $item['title'] ); ?></h3>
					<p><?php echo wp_kses_post( $item['text'] ); ?></p>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============================ GALLERY ============================ -->
<section id="projects" class="band-white">
	<div class="wrap">
		<div class="head center rv">
			<p class="eyebrow"><?php echo wp_kses_post( atf_lp_get( 'projects_eyebrow', $atf_prj['eyebrow'] ) ); ?></p>
			<h2><?php echo wp_kses_post( atf_lp_get( 'projects_heading', $atf_prj['heading'] ) ); ?></h2>
			<p class="head-p"><?php echo wp_kses_post( atf_lp_get( 'projects_intro', $atf_prj['intro'] ) ); ?></p>
		</div>

		<div class="mosaic rv">
			<?php foreach ( $atf_gallery as $shot ) :
				$img = atf_lp_image( $shot, '', 'Turf supplied and installed by Arrow Turf', 'large' );
				if ( ! $img['url'] ) {
					continue;
				}
				?>
				<figure><img src="<?php echo esc_url( $img['url'] ); ?>" alt="<?php echo esc_attr( $img['alt'] ); ?>" loading="lazy" decoding="async"></figure>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============================ REVIEWS ============================ -->
<section id="reviews">
	<div class="wrap">
		<div class="head center rv">
			<p class="eyebrow"><?php echo wp_kses_post( atf_lp_get( 'reviews_eyebrow', $atf_rev['eyebrow'] ) ); ?></p>
			<h2><?php echo wp_kses_post( atf_lp_get( 'reviews_heading', $atf_rev['heading'] ) ); ?></h2>
		</div>

		<div class="reviews rv">
			<?php foreach ( $atf_rev_rows as $item ) : ?>
				<div class="review">
					<?php echo atf_lp_stars( '5 out of 5 stars' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
					<p>&ldquo;<?php echo wp_kses_post( $item['quote'] ); ?>&rdquo;</p>
					<span class="who"><?php echo wp_kses_post( $item['name'] ); ?></span>
					<span class="src"><?php echo wp_kses_post( $item['source'] ); ?></span>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
</section>

<!-- ============================ CONTACT ============================ -->
<section id="contact">
	<div class="wrap">
		<div class="head center rv">
			<p class="eyebrow"><?php echo wp_kses_post( atf_lp_get( 'contact_eyebrow', $atf_con['eyebrow'] ) ); ?></p>
			<h2><?php echo wp_kses_post( atf_lp_get( 'contact_heading', $atf_con['heading'] ) ); ?></h2>
			<p class="head-p"><?php echo wp_kses_post( atf_lp_get( 'contact_intro', $atf_con['intro'] ) ); ?></p>
		</div>

		<div class="contact-grid rv">

			<div class="form-card">
				<h3><?php echo wp_kses_post( atf_lp_get( 'contact_form_title', $atf_con['form_title'] ) ); ?></h3>
				<p class="fc-sub"><?php echo wp_kses_post( atf_lp_get( 'contact_form_sub', $atf_con['form_sub'] ) ); ?></p>

				<?php $atf_c_code = atf_lp_get( 'contact_form_shortcode', $atf_con['form_shortcode'] ); ?>
				<?php if ( $atf_c_code ) : ?>
					<?php echo do_shortcode( $atf_c_code ); ?>
				<?php else : ?>
					<?php atf_lp_fallback_form( 'c', atf_lp_get( 'hero_cta_label', $atf_d['hero']['cta_label'] ), true ); ?>
				<?php endif; ?>

				<?php $atf_c_note = atf_lp_get( 'contact_form_note', $atf_con['form_note'] ); ?>
				<?php if ( $atf_c_note ) : ?>
					<p class="fnote"><?php echo wp_kses_post( $atf_c_note ); ?></p>
				<?php endif; ?>

				<?php atf_lp_thanks( $atf_thanks_t, $atf_thanks_x, $atf_tel, $atf_phone_txt ); ?>
			</div>

			<div class="contact-side">
				<?php foreach ( $atf_crows as $row ) :
					$tag = ! empty( $row['url'] ) ? 'a' : 'div';
					?>
					<<?php echo esc_attr( $tag ); ?> class="crow"<?php if ( ! empty( $row['url'] ) ) : ?> href="<?php echo esc_url( $row['url'] ); ?>"<?php else : ?> style="cursor:default;"<?php endif; ?>>
						<span class="crow-ico"><?php echo $atf_icon( $row['icon'] ); // phpcs:ignore WordPress.Security.EscapeOutput ?></span>
						<span>
							<span class="crow-k"><?php echo wp_kses_post( $row['label'] ); ?></span>
							<span class="crow-v"><?php echo wp_kses_post( $row['value'] ); ?></span>
						</span>
					</<?php echo esc_attr( $tag ); ?>>
				<?php endforeach; ?>

				<?php $atf_map = atf_lp_get( 'contact_map_src', $atf_con['map_src'] ); ?>
				<?php if ( $atf_map ) : ?>
					<iframe class="map" title="Arrow Turf farm location" loading="lazy"
					        referrerpolicy="no-referrer-when-downgrade"
					        src="<?php echo esc_url( $atf_map ); ?>"></iframe>
				<?php endif; ?>
			</div>

		</div>
	</div>
</section>

<!-- ============================ STICKY MOBILE BAR ============================ -->
<div class="callbar">
	<a href="<?php echo esc_url( $atf_tel ); ?>">
		<?php echo $atf_icon( 'phone' ); // phpcs:ignore WordPress.Security.EscapeOutput ?>
		<?php echo esc_html( atf_lp_get( 'callbar_call_label', $atf_d['callbar']['call_label'] ) ); ?>
	</a>
	<a href="#lead-form"><?php echo esc_html( atf_lp_get( 'callbar_cta_label', $atf_d['callbar']['cta_label'] ) ); ?></a>
</div>

<script>
(function () {
  "use strict";

  /* Reveal on scroll */
  var revealables = document.querySelectorAll(".rv");
  if ("IntersectionObserver" in window) {
    var io = new IntersectionObserver(function (entries) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) { entry.target.classList.add("in"); io.unobserve(entry.target); }
      });
    }, { rootMargin: "0px 0px -8% 0px", threshold: 0.08 });
    revealables.forEach(function (el) { io.observe(el); });
  } else {
    revealables.forEach(function (el) { el.classList.add("in"); });
  }

  /* Validation for the built-in fallback forms only. Contact Form 7 does its
     own validation and submission, and never carries the .atf-form class. */
  var EMAIL = /^[^\s@]+@[^\s@]+\.[^\s@]{2,}$/;

  function clearError(field) {
    var row = field.closest(".frow");
    if (row) { row.classList.remove("has-err"); }
    field.classList.remove("err");
  }
  function markError(field) {
    var row = field.closest(".frow");
    if (row) { row.classList.add("has-err"); }
    field.classList.add("err");
  }
  function validate(form) {
    var ok = true, first = null;
    form.querySelectorAll("[required]").forEach(function (field) {
      var value = field.value.trim(), valid = value !== "";
      if (valid && field.type === "email") { valid = EMAIL.test(value); }
      if (valid && field.type === "tel") { valid = value.replace(/[^0-9]/g, "").length >= 8; }
      if (valid) { clearError(field); }
      else { markError(field); ok = false; if (!first) { first = field; } }
    });
    if (first) { first.focus(); }
    return ok;
  }

  document.querySelectorAll(".atf-form").forEach(function (form) {
    form.addEventListener("input", function (e) {
      if (e.target.classList.contains("err")) { clearError(e.target); }
    });
    form.addEventListener("submit", function (e) {
      e.preventDefault();
      if (!validate(form)) { return; }
      form.classList.add("sent");
      var success = form.parentNode.querySelector(".form-success");
      if (success) {
        success.classList.add("on");
        success.scrollIntoView({ behavior: "smooth", block: "center" });
      }
    });
  });
})();
</script>

</div><!-- .atf-lp-page -->

<?php get_footer(); ?>
