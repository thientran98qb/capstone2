const myslide = document.querySelectorAll('.myslide'),
	  dot = document.querySelectorAll('.dot');
let counter = 1;
slidefun(counter);

let timer = setInterval(autoSlide, 8000);
function autoSlide() {
	counter += 1;
	slidefun(counter);
}
function plusSlides(n) {
	counter += n;
	slidefun(counter);
	resetTimer();
}
function currentSlide(n) {
	counter = n;
	slidefun(counter);
	resetTimer();
}
function resetTimer() {
	clearInterval(timer);
	timer = setInterval(autoSlide, 8000);
}

function slidefun(n) {
	
	let i;
	for(i = 0;i<myslide.length;i++){
		myslide[i].style.display = "none";
	}
	for(i = 0;i<dot.length;i++) {
		dot[i].className = dot[i].className.replace(' active', '');
	}
	if(n > myslide.length){
	   counter = 1;
	   }
	if(n < 1){
	   counter = myslide.length;
	   }
	myslide[counter - 1].style.display = "block";
	dot[counter - 1].className += " active";
}



function searchclick() {
	let searchtxt = document.querySelector('.search-txt');
	let widthnav = document.querySelectorAll('.header__nav--item');

	searchtxt.classList.toggle('search-txt-width');
	for (i = 0; i < widthnav.length; i++) {
		widthnav[i].classList.toggle('header__nav--item-toggle');
	}
	// widthnav.classList.toggle('header__nav--item-toggle');
}
// Scroll 

// const sr = ScrollReveal({
//     origin: 'top',
//     distance: '30px',
//     duration: 1800,
//     reset: true
// });

// sr.reveal(`.about,.about__content,.about__end,.popular,.new,.dish`, {
//     interval: 200
// })

