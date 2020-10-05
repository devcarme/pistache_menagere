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
</head>
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-lg-3 col-md-5 bg-g2 border-radius-0 p-0">
            <a href="#">
                <div class="alert bg-w2 alert-dismissible fade show text-center border-radius-0" role="alert" id="alert" onclick="dismiss('alert');">
                    <h4>
                        <?php echo $message;?>
                    </h4>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true" class="text-g">&times;</span>
                    </button>
                </div>
            </a>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script>
    function dismiss(id) {
        elem = document.getElementById(id);
        elem.setAttribute('hidden', true);
    }

</script>
