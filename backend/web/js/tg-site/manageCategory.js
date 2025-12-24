/**
 * Gestisce le categorie
 * 
 * @param {type} $
 * @returns results
 */
(function ( $ ) {
    $.fn.manageCategory = function(options) {
        var settings = $.extend({
            
        }, options );
        
        var _this = $(this);
        
        return _this.each((i, el)=>{
            var _el             = $(el) ;
            var _addBtn         = $("[data-add]",     _el);
            var _categoryName   = $("[data-name]",    _el);
            var _categoryError  = $("[data-error]",   _el);
            var _categoryPaste  = $("[data-paste]",   _el);
            var _draggableList  = $("#draggableList", _el);
            var _dataSave       = $("[data-save]",    _el);
            var _dataSuccess    = $("[data-success]", _el);
            var _dataError      = $("[data-error]",   _el);
            var csrfToken       = settings.csrfToken;
            var ajaxUrl         = settings['ajax-url'];
            
            _addBtn.on("click", ()=>{
                let categoryName = _categoryName.val();
                
                //Se è stato dato un nome all'item viene aggiunto al menu
                if(categoryName === ""){
                    _categoryError.text("Il campo non può essere vuoto");
                }else{
                    _categoryError.text("");
                    
                    addItem(_categoryName, _categoryPaste);
                }
            });
            
            /**
             * Cancella una categoria
             */
            $(document).on("click", "[data-delete]", function(e) {
                // Evita che l'evento risalga (utile se ci sono altri eventi sul drag&drop)
                e.stopPropagation();

                // Risale fino all'antenato più vicino con classe .draggable-item e lo rimuove
                $(this).closest(".draggable-item").remove();
            });
            
            /**
             * Salvo le voci di menu
            */
            _dataSave.click(()=>{
                var data = [];
                
                var _dataInput = $("[data-input]", _this);
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
                            console.log(response.x);
                            
                            _dataSuccess.fadeIn(1000);
                            _dataSuccess.text(response.message);
                            setTimeout(()=>{
                                _dataSuccess.fadeOut(1000);
                            }, 5000);
                        }
                    },
                    error: function (exception) {
                        _dataError.fadeIn(1000);
                        _dataError.text("Errore nel salvataggio della categoria!");
                    }
                });                                                                                                                                                                 
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
         * Aggiunge una nuova categoria
         * 
         * @param {type} _name      Elemento contenente il nome della categoria
         * @param {type} _container Elemento in cui incollare la nuova categoria
         */
        function addItem(_name, _container){
            //Compongo il JSON per permettere il salvataggio del menu
            //con tutte le informazioni necessarie
            let dataInputVal    = JSON.stringify({
                name        : _name.val(),
                taxonomy    : "category"
            });
            
            let trashContainer = document.createElement("div");
            trashContainer.setAttribute("data-delete", "");
            let trashImg = document.createElement("i");
            trashImg.setAttribute('class', 'fa-solid fa-trash');
            trashContainer.append(trashImg);
            
            let elToAdd = document.createElement("div");
            elToAdd.classList.add('draggable-item');
            elToAdd.setAttribute('draggable', 'true'); // Imposta l'attributo draggable
            elToAdd.setAttribute('data-input', dataInputVal);
            elToAdd.textContent = _name.val();
            elToAdd.append(trashContainer);
            
            _container.append(elToAdd);
        }
    };
 
}( jQuery ));