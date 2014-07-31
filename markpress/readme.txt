=== Plugin Name ===
Contributors: Gaya Kessler
Donate link: http://gaya.ninja/
Tags: markdown, journal, notes
Requires at least: 3.0.1
Tested up to: 3.4
Stable tag: 0.1.1
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Here is a short description of the plugin.  This should be no more than 150 characters.  No markup here.

== Description ==

MarkPress
=========

Write Markdown journal notes using WordPress.

##What does it do?
Takes over your WordPress install on activation and enables the user to quickly write MarkDown powered journal notes.

- Automatically saves
- Quickly add new notes
- Works on mobile
- Is plain awesome

##How to start helping the development
I tried to make development as painless as possible, so I added a Vagrant box and a Gulp automated workflow.

###Tools you need
1. [Download and install Vagrant](http://www.vagrantup.com/downloads.html)
2. [Download and install Node.js](http://nodejs.org/download/)
3. Install the Sass gem (in the terminal):
    gem install sass
4. Install Gulp
    npm install -g gulp

###Running the webserver
1. Clone this repository
    git clone https://github.com/Gaya/MarkPress.git
2. Create a folder in the root called `www`
3. Put [a WordPress install](http://wordpress.org/latest.zip) in `www`
4. Rename `wp-config-sample.php` to `wp-config.php` and change the database credentials to:
	- Database: `wordpress`
	- User: `root`
	- Password: `root`
5. Go to the `vagrant/` folder in the terminal
6. Run: `vagrant up`
7. Put `192.168.56.125 markdown.dev` in your hosts file
8. Go to [http://markpress.dev](http://markpress.dev) in your browser
9. Go through WordPress setup
10. Activate the MarkPress plugin in [http://markpress.dev/wp-admin/](http://markpress.dev/wp-admin/)

###Front-end Development
1. Run `npm install` in the root of the project
2. To start watching Sass and JavaScript run `gulp watch` in the terminal