export function displayErrorMessage(message, modalId) {
    var responseMessage;
    var errorAlert;

    if (modalId === 'signInModal') {
        responseMessage = document.getElementById('responseMessage');
        errorAlert = document.getElementById('errorAlert');
    } else if (modalId === 'signUpModal') {
        responseMessage = document.getElementById('responseMessage2');
        errorAlert = document.getElementById('errorAlert2');
    }

    if (responseMessage && errorAlert) {
        responseMessage.textContent = message;
        errorAlert.classList.remove('d-none');
    }
}

document.getElementById('loginForm').addEventListener('submit', function(event) {
    event.preventDefault();

    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;

    
    var errorAlert = document.getElementById('errorAlert');
    errorAlert.classList.add('d-none');

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
    data.append('password', password);
    axios.post('login.php', data)
        .then(function (response) {
            if (response.status) {
                window.location.href = 'index.php';
            } else {
                displayErrorMessage(response.statusText, 'signInModal');
            }
        })
        .catch(function (error) {
            console.error(error);
        });
});
