import routes from "./routes";
document.addEventListener('DOMContentLoaded', function() {
    const urlParams = new URLSearchParams(window.location.search);
    const id = urlParams.get('id');
    var updateInvoiceForm = document.getElementById('updateInvoiceForm');
    var invoiceIdInput = document.getElementById('invoiceId');
    var invoiceNumberInput = document.getElementById('invoiceNumber');
    var customerNameInput = document.getElementById('customerName');
    var addressInput = document.getElementById('address');

    // Fetch existing invoice data
    fetch('../../controller/invoice_detail.php?id=' + id,{
        method:'GET'
    })
        .then(function(response) {
            if (response.ok) {
                return response.json(); // Parse the response as JSON
            } else {
                throw new Error('Error: ' + response.status);
            }
        })
        .then(function(data) {
            invoiceNumberInput.value = data.invoice_number;
            customerNameInput.value = data.invoice_name;
            addressInput.value = data.address;
        })
        .catch(function(error) {
            console.log(error);
        });

    // Handle form submission
    updateInvoiceForm.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent form submission

        var form = new FormData(this);
        form.append('id', id); // Add invoice ID to the form data

        // Send the updated invoice data to the server
        fetch('../../controller/update_invoice.php', {
            method: 'POST',
            body: form
        })
        .then(function(response) {

            if (response.ok) {
                console.log('response = ', response.json())
                alert('Invoice updated successfully');
                location.href = '../list_invoices.html';
            } else {
                throw new Error('Error: ' + response.status);
            }
        })
        .catch(function(error) {
            console.log(error);
        });
    });
});
