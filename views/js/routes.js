const server_path = '/var/www/yarikul_traning/controller/';

const routes ={
    LIST_INVOICES: server_path + 'list_invoices.php',
    CREATE_INVOICE: server_path + 'invoice_form.php',
    INVOICE_DETAIL: server_path + 'invoice_detail.php',
    UPDATE_INVOICE: server_path + 'update_invoice.php',
    DELETE_INVOICE: server_path + 'delete_invoice.php',
};

export default routes;