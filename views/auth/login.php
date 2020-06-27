<h1 class="cover-heading">Se connecter</h1>
<p class="lead">
    <?php if (@$errors) : ?>
    <div class=" col-4 offset-4 alert bg-danger alert-danger text-light alert-dismissible fade show"
        role="alert">
        <strong>Erreur</strong> <?= $errors['error'] ?> <button type="button"
            class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <?php endif ?>
    <form method="POST" class="col-8 offset-2">
        <div class="form-group">
            <label for="login">Login</label>
            <input type="text" class="form-control" id="login" name="login"
                value="<?= $login ?? "" ?>">
        </div>
        <div class=" form-group">
            <label for="pwd">Password</label>
            <input type="password" name="password" class="form-control" id="pwd"
                value="<?= $password ?? "" ?>">
        </div>
        <button type="submit" class="btn col-12 btn-log btn-primary"
            name="connecter">Connecter</button>
    </form>
</p>
</p>