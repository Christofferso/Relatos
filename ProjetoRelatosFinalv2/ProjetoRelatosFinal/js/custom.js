const loginForm = document.getElementById("login-usuario-form");
const cadForm = document.getElementById("cad-usuario-form");
const msgAlert = document.getElementById("msgAlert");
const msgAlertErroLogin = document.getElementById("msgAlertErroLogin");
const msgAlertErroCad = document.getElementById("msgAlertErroCad");
const loginModal = new bootstrap.Modal(document.getElementById("loginModal"));
const cadModal = new bootstrap.Modal(document.getElementById("cadUsuarioModal"));

loginForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    if (document.getElementById("email").value === "") {
        msgAlertErroLogin.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo usuário!</div>";
    } else if (document.getElementById("senha").value === "") {
        msgAlertErroLogin.innerHTML = "<div class='alert alert-danger' role='alert'>Erro: Necessário preencher o campo senha!</div>";
    } else {
        const dadosForm = new FormData(loginForm);

        const dados = await fetch("validar.php", {
            method: "POST",
            body: dadosForm
        });

        const resposta = await dados.json();

        if(resposta['erro']){
            msgAlertErroLogin.innerHTML = resposta['msg']
        }else{
            window.location.href = "mapa.php";
            loginForm.reset();
            loginModal.hide();
        }
    }
});

cadForm.addEventListener("submit", async (e) => {
    e.preventDefault();

    const dadosForm = new FormData(cadForm);

    const dados = await fetch("cadastrar.php", {
        method: "POST",
        body: dadosForm 
    });

    const resposta = await dados.json();

    //console.log(resposta);

    if(resposta['erro']){
        msgAlertErroCad.innerHTML = resposta['msg'];
    }else{
        msgAlert.innerHTML = resposta['msg'];
        cadForm.reset();
        cadModal.hide();
    }   
});

    /* Set the width of the side navigation to 250px and the left margin of the page content to 250px */
function openNav() {
    document.getElementById("mySidenav").style.width = "250px";
    document.getElementById("main").style.marginLeft = "250px";
  }
  
  /* Set the width of the side navigation to 0 and the left margin of the page content to 0 */
  function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.getElementById("main").style.marginLeft = "0";
  }
  