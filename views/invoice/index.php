<?

use yii\widgets\LinkPager;

$url = new \yii\helpers\Url();

?>
<div class="container well">
    <h1>Invoices</h1>
    <br/>
    <? if ($invoices): ?>
        <table class="table table-responsive table-striped">
            <tr>
                <td>#</td>
                <td>Name</td>
                <td>Client</td>
                <td></td>
            </tr>
            <? foreach ($invoices as $invoice): ?>
                <tr>
                    <td><?= $invoice->id ?></td>
                    <td><?= $invoice->name ?></td>
                    <td><?= $invoice->getClient()->one()->first_name ?> <?= $invoice->getClient()->one()->last_name ?></td>
                    <td><a href="<?= $url->to('invoice/edit?id=' . $invoice->id) ?>">Edit</a> | <a href="<?= $url->to('invoice/remove?id=' . $invoice->id) ?>">Delete</a></td>
                </tr>
            <? endforeach; ?>
        </table>

        <br />

        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    <? else: ?>
        <div class="alert alert-info">No invoices <br /> <br />
            <a class="btn btn-primary" href="<?= $url->to('invoice/create') ?>">Create invoice</a> </div>
    <? endif ?>
</div>