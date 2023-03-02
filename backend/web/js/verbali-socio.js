/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
(function ( $ ) {
 
    $.fn.verbali_socio = function(options) {
        var settings = $.extend({
            'verbali-attachment'        : '.attachment-verbali',
            "convocazioni-attachment"   : "attachment-convocazioni"
        }, options );
        
        var verbali_attachment      = options['verbali-attachment'];
        var convocazioni_attachment = options['convocazioni-attachment'];
        
        //Pre load active tab
        var active = $(".vertical-tab.nav-link.active", this);
        ajax(active, "?r=verbali/view-socio-convocazione", "index.php?r=verbali/content-convocazioni", convocazioni_attachment);//Convocazioni
        ajax(active, "?r=verbali/view-socio-verbale", "index.php?r=verbali/content-verbali", verbali_attachment);//Verbali
        
        jQuery("[data-click]").click(function(){
            ajax(this, "?r=verbali/view-socio-convocazione", "index.php?r=verbali/content-convocazioni", convocazioni_attachment);//Convocazioni
            ajax(this, "?r=verbali/view-socio-verbale", "index.php?r=verbali/content-verbali", verbali_attachment);//Verbali
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
                            el += "<h5 class=\"oggetto\"><a href=\""+link+"&numero_protocollo="+val.numero_protocollo+"\">"+val.oggetto+"</a></h5>";
                            el += "<div class=\"numero_protocollo\">Prot. "+val.numero_protocollo+"</div>";
                            el += "<div class=\"oggetto\"><i class=\"fas fa-calendar\"></i> "+val.data+"</div>";
                            el += "<div class=\"ora_inizio\"><i class=\"fas fa-clock\"></i> "+val.ora_inizio+"</div>";
                            el += "<div class=\"ora_fine\"><i class=\"fas fa-calendar-times\"></i> "+val.data+"</div>";
                            el += "<div class=\"firma\"><i class=\"fas fa-signature\"></i> "+val.firma+"</div>";
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