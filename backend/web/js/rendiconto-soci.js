/* 
 * This plugin show "rendiconto" only for partner via tab
 */
(function ( $ ) {
 
    $.fn.rendiconto_socio = function(options) {
        var settings = $.extend({
            'attachment'        : '.attachment-rendiconto',
        }, options );
        
        var attachment = settings.attachment;
        
        //Pre load active tab
        var active = $(".vertical-tab.nav-link.active", this);
        ajax(active, "?r=rendiconto/view-socio-rendicontazioni", "index.php?r=rendiconto/content-rendiconti", attachment);//Convocazioni
        
        jQuery("[data-click]").click(function(){
            ajax(this, "?r=rendiconto/view-socio-rendicontazioni", "index.php?r=rendiconto/content-rendiconti", attachment);//Convocazioni
        });
        
        
        function ajax(_this, link, url, attachment){
            var anno = jQuery(_this).data("click");
            
            $.ajax({
                method : "GET",
                url    : url+"&anno="+anno,
                dataType : "json",
                success: function(risposta){
                    jQuery(".load").hide();
                    jQuery(attachment+" *:not(.not-found)").remove();
                    
                    if(risposta.length == 0){
                        jQuery(attachment+" .not-found").show();
                    }else{
                        jQuery(attachment+" .not-found").hide();
                    }
                    
                    var el = "<div class=\"row\">";
                    $.each(risposta, function(key, val){
                        el += "<div class=\"attachment col-sm-3 col-md-3 col-lg-3\">";
                            el += "<h5 class=\"nome\"><a href=\""+link+"&id="+val.id+"\">"+val.nome+"</a></h5>";
                            //el += "<div class=\"anno\">Anno: "+val.anno+"</div>";
                        el += "</div>";
                    });
                    el += "</div>";
                        
                    jQuery(attachment).append(el);
                },
                error: function(stato){alert("NO ajax: " + stato.status);}
            });
        };
        
        return this;
    };
 
}( jQuery ));