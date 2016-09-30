<?php
/**
 * Uses the PHP_CSS class to produce media queries
 *
 * @package PHP_CSS \ Examples \ Media Query
 * @author  Carlos Rios
 * @version 1.0
 */

// Include the library
include_once '../class-php-css.php';

// Instantiate the library
$css = new CarlosRios\PHP_CSS;

// Create some arbitrary css
$css->set_selector( 'body' );
$css->add_properties(array(
	'background-color' => '#222',
	'color'	=> '#111',
	'padding' => '2em',
	'font-size'	=> '16px'
));

// Create a media query
$css->start_media_query( '(max-width: 400px)' );

	$css->change_selector( '#header' )->add_property( 'background-color', '#363636' );
	$css->change_selector( '#navigation' )->add_property( 'padding', '20px' );

// End  media query
$css->stop_media_query();

// Add another property outside of the media query
$css->change_selector( '#footer' )->add_property( 'background', '#777' );

// Add a second media query
$css->start_media_query('(max-width: 600px)');

	$css->change_selector( '#header' )->add_property( 'background', '#FFCCCC' );
	$css->change_selector( '#navigation' )->add_property( 'padding', '10px' );

// End media query
$css->stop_media_query();

// Add another property outside of the second media query
$css->change_selector( '#footer' )->add_property( 'color', '#222' );

// Output the css
echo $css->css_output();