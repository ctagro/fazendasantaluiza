
function setRadioBtn(setRadio) { //função que deveria mudar o Status do Checked

  console.log(setRadio);
 
  //  console.log('passei');
//  document.querySelector(setRadio).checked = false;
 //  teste = document.querySelector('input[name="disease_id[4]"]').checked;
 //   console.log(teste);
    teste = (document.querySelector(setRadio));
    if (document.querySelector(setRadio).checked){
  
        console.log('passeipelotrue');
         document.querySelector(setRadio).checked = false;
       } 
       else{
         console.log('passeipeloelse');
         document.querySelector(setRadio).checked = true;
     }
   console.log(teste);

    teste1 = document.querySelector(setRadio).checked;
    console.log('depois');
    console.log(teste1);

 }
  
     // criação da lista de inputs 

    const listRadioBtn = document.querySelectorAll('.form-check-input');
    let count = 0;

    for(var i = 0; i < (listRadioBtn.length) ; i++)  {

    const radioBtn = listRadioBtn[i];
    const radioBtnName = radioBtn.name;
  //  const radioBtnId = radioBtn.id;
  //  const setRadioId = `#${radioBtnId}`;

    // Template string para chamar o imput correto pelo nome
    const setRadioName = `input[name="${radioBtnName}"]`;
    

    radioBtn.onclick = function(){
         setRadioBtn(setRadioName);
    };

    }
  
