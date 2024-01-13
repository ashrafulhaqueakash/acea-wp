/**
 * File customizer.js.
 *
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 */
( function( $ ) {
	"use strict";
	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-branding h2' ).text( to );
		} );
	} );
	wp.customize( 'header_background_color', function( value ) {
		value.bind( function( to ) {
			$( '.blog-breadcrumb' ).css( {
				'background-color': to
			} );
		} );
	} );
	// Header text color.
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.blog-breadcrumb h1, .blog-breadcrumb .post__caption' ).css( {
					'color': '#202427'
				} );
			} else {
				$( '.blog-breadcrumb h1, .blog-breadcrumb .post__caption' ).css( {
					'color': to
				} );
			}
		} );
	} );
	
	wp.customize( 'acea_site_layout', function( value ) {
		value.bind( function( to ) {
			if ( 'boxed_layout' === to ) {
				$( 'body' ).addClass('box-layout-page');
			} else {
				$( 'body' ).removeClass('box-layout-page');
			}
		} );
	} );
} )( jQuery );
