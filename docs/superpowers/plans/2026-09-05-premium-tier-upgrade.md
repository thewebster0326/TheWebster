# thewebster.net Premium-Tier Upgrade Implementation Plan

> **For agentic workers:** REQUIRED SUB-SKILL: Use superpowers:subagent-driven-development (recommended) or superpowers:executing-plans to implement this plan task-by-task. Steps use checkbox (`- [ ]`) syntax for tracking.

**Goal:** Close the gap between thewebster.net's current build and a genuine "$15,000-tier" site: add the missing completeness items (legal pages, technical SEO, image optimization, error handling) and escalate the design itself (a real signature element, a narrative Home arc, upgraded case-study presentation) without any fabricated content.

**Architecture:** Same static HTML/CSS/JS, no build step, no framework, as every prior page on this site. All new pages reuse the exact shared header/nav/footer pattern already established. New visual elements (network map, browser-chrome frames, pull-quote, stats strip) are pure CSS/inline-SVG additions to the existing shared `styles.css`/`script.js`.

**Tech Stack:** Plain HTML5, CSS (existing custom properties, `prefers-reduced-motion`), vanilla JS (existing `IntersectionObserver` pattern, extended not replaced), inline SVG for the new signature element, JSON-LD for structured data, Apache `.htaccess` for the custom 404.

## Global Constraints

- No build step, no JS framework, no CMS — every page remains hand-authored static HTML (per both the original and this spec's Non-goals).
- No fabricated statistics, testimonials, or invented performance numbers anywhere. The numbers strip uses only true, countable facts: `5` Countries Served, `3` Projects Delivered, `4` Services Offered.
- No new legal-compliance claims beyond a plain, honest description of what data is collected and why. No analytics/tracking is being added — the Privacy Policy must honestly state that none is currently used.
- Brand tokens (already defined in `styles.css`, do not change): `--ink: #0a0d16`, `--surface: #12172a`, `--blue: #2e6ff2`, `--violet: #8b2ff0`, `--orange: #ff7a2e`, `--text: #f5f6fa`, `--muted: #8a93b3`, `--gradient: linear-gradient(100deg, var(--blue) 0%, var(--violet) 55%, var(--orange) 100%)`.
- Fonts: `'Space Grotesk', sans-serif` (display/headings), `'Inter', system-ui, sans-serif` (body), `'JetBrains Mono', monospace` (eyebrows/labels) — already linked via Google Fonts `<link>` tags in every page; new pages must include the same tags.
- Every new animated/transitioning element must be neutralized under `@media (prefers-reduced-motion: reduce)`, matching the site's existing pattern (see `styles.css:173-176` and `:440-450` for the existing precedent).
- The Network Map Hero signature element replaces `.orbit` **only** in `index.html`'s Home hero. Every other page's `.hero--inner .orbit` is unchanged.
- New top-level pages (`privacy.html`, `terms.html`, `404.html`) are **not** added to the primary 7-item nav — they are footer-only links, added via a new 5th `.footer-col` titled "LEGAL" that must be added to **every** page on the site (all 10 existing pages plus the 3 new ones), since the footer is shared chrome.
- Every existing page's `og:image`/`twitter:image` tags must be updated to point to the new `assets/og-image.png` once it exists, and `twitter:card` upgraded from `summary` to `summary_large_image`.

---

### Task 1: OG/social-share image

**Files:**
- Create: `og-image-source.html` (project root — a standalone source page used only to generate the image, not deployed/linked from anywhere)
- Create: `assets/og-image.png` (1200×630)

**Interfaces:**
- Produces: `assets/og-image.png`, referenced by every page's `og:image`/`twitter:image` meta tags in Task 4 onward is NOT this task's job — **this task itself does not edit any existing page**. (The meta-tag swap happens per-page in a later step of this same task, Step 4, to keep the "create the asset" and "wire it up" work together in one reviewable unit.)

- [ ] **Step 1: Write `og-image-source.html`**

```html
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>OG Image Source</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@700&family=Inter:wght@400;500&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  html, body {
    width: 1200px;
    height: 630px;
    background: #0a0d16;
    overflow: hidden;
  }
  .stage {
    position: relative;
    width: 1200px;
    height: 630px;
    display: flex;
    flex-direction: column;
    align-items: center;
    justify-content: center;
    text-align: center;
  }
  .glow {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 900px;
    height: 900px;
    transform: translate(-50%, -50%);
    border-radius: 50%;
    background: conic-gradient(from 0deg, transparent 0deg, #2e6ff2 40deg, #8b2ff0 130deg, #ff7a2e 220deg, transparent 300deg);
    filter: blur(120px);
    opacity: 0.28;
  }
  .logo {
    position: relative;
    width: 150px;
    height: 150px;
    object-fit: contain;
    margin-bottom: 28px;
    filter: drop-shadow(0 8px 40px rgba(139, 47, 240, 0.35));
  }
  .eyebrow {
    position: relative;
    font-family: 'JetBrains Mono', monospace;
    font-size: 18px;
    font-weight: 500;
    letter-spacing: 0.18em;
    text-transform: uppercase;
    color: #8a93b3;
    margin-bottom: 20px;
  }
  .wordmark {
    position: relative;
    font-family: 'Space Grotesk', sans-serif;
    font-weight: 700;
    font-size: 72px;
    line-height: 1;
    letter-spacing: -0.02em;
    background: linear-gradient(100deg, #2e6ff2 0%, #8b2ff0 55%, #ff7a2e 100%);
    -webkit-background-clip: text;
    background-clip: text;
    color: transparent;
    margin-bottom: 20px;
  }
  .tagline {
    position: relative;
    font-family: 'Inter', system-ui, sans-serif;
    font-size: 28px;
    color: #f5f6fa;
  }
</style>
</head>
<body>
  <div class="stage">
    <div class="glow"></div>
    <img class="logo" src="assets/logo.webp" alt="">
    <p class="eyebrow">Web Design &amp; Digital Services</p>
    <h1 class="wordmark">The Webster</h1>
    <p class="tagline">Every Business Deserves To Be Seen</p>
  </div>
</body>
</html>
```

- [ ] **Step 2: Capture it at exactly 1200×630**

Serve the project root locally and open `og-image-source.html` in the Browser pane:

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && python -m http.server 8901 >/tmp/og_capture_server.log 2>&1 &
```

Open `http://localhost:8901/og-image-source.html`. Set the viewport to exactly 1200×630 (use the browser tool's custom-size resize, not a device preset), wait for the Google Fonts to load (a short `wait`), then take a screenshot and save it as `assets/og-image.png`. Verify the saved file's dimensions are 1200×630 (or as close as the tool allows — if the tool cannot produce an exact 1200×630 capture, capture at the closest available size and note the actual dimensions in your report; do not silently ship a wrong-aspect-ratio image without flagging it).

- [ ] **Step 3: Verify the image**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && file assets/og-image.png
```

Expected: a PNG image reasonably close to 1200 x 630. Visually inspect it (Read tool supports images) to confirm the logo, "The Webster" gradient wordmark, eyebrow, and tagline are all legible and correctly positioned, matching the brand system used elsewhere on the site.

- [ ] **Step 4: Update every existing page's OG/Twitter image tags**

In each of these 10 files, replace the line `<meta property="og:image" content="https://thewebster.net/assets/logo.webp">` with `<meta property="og:image" content="https://thewebster.net/assets/og-image.png">`, replace `<meta name="twitter:card" content="summary">` with `<meta name="twitter:card" content="summary_large_image">`, and replace `<meta name="twitter:image" content="https://thewebster.net/assets/logo.webp">` with `<meta name="twitter:image" content="https://thewebster.net/assets/og-image.png">`:

- `index.html`
- `services.html`
- `portfolio.html`
- `process.html`
- `about.html`
- `contact.html`
- `blog/index.html`
- `blog/website-speed-and-seo.html`
- `blog/signs-you-need-a-redesign.html`
- `blog/2026-web-design-trends.html`

Each file has exactly one occurrence of each of those three lines (confirm with `grep -c` before editing if unsure) — this is a mechanical, identical three-line swap in all 10 files.

- [ ] **Step 5: Stop the temporary local server**

Stop the `http.server` process started in Step 2.

- [ ] **Step 6: Verify locally**

Re-serve the project, open `index.html`, and confirm via `view-source` or `curl` that the three updated meta tags now point to `assets/og-image.png` and that `twitter:card` reads `summary_large_image`. Spot-check one more page (e.g. `contact.html`) the same way.

- [ ] **Step 7: Commit**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git add og-image-source.html assets/og-image.png index.html services.html portfolio.html process.html about.html contact.html blog/index.html blog/website-speed-and-seo.html blog/signs-you-need-a-redesign.html blog/2026-web-design-trends.html && git commit -m "feat: add designed OG/Twitter social-share image, wire up on every page"
```

---

### Task 2: Portfolio image optimization

**Files:**
- Modify (convert in place, same filenames but `.webp` extension): `assets/portfolio/optique-borehole-drilling.png` → `assets/portfolio/optique-borehole-drilling.webp` (and the other two, same pattern)
- Modify: `index.html` (3 `<img>` tags in the "Recent Work" section)
- Modify: `portfolio.html` (3 `<img>` tags in the case-study cards)

**Interfaces:**
- Produces: `assets/portfolio/optique-borehole-drilling.webp`, `assets/portfolio/reliable-runner-courier.webp`, `assets/portfolio/vuka-digital.webp` — these exact filenames are consumed by Task 8 (browser-chrome frame), which must run after this task.

- [ ] **Step 1: Convert the three PNGs to WebP**

All three source files are 1200×750. Try these approaches in order until one works (this environment's available tools are not guaranteed in advance):

**Option A — `cwebp` CLI, if installed:**
```bash
cd "/c/Users/ubzma/Desktop/The Webster/assets/portfolio"
cwebp -q 85 optique-borehole-drilling.png -o optique-borehole-drilling.webp
cwebp -q 85 reliable-runner-courier.png -o reliable-runner-courier.webp
cwebp -q 85 vuka-digital.png -o vuka-digital.webp
```

**Option B — Python Pillow, if installed:**
```bash
cd "/c/Users/ubzma/Desktop/The Webster/assets/portfolio" && python3 -c "
from PIL import Image
for name in ['optique-borehole-drilling', 'reliable-runner-courier', 'vuka-digital']:
    Image.open(f'{name}.png').save(f'{name}.webp', 'webp', quality=85)
"
```

**Option C — Browser canvas fallback (no external dependency), if both above are unavailable:**
Open each PNG in the Browser pane (`file://` URL or via a local server), then run in the page's JS context:
```javascript
const img = document.querySelector('img'); // or create one pointing at the file
const canvas = document.createElement('canvas');
canvas.width = img.naturalWidth; canvas.height = img.naturalHeight;
canvas.getContext('2d').drawImage(img, 0, 0);
canvas.toDataURL('image/webp', 0.85); // returns a data: URI string
```
Take the returned base64 payload (strip the `data:image/webp;base64,` prefix) and decode it to a file:
```bash
echo "PASTE_BASE64_HERE" | base64 -d > assets/portfolio/optique-borehole-drilling.webp
```
Repeat per image. This is more manual — prefer Option A or B if either is available.

If none of the three approaches work in this environment, report back with status BLOCKED describing exactly what you tried and what failed — do not ship unconverted PNGs silently.

- [ ] **Step 2: Verify the conversions**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && file assets/portfolio/*.webp
```

Expected: three WebP image files. Visually inspect each (Read tool supports WebP) to confirm no visible quality loss versus the original PNGs.

- [ ] **Step 3: Delete the original PNGs**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git rm assets/portfolio/optique-borehole-drilling.png assets/portfolio/reliable-runner-courier.png assets/portfolio/vuka-digital.png
```

- [ ] **Step 4: Update `index.html`'s three "Recent Work" images**

Replace each of these three `<img>` tags (currently using `.png` with only a `style="width:100%..."` attribute) with the `.webp` equivalent plus explicit dimensions and lazy-loading:

Replace:
```html
<img src="assets/portfolio/optique-borehole-drilling.png" alt="Optique Borehole Drilling website" style="width:100%; border-radius:8px; margin-bottom:1rem;">
```
with:
```html
<img src="assets/portfolio/optique-borehole-drilling.webp" alt="Optique Borehole Drilling website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1rem;">
```

Replace:
```html
<img src="assets/portfolio/reliable-runner-courier.png" alt="Reliable Runner Courier website" style="width:100%; border-radius:8px; margin-bottom:1rem;">
```
with:
```html
<img src="assets/portfolio/reliable-runner-courier.webp" alt="Reliable Runner Courier website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1rem;">
```

Replace:
```html
<img src="assets/portfolio/vuka-digital.png" alt="Vuka Digital website" style="width:100%; border-radius:8px; margin-bottom:1rem;">
```
with:
```html
<img src="assets/portfolio/vuka-digital.webp" alt="Vuka Digital website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1rem;">
```

- [ ] **Step 5: Update `portfolio.html`'s three case-study images**

Replace each of these (note the slightly different margin value, `1.25rem`, matching this page's existing markup):

Replace:
```html
<img src="assets/portfolio/optique-borehole-drilling.png" alt="Optique Borehole Drilling website" style="width:100%; border-radius:8px; margin-bottom:1.25rem;">
```
with:
```html
<img src="assets/portfolio/optique-borehole-drilling.webp" alt="Optique Borehole Drilling website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1.25rem;">
```

Replace:
```html
<img src="assets/portfolio/reliable-runner-courier.png" alt="Reliable Runner Courier website" style="width:100%; border-radius:8px; margin-bottom:1.25rem;">
```
with:
```html
<img src="assets/portfolio/reliable-runner-courier.webp" alt="Reliable Runner Courier website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1.25rem;">
```

Replace:
```html
<img src="assets/portfolio/vuka-digital.png" alt="Vuka Digital website" style="width:100%; border-radius:8px; margin-bottom:1.25rem;">
```
with:
```html
<img src="assets/portfolio/vuka-digital.webp" alt="Vuka Digital website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1.25rem;">
```

- [ ] **Step 6: Verify locally**

Serve the project, open `index.html` and `portfolio.html`, confirm all 6 image references (3 per page) render correctly with no broken-image icons, and check the Network tab / `read_network_requests` to confirm `.webp` files are what's actually loading (not 404s falling back to nothing).

- [ ] **Step 7: Commit**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git add assets/portfolio/ index.html portfolio.html && git commit -m "feat: convert portfolio screenshots to WebP, add explicit dimensions and lazy-loading"
```

---

### Task 3: Contact form error-state UI

**Files:**
- Modify: `styles.css` (append `.form-error` rule)
- Modify: `contact.html` (add `.form-error` element to the form)
- Modify: `script.js` (extend the existing `sent=1` param check to also handle `error=1`)

**Interfaces:**
- Consumes: the existing `.form-success`/`?sent=1` pattern already in `script.js:20-24` — this task extends the same block, doesn't replace it.

- [ ] **Step 1: Append `.form-error` styles to `styles.css`**

Add this immediately after the existing `.form-success.visible { display: block; }` rule (the last rule in the file):

```css

.form-error {
  display: none;
  background: rgba(255, 122, 46, 0.12);
  border: 1px solid rgba(255, 122, 46, 0.4);
  border-radius: 8px;
  padding: 1rem 1.25rem;
  color: var(--text);
  font-size: 0.9375rem;
}

.form-error.visible { display: block; }
```

- [ ] **Step 2: Add the error element to `contact.html`**

In the `<form>` in `contact.html`, immediately after the existing `<p class="form-success">Thanks — we've received your enquiry and will be in touch shortly.</p>` line, add:

```html
      <p class="form-error">Something went wrong — please check your details and try again, or email us directly at <a href="mailto:info@thewebster.net" style="color:inherit;">info@thewebster.net</a>.</p>
```

- [ ] **Step 3: Extend `script.js` to handle the error param**

Replace this block in `script.js`:

```javascript
  const params = new URLSearchParams(window.location.search);
  if (params.get('sent') === '1') {
    const note = document.querySelector('.form-success');
    if (note) note.classList.add('visible');
  }
```

with:

```javascript
  const params = new URLSearchParams(window.location.search);
  if (params.get('sent') === '1') {
    const note = document.querySelector('.form-success');
    if (note) note.classList.add('visible');
  }
  if (params.get('error') === '1') {
    const note = document.querySelector('.form-error');
    if (note) note.classList.add('visible');
  }
```

- [ ] **Step 4: Verify locally**

Serve the project, visit `contact.html?sent=1` directly and confirm `.form-success` still shows (regression check — this must keep working exactly as before). Then visit `contact.html?error=1` and confirm `.form-error` now shows with the warning-orange styling, and that both cannot show at once under normal navigation (visiting one URL shows only that one's message).

- [ ] **Step 5: Commit**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git add styles.css contact.html script.js && git commit -m "feat: add contact form error-state UI for failed submissions"
```

---

### Task 4: Legal pages, custom 404, site-wide footer LEGAL column

**Files:**
- Create: `privacy.html`
- Create: `terms.html`
- Create: `404.html`
- Create: `.htaccess` (project root)
- Modify (footer only — same 5-line insertion in each): `index.html`, `services.html`, `portfolio.html`, `process.html`, `about.html`, `contact.html`, `blog/index.html`, `blog/website-speed-and-seo.html`, `blog/signs-you-need-a-redesign.html`, `blog/2026-web-design-trends.html`

**Interfaces:**
- Produces: `privacy.html`, `terms.html` — linked from the new footer LEGAL column on every page (top-level pages link directly; `blog/*.html` files link via `../privacy.html`/`../terms.html`).
- Produces: `404.html` — not linked from anywhere in-page; reached only via the `.htaccess` `ErrorDocument` directive.

- [ ] **Step 1: Add the LEGAL footer column to all 10 existing top-level pages**

In each of these 6 files — `index.html`, `services.html`, `portfolio.html`, `process.html`, `about.html`, `contact.html` — find this exact block (present byte-for-byte identically in all 6):

```html
    <div class="footer-col">
      <h4>SERVING</h4>
      <p class="footer-area">United States &bull; United Kingdom &bull; Canada &bull; Australia &bull; New Zealand</p>
    </div>
  </div>
  <div class="footer-bottom">
```

and replace it with:

```html
    <div class="footer-col">
      <h4>SERVING</h4>
      <p class="footer-area">United States &bull; United Kingdom &bull; Canada &bull; Australia &bull; New Zealand</p>
    </div>
    <div class="footer-col">
      <h4>LEGAL</h4>
      <ul class="footer-links">
        <li><a href="privacy.html">Privacy Policy</a></li>
        <li><a href="terms.html">Terms of Service</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
```

- [ ] **Step 2: Add the LEGAL footer column to all 4 blog files**

In each of these 4 files — `blog/index.html`, `blog/website-speed-and-seo.html`, `blog/signs-you-need-a-redesign.html`, `blog/2026-web-design-trends.html` — find this exact block (present byte-for-byte identically in all 4, note the `../` prefixes distinguishing it from the top-level version above):

```html
    <div class="footer-col">
      <h4>SERVING</h4>
      <p class="footer-area">United States &bull; United Kingdom &bull; Canada &bull; Australia &bull; New Zealand</p>
    </div>
  </div>
  <div class="footer-bottom">
```

and replace it with:

```html
    <div class="footer-col">
      <h4>SERVING</h4>
      <p class="footer-area">United States &bull; United Kingdom &bull; Canada &bull; Australia &bull; New Zealand</p>
    </div>
    <div class="footer-col">
      <h4>LEGAL</h4>
      <ul class="footer-links">
        <li><a href="../privacy.html">Privacy Policy</a></li>
        <li><a href="../terms.html">Terms of Service</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
```

- [ ] **Step 3: Write `privacy.html`**

```html
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Privacy Policy | The Webster</title>
<meta name="description" content="How The Webster collects, uses, and protects information submitted through this website.">
<link rel="canonical" href="https://thewebster.net/privacy.html">
<meta property="og:type" content="website">
<meta property="og:url" content="https://thewebster.net/privacy.html">
<meta property="og:site_name" content="The Webster">
<meta property="og:title" content="Privacy Policy | The Webster">
<meta property="og:description" content="How The Webster collects, uses, and protects information submitted through this website.">
<meta property="og:image" content="https://thewebster.net/assets/og-image.png">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Privacy Policy | The Webster">
<meta name="twitter:description" content="How The Webster collects, uses, and protects information submitted through this website.">
<meta name="twitter:image" content="https://thewebster.net/assets/og-image.png">
<link rel="icon" type="image/webp" href="assets/logo.webp">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
</head>
<body>

<header class="site-header">
  <div class="container header-inner">
    <a href="index.html" class="logo"><img src="assets/logo.webp" alt="The Webster" class="logo-img"></a>
    <nav class="main-nav" id="mainNav">
      <a href="index.html">HOME</a>
      <a href="services.html">SERVICES</a>
      <a href="portfolio.html">PORTFOLIO</a>
      <a href="process.html">PROCESS</a>
      <a href="about.html">ABOUT</a>
      <a href="blog/index.html">BLOG</a>
      <a href="contact.html">CONTACT</a>
    </nav>
    <a href="contact.html" class="btn btn-primary header-cta">GET A QUOTE</a>
    <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<section class="hero hero--inner">
  <div class="orbit" aria-hidden="true"></div>
  <div class="hero-content">
    <p class="eyebrow">Privacy Policy</p>
    <h1 class="headline" style="font-size: clamp(2rem, 5vw, 3rem);">Your Information, Handled Plainly</h1>
  </div>
</section>

<section class="section">
  <div class="container" style="max-width: 720px;">
    <div class="reveal" style="color:var(--muted); line-height:1.8; font-size:1.0625rem;">
      <p style="margin-bottom:1.5rem;"><strong style="color:var(--text);">What we collect.</strong> When you submit the contact form on this site, we collect the name, email address, and message you provide. That's the only information this website collects — we do not use cookies, analytics, or any other tracking on thewebster.net.</p>
      <p style="margin-bottom:1.5rem;"><strong style="color:var(--text);">Why we collect it.</strong> Solely to respond to your enquiry.</p>
      <p style="margin-bottom:1.5rem;"><strong style="color:var(--text);">Sharing.</strong> We never sell or share your information with third parties.</p>
      <p style="margin-bottom:1.5rem;"><strong style="color:var(--text);">Retention.</strong> We keep submitted enquiries only as long as needed to respond to them.</p>
      <p style="margin-bottom:1.5rem;"><strong style="color:var(--text);">Your rights.</strong> You can request that we delete any information you've submitted at any time by emailing <a href="mailto:info@thewebster.net" style="color:var(--violet);">info@thewebster.net</a>.</p>
      <p><strong style="color:var(--text);">Effective date:</strong> September 5, 2026.</p>
    </div>
  </div>
</section>

<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-col">
      <a href="index.html" class="logo footer-logo"><img src="assets/logo.webp" alt="The Webster" class="logo-img"></a>
      <p class="footer-tagline">Every Business Deserves To Be Seen</p>
    </div>
    <div class="footer-col">
      <h4>QUICK LINKS</h4>
      <ul class="footer-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="process.html">Process</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="blog/index.html">Blog</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>CONTACT</h4>
      <ul class="footer-contact">
        <li><a href="mailto:info@thewebster.net">info@thewebster.net</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>SERVING</h4>
      <p class="footer-area">United States &bull; United Kingdom &bull; Canada &bull; Australia &bull; New Zealand</p>
    </div>
    <div class="footer-col">
      <h4>LEGAL</h4>
      <ul class="footer-links">
        <li><a href="privacy.html">Privacy Policy</a></li>
        <li><a href="terms.html">Terms of Service</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <p>&copy; <span id="year"></span> The Webster. All rights reserved.</p>
    </div>
  </div>
</footer>

<script src="script.js"></script>
<script>document.getElementById('year').textContent = new Date().getFullYear();</script>
</body>
</html>
```

- [ ] **Step 4: Write `terms.html`**

```html
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Terms of Service | The Webster</title>
<meta name="description" content="Terms governing the use of thewebster.net.">
<link rel="canonical" href="https://thewebster.net/terms.html">
<meta property="og:type" content="website">
<meta property="og:url" content="https://thewebster.net/terms.html">
<meta property="og:site_name" content="The Webster">
<meta property="og:title" content="Terms of Service | The Webster">
<meta property="og:description" content="Terms governing the use of thewebster.net.">
<meta property="og:image" content="https://thewebster.net/assets/og-image.png">
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="Terms of Service | The Webster">
<meta name="twitter:description" content="Terms governing the use of thewebster.net.">
<meta name="twitter:image" content="https://thewebster.net/assets/og-image.png">
<link rel="icon" type="image/webp" href="assets/logo.webp">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
</head>
<body>

<header class="site-header">
  <div class="container header-inner">
    <a href="index.html" class="logo"><img src="assets/logo.webp" alt="The Webster" class="logo-img"></a>
    <nav class="main-nav" id="mainNav">
      <a href="index.html">HOME</a>
      <a href="services.html">SERVICES</a>
      <a href="portfolio.html">PORTFOLIO</a>
      <a href="process.html">PROCESS</a>
      <a href="about.html">ABOUT</a>
      <a href="blog/index.html">BLOG</a>
      <a href="contact.html">CONTACT</a>
    </nav>
    <a href="contact.html" class="btn btn-primary header-cta">GET A QUOTE</a>
    <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<section class="hero hero--inner">
  <div class="orbit" aria-hidden="true"></div>
  <div class="hero-content">
    <p class="eyebrow">Terms of Service</p>
    <h1 class="headline" style="font-size: clamp(2rem, 5vw, 3rem);">The Ground Rules</h1>
  </div>
</section>

<section class="section">
  <div class="container" style="max-width: 720px;">
    <div class="reveal" style="color:var(--muted); line-height:1.8; font-size:1.0625rem;">
      <p style="margin-bottom:1.5rem;"><strong style="color:var(--text);">About this site.</strong> This website provides information about The Webster's services. Using it does not itself create a service agreement — any actual project is governed by a separate quote or contract agreed directly with you.</p>
      <p style="margin-bottom:1.5rem;"><strong style="color:var(--text);">Ownership.</strong> The design, copy, and code of this website are the property of The Webster.</p>
      <p style="margin-bottom:1.5rem;"><strong style="color:var(--text);">No warranty.</strong> This site and its content are provided as-is, without warranty of any kind.</p>
      <p style="margin-bottom:1.5rem;"><strong style="color:var(--text);">Liability.</strong> The Webster is not liable for any damages arising from your use of this website.</p>
      <p style="margin-bottom:1.5rem;"><strong style="color:var(--text);">Changes.</strong> These terms may be updated from time to time; the effective date below will be revised when they are.</p>
      <p><strong style="color:var(--text);">Effective date:</strong> September 5, 2026. Questions: <a href="mailto:info@thewebster.net" style="color:var(--violet);">info@thewebster.net</a>.</p>
    </div>
  </div>
</section>

<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-col">
      <a href="index.html" class="logo footer-logo"><img src="assets/logo.webp" alt="The Webster" class="logo-img"></a>
      <p class="footer-tagline">Every Business Deserves To Be Seen</p>
    </div>
    <div class="footer-col">
      <h4>QUICK LINKS</h4>
      <ul class="footer-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="process.html">Process</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="blog/index.html">Blog</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>CONTACT</h4>
      <ul class="footer-contact">
        <li><a href="mailto:info@thewebster.net">info@thewebster.net</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>SERVING</h4>
      <p class="footer-area">United States &bull; United Kingdom &bull; Canada &bull; Australia &bull; New Zealand</p>
    </div>
    <div class="footer-col">
      <h4>LEGAL</h4>
      <ul class="footer-links">
        <li><a href="privacy.html">Privacy Policy</a></li>
        <li><a href="terms.html">Terms of Service</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <p>&copy; <span id="year"></span> The Webster. All rights reserved.</p>
    </div>
  </div>
</footer>

<script src="script.js"></script>
<script>document.getElementById('year').textContent = new Date().getFullYear();</script>
</body>
</html>
```

- [ ] **Step 5: Write `404.html`**

```html
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Page Not Found | The Webster</title>
<meta name="robots" content="noindex">
<link rel="icon" type="image/webp" href="assets/logo.webp">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Space+Grotesk:wght@400;500;600;700&family=Inter:wght@400;500;600&family=JetBrains+Mono:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="styles.css">
</head>
<body>

<header class="site-header">
  <div class="container header-inner">
    <a href="index.html" class="logo"><img src="assets/logo.webp" alt="The Webster" class="logo-img"></a>
    <nav class="main-nav" id="mainNav">
      <a href="index.html">HOME</a>
      <a href="services.html">SERVICES</a>
      <a href="portfolio.html">PORTFOLIO</a>
      <a href="process.html">PROCESS</a>
      <a href="about.html">ABOUT</a>
      <a href="blog/index.html">BLOG</a>
      <a href="contact.html">CONTACT</a>
    </nav>
    <a href="contact.html" class="btn btn-primary header-cta">GET A QUOTE</a>
    <button class="nav-toggle" id="navToggle" aria-label="Toggle menu" aria-expanded="false">
      <span></span><span></span><span></span>
    </button>
  </div>
</header>

<section class="hero" style="padding: 6rem 1.5rem;">
  <div class="orbit" aria-hidden="true"></div>
  <div class="hero-content">
    <p class="eyebrow">Error 404</p>
    <h1 class="headline">This page doesn't exist.</h1>
    <p class="subhead">The page you're looking for may have moved or never existed.</p>
    <a class="btn btn-primary" href="index.html">Back to Home &nbsp;→</a>
  </div>
</section>

<footer class="site-footer">
  <div class="container footer-inner">
    <div class="footer-col">
      <a href="index.html" class="logo footer-logo"><img src="assets/logo.webp" alt="The Webster" class="logo-img"></a>
      <p class="footer-tagline">Every Business Deserves To Be Seen</p>
    </div>
    <div class="footer-col">
      <h4>QUICK LINKS</h4>
      <ul class="footer-links">
        <li><a href="index.html">Home</a></li>
        <li><a href="services.html">Services</a></li>
        <li><a href="portfolio.html">Portfolio</a></li>
        <li><a href="process.html">Process</a></li>
        <li><a href="about.html">About</a></li>
        <li><a href="blog/index.html">Blog</a></li>
        <li><a href="contact.html">Contact</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>CONTACT</h4>
      <ul class="footer-contact">
        <li><a href="mailto:info@thewebster.net">info@thewebster.net</a></li>
      </ul>
    </div>
    <div class="footer-col">
      <h4>SERVING</h4>
      <p class="footer-area">United States &bull; United Kingdom &bull; Canada &bull; Australia &bull; New Zealand</p>
    </div>
    <div class="footer-col">
      <h4>LEGAL</h4>
      <ul class="footer-links">
        <li><a href="privacy.html">Privacy Policy</a></li>
        <li><a href="terms.html">Terms of Service</a></li>
      </ul>
    </div>
  </div>
  <div class="footer-bottom">
    <div class="container">
      <p>&copy; <span id="year"></span> The Webster. All rights reserved.</p>
    </div>
  </div>
</footer>

<script src="script.js"></script>
<script>document.getElementById('year').textContent = new Date().getFullYear();</script>
</body>
</html>
```

Note: `404.html` deliberately does not use the Network Map Hero (Task 6 is Home-only) — it keeps the original `.orbit` element, matching every other inner page's hero treatment.

- [ ] **Step 6: Write `.htaccess`**

```apache
ErrorDocument 404 /404.html
```

- [ ] **Step 7: Verify locally**

Serve the project, visit `privacy.html` and `terms.html` directly and confirm they render with full header/footer/nav and the new LEGAL footer column appears on both. Then spot-check the LEGAL footer column on 3-4 of the existing pages (e.g. `index.html`, `blog/index.html`, `services.html`) to confirm the links resolve correctly (top-level pages link to `privacy.html`/`terms.html`; blog pages link to `../privacy.html`/`../terms.html`). A plain static server does not process `.htaccess`, so `404.html`'s actual error-page behavior can only be confirmed after deployment (note this in your report) — but do verify `404.html` itself renders correctly when visited directly by URL.

- [ ] **Step 8: Commit**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git add privacy.html terms.html 404.html .htaccess index.html services.html portfolio.html process.html about.html contact.html blog/index.html blog/website-speed-and-seo.html blog/signs-you-need-a-redesign.html blog/2026-web-design-trends.html && git commit -m "feat: add Privacy Policy, Terms of Service, custom 404 page, and site-wide LEGAL footer column"
```

---

### Task 5: Organization + Article schema.org structured data

**Files:**
- Modify: `index.html` (add Organization JSON-LD)
- Modify: `blog/website-speed-and-seo.html`, `blog/signs-you-need-a-redesign.html`, `blog/2026-web-design-trends.html` (add Article JSON-LD + visible publish date)

**Interfaces:**
- Consumes: nothing new — purely additive metadata and a small visible date line.

- [ ] **Step 1: Add Organization JSON-LD to `index.html`**

Immediately before the closing `</head>` tag, add:

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Organization",
  "name": "The Webster",
  "url": "https://thewebster.net/",
  "logo": "https://thewebster.net/assets/logo.webp",
  "description": "The Webster builds custom websites, e-commerce, SEO and branding for businesses across the US, UK, Canada, Australia and New Zealand."
}
</script>
```

- [ ] **Step 2: Add a visible publish date to `blog/website-speed-and-seo.html`**

Immediately after the `<h1 class="headline" ...>How Website Speed Affects Your SEO Ranking</h1>` line and before the closing `</div>` of `.hero-content`, add:

```html
    <p class="eyebrow" style="margin-top: 1rem;">Published September 5, 2026</p>
```

- [ ] **Step 3: Add Article JSON-LD to `blog/website-speed-and-seo.html`**

Immediately before the closing `</head>` tag, add:

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "How Website Speed Affects Your SEO Ranking",
  "description": "Why page load speed is a Google ranking signal, and practical ways to make your site faster.",
  "datePublished": "2026-09-05",
  "author": { "@type": "Organization", "name": "The Webster" },
  "publisher": { "@type": "Organization", "name": "The Webster", "logo": "https://thewebster.net/assets/logo.webp" }
}
</script>
```

- [ ] **Step 4: Add a visible publish date to `blog/signs-you-need-a-redesign.html`**

Same pattern as Step 2, immediately after its `<h1 class="headline" ...>5 Signs Your Website Needs a Redesign</h1>` line:

```html
    <p class="eyebrow" style="margin-top: 1rem;">Published September 5, 2026</p>
```

- [ ] **Step 5: Add Article JSON-LD to `blog/signs-you-need-a-redesign.html`**

Immediately before its closing `</head>` tag:

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "5 Signs Your Website Needs a Redesign",
  "description": "How to tell your website is holding your business back, and what to do about it.",
  "datePublished": "2026-09-05",
  "author": { "@type": "Organization", "name": "The Webster" },
  "publisher": { "@type": "Organization", "name": "The Webster", "logo": "https://thewebster.net/assets/logo.webp" }
}
</script>
```

- [ ] **Step 6: Add a visible publish date to `blog/2026-web-design-trends.html`**

Same pattern, immediately after its `<h1 class="headline" ...>Web Design Trends for 2026</h1>` line:

```html
    <p class="eyebrow" style="margin-top: 1rem;">Published September 5, 2026</p>
```

- [ ] **Step 7: Add Article JSON-LD to `blog/2026-web-design-trends.html`**

Immediately before its closing `</head>` tag:

```html
<script type="application/ld+json">
{
  "@context": "https://schema.org",
  "@type": "Article",
  "headline": "Web Design Trends for 2026",
  "description": "Typography, motion, accessibility and performance — the web design trends actually worth paying attention to in 2026.",
  "datePublished": "2026-09-05",
  "author": { "@type": "Organization", "name": "The Webster" },
  "publisher": { "@type": "Organization", "name": "The Webster", "logo": "https://thewebster.net/assets/logo.webp" }
}
</script>
```

- [ ] **Step 8: Validate the JSON-LD**

For each of the 4 modified files, extract the `<script type="application/ld+json">` block's contents and confirm it parses as valid JSON (e.g. `python3 -c "import json,sys; json.load(sys.stdin)"` piped the extracted block, or equivalent). No trailing commas, correctly quoted strings.

- [ ] **Step 9: Verify locally**

Serve the project, open each of the 3 blog posts, and confirm the "Published September 5, 2026" line renders under the headline in the existing eyebrow style. Confirm Home's `<head>` now contains the Organization script block via view-source.

- [ ] **Step 10: Commit**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git add index.html blog/website-speed-and-seo.html blog/signs-you-need-a-redesign.html blog/2026-web-design-trends.html && git commit -m "feat: add Organization and Article schema.org structured data, visible blog post dates"
```

---

### Task 6: Network Map Hero (Home signature element)

**Files:**
- Modify: `styles.css` (append `.network-map` styles)
- Modify: `index.html` (replace the `.orbit` div in the Home hero with the new SVG)

**Interfaces:**
- Produces: `.network-map` class, used only in `index.html`'s hero — no other file references it.
- Consumes: existing `--blue`/`--violet`/`--orange`/`--muted` custom properties from `:root` in `styles.css`.

- [ ] **Step 1: Append Network Map styles to `styles.css`**

Add this to the end of `styles.css` (after the `.form-error.visible { display: block; }` rule added in Task 3):

```css

/* ============ network map (Home hero signature element) ============ */
.network-map {
  position: fixed;
  top: 50%;
  left: 50%;
  width: min(70vh, 640px);
  height: min(70vh, 640px);
  transform: translate(-50%, -55%);
  opacity: 0.9;
  pointer-events: none;
  z-index: 0;
}

.network-map .net-path {
  fill: none;
  stroke: url(#netGradient);
  stroke-width: 2;
  stroke-linecap: round;
  opacity: 0.5;
  stroke-dasharray: 300;
  stroke-dashoffset: 300;
  animation: draw-path 1.6s ease-out forwards;
}

.network-map .net-node circle {
  fill: url(#netGradient);
  animation: node-pulse 2.4s ease-in-out infinite;
  animation-delay: var(--delay, 0s);
}

.network-map .net-node text {
  font-family: 'JetBrains Mono', monospace;
  font-size: 13px;
  fill: var(--muted);
  letter-spacing: 0.05em;
}

@keyframes draw-path {
  to { stroke-dashoffset: 0; }
}

@keyframes node-pulse {
  0%, 100% { opacity: 0.6; r: 5; }
  50% { opacity: 1; r: 7; }
}

@media (prefers-reduced-motion: reduce) {
  .network-map .net-path {
    stroke-dashoffset: 0;
    animation: none;
  }
  .network-map .net-node circle {
    animation: none;
    opacity: 1;
  }
}
```

- [ ] **Step 2: Replace the `.orbit` div in `index.html`'s hero**

Replace this line in `index.html` (inside `<section class="hero">`, the Home hero — do not touch any other page's `.orbit` div):

```html
  <div class="orbit" aria-hidden="true"></div>
```

with:

```html
  <div class="network-map" aria-hidden="true">
    <svg viewBox="0 0 600 600" width="100%" height="100%" preserveAspectRatio="xMidYMid meet">
      <defs>
        <linearGradient id="netGradient" x1="0%" y1="0%" x2="100%" y2="100%">
          <stop offset="0%" stop-color="#2e6ff2"/>
          <stop offset="55%" stop-color="#8b2ff0"/>
          <stop offset="100%" stop-color="#ff7a2e"/>
        </linearGradient>
      </defs>
      <path class="net-path" d="M 300 90 Q 300 300 300 300"/>
      <path class="net-path" d="M 510 220 Q 400 260 300 300"/>
      <path class="net-path" d="M 460 480 Q 380 390 300 300"/>
      <path class="net-path" d="M 140 480 Q 220 390 300 300"/>
      <path class="net-path" d="M 90 220 Q 200 260 300 300"/>
      <g class="net-node" style="--delay:0s"><circle cx="300" cy="90" r="6"/><text x="300" y="70" text-anchor="middle">US</text></g>
      <g class="net-node" style="--delay:0.3s"><circle cx="510" cy="220" r="6"/><text x="522" y="216">UK</text></g>
      <g class="net-node" style="--delay:0.6s"><circle cx="460" cy="480" r="6"/><text x="472" y="500">CA</text></g>
      <g class="net-node" style="--delay:0.9s"><circle cx="140" cy="480" r="6"/><text x="90" y="500" text-anchor="end">AU</text></g>
      <g class="net-node" style="--delay:1.2s"><circle cx="90" cy="220" r="6"/><text x="78" y="216" text-anchor="end">NZ</text></g>
    </svg>
  </div>
```

- [ ] **Step 3: Verify locally**

Serve the project, open `index.html`, and confirm: the five gradient-stroked paths draw in on page load (a short animated stroke reveal), then each node pulses gently and continuously; the five country labels (US/UK/CA/AU/NZ) are legible and positioned around the hero without overlapping the headline text; the logo mark still renders on top, unobscured. Emulate `prefers-reduced-motion: reduce` and confirm the paths render fully-drawn immediately with no animation, and the nodes render at full opacity with no pulse. Confirm every other page (e.g. `services.html`, `about.html`) still shows the original `.orbit` element, unchanged.

- [ ] **Step 4: Commit**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git add styles.css index.html && git commit -m "feat: replace Home hero's orbit ring with an animated network map signature element"
```

---

### Task 7: "The Problem" section + honest numbers strip

**Files:**
- Modify: `styles.css` (append `.stats-strip`/`.stat`/`.stat-number`/`.stat-label` styles)
- Modify: `index.html` (insert two new sections)

**Interfaces:**
- Produces: `.stats-strip`, `.stat`, `.stat-number`, `.stat-label` classes — used only on `index.html`.

- [ ] **Step 1: Append stats-strip styles to `styles.css`**

Add this to the end of `styles.css` (after the Network Map styles from Task 6):

```css

/* ============ stats strip ============ */
.stats-strip {
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
  gap: 3rem;
}

.stat {
  display: flex;
  flex-direction: column;
  align-items: center;
  text-align: center;
}

.stat-number {
  font-family: 'Space Grotesk', sans-serif;
  font-weight: 700;
  font-size: clamp(2.5rem, 5vw, 3.5rem);
  background: var(--gradient);
  -webkit-background-clip: text;
  background-clip: text;
  color: transparent;
  line-height: 1;
}

.stat-label {
  margin-top: 0.5rem;
  font-family: 'JetBrains Mono', monospace;
  font-size: 0.8125rem;
  letter-spacing: 0.05em;
  color: var(--muted);
  text-transform: uppercase;
}
```

- [ ] **Step 2: Insert "The Problem" section into `index.html`**

Immediately after the closing `</section>` of the Home hero (`<section class="hero">...</section>`) and before `<section class="section">` (the "What We Do" section), insert:

```html
<section class="section">
  <div class="container" style="max-width: 720px; text-align: center;">
    <p class="eyebrow reveal">Why This Matters</p>
    <h2 class="section-title reveal">Great businesses lose customers to weaker competitors — because of a weaker website.</h2>
    <p class="reveal" style="color: var(--muted); line-height: 1.8; font-size: 1.0625rem;">
      It's not talent or service that decides who gets found first. It's who shows up when a customer
      searches, and who looks credible the moment they land. The Webster exists to close that gap — for
      local businesses and international clients alike.
    </p>
  </div>
</section>

```

- [ ] **Step 3: Insert the numbers strip into `index.html`**

Immediately after the closing `</section>` of the "Recent Work" section (`<section class="section section-alt">...Recent Work...</section>`) and before the final `<section class="section" style="text-align:center;">` (the "Ready to be seen?" CTA section), insert:

```html
<section class="section">
  <div class="container">
    <div class="stats-strip">
      <div class="stat reveal">
        <span class="stat-number">5</span>
        <span class="stat-label">Countries Served</span>
      </div>
      <div class="stat reveal">
        <span class="stat-number">3</span>
        <span class="stat-label">Projects Delivered</span>
      </div>
      <div class="stat reveal">
        <span class="stat-number">4</span>
        <span class="stat-label">Services Offered</span>
      </div>
    </div>
  </div>
</section>

```

- [ ] **Step 4: Verify locally**

Serve the project, open `index.html`, and confirm the page now reads, top to bottom: Hero → "Why This Matters" (Problem) → "What We Do" → "Recent Work" → numbers strip (5 / 3 / 4) → "Ready to be seen?" CTA → footer. Confirm both new sections reveal-on-scroll like the rest of the page, and that the numbers strip's three stats are legible and evenly spaced at both desktop and mobile widths.

- [ ] **Step 5: Commit**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git add styles.css index.html && git commit -m "feat: add Home narrative Problem section and honest numbers strip"
```

---

### Task 8: Case-study browser-chrome frame

**Files:**
- Modify: `styles.css` (append `.browser-frame`/`.frame-tags` styles)
- Modify: `index.html` (wrap the 3 "Recent Work" images)
- Modify: `portfolio.html` (wrap the 3 case-study images)

**Interfaces:**
- Consumes: the `.webp` portfolio image filenames produced by Task 2 — this task must run after Task 2 is complete and merged.

- [ ] **Step 1: Append browser-frame styles to `styles.css`**

Add this to the end of `styles.css` (after the stats-strip styles from Task 7):

```css

/* ============ case-study browser-chrome frame ============ */
.browser-frame {
  position: relative;
  border-radius: 8px;
  overflow: hidden;
}

.browser-frame-bar {
  display: flex;
  gap: 6px;
  padding: 8px 10px;
  background: rgba(255, 255, 255, 0.05);
}

.browser-frame-bar span {
  width: 8px;
  height: 8px;
  border-radius: 50%;
  background: rgba(255, 255, 255, 0.2);
}

.browser-frame img {
  display: block;
  width: 100%;
  height: auto;
}

.frame-tags {
  position: absolute;
  left: 0;
  right: 0;
  bottom: 0;
  display: flex;
  flex-wrap: wrap;
  gap: 0.4rem;
  padding: 0.75rem;
  background: linear-gradient(to top, rgba(10, 13, 22, 0.92), transparent);
  opacity: 0;
  transform: translateY(8px);
  transition: opacity 0.25s ease, transform 0.25s ease;
}

.browser-frame:hover .frame-tags {
  opacity: 1;
  transform: translateY(0);
}

.frame-tags span {
  font-family: 'JetBrains Mono', monospace;
  font-size: 0.6875rem;
  padding: 0.25rem 0.6rem;
  border-radius: 999px;
  background: rgba(255, 255, 255, 0.08);
  color: var(--text);
}

@media (prefers-reduced-motion: reduce) {
  .frame-tags { transition: none; }
}
```

- [ ] **Step 2: Wrap `index.html`'s 3 "Recent Work" images**

Replace this (the Optique card in the "Recent Work" section):

```html
      <a href="portfolio.html" class="card reveal" style="text-decoration:none;">
        <img src="assets/portfolio/optique-borehole-drilling.webp" alt="Optique Borehole Drilling website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1rem;">
        <h3>Optique Borehole Drilling</h3>
        <p>Precision water solutions across Gauteng, South Africa.</p>
      </a>
```

with:

```html
      <a href="portfolio.html" class="card reveal" style="text-decoration:none;">
        <div class="browser-frame" style="margin-bottom:1rem;">
          <div class="browser-frame-bar"><span></span><span></span><span></span></div>
          <img src="assets/portfolio/optique-borehole-drilling.webp" alt="Optique Borehole Drilling website" width="1200" height="750" loading="lazy">
          <div class="frame-tags"><span>5 pages</span><span>Custom logo work</span><span>Call/WhatsApp CTAs</span></div>
        </div>
        <h3>Optique Borehole Drilling</h3>
        <p>Precision water solutions across Gauteng, South Africa.</p>
      </a>
```

Replace this (the Reliable Runner Courier card):

```html
      <a href="portfolio.html" class="card reveal" style="text-decoration:none;">
        <img src="assets/portfolio/reliable-runner-courier.webp" alt="Reliable Runner Courier website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1rem;">
        <h3>Reliable Runner Courier</h3>
        <p>Local delivery service serving Cape Town.</p>
      </a>
```

with:

```html
      <a href="portfolio.html" class="card reveal" style="text-decoration:none;">
        <div class="browser-frame" style="margin-bottom:1rem;">
          <div class="browser-frame-bar"><span></span><span></span><span></span></div>
          <img src="assets/portfolio/reliable-runner-courier.webp" alt="Reliable Runner Courier website" width="1200" height="750" loading="lazy">
          <div class="frame-tags"><span>Single-page site</span><span>Business-solutions section</span></div>
        </div>
        <h3>Reliable Runner Courier</h3>
        <p>Local delivery service serving Cape Town.</p>
      </a>
```

Replace this (the Vuka Digital card):

```html
      <a href="portfolio.html" class="card reveal" style="text-decoration:none;">
        <img src="assets/portfolio/vuka-digital.webp" alt="Vuka Digital website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1rem;">
        <h3>Vuka Digital</h3>
        <p>The agency's own animated, Next.js-built marketing site.</p>
      </a>
```

with:

```html
      <a href="portfolio.html" class="card reveal" style="text-decoration:none;">
        <div class="browser-frame" style="margin-bottom:1rem;">
          <div class="browser-frame-bar"><span></span><span></span><span></span></div>
          <img src="assets/portfolio/vuka-digital.webp" alt="Vuka Digital website" width="1200" height="750" loading="lazy">
          <div class="frame-tags"><span>Next.js</span><span>Animated hero</span><span>Pricing page</span></div>
        </div>
        <h3>Vuka Digital</h3>
        <p>The agency's own animated, Next.js-built marketing site.</p>
      </a>
```

- [ ] **Step 3: Wrap `portfolio.html`'s 3 case-study images**

Replace this (Optique card, note this page's slightly different `1.25rem` margin and card structure — no wrapping `<a>`, the outer element is a plain `<div class="card reveal">`):

```html
      <div class="card reveal">
        <img src="assets/portfolio/optique-borehole-drilling.webp" alt="Optique Borehole Drilling website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1.25rem;">
        <h3>Optique Borehole Drilling</h3>
```

with:

```html
      <div class="card reveal">
        <div class="browser-frame" style="margin-bottom:1.25rem;">
          <div class="browser-frame-bar"><span></span><span></span><span></span></div>
          <img src="assets/portfolio/optique-borehole-drilling.webp" alt="Optique Borehole Drilling website" width="1200" height="750" loading="lazy">
          <div class="frame-tags"><span>5 pages</span><span>Custom logo work</span><span>Call/WhatsApp CTAs</span></div>
        </div>
        <h3>Optique Borehole Drilling</h3>
```

Replace this (Reliable Runner Courier card):

```html
      <div class="card reveal">
        <img src="assets/portfolio/reliable-runner-courier.webp" alt="Reliable Runner Courier website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1.25rem;">
        <h3>Reliable Runner Courier</h3>
```

with:

```html
      <div class="card reveal">
        <div class="browser-frame" style="margin-bottom:1.25rem;">
          <div class="browser-frame-bar"><span></span><span></span><span></span></div>
          <img src="assets/portfolio/reliable-runner-courier.webp" alt="Reliable Runner Courier website" width="1200" height="750" loading="lazy">
          <div class="frame-tags"><span>Single-page site</span><span>Business-solutions section</span></div>
        </div>
        <h3>Reliable Runner Courier</h3>
```

Replace this (Vuka Digital card):

```html
      <div class="card reveal">
        <img src="assets/portfolio/vuka-digital.webp" alt="Vuka Digital website" width="1200" height="750" loading="lazy" style="width:100%; border-radius:8px; margin-bottom:1.25rem;">
        <h3>Vuka Digital</h3>
```

with:

```html
      <div class="card reveal">
        <div class="browser-frame" style="margin-bottom:1.25rem;">
          <div class="browser-frame-bar"><span></span><span></span><span></span></div>
          <img src="assets/portfolio/vuka-digital.webp" alt="Vuka Digital website" width="1200" height="750" loading="lazy">
          <div class="frame-tags"><span>Next.js</span><span>Animated hero</span><span>Pricing page</span></div>
        </div>
        <h3>Vuka Digital</h3>
```

- [ ] **Step 4: Verify locally**

Serve the project, open `index.html` and `portfolio.html`, and confirm on both pages: each screenshot now sits inside a browser-chrome frame (thin dot-bar above the image), and hovering a card reveals the tag list sliding up from the bottom of the frame. Confirm the tags shown match the facts already stated in each case study's copy (no new claims). Check mobile width: confirm the frame and tags don't overflow or look cramped on narrow viewports (tags wrap via `flex-wrap`).

- [ ] **Step 5: Commit**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git add styles.css index.html portfolio.html && git commit -m "feat: add browser-chrome frame and hover tag reveal to case-study images"
```

---

### Task 9: About page pull-quote

**Files:**
- Modify: `styles.css` (append `.pull-quote` styles)
- Modify: `about.html` (convert the mission-statement paragraph to a blockquote)

**Interfaces:**
- Produces: `.pull-quote` class, used only in `about.html`.

- [ ] **Step 1: Append pull-quote styles to `styles.css`**

Add this to the end of `styles.css` (after the browser-frame styles from Task 8):

```css

/* ============ about page pull-quote ============ */
.pull-quote {
  position: relative;
  margin: 0 0 2rem;
  padding-left: 1.75rem;
  border-left: 3px solid transparent;
  border-image: var(--gradient) 1;
  font-family: 'Space Grotesk', sans-serif;
  font-size: 1.375rem;
  line-height: 1.6;
  color: var(--text);
}
```

- [ ] **Step 2: Convert the mission statement to a pull-quote in `about.html`**

Replace this (the first of the two paragraphs in the About page's main section — the verbatim mission statement):

```html
    <p class="reveal" style="color:var(--text); line-height:1.8; font-size:1.0625rem;">
      The Webster is a web design and SEO agency dedicated to helping businesses establish a
      strong online presence. We create modern, high-performing websites and effective digital
      strategies that attract customers and drive growth. Combining creativity with technical
      expertise, we deliver solutions designed to build trust, strengthen brands, and help
      businesses succeed in an increasingly competitive digital world.
    </p>
```

with:

```html
    <blockquote class="pull-quote reveal">
      The Webster is a web design and SEO agency dedicated to helping businesses establish a
      strong online presence. We create modern, high-performing websites and effective digital
      strategies that attract customers and drive growth. Combining creativity with technical
      expertise, we deliver solutions designed to build trust, strengthen brands, and help
      businesses succeed in an increasingly competitive digital world.
    </blockquote>
```

Do not alter the text itself in any way — only the wrapping tag and class changed. The second paragraph (the South Africa/international-expansion framing, starting "Built on years of work...") is unchanged.

- [ ] **Step 3: Verify locally**

Serve the project, open `about.html`, and confirm the mission statement now renders larger, in the display typeface, with a gradient left border, visually distinct from the second paragraph below it. Confirm the text content is character-for-character identical to before (no wording changed).

- [ ] **Step 4: Commit**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git add styles.css about.html && git commit -m "feat: give About page's mission statement a pull-quote treatment"
```

---

### Task 10: Deploy config, DEPLOY.md cleanup, final QA pass

**Files:**
- Modify: `.cpanel.yml`
- Modify: `DEPLOY.md`

**Interfaces:**
- Consumes: every file created by Tasks 1-9 — this task must run last.

- [ ] **Step 1: Replace `.cpanel.yml`**

```yaml
---
deployment:
  tasks:
    - export REPO=/home/thewebster/repositories/TheWebster
    - export DOCROOT=/home/thewebster/public_html
    - cp -R $REPO/index.html $DOCROOT/index.html
    - cp -R $REPO/services.html $DOCROOT/services.html
    - cp -R $REPO/portfolio.html $DOCROOT/portfolio.html
    - cp -R $REPO/process.html $DOCROOT/process.html
    - cp -R $REPO/about.html $DOCROOT/about.html
    - cp -R $REPO/contact.html $DOCROOT/contact.html
    - cp -R $REPO/contact-handler.php $DOCROOT/contact-handler.php
    - cp -R $REPO/privacy.html $DOCROOT/privacy.html
    - cp -R $REPO/terms.html $DOCROOT/terms.html
    - cp -R $REPO/404.html $DOCROOT/404.html
    - cp -R $REPO/.htaccess $DOCROOT/.htaccess
    - cp -R $REPO/styles.css $DOCROOT/styles.css
    - cp -R $REPO/script.js $DOCROOT/script.js
    - cp -R $REPO/sitemap.xml $DOCROOT/sitemap.xml
    - cp -R $REPO/robots.txt $DOCROOT/robots.txt
    - mkdir -p $DOCROOT/assets
    - cp -R $REPO/assets/. $DOCROOT/assets/
    - mkdir -p $DOCROOT/blog
    - cp -R $REPO/blog/. $DOCROOT/blog/
```

- [ ] **Step 2: Fix the stale line in `DEPLOY.md`**

Replace this line:

```markdown
2. **Deploy HEAD Commit** — runs the tasks in `.cpanel.yml`, which copy `index.html`, `styles.css`, and `assets/` into the site's document root.
```

with:

```markdown
2. **Deploy HEAD Commit** — runs the tasks in `.cpanel.yml`, which copy every page (including `privacy.html`, `terms.html`, `404.html`), `contact-handler.php`, `.htaccess`, `styles.css`, `script.js`, `sitemap.xml`, `robots.txt`, `assets/`, and `blog/` into the site's document root.
```

- [ ] **Step 3: Full local QA pass**

With the project served locally, visit every page and verify:
- **Every page** (`index.html`, `services.html`, `portfolio.html`, `process.html`, `about.html`, `contact.html`, `privacy.html`, `terms.html`, `404.html`, `blog/index.html`, and all 3 blog posts — 13 pages total): nav links resolve, footer links resolve (including the new LEGAL column on all 13), active nav item correctly marked where applicable.
- `index.html` specifically: Network Map Hero animates in and settles into its pulse loop; "The Problem" section appears after the hero; numbers strip (5/3/4) appears after "Recent Work"; all 3 "Recent Work" cards show the browser-chrome frame with hover tags.
- `portfolio.html`: all 3 case-study cards show the browser-chrome frame with hover tags, using the new `.webp` images.
- `about.html`: mission statement renders as a pull-quote.
- `contact.html`: both `?sent=1` and `?error=1` still correctly reveal their respective messages.
- `privacy.html`/`terms.html`: render correctly with the new LEGAL footer column present (pointing at themselves and each other).
- `404.html`: renders correctly when visited directly (actual 404-triggering behavior via `.htaccess` can only be confirmed post-deploy).
- Mobile viewport (~375px): no horizontal overflow on any of the 13 pages, nav collapses correctly everywhere.
- `prefers-reduced-motion`: Network Map Hero freezes fully-drawn with no pulse; existing reveal/orbit/card/button behaviors remain correctly neutralized (regression check).
- No console errors on any of the 13 pages.

- [ ] **Step 4: Commit**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git add .cpanel.yml DEPLOY.md && git commit -m "chore: extend deploy config for new pages/assets, fix stale DEPLOY.md file list"
```

- [ ] **Step 5: Push**

```bash
cd "/c/Users/ubzma/Desktop/The Webster" && git push
```

Do NOT attempt to deploy via cPanel — that requires an already-authenticated browser session only the controller has access to. Stop after pushing and report back; the controller will handle the cPanel deploy and post-deploy verification (including confirming `.htaccess`'s 404 behavior actually works in production) separately.
