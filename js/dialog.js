/**
 * Created by crystal on 5/12/17.
 */

$( function() {
    $( "#dialog-confirm" ).dialog({

        resizable: false,
        height: "auto",
        width: 400,
        modal: true,
        buttons: {
            "확인": function() {
                $('#add_tag_form').submit();
            },
            "취소": function() {
                $( this ).dialog( "close" );
            }
        }
    });
} );

