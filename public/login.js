window.onload = () => {
    const form = document.getElementById('Login');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new URLSearchParams(new FormData(form));
        fetch('../submit_login', {
            method: "POST",
            body: formData,
        }).then(res => res.text())
        .then(data => {
            //Parse data from the server
            data=JSON.parse(data);
            //check for an error status
            if(data.status=="error"){
                //display the error message
                // document.getElementById('error').textContent=data.message;
                alert(data.message);
            }
            else{
                alert(data.message);
                window.location.href = "./home";
            }
        })
    })
}

