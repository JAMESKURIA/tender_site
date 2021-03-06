const buttons = document.getElementsByClassName("two-buttons")[0];
const login = buttons.getElementsByTagName("button")[0];
const register = buttons.getElementsByTagName("button")[1];
const loginSection = document.querySelector('.login-section');
const registerSection = document.querySelector('.register-section');
const existingAccount = document.querySelector("#existing-account")


const showLogin = () => {
    loginSection.style.display = "grid";
    registerSection.style.display = "none"

    login.style.boxShadow = " 2px -2px 5px rgb(231, 227, 227), -2px -2px 5px rgb(231, 227, 227)";
    register.style.boxShadow = "inset 2px -2px 3px rgb(231, 227, 227), inset -1px 1px 1px rgb(231, 227, 227)";

    register.style.color = "#333";
    login.style.color = "#00bcd4";
}

const showRegister = () => {
    loginSection.style.display = "none";
    registerSection.style.display = "grid";

    register.style.boxShadow = "2px -2px 5px rgb(231, 227, 227), -2px -2px 5px rgb(231, 227, 227)";
    login.style.boxShadow = "inset -2px 2px 3px rgb(231, 227, 227), inset 1px -1px 1px rgb(231, 227, 227)";

    register.style.color = "#00bcd4";
    login.style.color = "#333";
}

login.addEventListener('click', showLogin);
register.addEventListener('click', showRegister);

existingAccount.addEventListener("click", showLogin);