<?php

//use Yii;
use yii\helpers\Html;
use app\models\Comment;

/* @var $this yii\web\View */

$this->title = 'Новости';
$model = new Comment();
?>
<div id="templatemo_main_wrapper">
<div id="templatemo_content_wrapper">

    <h1><?= Html::encode($this->title) ?></h1>

    <div id="templatemo_content">

        <?php foreach ($post as $item): ?>
            
            <div class="post_section"><span class="bottom"></span>
            
                <h2><?php echo $item['title']; ?></h2>
                <div class="lay_left">
                    <div class="info"><strong>Date:</strong> <?php echo $item['date']; ?> | <strong>Author:</strong> <?php echo $item['author']; ?></div>
                    <div class="img"><img src="<?php echo $item['img']; ?>" alt="<?php echo $item['img']; ?>" /></div>
                </div>
                <div class="lay_right">
                    <div class="text"><?php echo $item['text']; ?></div>
                </div>
                <div class="cleaner"></div>
                <!-- <span class="comment"><a href="blog_post.html">65</a></span> --> 
                <?php if (!Yii::$app->user->isGuest && !empty($item['iscomment'])) { ?>   
                    <a href="/comment/create?post_id=<?php echo $item['id']; ?>" class="btn btn-warning">Оставить комментарий</a>
                <?php } ?>
            </div>

            <?php $comment = $model->getByPost($item['id']); ?>

            <div class="comment">
            <?php foreach ($comment as $item2): ?>
                <div class="li">
                    <div class="wrap">
                        <div class="text"><?php echo $item2['text']; ?></div>
                        <div class="info"><strong>Date:</strong> <?php echo $item2['date']; ?> | <strong>Author:</strong> <?php echo $item2['author']; ?></div>
                    </div>
                    <?php if (Yii::$app->user->id == $item['author_id'] || Yii::$app->user->id == $item2['author_id']) { ?>
                    <div class="buttons">
                        <a href="/comment/update?id=<?php echo $item2['id']; ?>" class="btn btn-primary">Редактировать</a>
                        <a href="/comment/delete?id=<?php echo $item2['id']; ?>" class="btn btn-danger" data-confirm="Вы хотете удалить комментарий?">Удалить</a>
                    </div>
                    <?php } ?>
                    <div class="cleaner"></div>
                </div>
            <?php endforeach ?>                
            </div>

            <div class="cleaner_h40"><!-- a spacing between 2 posts --></div>

        <?php endforeach ?>
    
    </div>
    
    <div class="cleaner"></div>
</div> <!-- end of content wrapper -->
</div>