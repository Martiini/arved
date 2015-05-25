<?php

use yii\widgets\LinkPager;

$url = new \yii\helpers\Url();

?>
<style type="text/css">
    .highlight-row:hover {
        background: #e0e0e0;
        cursor: pointer;
    }
</style>
<div class="container well">
    <h1>Client list <a href="<?= $url->to('/client/create') ?>" class="btn btn-primary">Create client</a></h1>

    <br />
    <br />

    <?php if($clients): ?>
        <table class="table table-responsive">
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Company</th>
            </tr>

            <?php foreach($clients as $client): ?>
            <tr class="highlight-row" onclick="window.location.href='<?= $url->to('/invoice/index?client_id=' . $client->id) ?>'">
                <td><?= $client->first_name ?></td>
                <td><?= $client->last_name ?></td>
                <td><?= $client->email ?></td>
                <td><?= $client->address ?></td>
                <td><?= $client->phone ?></td>
                <td><?= $client->company ?></td>
            </tr>
            <?php endforeach; ?>
        </table>

        <?= LinkPager::widget(['pagination' => $pagination]) ?>
    <?php else: ?>
    <div class="alert alert-info">No clients found <br /> <br />
        <a href="<?= $url->to('/client/create') ?>" class="btn btn-primary">Create client</a>
    </div>
    <?php endif; ?>
</div>