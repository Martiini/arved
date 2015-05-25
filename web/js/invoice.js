function updatePreview(download) {
    var doc = new jsPDF();

    doc.setFontSize(20);
    doc.text(35, 25, $('#inv_title').text());

    doc.setFontSize(12);
    doc.text(35, 34, 'Client: ' + $('#inv_client').text());

    if (download) {
        doc.save('invoice.pdf');
    } else {

        var urlString = doc.output('dataurlstring');

        $('#pdf_preview').attr({
            src: urlString
        });

    }

}
