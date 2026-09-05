# thewebster.net — Premium-Tier Upgrade Design

## Context

The full marketing site (spec: `2026-09-05-full-site-design.md`) is live at thewebster.net. The user asked directly whether it's honestly worth the "$15,000-tier" framing used to sell it, and the honest answer was no — it's solid $2-5K-tier work missing several things that genuinely justify a higher price: legal pages, real SEO infrastructure (schema, proper OG image), image optimization, and a design that reads as distinctive rather than competent-but-safe.

This spec covers closing that gap: both completeness (legal pages, technical SEO, image optimization, error handling) and a genuine design escalation (a real signature element, a narrative arc on Home, upgraded case-study presentation) — not a cosmetic reskin, and not fabricated content (no fake stats, no invented testimonials, no false dates).

## Goals

- Add the missing completeness items a real business site needs: Privacy Policy, Terms of Service, custom 404, contact form error-state UI, optimized portfolio images, Organization/Article schema.org structured data, a proper designed OG/social-share image.
- Escalate the design itself: replace the generic blurred orbit-ring with a genuine signature element that visualizes the actual brand story (international expansion), add a narrative "why this matters" section to Home, reframe case studies with a browser-chrome treatment, add an honest numbers strip, give the About page's mission statement a pull-quote treatment.
- Keep the existing, already-live brand system (palette, type trio, overall page structure/nav) — this is an escalation of the same brand, not a replacement of it.

## Non-goals

- No fabricated statistics, testimonials, or invented performance numbers. The numbers strip uses only true, countable facts (countries served, projects delivered).
- No fake "free audit" tool or any interactive feature that would present simulated/fabricated analysis as if it were real for a URL the visitor provides.
- No analytics/tracking integration (out of scope for this pass — the Privacy Policy will honestly state none is currently used).
- No CMS, no build step, no JS framework — stays static HTML/CSS/JS, consistent with every prior page on this site.
- No new legal compliance claims (e.g. explicit GDPR/CCPA mechanism claims) beyond a plain, honest description of what data is collected and why.

## Design

### 1. Signature element: Network Map Hero

Replaces the current blurred `.orbit` conic-gradient ring on the Home hero (inner pages keep their existing calmer `.hero--inner .orbit` treatment unchanged — this upgrade is Home-only, where the brand story is being told).

- An SVG layer sized to the hero, positioned behind the existing logo mark.
- Five small circular nodes arranged around the hero, each labeled with one served country (US, UK, CA, AU, NZ) via a small `<title>`/visually-adjacent label.
- Each node connects to the center (where the eagle/globe logo already sits) via a curved SVG path, stroked with the existing `--gradient` (blue → violet → orange), `stroke-dasharray`/`stroke-dashoffset` animated on load to "draw" the connection once, then a slow, subtle opacity pulse loop (2-3s) on each node.
- `prefers-reduced-motion`: the draw-in and pulse animations are disabled; paths and nodes render at their final, fully-drawn, full-opacity state (no motion, still visually present).
- This directly visualizes "The Webster, going international" instead of decorative ambient glow — a real signature tied to the actual brand story.

### 2. New Home section: "The Problem"

A short narrative block inserted between the hero and the existing "What We Do" section:

> Eyebrow: **Why This Matters**
> Heading: **Great businesses lose customers to weaker competitors — because of a weaker website.**
> Body: "It's not talent or service that decides who gets found first. It's who shows up when a customer searches, and who looks credible the moment they land. The Webster exists to close that gap — for local businesses and international clients alike."

Plain prose section, no cards/grid — a single centered block, consistent with the existing `.section` rhythm.

### 3. Case study browser-chrome frame

Home's "Recent Work" cards and the full Portfolio page cards both get an upgraded image treatment:

- Each screenshot is wrapped in a `.browser-frame` div: a thin top bar (three small dot circles, `::before`-style, muted grey — not real traffic-light colors, keeping it monochrome/on-brand) above the rounded-corner screenshot, giving the impression of a browser window rather than a bare cropped image.
- On hover (desktop) / tap-equivalent no-op on touch (no JS required beyond existing `:hover` CSS — this is a progressive-enhancement visual detail, not required for comprehension), a short tag list overlays the bottom of the frame, drawn from facts already stated in that case study's existing copy — nothing new is claimed:
  - Optique Borehole Drilling: "5 pages" · "Custom logo work" · "Call/WhatsApp CTAs"
  - Reliable Runner Courier: "Single-page site" · "Business-solutions section"
  - Vuka Digital: "Next.js" · "Animated hero" · "Pricing page"

### 4. Honest numbers strip

A row of three real, countable facts, inserted on Home just above the closing "Ready to be seen?" CTA section:

- **5** — Countries Served
- **3** — Projects Delivered
- **4** — Services Offered

No invented metrics (no "% faster," no "clients served," no fabricated satisfaction scores) — every number here is directly verifiable from the site's own content.

### 5. About page pull-quote

The mission statement (already on the page, verbatim, unchanged text) moves from a plain paragraph into a `<blockquote class="pull-quote">` treatment: larger type size, a gradient-colored left border or oversized decorative opening quotation mark, set apart from the surrounding paragraph rhythm. Text itself does not change.

### 6. Privacy Policy page (`privacy.html`)

Plain, honest policy — not aggressive legal boilerplate, no false compliance claims:
- What's collected: name, email, and message submitted via the Contact page's form only. No cookies, no analytics, no tracking of any kind currently in use on this site.
- Why: solely to respond to the enquiry.
- Sharing: never sold or shared with third parties.
- Retention: kept only as long as needed to respond to the enquiry.
- Rights: anyone can request their submitted information be deleted by emailing info@thewebster.net.
- Effective date: 2026-09-05 (today, when this page goes live — a true date, not a placeholder).

### 7. Terms of Service page (`terms.html`)

Standard, honest agency terms:
- This website provides information about The Webster's services; using it does not itself create a service agreement — actual engagements are governed by a separate quote/contract.
- Site content (design, copy, code) is the property of The Webster.
- The site and its content are provided "as is," without warranty.
- The Webster is not liable for damages arising from use of the site.
- Terms may be updated; the effective date will be revised when they are.
- Contact: info@thewebster.net.

### 8. Custom 404 page (`404.html`)

Same header/footer/nav as every other page. Hero-style centered content: large gradient "404" headline, "This page doesn't exist" subhead, a button back to Home. No orbit/network-map animation needed here — keep it simple and fast.

### 9. Contact form error-state UI

Closes a gap the final review flagged: `contact-handler.php` already redirects failed submissions to `contact.html?error=1`, but nothing handles that parameter.
- Add a `.form-error` paragraph to `contact.html`, styled as a visible error state (red/orange-tinted border, matching the `.form-success` treatment's visual weight but in a warning color), initially hidden.
- Extend `script.js`'s existing `URLSearchParams` check to also look for `error=1` and reveal `.form-error` when present (mirrors the existing `sent=1` → `.form-success` pattern already in the file).
- Message: "Something went wrong — please check your details and try again, or email us directly at info@thewebster.net."

### 10. Portfolio image optimization

The three portfolio screenshots (currently large PNGs, up to 737KB) are converted to WebP at a sensible display width (~1200px wide, matching current usage), and every `<img>` referencing them gains explicit `width="1200" height="750"` attributes plus `loading="lazy"` (they're all below-the-fold or in a grid, never the LCP element) to prevent layout shift and defer loading until needed.

### 11. Organization + Article schema.org structured data

- **Home page**: a `<script type="application/ld+json">` block with `@type: "Organization"` — name "The Webster", url "https://thewebster.net/", logo, and a plain-text description matching the existing meta description. Deliberately `Organization`, not `LocalBusiness` — this is an international, address-less service arm by design (per the original site spec), and claiming a `LocalBusiness` type with a fabricated or omitted address would be inaccurate.
- **Each blog post**: a `<script type="application/ld+json">` block with `@type: "Article"` — headline (matching `<title>`), description (matching meta description), `datePublished` set to `2026-09-05` (the true date these posts are actually going live), and `author`/`publisher` referencing the Organization. This same date is also added as a small visible "Published Sep 5, 2026" line under each post's `<h1>` — closing the previously-flagged "blog posts have no dates" gap honestly, using the real publish date rather than a fabricated one.

### 12. Real OG/social-share image

A dedicated 1200×630 PNG (`assets/og-image.png`) replacing the current placeholder use of the plain logo:
- Near-black background matching `--ink`, the gradient system, the logo mark, "The Webster" wordmark, and the tagline "Every Business Deserves To Be Seen" — built as a static HTML page using the site's existing brand tokens/fonts, then screenshotted at 1200×630 and saved as a static asset (same technique already used to capture the portfolio screenshots in the original build).
- Every page's `og:image`/`twitter:image` meta tags are updated to point to this new asset instead of the bare `assets/logo.webp`. `twitter:card` upgrades from `summary` to `summary_large_image` now that a properly-sized landscape image exists.

## Technical approach

- No build step, no framework — every addition is static HTML/CSS/JS/JSON-LD, consistent with the rest of the site.
- `privacy.html`, `terms.html`, and `404.html` reuse the exact shared header/nav/footer pattern from every existing top-level page (same classes, same 7-item nav, though 404 and the legal pages are not themselves nav items — they're linked from the footer only, alongside the existing quick links, to avoid cluttering the primary nav with rarely-visited pages).
- The Network Map Hero is pure inline SVG + CSS animation — no new JS required beyond what `script.js` already provides (reduced-motion handling stays CSS-only, matching the existing `.reveal`/`.orbit` pattern).
- `.cpanel.yml` is extended to deploy the three new pages and the new OG image asset.
- `DEPLOY.md`'s stale "copies `index.html`, `styles.css`, and `assets/`" line (flagged in the final review) is corrected to describe the actual current file list.

## Footer navigation change

Every page's footer gains a fifth `.footer-col` (using the existing `.footer-col`/`.footer-links` markup pattern, same as the existing "QUICK LINKS" column), titled "LEGAL", containing two links: Privacy Policy and Terms of Service. This is additive to the existing 4-column footer grid (`.footer-inner`'s `repeat(auto-fit, minmax(180px, 1fr))` already accommodates any column count) — no existing column's content changes. The primary top nav (7 items) is unchanged; these pages are footer-only, standard placement for rarely-visited legal pages.

## Testing / QA plan

- Local preview via static server, as with every prior page on this site.
- Visual check of every new/changed page (Home, About, Portfolio, Contact, 404, Privacy, Terms) at desktop and mobile widths.
- Verify the Network Map Hero's draw-in animation plays once on load and settles into its idle pulse state; verify `prefers-reduced-motion` freezes it in the fully-drawn state with no animation.
- Verify `contact.html?error=1` reveals `.form-error`, and `?sent=1` still correctly reveals `.form-success` (regression check on existing behavior).
- Verify the three portfolio images load as WebP with no visual quality regression, and that layout doesn't shift as they load (explicit width/height present).
- Validate the JSON-LD blocks are well-formed (no trailing commas, matches schema.org's expected shape) — spot-check with a JSON parse, not a live Google Rich Results Test (no network dependency required for that check in this build).
- Confirm the new OG image renders correctly by checking its file dimensions (1200×630) and that every page's `og:image`/`twitter:image` tags point to it.
- Full link check across the two new legal pages and 404 (footer links resolve, page itself doesn't 404-loop).

## Open items / follow-ups (not blocking this build)

- No analytics/tracking is being added in this pass — flagged as a known, deliberate gap in the Privacy Policy's own text, honestly stated rather than silently absent.
- The Privacy Policy and Terms of Service are reasonable, honest generic content, not a substitute for actual legal review if the business wants one — this build does not claim otherwise.
