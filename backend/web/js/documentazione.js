/**======================================================================
 * Gestione della sezione di documentazione
=======================================================================*/

/**
 * Visualizza/Nasconde il menu
 */
jQuery("#document-container .actions").on("click", (e)=>{
    var _target = jQuery(" .menu", e.currentTarget);
    
    _target.toggleClass("active");
    _target.toggle();
});