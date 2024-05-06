function displayErrorMessage(message) {
    var responseMessageSignUp = document.getElementById('responseMessage2');
    responseMessageSignUp.textContent = message;
    document.getElementById('errorAlert2').classList.remove('d-none');
}

document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var username = document.getElementById('username2').value;
    var dateOfBirth = document.getElementById('dateOfBirth').value;
    var email = document.getElementById('email').value;
    var password = document.getElementById('password2').value;
    var confirmPassword = document.getElementById('confirmPassword').value;

    var errorAlertSignUp = document.getElementById('errorAlert2');
    errorAlertSignUp.classList.add('d-none');

    if (username.trim() === '' || password.trim() === '') {
        displayErrorMessage('Username or password cannot be empty');
        return;
    }

    if (username.length <= 5 || username.length > 20) {
        displayErrorMessage('Username must be between 5 and 20 characters');
        return;
    }

    if (!/^[a-zA-Z0-9]+$/.test(username)) {
        displayErrorMessage('Username can only contain letters and numbers');
        return;
    }

    if (password.length < 8 || password.length > 20) {
        displayErrorMessage('Password must be between 8 and 20 characters');
        return;
    }

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
                window.location.href = 'index.php';
            } else {
                displayErrorMessage(data.message);
            }
        })
        .catch(function (error) {
            console.error(error);
        });
});