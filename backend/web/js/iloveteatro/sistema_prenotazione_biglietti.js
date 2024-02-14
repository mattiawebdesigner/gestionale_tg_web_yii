(function( $ ) {
 
    $.fn.sistema_prenotazione_biglietti = function(options) {
        var settings = $.extend({
            /*
             * Criterio di selezione del contenitore per la piantina
             */
            piantina_contenitore: "theatre-place"
        }, options );
        
        //***************************
        // COSTANTI
        //***************************
        //Elemento a cui è applicato il plugin
        const _THIS = $(this);
        //Posti liberi
        const COLOR_FREE    = "darkgreen";
        //Posto prenotato
        const COLOR_BOOKED  = "grey";
        
        /**
        * Attivo l'evento di selezione del posto, valido SOLO per 
        * i posti numerati.
        * Esclude i posti non numerati.
        */
       jQuery(".seat:not(.seat.busy):not(.seat.nn):not(.seat.my-busy.not-payed", _THIS).click((e)=>{
           var el = jQuery(e.target);
           var nome    = el.data("nome");
           var fila    = el.data("fila");
           var posto   = el.data("posto");
           var palco   = el.data("palco");
           var form    = jQuery("#theatre-reservations > form", _THIS);

           var prenotazioni = jQuery("#theatre-reservations > table", _THIS);
           var id = (nome.replace(" ", "_"))+"-"+fila+"-"+posto;
           if(palco !== undefined){
               id += "-"+palco;
           }

           el.attr("data-id", id);
           //Imposto come selezionato per la prenotazione
           if(el.hasClass("reservation")){                    
               remove(id, el);
           }else{                    
               insert(prenotazioni, id, el, nome, fila, posto, palco);
           }
           //--------------------------------------------

           var form        = jQuery("#theatre-reservations > form", _THIS);
           var tableRow    = jQuery("#theatre-reservations > table tr", _THIS);

           if(tableRow.length === 0){
               form.hide();
           }else{
               form.show();
           }
       });
       
        /**
        * visualizza le prenotazioni da rimuovere
        */
        jQuery(".my-busy.not-payed:not(.seat.reservation), .my-busy.credit:not(.seat.reservation)", _THIS).click((e)=>{
            var el = jQuery(e.target);
            var nome    = el.data("nome");
            var fila    = el.data("fila");
            var posto   = el.data("posto");
            var palco   = el.data("palco");
            var form    = jQuery("#reservations-delete-form", _THIS);

            var prenotazioni = jQuery("#theatre-reservations-delete > table", _THIS);
            var id = (nome.replace(" ", "_"))+"-"+fila+"-"+posto;
            if(palco !== undefined){
                id += "-"+palco;
            }

            el.attr("data-id", id);
            if(el.hasClass("reservation")){
                let stroke  = el.attr("old-stroke");
                let fill    = el.attr("old-fill");
                
                remove(id, el, fill, stroke);
            }else{
                let stroke  = el.attr("stroke");
                let fill    = el.attr("fill");

                el.attr("old-stroke", stroke);
                el.attr("old-fill", fill);
                insert(prenotazioni, id, el, nome, fila, posto, palco, "reservations-delete-form", COLOR_FREE, COLOR_FREE);
            }

            var tableRow    = jQuery("#theatre-reservations-delete > table tr", _THIS);    

            if(tableRow.length === 0){
                form.hide();
            }else{
                form.show();
            }
        });
       
       /**
        * Inserisce l'elemento nella pagina
        * 
        * @param {[Object object]} prenotazioni 
        * @param {int} id
        * @param {[Object object]} el
        * @param {string} nome
        * @param {string} fila
        * @param {string} posto 
        * @param {string} palco
        * @param {string} formClass
        * @param {string} fill
        * @param {string} stroke
        * 
        */
        function insert(prenotazioni, id, el, nome, fila, posto, palco = undefined, formClass = "reservations-form", fill = COLOR_BOOKED, stroke = COLOR_BOOKED){
            el.attr("fill", fill);
            el.attr("stroke", stroke);
            el.addClass("reservation busy");

            let insert = "<tr id='"+id+"'>" + 
                            "<th>" + nome + " <input type='hidden' name='prenotazione["+nome+"][nome][]' form='"+formClass+"' value='"+nome+"' /></th>";
            if(palco !== undefined){
                insert += "<td>Palco: <strong>"+palco+"</strong> <input type='hidden' name='prenotazione["+nome+"][palco][]' form='"+formClass+"' value='"+palco+"' /></td>";
            }else{
                insert += "<td></td>";
            }

            insert += "<td>Fila: <strong>" + fila + "</strong> <input type='hidden' name='prenotazione["+nome+"][fila][]' form='"+formClass+"' value='"+fila+"' /></td> " +
                            "<td>Posto: <strong>" + posto + "</strong> <input type='hidden' name='prenotazione["+nome+"][posto][]' form='"+formClass+"' value='"+posto+"' /></td>" +
                            "<td><span class='remove-reservation fa fa-trash-alt'></span></td>" +
                        "</tr>";
            prenotazioni.append(insert);
        }

        /**
        * Rimuove l'elemento dalla pagina
        * @param {int} id
        * @param {[Object object]} el
        * @param {string} fill
        * @param {string} stroke
        */
        function remove(id, el, fill = COLOR_FREE, stroke = COLOR_FREE){
            el.attr("fill", fill);
            el.attr("stroke", stroke);
            el.removeClass("reservation busy");

            var form        = jQuery("#theatre-reservations > form");
            var tableRow    = jQuery("#theatre-reservations > table tr");

            if(tableRow.length === 1){
                form.hide();
            }

            jQuery("#"+id).remove();
        }
        
        /**
        * Pulsante di rimozione della prenotazione
        */
        jQuery("#theatre-reservations > table, #theatre-reservations-delete > table").on("click", ".remove-reservation", (e)=>{
            var parent = jQuery(e.target).parent().parent();
            var id = parent.attr("id");

            remove(id, jQuery("[data-id='"+id+"']"));
        });
        
        
        return this;
 
    };
 
}( jQuery ));

jQuery(".seat").tooltip({
                content : function (){//Renderizza anche in HTML
                    var item = jQuery(this);
                    var data = item.data("tooltip");
                    return data;
                }
            });