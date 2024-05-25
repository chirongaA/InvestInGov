window.onload = () => {
    const form = document.getElementById('Securities');
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new URLSearchParams(new FormData(form));
        fetch('../submit_security', {
            method: "POST",
            body: formData,
        }).then(res => res.json())
        .then(data => {
            console.log(data);
        })
    })
}

const body = document.querySelector("body"),
    sidebar = body.querySelector(".sidebar"),
    toggle = body.querySelector(".toggle"),
    searchBtn = body.querySelector(".search-box"),
    modeSwitch = body.querySelector(".toggle-switch"),
    modeText = body.querySelector(".mode-text");

    toggle.addEventListener("click", () => {
        sidebar.classList.toggle("close");
    });
    searchBtn.addEventListener("click", () => {
        sidebar.classList.remove("close");
    });


    modeSwitch.addEventListener("click", () => {
        body.classList.toggle("dark");

        if (body.classList.contains("dark")) {
            modeText.innerText = "Light Mode";
        } else {
            modeText.innerText = "Dark Mode";
        }
    });


    function validateFvalue() {
        var yield = document.getElementById('facevalue').value;
        if (yield % 50000 !== 0) {
            alert('Face Value must be a multiple of 50,000');
            document.getElementById('facevalue').value = '';
        }
    }

    function clearForm(){
        document.getElementById('Securities').reset();
            var fieldsToValidate = ['bond_id', 'bond_name', 'facevalue', 'maturity', 'rate', 'status'];
            fieldsToValidate.forEach(function(field) {
                document.getElementById(field).classList.remove('invalid');
                document.getElementById(field + 'Error').textContent = '';
  });
}