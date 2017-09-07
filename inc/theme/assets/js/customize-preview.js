/**
 * File customize-preview.js.
 *
 * Instantly live-update customizer settings in the preview for improved user experience.
 */

(function( $ ) {
    // Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '#masthead .branding h1 a' ).text( to );
		});
	});
    
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '#masthead .branding span' ).text( to );
		});
	});
    
    // Check if using site title and description
    wp.customize( 'header_text', function( value ) {
		value.bind( function( to ) {
			if ( false === to ) {
				$('#masthead .branding h1 a, #masthead .branding span').hide();
			} else {
                $('#masthead .branding h1 a, #masthead .branding span').show();
			}
		});
	});
    
} )( jQuery );