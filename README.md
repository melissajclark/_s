[![Build Status](https://travis-ci.org/Automattic/_s.svg?branch=master)](https://travis-ci.org/Automattic/_s)

_s Fork by Melissa Jean Clark
===

I used to have my [own starter theme](https://github.com/melissajclark/wp-content/tree/master/themes/starter-theme), but switched to using `_s` in 2016. 

I've tweaked `_s` for my workflow and preferences. For example, I set up Customizer fields that I use over and over again, and set up the SASS to automatically generate the `editor-style.css` and `login-style.css` files.

## My fork of `_s` has:

- Customizer fields for (see `inc/customizer.php` and `inc/template-tags.php`):
    + 404 Page: Headline, subheadline and paragraph text
    + Search Results Page (nothing found): Headline, subheadline and paragraph text
    + Social Media - set up for Facebook, LinkedIn, Twitter, Instagram, Pinterest. I tweak these as needed for each project.
- WordPress Admin tweaks (see `inc/extras.php`):
    + Set the TinyMCE editor to always show both rows of buttons
    + Set up the format dropdown to the TinyMCE editor, includes base setup with styles for a `.button` selector
    + Set the `wp-login.php` logo to link to the website's home page
    + Set the `wp-login.php` logo to use `/assets/images/logo.svg` instead of the WordPress logo
    + Set the `image_default_link_type` to `none`
    + Enabled support for `excerpt` on `pages` post type
    + Removed the `<p>` tags typically wrapped around images
- Gulp setup via [WPGulp by Ahmad Awais](https://github.com/ahmadawais/WPGulp):
    + It automatically compiles by SASS files and launches BrowserSync for local development
    + Gulp generates the main `style.css` file, and `login-style.css`, `admin-style.css`, `editor-style.css` (these files are enqueued in `inc/extras.php`)
    + With the SASS maps, regular and minified versions of CSS, there's a lot of CSS files. So, I moved them into `assets/css/`.
- CSS Object-fit support via [object-fit-images polyfill](https://github.com/bfred-it/object-fit-images)
    + Includes SASS mixin, see: `assets/sass/mixins/_mixins-master.scss`
    + JavaScript polyfill for support of object-fit in IE: `assets/js/object-fit-polyfill.js`

Some of the functions in `inc/extras.php` are inspired by my friend Linn's [Function Friday](http://drollic.ca/?s=function+friday) series. Thank you Linn!

_s
===

Hi. I'm a starter theme called `_s`, or `underscores`, if you like. I'm a theme meant for hacking so don't use me as a Parent Theme. Instead try turning me into the next, most awesome, WordPress theme out there. That's what I'm here for.

My ultra-minimal CSS might make me look like theme tartare but that means less stuff to get in your way when you're designing your awesome theme. Here are some of the other more interesting things you'll find here:

* A just right amount of lean, well-commented, modern, HTML5 templates.
* A helpful 404 template.
* A custom header implementation in `inc/custom-header.php` just add the code snippet found in the comments of `inc/custom-header.php` to your `header.php` template.
* Custom template tags in `inc/template-tags.php` that keep your templates clean and neat and prevent code duplication.
* Some small tweaks in `inc/extras.php` that can improve your theming experience.
* A script at `js/navigation.js` that makes your menu a toggled dropdown on small screens (like your phone), ready for CSS artistry. It's enqueued in `functions.php`.
* 2 sample CSS layouts in `layouts/` for a sidebar on either side of your content.
* Smartly organized starter CSS in `style.css` that will help you to quickly get your design off the ground.
* Licensed under GPLv2 or later. :) Use it to make something cool.

Getting Started
---------------

If you want to keep it simple, head over to http://underscores.me and generate your `_s` based theme from there. You just input the name of the theme you want to create, click the "Generate" button, and you get your ready-to-awesomize starter theme.

If you want to set things up manually, download `_s` from GitHub. The first thing you want to do is copy the `_s` directory and change the name to something else (like, say, `megatherium`), and then you'll need to do a five-step find and replace on the name in all the templates.

1. Search for `'_s'` (inside single quotations) to capture the text domain.
2. Search for `_s_` to capture all the function names.
3. Search for `Text Domain: _s` in style.css.
4. Search for <code>&nbsp;_s</code> (with a space before it) to capture DocBlocks.
5. Search for `_s-` to capture prefixed handles.

OR

* Search for: `'_s'` and replace with: `'megatherium'`
* Search for: `_s_` and replace with: `megatherium_`
* Search for: `Text Domain: _s` and replace with: `Text Domain: megatherium` in style.css.
* Search for: <code>&nbsp;_s</code> and replace with: <code>&nbsp;Megatherium</code>
* Search for: `_s-` and replace with: `megatherium-`

Then, update the stylesheet header in `style.css` and the links in `footer.php` with your own information. Next, update or delete this readme.

Now you're ready to go! The next step is easy to say, but harder to do: make an awesome WordPress theme. :)

Good luck!
