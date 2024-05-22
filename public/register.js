window.onload = () => {
    const form = document.getElementById('registration');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new URLSearchParams(new FormData(form));
        fetch('../submit_register', {
            method: "POST",
            body: formData,
        }).then(res => res.json())
        .then(data => {
            //check if there is an error
            if(data.status=="error"){
                //display the error message
                alert(data.message);
            }
            else{
                // alert(data.message);
                window.location.href = "./home";
            }
        })
    })
}