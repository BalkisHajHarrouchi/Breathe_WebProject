function validate(form) {
    var email = form.email.value;
    var type = form.type.value;
    var date = form.date_recy.value;
    var quantity = form.quantite.value;
    var regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    // Check email field
    if (!email || email.trim() === "" || !regex.test(email)) {
        document.getElementById("email").innerHTML = "Email field is required";
        return false;
    } else {
        document.getElementById("email").innerHTML = "";
    }

    // Check type field
    if (!type || type.trim() === "") {
        document.getElementById("type").innerHTML = "Type field is required";
        return false;
    } else {
        document.getElementById("type").innerHTML = "";
    }

    // Check quantity field
    if (!quantity || quantity > 20 || quantity < 0) {
        document.getElementById("quantite").innerHTML = "Quantity field is required and must be between 20 and 0";
        return false;
    } else {
        document.getElementById("quantite").innerHTML = "";
    }

    return true;
}

function checkEmail(input) {
    var email = input.value.trim();
    var regex = /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/;

    if (!regex.test(email)) {
        document.getElementById("email").innerHTML = "Invalid email address";
        return false;
    } else {
        document.getElementById("email").innerHTML = "";
        return true;
    }
}

function checkQuantite(input) {
    var quantity = input.value.trim();

    if (quantity > 20 || quantity < 0) {
        document.getElementById("quantite").innerHTML = "Quantity must be between 20 and 0";
        return false;
    } else {
        document.getElementById("quantite").innerHTML = "";
        return true;
    }
}


