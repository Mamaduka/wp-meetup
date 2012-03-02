wp-meetup readme
================

2012 is the [Year of the WordPress Meetup](http://wordpress.org/news/2012/01/year-of-the-meetup/). This theme was created for the [WordPress Meetup group in Zurich](http://www.wp-zuri.ch), but can be used anywhere else with minor option tweaks.

installation
------------

This is a single-page theme, so you'll want to set your homepage to the page template Home (page-home.php), and then edit the following code block to get you started (top of functions.php, uncomment it):

	update_option( 'meetup_apikey', '' ); // Your Meetup API Key, i.e. 70144d1d5ea9566d4563
	update_option( 'meetup_group', '' ); // Your Group URL , i.e. WordPress-Zurich
	update_option( 'meetup_question_url', '' ); // the ID for the Recent Works URL Question, i.e. 1637322
	update_option( 'meetup_question_img', '' ); // the ID for the Recent Works Image URL Question, i.e.  1637332
