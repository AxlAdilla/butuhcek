<?php

    $nama = $_GET['id'];

    $sql = $koneksi->query("select * from reservasi where nama = '$nama'");

    $tampil = $sql->fetch_assoc();

?>

<div class="panel panel-default">
<div class="panel-heading">
		Upload Bukti Pembayaran
		</div>
<div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <form method="POST" enctype="multipart/form-data">
                                      <div class="form-group">
                                            <label>Masukkan Lima angka terakhir Rekening yang anda gunakan untuk transfer </label> 
                                            <input type="file" name="filegambar" id="filegambar" />
                                           
                                        </div>

                                        	<input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                                     </div>
                                     </form>
                                     </div>
     </div>
     </div>
     </div>

    <?php
     $code = uniqid();
     $bukti = $_FILES['filegambar']['name'];

     $simpan = $_POST ['simpan'];

     if ($simpan){

        $tempdir = "gambar/"; 
            if (!file_exists($tempdir))
            mkdir($tempdir); 

            $target_path = $tempdir . basename($_FILES['filegambar']['name']);

            //nama gambar
            $nama_gambar=$_FILES['filegambar']['name'];
            //ukuran gambar
            $ukuran_gambar = $_FILES['filegambar']['size']; 
        include "phpqrcode/qrlib.php"; 

 $tempdir = "temp/"; //Nama folder tempat menyimpan file qrcode
 if (!file_exists($tempdir)) //Buat folder bername temp
    mkdir($tempdir);

    $codeContents = $code;
    $temp_name = $code; 
  
 QRcode::png($codeContents,$tempdir.$temp_name); 


            $sql = $koneksi->query("update reservasi set code='$code', bukti='$bukti' where nama='$nama'");


            if ($sql) {
                ?>
                    <script type="text/javascript">

                        alert ('Terima kasih, Silahkan tunggu konfirmasi status');
                        window.location.href="?page=Siswa";
                        </script>

                <?php
            }
     }

     ?>