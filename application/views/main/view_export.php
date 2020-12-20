<head>  
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<section class="content-header">
  <table><tr><td colspan='8'><h1>
    Rekap Taruna
  </h1></td></tr></table>
</section>

<section class="content">
  <div class="row">
    <div class="col-xs-12">
      <div class="box">
        <div class="box-body" style="overflow-y:scroll">
          <table border="1" width="100%">
            <thead>
              <tr>
                <th width="5%"> <div align="center">NIM </div></th>
                <th width="20%"> <div align="center">Nama Taruna </div></th>
                <th width="5%"> <div align="center">Sex </div></th>
                <th width="10%"> <div align="center">Prodi </div></th>
                <th width="15%"> <div align="center">Angkatan </div></th>
                <th width="5%"> <div align="center">Kelas </div></th>
                <th width="5%"> <div align="center">IPS </div></th>
                <th width="5%"> <div align="center">IPK </div></th>
              </tr>
            </thead>
            <?php foreach ($taruna as $y) { ?> 
            <tbody>
              <tr>
                <td><div align="center"><?php echo $y->nim?></div></td>
                <td><?php echo $y->nama_mhs?></td>
                <td><div align="center"><?php echo $y->sex?></div></td>
                <td><div align="center"><?php echo $y->prodi?></div></td>
                <td><div align="center"><?php echo $y->tahun?></div></td>
                <td><div align="center"><?php echo $y->kelas?></div></td>
                <td><div align="center"><?php echo "blabla"?></div></td>
                <td><div align="center"><?php echo "blabla"?></div></td>
                <?php }?>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</section>

<style>
  .table-striped > tbody > tr:nth-child(2n+1) > td, .table-striped > tbody > tr:nth-child(2n+1) > th {
     background-color: #ebdac0;
  }
</style>