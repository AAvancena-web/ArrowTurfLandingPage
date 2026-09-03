# Arrow Turf — Google Ads Landing Page

A single, self-contained landing page built for paid search traffic.
Everything (CSS, JS, SVG icons) lives inside `index.html` — no build step,
no dependencies beyond Google Fonts.

## Page structure

| # | Section | Purpose |
|---|---------|---------|
| 1 | Hero | H1 + lede + trust ticks + CTA on the left, lead form on the right |
| 2 | Facts bar | Four proof points (45+ years, own farm, 1–2 days, Sydney-wide) |
| 3 | Turf varieties | The five varieties, each with a "Get a price" link to the form |
| 4 | Services | Delivery, pickup, maxi roll, maxi roll laying, installation, advice |
| 5 | Why Arrow Turf | Split image + differentiators |
| 6 | How it works | Four-step process — removes friction before the enquiry |
| 7 | Recent work | Six-image project gallery |
| 8 | Reviews | Three Google reviews, 5-star |
| 9 | CTA strip | Full-width conversion prompt |
| 10 | FAQ | Six objection-handling questions |
| 11 | Contact | Enquiry form + contact details + Google Map |

No site header or footer by design — the page keeps ad traffic focused on
the two conversion actions: **submit the form** or **call the farm**.

## Conversion mechanics

- Lead form is above the fold on desktop and immediately below the hero copy on mobile.
- Primary CTA text is `BOOK YOUR CONSULTATION HERE` throughout, in `--clay` so it
  stands out against the green brand palette.
- Every CTA either scrolls to a form (`#lead-form` / `#contact`) or dials `tel:0490779707`.
- Sticky call/enquire bar pinned to the bottom on screens ≤760px.
- Both forms share client-side validation, inline error states and an inline
  thank-you panel — no page reload, so the conversion event stays on this page.

## Layout widths

`--wrap` controls the content container:

- **1440px** on desktop and laptop
- **1880px** from 1700px viewport width up

## Things to wire up before launch

1. **Form handler.** Both `<form class="atf-form">` elements are front-end only.
   Point `action`/`method` at your handler (CF7, HubSpot, Zapier webhook, etc.)
   or replace the `// --- Send the lead here ---` block in the inline script with a `fetch()`.
2. **Images.** Currently loaded from the live WordPress URLs. Search `index.html`
   for the `IMAGE MAP` comment near the top of `<body>` — it lists every asset in one place.
   Swap the paths once the images are uploaded to this repo.
3. **Tracking.** No analytics, GTM or conversion tags are included, as requested.
4. `noindex, nofollow` is set in the head — remove it if this page should be indexed.
