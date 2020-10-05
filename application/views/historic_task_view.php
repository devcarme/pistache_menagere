<html>

<body class="bg-g2">
    <?php 
    $data['current'] = $current;;
    $this->load->view('header',$data);?>
    
    <div class="main-content">
        <?php 
        $data['current'] = 'historic';
        $this->load->view('header_home',$data);?>
        <div class="table-responsive tableau">
        <table class="table table-striped table-flush">
        <thead>
            <?php if(sizeof($tasks)>0):?>
                    <tr class="bg-light">
                        <th scope="col"><h3>Nom</h3></th>
                        <th scope="col"><h3>Attribution</h3></th>
                        <th scope="col"><h3>Type</h3></th>
                        <th scope="col"><h3>Jour</h3></th>
                        <th scope="col"><h3>Heure</h3></th>
                        <th scope="col"><h3>Points</h3></th>
                    </tr>
            <?php else:?>
                    <tr class="d-flex flex-row justify-content-center bg-w">
                        <td><h3>Aucune missions effectuées pour le moment</h3></td>
                    </tr>
            <?php endif;?>
                </thead>
        <tbody>
        <div class="d-flex flex-row justify-content-between list-group-item bg-w2 border-0">
            <div>
                <h2>Historique des missions effectuées</h2>
            </div>
        </div>
        <?php $i=0;?>
        <?php foreach($tasks as $task): ?>
            <tr class="bg-w">
            <td><h3><?php echo $task['name'];?></h3></td>
            <td scope="col"><h3>
                <?php foreach ($distributions as $distribution){
                        if ($distribution['task_id'] === $task['id']){
                            echo '<div>'.$distribution['user_login'].'</div>';    
                        } 
                      }
                ?></h3></td>
            <td><h3><?php echo $task['type'];?></h3></td>
            <td><h3><?php echo $task['jour'];?></h3></td>
            <td><h3><?php echo $task['heure'];?></h3></td>
            <td><h3><?php echo $task['points'];?></h3></td>
            </tr>
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
</body>

</html>
