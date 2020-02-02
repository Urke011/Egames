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

    <div class="form-group">
      <label for="first_name">Ime:</label>
      <input 
          id="first_name" type="text" class="form-control" 
          name="User[first_name]" value="<?= htmlspecialchars($user->first_name)?>"
      >
    </div>
    
    <div class="form-group">
      <label for="email">Email:</label>
      <input 
          id="email" type="text" class="form-control" 
          name="User[email]" value="<?= htmlspecialchars($user->email)?>"
      >
    </div>    

    <button type="submit" class="btn btn-primary">Registracija</button>
  
</form>