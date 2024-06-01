document.addEventListener('DOMContentLoaded', () => {
    const bidForm = document.getElementById('bidForm');
    const paymentForm = document.getElementById('paymentForm');

    if (bidForm) {
        bidForm.addEventListener('submit', (event) => {
            event.preventDefault();
            if (validateBidForm()) {
                bidForm.submit();
            }
        });
    }

    if (paymentForm) {
        paymentForm.addEventListener('submit', (event) => {
            event.preventDefault();
            if (validateAndFormatPaymentForm()) {
                paymentForm.submit();
            }
        });
    }

    function validateBidForm() {
        const username = document.getElementById('username').value.trim();
        const bond_id = document.getElementById('bond_id').value.trim();
        const yieldValue = document.getElementById('yield').value.trim();
        const facevalue = document.getElementById('facevalue').value.trim();
        const maturity = document.getElementById('maturity').value.trim();
        const rate = document.getElementById('rate').value.trim();

        if (!username || !bond_id || !yieldValue || !facevalue || !maturity || !rate) {
            alert('All fields are required.');
            return false;
        }

        if (isNaN(yieldValue) || isNaN(facevalue) || isNaN(rate)) {
            alert('Yield, Face Value, and Rate must be numeric.');
            return false;
        }

        if (new Date(maturity) <= new Date()) {
            alert('Maturity date must be in the future.');
            return false;
        }

        return true;
    }

    function validateAndFormatPaymentForm() {
        const phonenumberInput = document.getElementById('phonenumber');
        let phonenumber = phonenumberInput.value.trim();

        // Remove any non-numeric characters
        phonenumber = phonenumber.replace(/\D/g, '');

        if (phonenumber.startsWith('0')) {
            phonenumber = '254' + phonenumber.substring(1);
        }

        // Check if the phone number is valid
        const phonePattern = /^2547\d{8}$/;

        if (!phonePattern.test(phonenumber)) {
            alert('Phone Number must be a valid Kenyan number in the format 07XXXXXXXX.');
            return false;
        }

        phonenumberInput.value = phonenumber;

        // Clear the form after submission
        setTimeout(() => {
            document.getElementById('paymentForm').reset();
        }, 1000);
        
        return true;
    }
});
