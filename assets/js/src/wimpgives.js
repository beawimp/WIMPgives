/**
 * WIMPgives 2014
 * http://gives.beawimp.org
 *
 * Copyright (c) 2014 Cole Geissinger
 * Licensed under the GPLv2+ license.
 */

(function( window, $, undefined ) {
	'use strict';

	$( 'ul.menu' ).supersubs( {
		minWidth : 5, maxWidth : 15, extraWidth : 1
	} ).superfish( {
		animation     : {
			opacity : 'show', height : 'show'
		}, autoArrows : false
	} );

	// Add our current link image to the navigation
	$( 'nav' ).find( 'li.current-menu-item a' ).append( '<span class="current-link"></span>' );

	// Force external links to open in a new window
	$( 'a' ).each( function() {
		var a = new RegExp( '/' + window.location.host + '/' );

		if ( ! a.test( this.href ) ) {

			$( this ).click( function( event ) {
				var SELF = this;
				event.preventDefault();
				event.stopPropagation();

				window.open( SELF.href, '_blank' );
			} );

		}
	} );

	// Run equal heights on main body content if it is shorter than the sidebar
	$( window ).load( function() {
		var $body = $( document.getElementById( 'body-wrap' ) ), $sidebar = $( document.getElementById( 'sidebar' ) ), navHeight = $body.children( 'nav' ).height(), bodyHeight = $body.height(), sidebarHeight = $sidebar.height();
		if ( bodyHeight < sidebarHeight && false === $( 'body' ).hasClass( 'is-mobile' ) ) {
			$( document.getElementById( 'body-content' ) ).css( 'height', sidebarHeight - navHeight );
		}
	} );
})( this, jQuery );