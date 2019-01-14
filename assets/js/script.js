import 'bootstrap';

( function( $ ) {
    'use strict';
    if( $( '#fengshui-birthday' ).length ) {
        $( '#fengshui-birthday' ).jqxDateTimeInput( {
            formatString: 'dd/MM/yyyy',
            showCalendarButton: false
        } );
    }
    
} )( jQuery );