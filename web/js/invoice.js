function updatePreview(download) {
    text_pos = 100;
    var id = $('#item_table').attr('data-id');

    var doc = new jsPDF();

    $.get( "json?invoice_id=" + id, function( data ) {

        data = JSON.parse(data);

        $('#total_sum').text(data.sum + ' €');

        doc.setFontSize(20);
        doc.text(25, 25, data.invoice.name);

        doc.setFontSize(12);
        doc.text(25, 34, 'Client name: ' + data.client.first_name + ' ' + data.client.last_name);
        doc.text(25, 40, 'Address: ' + data.client.address);
        doc.text(25, 46, 'Email: ' + data.client.email);
        doc.text(25, 52, 'Phone: ' + data.client.phone);
        doc.text(25, 58, 'Company: ' + data.client.company);

        doc.setFontSize(14);
        doc.text(25, 90, 'Items purchased');

        doc.setFontSize(12);
        $.each(data.rows, function(id, row) {
            doc.text(25, text_pos, row.name);
            doc.text(100, text_pos, row.sum + ' €');
            text_pos += 6;
        });

        text_pos =+ 10;
        doc.text(25, text_pos, 'Total:');
        doc.text(100, text_pos, data.sum + ' €');

        if (download) {
            doc.save('invoice.pdf');
        } else {

            var urlString = doc.output('dataurlstring');

            $('#pdf_preview').attr({
                src: urlString
            });

        }
    });

}

function addItem() {
    var invoice_id = $('#add_item_form').attr('data-id');

    $.post( "api", { 'action': "add", 'invoice_id': invoice_id, 'name': $('#item_name').val(), 'sum': $('#item_sum').val() } ).done(function( data ) {
        if(data != 'failed') {
            var newRow = $('#item_form tbody').html().replace('{{name}}', $('#item_name').val()).replace('{{sum}}', $('#item_sum').val()).replace('{{id}}', data).replace('{{id}}', data);
            $('#item_table tr:nth-last-child(3)').after(newRow);
            updatePreview();
            $('#item_name').val('');
            $('#item_sum').val('');
        } else {
            alert('Something went wrong');
        }
    });
}

function removeItem(item_id) {
    $.post( "api", { 'action': "remove", 'item_id': item_id} ).done(function( data ) {
        if(data == 'success') {
            $('#item_' + item_id).remove();
            updatePreview();
        } else {
            alert('Something went wrong');
        }
    });
}

$("#add_item_form").keypress(function(e) {
    if(e.which == 13) {
        addItem();
    }
});

$( document ).ready(function() {
    updatePreview();
});