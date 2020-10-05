<html>
<body class="bg-g2">
<?php 
    $data['current'] = $current;
    $this->load->view('header',$data);?>
<div class="main-content">
    <?php 
    $data['current'] = $current;
    $this->load->view('header_home',$data);
    if ($message !== ''){
           $this->load->view('alert_view'); 
    };?>
        <div class="table-responsive">
            <table class="table table-striped table-flush">
                <thead>
                <?php if (sizeof($blacklist)>0):?>
                <tr class="table-primary">
                    <th scope="col"><h3>Nom</h3></th>
                    <th scope="col"><h3>Débannir</h3></th>
                </tr>
                <?php else:?>
                    <tr class="d-flex flex-row justify-content-center bg-w"><td><h3>Aucun membre n'est banni</h3></td></tr>    
                <?php endif;?>
                </thead>
                <tbody>
                <li class="list-group-item bg-w2 border-0"><h2>Blacklist</h2></li>
            <?php
        $position = 1;
        foreach($blacklist as $blacklisted): ?>
            <tr class="bg-w">
            <td><h3><?php echo $blacklisted['login'];?></h3></td>
            <td>
                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modalDeban<?php echo $position;?>">Débannir</button>
            </td>
            </tr>
                    
            <div class="modal fade" id="modalDeban<?php echo $position;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Débannir un membre</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php echo form_open('Controller/deban_user');?>
                                    <input type="hidden" value="<?php echo $blacklisted['login'];?>" name="user_login"/>
                                    <p>Voulez vous débannir <?php echo $blacklisted['login'];?> ?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary">Oui</button>
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Non</button>
                                    <?php echo form_close();?>
                                </div>
                            </div>
                        </div>
            </div> 
            <?php $position++; endforeach;?>
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

</body>
</html>
