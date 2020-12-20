<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
<script src="<?php echo base_url(); ?>assets/dist/jsresponsiveslides.min.js"></script>

<section class="content-header">
  <h1>
    Dashboard
    <small>Sistem Informasi Pengasuhan</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active">Dashboard</li>
  </ol>
</section>

<section class="content">
      <!-- Info boxes -->
  <div class="row">
   
  </div>
  <!-- /.row -->

  <div class="row">
    <div class="col-sm-12">
      <div class="box">
          <!-- <div class="box-header with-border">
            ini box header
          </div> -->
          <div class="box-body">
            <!-- ini box body -->
          </div>
          <!-- <div class="box-footer">
          </div> -->
      </div>
      <!-- /.box -->
    </div>
    <!-- /.col -->
  </div>
      <!-- /.row -->
  <script>
    $(function() {
      $('.box').hide();

      $('.box').fadeIn(500);
    });

  </script>

  <style>
  /* Make the image fully responsive */
    .box
    {
    	background-image: url("<?php echo base_url(''); ?>assets/img/STPN2.jpg");
    	height: 720px;
    	background-size: cover;
    	background-position: center;
    	animation: ganti 10s infinite;
    }

    @keyframes ganti
    {
    	30%{
    		background-image: url("<?php echo base_url(''); ?>assets/img/STPN2.jpg");	
    	}
    	60%{
    		background-image: url("<?php echo base_url(''); ?>assets/img/STPN1.jpg");
    	}
    	90%{
    		background-image: url("<?php echo base_url(''); ?>assets/img/STPN2.jpg");
    	}
    }
  </style>
