/**
 * Show/Hide an item when an event is activated
 * 
 * @param {type} $
 * @returns {undefined}
 */
(function ( $ ) {
 
    $.fn.showItem = function(options) {
        var settings = $.extend({
            /*
             * Clear an input when hidden
             * 
             * 
             * <strong>true</strong>: clear
             * <strong>false</strong>: dont' clear
             */
            clear : true
        }, options );
		
        var _this 	= $(this);
        var _showItems  = $('[data-showitem]', _this);
        
        var clear = settings.clear;
        
        for(let value of _showItems){
            let type = $(value).data('type');
            
            //Add change event on a list (radio button or checkbox)
            if( type === "list"){
                $("[type='radio']", value).addClass("change");
            }
        }
         
        //Show element if clicked on list (checkbox or radio button)
        $(".change").change(function (){
            let checked = $(this).filter(':checked').val();
            let parent = $(this).parent().parent();
            let itemCheck   = parent.data('showitemcheck');
            let itemCheckNo = parent.data('showitemcheckno');
            let show = parent.data('showitemclassview');

            //show item
            if(itemCheck === checked ){
                $("."+show).show();
            }else if(itemCheckNo === checked){//hide item
                $("."+show).hide();
                
                if(clear) $("."+show+" input").val("");//Clear value if hidden
            }
        });        
        
        return this;
    };
 
}( jQuery ));