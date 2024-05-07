const wrapper= document.querySelector('.wrapper');
const btnPublish = document.querySelector('.btn-publish');
const btnClose = document.querySelector('.icon-close');
const p_error_publish = document.querySelector('.error_publish');

btnPublish.addEventListener("click", ()=>
{
    wrapper.classList.add('active-btn');
});

btnClose.addEventListener("click", ()=>
{
    wrapper.classList.remove('active-btn');
    p_error_publish.classList.add('invisible')
});