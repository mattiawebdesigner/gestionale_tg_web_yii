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
            var _dataChange     = $("[data-change]",            _el);
            
            /**
             * Seleziona la <b>select</b> i cui elementi servono a 
             * scegliere quale elemento associato visualizzare.
             */
            var _optionsTarget  = $("[data-change]", _el);
            var menuInfo        = settings['menu-type'];
            
            //Nascondo tutti gli elementi per il tipo di voce di menu            
            hideTargetHideMenuItem(_el);
            //visualizzo solamente l'item selezionato di default
            showFirstTargetMenuItem(_dataChange);
            
            
            /**
             * Visualizzo gli elementi in base al tipo di voce
             * del menu selezionata.
            */
            _optionsTarget.change((el)=>{
                hideTargetHideMenuItem();
                
                var target_id = $(el.target).children('option:selected').data("change-target-id");
                
                var target_element = $("[data-change-id='"+target_id+"']");
                
                target_element.show();
            });
            
            /**
             * Aggiunge la voce di menu al menu
             */
            $(_itemMenuAdd).click(()=>{
                let itemName = _itemMenuName.val();
                
                //Se è stato dato un nome all'item viene aggiunto al menu
                if(itemName === ""){
                    _itemMenuError.text("Il campo non può essere vuoto");
                }else{
                    _itemMenuError.text("");
                    
                    addItem(_itemMenuName, _itemMenuPaste, _dataChange, menuInfo);
                }
            });
        });
        
        /**
         * Aggiungo la nuova voce di menu all'elenco
         * 
         * @param {type} _itemMenuName   Contenitore del nome da visualizzare per la voce di menu
         * @param {type} container  Container
         * @param {type} _dataChange   Nome da visualizzare per la voce di menu
         * @param {type} json Dato JSON contenente le informazioni per la scelta della voce del menu
         * @returns {undefined}
         */
        function addItem(_itemMenuName, container, _dataChange, json){
            let targetId        = $(" option:checked", _dataChange).data("change-target-id");
            let _targetEl       = $("[data-change-id='"+targetId+"']");
            let dataInputVal    = JSON.stringify({target: targetId, value: _targetEl.val()});
            let infoDivText     = "";
            
            switch (targetId){
                case "custom":
                    infoDivText = "Link personalizzato";
                    break;
                case "post_type":
                    infoDivText = "Articolo specifico";
                    break;
            }
            
            let elToAdd = document.createElement("div");
            elToAdd.classList.add('draggable-item');
            elToAdd.setAttribute('draggable', 'true'); // Imposta l'attributo draggable
            elToAdd.setAttribute('data-input', dataInputVal);
            elToAdd.textContent = _itemMenuName.val();
            
            let elInfoLink = document.createElement("div");
            elInfoLink.setAttribute("style", "font-size: small;");
            elInfoLink.textContent = infoDivText;
            
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
            elToAdd.append(elInfoLink);
            
            container.append(elToAdd);
            
            _itemMenuName.val("");
            _targetEl.val("");
        }
        
        /**
         * Nasconde l'elemento target per la definizione
         * della voce di menu
         * 
         * @param _container Contenitore padre
         * @returns void
         */
        function hideTargetHideMenuItem(_container){
            $("[data-change-id]", _container).hide();
        }
        
        /**
         * Visualizza il primo elemento selezionato
         * di default per la voce di menu
         * 
         * @param _dataChange
         * @returns void
         */
        function showFirstTargetMenuItem(_dataChange){
            var targetId = $(" option:checked", _dataChange).data("change-target-id");
            
            $("[data-change-id='"+targetId+"']").show();
        }
    };
 
}( jQuery ));