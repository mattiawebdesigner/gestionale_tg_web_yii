(function ( $ ) {
 
    $.fn.saveForm = function(options) {
        var settings = $.extend({
        }, options );
        
        var _this       = $(this);
        var _form       = $("[data-form='"+_this.data('save')+"']");
        var url         = settings.url;
        var click       = -1;//if >= 1 then update and read from input, not by data-id. If == 0 then read by data-id
        
        $(_this).click(function (){
            var input = {};
            var _id         = $("[data-id]", _form);
            var id;
            if(++click === 0){
                id = _id.data("id");
            }else{
                id = _id.val();
            }
            
            $("[data-input]", _form).each(function (i, el){
                input[ $(el).data('input') ] = $(el).val();            
            });
            input['contenuto'] = tinymce.activeEditor.getContent();
            
            //Save data
            $.ajax({
                method : "POST",
                url    : "index.php?r="+url+"&numero_protocollo="+id,
                data : input,
                success: function(risposta){    
                    if(risposta == true){
                        alert("Salvato con successo!");
                        
                        //For new record
                        _id.attr("data-id", _id.val());
                    }else{
                        alert("Errore nel salvare i dati!");
                    }
                },
                error: function(stato){alert("NO ajax: " + stato.status);}
            });
        });
        
        return this;
    };
 
}( jQuery ));