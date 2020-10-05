<html>

<body class="bg-g2">
    <?php 
    $data['current'] = $current;
    $this->load->view('header',$data);?>
    
    <div class="main-content">
       
         <?php
        $data['current_bis'] = 'members';
        $this->load->view('header_home',$data);
        if ($message !== ''){
           $this->load->view('alert_view'); 
        } ?>
        <div class="table-responsive">
            <table class="table table-striped table-flush">
                <thead>
                <tr class="bg-light">
                    <th scope="col"><h3>Classement</h3></th>
                    <th scope="col"><h3>Nom</h3></th>
                    <th scope="col"><h3>Points</h3></th>
                    <th scope="col">
                    <?php if($admin){
                        echo '<h3>Bannir</h3>';
                    }?>       
                    </th>
                </tr>
                </thead>
                <tbody>
                <li class="list-group-item bg-w2 border-0"><h2>Liste des membres</h2></li>
            <?php
        $position = 1;
        foreach($userlist as $user): ?>
            <tr class="bg-w">
            <?php switch($position){
                case 1 : echo '<td><h1 id="first"><span class="fas fa-crown" ></span> 1er</h1></td>';
                    break;
                case 2 : echo '<td><h1 id="second"><span></span> 2è</h1></td>';
                    break;
                case 3 : echo '<td><h1 id="third"><span></span> 3è</h1></td>';
                    break;
                default:case 1 : echo '<td><h2>'.$position.'è</h2></td>';
                    break;
            }?>
            <td><h3 style="<?php if ($user['login'] === $admin_home){ echo 'color:red';}?>"><?php echo $user['login'];?></h3></td>
            <td><h3><?php echo $user['points'];?></h3></td>
            <td>
            <?php if($admin && $user['login'] !== $admin_home): ?>
                
                <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#modalBan<?php echo $position;?>">Bannir</button>
                
            <?php endif;?>
            </td>
            </tr>
                    
            <div class="modal fade" id="modalBan<?php echo $position;?>" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h3 class="modal-title" id="exampleModalLabel">Bannir un membre</h3>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <?php echo form_open('Controller/ban_user');?>
                                    <input type="hidden" value="<?php echo $user['login'];?>" name="user_login"/>
                                    <p>Voulez vous bannir <?php echo $user['login'];?> ?</p>
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
