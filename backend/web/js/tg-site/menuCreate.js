/**
 * Gestisce la creazione di un nuovo menu
 * 
 * Struttura:
 * <div id="menu-create" class="flex flex-row gap-1 flex-wrap">
 *      <div class="btn btn-success" data-menu-add>+</div>
 *      <div class="menu">
 *      </div>
 * </div>
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
            var menuInfo        = settings['menu-type'];
            
            $(_itemMenuAdd).click(()=>{
                let itemName = _itemMenuName.val();
                
                //Se è stato dato un nome all'item viene aggiunto al menu
                if(itemName === ""){
                    _itemMenuError.text("Il campo non può essere vuoto");
                }else{
                    _itemMenuError.text("");
                    
                    addItem(itemName, _itemMenuPaste, menuInfo);
                }
            });
        });
        
        /**
         * Aggiungo la nuova voce di menu all'elenco
         * 
         * @param {type} name   Nome da visualizzare per la voce di menu
         * @param {type} container  Container
         * @param {type} json Dato JSON contenente le informazioni per la scelta della voce del menu
         * @returns {undefined}
         */
        function addItem(name, container, json){
            /*let elToAdd = '<div class="draggable-item" draggable="true">' +
                            name + 
                            '<div class="info1">' + 
                                '<div class="close">' +
                                    '<i class="fa-solid fa-x"></i>' +
                                '</div>' +
                                
                                info[0] + 
                                
                            '</div>' +
                          '</div>';*/
            
            let elToAdd = document.createElement("div");
            elToAdd.classList.add('draggable-item');
            elToAdd.setAttribute('draggable', 'true'); // Imposta l'attributo draggable
            elToAdd.textContent = name;
            
            let infoDiv = document.createElement("div");
            infoDiv.classList.add("info");
            
            let closeDiv = document.createElement("div");
            closeDiv.classList.add('close');
            
            let icon = document.createElement('i');
            icon.classList.add('fa-solid', 'fa-x');
            closeDiv.appendChild(icon);
            
            infoDiv.appendChild(closeDiv);
            
            //Creo i campi di scelta del tipo di input
            let select = document.createElement('select');
            select.setAttribute("name", "sceltaTipoMenu[]");
            
            let arr = JSON.parse(JSON.stringify(json));
            Object.keys(arr._menu_item_type).forEach(key=>{
                const val = arr._menu_item_type[key];
                
                let option = document.createElement("option");
                option.textContent = val;
                
                select.appendChild(option);
            });
            
            elToAdd.appendChild(infoDiv);
            
            container.append(elToAdd);
            
            
            
            /*for(let val of json){
                console.log((val));
                for(let key of val){
                    console.log(key);
                }
            }*/
        }
    };
 
}( jQuery ));