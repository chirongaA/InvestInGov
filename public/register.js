window.onload=()=>{
    //Get the form with the id regisration
    const form = document.getElementById('registration');
    //Add an event listener to the form
    form.addEventListener('submit', (e)=>{
        //Prevent the default form submission
        e.preventDefault();
        //Get the form data
        const formData = new FormData(form);
       //Use fecth API to send data
       fetch('../submit_register',{
        method:"post",
        body:formData
        }).then(response=>{
            console.log(response)
        })
    })
}