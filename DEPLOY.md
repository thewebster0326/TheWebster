# Deploying to cPanel

This is a static site (no build step), deployed via cPanel's **Git™ Version Control** feature.

## 1. One-time setup in cPanel

1. Log into cPanel for `thewebster.net`.
2. Open **Git™ Version Control** → **Create**.
3. Choose **Clone a Repository** and set:
   - **Clone URL**: `https://github.com/thewebster0326/TheWebster.git`
   - **Repository Path**: `repositories/TheWebster` (cPanel will show the full path, e.g. `/home/<cpanel_user>/repositories/TheWebster`)
   - **Repository Name**: `TheWebster`
4. Click **Create**.

## 2. Fix `.cpanel.yml`

Open `.cpanel.yml` in this project and replace `<CPANEL_USER>` with your actual cPanel username (visible in the repository path cPanel showed you in step 3), and adjust the docroot path if `thewebster.net` isn't the primary domain on the account (e.g. `public_html/thewebster.net` for an addon domain). Commit and push that change.

## 3. Deploy

Back in cPanel's **Git™ Version Control**, open this repository and use the **Pull or Deploy** tab:

1. **Update from Remote** — pulls the latest commit from GitHub.
2. **Deploy HEAD Commit** — runs the tasks in `.cpanel.yml`, which copy `index.html`, `styles.css`, and `assets/` into the site's document root.

Repeat step 3 after every push (or set up cPanel's webhook/API deploy trigger later for a fully automatic push-to-deploy pipeline — ask if you want that wired up).

## Contact form mailbox

The contact form on `contact.html` posts to `contact-handler.php`, which sends mail to
`info@thewebster.net`. Before enquiries can be delivered, create that mailbox in cPanel:

1. Open **Email Accounts** in cPanel.
2. Click **Create**.
3. Set the username to `info` (so the full address is `info@thewebster.net`) and set a password.
4. Save.

Without this mailbox, form submissions will still redirect to `contact.html?sent=1` (PHP's
`mail()` doesn't report delivery failures back to the form), but the mail itself won't be
delivered anywhere. Test by submitting the form once after deploying and confirming the email
arrives.

## 4. Verify

Visit `https://thewebster.net` and confirm the page loads over HTTPS (issue a free Let's Encrypt certificate in cPanel's **SSL/TLS Status** if one isn't active yet).
