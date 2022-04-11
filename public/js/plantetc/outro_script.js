var ajax = new XMLHttpRequest();


ajax.open("GET","http://127.0.0.1:8000/umidade/chart");

ajax.response.type = "json";

ajax.send();
 
ajax.addEventListener("readystatechange", function (){

if (ajax.readyState === 4 && ajax.status === 200){

    var resposta = ajax.response;
    console.log(resposta);

    for(var i = 0; i< resposta.length; i++ ){
        console.log(resposta[i]);
    }
}

})

