<script>
  window.print();
  importStyle: true;
</script>

<section class="content-header">
  <h1>
    Detail Taruna
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?php echo site_url("main/dashboard"); ?>"><i class="fa fa-dashboard"></i> Home</a></li>
    <li><a href="#">Tabel Rekap</a></li>
    <li><a href="<?php echo site_url("main/peristiwa/rekap_taruna");?>">Rekap Taruna</a></li>
    <li class="active">Detail Taruna</li>
  </ol>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
       <div class="box-header"> </div>
        <?php foreach ($ini as $y) {?> 
        <div class="row">
         <div class="col-md-6" >
          <div class="card border-danger mb-3"></div>
           <table class="table table-hover table-bordered" id="bootstrap-table">
             <thead>
                <tr>
                  <th scope="col">NIM</th>
                    <td><?php echo $y->nim?></td>
                </tr>
                <tr>
                  <th scope="col">Nama Taruna</th>
                    <td><?php echo $y->nama_mhs?></td>
                </tr>
                <tr> 
                  <th scope="col">Sex</th>
                    <td><?php echo $y->sex?></td>
                </tr>
             </thead>
            </table>
         </div> <!--card border-->
        
        <div class="col-md-6">
          <table class="table table-hover table-bordered" id="bootstrap-table">
            <thead>
              <tr>
                <th scope="col">Program Studi</th>
                  <td><?php echo $y->prodi?></td>
              </tr>
              <tr>
                <th scope="col">Angkatan</th>
                  <td><?php echo $y->tahun?></td>
              </tr>
            </thead>
          </table>
        </div> 

      </div> <!--col-md-6 yg atas -->
      <?php }?>

<div class="box-body">
  <?php $array_ipk=array();

  foreach($data as $smt=>$d)
  {
    $ctr_smt=50; ?>
    <table id="example" class="table table-bordered table-hover">
        <tr class="bg-red">
          <th colspan="3" ><center>SEMESTER : <?php echo $smt."<br>";?></center></th>
        </tr>
      <?php
    foreach ($d as $tp => $e) {?>
      <tr class="bg-danger">
        <th colspan="3" ><center><?php echo($tp==1)?"PENGHARGAAN":"PELANGGARAN";?></center></th>
      </tr>
      <?php 
      $ctr_pg=0; 

        foreach ($e as $key=>$kat){?>
          <tr class="bg-lighten-3">
            <th colspan="3" ><?php echo "Kategori : ".$key;?></th>
          </tr> 
          <tr class="bg-gray">
              <?php $no = 1 ;?>
              
              <th><center>No</center></th>
              <th><center>Peristiwa</center></th>
              <th><center>Poin</center></th>
            </tr>
          <?php
            foreach ($kat as $val) {
              ?>
              <tbody>
                <tr>
                  <td><?php echo $no++;?></td>
                  <td><?php echo $val['nama_peristiwa'];?></td>
                  <td><?php echo $val['point'];?></td>
                </tr>
              <?php
                  $ctr_pg+=$val['point'];
                  $ctr_smt+=$val['point'];
            }
        }
        ?>
          <tr class="bg-gray">
            <td colspan="2">Total Poin <?php echo($tp==1)?"Penghargaan":"Pelanggaran";?></td>
            <td><?php echo $ctr_pg;?></td>
          </tr>
        </tbody>
      <?php
    }?>

      
      <tr>
        <td colspan="3"><center><b><?php echo "IPS : ".$ctr_smt;?></b></center></td>
      </tr>
      </table>
      
      <?php
      array_push($array_ipk,$ctr_smt);
      //print_r($d);
      echo "<br>";
  }?>



    <table id="example" class="table table-bordered table-hover">
      <tr class="bg-black">
        <td colspan="2"><?php 
        if(count($array_ipk)== 0) echo "<center><b>Saat ini Taruna belum memiliki catatan Penghargaan maupun Pelanggaran </b> </center>";
        else echo "<center><b>IPK : ".array_sum($array_ipk)/count($array_ipk)."</b></center> "; ?>
        </td>
      </tr>
        <?php
        if(count($array_ipk)== 0) $kat_nilai_ipk="-";
        else{
           $hasil_ipk = array_sum($array_ipk)/count($array_ipk);
          
          if($hasil_ipk>=80) $kat_nilai_ipk="Sangat Baik";
          else if($hasil_ipk>=64.5 && $hasil_ipk<=79.5) $kat_nilai_ipk=" Baik";
          else if($hasil_ipk>=54 && $hasil_ipk<=64) $kat_nilai_ipk="Cukup";
          else if($hasil_ipk<54) $kat_nilai_ipk="Kurang";
        }
    ?>

    <?php
    if($kat_nilai_ipk=="Kurang"){?>
      
      <tr style="background-color: red"> 
        <th><center>Kategori Nilai : <?php echo $kat_nilai_ipk ?> </center></th>
      </tr>
    <?php } ?>

      <?php
      if($kat_nilai_ipk!="Kurang"){?>
      
      <tr style="background-color:aqua"> 
        <th><center>Kategori Nilai : <?php echo $kat_nilai_ipk ?> </center></th>
      </tr>
      <?php } ?>
    
    </table>

   

    </div>
  </div>
</div></div></section>
