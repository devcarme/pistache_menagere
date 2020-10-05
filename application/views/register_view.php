<html>
<div class="container-fluid">
<body class="bg-g">
    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-5 bg-g2 border-radius-0 pb-4">
            <h2 class="mt-3 text-w2">Créez votre compte</h2>
            <?php echo form_open('Controller/register');?>
            <input type="text" name="login" class="mt-3 form-control border-0 <?php if($error==='login'){echo 'is-invalid';}?>" placeholder="Identifiant" required autocomplete="off">
            <?php if($error==='login'):?>
            <div class="invalid-feedback">
                Identifiant déjà utilisé
            </div>
            <?php endif;?>
            <input type="password" name="password" class="mt-3 form-control border-0" placeholder="Mot de passe" required autocomplete="off">
            <input type="password" name="confirmation" class="mt-3 form-control border-0 <?php if($error==='password'){echo 'is-invalid';}?>" placeholder="Confirmation du mot de passe" required autocomplete="off">
            <?php if($error==='password'):?>
            <div class="invalid-feedback">
                Confirmation du mot de passe incorrecte
            </div>
            <?php endif;?>
            <button type="submit" class="btn btn-success mt-3">S'inscrire</button>
            <?php echo form_close();?>
            <nav>
                <h3 class="text-w2">Votre compte est déjà créé ?</h3><a href="<?php echo base_url().'index.php/Controller/index'?>"><button type="button" class="btn btn-primary">Se connecter</button></a>
            </nav>
        </div>
    </div>
</body>
</div>
</html>
