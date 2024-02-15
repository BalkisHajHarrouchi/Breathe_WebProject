
const checkNom = (input) => {
    
    let nom = input.value
// /if (/^[a-zA-Z]{2,10}$/.test(nom)){
    if(nom.length>3&&nom.length<=50){
    document.getElementById("nom").innerHTML = "<span style='color:green'>valid name</span>"
}else{
    document.getElementById("nom").innerHTML =  "<span style='color:red'>invalid name, min 3 characters</span>"
}
}
const checkType = (input) => {

    let type = input.value
    if (type!==""){
    document.getElementById("type").innerHTML = "<span style='color:green'>valid type</span>"
}else{
    document.getElementById("type").innerHTML =  "<span style='color:red'>this attribute should not be empty</span>"
}
}
const checkLieu = (input) => {
let lieu = input.value

    if (lieu.length>3&&lieu.length<=50){
    document.getElementById("lieu").innerHTML = "<span style='color:green'>valid place</span>"}
else{
    document.getElementById("lieu").innerHTML =  "<span style='color:red'>invalid place, min 3 characters</span>"
}
}
const checkDate = (input) => {
// let date = input.value

//     if (/^[a-zA-Z]{3,10}$/.test(date)){
//     document.getElementById("lieu").innerHTML = "<span style='color:green'>place is valid</span>"}
// else{
//     document.getElementById("lieu").innerHTML =  "<span style='color:red'>invalid place, min 3 characters</span>"
// }
}
const checkDesc = (input) => {
let description = input.value

    if (description.length > 8){
    document.getElementById("desc").innerHTML = "<span style='color:green'>valid description</span>"}
else{
    document.getElementById("desc").innerHTML =  "<span style='color:red'>invalid description, min 8 characters</span>"
}
}
const checkNbPlaces = (input) => {
let nb = input.value;  
var regex = /^[0-9]+$/;
if(regex.test(nb)&&nb.length>=1&&nb.length<=3){
    document.getElementById("nbPlaces").innerHTML = "<span style='color:green'>valid number</span>" 
}else{
    document.getElementById("nbPlaces").innerHTML = "<span style='color:red'>invalid number, should be a number min one digit max 2 digits</span>"

}
}


var btn = document.querySelector(".submitBtn").addEventListener("click", (e)=>{
    var type = document.querySelector(".selectType").value;
    let inputs = document.getElementsByClassName("form__input");
    let formData = {
        nom: inputs[0].value,
        lieu: inputs[1].value,
        dateEventStart: inputs[2].value,
        dateEventEnd: inputs[3].value,
        description: inputs[4].value,
        nbPlaces: inputs[5].value,
        prixEvent: inputs[6].value
    }
    let test_verifie = validate(formData,type);
    if(test_verifie==false) {
        e.preventDefault();
    }  
});

const validate = (formData,type) => {
    console.log(type);
    let test_verifie=false;
    let regex_input = /^[a-zA-Z]{2,50}$/;
    let regex_textarea = /^[a-zA-Z]{8,100}$/;
    if(regex_input.test(formData.nom)&&formData.lieu.length>3&&formData.lieu.length<50&&formData.description.length>5&&formData.description.length<1000&&type!==""&&formData.nbPlaces>0){
        test_verifie=true;
    }else{
        if(!regex_input.test(formData.nom)){
        document.getElementById("nom").innerHTML = "<span style='color:red'>invalid name, min 3 characters</span>"
        }
        if(formData.lieu.length<3||formData.lieu.length>=50){
        document.getElementById("lieu").innerHTML =  "<span style='color:red'>invalid place, min 3 characters max 50</span>"
        }
        if(formData.description.length<5||formData.description.length>300){
        document.getElementById("desc").innerHTML = "<span style='color:red'>invalid description, min 8 characters</span>"
        }
        if(type==""){
        document.getElementById("type").innerHTML = "<span style='color:red'>invalid type, this attribute should not be empty</span>"
        }
        // if(formData.prixEvent==""){
        // document.getElementById("price").innerHTML = "<span style='color:red'>invalid price, this attribute should not be empty</span>"
        // }
        if(formData.nbPlaces.length==0){
        document.getElementById("nbPlaces").innerHTML = "<span style='color:red'>invalid number, this attribute should not be empty</span>"
        }
    }
    
    return test_verifie;
}
document.getElementById('resetBtn').addEventListener('click', function() {
    history.go(-1); // Go back to previous page
  });

//  **************************************** ticket******************************

const checkIdEvent = (input) => {
    let idEvent = input.value;
    if (/^\d{1,10}$/.test(idEvent)) {
      document.getElementById("idEvent").innerHTML = "<span style='color:green'>ID Event valide</span>";
    } else {
      document.getElementById("idEvent").innerHTML = "<span style='color:red'>ID Event invalide, doit contenir entre 1 et 10 chiffres</span>";
    }
  }
//   const checkCodeTicket = (input) => {
//     let CodeTicket = input.value;
//     if (/^\d{1,10}$/.test(CodeTicket)) {
//       document.getElementById("codeTicketMessage").innerHTML = "<span style='color:green'>Code Ticket valide</span>";
//     } else {
//       document.getElementById("codeTicketMessage").innerHTML = "<span style='color:red'>Code Ticket invalide, doit contenir entre 1 et 10 chiffres</span>";
//     }
//   }
  
  const checkDetailTicket = (input) => {
    let DetailTicket = input.value
    
        if (DetailTicket.length>=0&&DetailTicket.length<=20){
        document.getElementById("detailTicket").innerHTML = "<span style='color:green'>valid detail</span>"}
    else{
        document.getElementById("detailTicket").innerHTML =  "<span style='color:red'>invalid detail, max 20 characters</span>"
    }
    }
    var btnTicket = document.querySelector(".submitBtnT").addEventListener("click", (e)=>{
        let inputs = document.getElementsByClassName("form__input");
        let formData = {
            idEvent: inputs[7].value,
            dateTicketExp: inputs[8].value,
            codeTicket: inputs[9].value,
            detailTicket: inputs[10].value
        }
        let test_verifie = validateTicket(formData);
        if(test_verifie==false) {
            e.preventDefault();
        }    
    });
    
    const validateTicket = (formData) => {
        let test_verifie=false;
        let regex_chiffre =/^\d{1,10}$/;
        if(regex_chiffre.test(formData.idEvent)&&formData.detailTicket.length<=20){
            test_verifie=true;
        }else{
            if(!regex_chiffre.test(formData.idEvent)){
                document.getElementById("idEvent").innerHTML = "<span style='color:red'>ID Event invalide, doit contenir entre 1 et 10 chiffres</span>";
            }
            // if(!regex_chiffre.test(formData.codeTicket)){
            //     document.getElementById("codeTicketMessage").innerHTML = "<span style='color:red'>Code Ticket invalide, doit contenir entre 1 et 10 chiffres</span>";
            // }
            if(formData.detailTicket.length>20){
                document.getElementById("detailTicket").innerHTML =  "<span style='color:red'>invalid detail, max 20 characters</span>"
            }
        }
        
        return test_verifie;
    }
    document.getElementById('resetBtnT').addEventListener('click', function() {
        history.go(-1); // Go back to previous page
      });