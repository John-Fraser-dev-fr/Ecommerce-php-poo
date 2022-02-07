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


$(document).ready(function() {

   
    $('#upPhotoPop').hide();

    $('#target3').popover({
        content: $('#upPhotoPop'), 
        placement: 'right',
        html: true
    });
    
    $('#target3').popover('show');
    $('#target3').popover('hide');
    
    $('#upPhotoPop').show();
  
});

/************ Modal ***************** */

function ModalFinalPaiement(text,text2) {
    document.getElementById("textModalFinalPaiement").innerHTML = text;
    document.getElementById("textModalFinalPaiement2").innerHTML = text2;
    $('#modalFinalPaiement').modal('show');
};

/************Erreur *******************/

function Erreur(){
    $('#numppl').on('change', function () {
        $("#snoAlertBox").fadeIn();
         closeSnoAlertBox();
           });
}


/******* Paiment Stripe ********/

window.onload = () => {
    //variables
    var stripe = Stripe('pk_test_51KHV5GAHhzIZdHyZdRsJwB9IXrgQ7UTCPzivcgD76W19QY21YrSUJaVLPGyWn1F7BJ5y8JEL2sFML3pTvL11iIOQ00oEmjJuF3')
    var elements = stripe.elements()
    var redirect = "index.php"

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
                

                ModalFinalPaiement("Votre paiement a été validé !", "Merci pour votre commande");
                   
               
                
                
                
            }
        })
        
    })
}

/****** DASHBOARD ADMIN *********/

function show(elementID) {
    var ele = document.getElementById(elementID);
    if (!ele) {
        alert("erreur");
        return;
    }
    var pages = document.getElementsByClassName('page');
    for(var i = 0; i < pages.length; i++) {
        pages[i].style.display = 'none';
    }
    ele.style.display = 'block';
}