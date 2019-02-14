<?php
/**
 * This code shows how to fetch data using WordPress.org API to search for plugins and phemes
 * Blog post link: https://orbisius.com/p4477
 * @author Svetoslav Marinov (SLAVI) | http://orbisius.com
 * @copyright (c) All rights reserved.
 * @license GPL
 */

$api_params = [
	'user_agent' => 'Orbisius_wporg_API_tutorial/1.0',
	'request[search]' => 'orbisius', /// <<== searched keyword
	'request[page]' => 1,
	'request[per_page]' => 8,

	// This is a great idea to only fetch fields that are needed.
	'request[fields]' => [
		'name' => true,
		'author' => true,
		'slug' => true,
		'downloadlink' => true,

		// we don't care about these at all so we want less data for faster transfer
		'rating' => false,
		'ratings' => false,
		'downloaded' => false,
		'description' => false,
		'active_installs' => false,
		'short_description' => false,
		'donate_link' => false,
		'tags' => false,
		'sections' => false,
		'homepage' => true,
		'added' => false,
		'last_updated' => false,
		'compatibility' => false,
		'tested' => false,
		'requires' => false,
		'versions' => false,
		'support_threads' => false,
		'support_threads_resolved' => false,
	],
];

/////////////////////////////////////////////////////////////////////////
// Fetching plugins
$plugin_search_api_url = 'http://api.wordpress.org/plugins/info/1.1/?action=query_plugins';
$api_url = $plugin_search_api_url;
$packaged_params = $api_params;
$packaged_params['request']['search'] = 'orbisius';
$packaged_params = http_build_query($packaged_params);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $packaged_params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // hmm?
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // hmm?
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$content_json_maybe = curl_exec($ch);
$error = curl_error($ch);

if ( !empty( $error ) ) {
	echo "Error: $error\n";
	$result = curl_getinfo($ch);
} else {
	$result = json_decode( $content_json_maybe, true );
}

var_dump($result);

curl_close($ch);
/////////////////////////////////////////////////////////////////////////



/////////////////////////////////////////////////////////////////////////
// Fetching themes
$theme_search_api_url = 'http://api.wordpress.org/themes/info/1.1/?action=query_themes';
$api_url = $theme_search_api_url;
$packaged_params = $api_params;
$packaged_params['request']['search'] = 'ocean';
$packaged_params = http_build_query($packaged_params);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $api_url);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $packaged_params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0); // hmm?
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0); // hmm?
curl_setopt($ch, CURLOPT_TIMEOUT, 10);
$content_json_maybe = curl_exec($ch);
$error = curl_error($ch);

if ( !empty( $error ) ) {
	echo "Error: $error\n";
	$result = curl_getinfo($ch);
} else {
	$result = json_decode( $content_json_maybe, true );
}

var_dump($result);

curl_close($ch);
/////////////////////////////////////////////////////////////////////////


exit(0);
