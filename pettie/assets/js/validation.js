if (document.getElementById("user_login_auth")) {
    document.getElementById("user_login_auth").addEventListener("keyup", function () {
        let login = document.getElementById("user_login_auth").value;
        if (login.length < 2) {
            document.getElementById("login_helper").innerHTML = "Логин должнен состоять хотя бы из двух знаков.";
        } else if (login.match(/[а-яА-Я]+/)) {
            document.getElementById("login_helper").innerHTML = "Логин должен состоять из латинских букв и цифр.";
        } else if (!login.match(/[a-zA-Z]+/)) {
            document.getElementById("login_helper").innerHTML = "Должна присутствовать хотя бы одна буква.";
        } else {
            document.getElementById("login_helper").innerHTML = "";
        }
    });
}

if (document.getElementById("user_password_reg")) {
    document.getElementById("user_password_reg").addEventListener("keyup", function () {
        let password = document.getElementById("user_password_reg").value;
        if (password.length < 6) {
            document.getElementById("password_helper").innerHTML = "Пароль должнен состоять хотя бы из шести знаков.";
        } else if (!password.match(/[a-zA-Zа-яА-Я]+/)) {
            document.getElementById("password_helper").innerHTML = "Должна присутствовать хотя бы одна буква.";
        } else {
            document.getElementById("password_helper").innerHTML = "";
        }
        let password_repeat = document.getElementById("user_password_repeat").value;
        if(password != "" && password_repeat != ""){
            check_passwords();
        }
    });
}

if (document.getElementById("user_password_repeat")) {
    document.getElementById("user_password_repeat").addEventListener("keyup", check_passwords);
}


function check_passwords() {
        let password_repeat = document.getElementById("user_password_repeat").value;
        let password = document.getElementById("user_password_reg").value;
        if (password_repeat != password) {
            document.getElementById("password_repeat_helper").innerHTML = "Пароли не совпадают!";
        } else {
            document.getElementById("password_repeat_helper").innerHTML = "";
        }
    }

if (document.getElementById("user_password_auth")) {
    document.getElementById("user_password_auth").addEventListener("keyup", function () {
        let password = document.getElementById("user_password_auth").value;
        if (password.length < 6) {
            document.getElementById("password_helper").innerHTML = "Пароль должнен состоять хотя бы из шести знаков.";
        } else {
            document.getElementById("password_helper").innerHTML = "";
        }
        let password_repeat = document.getElementById("user_password_repeat").value;
        if(password != "" && password_repeat != ""){
            check_passwords();
        }
    });
}