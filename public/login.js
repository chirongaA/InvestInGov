window.onload = () => {
    const form = document.getElementById('Login');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new URLSearchParams(new FormData(form));
        fetch('../submit_login', {
            method: "POST",
            body: formData,
        }).then(res => res.json())
        .then(data => {
            console.log(data);
        })
    })
}

