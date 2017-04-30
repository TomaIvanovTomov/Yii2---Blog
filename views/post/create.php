<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Post */

//$this->title = 'Create Post';
//$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="post-create">

    <?= $this->render('_form', [
        'model' => $model,
        'ddItems' => $ddItems
    ]) ?>

</div>
