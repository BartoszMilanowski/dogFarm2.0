document.addEventListener('DOMContentLoaded', (e) => {
    e.preventDefault();

    const showListButtons = document.querySelectorAll('.showList');
    const radioInputs = document.querySelectorAll('input[name="selectedPhotoId"]');


    showListButtons.forEach((btn) => {
        btn.addEventListener('click', (e) => {
            e.preventDefault();
            const targetId = btn.getAttribute('data-target');
            togglePhotosList(targetId);
        }) 
    })

    if(radioInputs){
        radioInputs.forEach((radioInput) => {
            radioInput.addEventListener('change', () => {
                e.preventDefault();
                const targetId = radioInput.closest('.photosList').id;
                console.log(targetId);
                changePhoto(radioInput, targetId);
            })
        })
    }
});

const changePhoto = (radioInput, targetId) => {

    const currentPhoto = document.querySelector("#currentPhoto");
    const hiddenInput = document.querySelector('input[name="currentPhotoId"]');
    const selectedLink = radioInput.closest('label').querySelector('.selectedPhotoLink');
    const currentId = document.querySelector("#currentId");

    if(currentId.hasAttribute('hidden')){
        currentId.removeAttribute('hidden');
    }

    if(currentPhoto.hasAttribute('hidden')){
        currentPhoto.removeAttribute('hidden');
    }

    currentPhoto.src = selectedLink.src;
    hiddenInput.value = radioInput.value;
    currentId.innerHTML = "Id: " + radioInput.value;
    radioInput.checked = false;

    togglePhotosList(targetId);
}

const togglePhotosList = (targetId) => {
    const photosList = document.getElementById(targetId);

    if (photosList.classList.contains('hidden')) {
        photosList.classList.remove('hidden');
    } else {
        photosList.classList.add('hidden');
    }
}
