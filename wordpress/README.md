# Arrow Turf landing page: WordPress install

Four files for the `siteorigin-corp-child` theme. The template renders correctly
before the seeder runs, so nothing is ever half-built on screen.

```
wp-content/themes/siteorigin-corp-child/
├── page-arrow-turf-lp.php            template (markup + CSS)
└── inc/
    ├── arrow-turf-lp-content.php     default copy + shared helpers
    ├── acf-arrow-turf-lp.php         ACF field group
    └── arrow-turf-lp-seeder.php      one-time seeder (delete after running)
```

`arrow-turf-lp-content.php` is the single source of truth for the copy: the
template falls back to it field by field, and the seeder writes the same values
into ACF. Change the copy in one place and both follow.

## 1. Upload

Copy the four files to the paths above.

## 2. Wire them into `functions.php`

```php
/* Arrow Turf landing page */
require_once get_stylesheet_directory() . '/inc/arrow-turf-lp-content.php';
require_once get_stylesheet_directory() . '/inc/acf-arrow-turf-lp.php';
require_once get_stylesheet_directory() . '/inc/arrow-turf-lp-seeder.php'; // remove after seeding

/**
 * The landing page ships its own CSS and wants no theme chrome. Drop the
 * parent theme's stylesheets on this template only.
 */
add_action( 'wp_enqueue_scripts', function () {
	if ( ! is_page_template( 'page-arrow-turf-lp.php' ) ) {
		return;
	}
	wp_dequeue_style( 'siteorigin-corp-style' );
	wp_dequeue_style( 'siteorigin-corp-child-style' );
	wp_dequeue_style( 'siteorigin-corp-icons' );
}, 100 );
```

## 3. Run the seeder

Load any admin page. The seeder creates **Instant Turf Sydney**
(`/instant-turf-sydney/`) as a **draft**, assigns the template and writes every
field. An admin notice confirms how many fields and repeater rows were written
and links to the page.

- The seeder never overwrites a field that already has a value, so a re-run only
  fills in what is still empty.
- Re-run over existing values: `/wp-admin/?atf_lp_seed=force` (administrators only)
- WP-CLI: `wp atf-lp seed [--force]`
- To publish immediately instead of drafting, change `ATF_LP_SEED_STATUS` at the
  top of the seeder before running it.

Then delete `inc/arrow-turf-lp-seeder.php` and its `require_once` line.

### What gets seeded

All 77 fields, including all nine repeaters:

| Repeater | Field | Rows |
|---|---|---|
| Hero trust ticks | `atf_hero_ticks` | 3 |
| Facts bar | `atf_facts` | 4 |
| Turf varieties | `atf_varieties` | 5 |
| Services | `atf_services` | 6 |
| Why Arrow Turf | `atf_why_items` | 4 |
| How it works | `atf_how_items` | 4 |
| Reviews | `atf_reviews` | 3 |
| Contact rows | `atf_contact_rows` | 4 |
| Project gallery | `atf_projects_gallery` | 6 images |

Images are matched to your media library by URL. The seeder tries the exact URL,
then the un-sized original, then the filename alone, so it still works if the
site has changed domain. Anything it cannot resolve is left empty and the
template falls back to the live URL, so no image ever disappears.

## 4. Forms

Both forms default to `[contact-form-7 id="fa9bd4f" title="Google Ads Form"]`,
which lives in `arrow-turf-lp-content.php`, so it renders whether or not the ACF
field holds anything. To use a different form on either, paste its shortcode into
the matching field:

- Hero: **Hero → Contact Form 7 shortcode**
- Bottom: **Contact → Contact Form 7 shortcode**

Clear a field entirely and the template renders a built-in fallback form instead.
That fallback validates and shows the thank-you panel, but **it does not send
anything**, so leave the CF7 shortcode in place for anything taking paid traffic.

Build the CF7 form with the same wrappers the fallback uses and it will match
the design with no extra CSS:

```
<div class="f2">
  <div class="frow">
    <label for="lp-name">Your name *</label>
    [text* your-name id:lp-name autocomplete:name]
  </div>
  <div class="frow">
    <label for="lp-phone">Phone *</label>
    [tel* your-phone id:lp-phone autocomplete:tel]
  </div>
</div>
...
[submit class:btn class:btn-primary class:btn-block "BOOK YOUR CONSULTATION HERE"]
```

CF7 renders the submit as an `<input>`, which cannot hold the arrow icon. Those
buttons keep the green fill, the glow and the hover lift, but have no arrow.
If you want the arrow on the CF7 submit too, swap it for
`[submit_button]`-style markup or use a `<button>` via a CF7 form-tag plugin.

## Notes

- **No header or footer by design.** `wp_head()` and `wp_footer()` still fire,
  so GTM, CF7 and anything else hooked in keeps working.
- **Icons** are inline SVG chosen by key from a select, not stored in the
  database. Add new ones to `atf_lp_icon()` in the content file and to the
  matching `choices` array in the ACF file.
- **Variety spec bullets** are one per line in a textarea.
- **Editing after seeding** happens entirely in ACF. The template only falls
  back to the shipped copy for fields left empty.
- The page is set to `noindex` in the static build but **not** here: WordPress
  and Yoast control indexing, so set it in the Yoast sidebar if you want the
  landing page kept out of search.
