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
        <br>

        <div class="col col-xs-16 text-center" id="button-relative">
          <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#myModal"> Tambah Penghargaan</a>    
        </div>

        <!-- Modal -->
        <div class="modal fade" id="myModal" role="dialog">
          <div class="modal-dialog">
          
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Modal Header</h4>
              </div>
              <div class="modal-body">
                <p>Some text in the modal.</p>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </div>
            </div>
            
          </div>
        </div>

        <div class="box-body" style="overflow-y:scroll">
          <table class="table table-striped table-bordered table-hover text-center bg-danger">
            <thead>
              <tr>
                <th>No</th>
                <th>Semester</th>
                <th>Nama Kategori</th>
                <th>Penghargaan</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $no=1;
              foreach ($data as $y) { ?> 
              <tr>
								<td><?php echo $no++?></td>
                <td><?php echo $y['smt_melakukan']?></td>
                <td><?php echo $y['nama_kategori']?></td>
                <td><?php echo $y['nama_peristiwa']?></td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
      <table id="example2" class="table table-bordered bg-red text-center">
        <tr>
          <td colspan="5"><strong><center>Total Penghargaan : <?php 
          foreach($data as $val){
            echo $val['total'];
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
