<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <?php
        include "conn.php";

        function input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nama_mahasiswa = input($_POST["nama_mahasiswa"]);
            $prodi_mahasiswa = input($_POST["prodi_mahasiswa"]);
            $jurusan = input($_POST["jurusan"]); 
            $alamat = input($_POST["alamat"]);

            $sql = "INSERT INTO mahasiswa (nama_mahasiswa, prodi_mahasiswa, jurusan, alamat) VALUES 
            ('$nama_mahasiswa', '$prodi_mahasiswa', '$jurusan', '$alamat')";

            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("Location: index.php");
            } else {
                echo "<div class='alert alert-danger'>Data gagal ditambahkan</div>";
            }
        }
        ?>
        <h2>Input Data</h2>

        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="form-group">
                <label>Nama Mahasiswa:</label>
                <input type="text" name="nama_mahasiswa" class="form-control" placeholder="Masukkan Nama" required />
            </div>
            <br>
            <div class="form-group">
                <label>Prodi Mahasiswa:</label>
                <input type="text" name="prodi_mahasiswa" class="form-control" placeholder="Masukkan Prodi" required />
            </div>
            <br>
            <div class="form-group">
                <label>Jurusan Mahasiswa:</label>
                <input type="text" name="jurusan" class="form-control" placeholder="Masukkan Jurusan" required />
            </div>
            <br>
            <div class="form-group">
                <label>Alamat Mahasiswa:</label>
                <input type="text" name="alamat" class="form-control" placeholder="Masukkan Alamat" required />
            </div>
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
    
</body>
</html>
