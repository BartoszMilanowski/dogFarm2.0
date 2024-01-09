window.onscroll = () => {scrollFunction();}

document.addEventListener('DOMContentLoaded', () => {
    modalGallery();
    showSlides();
    toggleMenu();
})


const scrollFunction = () => {
    if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
        document.querySelector('.navbar').style.background = 'rgba(244, 246, 247, 1)';
    } else {
        document.querySelector('.navbar').style.background = 'rgba(244, 246, 247, 0.3)';

    }
}

const modalGallery = () => {
    const images = document.querySelectorAll('.gallery-item img');
    let currentIndex = 0;

    images.forEach((img) => {
        img.addEventListener('click', () => {
            imgModal(img);
        })
    });

    let imgModal = (img) => {

        currentIndex = Array.from(images).indexOf(img);
        let src = img.src;

        const modal = document.createElement('div');
        modal.setAttribute('class', 'modal');
        document.querySelector('.gallery').append(modal);

        const newImage = document.createElement('img');
        newImage.setAttribute('src', src);

        const prevBtn = document.createElement('i');
        prevBtn.setAttribute('class', 'fas fa-arrow-left prevBtn');
        prevBtn.onclick = () => handlePrev(newImage);

        const nextBtn = document.createElement('i');
        nextBtn.setAttribute('class', 'fas fa-arrow-right nextBtn');
        nextBtn.onclick = () => handleNext(newImage);

        const closeBtn = document.createElement('i');
        closeBtn.setAttribute('class', 'fas fa-times closeBtn');
        closeBtn.onclick = () => handleEsc(modal);

        document.addEventListener('keydown', (event) => {
            switch(event.key){
                case 'ArrowLeft':
                    handlePrev(newImage);
                    break;
                case 'ArrowRight':
                    handleNext(newImage);
                    break;
                case 'Escape':
                    handleEsc(modal);
                    break;
                default:
                    break;
            }
        })

        modal.append(newImage, closeBtn, prevBtn, nextBtn);
    };

    const handlePrev = (newImage) => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        newImage.src = images[currentIndex].src;
    };

    const handleNext = (newImage) => {
        currentIndex = (currentIndex + 1) % images.length;
        newImage.src = images[currentIndex].src;
    };

    const handleEsc = (modal) => {
        modal.remove();
    }
}


let slideIndex = 0;

const showSlides = () => {

    let i;
    const slides = document.querySelectorAll('.slide');

    if(slides.length === 0){
        return;
    }

    for (i = 0; i < slides.length; i++) {
        slides[i].style.display = 'none';
    };
    slideIndex++;
    if (slideIndex > slides.length) { slideIndex = 1 };
    slides[slideIndex - 1].style.display = 'block';
    setTimeout(showSlides, 5000);
}

const toggleMenu = () => {
    const closeBtn = document.querySelector('.close-menu');
    const openBtn = document.querySelector('.burger-icon');
    const menu = document.querySelector('.menu-list');

    openBtn.onclick = () => {
        menu.style.display = 'flex';
    }

    closeBtn.onclick = () => {
        menu.style.display = 'none';
    }


}