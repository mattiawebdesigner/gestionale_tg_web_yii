/**
 * Gestisce la creazione di un nuovo menu
 * 
 * Struttura:
 * <div class="btn btn-success" data-menu-add>+</div>
 * 
 * 
 * 
 * @param {type} $
 * @returns results
 */
(function ( $ ) {
    $.fn.menuCreate = function(options) {
        var settings = $.extend({
            
        }, options );
        
        var _this = $(this);
        
        return _this.each((i, el)=>{
            var _el             = $(el);
            var _itemMenuAdd    = $("[data-item-menu-add]",     _el);
            var _itemMenuName   = $("[data-item-menu-name]",    _el);
            var _itemMenuError  = $("[data-item-menu-error]",   _el);
            var _itemMenuPaste  = $("[data-menu-item-paste]",   _el);
            var _itemMenuInfo   = $("[data-item-menu-info]",    _el);
            
            $(_itemMenuAdd).click(()=>{
                let itemName = _itemMenuName.val();
                
                //Se è stato dato un nome all'item viene aggiunto al menu
                if(itemName === ""){
                    _itemMenuError.text("Il campo non può essere vuoto");
                }else{
                    _itemMenuError.text("");
                    
                    addItem(itemName, _itemMenuPaste, _itemMenuInfo);
                }
            });
        });
        
        function addItem(name, container, info){
            /*let elToAdd = '<div class="draggable-item" draggable="true">' +
                            name + 
                            '<div class="info1">' + 
                                '<div class="close">' +
                                    '<i class="fa-solid fa-x"></i>' +
                                '</div>' +
                                
                                info[0] + 
                                
                            '</div>' +
                          '</div>';*/
            
            // 1. Crea l'elemento principale (il contenitore)
            let elToAdd = document.createElement('div');
            elToAdd.classList.add('draggable-item');
            elToAdd.setAttribute('draggable', 'true'); // Imposta l'attributo draggable

            // 2. Aggiungi il testo 'name'
            elToAdd.textContent = name;

            // 3. Crea il contenitore interno 'info1'
            let info1Div = document.createElement('div');
            info1Div.classList.add('info1');

            // 4. Crea l'elemento 'close' con l'icona
            let closeDiv = document.createElement('div');
            closeDiv.classList.add('close');
            let icon = document.createElement('i');
            icon.classList.add('fa-solid', 'fa-x');
            closeDiv.appendChild(icon);

            // 5. Aggiungi 'close' a 'info1'
            info1Div.appendChild(closeDiv);

            // 6. **Aggiungi l'oggetto DOM contenuto in info[0] a 'info1'**
            info1Div.appendChild(info[0]); // Inserisce l'effettivo elemento, non la sua rappresentazione stringa

            // 7. Aggiungi 'info1' al contenitore principale
            elToAdd.appendChild(info1Div);
            
            //console.log(info[0]);
            container.append(elToAdd);
        }
    };
 
}( jQuery ));