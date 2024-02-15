function validate1(form) {
    var nomCateg = form.nomCateg.value;
    var image = form.image.value;
    var description = form.description.value;
    var nbr_demande = form.nbr_demande.value;

    // Check email field
    if (nomCateg.trim() === "") {
        document.getElementById("nomCateg").innerHTML = "nomCateg field is required";
        return false;
    } else {
        document.getElementById("nomCateg").innerHTML = "";
    }

    // Check type field
    if (image.trim() === "") {
        document.getElementById("image").innerHTML = "image field is required";
        return false;
    } else {
        document.getElementById("image").innerHTML = "";
    }

    // Check quantity field
    if (description.trim() === "") {
        document.getElementById("description").innerHTML = "description field is required";
        return false;
    } else {
        document.getElementById("description").innerHTML = "";
    }

    if (nbr_demande.trim() === "" || nbr_demande < 0) {
        document.getElementById("nbr_demande").innerHTML = "nbr_demande field is required and must be > 0";
        return false;
    } else {
        document.getElementById("nbr_demande").innerHTML = "";
    }

    return true;
}

function checknbr_demande(input) {
    var nbr_demande = input.value.trim();

    if (nbr_demande < 0) {
        document.getElementById("nbr_demande").innerHTML = "nbr_demande must be > 0";
        return false;
    } else {
        document.getElementById("nbr_demande").innerHTML = "";
        return true;
    }
}


