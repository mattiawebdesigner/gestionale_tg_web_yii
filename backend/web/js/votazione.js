


var pos = 0;
jQuery('[data-add]').click((e)=>{
    
    var _tot_info = jQuery("[data-tot-info]");
    
    if(_tot_info.length > 0){
        pos = jQuery(_tot_info[0]).val();
    }
    
    var input = `<div class='form-group field-votazione-info-data required has-error'>
        <input type='date' 
                id='votazione-info-data' 
                class='form-control' 
                name='Votazione[info][${pos}][data]' 
                aria-required='true' 
                aria-invalid='true'>

        <div class='help-block'></div>
    </div>

    <div class='form-group field-votazione-info-time-inizio required has-error'>
        <label for='votazione-info-time-inizio'>Ora inizio</label>
        <input type='time' 
                id='votazione-info-time-inizio' 
                class='form-control' 
                name='Votazione[info][${pos}][ora_inizio]' 
                aria-required='true' 
                aria-invalid='true'>

        <div class='help-block'></div>
    </div>

    <div class='form-group field-votazione-info-time-inizio required has-error'>
        <label for='votazione-info-time-fine'>Ora di fine</label>
        <input type='time' 
                id='votazione-info-time-fine' 
                class='form-control' 
                name='Votazione[info][${pos}][ora_fine]' 
                aria-required='true' 
                aria-invalid='true'>

        <div class='help-block'></div>
    </div>
    `;

    jQuery('[data-container=\''+jQuery(e.target).parent().attr('data-add')+'\']').append(input);
    console.log(pos);

    pos ++;
});