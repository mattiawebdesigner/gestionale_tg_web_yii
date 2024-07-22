/* 
 * This plugin show "soci"
 * 
 */
(function ( $ ) {
 
    $.fn.soci = function(options) {
        var settings = $.extend({
            'attachment'        : '.attachment-partner',
        }, options );
        
        var attachment = settings.attachment;
        var link       = "?r=soci/view";
        var url        = "index.php?r=soci/get-soci-anno";
        
        
        //Pre load active tab
        var active = $(".vertical-tab.nav-link.active", this);
        ajax(active, link, url, attachment);//Convocazioni
        
        jQuery("[data-click]").click(function(){
            var anno       = jQuery(this).data("anno");
            link += "&anno="+anno;
            
            ajax(this, link, url, attachment);//Convocazioni
        });
        
        /**
         * Run ajax function
         * 
         * @param [Object object] _this
         * @param string link
         * @param string url
         * @param string attachment
         * @returns
         */
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
                    
                    el += "<p></p>";
                    el += "<div class=\"total\">Total soci: <strong>"+risposta.length+"</strong></div>";
                    el += "<p></p>";
                    
                    el += "<table class='table'>";
                        el += "<tr>";
                            el += "<th>Nome</th>"
                            el += "<th>Email</th>"
                            el += "<th>Indirizzo</th>"
                        el += "</tr>";
                        
                        $.each(risposta, function(key, val){

                            el += "<tr>";
                                el += "<td><a href=\""+link+"&id="+val.id+"\">"+val.cognome+" "+val.nome+"</a></td>";
                                el += "<td>"+val.email+"</td>";
                                el += "<td>"+val.indirizzo+"</td>";
                            el += "</tr>";
                                    
                        });
                        el += "</table>";
                    el += "</div>";
                        
                    jQuery(attachment).append(el);
                },
                error: function(stato){alert("NO ajax: " + stato.status);}
            });
        };
        
        return this;
    };
 
}( jQuery ));