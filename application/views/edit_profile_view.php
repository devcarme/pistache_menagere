<html>

<body class="bg-g2">
    <?php 
    $data['current'] = 'user';
    $this->load->view('header',$data);?>
<div class="main-content mt-5">
    <div class="container-fluid">
        <div class="row justify-content-center mt-2">
            
            <div class="jumbotron col-lg-6 row d-flex justify-content-center text-center">
                <figure class="mb-3 left-1 ">
                        <h1>PHOTO</h1>
                </figure>
                <?php echo form_open('Controller/edit_user');?>
                    <h1 class="mb-3">Modifier votre compte</h1>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary"><i class="fas fa-user mr-1"></i>Nom</span>
                        </div>
                        <input type="text" class="form-control <?php if($error==='login'){echo 'is-invalid';}?>" value="<?php echo $user;?>" name="login" autocomplete="off">
                        <?php if($error==='login'):?>
                        <div class="invalid-feedback">Identifiant déjà utilisé</div>
                        <?php endif;?>
                    </div>
                    
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary"><i class="fas fa-key mr-1"></i>Mot de passe actuel</span>
                        </div>
                        <input type="password" class="form-control <?php if($error==='old_password'){echo 'is-invalid';}?>"  name="old_password" required>
                        <?php if($error==='old_password'):?>
                        <div class="invalid-feedback">Mot de passe incorrect</div>
                        <?php endif;?>
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary"><i class="fas fa-key mr-1"></i>Nouveau mot de passe</span>
                        </div>
                        <input type="password" class="form-control"  name="password" >
                    </div>
                    <div class="input-group mb-4 ">
                        <div class="input-group-prepend">
                            <span class="input-group-text bg-secondary"><i class="fas fa-key mr-1"></i>Confirmation</span>
                        </div>
                        <input type="password" class="form-control <?php if($error==='confirmation'){echo 'is-invalid';}?>"  name="confirmation">
                        <?php if($error==='confirmation'):?>
                        <div class="invalid-feedback">Mauvaise confirmation de mot de passe</div>
                        <?php endif;?>
                    </div>
                    <div class="row col-lg-12">
                    <button class="btn btn-success " type="submit">Enregistrer les modifications</button>
                    <a href="<?php echo base_url();?>index.php/Controller/profile"><button class="btn btn-secondary" type="button">Annuler</button></a>
                    </div>
                <?php echo form_close();?>
            </div>
        </div>
    </div>
    </div>
</body>

</html>
