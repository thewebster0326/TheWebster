# The Webster — thewebster.net

Full marketing site for **The Webster**'s international launch (US, UK, Canada, Australia, New Zealand).

Static HTML/CSS/JS, no build step, no dependencies.

## Pages

- `index.html` — Home
- `services.html` — Services
- `portfolio.html` — Portfolio (real case studies)
- `process.html` — Process
- `about.html` — About
- `blog/` — Blog (index + posts)
- `contact.html` + `contact-handler.php` — Contact form (PHP `mail()`, sends to `info@thewebster.net`)

## Shared files

- `styles.css` — all page styles
- `script.js` — nav toggle, scroll reveal, contact form success message
- `assets/` — logo + portfolio screenshots

## Local preview

```bash
python -m http.server 8080
```

Then visit http://localhost:8080.

## Deploying

See [DEPLOY.md](DEPLOY.md) for pushing this to cPanel.
