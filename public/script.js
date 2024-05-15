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
    
    function clearForm(){
        document.getElementById('Bids').reset();
            var fieldsToValidate = ['username', 'bondID', 'yield', 'fvalue', 'maturity', 'rate'];
            fieldsToValidate.forEach(function(field) {
                document.getElementById(field).classList.remove('invalid');
                document.getElementById(field + 'Error').textContent = '';
  });
}

function validateYield() {
    var yield = document.getElementById('yield').value;
    if (yield % 50000 !== 0) {
        alert('Yield must be a multiple of 50,000');
        document.getElementById('yield').value = '';
    }
}