import 'bootstrap';

( function( $ ) {
    
    if( $( '#fengshui-birthday' ).length ) {
        $( '#fengshui-birthday' ).jqxDateTimeInput( {
            formatString: 'dd/MM/yyyy',
            showCalendarButton: false
        } );
    }
    
} )( jQuery );