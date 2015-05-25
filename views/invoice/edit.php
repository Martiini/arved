<div>

    <h1 id="inv_title">Invoice: <?= $invoice->name ?>  <a class="btn btn-success" onclick="updatePreview(true)">Download as PDF</a></h1>
    <p><i>..by <?= $invoice->getUser()->one()->username ?></i></p>

    <br/>
    <br/>

    <table id="item_form" style="display: none">
        <tr id="item_{{id}}">
            <td>{{name}}</td>
            <td>{{sum}} €</td>
            <td><a style="cursor: pointer" onclick="removeItem('{{id}}')">Delete</a></td>
        </tr>
    </table>


    <table class="table" id="item_table" data-id="<?= $invoice->id ?>">
        <tr id="items_header">
            <th>Item</th>
            <th>Cost</th>
            <th></th>
        </tr>

        <? foreach ($invoice_items as $item): ?>
            <tr id="item_<?= $item->id ?>">
                <td><?= $item->name ?></td>
                <td><?= $item->sum ?> €</td>
                <td><a style="cursor: pointer" onclick="removeItem('<?= $item->id ?>')">Delete</a></td>
            </tr>
        <? endforeach; ?>

        <tr>
            <th>Total:</th>
            <th id="total_sum"><?= $sum ?> €</th>
            <th></th>
        </tr>

        <tr>
            <th id="add_item_form" data-id="<?= $invoice->id ?>">
                <input style="width: 30%" class="form-control pull-left" type="text" id="item_name" placeholder="Item name"/>
                <input style="width: 15%" class="form-control pull-left" type="number" id="item_sum" placeholder="Item cost"/>
                <button class="btn btn-primary" onclick="addItem()">Add item</button>
            </th>
            <th></th>
        </tr>

    </table>

    <h2>Preview</h2>
    <br/>
    <br/>
    <iframe id="pdf_preview" src="" style="width:100%; height:500px;" frameborder="0"></iframe>


</div>