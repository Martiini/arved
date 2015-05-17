<div>

    <h1 id="inv_title"><?= $invoice->name ?></h1>


    <br />
    <br />
    <br />

    <div>
    <p>Clients name: <span id="inv_client"><?= $client->first_name ?> <?= $client->last_name ?></span></p>
    </div>



    <br />
    <br />
    <br />

    <a class="btn btn-primary" onclick="updatePreview(true)">Download</a>
    <a class="btn btn-default" onclick="updatePreview()">
        Preview
    </a>

    <br/>
    <br/>
    <iframe id="pdf_preview" src="" style="width:100%; height:500px;" frameborder="0"></iframe>


</div>