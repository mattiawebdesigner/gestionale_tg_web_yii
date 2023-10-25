(function ( $ ) {
 
    $.fn.media = function(options) {
        var settings = $.extend({
			/**
			* Close the frame if clicked
			*/	
			'close' : '.exit',
			/**
			* Element to click for open frame
			*/
			'open' : '.open',
			/**
			* 
			*/
			'attachment' : '.attach',
			/*
			* Clear button for img url
			*/
			'clear-btn' : '.clear-img',
			/**
			* Img show box
			*/
			'show-box' : '.img-show-media'
        }, options );
		
		var _this 			= $(this);
		var _closeBtn		= _this.children(settings.close);
		var _openBtn		= $(settings.open);
		var _appendEl		= $(settings.attachment); 
		var _imgEl			= $(".thumbnail", _this);
		var _clearBtn		= $(settings['clear-btn']);
		var _imgShowMedia	= $(settings['show-box']);
		
		_imgEl.click(function(){
			_appendEl.val($(this).data("url"));
			
			close();
		});
		
		/**
		* Clear URL and delete preview img
		*/
		_clearBtn.click(function(){
			_appendEl.val("");
			_imgShowMedia.remove();
		});
		
		/**
		* Open object, with fade in
	    */
		_openBtn.click(function(){
			_this.fadeIn();
		});
		
		/**
		* Close Object, with fade out
		*/
		_closeBtn.click(function(){
			close();
		});
		
		/**
		* Close frame
		*/
		function close(){
			_this.fadeOut();
		}
		
        return this;
    };
 
}( jQuery ));