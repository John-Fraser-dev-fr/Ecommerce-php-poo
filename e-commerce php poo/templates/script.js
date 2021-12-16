$(document).ready(function() {

    // We don't want to see the popover contents until the user clicks the target.
    // If you don't hide 'blah' first it will be visible outside of the popover.
    //
    $('#panier_pop').hide();

    // Initialize our popover
    //
    $('#target').popover({
        content: $('#panier_pop'), // set the content to be the 'blah' div
        placement: 'bottom',
        html: true
    });
    // The popover contents will not be set until the popover is shown.  Since we don't 
    // want to see the popover when the page loads, we will show it then hide it.
    //
    $('#target').popover('show');
    $('#target').popover('hide');
    
    // Now that the popover's content is the 'blah' dive we can make it visisble again.
    //
    $('#panier_pop').show();
  

});