$(document).ready(function() {

   
    $('#panier_pop').hide();

    $('#target').popover({
        content: $('#panier_pop'), 
        placement: 'bottom',
        html: true
    });
    
    $('#target').popover('show');
    $('#target').popover('hide');
    
    $('#panier_pop').show();
  
});


$(document).ready(function() {

   
    $('#user_pop').hide();

    $('#target2').popover({
        content: $('#user_pop'), 
        placement: 'bottom',
        html: true
    });
    
    $('#target2').popover('show');
    $('#target2').popover('hide');
    
    $('#user_pop').show();
  
});

