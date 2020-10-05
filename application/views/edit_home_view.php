<html>
<?php if (!$admin){
    redirect('Controller/user_space');
}?>

<body class="bg-g2">
    <div class="container-fluid p-0">
        <?php 
    $data['current'] = 'home';
    $this->load->view('header',$data);?>
        <div class="main-content">
            <?php 
    $data['current_bis'] = '';
    $this->load->view('header_home',$data);?>
            <div class="container-fluid">
                <div class="row justify-content-center mt-2">
                    <div class="jumbotron col-lg-6 row d-flex justify-content-center">

                        <?php echo form_open('Controller/edit_home');?>
                        <h1 class="mb-3">Modifier la maison</h1>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary"><i class="fas fa-key mr-1"></i>Votre Mot de passe actuel</span>
                            </div>
                            <input type="password" class="form-control <?php if($error==='old_password'){echo 'is-invalid';}?>" name="old_password" required>
                            <?php if($error==='old_password'):?>
                            <div class="invalid-feedback">Mot de passe incorrect</div>
                            <?php endif;?>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary"><i class="fas fa-key mr-1"></i>Mot de passe actuel de la maison</span>
                            </div>
                            <input type="password" class="form-control <?php if($error==='old_password_home'){echo 'is-invalid';}?>" name="old_password_home" required>
                            <?php if($error==='old_password_home'):?>
                            <div class="invalid-feedback">Mot de passe incorrect</div>
                            <?php endif;?>
                        </div>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary"><i class="fas fa-key mr-1"></i>Nouveau mot de passe de maison</span>
                            </div>
                            <input type="password" class="form-control" name="password">
                        </div>
                        <div class="input-group mb-3 ">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary"><i class="fas fa-key mr-1"></i>Confirmation</span>
                            </div>
                            <input type="password" class="form-control <?php if($error==='confirmation'){echo 'is-invalid';}?>" name="confirmation">
                            <?php if($error==='confirmation'):?>
                            <div class="invalid-feedback">Mauvaise confirmation de mot de passe</div>
                            <?php endif;?>
                        </div>
                        <!--
                <div class="row mb-4 align-items-center justify-content-start">
                    <h3>Remise des points à 0</h3>
                    <div class="col">
                        <div class="custom-control custom-radio mb-1">
                            <input type="radio" class="custom-control-input" id="customCheck1" name="reset_points" value="week">
                            <label class="custom-control-label" for="customCheck1">toutes les semaines</label>
                        </div>
                        <div class="custom-control custom-radio mb-1">
                            <input type="radio" class="custom-control-input" id="customCheck2" name="reset_points" value="month">
                            <label class="custom-control-label" for="customCheck2">tous les mois</label>
                        </div>
                        <div class="custom-control custom-radio mb-1">
                            <input type="radio" class="custom-control-input" id="customCheck3" name="reset_points" value="year">
                            <label class="custom-control-label" for="customCheck3">tous les ans</label>
                        </div>
                        <div class="custom-control custom-radio mb-1">
                            <input type="radio" class="custom-control-input" id="customCheck4" name="reset_points" value="NULL">
                            <label class="custom-control-label" for="customCheck4">jamais</label>
                        </div>
                    </div>
                </div>-->
                        <div class="row col-lg-6">
                            <button type="button" class="btn btn-danger mb-3" data-toggle="modal" data-target="#modal-reset"><i class="fas fa-circle mr-1"></i>Remettre les points à 0
                            </button>
                            <button type="button" class="btn btn-danger mb-3" data-toggle="modal" data-target="#modal-delete"><i class="fas fa-trash mr-1"></i>Détruire la maison
                            </button>
                        </div>
                        <div class="row col-lg-12">
                            <button class="btn btn-success " type="submit"><i class="fas fa-save mr-1"></i>Enregistrer les modifications</button>

                            <a href="<?php echo base_url();?>index.php/Controller/user_space"><button class="btn btn-secondary" type="button">Annuler</button></a>
                        </div>
                        <?php echo form_close();?>

                        <div class="modal fade" id="modal-delete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content bg-light">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Supprimer la maison
                                            <?php echo $home;?>
                                        </h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open('Controller/delete_home');?>
                                        <input type="hidden" value="<?php echo $home;?>" name="home" />
                                        <h3>Voulez vous supprimer cette maison ? Toutes les missions concernant cette maison seront supprimées DÉFINITiVEMENT ! Aucun retour en arrière ne sera possible !</h3>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Oui</button>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Non</button>
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="modal-reset" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content bg-light">
                                    <div class="modal-header">
                                        <h3 class="modal-title" id="exampleModalLabel">Réinitialiser les points des membres de
                                            <?php echo $home;?>
                                        </h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <?php echo form_open('Controller/reset_points');?>
                                        <input type="hidden" value="<?php echo $home;?>" name="home" />
                                        <h3>Voulez vous remettre les points de TOUS les membres de la maison à 0 ? Un retour en arrière sera impossible !</h3>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Oui</button>
                                        <button type="button" class="btn btn-success" data-dismiss="modal">Non</button>
                                        <?php echo form_close();?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
</body>
<script src="<?php echo base_url()?>assets/vendor/jquery/dist/jquery.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<!-- Optional JS -->
<script src="<?php echo base_url()?>assets/vendor/chart.js/dist/Chart.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="<?php echo base_url()?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
<!-- Argon JS -->
<script src="<?php echo base_url()?>assets/js/argon.js?v=1.0.0"></script>


</html>
