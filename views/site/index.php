<?php

use app\models\Post;
use yii\helpers\Url;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\grid\ActionColumn;

/** @var yii\web\View $this */

$this->title = 'Все посты';
?>
<h1><?= Html::encode($this->title) ?></h1>
<div class="site-index d-flex justify-content-around">

    <?php foreach($posts as $post) { ?>

    <div class="row">
        <div class="col-lg-6 application">
            <h2> <?= $post->title ?></h2>
                <img  class="img-fluid" src="<?php echo Yii::$app->request->BaseUrl.'/uploads/' . $post->image ?>" alt="postImg<?=$post->id?>">
                <p><?=$post->content?></p>
        </div>
    </div>
    <? } ?>
</div>
