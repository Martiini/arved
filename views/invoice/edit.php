<div>

    <h1 id="inv_title">Invoice: <?= $invoice->name ?></h1>


    <br/>
    <br/>

    <table id="item_form" style="display: none">
        <tr id="item_{{id}}">
            <td>{{name}}</td>
            <td>{{sum}} €</td>
            <td><a style="cursor: pointer" onclick="removeItem('{{id}}')">Delete</a></td>
        </tr>
    </table>


    <table class="table" id="item_table">
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
            <th><?= $sum ?> €</th>
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


    <br/>
    <br/>
    <br/>

    <a class="btn btn-primary" onclick="updatePreview('<?= $invoice->id ?>', true)">Download</a>
    <a class="btn btn-default" onclick="updatePreview('<?= $invoice->id ?>')">
        Preview
    </a>

    <br/>
    <br/>
    <iframe id="pdf_preview" src="" style="width:100%; height:500px;" frameborder="0"></iframe>


</div>