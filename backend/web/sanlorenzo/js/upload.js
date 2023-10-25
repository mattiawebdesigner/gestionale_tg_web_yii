(function ( $ ) {
 
    $.fn.upload = function(options) {
        var settings = $.extend({
        }, options );
		
		var _this 			= $(this);
		var filename		= "";
		
		$(_this).change(function(){
			filename = $('input[type=file]').val().replace(/.*(\/|\\)/, '');
			
			_this.next().text(filename);
		});
		
		
		
        return this;
    };
 
}( jQuery ));