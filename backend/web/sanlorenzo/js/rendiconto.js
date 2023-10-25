(function ( $ ) {
 
    $.fn.rendiconto = function(options) {
        var settings = $.extend({
        }, options );
        
        $("[data-copy='true']", _this).hide();
        
        var _this       = $(this);
        var _btn_copy   = $("[data-btn-copy]", _this);
        var _in_title   = $("[data-title]", _this);
        
        /**
         * Copy element
         */
        $(_btn_copy).click(function (){
            let _copy       = $("[data-copy='true']", _this).clone(true);
            let _paste      = $("[data-paste='true']", $(this).parent());
            let type        = $(this).data("type");
            
            _copy.show();
            _copy.removeAttr("data-copy");
            _paste.append(_copy);
            $("[data-element]", _paste);
            $(".type", $(this).parent()).val(type);
        });
        
        /**
         * Copy title while write
         */
        $(_in_title).keyup(function (){
            $("[data-title-paste]", $(this).parent().parent().parent()).text($(this).val());
        });
        
        /**
         * Collapse element
         */
        $("[data-collapse]", _this).click(function (){
            $("[data-toggle]", $(this).parent()).slideToggle();
        });
        
        /**
         * Click for upload
        */
        $("[data-upload] [data-field]", _this).dblclick(function (){
            let field = $(this).data("field");
            /*let value = $(this).text();
            let id    = $(this).data("id");*/
            
            $( $(this).parent().prev() ).show();
            
            $("td > span", $(this).parent() ).each(function (pos, el){
                let val = $(el).text();
                
                $(this).html("<input type='"+$(el).parent().data("input-type")+"' class='form-control' name='"+field+"' value='"+val+"' />");
            });
        });
        
        /**
         * Update records
         */
        $("[data-save]", _this).click(function (){
            let _input = $("input", $( $(this).parent().parent() ).next() );
            let id    = $(this).data("id");
            
            var data_contabile  = undefined,
                voce            = undefined,
                prezzo          = undefined,
                tipo            = $(this).data('type');
                    
            $(_input).each(function(pos, el){
                let val = $(el).val();
                let field = $(el).parents("td").data('field');
                
                if(field === "data_contabile"){
                    data_contabile = $(el).val();
                }else if(field === "prezzo"){
                    prezzo = $(el).val();
                }else{
                    voce = $(el).val();
                }
            });
            
            //Upload record via Ajax
            $.ajax({
                method : "POST",
                url    : "index.php?r=voci/update&id="+id+"&voce="+voce+"&prezzo="+prezzo+"&data_contabile="+data_contabile+"&tipologia="+tipo,
                success: function(risposta){                    
                    cancel(_input);//Close input
                },
                error: function(stato){}
            });
            
            $( $(this).parent().parent().hide());
        });
        
        /**
         * Cancel button
         */
        $("[data-cancel]", _this).click(function (){
            let _input = $("input", $( $(this).parent().parent() ).next() );
            $( $(this).parent().parent().hide());
            
            cancel(_input);//Close input
        });
        
        $("[data-delete]", _this).click(function(){let _input = $("input", $( $(this).parent().parent() ).next() );
            let id    = $(this).data("id");
            
            //Upload record via Ajax
            $.ajax({
                method : "POST",
                url    : "index.php?r=voci/delete&id="+id,
                success: function(risposta){                    
                    remove(_input);//Close input
                },
                error: function(stato){}
            });
            
            $( $(this).parent().parent().hide());
        });
        
        /**
         * 
         * @param {[Object object} _input
         * @returns
         */
        function cancel(_input){
            $(_input).each(function (pos, el){
                let val = $(el).val();

                $(el).parent().html("<span>"+val+"</span>");
            });
        }
        
        /**
         * Remove field from page
         */
        function remove(_input){
            $(_input).each(function (pos, el){
                let val = $(el).val();

                $(el).parent().remove();
            });
        }
        
        return this;
    };
 
}( jQuery ));