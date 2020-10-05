<html>

<body class="bg-g2">
    <?php 
    $data['current'] = 'user';
    $this->load->view('header',$data);?>
    <div class="main-content mt-5">
        <div class="container-fluid">
            <div class="row justify-content-center mt-2">
                <div class="jumbotron col-lg-6">
                    <div class="row d-flex justify-content-around">
                        <figure class="mb-3">
                            <h1>PHOTO</h1>
                        </figure>
                        <?php echo form_open('Controller/edit_profile');?>
                        <button class="fas fa-user-cog border-0 btn bg-white" type="submit"></button>
                        <?php echo form_close();?>
                    </div>
                    <div class="row d-flex justify-content-center text-center">
                        <h1 class="mb-3">Profil</h1>
                    </div>
                    <div class="row d-flex justify-content-center text-center">
                        <div class="input-group mb-3 col-lg-5">
                            <div class="input-group-prepend">
                                <span class="input-group-text bg-secondary"><i class="fas fa-user mr-1"></i>Nom</span>
                            </div>
                            <input type="text" class="form-control bg-white" value="<?php echo $user;?>" disabled>
                        </div>
                    </div>
                    <div class="row d-flex justify-content-center text-center">
                        <h1 class="mb-3">Maisons</h1>
                    </div>
                    <?php foreach($home as $elem):?>
                    <div class="row justify-content-center col-lg-12">
                        <?php echo form_open('Controller/select_home');?>
                        <input hidden name="home" value="<?php echo $elem['home'];?>">
                        <button class="btn btn-secondary" type="submit">
                            <div class="row justify-content-between align-items-center pl-2 pr-2">
                                <i class="fas fa-home" style="font-size:2em;color:blue"></i>
                                <h1 class="mr-5">
                                    <?php echo $elem['home'];?>
                                </h1>
                                <h3>Administrateur :
                                    <?php echo $elem['admin'];?>
                                </h3>
                            </div>
                        </button>
                        <?php echo form_close();?>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
