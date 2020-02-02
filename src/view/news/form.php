
<?=$this->render('partial-view/error', ['errors' => $news->errors])?>

<form method="post">
    
    <div class="form-group">
        <label for="news-title"><?=$news->getLabel('title')?></label> 
        <input 
            id="news-title"
            type="text" class="form-control" 
            name="News[title]" 
            value="<?= htmlspecialchars($news->title)?>"
            autofocus
        >
    </div>

    <div class="form-group">
        <label for="content"><?=$news->getLabel('content')?></label> 
        <textarea rows="6"
            id="content"
            type="text" class="form-control" 
            name="News[content]" 
            ><?= htmlspecialchars($news->content)?></textarea>
    </div> 
 
    <div class="form-group">
        <label for="intro"><?=$news->getLabel('intro')?></label> 
        <textarea rows="3"
            id="intro"
            type="text" class="form-control" 
            name="News[intro]" 
            ><?= htmlspecialchars($news->intro)?></textarea>
    </div> 

    <div class="form-group">
        <label for="img_url"><?=$news->getLabel('img_url')?></label> 
        <input 
            id="img_url"
            type="text" class="form-control" 
            name="News[img_url]" 
            value="<?= htmlspecialchars($news->img_url)?>"
        >
    </div> 
    
    <div class="form-group">
        <label for="category_id"><?=$news->getLabel('category_id')?></label> 
        <select id="category_id" class="form-control" name="News[category_id]">
            <?php foreach (\app\model\Category::findAll('ORDER BY name') as $category):?>
                <?php $selected = (!empty($news->category_id) && $news->category_id == $category->id) ? ' selected' : '';?>
                <option value="<?=$category->id?>"<?=$selected?>>
                    <?= htmlspecialchars($category->name) ?>
                </option>
            <?php endforeach;?>
        </select>
    </div>         
        
    <button type="submit" class="btn btn-primary">Sačuvaj</button>
  
</form>


