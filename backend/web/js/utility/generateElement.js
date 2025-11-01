/**
 * Genera un nuovo elemento passando i criteri di generazione come
 * parametri
 * 
 * @param {type} $
 * @returns {undefined}
 */
(function ( $ ) {
    $.fn.generateElement = function(options) {
        var settings = $.extend({
            /**
             * Element to generate
             */
            'element' : ''
        }, options );
		
        var _this 	= $(this);
        
        return _this.each((i, el)=>{
            var _addElementsContainer   = $("[data-append]", _this);
            var _addBtn                 = $("[data-add]", _this);
            var _elementToCreate        = settings.element;
            
            //ADD element to container
            _addBtn.click(()=>{
                _addElementsContainer.append(_elementToCreate);
            });
            
        });
    };
 
}( jQuery ));