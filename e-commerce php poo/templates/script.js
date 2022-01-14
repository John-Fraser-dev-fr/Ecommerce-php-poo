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



/******* Paiment Stripe ********/

window.onload = () => {
    //variables
    var stripe = Stripe('pk_test_51KHV5GAHhzIZdHyZdRsJwB9IXrgQ7UTCPzivcgD76W19QY21YrSUJaVLPGyWn1F7BJ5y8JEL2sFML3pTvL11iIOQ00oEmjJuF3')
    var elements = stripe.elements()
    var redirect = "/index.php"

    //Objet de la page
    var cardHolderName = document.getElementById("cardholder-name")
    var cardButton = document.getElementById("card-button")
    var clientSecret = cardButton.dataset.secret;

    //Crée les éléments du formulaire de carte bancaire
    var card = elements.create("card")
    card.mount("#card-elements")


    //Gestion de la saisie
    card.addEventListener("change", (event) => {
        var displayError = document.getElementById("card-errors")
        if(event.error){
            displayError.textContent = event.error.message;
        }
        else{
            displayError.textContent = "";
        }
    })


    //Gestion du paiement
    cardButton.addEventListener("click", () => {
        stripe.handleCardPayment(
            clientSecret, card, {
                payment_method_data: {
                    billing_details: {name: cardHolderName.value}
                }
            }
        ).then((result) =>{
            if(result.error){
                document.getElementById("errors").innerText = result.error.message
            }else{
                document.location.href = redirect
            }
        })
    })
}

