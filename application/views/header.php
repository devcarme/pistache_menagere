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
<nav class="bg-dark navbar navbar-vertical fixed-left navbar-expand-md navbar-dark " id="sidenav-main">
    <div class="container-fluid">
        <!-- Toggler -->
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <!-- Brand -->
        <a class="navbar-brand pt-0" href="<?php echo base_url()?>index.php/Controller/home">
            <h1 class="text-light">PISTACHES</h1>
            <h1 class="text-light">MENAGERES</h1>
        </a>
        <hr class="m-0 p-0" style="border-color:white">
        <!-- User -->
        <ul class="nav align-items-center d-md-none">
            <li class="nav-item dropdown">
                <a class="nav-link nav-link-icon" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ni ni-bell-55"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right" aria-labelledby="navbar-default_dropdown_1">
                    <a class="dropdown-item" href="#">Notification n°1</a>
                    <a class="dropdown-item" href="#">Notification n°2</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Notification n°3</a>
                </div>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <div class="media align-items-center">
                        <span class="avatar avatar-sm rounded-circle">
                            <img alt="Image placeholder" src="../../assets/img/theme/team-4-800x800.jpg">
                        </span>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-arrow dropdown-menu-right">
                    <div class=" dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Bienvenu !</h6>
                    </div>
                    <a href="" class="dropdown-item">
                        <i class="ni ni-single-02"></i>
                        <span>Mon profil</span>
                    </a>
                    <a href="" class="dropdown-item">
                        <i class="ni ni-settings-gear-65"></i>
                        <span>Réglages</span>
                    </a>
                    <div class="dropdown-divider"></div>
                    <a href="#!" class="dropdown-item">
                        <i class="ni ni-button-power"></i>
                        <span>Déconnexion</span>
                    </a>
                </div>
            </li>
        </ul>
        <!-- Collapse -->
        <div class="collapse navbar-collapse" id="sidenav-collapse-main">
            <!-- Collapse header -->
            <div class="navbar-collapse-header d-md-none">
                <div class="row">
                    <div class="col-6 collapse-brand">
                        <a href="">
                            <img src="../../assets/img/icons/jc22.png">
                        </a>
                    </div>
                    <div class="col-6 collapse-close">
                        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#sidenav-collapse-main" aria-controls="sidenav-main" aria-expanded="false" aria-label="Toggle sidenav">
                            <span></span>
                            <span></span>
                        </button>
                    </div>
                </div>
            </div>
            <!-- Form -->
            <form class="mt-4 mb-3 d-md-none">
                <div class="input-group input-group-rounded input-group-merge">
                    <input type="search" class="form-control form-control-rounded form-control-prepended" placeholder="Search" aria-label="Search">
                    <div class="input-group-prepend">
                        <div class="input-group-text">
                            <span class="fa fa-search"></span>
                        </div>
                    </div>
                </div>
            </form>
            <!-- Navigation -->
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link <?php if($current === 'home'){echo ' active';}?>" href='<?php echo base_url()?>index.php/Controller/home'><i class="fas fa-home"></i>Accueil</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link <?php if($current === 'user'){echo ' active';}?>" href='<?php echo base_url()?>index.php/Controller/profile'><i class="fas fa-user"></i>Mon profil
                    </a>
                </li>
                
                <?php foreach($user_home as $home):?>
                <li class="nav-item">
                    <a class="nav-link <?php if($current === $home['home']){echo ' active';}?>" href="<?php echo base_url().'index.php/Controller/select_home/'.$home['home']?>"><i class="fa fa-door-open"></i>Maison
                        <?php echo $home['home'];?></a>
                </li>
                <?php endforeach;?>
                <hr class="m-4 p-0" style="border-color:white">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url().'index.php/Controller/logout'?>"><i class="fa fa-power-off"></i>Se déconnecter</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

</html>
