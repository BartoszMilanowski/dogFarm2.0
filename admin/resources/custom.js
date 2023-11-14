document.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();


    const btn = document.querySelector('.changePhoto');
    const radioInputs = document.querySelectorAll('input[name="selectedPhoto"]');

    if (btn) {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            togglePhotosList();
        })
    }

    if(radioInputs){
        radioInputs.forEach((radioInput) => {
            radioInput.addEventListener('change', (e) => {
                e.preventDefault();
                changePhoto(radioInput);
            })
        })
    }
});

const togglePhotosList = () => {
    const photosList = document.querySelector('.showPhotos');

    if (photosList.classList.contains('hidden')) {
        photosList.classList.remove('hidden');
    } else {
        photosList.classList.add('hidden');
    }
}

const changePhoto = (radioInput) => {
    
    const currentPhoto = document.querySelector("#currentPhoto");
    const hiddenInput = document.querySelector('input[name="currentPhotoLink"]');

    currentPhoto.src = "../" + radioInput.value;
    hiddenInput.value = radioInput.value;

    togglePhotosList();

}