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
    <?php 
    $data['current'] = $current;
    $this->load->view('header',$data);?>
    <div class="main-content mt-5">
        <div class="container-fluid">
            <div class="row justify-content-around">
                <div class="jumbotron  text-center pt-1 pb-1 pl-4 pr-4">
                    <?php echo form_open('Controller/add_home');?>
                    <h2>Créer une maison</h2>
                    <div class="row">
                        <div>
                            <input class="form-control mb-2" placeholder="Nom" name="nom" type="text" autocomplete="off" required>
                            <input class="form-control mb-2" placeholder="Mot de passe de maison" name="password" type="password" autocomplete="off" required>
                        </div>
                        <button class="fas fa-plus btn bg-transparent ml-1" style="font-size:4em; color:limegreen;" type="submit"></button>
                    </div>
                    <?php echo form_close();?>
                </div>
                <div class="jumbotron text-center pt-1 pb-1 pl-4 pr-4">
                    <h2>Rejoindre une maison</h2>
                    <?php echo form_open('Controller/join_home');?>
                    <div class="row">
                        <div>
                            <input class="form-control mb-2" placeholder="Nom" name="nom" type="text" autocomplete="off" required>
                            <input class="form-control mb-2" placeholder="Mot de passe de maison" name="password" type="password" autocomplete="off" required>
                        </div>
                        <button class="fas fa-arrow-circle-right btn bg-transparent ml-1" style="font-size:4em; color:blue;" type="submit"></button>
                    </div>
                    <?php echo form_close();?>
                </div>
            </div>
            <div class="row justify-content-around">
                <?php foreach($user_home as $home):?>
                <?php echo form_open('Controller/select_home');?>
                <input hidden name="home" value="<?php echo $home['home'];?>">
                <button class="jumbotron text-center btn btn-secondary p-3" type="submit">
                    <i class="fas fa-home" style="font-size:5em;color:blue"></i>
                    <h1>
                        <?php echo $home['home'];?>
                    </h1>
                    <h2>Administrateur :
                        <?php echo $home['admin'];?>
                    </h2>
                </button>
                <?php echo form_close();?>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</body>

</html>
