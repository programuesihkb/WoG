$(document).ready(function () {
    $("#loginForm").submit(function (event) {
      event.preventDefault();

     var formData = {
            username: $("#username").val(),
            password: $("#password").val()
        };
      console.log(formData.password , ' ', typeof formData.password);
      $.ajax({
        type: "POST",
        url: "login.php",
        data: formData,
        dataType: "json",
        success: function (response) {
          if (response.success) {
            window.location.href = "index.php";
          } else {
            $("#responseMessage").text(response.message);
          }
        },
        error: function (xhr, status, error) {
          console.error("Error:", error);
        },
      });
    });
  });
