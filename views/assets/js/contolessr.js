let produit = document.getElementById("addproduit");
produit.addEventListener("submit", (e) => {
  
  let nomproduit = document.getElementById("nomproduit");
  let typeprod = document.getElementById("typeprod");
  let prix = document.getElementById("prix");
  let stock = document.getElementById("stock");
  let codeBarre = document.getElementById("codeBarre");
  let status = document.getElementById("status");
  let error = document.getElementsByName("error");
  for (let i = 0; i < error.length; i++) {
    error[i].style.color = "red";
  }
  const regex = /^[a-zA-Z\s]*$/;
  
  if (
    
    nomproduit.value.trim() == "" ||
    typeprod.value.trim() == "" ||
    prix.value.trim() == "" ||
    stock.value.trim() == "" ||
    codeBarre.value.trim() == "" ||
    status.value.trim() == "" 

  ) {
    error[3].innerHTML='Empty Label Detected';
    e.preventDefault();
  } else {
    error[3].innerHTML='';
    if (!regex.test(nomproduit.value)) {
      error[0].innerHTML='just lettres required!!';
      e.preventDefault();
    }
    else{
      error[0].innerHTML='';
    }
    if (Number(prix.value) >= 99999 || Number(prix.value) < 20) {
      error[1].innerHTML='price must be high!';
      e.preventDefault();
    } 
    else{
      error[1].innerHTML='';
    }
    if (isNaN(Number(codeBarre.value)) || Number(codeBarre.value) < 1000 || Number(codeBarre.value) > 9999) {
      error[2].innerHTML = '4 numbers required !!';
      e.preventDefault();
    } 
    else{
      error[2].innerHTML='';
    }
  }
});

