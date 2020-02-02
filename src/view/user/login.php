
<?=$this->render('partial-view/error', ['errors' => $user->errors])?>

<form method="post">
    
    <div class="form-group">
      <label for="user-name">Korisničko ime:</label> 
      <input 
          type="text" class="form-control" name="User[user_name]" 
          value="<?= htmlspecialchars($user->user_name)?>"
          autofocus
      >
    </div>

    <div class="form-group">
      <label for="lozinka">Lozinka:</label>
      <input 
          id="lozinka" type="password" class="form-control" 
          name="User[plainPassword]" value="<?= htmlspecialchars($user->plainPassword)?>"
      >
    </div>

    <button type="submit" class="btn btn-primary">Prijava</button>
  
</form>

