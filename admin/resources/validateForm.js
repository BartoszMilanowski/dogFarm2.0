const validateForm = () => {

    const inputs = document.querySelectorAll("input[type=text], textarea");
    let isValid = true;

    inputs.forEach((input) =>{
        if(input.value.trim() === ''){
            isValid = false;
        }
    });

    if(!isValid){
        alert('Uzupełnij wszystkie pola!');
    }

    return isValid;
}