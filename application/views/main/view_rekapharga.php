<section class="content-header">
  <h1>
    Rekap Penghargaan 
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tabel Rekap</a></li>
    <li class="active">Rekap Penghargaan</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body" style="overflow-y:scroll">
          <table class="table table-striped table-bordered table-hover text-center bg-danger">
            <thead>
              <tr>
                <th>No</th>
                <th>Semester</th>
                <th>Nama Kategori</th>
                <th>Penghargaan</th>
                <th>Jumlah</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=1;
              foreach ($data as $y) { ?> 
              <tr>
                <td><?php echo $no++ ?></td>
                <td><?php echo $y->smt_melakukan?></td>
                <td><?php echo $y->nama_kategori?></td>
                <td><?php echo $y->nama_peristiwa?></td>
                <td><?php echo $y->terserah?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
      <table id="example2" class="table table-bordered bg-red text-center">
        <tr>
          <td colspan="5"><strong><center>Total Penghargaan : <?php 
          foreach($total as $val){
            echo $val->lala;
          }?></center></strong></td>
        </tr>
      </table>
    </div>
  </div>
</section>

<style>
.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   background-color: #f4f4f4;
}
</style>