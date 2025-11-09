/**
 * Rimuove un elemento dalla pagina
 * 
 * @param {type} $
 * @returns {undefined}
 */
(function ( $ ) {
    $.fn.deleteItem = function(options) {
        var settings = $.extend({}, options );
		
        var _this 	= $(this);
        
        return _this.each((i, el)=>{
            var _el         = $(el);
            var deleteId   = $(_el).data("delete");
            var _target     = $("[data-delete-id='"+deleteId+"']");
            
            _el.click((e)=>{
                _target.remove();
            });
            
            console.log(_target);
            
        });
    };
 
}( jQuery ));