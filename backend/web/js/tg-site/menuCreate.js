/**
 * Gestisce la creazione di un nuovo menu * 
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
            var _dataSuccess    = $("[data-success]",           _el);
            var _dataError      = $("[data-error]",             _el);
            var _draggableList  = $("#draggableList",           _el);
            var _dataMenuSave   = $("[data-menu-save]", _el);
            var csrfToken       = settings.csrfToken;
            var ajaxUrl         = settings['ajax-url'];
            
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
            
            /**
             * Salvo le voci di menu
            */
            _dataMenuSave.click(()=>{
                var data = {
                    "name": "John",
                    "age": 30,
                    "city": "New York",
                    '_csrf': csrfToken
                };
                data = [];
                
                var _dataInput = $("[data-input]", _this);
                var cont = 0;
                for(let val of _dataInput){
                    data.push($(val).data("input"));
                }
                
                $.ajax({
                    url             : ajaxUrl,
                    'type'          : 'POST',
                    'dataType'      : "json",
                    headers         : {
                        'X-CSRF-Token': csrfToken // Invia il token nell'header
                    },
                    'data'  : {data : data},
                    
                    success: function (response) {
                        if(response.success){
                            _dataSuccess.fadeIn(1000);
                            _dataSuccess.text(response.message);
                            setTimeout(()=>{
                                _dataSuccess.fadeOut(1000);
                            }, 5000);
                        }
                    },
                    error: function (exception) {
                        _dataError.fadeIn(1000);
                        _dataError.text("Errore nel salvataggio del menu!");
                    }
                });                                                                                                                                                                 
            });
            
            /**
             * Cancella una voce di menu
             */
            $(document).on("click", "[data-delete-item]", function(e) {
                // Evita che l'evento risalga (utile se ci sono altri eventi sul drag&drop)
                e.stopPropagation();

                // Risale fino all'antenato più vicino con classe .draggable-item e lo rimuove
                $(this).closest(".draggable-item").remove();
            });
            
            /**
             * Drag and drop menu item
             */
            // 1. Gestione Drag Start (con delega per elementi dinamici)
            $(document).on('dragstart', '.draggable-item', function(e) {
                $(this).addClass('dragging');
                // Accesso a dataTransfer tramite originalEvent
                if (e.originalEvent.dataTransfer) {
                    e.originalEvent.dataTransfer.setData('text/plain', '');
                }
            });

            // 2. Gestione Drag End
            $(document).on('dragend', '.draggable-item', function() {
                $(this).removeClass('dragging');
            });
            _draggableList.on('dragover', function(e) {
                e.preventDefault(); // Necessario per permettere il drop

                const draggingItem = $('.dragging')[0]; // Elemento che stiamo trascinando
                if (!draggingItem) return;

                // Trova tutti i fratelli tranne quello che si sta trascinando
                const siblings = _draggableList.find('.draggable-item:not(.dragging)').toArray();

                // Trova l'elemento dopo il quale inserire quello trascinato
                const nextSibling = siblings.find(sibling => {
                    const box = sibling.getBoundingClientRect();
                    // Calcola se il mouse è sopra la metà dell'elemento
                    return e.clientY < box.top + box.height / 2;
                });

                // Inserimento dell'elemento nel DOM (metodo nativo insertBefore o jQuery)
                if (nextSibling) {
                    $(draggingItem).insertBefore(nextSibling);
                } else {
                    _draggableList.append(draggingItem);
                }
            });
            //End Drag and drop
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
            
            //Compongo il JSON per permettere il salvataggio del menu
            //con tutte le informazioni necessarie
            let dataInputVal    = JSON.stringify({
                post_title: _itemMenuName.val(),
                item_object : _dataChange.val(),
                item_object_id : (targetId==="post_type")?$(_targetEl).val():"",
                menu_item_parent : 0,
                menu_item_url : (targetId==="custom")?$(_targetEl).val():(json._menu_item_type[targetId].url),
                menu_item_target : "",
                menu_item_type: targetId
                
            });
            let infoDivText     = "";
            
            switch (targetId){
                case "custom":
                case "who_we_are":
                case "next_time":
                case "conctact_us":
                    infoDivText = "Link personalizzato";
                    break;
                case "post_type":
                    infoDivText = "Articolo specifico";
                    break;
            }
            
            //<div data-delete-item><i class="fa-solid fa-trash"></i></div>
            let trashContainer = document.createElement("div");
            trashContainer.setAttribute("data-delete-item", "");
            let trashImg = document.createElement("i");
            trashImg.setAttribute('class', 'fa-solid fa-trash');
            trashContainer.append(trashImg);            
            
            let elToAdd = document.createElement("div");
            elToAdd.classList.add('draggable-item');
            elToAdd.setAttribute('draggable', 'true'); // Imposta l'attributo draggable
            elToAdd.setAttribute('data-input', dataInputVal);
            elToAdd.textContent = _itemMenuName.val();
            elToAdd.append(trashContainer);
            
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