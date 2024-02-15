let categorie = document.getElementById("addcategorie");
categorie.addEventListener("submit", (e) => {
  
  let description = document.getElementById("description");
  let nom_cles = document.getElementById("nom_cles");
  let marque = document.getElementById("marque");
  let budget = document.getElementById("budget");
  let error = document.getElementsByName("error");
  for (let i = 0; i < error.length; i++) {
    error[i].style.color = "red";
  }
  const regex = /^[a-zA-Z\s]*$/;
  
  if (
    
    description.value.trim() == "" ||
    nom_cles.value.trim() == "" ||
    marque.value.trim() == "" ||
    budget.value.trim() == "" 

  ) {
    error[8].innerHTML='Empty Label Detected';
    e.preventDefault();
  } else {
    error[8].innerHTML='';
    if (!regex.test(description.value)) {
      error[4].innerHTML='just lettres required!!';
      e.preventDefault();
    }
    else{
      error[4].innerHTML='';
    }
    if (!regex.test(nom_cles.value)) {
      error[5].innerHTML='just lettres required!!';
      e.preventDefault();
    }
    else{
      error[5].innerHTML='';
    }
    if (!regex.test(marque.value)) {
      error[6].innerHTML='just lettres required!!';
      e.preventDefault();
    }
    else{
      error[6].innerHTML='';
    }
    if (isNaN(Number(budget.value)) || Number(budget.value) < 1000 || Number(budget.value) > 9999) {
      error[7].innerHTML = '4 numbers required !!';
      e.preventDefault();
    } 
    else{
      error[7].innerHTML='';
    }
  }
});
