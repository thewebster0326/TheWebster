# thewebster.net — Full Marketing Site Design

## Context

thewebster.net currently serves a static coming-soon page (`index.html` + `styles.css`, deployed live via cPanel Git Version Control). This spec covers replacing it with a full marketing site for The Webster's international arm — a web design & SEO agency based in South Africa, expanding to serve clients in the US, UK, Canada, Australia, and New Zealand.

This is explicitly framed (by the user) as a "$15,000-tier" website: custom design, real strategy, and real content — not a template swap. The build quality bar is: custom design system carried through every page, genuine copywriting, real portfolio proof, and technical care (performance, accessibility, SEO structure) — not just more pages bolted onto the coming-soon page.

## Goals

- Replace the coming-soon page with a complete 7-section marketing site that can start generating international enquiries.
- Keep the existing brand system (established on the live coming-soon page) consistent across every new page, so the transition reads as one continuous brand rather than a reskin.
- Ship with real content: real portfolio case studies, real service descriptions, real (non-fabricated) blog posts, and the company mission statement the user provided directly.
- No public pricing — every page funnels toward the Contact page ("Get a Quote").

## Non-goals

- No CMS, no build step, no JavaScript framework. Static HTML/CSS/JS only, matching the existing deploy pipeline.
- No blog authoring tooling (e.g. markdown pipeline, static site generator). Posts are hand-authored HTML files.
- No fabricated testimonials, reviews, or client quotes. The site has no client-testimonial section because none exist yet for the international market.
- No personal founder photo/bio — the About page is company-level (per the mission statement provided), not a personal founder story.

## Site structure

Static multi-page site, same pattern as the user's other static-HTML client sites (e.g. Optique Borehole Drilling): every page is a standalone `.html` file sharing common CSS/JS, with the header/nav/footer markup duplicated across files (no templating engine, by design — see Non-goals).

```
The Webster/
├── index.html                              (Home — replaces coming-soon content)
├── services.html                           (Services)
├── portfolio.html                          (Portfolio)
├── process.html                            (Process)
├── about.html                              (About)
├── contact.html                            (Contact)
├── contact-handler.php                     (form processor, mirrors Optique's pattern)
├── blog/
│   ├── index.html                          (Blog listing)
│   ├── website-speed-and-seo.html
│   ├── signs-you-need-a-redesign.html
│   └── 2026-web-design-trends.html
├── assets/
│   ├── logo.webp                           (existing)
│   └── portfolio/                          (new — screenshots of the 3 case-study sites)
├── styles.css                              (extended, not replaced)
├── script.js                               (new — nav toggle, scroll reveal, form handling)
├── .cpanel.yml                             (extended to copy new pages/folders)
├── DEPLOY.md                               (extended: note the info@thewebster.net mailbox requirement)
└── README.md                               (updated to describe the full site, not just coming-soon)
```

## Visual system

Carries over the brand system already live on the coming-soon page — this is a continuation, not a new direction:

- **Palette**: near-black canvas (`--ink: #0a0d16`), `--surface: #12172a`, gradient accent `--blue: #2e6ff2` → `--violet: #8b2ff0` → `--orange: #ff7a2e`, text `--text: #f5f6fa`, muted `--muted: #8a93b3`.
- **Type**: Space Grotesk (display/headings), Inter (body), JetBrains Mono (eyebrows, labels, nav small-caps).
- **Signature motif**: the slow-rotating conic-gradient orbit ring from the coming-soon hero recurs site-wide — prominent on the Home hero, subtler (smaller, more blurred, lower opacity) as an ambient background element on inner pages so it doesn't compete with page content.
- **Motion**: lightweight scroll-reveal (IntersectionObserver-based fade/slide-up on section entry) and hover micro-interactions on cards/buttons, consistent with the restrained, deliberate motion already established. Respects `prefers-reduced-motion`.
- **Responsive**: mobile-first, same breakpoint approach as the coming-soon page (single `@media (max-width: 480px)` tier plus fluid `clamp()` type sizing), extended as needed per page.

## Page-by-page content plan

### Home (`index.html`)
- Hero: tagline "Every business deserves to be seen," sub-line introducing The Webster's international expansion, orbit-ring signature prominent.
- Market strip: US · UK · Canada · Australia · New Zealand (reused from coming-soon page).
- Services overview: 4 cards (Web Design & Development, E-commerce, SEO & Digital Marketing, Branding/Logo Design), each linking to its anchor on Services.
- Portfolio highlights: 2-3 featured case studies (condensed cards) linking to full Portfolio page.
- Closing CTA to Contact.

### Services (`services.html`)
Four sections, one per service, each with: a short description of what's included, and a "Get a Quote" CTA linking to Contact. Services, in order:
1. Web Design & Development
2. E-commerce
3. SEO & Digital Marketing
4. Branding & Logo Design

### Portfolio (`portfolio.html`)
Three real case studies, each with a screenshot, 2-3 sentence description of what was built and for whom, and a link to the live site:
1. **Optique Borehole Drilling** — precision borehole drilling, pump installation, filtration and water solutions across Gauteng, South Africa. 5-page site (Home/About/Services/Gallery/Contact) with custom logo work and floating call/WhatsApp contact buttons.
2. **Reliable Runner Courier** — local collection and delivery service for businesses and individuals in Cape Town. Single-page site with service breakdown and business-solutions section.
3. **Vuka Digital** — the agency's own Next.js-built marketing site, with animated/interactive elements, services, portfolio, and pricing sections.

### Process (`process.html`)
A genuinely sequential flow — numbered steps are appropriate here (unlike Home/Services, which don't get numbered markers):
1. **Discovery** — understand the business, audience, and goals.
2. **Design** — custom visual direction and layout, specific to the brand.
3. **Development** — build, test across devices, integrate any required functionality.
4. **Launch & Growth** — go live, then ongoing SEO/support as needed.

### About (`about.html`)
Built around the mission statement the user provided verbatim:

> "The Webster is a web design and SEO agency dedicated to helping businesses establish a strong online presence. We create modern, high-performing websites and effective digital strategies that attract customers and drive growth. Combining creativity with technical expertise, we deliver solutions designed to build trust, strengthen brands, and help businesses succeed in an increasingly competitive digital world."

Expanded with a short framing paragraph on the international expansion (serving US/UK/CA/AU/NZ alongside the existing South African client base). Company-level — no personal bio, no photo (per Non-goals).

### Blog (`blog/index.html` + 3 posts)
Listing page linking to 3 launch posts. Topics are general, evergreen, non-fabricated educational content (no invented case-study numbers or client claims):
1. "How Website Speed Affects Your SEO Ranking"
2. "5 Signs Your Website Needs a Redesign"
3. "Web Design Trends for 2026"

### Contact (`contact.html`)
Form fields: name, email, message. Submits to `contact-handler.php`, which emails `info@thewebster.net` — same pattern as the Optique Borehole Drilling site's `contact-handler.php`. DEPLOY.md will note that the `info@thewebster.net` mailbox must exist in cPanel Email Accounts for delivery to work (mirroring the note already written for Optique's `info@` mailbox).

## Technical approach

- **No build step.** Every page is hand-authored static HTML, consistent with the "Static HTML/CSS/JS" decision already made (matches the current, working cPanel deploy pipeline — no risk of introducing an npm/Node build step on this hosting account).
- **Contact form backend**: PHP mail handler (`contact-handler.php`), following the exact pattern already proven on Optique Borehole Drilling's site rather than inventing a new approach.
- **Deploy**: extend the existing `.cpanel.yml` to copy the new pages, `blog/`, `contact-handler.php`, `script.js`, and `assets/portfolio/` into the docroot alongside the files it already copies. No change to the deploy mechanism itself (cPanel Git Version Control, `Deploy HEAD Commit`).
- **Portfolio screenshots**: captured directly from the three live/local project files already in the `shilajit` workspace (Optique, Reliable Runner Courier, Vuka Digital) rather than stock imagery.

## Testing / QA plan

- Local preview via a simple static server (as used for the coming-soon page) before every deploy.
- Visual check of every page at desktop and mobile widths.
- Verify all internal links (nav, footer, CTAs, portfolio "visit site" links) resolve correctly.
- Verify the contact form submits and reaches `info@thewebster.net` once that mailbox exists (flagged as a manual cPanel step, not something this build can verify itself).
- Confirm `prefers-reduced-motion` disables the orbit-ring animation and scroll-reveal transitions, consistent with the coming-soon page's existing behavior.

## Open items / follow-ups (not blocking this build)

- The `info@thewebster.net` mailbox needs to be created in cPanel before the contact form can deliver mail — flagged in DEPLOY.md, not something this build can do itself (requires cPanel access).
- No client testimonials exist yet for the international market — the site ships without a testimonials section; add one later once real international client feedback exists.
