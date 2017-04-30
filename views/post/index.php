<?php

use yii\helpers\Html;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

?>

<div class="post-index" style="position:relative;">
    <div class="content">
        <div class="row">
            <div class="col-md-12 search-post">
                <div class="col-md-4">
                    <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Search', [''], ['class' => 'btn btn-default search-form']) ?>
                    <?= Html::radioList('search-type', 'search-type',
                                            ['item1' => 'by title', 'item2' => 'by tag'],
                                            [
                                                    'style' => 'display: inline-block; margin-left: 10%'
                                            ]) ?>
                </div>
                <div class="col-md-8 search-input">
                    <?= Html::textInput('search-info', '',['class' => 'form-control']) ?>
                </div>
            </div>
        </div>
        <div class="row">

            <?= Html::hiddenInput('search-type-check', '') ?>

            <div class="none" style="display: none;">
                <div class="title-post text-center"><h3></h3></div>
                <div class="content-post"></div>
                <div class="foot-post">

                    <div class="text-left">
                        <?= Html::a('Go To Post','',['class' => 'btn btn-primary', 'style' => 'color: white;']) ?>
                    </div>

                    <div class="text-right">
                        <?= Html::a('Back','index', ['class' => 'btn btn-warning']) ?>
                    </div>

                </div>
            </div>

            <div class="list-view">
                    <?= Html::a('Back', 'index', ['class' => 'btn btn-warning']) ?>
            </div>

            <?php Pjax::begin(['id' => 'posts']) ?>
            <div class="col-md-12">
                <?php

                    foreach ($posts as $post)
                    {
                        $id = $post->user_id;

                        $user = $userModel::find()->where(['id' => $id])->one();

                        echo "<div class='col-md-6 blog-post'>
                                  <div class='col-md-3 post-prof-img'>"
                                        . Html::img('../images/' . $user->image, ['alt' => 'image', 'class' => 'tall img-circle']) .
                                  "<p class='text-center title-par'><strong><em>" . Html::encode($user->username ) . "</em></strong></p>
                                   <p class='text-center'>" . Html::encode($post->date_create) . "</p>
                                  </div>
                                  <div class='col-md-9 post-cont'><p>"
                                        . Html::a('Click for more!',['view', 'id' => $post->post_id]) .
                                        "</p><label class='text-center'>" . Html::encode($post->title) . " : </label>
                                        <div class='fade-post'>"
                                            . Html::encode($post->content) .
                                        "</div>
                                  </div>
                              </div>";
                    }

                ?>

            </div>
            <?php Pjax::end() ?>
        </div>

    </div>

</div>
