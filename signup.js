document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var username = document.getElementById('username2').value;
    var dateOfBirth = document.getElementById('dateOfBirth').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password2').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    var data = new URLSearchParams();
    data.append('username', username);
    data.append('dateOfBirth', dateOfBirth);
    data.append('email', email);
    data.append('password', password);
    data.append('confirmPassword', confirmPassword);

    axios.post('signup.php', data)
        .then(function (response) {
            var data = response.data;
            if (data.success) {
                console.log(data);
                window.location.href = 'index.php';
            } else {
                document.getElementById('responseMessage').textContent = data.message;
                console.log(data);
            }
        })
        .catch(function (error) {
            console.error(error);
        });
});