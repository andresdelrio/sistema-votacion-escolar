// const btnVotar = document.querySelector('#bnVotar');

let optionValue = document.querySelector('input[name="vote"]:checked');   
let boton = document.querySelector('#btnVotar');     
const radioButtons = document.querySelectorAll('input[name="vote"]');      
console.log(radioButtons);
if(!optionValue){
    boton.style.visibility = 'hidden';
    
}

for(const radioButton of radioButtons){
    radioButton.addEventListener('change', function(){
        boton.style.visibility = 'visible';
    });
} 