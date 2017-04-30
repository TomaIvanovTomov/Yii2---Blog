<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Post */

//$this->title = 'Update Post: ' . $model->title;
//$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->title, 'url' => ['view', 'id' => $model->post_id]];
//$this->params['breadcrumbs'][] = 'Update';
?>
<div class="post-update">

    <?= $this->render('_update_form', [
        'model' => $model,
    ]) ?>

</div>
