# Wordpress + Timber + ACF + Vite

This is a starter theme for Wordpress that uses modern dev tools.

## Installation and Setup

1. [Install Composer](https://getcomposer.org/doc/00-intro.md).
2. [Install Node and NPM](https://github.com/nvm-sh/nvm).
3. [Install Local WP](https://localwp.com).
4. Set up a new site. You can follow Local WP's [help docs](https://localwp.com/help-docs/).
5. Add this theme to the theme dir for your local wordpress site: `/app/public/wp-content/themes/`. You can open this in Local WP by clicking the "Go to Site Folder" button right below the site title.
6. Open the theme in your code editor.
7. Install node deps: `npm i`.
8. Install php deps: `composer install`.
9. Run `npm run dev` to start the live dev server.

## Best Practices

The charm of web development is how flexible it is, and there's no reason to undermine that, but we do want to balance that with some gentle constraints so that things don't get messy. Here are some guidelines:

### Functions

Notate any custom php functions with a [DocBlock comment](https://make.wordpress.org/core/handbook/best-practices/inline-documentation-standards/php/#docblock-formatting) so that others can understand at a glance what it does, what params it expects, and what it returns.

### SCSS

By default, any scss you write in `/templates/*/**` will automatically be imported.
**Favor readability and simplicity and portability over specificity**. When possible, avoid deeply-nested rules; they are tightly coupled to a specific HTML structure, and make it more difficult to modify, extend, and reuse components.
**Favor CSS Custom Props over SASS vars.** [CSS custom props](https://developer.mozilla.org/en-US/docs/Web/CSS/Using_CSS_custom_properties) are more flexible, extensible, and they still exist after build time.

### JS

Write your js as ES6 modules. Import and init js in `/src/main.js`. You can import from node_modules, or via a relative path.

## Technology

### Composer

[Composer](https://getcomposer.org/) is the de facto package manager for PHP. It provides a systematic way to share and load 3rd-party PHP packages. Composer's default repo is [Packagist](https://packagist.org/).

### Node/NPM

[Node](https://nodejs.org/en/) is a js runtime for servers, but it is also used extensively to run live dev environments for frontend projects. [NPM](https://www.npmjs.com/) is the package manager for Node. It provides a systematic way to share and load third-party js packages.

### Local WP

[Local WP](https://localwp.com/) is a containerized desktop development environment for Wordpress. It includes a server that runs PHP, MySQL, and nginx/apache on your local device. This allows you to set up and run a Wordpress site on your computer for rapid, low-stakes development.

### Twig

[Twig](https://twig.symfony.com/) is a php-based templating language with a concise, powerful syntax.

### Timber

[Timber](https://timber.github.io/docs/v2/) makes Twig work with Wordpress. With Timber, you write your HTML separate from Wordpress's traditional theme PHP files. This cleans-up your theme code so your PHP file can focus on supplying the data and logic, while your twig file can focus 100% on the display and HTML.

### ACF Pro

[ACF](https://www.advancedcustomfields.com/) is the industry standard for adding custom fields to a content type in Wordpress. The [Pro](https://www.advancedcustomfields.com/pro/) version provides an incredibly efficient way to create custom blocks for the WP Block Editor

### Timber ACF WP Blocks

This little [plugin](https://palmiak.github.io/timber-acf-wp-blocks/#/) for Timber makes it even easier to instantiate new custom blocks. You just add a formatted comment at the top of your component, and that makes it available to use as a custom block in the WP Block Editor.

### Vite

[Vite](https://vitejs.dev/) is a modern js build tool. Vite does 2 things for us:

1. **Local Dev Server:** Changes you make in your theme will be reflected in your browser without you needing to manually refresh the page. Vite streams changes to js/scss directly to the browser and reloads the code in near real time. Vite also watches template files and will refresh the browser if your markup changes.
2. **Production Asset Bundler** Vite bundles and optimizes your code into production-ready files.

## Theme Structure

**/** The theme root contains the default Wordpress template files (index.php, page.php, post.php, archive.php etc). These behave kind of like models where we get and prepare the data for display in the template, and kind of like controllers because this is where you can specify which Twig template you want to use.

**/dist** contains the compiled styles, scripts, and assets that get loaded on the front-end. Don't edit these, they are automatically created by Vite.

**/lib** contains grouped functions and definitions that have been abstracted out of functions.php to keep things organized.

**/node_modules** These are js deps managed by npm. Don't edit these files directly, these packages are under version control and should stay that way.

**/public** contains static assets that get passed through to /dist. Things like favicons, fonts, etc. **NOTE:** Static files from `/public` referenced in css don't really work. Apparently you can symlink your site root to your template dir, but that seems a little hacky to me, and I'm not sure what the CI/CD story is with that. The place I run into this most often is locally-hosted fonts; I typically just add a fonts.css file with the @font-face declarations alongside the font-files in `/public`, then just enqueue that css file separately.

**/src** contains the catchall for the working files for global styles/scripts. This compiles into /dist.

**/templates** contains the template files for specific pages/post types along with reusable components.

**/vendor** These are php deps managed by [Composer](https://getcomposer.org/). Timber and Timber ACF WP Blocks live here. Don't edit these files directly, this is like NPM for PHP, these packages are under version control and should stay that way.

**.env** This file allows us to assign variables that can be understood by both the node universe and the PHP universe.

## Components

Reusable UI components have been broken out into individual dirs. These components can be hooked into WP's Block Editor via [Timber ACF WP Blocks](https://github.com/palmiak/timber-acf-wp-blocks). Components each have their own dir that usually contains 3 files:

- Template file: component-name.twig. Use this in other templates via [include](https://twig.symfony.com/doc/2.x/tags/include.html) or [embed](https://twig.symfony.com/doc/2.x/tags/embed.html).
- Style file: component-name.scss.
- Script file: component-name.js Write these as an ES6 module. Import and instantiate it in /src/main.js.

## Q&A

### What kind of site is this for?

This theme is well-suited for medium-to-large sites where you need to provide a gradient of control to content editors: A set of custom blocks for idiot-proof page building, and the standard Worpdress blocks for more capable editors.

### Why not just build an FSE (Full Site Editing) theme?

FSE themes _do_ provide a way to build custom UI elements though [patterns](https://fullsiteediting.com/lessons/introduction-to-block-patterns/). Patterns have a major shortcoming though. If you ever need to change the style or markup of a pattern, there is currently no way to update all the existing instances of that pattern. A pattern is really just markup that you can paste into the block editor. Custom blocks on the other hand _can_ be updated ex post facto simply by re-saving the post that contains the custom block.

### Why not just build a traditional WP theme? Why is Twig here?

PHP is a little awkward and wordy for templating especially when it comes to loops and conditions. Twig clears that up by allowing you to write standard HTML, with clear, precise interventions for vars, loops, and conditions. Additionally, a templating language pushes you toward good habits that are really helpful as your site scales up. Separation of business logic from display logic, and componentization are a big help as your site becomes more complex.
