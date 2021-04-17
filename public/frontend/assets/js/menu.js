// bar menu fixed
document.addEventListener('DOMContentLoaded',function(){
    var positionBar = document.querySelector('.bar');
    window.addEventListener('scroll',function(){
        console.log(window.pageYOffset);
        if(window.pageYOffset==300){
            positionBar.classList.add('bar-fixed');
        }
        if(window.pageYOffset<300){
            positionBar.classList.remove('bar-fixed');
        }
    })

})
