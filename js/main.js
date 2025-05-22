$(document).ready(function () {
  $("#loginForm").submit(function (event) {
    event.preventDefault();

    var username = $.trim($('input[name="username"]').val());
    var password = $.trim($('input[name="password"]').val());

    password = encodeURIComponent(password);

    loginUser(username, password);
  });
});

function loginUser(username, password) {
  $.ajax({
    url: "./backend/login.php",
    method: "POST",
    data: { username: username, password: password },
    dataType: "json",
    success: function (response) {
      console.log("Respuesta nuevo user", response);

      if (response.status === "success") {
        window.location.href = "./views/index.php";
      } else if (response.status === "error") {
        if (response.message === "El usuario está inactivo") {
          showAlert(response.message);
        } else {
          showAlert(response.message);
          $('input[name="username"]').val("");
          $('input[name="password"]').val("");
        }
      } else {
        $("#result").html("<p>Error en llamada AJAX</p>");
      }
    },
    error: function () {
      showAlert("Error de conexión con el servidor.");
    }
  });
}

function showAlert(message) {
  $(".form-container .alert").remove(); // Eliminar alerta anterior si existe

  const alertBox = `<div class="alert">${message}</div>`;
  $(".form-container").prepend(alertBox);

  setTimeout(() => {
    $(".alert").fadeOut(500, function () {
      $(this).remove();
    });
  }, 3000);
}
