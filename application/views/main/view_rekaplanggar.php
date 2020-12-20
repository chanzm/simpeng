<section class="content-header">
  <h1>
    Rekap Pelanggaran
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tabel Rekap</a></li>
    <li class="active">Rekap Pelanggaran</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body" style="overflow-y:scroll">
          <table id="example2" class="table table-bordered table-hover bg-danger table-striped text-center">
            <thead>
                <tr>
                  <th>No</th>
                  <th>Semester</th>
                  <th>Nama Kategori</th>
                  <th>Pelanggaran</th>
                  <th>Jumlah</th>
               </tr>
            </thead>
            <tbody>
              <?php 
              $no=1;
              foreach ($data as $y) { ?> 
              <tr>
                <td><?php echo $no++?></td>
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
          <td colspan="5"><strong><center>Total Pelanggaran : <?php 
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