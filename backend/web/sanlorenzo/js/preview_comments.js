/**
 * 
 * 
 * @param {type} $
 * @returns results
 */
(function ( $ ) {
 
    $.fn.preview_comments = function(options) {
        var settings = $.extend({}, options );

        var _this           = $(this);
        var _pasteComment   = $("[data-paste-comment]");
        var _content        = $('[data-content]', _this);
        var _pasteData      = $("[data-content]", _pasteComment);
        var _close          = $("[data-exit]", _pasteComment);
        
        var content = _content.text();
        
        _content.click(function(){
            _pasteComment.show();
            _pasteData.text(content);
        });
        
        _close.click(function (){
            $(this).parent().hide();
            _pasteData.text("");
        });
        
        return this;
    };
 
}( jQuery ));