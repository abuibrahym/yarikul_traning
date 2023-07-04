
document.addEventListener('DOMContentLoaded', function() {
    // Get the table body element
    var tableBody = document.getElementById('invoiceTableBody');
  
    // Fetch the data from the PHP script
    fetch('../../controller/list_invoices.php') // /php/list_invoices.php
    .then(function(response) {
        if (response.ok) {
            console.log('inside if block . response is ok!!!');
            data = response.json(); 
            console.log('data=', data)
            return data;

        }else {
            // throw new Error('Error: ' + response.status);
            console.log('error')
            }
    })
        .then(function(data){
            console.log('data in 2nd then ', data);
            rows = '';
            data.forEach(function(invoice) {
            rows += '<tr>';
            rows += '<td>' + invoice.invoice_number + '</td>';
            rows += '<td>' + invoice.invoice_name + '</td>';
            rows += '<td>' + invoice.address + '</td>';
            rows += '<td><button onClick="deleteInvoice(\'' + invoice.id + '\')">Delete</button></td>';

            rows += '<td><td><a href="update_invoice.html?id=' + invoice.id + '">Update</a></td>';
            rows += '</tr>';
        })
        tableBody.innerHTML = rows;
        
    })
    .catch(function(error) {
        console.log('Fetch Error:', error);
    });
})

