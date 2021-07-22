var eyeslashElement = document.querySelector('.fa-eye-slash');
var eyeElement = document.querySelector('.fa-eye');
var inputPass = document.querySelector('#passlogin');
eyeslashElement.onclick = function () {
    eyeElement.style.display = 'block';
    eyeslashElement.style.display = 'none';
    inputPass.type = "text";
}

eyeElement.onclick = function () {
    eyeElement.style.display = 'none';
    eyeslashElement.style.display = 'block';
    inputPass.type = "password";
}
