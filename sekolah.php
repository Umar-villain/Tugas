<?php
 //* KONEKSI
  $koneksi = mysqli_connect("localhost", "root", "", "sekolah");
 
  //* SQL
  $sql = "select count('id') as jumlah_siswa from `siswa`";
  //* KIRIM sql ke mysql
  $query = mysqli_query($koneksi, $sql);
  //* Mendapatkan / Mengambil data yang sudah dikirim
  $jumlah_siswa = mysqli_fetch_assoc($query);

  $sql = "select count('id') as jumlah_eskul FROM `eskul`";
  //* KIRIM sql ke mysql
  $query = mysqli_query($koneksi, $sql);
  //* Mendapatkan / Mengambil data yang sudah dikirim
  $jumlah_eskul = mysqli_fetch_assoc($query);

  $sql = "select count('id') as jumlah_kelas FROM `kelas`";
  //* KIRIM sql ke mysql
  $query = mysqli_query($koneksi, $sql);
  //* Mendapatkan / Mengambil data yang sudah dikirim
  $jumlah_kelas = mysqli_fetch_assoc($query);

  $sql = "select sum(nominal_pembayaran) as Total_pembayaran_spp_hariIni FROM `spp` where tgl_bayar = '2026-09-30';";
  //* KIRIM sql ke mysql
  $query = mysqli_query($koneksi, $sql);
  //* Mendapatkan / Mengambil data yang sudah dikirim
  $Total_pembayaran_spp_hariIni = mysqli_fetch_assoc($query);

    $sql = "select siswa.nama as nama,
            spp.nominal_pembayaran as nominal,
            spp.tgl_bayar as tgl
            from `siswa`
            inner join `spp`
            on siswa.id = spp.id_siswa
            where spp.tgl_bayar = '2026-09-30';";
  //* KIRIM sql ke mysql
  $query = mysqli_query($koneksi, $sql);
?>

<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="[REDACTED LIKELY SECRET]" crossorigin="anonymous">
  </head>
  <body style="padding: 10px">

    <div class="card"  style="display:inline-block; padding: 5px">
     <div class="card-body">
       <h1>Jumlah Siswa</h1>
        <h2> <?php echo $jumlah_siswa['jumlah_siswa']  ?> <h2>
      </div>
    </div>


    <div class="card"  style="display:inline-block; padding: 5px">
     <div class="card-body">
       <h1>Jumlah Eskul</h1>
        <h2> <?php echo $jumlah_eskul['jumlah_eskul']  ?> <h2>
      </div>
    </div>


    <div class="card"  style="display:inline-block; padding: 5px">
     <div class="card-body">
       <h1>Jumlah Kelas</h1>
        <h2> <?php echo $jumlah_kelas['jumlah_kelas']  ?> <h2>
      </div>
    </div>


    <div class="card"  style="display:inline-block; padding: 5px">
     <div class="card-body">
       <h1>Total Pembayaran SPP Hari Ini</h1>
        <h2>Rp. <?php echo $Total_pembayaran_spp_hariIni['Total_pembayaran_spp_hariIni']  ?> <h2>
      </div>
    </div>  

    <div class="card"  style="display:inline-block; padding: 5px">
     <div class="card-body">
       <h1>Data Pembayaran SPP Hari Ini</h1>
        <table class="table">
          <thead>
            <tr>
              <th scope="col">Nama</th>
              <th scope="col">Nominal</th>
              <th scope="col">Tanggal Bayar</th>
            </tr>
          </thead>
          <tbody>
            <?php while($data_spp_hari_ini = mysqli_fetch_assoc($query)) { ?>
            <tr>
              <td><?php echo $data_spp_hari_ini['nama'] ?></td>
              <td>Rp. <?php echo $data_spp_hari_ini['nominal'] ?></td>
              <td><?php echo $data_spp_hari_ini['tgl'] ?></td>
            </tr>
            <?php } ?>
          </tbody>
        </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="[REDACTED LIKELY SECRET]" crossorigin="anonymous"></script>
  </body>
</html>