let quantity1 = 0;
let numberbox1 = document.querySelector(".numberbox1");
function add1(){
quantity1++;
numberbox1.value = 1;
}

function subtract1(){
    if(quantity1>0){
        quantity1--;
        numberbox1.value = quantity1;
    }


}



