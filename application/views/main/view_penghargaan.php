<head>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

  <script>
    function delete_confirm(url){
      $('#modal-delete').modal();
      $('#btn-delete').attr("href", url);
    }
  </script>
</head>

<section class="content-header">
  <h1>
    Data Penghargaan
  </h1>
  <ol class="breadcrumb">
  <li><a href="<?php echo site_url("main/dashboard"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Table Pengasuhan</a></li>
    <li class="active">Data Penghargaan</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">  
        <div class="col col-xs-16 text-center" id="button-relative">
          <a class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-add"> Tambah Penghargaan</a>    
        </div>
        <div class="box-body" style="overflow-y:scroll">
          <table id="example2" class="table table-striped table-bordered bg-danger table-hover text-center">
            <thead>
              <tr>
               <th>No</th>
               <th>Nama Kategori</th>
               <th>Nama Peristiwa</th>
               <th>Poin</th>
               <th >Action</th>
              </tr>
            </thead>
            <tbody>
            <?php 
              $no = 1;
              foreach ($data as $y) { ?>                                  
               <tr>
                <td><?php echo $no++; ?></td>
                <td id="k_<?php echo $y->id_peristiwa?>"><?php echo $y->nama_kategori?></td>
                <td id="j_<?php echo $y->id_peristiwa?>"><?php echo $y->nama_peristiwa?></td>
                <td id="p_<?php echo $y->id_peristiwa?>"><?php echo $y->point?></td>
                <td>
                <!-- <a class="btn btn-sm btn-danger" onclick="show_edit_modal(<?php echo $y->id_peristiwa?>)"  data-target="#modal-edit<?=$y->id_peristiwa;?>">Edit</a> -->
                <a data-toggle="modal" data-target="#modal-edit<?php echo $y->id_peristiwa;?>"> <em class="fa fa-pencil btn btn-sm btn-danger btn-create"></em></a> 
                <a data-toggle="modal" onclick="delete_confirm('<?php echo site_url('main/peristiwa/hapus_penghargaan/'.$y->id_peristiwa) ?>')" ><em class="fa fa-trash btn btn-sm btn-danger"></em></a>
                </td>
              </tr>
              <?php }?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
    <div class="modal fade" id="modal-add" >
      <div class="modal-dialog">
        <form action="<?php echo base_url(). 'main/peristiwa/simpan_penghargaan'; ?>"  method="post">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Tambah Penghargaan</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <input type="hidden" class="form-control" name="counter_peristiwa">
                <label name="kategori">Kategori</label>
                  <select class='form-control input-md' name='kategori' id='kategori' >
                    <option value="">Pilih Kategori</option>
                    <?php
                    foreach ($penghargaan as $row) {
                      echo '<option value='.$row->id_kategori.'>'.$row->nama_kategori.'</option>';
                    }
                    ?>
                </select>
              </div>
              <div class="form-group">                
                <label>Nama_Peristiwa</label>
                <input type="text" class="form-control" name="nama_peristiwa" required placeholder="Enter ...">
              </div>
              <div class="form-group">                
                <label for="poin">Point</label>
                <input type="numeric" class="form-control" step="any" placeholder="Enter Poin" name="point" required>
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
  </div>

  <?php 
  foreach($data as $y):
  ?>

  <div class="modal fade" id="modal-edit<?php echo $y->id_peristiwa?>">
    <div class="modal-dialog">
      <form action="<?php echo base_url(). 'main/peristiwa/update_penghargaan'; ?>"  method="post">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Edit Penghargaan</h4>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <input type="hidden" class="form-control" name="id_peristiwa" value="<?php echo $y->id_peristiwa?>">
            </div>
            <div class="form-group">
              <input type="hidden" class="form-control" name="counter_peristiwa" value="<?php echo $y->counter_peristiwa?>">
            </div>
            <div class="form-group">
              <label name="kategori">Kategori</label>
                <select class='form-control input-md' name='kategori' id='kategori' >
                  <option value=<?php echo $y->id_kategori?> selected><?php echo $y->nama_kategori?></option>
                  <?php
                  foreach ($penghargaan as $row) {
                  echo '<option value='.$row->id_kategori.'>'.$row->nama_kategori.'</option>';
                  }
                  ?>
                </select>
            </div>
            <div class="form-group">                
              <label>Nama_Peristiwa</label>
              <input type="text" class="form-control" name="nama_peristiwa" id="j_edit_m" value="<?php echo $y->nama_peristiwa?>" required placeholder="Enter ...">
            </div>
            <div class="form-group">                
              <label>Point</label>
              <input type="numeric" id='p_edit_m' name="point" class="form-control" value="<?php echo $y->point?>">
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
  <?php endforeach;?>
  <div class="modal modal-danger fade" id="modal-delete">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title">Hapus Penghargaan</h4>
        </div>
        <div class="modal-body">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline pull-left" data-dismiss="modal">Tutup</button>
          <a id="btn-delete" class="btn btn-outline" href="">Hapus</a>
        </div>
      </div>
    </div>
  </div>

<style>
  .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
     background-color: #f4f4f4;
  }
</style>