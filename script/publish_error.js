function error_publish(){
    const wrapper2= document.querySelector('.wrapper');
    wrapper2.classList.add('active-btn');
}

var isRealisePublish = true
if (isRealisePublish)
{
    error_publish();
    isRealisePublish = false
}