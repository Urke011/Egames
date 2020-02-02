<?php $app=\app\App::get();?>

<?php foreach ($newsList as $news):?>

    <div class="single-game-review-area d-flex flex-wrap mb-30">
        <div class="game-thumbnail">
            <img src="<?=$news->img_url?>" alt="">
        </div>
        <div class="game-content">
            
            <?= $this->render('partial-view/news-meta', ['news' => $news]) ?>
        
            <section><?=$news->intro?></section>
            
            <div class="download-rating-area d-flex align-items-center justify-content-between">
                <div class="download-area">
                    <a href="#"><img src="img/core-img/app-store.png" alt=""></a>
                    <a href="#"><img src="img/core-img/google-play.png" alt=""></a>
                </div>
            </div>
        </div>
    </div>
<?php endforeach;?>