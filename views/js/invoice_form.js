// script.js
import routes from "./routes";
document.addEventListener('DOMContentLoaded', function() {
document.getElementById('createInvoice').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent form submission

    var form = new FormData(this);
    if (validateForm()){
        console.log('form = ', form);
        fetch('../../controller/invoice_form.php', {
            method: 'POST',
            body: form
        })
        .then(function(response) {
            if (response.ok) {
                alert ('saved!!',response.text());
                } else {
                // throw new Error('Error: ' + response.status);
                console.log('error-----',response.text())
            }
            })
    }
    })
});

function validateForm() {
    console.log('inside vaalidaee form...')
    var invoiceNumInput = document.getElementById('finvoice');
    var nameInput = document.getElementById('fname');
    var addressInput = document.getElementById('faddress');
    
    // Check if any of the fields are empty
    if (invoiceNumInput.value.trim() == '' || nameInput.value.trim() == '' || addressInput.value.trim() == '') {
        alert('Please fill in all fields');
        return false; 
    }
    
    return true; 
    }