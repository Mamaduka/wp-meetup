<?php

/*
 * Functions Structure
 *
 * - Includes (WP-Less, TLC Transients, WP Thumb) - All GitHub Repo's
 * - Defines
 * - LESS Parsing
 * - Meetup Functions
 * --- People Output
 * --- People Backup (upon transient fail)
 * --- Recent Work Output
 * --- Recent Work Backup (upon transient fail)
 *
 */

// Includes

require_once( 'wp-less/wp-less.php' );
require_once( 'includes/tlc-transients.php' );
require_once( 'WPThumb/wpthumb.php' );

// Defines

define( 'MEETUP_API', get_option('meetup_apikey'));
define( 'MEETUP_GROUP', get_option('meetup_group'));
define( 'MEETUP_LIMIT', get_option('meetup_limit', 100));

// LESS / CSS

function meetup_less() {

    if ( ! is_admin() )
        wp_enqueue_style( 'style', get_stylesheet_directory_uri() . '/less/meetup_styles.less' );

}

add_action('wp_print_styles', 'meetup_less');

// MEETUP.COM - PEOPLE
//--------------------------------

function meetup_people() {

        $api_response = wp_remote_get( 'http://api.meetup.com/members.json?key=' . MEETUP_API . '&sign=true&group_urlname=' . MEETUP_GROUP . '&page=' . MEETUP_LIMIT );
        $mfile = wp_remote_retrieve_body( $api_response );
        $meetup = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $mfile ), true);

        $people = array();
        $peopleindex = array();

        foreach ($meetup['results'] as $person) {

            // Thumb used for Recent Work
            $thumb50 = wpthumb( $person['photo_url'], 'width=50&height=50&crop=1&jpeg_quality=95', false );

            // Thumb used for Header Background
            $thumb80 = wpthumb( $person['photo_url'], 'width=80&height=80&crop=1&jpeg_quality=95', false );

            // Store for Display
            $people[] = array(
                    'id' => $person['id'],
                    'name' => $person['name'],
                    'twitter' => $person['other_services']['twitter']['identifier'],
                    'photo' => $thumb80,
                    'link' => $person['link']
            );

            // Store for cross-referencing against Recent Work (Member ID is used as key)
            $peopleindex[$id] = array(
                    'name' => $person['name'],
                    'twitter' => $person['other_services']['twitter']['identifier'],
                    'photo' => $thumb50,
                    'link' => $person['link']
            );
        }

        // Store count that is displayed within tagline
        update_option('meetup_people_count', count($people));

        // Store Member ID's as Keys
        update_option('meetup_people_index', $peopleindex);

        // Randomize the display of avatars to keep it interesting
        shuffle($people);

        // Output Display HTML

        $i = 0;

        foreach ($people as $person) {

            $thumb = $person['photo'];

            // If blank avatar, skip and do not count towards the total
            if ( $thumb ) {
                $output .= '<div class="home-thumb-person" style="background-image:url(' . $thumb . ')"></div>';
            } else {
                $i -= 1;
            }

            if (++$i == 100) break;

        }

        $output .= $output;

        // Store in case of transient fail
        update_option( 'meetup_people_backup', $output);

        return $output;

}

function meetup_people_backup() {

        $pics = get_option('meetup_people_backup');
        if ( $pics ) { echo $pics; }

}

// MEETUP.COM - RECENT WORK
//--------------------------------

function get_site_title($url){

    // Get <title>$title</title> from remote url
    $str = file_get_contents($url);
    if(strlen($str)>0){
        preg_match("/\<title\>(.*)\<\/title\>/",$str,$title);
        return $title[1];

    }
}

function meetup_recentwork() {

    $i = 0;

    $api_response = wp_remote_get( 'http://api.meetup.com/2/profiles.json?key=' . MEETUP_API . '&sign=true&group_urlname=' . MEETUP_GROUP . '&page=100' );
    $mfile = wp_remote_retrieve_body( $api_response );
    $meetup = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $mfile ), true);

    $recentwork = array();

    foreach ($meetup['results'] as $person) {

        // Create array from profile question responses
        $recentwork[] = array( 'url' => $person['answers'][1]['answer'], 'img'=> $person['answers'][2]['answer'], 'id'=> $person['member_id']);

    }

    // Randomize recent work items to keep it fair & interesting
    shuffle($recentwork);

    $profile = get_option('meetup_people_index');

    $output = '<div class="home-recent-wrap">';

    foreach ($recentwork as $site) {

        $url = $site['url'];
        $img = $site['img'];

        // Skip if questions not answered
        if ( $url && $img ) {

            $thumb = wpthumb( $img, 'width=330&height=220&crop=1&jpeg_quality=95', false );

            $profilepic = $profile[$site['id']]['photo'];
            $name = $profile[$site['id']]['name'];
            $link = $profile[$site['id']]['link'];
            $sitetitle = substr(get_site_title($url), 0, 30) . '...';

            if ( $thumb ) {
                $output .= '<div class="home-thumb-recent" style="background-image:url(' . $thumb . ')"><div class="home-thumb-recent-desc"><a href="' . $link . '"><img src="' . $profilepic . '" /></a><div class="home-recent-title"><a href="' . $url . '" rel="nofollow" target="_blank">' . $sitetitle . '</a></div><div class="home-recent-author"><em>by </em><a href="' . $link . '">' . $name . '</a></div></div></div>';
            } else {
                $i -= 1;
            }

        }

        if (++$i == 100) break;

    }

    $output .= '</div>';

    // Store in case of transient fail
    update_option( 'meetup_recentwork_backup', $output);

    return $output;


}

function meetup_recentwork_backup() {

    $pics = get_option('meetup_recentwork_backup');
    if ( $pics ) { echo $pics; }

}

?>