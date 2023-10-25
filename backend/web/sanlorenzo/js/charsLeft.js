/* 
 * Count the left chars on textearea.
 * 
 * <textarea name="<input_name>" 
 *          id="<textarea id>" 
 *          maxlength="<max chars>" >
 * </textarea>
 * 
 * 
 */
$.charsLeft = function( element ) {
    var max = parseInt( $( element ).attr("maxlength"), 10 );
    $( element ).after( '<div class="chars-left"></div>' );
    $( element ).keyup(function() {
        var textLength = $( this ).val().length;
        $( this).next().text( textLength + "/" + max);
        if( textLength > max ) {
            $( this).next().addClass( "text-danger" );
        } else {
            $( this).next().removeClass( "text-danger" );
        }
    });
};

