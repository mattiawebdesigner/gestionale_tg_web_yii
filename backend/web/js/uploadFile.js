/**
 * Manage Upload file.
 * 
 * @param {type} $
 * @returns
 */
(function ( $ ) {
 
    $.fn.uploadFile = function(options) {
        var settings = $.extend({
        }, options );
		
        var _this = $(this);
        
        _this.change(function (){
            for(var i = 0 ; i < this.files.length ; i++){
                var fileName = this.files[i].name;
                $('.name').remove();
                $('.filenames').append('<div class="name">' + fileName + '</div>');
            }
        });
        
        return this;
    };
 
}( jQuery ));