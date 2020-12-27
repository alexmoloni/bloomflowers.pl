<?php

function add_header_x_robots($headers) {

	if (IS_STAGING) {
		$headers['X-Robots-Tag'] = 'noindex, nofollow';
	}

	return $headers;
}
add_filter('wp_headers', 'add_header_x_robots');