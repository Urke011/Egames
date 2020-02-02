<div class="row">

    <div class="col-12 col-md-8">
        <div class="single-game-review-area style-2 mt-70">
            <div class="game-content">

                <?= $this->render('partial-view/news-meta', ['news' => $news]) ?>

                <article><?=$news->content?></article>

            </div>
        </div>
    </div>

    <div class="col-12 col-md-4">
        <div class="single-game-review-area style-2 mt-70">
            <?php if (app\App::get()->getUser()):?>    
                <form method="post">
                    <label for="comment"><?=$comment->getLabel('content')?></label>
                    <div id="comment" class="form-group" >
                          <textarea name="Comment[content]" class="form-control" rows="2"></textarea>          
                    </div>
                    <button type="submit" class="btn btn-primary">Slanje komentara</button>
                </form>    
            <?php endif;?>
            <?php foreach ($news->getComments() as $comment):?>

            <div class="game-comments">
                <hr>
                <em>
                    <i class="fa fa-comments"></i> <?= htmlspecialchars($comment->getAuthor()->first_name)?>
                </em>
                <?= date('d.m.Y.', strtotime($comment->pub_date))?>
                 <?php if (\app\App::get()->getUser() && \app\App::get()->getUser()->id == $comment->game_user_id): ?>
                     <a title="Brisanje" href="index.php?run=comment/delete&commentId=<?=$comment->id?>">
                         <i class="fa fa-trash"></i>
                     </a>
                 <?php endif;?>                  
                <p><?= htmlspecialchars($comment->content)?></p>                          

            </div>
            <?php endforeach;?>
        </div>
    </div>
    
</div>