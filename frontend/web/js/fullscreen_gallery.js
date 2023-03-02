(function ( $ ) {
 
    $.fn.fullscreen_gallery = function(options) {
        var settings = $.extend({
            'album-id' : 'album',
            /**
             * Selection for the close button
             */
            'closeBtn' : '.close',
            /**
             * Prev button selection
             */
            'prevBtn' : '.prev',
            /**
             * Next button selection
             */
            'nextBtn' : '.next',
            /**
             * Scrollbar selection for hide
             */
            'hideScrollbar' : 'hide-scrollbar'
        }, options );
        
        //Slideshow elements
        var _this           = $(this);
        /**
         * Close button
         */
        var _closeBtn       = $(settings.closeBtn, _this);
        /**
         * Previous button
         */
        var _prevBtn        = $(settings.prevBtn, _this);
        /**
         * Next button
         */
        var _nextBtn         = $(settings.nextBtn, _this);
        
        //Album elements
        /**
         * Album element
         */
        var _album          = $('#'+settings['album-id']);
        /**
         * Image album previou
         */
        var _imagePreview   = $(".foto", _album);
        
        //Global
        /**
         * Number of show image
         */
        var imagePosition = -1;
        /**
         * Totale image in slider
         */
        var totalImage    = _imagePreview.length;
        /**
         * Scrollbar selection
        */
        var scrollbar     = settings.hideScrollbar;
        
        /**
         * Capture keyboard element
         */
        $(document).keydown(function(e){
            //Close slideshow
            if(e.which == 27){
                close();
            }
            //Next image
            if (e.which == 39) { 
                next();
                return false;
            }
            //Prev image
            if (e.which == 37) {
                prev();
                return false;
            }
            
        });
        
        /**
         * Next Button
         */
        _nextBtn.click(function (){
            next();
        });
        
        /**
         * Prev button
         */
        _prevBtn.click(function (){
            prev();
        });
        
        /**
         * Click to image preview for open slideshow
         */
        $(_imagePreview).click(function (){
            _this.show();//Show slideshow
            $("html").addClass( scrollbar );
            
            
            var data_image_position = $(this).data("image-position");
            imagePosition = data_image_position;
            
            //Hide
            $("[data-show='true']", _this);
            //Show image
            $("[data-image-position="+data_image_position+"]", _this).attr("data-show", "true");
        });
        
        
        /**
         * Close slider
         */
        _closeBtn.click(function (){
            close();
        });
        
        //---------------- FUNCTIONS ------------------------//
        /**
         * Show next image
         */
        function next(){
            let _showEl = $("[data-show='true']", _this);
            
            _showEl.attr("data-show", "false");
            
            if( ++ imagePosition === totalImage ){
                imagePosition = 0;
            }
            
            $("[data-image-position='"+imagePosition+"']").attr("data-show", "true");
        }
        
        /**
         * Show previous image
         */
        function prev(){
            let _showEl = $("[data-show='true']", _this);
            
            _showEl.attr("data-show", "false");
            
            if(  -- imagePosition === -1 ){
                imagePosition = totalImage-1;
            }
            
            $("[data-image-position='"+imagePosition+"']").attr("data-show", "true");
        }
        
        /**
         * Close slideshow
         */
        function close(){
            _this.hide();
            $("html").removeClass( scrollbar );
        }
		
        return this;
    };
 
}( jQuery ));