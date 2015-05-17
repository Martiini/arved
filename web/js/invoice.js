var doc = new jsPDF();

function updatePreview(download) {

    doc.setFontSize(20);
    doc.text(35, 25, $('#inv_title').text());

    doc.setFontSize(12);
    doc.text(35, 34, 'Client: ' + $('#inv_client').text());

    var urlString = doc.output('dataurlstring');

    $('#pdf_preview').attr({
        src: urlString
    });

    if (download) {
        doc.save('invoice.pdf');
    }

}
