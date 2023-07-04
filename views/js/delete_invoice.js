const deleteInvoice = (id) =>{
    console.log('inside delete function..')
    if (confirm("Are you sure you want to delete this invoice?")) {
        fetch('../../controller/delete_invoice.php?id=' + id, {
            method : 'DELETE',
        })
        .then(res => {
            if (res.ok){
                return res.json()
            }else{
                console.log('not deleted')
            }
        })
        .then(data => {
            console.log('delete data = ', data);
            if (data == 'Invoice Deleted Successfully'){
                alert(data)
                location.reload();
            }
        })
    }

}