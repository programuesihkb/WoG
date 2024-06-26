import { displayErrorMessage } from "./login";

document.getElementById('signupForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var username = document.getElementById('username2').value;
    var dateOfBirth = document.getElementById('dateOfBirth').value ?? '';
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
    console.log("dateOfBirth:", dateOfBirth);

    var data = new URLSearchParams();
    data.append('username', username);
    data.append('dateOfBirth', dateOfBirth);
    data.append('email', email);
    data.append('password', password);
    data.append('confirmPassword', confirmPassword);

    axios.post('signup.php', data)
        .then(function (response) {
            if (response.data.success) {
                const user_obj = {
                    user_name : username,
                    user_email : email,
                    user_role : 'user',
                };
                localStorage.setItem('user', JSON.stringify(user_obj));
                window.location.href = 'index.php';
            } else {
                displayErrorMessage(response.data.message, 'signUpModal');
            }
        })
        .catch(function (error) {
            console.error(error);
        });
});