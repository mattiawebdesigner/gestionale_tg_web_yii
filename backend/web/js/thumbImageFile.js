/**
 * Show image thumbnail file.
 * 
 * @param {type} $
 * @returns
 */
(function ( $ ) {
 
    $.fn.thumbImageFile = function(options) {
        var settings = $.extend({
        }, options );
		
        var _this = $(this);
        
        _this.change(function (){
            var _input = $(this);
                    
            if (this.files && this.files[0]) {
                var reader = new FileReader();
                
                reader.onload = function (e) {
                    //$('#blah').attr('src', e.target.result);
                    _input.parent().css("background-image", "url("+e.target.result+")");
                };

                reader.readAsDataURL(this.files[0]);
            }
        });
        
        return this;
    };
 
}( jQuery ));