<html>

<body>
    <?php 
    $data['current'] = 'home';
    $this->load->view('header',$data);?>
    <div class="container-fluid">
        <div class="mb-2 my-2">
            <button type="submit" class="btn btn-success" data-toggle="modal" data-target="#modal-mission">
                <h1><i class="ni ni-fat-add"></i>Ajouter une mission</h1>
            </button>
        </div>

        <div class="modal fade" id="modal-mission" tabindex="-1" role="dialog" aria-labelledby="modal-default" aria-hidden="true">
            <div class="modal-dialog modal- modal-dialog-centered modal-" role="document">
                <div class="modal-content">

                    <div class="modal-header">
                        <h3 class="modal-title" id="modal-title-default">Ajouter une mission</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">×</span>
                        </button>
                    </div>

                    <div class="modal-body">
                        <div class="card-body px-lg-2 py-lg-2">
                            <?php echo form_open('controller/add_task/'.$user); ?>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-secondary"><i class="ni ni-paper-diploma"></i></span>
                                    </div>
                                    <input class="form-control" autocomplete="off" placeholder="Nom de la mission" type="text" name="name" required>
                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text bg-secondary"><i class="ni ni-bullet-list-67"></i></span>
                                    </div>
                                    <select class="form-control" name="type" id=discipline required>
                                        <option value="" disabled selected hidden>Type</option>
                                        <option value="nettoyage">Nettoyage</option>
                                        <option value="linge">Linge</option>
                                        <option value="repas">Repas</option>
                                        <option value="extérieur">Extérieur</option>
                                        <option value="animaux">Animaux</option>
                                    </select>

                                </div>
                            </div>


                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3 date" data-provide="datepicker">

                                    <div class="input-group-addon bg-secondary">
                                        <span class="input-group-text bg-secondary"><i class="ni ni-calendar-grid-58"></i></span>
                                    </div>
                                    <input type="text" autocomplete="off" class="form-control" placeholder="Jour" name="jour" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">

                                    <div class="input-group-addon bg-secondary">
                                        <span class="input-group-text bg-secondary"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <input type="text" placeholder="Heure" name="heure" class="form-control" autocomplete="off" id="add_task" required />

                                </div>
                            </div>
                            
                            <div class="form-group">
                                <div class="input-group input-group-alternative mb-3">
                                    <div class="input-group-addon bg-secondary">
                                        <span class="input-group-text bg-secondary"><i class="fas fa-user"></i>&nbsp;Membre</span>
                                    </div>
                                    <div class="col">
                                        <?php foreach($users as $login):?>
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" name="membres[]" class="custom-control-input" id="customCheck1<?php echo $login['login'];?>" value="<?php echo $login['login'];?>">
                                            <label class="custom-control-label" for="customCheck1<?php echo $login['login'];?>"><h3><?php echo $login['login'];?></h3></label>
                                        </div>
                                        <?php endforeach;?>
                                    </div>
                                </div>
                            </div>
                            
                            
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-primary">Ajouter une mission</button>
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                            </div>


                            <?php echo form_close(); ?>

                        </div>
                    </div>
                </div>
            </div>

        </div>





        <div class="table-responsive">
            <table class="table table-striped table-flush">
                <thead>
                    <tr class="table-primary">
                        <th scope="col">
                            <h3>Nom</h3>
                        </th>
                        <th scope="col">
                            <h3>Membre</h3>
                        </th>
                        <th scope="col">
                            <h3>Type</h3>
                        </th>
                        <th scope="col">
                            <h3>Jour</h3>
                        </th>
                        <th scope="col">
                            <h3>Heure</h3>
                        </th>
                        <?php if($admin){
                            echo '<th scope="col"><h3>Valider</h3></th>';
                            echo '<th scope="col"><h3>Modifier</h3></th>';
                            echo '<th scope="col"><h3>Supprimer</h3></th>';
                        }
                        ?>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                if (!$admin_account){
                    echo '<li class="list-group-item"><h3>Les missions de '.$user.'</h3></li>';
                } else{
                    echo '<li class="list-group-item"><h3>Mes missions</h3></li>';
                }
                
            $i = 0;
            foreach($usertask as $task): ?>
                    <tr>
                        <td>
                            <h3>
                                <?php echo $task['name'];?>
                            </h3>
                        </td>
                        <td scope="col"><h3>
                        <?php foreach ($distributions as $distribution){
                                if ($distribution['task_id'] === $task['id']){
                                    echo '<div>'.$distribution['user_login'].'</div>';    
                                } 
                            }
                        ?></h3></td>
                        <td>
                            <h3>
                                <?php echo $task['type'];?>
                            </h3>
                        </td>
                        <td>
                            <h3>
                                <?php echo $task['jour'];?>
                            </h3>
                        </td>
                        <td>
                            <h3>
                                <?php echo $task['heure'];?>
                            </h3>
                        </td>
                        <?php if ($admin):?>
                        <td><button class="btn btn-success" type="button" data-toggle="modal" data-target="#modalValidation<?php echo $i;?>"><i class="fas fa-check"></i></button></td>
                        <td><button type="button" class="btn btn-warning fas fa-wrench" data-toggle="modal" data-target="#modalModif<?php echo $i;?>"></button></td>
                        <td><button type="button" class="btn btn-danger fa fa-trash" data-toggle="modal" data-target="#modalSupp<?php echo $i;?>"></button></td>
                            <?php endif;?>
                    </tr>
                    
                    <div class="modal fade" id="modalValidation<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Valider une mission</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                <?php echo form_open('Controller/confirm_task');?>
                                <input type="hidden" name="task_id" value="<?php echo $task['id'];?>"/>
                                    <h4>Entrez les points à attribuer aux membres de la mission puis valider la misison</h4>
                                    <div class="input-group mb-3">
                                        <input type="number" name="points" class="form-control" placeholder="Points attribués" aria-label="Points attribués" aria-describedby="button-addon2" required automcomplete="off">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Valider la mission</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                </div>
                                <?php echo form_close();?>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="modalSupp<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Supprimer une misison</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php echo form_open('Controller/delete_task');?>
                                    <input type="hidden" value="<?php echo $task['id'];?>" name="task_id" />
                                    <p>Voulez vous supprimer cette mission ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Oui</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="modal fade" id="modalModif<?php echo $i;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Modifier la mission numéro
                                        <?php echo $task['id'];?>
                                    </h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body px-lg-2 py-lg-2">
                                        <?php echo form_open('Controller/edit_task/'.$user); ?>
                                        <input type="hidden" name="task_id" value="<?php echo $task['id'];?>"/>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-secondary"><i class="ni ni-paper-diploma"></i>&nbsp;Nom de la mission</span>
                                                </div>
                                                <input class="form-control" autocomplete="off" type="text" name="name" value="<?php echo $task['name'];?>" required>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">
                                                <div class="input-group-prepend">
                                                    <span class="input-group-text bg-secondary"><i class="ni ni-bullet-list-67"></i>&nbsp;Type</span>
                                                </div>
                                                <select class="form-control" name="type" id=discipline required>
                                                    <option value="<?php echo $task['type'];?>" disabled selected hidden><?php echo $task['type'];?></option>
                                                    <option value="nettoyage">Nettoyage</option>
                                                    <option value="linge">Linge</option>
                                                    <option value="repas">Repas</option>
                                                    <option value="extérieur">Extérieur</option>
                                                    <option value="animaux">Animaux</option>
                                                </select>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3 date" data-provide="datepicker">
                                                <div class="input-group-addon bg-secondary">
                                                    <span class="input-group-text bg-secondary"><i class="ni ni-calendar-grid-58"></i>&nbsp;Jour</span>
                                                </div>
                                                <input type="text" autocomplete="off" class="form-control" value="<?php echo $task['jour'];?>" name="jour" required>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <div class="input-group input-group-alternative mb-3">

                                                <div class="input-group-addon bg-secondary">
                                                    <span class="input-group-text bg-secondary"><i class="fas fa-clock"></i>&nbsp;Heure</span>
                                                </div>
                                                <input type="text" value="<?php echo $task['heure'];?>" name="heure" class="form-control" autocomplete="off" id="edit_task" required />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Modifier la mission</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Annuler</button>
                                </div>
                                <?php echo form_close(); ?>
                            </div>
                        </div>
                    </div>
                    <?php $i++;?>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>

    </div>
    <script src="<?php echo base_url()?>assets/vendor/jquery/dist/jquery.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Optional JS -->
    <script src="<?php echo base_url()?>assets/vendor/chart.js/dist/Chart.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
    <script src="<?php echo base_url()?>assets/vendor/chart.js/dist/Chart.extension.js"></script>
    <!-- Argon JS -->
    <script src="<?php echo base_url()?>assets/js/argon.js?v=1.0.0"></script>
    <script src="<?php echo base_url()?>assets/js/timepicker.js"></script>
    <script>
        $('#add_task').timepicker();
        $('#edit_task').timepicker();
    </script>
</body>


</html>
