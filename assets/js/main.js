//Smooth Scroll Menu
$(function() {
    $('.navbar a, footer a ').on('click', function(event) {
        event.preventDefault();
        let hash = this.hash;
        $('body, html').animate({scrollTop: $(hash).offset().top}, 900, 
        function() {
            window.location.hash = hash;
        })
    })
})


//Progresses Barres Animation
function scrollAppear() {
    var progressesBarres = document.querySelector('.progresses');
    var secondBarre = document.querySelector('.progresses:nth-child(2)');
    var thirdBarre = document.querySelector('.progresses:nth-child(3)');
    var barrePosition = progressesBarres.getBoundingClientRect().top;
    var screenPosition = window.innerHeight /1.2;

    if (barrePosition < screenPosition) {
        progressesBarres.classList.add('progresses-appear');
        secondBarre.classList.add('progresses-appear');
        thirdBarre.classList.add('progresses-appear');
    }
}
window.addEventListener('scroll', scrollAppear);



// Timeline Animation
const allRonds = document.querySelectorAll('.review-badge');
const allBoxes = document.querySelectorAll('.review-generale');

const controller = new ScrollMagic.Controller();

allBoxes.forEach(box => {
    for(i = 0; i < allRonds.length; i++) {
        if(allRonds[i].getAttribute('data-anim') === box.getAttribute('data-anim')) {
            let tween = gsap.from(box, {y: -50, opacity: 0, duration: 0.5});
            let scene = new ScrollMagic.Scene({
                triggerElement: allRonds[i],
                reverse: false //si true : disparait au retour
            })
            .setTween(tween)
            //.addIndicators()
            .addTo(controller)
        }
    }
})


//DarkMode
const toggleSwitch = document.querySelector('.theme-switch input[type="checkbox"]');

function switchTheme(e) {
    if (e.target.checked) {
        document.body.classList.add('darkmode');
    }
    else {
        document.body.classList.remove('darkmode');
    }    
}

toggleSwitch.addEventListener('change', switchTheme, false);