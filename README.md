MarkPress
=========

Write short Markdown notes in WordPress

##Help developing

1. Install Vagrant
2. Install Node.js
3. Create a folder in the root called `www`
4. Put a WordPress install in `www`
5. Use the following database credentials:
	- User: `root`
	- Password: `root`
	- Database: `wordpress`
6. Go to the `vagarant` folder in the terminal
7. Run: `vagrant up`
8. Put `192.168.56.125 markdown.dev`  in your hosts file
9. To start watching Sass and JavaScript run `gulp watch` in the terminal
10. The site can be found at `markdown.dev` in the webbrowser