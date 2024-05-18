window.onload = () => {
    const form = document.getElementById('Bids');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new URLSearchParams(new FormData(form));
        fetch('../submit_bid', {
            method: "POST",
            body: formData,
        }).then(res => res.json())
        .then(data => {
            console.log(data);
        })
    })
}