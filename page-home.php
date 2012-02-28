<?php
/**
 * Template Name: Home
 */

get_header(); ?>

<header class="home">
    <div class="header-overlay"></div>
    <div class="header-people-bg">
    <?php

        // People Feed

        $t = tlc_transient( 'meetup_people_transient' );
        if ( true ) {
            $t->updates_with( 'meetup_people' );
        } else {
            $t->updates_with( 'meetup_people_backup' );
        }

        $t->expires_in( 3600 );
        $t->background_only();
        echo $t->get();

    ?>
    </div>

    <div class="container">

	<div class="row" style="position:relative;z-index:20;">

        <div class="twelvecol">
            <h1 class="home-title">WordPress Zurich Meetup</h1>
            <h3 class="home-tagline">Join <strong><?php echo get_option('meetup_people_count'); ?></strong> awesome people for everything related to WordPress. <a href="http://www.meetup.com/WordPress-Zurich/">Sign up here</a>.</h3>



        </div>

        </div>

    <div>
</header>

<div class="container" id="content">

    <div class="row">

        <div class="clearfix" style="margin-bottom:40px"></div>

            <div class="fourcol">

                <h3 class="home-title">introduction</h3>

                <p>Welcome to Zurich's WordPress Meetup group. We welcome <span class="notice">all skill levels and backgrounds</span>, so no reason to be shy. Simply <a href="http://www.meetup.com/WordPress-Zurich/">sign up</a> on our meetup page and you'll be notified of the next event.</p>

            </div>

            <div class="fourcol">

                <h3 class="home-title">our meetups</h3>
                
                <p>Next meetup is planned for end of March, beginning of April. We will try and feature two case studies/lessons learned from sites built by group members. Still looking for a location/office!</p>

            </div>


            <div class="fourcol last">

                <h3 class="home-title">wordcamp 2012</h3>
                
                <p>It is my goal to create an English-speaking WordCamp in Zurich this year, allowing us to invite everyone else in Switzerland. If you're interested in <span class="notice">helping organize</span>, <span class="notice">sponsor</span>, or <span class="notice">provide a location</span>, please get in touch with me (<a href="mailto:hello@noeltock.com">hello@noeltock.com</a>).</p>

            </div>

            <div class="clearfix"></div>
            <div class="home-sep"></div>

            <div class="twelvecol">

                <h3 class="home-title">recent work by members</h3>
                <p>Here are a selection of works added by users (which they either created themselves or together with others):</p>
                
            </div>

            <div class="twelvecol">

                <?php

                // Recent Work Feed

                $t = tlc_transient( 'meetup_recentwork_transient' );
                if ( true ) {
                    $t->updates_with( 'meetup_recentwork' );
                } else {
                    $t->updates_with( 'meetup_recentwork_backup' );
                }

                $t->expires_in( 180 );
                $t->background_only();
                echo $t->get();

                ?>

            </div>

    </div>

<?php get_footer(); ?>