<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>

<section class="content-header">
  <h1>
    Rekap Taruna
  </h1>
  <div class="text-center">
    <a href="<?php echo base_url("main/peristiwa/export"); ?>" class="btn btn-sm btn-danger">Export to Excel</a>
  </div>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tabel Rekap</a></li>
    <li class="active">Rekap Taruna</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body" style="overflow-y:scroll">
          <table id="example2" class="table table-bordered table-hover table-striped bg-danger text-center">
            <thead>
              <tr>
                <th>Nama Taruna</th>
                <th>Sex</th>
                <th>Prodi</th>
                <th>IPS</th>
                <th>IPK</th>
                <th class="text-center">ACTION</th>
              </tr>
            </thead>
            <tbody>
              <?php foreach ($taruna as $y) { ?> 
              <tr>
                <td><?php echo $y->nama_mhs?></td>
                <td><?php echo $y->sex?></td>
                <td><?php echo $y->prodi?></td>
                <td><?php echo "-"?></td>
                <td><?php echo "-"?></td>
                 <td style="align:center">
                  <?php echo anchor('main/peristiwa/detil_taruna/'.$y->nim,'<div class="col text-center"><button class="btn btn-sm btn-danger">Detail</button></div>');?>
                </td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   background-color: #f4f4f4;
}
</style>