const wrapper= document.querySelector('.wrapper');
const loginLink = document.querySelector('.login-link');
const registerLink = document.querySelector('.register-link');
const btnLogin = document.querySelector('.header__btn-login');
const btnClose = document.querySelector('.icon-close');
const p_error_registr = document.querySelector('.error_registr');
const p_error_log = document.querySelector('.error_log');

registerLink.addEventListener("click", ()=>{
    wrapper.classList.add('active');
    p_error_log.classList.add('invisible')
});

loginLink.addEventListener("click", ()=>
{
    wrapper.classList.remove('active');
    p_error_registr.classList.add('invisible')
});

btnLogin.addEventListener("click", ()=>
{
    wrapper.classList.add('active-btn');
});

btnClose.addEventListener("click", ()=>
{
    wrapper.classList.remove('active-btn');
    p_error_registr.classList.add('invisible')
    p_error_log.classList.add('invisible')
});

