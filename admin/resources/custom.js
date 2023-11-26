document.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();

    const btn = document.querySelector('.changePhoto');
    const radioInputs = document.querySelectorAll('input[name="selectedPhotoId"]');

    if (btn) {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            togglePhotosList();
        })
    }

    if(radioInputs){
        radioInputs.forEach((radioInput) => {
            radioInput.addEventListener('change', () => {
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
    const hiddenInput = document.querySelector('input[name="currentPhotoId"]');
    const selectedLink = radioInput.closest('label').querySelector('.selectedPhotoLink');
    const currentId = document.querySelector("#currentId");


    currentPhoto.src = selectedLink.src;
    hiddenInput.value = radioInput.value;
    currentId.innerHTML = "Id: " + radioInput.value;
    radioInput.checked = false;

    togglePhotosList();
}
