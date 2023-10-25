/**
 * Manage a photo/video gallery on jQuery
 * 
 * <div id="tg_gallery">
 *      <div data-copy>
 *      </div>
 *      
 *      <!-- Title and action bar -->
 *      <div class="action-bar row">
 *          <div class="title col col-sm-9 col-lg-9">
 *              <input type="text" name="..." value="..." />
 *          </div>
 *          
 *          <div class="buttons col col-sm-3 col-lg-3">
 *              <button type="submit" class="btn btn-success"><i class="fas fa-save"></i>Salva</button>            
 *              <a class="btn btn-danger" href="..."><i class="fas fa-trash"></i> Cancella galleria</a>
 *              <div class="form-group field-gallery-tipo required">
 *              <select id="gallery-tipo" class="form-control" name="Gallery[tipo]" aria-required="true">
 *                  <option value=""></option>
 *                  <option value="foto" selected="">Foto</option>
 *                  <option value="video">Video</option>
 *             </select>
 *          </div>
 *      </div>
 *      
 *      <!-- Gallery description -->
 *      <div class="row">
 *          <div class="col col-sm-12 col-md-12 col-lg-12">
 *              <label class="control-label" data-show-sibling="true" for="description"><i class="fas fa-chevron-right"></i> Descrizione</label>
 *              <textarea id="...." class="..." name="..." data-hide="true"></textarea>
 *          </div>
 *      </div>
 *      
 *      <!-- Photoes -->
 *      
 * </div>
 * 
 * @param {type} $
 * @returns results
 */
(function ( $ ) {
 
    $.fn.tg_gallery = function(options) {
        var settings = $.extend({}, options );

        var _this = $(this);
        var _hide_elements = $("[data-hide='true']", _this);
        var _sibling_click = $("[data-show-sibling='true']");
        //Hide elements
        _hide_elements.each(function (i, el){
           $(el).hide(); 
        });
        
        $("i", _sibling_click).addClass("fas fa-chevron-right");
        
        //Show hide elements on click
        _sibling_click.click(function (){
            $(this).next().toggle();
            if( $("i", this).hasClass("fas fa-chevron-right")){
                $("i", this).removeClass("fas fa-chevron-right");
                $("i", this).addClass("fas fa-chevron-down");
            }else{
                $("i", this).removeClass("fas fa-chevron-down");
                $("i", this).addClass("fas fa-chevron-right");
            }
        });

        return this;
    };
 
}( jQuery ));