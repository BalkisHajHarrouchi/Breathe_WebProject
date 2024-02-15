const sideMenu=document.querySelector("aside");
const menuBtn=document.querySelector("#menu-btn");
const closeBtn=document.querySelector("#close-btn");
const themeToggler=document.querySelector(".theme-toggler");
const image=document.querySelector("#image");
var uploaded="";
image.addEventListener("change",function(){
    console.log(image.value);
})
menuBtn.addEventListener('click',()=>{
sideMenu.style.display='block';

})
closeBtn.addEventListener('click',()=>{
    sideMenu.style.display='none';
})
themeToggler.addEventListener('click',()=>{
    document.body.classList.toggle('dark-theme-variables');
    themeToggler.querySelector('span:nth-child(1)').classList.toggle('active');
    themeToggler.querySelector('span:nth-child(2)').classList.toggle('active');

})
/*
function openForm() {
    // Create a new form element
    var form = document.createElement("form");
  
    // Add attributes to the form
    form.setAttribute("method", "post");
    form.setAttribute("action", "update.php");
  
    // Add a hidden input field for the username
    var usernameInput = document.createElement("input");
    usernameInput.setAttribute("type", "hidden");
    usernameInput.setAttribute("name", "username");
    usernameInput.setAttribute("value", "<?php echo $row['username']; ?>");
    form.appendChild(usernameInput);
  
    // Add a label and input field for the email
    var emailLabel = document.createElement("label");
    emailLabel.setAttribute("for", "email");
    emailLabel.innerHTML = "Email:";
    form.appendChild(emailLabel);
  
    var emailInput = document.createElement("input");
    emailInput.setAttribute("type", "email");
    emailInput.setAttribute("id", "email");
    emailInput.setAttribute("name", "email");
    form.appendChild(emailInput);
  
    // Add a label and input field for the password
    var passwordLabel = document.createElement("label");
    passwordLabel.setAttribute("for", "password");
    passwordLabel.innerHTML = "Password:";
    form.appendChild(passwordLabel);
  
    var passwordInput = document.createElement("input");
    passwordInput.setAttribute("type", "password");
    passwordInput.setAttribute("id", "password");
    passwordInput.setAttribute("name", "password");
    form.appendChild(passwordInput);
  
    // Add a label and input field for the role
    var roleLabel = document.createElement("label");
    roleLabel.setAttribute("for", "role");
    roleLabel.innerHTML = "Role:";
    form.appendChild(roleLabel);
  
    var roleInput = document.createElement("select");
    roleInput.setAttribute("id", "role");
    roleInput.setAttribute("name", "role");
  
    var roleOptions = [    {value: "admin", label: "Admin"},    {value: "editor", label: "Editor"},    {value: "user", label: "User"}  ];
  
    for (var i = 0; i < roleOptions.length; i++) {
      var option = document.createElement("option");
      option.setAttribute("value", roleOptions[i].value);
      option.innerHTML = roleOptions[i].label;
      roleInput.appendChild(option);
    }
  
    form.appendChild(roleInput);
  
    // Add a submit button
    var submitButton = document.createElement("button");
    submitButton.setAttribute("type", "submit");
    submitButton.innerHTML = "Update";
    form.appendChild(submitButton);
  
    // Create a new popup window and add the form to it
    var popup = window.open("", "Update Form", "width=400,height=400");
    popup.document.body.appendChild(form);
  }*/
