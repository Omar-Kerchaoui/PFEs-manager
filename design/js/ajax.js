let form = document.querySelector("form#form_admin");
let ctnBtn = document.querySelector("#submit");
let div = document.querySelector(".error");

//preventing the form from submiting data
form.onsubmit = function (e) {
  e.preventDefault();
};

ctnBtn.onclick = function () {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "login.cnfg.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      if (xhr.responseText == "logAdminSeccuss") {
        window.location.replace("ADMIN/dashboard.php");
      } else if (xhr.responseText == "logEtdSeccuss") {
        window.location.replace("ETUDIANT/profil.etudiant.php");
      } else if (xhr.responseText == "logEnsSeccuss") {
        window.location.replace("ENSEIGNANT/profil.enseignant.php");
      } else {
        div.innerHTML = xhr.responseText;
      }
    }
  };
  let formdata = new FormData(form);

  xhr.send(formdata);
};
