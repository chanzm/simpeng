<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<section class="content-header">
  <h1>
    Entry Nilai Individu
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url("main/dashboard"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Entry Nilai</a></li>
    <li class="active">Individu</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">  
        <div class="box-body" style="overflow-y:scroll">
          <table id="example2" class="table table-striped table-bordered bg-danger table-hover text-center">
            <thead>
              <tr>
                <th>NIM</th>
                <th>Nama Taruna</th>
                <th>Sex</th>
                <th>Prodi</th>
                <th>Tahun</th>
                <th>Action</th>
               </tr>
            </thead>
            <tbody>
              <?php foreach ($data as $y) { ?> 
              <tr>
                <td><?php echo $y->nim?></td>
                <td><?php echo $y->nama_mhs?></td>
                <td><?php echo $y->sex?></td>
                <td><?php echo $y->prodi?></td>
                <td><?php echo $y->tahun?></td>
                <td>
                  <a class="btn btn-sm btn-danger" onclick="show_add_penghargaan(<?php echo $y->nim;?>);"> Penghargaan</a>
                  <a class="btn btn-sm btn-danger" onclick="show_add_pelanggaran(<?php echo $y->nim;?>);"> Pelanggaran</a>
                </td>
              <?php }?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-add-penghargaan">
      <div class="modal-dialog">
        <form action="<?php echo base_url(). 'main/peristiwa/entry_penghargaan'; ?>"  method="post">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Entry Individu</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <input type="hidden" name="nim" id="nim" value="" class="form-control">
                </div>
                <div class="form-group">
                  <label>Tindakan</label>
                  <input type="text" class="form-control" placeholder="Penghargaan" disabled>
                </div>
                <div class="form-group">
                  <input type="hidden" name="id_peristiwa" class="form-control" placeholder="id peristiwa">
                </div>
                <div class="form-group">
                  <label name="kategori">Kategori</label>
                    <select class='form-control input-md' name='penghargaan' id='penghargaan' >
                      <option value="">Pilih Kategori</option>
                      <?php
                      foreach ($penghargaan as $row) {
                        echo '<option value="'.$row->id_kategori.'">'.$row->nama_kategori.'</option>';
                      }?>
                    </select>
                </div>
                <div class="form-group">                
                  <label>Nama Peristiwa</label>
                  <select name="peristiwa" class='form-control input-md' id="peristiwa">
                    <option value="">Pilih Penghargaan</option>
                  </select>
                </div>
                <div class="form-group">                
                  <label>Semester</label>
                  <input type="text" name="smt_melakukan" class="form-control" placeholder="Masukkan semester dilakukannya penghargaan">
                </div>
                <div class="form-group">                
                  <label>Poin</label>
                  <input type="numeric" name="point" id="point_penghargaan" class="form-control" disabled>
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" name="simpan" class="btn btn-danger">Save</button>
              </div>
            </div>
        </form>
      </div>
    </div>
    
  <script>
  function show_add_penghargaan(id)
  {
  var modal_add=document.getElementById('modal-ad d-penghargaan');
  var id_col=document.getElementById('nim');
  id_col.value=id;
  $("#modal-add-penghargaan").modal();
  //modal_add.style.display="block";
  }

  $(document).ready(function(){
  $('#penghargaan').change(function(){
  var id_kategori = $('#penghargaan').val();
  if(id_kategori != ''){
    $.ajax({
      url:"<?php echo site_url('main/peristiwa/fetch_peristiwa')?>", 
      method:"POST",
      data:{id_kategori:id_kategori},
      success:function(data){
        $('#peristiwa').html(data);
      }
    })
  }
  });
  $('#peristiwa').change(function(){
  var id_peristiwa = $('#peristiwa').val();
  if(id_peristiwa != '')
    //alert(id_peristiwa);
  {
    $.ajax({
      url:"<?php echo site_url('main/peristiwa/fetch_poin')?>", 
      method:"POST",
      data:{id_peristiwa:id_peristiwa},
      success:function(data){
        //alert(data);
        $('#point_penghargaan').val(data);
      }
    })
  }
  });

  });
  </script>
              <!-- /.box-body -->
  <div class="modal fade" id="modal-add-pelanggaran">
      <div class="modal-dialog">
        <form action="<?php echo base_url(). 'main/peristiwa/entry_pelanggaran'; ?>"  method="post">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Entry Individu</h4>
            </div>

            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" name="nim" id="nim_pel" value="" class="form-control">
              </div>
              <div class="form-group">
                <label>Tindakan</label>
                <input type="text" class="form-control" placeholder="Pelanggaran" disabled>
              </div>
              <div class="form-group">
                <label name="kategori">Kategori</label>
                  <select class='form-control input-md' name='pelanggaran' id='pelanggaran' >
                    <option value="">Pilih Kategori</option>
                    <?php
                    foreach ($pelanggaran as $row) {
                      echo '<option value="'.$row->id_kategori.'">'.$row->nama_kategori.'</option>';
                    }
                    ?>
                  </select>
              </div>
              <div class="form-group">                
                <label>Nama Peristiwa</label>
                  <select name="peristiwa" class='form-control input-md' id="peristiwa_pel">
                    <option value="">Pilih Pelanggaran</option>
                  </select>
              </div>
              <div class="form-group">                
                <label>Semester</label>
                  <input type="text" name="smt_melakukan" class="form-control" placeholder="Masukkan semester dilakukannya penghargaan">
              </div>
              <div class="form-group">                
                <label>Poin</label>
                <input type="numeric" name="point" id="point_pelanggaran" class="form-control" disabled>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              <button type="submit" name="simpan" class="btn btn-danger">Save</button>
            </div>
          </div>
        </form>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
  </div>
</section>
        
<script>
  function show_add_pelanggaran(id)
  {
    var modal_add=document.getElementById('modal-add-pelanggaran');
    var id_col=document.getElementById('nim_pel');
    id_col.value=id;
    $("#modal-add-pelanggaran").modal();
    //modal_add.style.display="block";
  }

  $(document).ready(function(){
    $('#pelanggaran').change(function(){
      var id_kategori = $('#pelanggaran').val();
      if(id_kategori != ''){
        $.ajax({
          url:"<?php echo site_url('main/peristiwa/fetch_peristiwa')?>", 
          method:"POST",
          data:{id_kategori:id_kategori},
          success:function(data){
            $('#peristiwa_pel').html(data);
          }
        })
      }
    });
    $('#peristiwa_pel').change(function(){
      var id_peristiwa = $('#peristiwa_pel').val();
      if(id_peristiwa != '')
        //alert(id_peristiwa);
      {
        $.ajax({
          url:"<?php echo site_url('main/peristiwa/fetch_poin')?>", 
          method:"POST",
          data:{id_peristiwa:id_peristiwa},
          success:function(data){
            //alert(data);
            $('#point_pelanggaran').val(data);
          }
        })
      }
    });
  });
</script>

<style>
.table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
   background-color: #f4f4f4;
}
</style>





          