/* global settings */
( function( $ ) {
    'use strict';
    if ( typeof settings === 'undefined' ) {
		return false;
	}
    $( document ).ready( function() {
        $( '#btn-fengshui-discover' ).on( 'click', function() {
            var date = $( '#fengshui-birthday' ).val();
            var gender = $( '#fengshui-gender' ).val();
            // set ajax data
			var data = {
				'action' : 'twentynineteen_ajax_fengshui_discover',
				'date': date,
				'gender' : gender
			};
			$.post( settings.ajaxurl, data, function( response ) {
                console.log(response);
                var $display = $( '#fengshui-display' );
				if ( response.success ) {
					// display result
                    $display.find( 'span.solar-date' ).text( date );
                    var lunar = response.data.lunar;
                    $display.find( 'span.lunar-date' ).text( lunar.lunar_day + '/' + lunar.lunar_month + '/' + lunar.lunar_year );
                    $display.find( 'span.can-chi' ).text( response.data.wu_xing.can_chi );
                    $display.find( 'span.gender' ).text( $( '#fengshui-gender option:selected' ).text() );
                    $display.find( 'span.wu-xing' ).text( response.data.wu_xing.wu_xing );
                    $display.find( 'span.cung-menh' ).text( response.data.wu_xing.cung_menh );
				} else {
                    $display.find( 'span.solar-date' ).text( settings.error_message );
				}
			} );
        } );
    } );
} )( jQuery );