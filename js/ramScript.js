let heroImgContainer = document.getElementById('header-hero');
let randomImgNumber = Math.ceil(Math.random() * 6);
if (heroImgContainer) {
    heroImgContainer.style.backgroundImage = `url('img/hero-img/${randomImgNumber}.jpg')`;
};

let pexesoCards = document.querySelectorAll('.pexeso-card');

pexesoCards.forEach(pexesoCard => {
    pexesoCard.addEventListener('click', function() {
        this.classList.remove('hidden-card');
        let seenPexesoCards = document.querySelectorAll('.pexeso-card:not(.hidden-card):not(.matched)');

        if (seenPexesoCards.length > 1) {
            if (seenPexesoCards[0].dataset.value !== seenPexesoCards[1].dataset.value) {
                setTimeout(() => {
                    seenPexesoCards.forEach(item => {
                        item.classList.add('hidden-card');
                    });
                }, 1500);
            }
            else {
                seenPexesoCards[0].classList.add('matched');
                seenPexesoCards[1].classList.add('matched');
            }
        }
    });
});