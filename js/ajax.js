/* global settings */
( function( $ ) {
    'use strict';
    if ( typeof settings === 'undefined' ) {
		return false;
	}
    $( document ).ready( function() {
        $( '.btn-section-close' ).on( 'click', function(e) {
            e.preventDefault();
            $(this).parent().addClass('section-close');
        } );
        $( '#btn-fengshui-discover' ).on( 'click', function() {
            var $button = $(this);
            $button.addClass( 'btn-loading' );
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
                $button.removeClass( 'btn-loading' );
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
                    if ( response.data.wu_xing.color_suit ) {
                        var html = '';
                        for (var i = 0; i < response.data.wu_xing.color_suit.length; i++) {
                            html += '<div class="col-md-3"><h5>' + settings.l18n_color_suit[i] + '</h5>';
                            html += '<div class="row">';
                            // Print color
                            var color_arr = response.data.wu_xing.color_suit[i].split(',');
                            for (var j = 0; j < color_arr.length; j++) {
                                html += '<div class="col-6"><span class="fengshui-color-swatch" data-color="' + response.data.color[color_arr[j]].code + '"></span><small class="text-uppercase">' + response.data.color[color_arr[j]].name + '</small></div>';
                            }
                            html += '</div>';
                            html += '</div>';
                        }
                        $display.find( '#fengshui-display-color' ).html(html);
                    }
                    $display.removeClass( 'section-close' );
				} else {
                    $display.find( 'span.solar-date' ).text( settings.error_message );
				}
			} );
        } );
    } );
} )( jQuery );