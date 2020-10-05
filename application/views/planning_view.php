<html>

<head>
    <title>PISTACHES MÉNAGÈRES</title>
    <meta charset="utf-8" />
    <!-- Favicon -->
    <link href="<?php echo base_url(); ?>assets/img/icons/jc22.png" rel="icon" type="image/png">
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">
    <!-- Icons -->
    <link href="<?php echo base_url(); ?>assets/vendor/nucleo/css/nucleo.css" rel="stylesheet">
    <link href="<?php echo base_url(); ?>assets/vendor/@fortawesome/fontawesome-free/css/all.min.css" rel="stylesheet">
    <!-- Main CSS -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
    <!-- Argon CSS -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/argon.css" rel="stylesheet">
    
    <!-- Timpepicker CSS -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker.css" rel="stylesheet">
</head>
    <body class="bg-g2">
        <div class="container-fluid p-0">
    <?php
    $data['current'] = $current;
    $this->load->view('header',$data);?>
    <div class="main-content">
    <?php 
        $data['current_bis'] = 'planning';
        $this->load->view('header_home',$data);
        if ($message !== ''){
            $data_alert['message'] = $message;
            $this->load->view('alert_view',$data_alert);    
        }
    ?>
        
            <div class="row justify-content-around m-3">
                <h1 class="text-w"><i class="fas fa-home mr-1"></i>
                    <?php echo $home['home'];?>
                </h1>
                <button type="submit" class="btn btn-primary" data-toggle="modal" data-target="#modal-mission">
                    <h2 class="text-w"><i class="fas fa-plus mr-1"></i>Ajouter une mission</h2>
                </button>
                <?php if (!$admin):?>
                <button type="submit" class="btn btn-warning" data-toggle="modal" data-target="#modal-leave">
                    <h2 class="text-w"><i class="fas fa-door-open mr-1"></i>Quitter cette maison</h2>
                </button>
                <?php endif;?>
                <?php if ($admin):?>
                <?php echo form_open('Controller/edit_home_access');?>
                <button class="btn bg-w2 row" type="submit">
                    <h2><i class="fas fa-cogs mr-1"></i>Paramètres</h2>
                </button>
                <?php echo form_close();?>
                <?php endif;?>
            </div>

            <div class="modal fade" id="modal-leave" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content bg-w2">
                        <div class="modal-header">
                            <h3 class="modal-title" id="exampleModalLabel">Quitter la maison</h3>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <?php echo form_open('Controller/leave_home');?>
                            <h4>Voulez vous quitter cette maison ?</h4>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Oui</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                            <?php echo form_close();?>
                        </div>
                    </div>
                </div>
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
                                <?php echo form_open('Controller/add_task'); ?>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-secondary"><i class="ni ni-paper-diploma"></i></span>
                                        </div>
                                        <input class="form-control pl-1" autocomplete="off" placeholder="Nom de la mission" type="text" name="name" required>
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
                                    <div class="input-group input-group-alternative mb-3">

                                        <div class="input-group-addon bg-secondary">
                                            <span class="input-group-text bg-secondary"><i class="ni ni-calendar-grid-58"></i></span>
                                        </div>
                                        <input type="date" autocomplete="off" class="form-control pl-1" placeholder="Jour" name="jour" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">

                                        <div class="input-group-prepend">
                                            <span class="input-group-text bg-secondary"><i class="ni ni-bullet-list-67"></i></span>
                                        </div>
                                        <input type="time" placeholder="Heure" name="heure" class="form-control pl-1" autocomplete="off"  required />

                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="input-group input-group-alternative mb-3">
                                        <div class="input-group-addon">
                                            <span class="input-group-text bg-secondary"><i class="fas fa-user mr-1"></i>Attribution</span>
                                        </div>
                                        <div class="col">
                                            <?php foreach($users as $login):?>
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="membres[]" class="custom-control-input" id="customCheck1<?php echo $login['login'];?>" value="<?php echo $login['login'];?>">
                                                <label class="custom-control-label" for="customCheck1<?php echo $login['login'];?>">
                                                    <h3>
                                                        <?php echo $login['login'];?>
                                                    </h3>
                                                </label>
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

            <div class="table-responsive-md">
                <table class="table">
                    <thead>
                        <?php if (sizeof($tasks)>0):?>
                        <tr class="bg-light">
                            <th scope="col">
                                <h3>Nom</h3>
                            </th>
                            <th scope="col">
                                <h3>Attribution</h3>
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
                            <?php if($admin):?>
                            <th scope="col">
                                <h3>Valider</h3>
                            </th>
                            <th scope="col">
                                <h3>Modifier</h3>
                            </th>
                            <th scope="col">
                                <h3>Supprimer</h3>
                            </th>
                            <?php endif;?>
                        </tr>
                        <?php else:?>
                        <tr class="d-flex flex-row justify-content-center bg-w"><td><h3>Aucune mission</h3></td></tr>
                        <?php endif;?>
                    </thead>
                    <tbody>
                        <div class="d-flex flex-row justify-content-between list-group-item bg-w2 border-0">
                            <div>
                                <h2>Liste de toutes les missions</h2>
                            </div>
                            <div class="d-flex flex-row justify-content-around">
                                <form action="<?php echo base_url();?>index.php/Controller/sort_task" method="post" id="sort_task">
                                    <h3 class="mr-4">Trier par : </h3>
                                    <?php foreach($sorts_name as $sort_name):?>
                                    <div class="custom-control custom-checkbox mr-3">
                                        <input class="custom-control-input" id="customCheck2<?php echo $sort_name;?>" type="checkbox" name="tri[]" onclick="submitForm('sort_task');" value="<?php echo $sort_name;?>" <?php foreach($sorts as $sort){ switch ($sort_name){ case 'Mes missions' : if($sort['my_missions']){echo 'checked' ;} break; case "Aujourd'hui" : if($sort['today']){echo 'checked' ;} break; case "Cette semaine" : if($sort['week']){echo 'checked' ;} } } ?>>
                                        <label class="custom-control-label" for="customCheck2<?php echo $sort_name;?>">
                                            <h4>
                                                <?php echo $sort_name;?>
                                            </h4>
                                        </label>
                                    </div>
                                    <?php endforeach;?>
                                </form>
                            </div>

                        </div>
                        <?php $i=0;?>
                        <?php foreach($tasks as $task): ?>
                        <tr class="bg-w">
                            <td>
                                <h3>
                                    <?php echo $task['name'];?>
                                </h3>
                            </td>
                            <td scope="col">
                                <h3>
                                    <?php foreach ($distributions as $distribution){
                        if ($distribution['task_id'] === $task['id']){
                            echo '<div>'.$distribution['user_login'].'</div>';    
                        } 
                      }
                ?>
                                </h3>
                            </td>
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
                            <?php if($admin): ?>
                            <td><button class="btn btn-success fas fa-check" type="button" data-toggle="modal" data-target="#modalValidation<?php echo $i;?>" <?php if($task['valid']){echo 'disabled' ;}?>></button></td>
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
                                        <input type="hidden" name="task_id" value="<?php echo $task['id'];?>" />
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
                                        <h3 class="modal-title" id="exampleModalLabel">Modifier la mission
                                            <?php echo $task['name'];?>
                                        </h3>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="card-body px-lg-2 py-lg-2">
                                            <?php echo form_open('Controller/edit_task/'); ?>
                                            <input type="hidden" name="task_id" value="<?php echo $task['id'];?>" />
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-secondary"><i class="ni ni-paper-diploma mr-1"></i>Nom de la mission</span>
                                                    </div>
                                                    <input class="form-control pl-1" autocomplete="off" type="text" name="name" value="<?php echo $task['name'];?>" required>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text bg-secondary"><i class="ni ni-bullet-list-67 mr-1"></i>Type</span>
                                                    </div>
                                                    <select class="form-control" name="type" id=discipline required>
                                                        <option value="<?php echo $task['type'];?>" selected hidden>
                                                            <?php echo $task['type'];?>
                                                        </option>
                                                        <option value="nettoyage">Nettoyage</option>
                                                        <option value="linge">Linge</option>
                                                        <option value="repas">Repas</option>
                                                        <option value="extérieur">Extérieur</option>
                                                        <option value="animaux">Animaux</option>
                                                    </select>
                                                </div>
                                            </div>


                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-addon bg-secondary">
                                                        <span class="input-group-text bg-secondary"><i class="ni ni-calendar-grid-58 mr-1"></i>Jour</span>
                                                    </div>
                                                    <input type="date" autocomplete="off" class="form-control pl-1" value="<?php echo $task['jour'];?>" name="jour" required>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">

                                                    <div class="input-group-addon bg-secondary">
                                                        <span class="input-group-text bg-secondary"><i class="fas fa-clock mr-1"></i>Heure</span>
                                                    </div>
                                                    <input type="time" value="<?php echo $task['heure'];?>" name="heure" class="form-control pl-1" autocomplete="off" required />
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <div class="input-group input-group-alternative mb-3">
                                                    <div class="input-group-addon">
                                                        <span class="input-group-text bg-secondary"><i class="fas fa-user mr-1"></i>Attribution</span>
                                                    </div>
                                                    <div class="col">
                                                        <?php $j = 0;foreach($users as $login):?>
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" name="attribution[]" class="custom-control-input" id="customCheck3<?php echo $j.$i;?>" value="<?php echo $login['login'];?>"
                                                            <?php foreach($distributions as $distribution):?>       
                                                                   <?php if ($distribution['task_id'] === $task['id'] && $distribution['user_login'] === $login['login'] ){echo 'checked';}?>
                                                            <?php endforeach;?>       
                                                            >
                                                            <label class="custom-control-label" for="customCheck3<?php echo $j.$i;?>">
                                                            <h3>
                                                                <?php echo $login['login'];?>
                                                            </h3>
                                                            </label>
                                                        </div>
                                                        <?php $j++;endforeach;?>
                                                    </div>
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
    <script type="text/javascript">
        function submitForm(form_id) {
            document.forms[form_id].submit();
        }

    </script>
</body>
</html>
