const checkTitre = (input) => {
    
    let titre = input.value
    if (/^[a-zA-Z]{2,20}$/.test(titre)){
    document.getElementById("titre").innerHTML = "<span style='color:green'>valid title</span>"
}else{
    document.getElementById("titre").innerHTML =  "<span style='color:red'>invalid title, min 3 characters</span>"
}
}
const checkSource = (input) => {
    let source = input.value
    
        if (/^[a-zA-Z]{2,10}$/.test(source)){
        document.getElementById("source").innerHTML = "<span style='color:green'>valid source</span>"}
    else{
        document.getElementById("source").innerHTML =  "<span style='color:red'>invalid source, min 3 characters</span>"
    }
    }
    
const checkContenu = (input) => {
    let contenu = input.value
    
        if (contenu.length > 8)
        {
        document.getElementById("contenu").innerHTML = "<span style='color:green'>valid content</span>"}
    else{
        document.getElementById("contenu").innerHTML =  "<span style='color:red'>invalid content, min 8 characters</span>"
    }
    }
    const checkContenuC = (input) => {
    let contenu = input.value
    
        if (contenu.length > 40)
        {
        document.getElementById("content").innerHTML = "<span style='color:green'>valid content</span>"}
    else{
        document.getElementById("content").innerHTML =  "<span style='color:red'>invalid content, min 9 characters</span>"
    }
    }
const checkCategorie = (input) => {

    let categorie = input.value
    if (categorie!==""){
    document.getElementById("categ").innerHTML = "<span style='color:green'>valid category</span>"
}else{
    document.getElementById("categ").innerHTML =  "<span style='color:red'>this attribute should not be empty</span>"
}
}





var btn = document.querySelector(".submitBtn").addEventListener("click", (e)=>{
    // console.log("waw");
    var categorie = document.querySelector(".selectCategorie").value;
    let inputs = document.getElementsByClassName("form__input");
    let formData = {
        titre: inputs[0].value,
        source: inputs[1].value,
        contenu: inputs[2].value
        
    }
    let test_verifie = validate(formData,categorie);
    if(test_verifie==false) {
        e.preventDefault();
    }
    
});

const validate = (formData,categorie) => {
   
    let test_verifie=false;
    let regex_input = /^[a-zA-Z]{2,500}$/;
    
    
    if(regex_input.test(formData.titre) && regex_input.test(formData.source) && formData.contenu.length>0  && categorie!==""){
        test_verifie=true;
    }
    else
    {
        if(!regex_input.test(formData.titre)){
        document.getElementById("titre").innerHTML = "<span style='color:red'>invalid title, min 3 characters</span>"
        }
        if(!regex_input.test(formData.source)){
        document.getElementById("source").innerHTML =  "<span style='color:red'>invalid source, min 3 characters</span>"
        }
        if(!regex_input.test(formData.contenu)){
            document.getElementById("contenu").innerHTML =  "<span style='color:red'>invalid source, min 8 characters</span>"
            }
        // if(formData.contenu.length<0){
        // document.getElementById("contenu").innerHTML = "<span style='color:red'>invalid content, min 8 characters</span>"
        // }
        if(categorie==""){
        document.getElementById("categ").innerHTML = "<span style='color:red'>invalid category, this attribute should not be empty</span>"
        }
    }
    
    return test_verifie;
}
document.getElementById('resetBtn').addEventListener('click', function() {
    history.go(-1); // Go back to previous page
  });