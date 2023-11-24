# Deepspace Boilerplate Theme

This is a starter theme for Wordpress. Here are some of the main features:

- [Composer](https://getcomposer.org) for PHP dependency management.
- [NPM](https://www.npmjs.com) for js dependency management
- [Vite](https://vitejs.dev) for local dev.

## Local Development Environment

You will need some way to host a php application on your local machine. There are many options (Docker, DDev, MAMP, XAMPP, etc). The one we've found to be the most simple and reliable is [Local WP](https://localwp.com).

## Setup

1. [Install Composer](https://getcomposer.org/doc/00-intro.md).
2. [Install Node and NPM](https://github.com/nvm-sh/nvm).
3. [Install Local WP](https://localwp.com).
4. Pull a site from WPEngine, or set up a new site. You can follow Local WP's [help docs](https://localwp.com/help-docs/).
5. Add this theme to the theme dir for your local wordpress site: `/app/public/wp-content/themes/`. You can open this in Local WP by clicking the "Go to Site Folder" button right below the site title.
6. Open the theme in your code editor.
7. Install node deps: `npm i`.
8. Install php deps: `composer install`.
9. Run `npm run dev` to start the live dev server.
