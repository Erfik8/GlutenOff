function registerPage(event) {
    window.location.href = 'http://localhost:8000/register';
}

function loginPage(event) {
    window.location.href = 'http://localhost:8000/login';
}

function validateRegistrationForm() {
    var nameInput = document.getElementById('name');
    var surnameInput = document.getElementById('surname');
    var emailInput = document.getElementById('emal');
    var passwordInput = document.getElementById('password');
    var password2Input = document.getElementById('password2');


    var name = nameInput.value.trim();
    var surname = surnameInput.value.trim();
    var email = emailInput.value.trim();
    var password = passwordInput.value;
    var password2 = password2Input.value;

    if (name === '' || !isValidName(name)) {
        alert('Name is incorrect');
        nameInput.focus();
        return false;
    }

    if (surname === '' || !isValidName(surname)) {
        alert('Surname is incorrect');
        surnameInput.focus();
        return false;
    }

    if (email === '') {
        alert('Please enter your email address.');
        emailInput.focus();
        return false;
    } 

    if (password === '') {
        alert('Please enter a password.');
        passwordInput.focus();
        return false;
    }

    if (password !== password2) {
        alert('Password and confirm password do not match.');
        password2Input.focus();
        return false;
    }
    return true;
}

function isValidName(name) {
    var nameRegex = /^[A-Z][a-z]*$/;
    return nameRegex.test(name);
}
