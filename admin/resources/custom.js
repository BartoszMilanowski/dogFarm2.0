document.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();
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