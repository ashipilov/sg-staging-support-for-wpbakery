<?php
/**
 * Plugin Name:       SiteGround Staging Fix for WP Bakery
 * Plugin URI:        https://example.com/plugins/the-basics/
 * Description:       Support for SiteGround staging functionality for the WP Bakery plugin
 * Version:           0.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Aleksey Shipilov
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

require_once('SgStagingSupportForWbBakery.php');

/* Brutal override the post content using the action instead of filters. Otherwise WP Bakery front end editor doesn't pick up the chagnes */
add_action('the_post', function( $post ) { $post->post_content = (new SgStagingSupportForWbBakery(home_url()))->stage($post->post_content); }, -1000);
add_filter('content_edit_pre', function( $content ) { return (new SgStagingSupportForWbBakery(home_url()))->stage($content); });
add_filter('content_save_pre', function( $content ) { return (new SgStagingSupportForWbBakery(home_url()))->unStage($content); });