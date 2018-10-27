( function( $ ) {
    'use strict';
    $( '#fengshui-birthday' ).jqxDateTimeInput( {
        formatString: 'dd/MM/yyyy',
        showCalendarButton: false
    } );
    $( '#btn-fengshui-discover' ).on( 'click', function() {
        if( $( '#fengshui-birthday' ).val() ) {
            var date = $( '#fengshui-birthday' ).val().split('/');
            for (var i = 0; i < date.length; i++) {
                console.log(parseInt(date[i], 10)); /* jshint node: true */
            }
        }
    } );
} )( jQuery );