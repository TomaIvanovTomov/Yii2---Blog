<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

?>
<div class="site-error">

    <h1>Not Allowed Method (#<?= $_GET['1'] ?>)</h1>

    <div class="alert alert-danger">
        <?= $_GET['2']; ?>
    </div>

</div>
