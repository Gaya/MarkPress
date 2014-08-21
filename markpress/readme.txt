=== Plugin Name ===
Contributors: gayadesign
Donate link: http://gaya.ninja/
Tags: MarkPress, Markdown, Mark down, Journal, notes, ajax
Requires at least: 3.0.1
Tested up to: 3.9.2
Stable tag: 0.1.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Takes over your WordPress install on activation and enables the user to quickly write MarkDown powered journal notes.

== Description ==

Write Markdown journal notes using WordPress.

= What does it do? =

- Takes over your WordPress install on activation
- Enables the user to quickly write Markdown powered journal notes *without* using `wp-admin`
- Type Markdown on the left, see styled output *live updated* on the right
- Only works when user is logged in
- Automatically saves
- Quickly add new notes
- Works on mobile
- *Is plain awesome*

= Also on GitHub =

Want to help out or fork the plugin?
[https://github.com/Gaya/MarkPress](https://github.com/Gaya/MarkPress)

= More info =

- [Follow me on Twitter (@GayaNinja)](https://twitter.com/GayaNinja)
- Visit my blog: [gayadesign.com](http://www.gayadesign.com/)

== Installation ==

This section describes how to install the plugin and get it working.

1. Upload the `markpress` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Go to your site and start journaling!

== Frequently Asked Questions ==

= GitHub repository =
Want to help? Great! There is a GitHub repo:
[https://github.com/Gaya/MarkPress](https://github.com/Gaya/MarkPress)

== Screenshots ==

1. Markdown editor and styled content
2. The editor on a mobile display
3. View / read mode on mobile display

== Changelog ==

= 0.1.3 =
* fixed bug which submit form when pressing the return key in input fields
* gets journals through Ajax to decouple template logic
* refactored all 'wp-*' strings to 'mp-*'. WTH was I thinking?!

= 0.1.2 =
* improved sass and html for BEM classes
* disable zoom on mobile
* enable view mode on mobile
* catch keyboard macro for saving in browsers

= 0.1.1 =
* Removed admin bar for everyone
* New posts are now also saved
* Improved docs for WordPress and GitHub repo

= 0.1.0 =
* First working copy
