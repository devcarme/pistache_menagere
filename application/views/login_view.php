<html>
<div class="container-fluid">
<body class="bg-g">
    <div class="row justify-content-center">
    <div class="col-lg-3 col-md-5 bg-g2 border-radius-0 pb-4">
        <h2 class="mt-3 text-w2">Connectez vous à votre compte</h2>
        <?php echo form_open('Controller/login');?>
        <input type="text" name="login" class="mt-3 form-control border-0 <?php if($error==='login'){echo 'is-invalid';}?> " placeholder="Identifiant" autocomplete="off">
        <?php if($error==='login'):?>
        <div class="invalid-feedback">
            Identifiant incorrect
        </div>
        <?php endif;?>
        <input type="password" name="password" class="mt-3 form-control  border-0 <?php if($error==='password'){echo 'is-invalid';}?>" placeholder="Mot de passe" autocomplete="off">
        <?php if($error==='password'):?>
        <div class="invalid-feedback">
            Mot de passe incorrect
        </div>
        <?php endif;?>
        <button type="submit" class="btn btn-success mt-3">Se connecter</button>
        <?php echo form_close();?>

        <nav>
            <h3 class="text-w2">Vous n'avez pas encore de compte ?</h3><a href="<?php echo base_url('index.php/Controller/load_register'); ?>"><button type="button" class="btn btn-primary">Créer un compte ici</button></a>
        </nav>
    </div>
        </div>
</body>
    </div>
</html>
