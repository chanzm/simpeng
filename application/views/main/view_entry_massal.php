<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"/>

<script>
  function cek_checked(){ 
    var nim_kumpul = [];
    var input= document.getElementsByName("nim[]");
    for(var i=0;i< input.length;i++){ 
        if(input[i].value!='' && input[i].checked == true){
         nim_kumpul.push(input[i].value);
        }
      }
      var nim = nim_kumpul.toString();
      document.getElementById("nim_form1").value=nim;
      document.getElementById("nim_form2").value=nim;
  }
  
  function checkAll(){
    var parent = document.getElementById("parent");
    var label = document.getElementById("label");
    var input= document.getElementsByName("nim[]");
    if(parent.checked === true){
      for(var i=0;i< input.length;i++){
        if(input[i].type=="checkbox" && input[i].id == "child_checkbox" && input[i].checked == false){
          input[i].checked = true;
          label.innerHTML = "All Selected";
        }
      }
    }

    else if(parent.checked === false){
      for(var i=0;i< input.length;i++){ 
        if(input[i].type=="checkbox" && input[i].id == "child_checkbox" && input[i].checked == true){
          input[i].checked = false;
          label.innerHTML = "Select All";
        }
      }
    }
  }

</script>

<script>

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

<script>
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


<section class="content-header">
  <h1>
    Entry Nilai Massal
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url("main/dashboard"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Entry Nilai</a></li>
    <li class="active">Massal</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12"> 
      <div class="row">
          <form action="<?php echo base_url(). 'main/peristiwa/entry_massal'; ?>"  method="post">
          <div class="col col-md-3">
            <input type="text" name="kelas_sr" id="kelas_sr">Kelas
          </div>
          <div class="col col-md-3">
            <input type="text" name="tahun_sr" id="tahun_sr" >Angkatan
          </div>
          <div class="col col-md-3">
            <input type="text" name="prodi_sr" id="prodi_sr">Prodi
          </div>
        <div class="col col-md-3">
          <button type="submit" class="btn btn-danger">Cari</button>
        </div>
      </form>  
      </div> 

      <div ="box-bodclassy" style="overflow-y:scroll">
        <table class="table table-striped table-bordered bg-danger table-hover text-center">
          <thead>
            <tr>
              <th>NIM</th>
              <th>Nama Taruna</th>
              <th>Sex</th>
              <th>Prodi</th>
              <th>Tahun</th>
              <th>Kelas</th>
              <th> <!-- <input type="button" id="toggle" onclick="do_this()" value="SelectAll"/> -->
                <span id="label">All Selected</span>
                <input type="checkbox" id="parent" onclick="checkAll()" checked />
              </th>
           </tr>
          </thead>

          <tbody id="table_tbody">
            <?php if(count($data)):?>
            <?php foreach ($data as $y) { ?> 
            <tr>
              <td><?php echo $y->nim?></td>
              <td><?php echo $y->nama_mhs?></td>
              <td><?php echo $y->sex?></td>
              <td id="prodi"><?php echo $y->prodi?></td>
              <td id="tahun"><?php echo $y->tahun?></td>
              <td id="kelas"><?php echo $y->kd_angkatan?></td>
              <td>
                <input id="child_checkbox" name="nim[]" type="checkbox" value=<?php echo $y->nim?> checked> 
              </td>
                <?php }?>
                <?php else:?>
                  <tr>No Records Found!</tr>
                <?php endif;?>
            </tr>
          </tbody>
        </table>
      </div>
      <div class="container col col-xs-12 text-center" id="button-relative">
        <div class="panel-group" id="accordion">
          <div class="panel-heading">
            <button type="button"  class="btn btn-danger" onclick="cek_checked()" data-toggle="collapse" name="add-penghargaan" id="add-penghargaan" href="#collapse2">Tambah Penghargaan
            </button>
          </div>
          <div id="collapse2" class="panel-collapse collapse justify-content-center ">
            <div class="panel-body">
              <div class="container col col-xs-12"  style="background-color:#ebdac0">
                <form class="from-inline" action="<?php echo base_url(). 'main/peristiwa/entry_penghargaan_massal'; ?>"  method="post">
                  <div class="form-group">                
                    <!-- <label>Nim</label> -->
                    <input type="hidden" name="nim_form1" id="nim_form1" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Tindakan</label>
                    <input type="text" class="form-control" placeholder="Penghargaan" disabled>
                  </div>    
                  <div class="form-group">                
                    <!-- <label>Id Peristiwa</label> -->
                    <input type="hidden" name="id_peristiwa" class="form-control" placeholder="id peristiwa">
                  </div>
                  <div class="form-group">
                  <label name="kategori">Kategori</label>
                    <select class='form-control input-md' name='penghargaan' id='penghargaan' >
                      <option value="">Pilih Kategori</option>
                      <?php
                      foreach ($penghargaan as $row) {
                        echo '<option value="'.$row->id_kategori.'">'.$row->nama_kategori.'</option>';
                      }
                      ?>
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
                  <div>
                    <button type="submit" name="simpan" class="btn btn-danger">Save</button>
                    <!-- <?php echo form_submit(['name'=>'submit','value'=>'save','class'=>'entry']); ?> -->
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
    
        <div class="panel-group" id="accordion">
          <div class="panel-heading">
            <button type="button" class="btn btn-danger" onclick="cek_checked()" data-toggle="collapse" name="add-pelanggaran" href="#collapse1">Tambah Pelanggaran
            </button>
          </div>
          <div id="collapse1" class="panel-collapse collapse">
            <div class="panel-body">
              <div class="container col-lg-12" style="background-color:#ebdac0">
                <form class="from-inline" action="<?php echo base_url(). 'main/peristiwa/entry_pelanggaran_massal'; ?>"  method="post">
                  <div class="form-group">
                    <input type="hidden" name="nim_form2" id="nim_form2" value="" class="form-control">
                  </div>
                  <div class="form-group">
                    <label>Tindakan</label>
                    <input type="text" class="form-control" placeholder="Pelanggaran" disabled>
                  </div>
                  <div class="form-group">
                    <input type="hidden" name="id_peristiwa" class="form-control" placeholder="id peristiwa">
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
                      <select name="peristiwa_pel" class='form-control input-md' id="peristiwa_pel">
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
                  <div>
                    <button type="submit" name="simpan" class="btn btn-danger">Save</button>
                  </div>
                </form>
              </div>
            </div>
          </div>
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
