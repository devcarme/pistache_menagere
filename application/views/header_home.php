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
    <!-- Argon CSS -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/argon.css" rel="stylesheet">
    <!-- Main CSS -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/main.css" rel="stylesheet">
    <!-- Timpepicker CSS -->
    <link type="text/css" href="<?php echo base_url(); ?>assets/css/timepicker.css" rel="stylesheet">
</head>
<header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup2" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup2">
                <div class="navbar-nav">
                    <a class="nav-item nav-link <?php if($current_bis === 'planning'){echo ' active';}?>" href='<?php echo base_url()?>index.php/controller/user_space'><i class="fas fa-tasks mr-1"></i>Planning</a>
                    <a class="nav-item nav-link <?php if($current_bis === 'members'){echo ' active';}?>" href='<?php echo base_url()?>index.php/controller/userlist'><i class="fas fa-users mr-1"></i>Membres
                    </a>
                    <a class="nav-item nav-link <?php if($current_bis === 'historic'){echo ' active';}?>" href='<?php echo base_url()?>index.php/controller/historic'><i class="fas fa-folder mr-1"></i>Historique
                    </a>
                    <?php if($admin):?>
                    <a class="nav-item nav-link <?php if($current_bis === 'blacklist'){echo ' active';}?>" href='<?php echo base_url()?>index.php/controller/blacklist'><i class="fas fa-user-times mr-1"></i>Blacklist
                    </a>
                    <?php endif;?>
                </div>
            </div>
        </nav>
</header>

</html>
