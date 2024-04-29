document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();
    console.log("are we here???");

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    var data = new URLSearchParams();
    data.append('username', username);
    data.append('password', password);

    axios.post('login.php', data)
        .then(function (response) {
            var data = response.data;
            if (data.success) {
                window.location.href = 'index.php';
            } else {
                document.getElementById('responseMessage').textContent = data.message;
            }
        })
        .catch(function (error) {
            console.error(error);
        });
});