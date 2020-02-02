
<?=$this->render('partial-view/error', ['errors' => $category->errors])?>

<form method="post">
    
    <div class="form-group">
        <label for="news-title"><?=$category->getLabel('name')?></label> 
        <input 
            id="news-title"
            type="text" class="form-control" 
            name="Category[name]" 
            value="<?= htmlspecialchars($category->name)?>"
            autofocus
        >
    </div>
        
    <button type="submit" class="btn btn-primary">Sačuvaj</button>
  
</form>


