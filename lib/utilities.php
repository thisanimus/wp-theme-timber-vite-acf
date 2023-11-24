<?php

/**
 * Retrieves the SVG code from a given file location.
 *
 * @param string|null $file_location The path to the SVG file. Default is null.
 *
 * @return string|false The SVG code as a string if the file exists, false otherwise.
 */
function svg_code($file_location = null) {
	if (WP_DEBUG) {
		$opts = array(
			'ssl' => array(
				'verify_peer' => false,
				'verify_peer_name' => false,
			)
		);
		$context = stream_context_create($opts);
		libxml_set_streams_context($context);
	}
	$return = false;
	if ($file_location) {
		$iconfile = new DOMDocument();
		$iconfile->load($file_location);
		$html = $iconfile->saveHTML($iconfile->getElementsByTagName('svg')[0]);
		$return = $html;
	}
	return $return;
}

/**
 * Retrieves the site logo as either SVG code or an image, depending on the file type.
 *
 * @return string The site logo represented as SVG code or an HTML image tag.
 */
function site_logo() {
	$logo = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 22C6.47715 22 2 17.5228 2 12C2 6.47715 6.47715 2 12 2C17.5228 2 22 6.47715 22 12C22 17.5228 17.5228 22 12 22ZM12 20C16.4183 20 20 16.4183 20 12C20 7.58172 16.4183 4 12 4C7.58172 4 4 7.58172 4 12C4 16.4183 7.58172 20 12 20ZM8 13H16C16 15.2091 14.2091 17 12 17C9.79086 17 8 15.2091 8 13ZM8 11C7.17157 11 6.5 10.3284 6.5 9.5C6.5 8.67157 7.17157 8 8 8C8.82843 8 9.5 8.67157 9.5 9.5C9.5 10.3284 8.82843 11 8 11ZM16 11C15.1716 11 14.5 10.3284 14.5 9.5C14.5 8.67157 15.1716 8 16 8C16.8284 8 17.5 8.67157 17.5 9.5C17.5 10.3284 16.8284 11 16 11Z"></path></svg>';
	if (get_theme_mod('custom_logo')) {
		// get the url of the selected logo image
		$logo_url = wp_get_attachment_url(get_theme_mod('custom_logo'));

		// make it a local path so we don't have to make an http requests
		$logo_url = ltrim(parse_url($logo_url, PHP_URL_PATH), '/');

		if (str_contains($logo_url, '.svg')) {
			$logo = svg_code($logo_url);
		} else {
			$logo = '<img src="' . $logo_url . '" alt="site logo" />';
		}
	}
	return $logo;
}
