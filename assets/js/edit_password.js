let inputPassword = document.getElementById("password");

inputPassword.oninput = function () {
  let commentPassword = document.getElementById("password-comment");
  let passwordValue = inputPassword.value.trim();
  if (passwordValue.length > 0) {
    if (passwordValue.length < 8 || !passwordValue.match(/[A-Z]/g) || !passwordValue.match(/[a-z]/g) || !passwordValue.match(/[0-9]/g)) {
      commentPassword.innerHTML = "<i class='fas fa-times'></i> Le mot de passe doit contenir au moins une majuscule, une minuscule, un chiffre et au minimum 8 caractères.";
      commentPassword.classList.remove("text-success");
      commentPassword.classList.add("text-danger");
    } else {
      commentPassword.innerHTML = "<i class='fas fa-check'></i>";
      commentPassword.classList.remove("text-danger");
      commentPassword.classList.add("text-success");
    }
  } else {
    commentPassword.innerHTML = "";
  }
}