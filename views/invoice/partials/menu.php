<?php

use yii\helpers\Url;

?>
<a class="btn btn-primary" href="<?= Url::to(['invoice/create']) ?>">Create</a>
<a class="btn btn-default" href="<?= Url::to(['invoice/index']) ?>">All invoices</a>
