<!DOCTYPE html>
<html>
  <?php
    $this->load->view('inicio/head');
  ?>
  <body ng-app="app" ng-controller="main">
    
    <?php $this->load->view('inicio/nav'); ?>

    <div class="off-canvas-wrapper" style="height:100%" ng-init="site_url = '<?= site_url() ?>'">
      <div id="offCanvas" class="off-canvas position-left" data-off-canvas style="box-shadow: 0px 0px 5px #333;">
        
        <?php $this->load->view('inicio/menu'); ?>

      </div>
      
      <div class="off-canvas-content callout " data-off-canvas-content >


      	<?php 

      	if(isset($html)){
      		echo $html;
      	}else{
      		$this->load->view('inicio/inicio');
      	}

      	?>


      </div>
      
    </div>


    <script type="text/javascript" src="<?= base_url('assets/foundation/js/app.js') ?>"></script> 
  </body>
</html>
