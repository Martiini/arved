<?php

use yii\widgets\LinkPager;

?>
<div class="container well">
    <h1>Client list</h1>

    <br />
    <br />

    <?php if(count($clients)): ?>
        <table class="table table-responsive table-striped">
            <tr>
                <th>First name</th>
                <th>Last name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Phone</th>
                <th>Company</th>
            </tr>

            <?php foreach($clients as $client): ?>
            <tr>
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
    <div class="alert alert-info">No clients found</div>
    <?php endif; ?>
</div>