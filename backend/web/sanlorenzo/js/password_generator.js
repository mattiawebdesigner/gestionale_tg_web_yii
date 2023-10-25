(function ( $ ) {
 
    $.fn.password_generator = function(options) {
        var settings = $.extend({
        }, options );
		
        var _this       = $(this);
        
        var chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890!\"\\'£$%&/()=^";
        var min   = 6;
	var max   = 35;
	var diff  = max-min;
        
        _this.click(function (){
            var length   = Math.round((Math.random()*diff)+min);
            var increase = 0;
            var password = "";

            while(increase<length){
               password+=chars.charAt(Math.round(Math.random()*chars.length));
               increase ++;
            }
            
            $('[type="password"]').val(password);
        });
		
        return this;
    };
 
}( jQuery ));