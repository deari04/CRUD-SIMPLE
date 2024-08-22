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

        if (isset($_GET["id_"])) {
            $id_ = input($_GET["id_"]);

            $sql = "SELECT * FROM mahasiswa WHERE id_ = '$id_'";
            $result = mysqli_query($conn, $sql);
            $data = mysqli_fetch_assoc($result);
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            $id_ = input($_POST["id_"]);
            $nama_mahasiswa = input($_POST["nama_mahasiswa"]);
            $prodi_mahasiswa = input($_POST["prodi_mahasiswa"]);
            $jurusan = input($_POST["jurusan"]);
            $alamat = input($_POST["alamat"]);

            $sql = "UPDATE mahasiswa SET 
            nama_mahasiswa = '$nama_mahasiswa',
            prodi_mahasiswa = '$prodi_mahasiswa',
            jurusan = '$jurusan',
            alamat = '$alamat'
            WHERE id_ = '$id_'";

            $result = mysqli_query($conn, $sql);
            if ($result) {
                header("Location: index.php");
            } else {
                echo "<div class='alert alert-danger'>Data gagal di update</div>";
            }
        }

        ?>

        <h2>Update Data</h2>

        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Nama Mahasiswa:</label>
                <input type="text" name="nama_mahasiswa" class="form-control" value="<?php echo $data['nama_mahasiswa']; ?>" placeholder="Masukkan Nama" required />
            </div>
            <br>
            <div class="form-group">
                <label>Prodi Mahasiswa:</label>
                <input type="text" name="prodi_mahasiswa" class="form-control" value="<?php echo $data['prodi_mahasiswa']; ?>" placeholder="Masukkan Prodi" required />
            </div>
            <br>
            <div class="form-group">
                <label>Jurusan Mahasiswa:</label>
                <input type="text" name="jurusan" class="form-control" value="<?php echo $data['jurusan']; ?>" placeholder="Masukkan Jurusan" required />
            </div>
            <br>
            <div class="form-group">
                <label>Alamat Mahasiswa:</label>
                <textarea name="alamat" class="form-control" rows="3" placeholder="Masukkan Alamat" required><?php echo $data["alamat"]; ?></textarea>
            </div>
            <input type="hidden" name="id_" value="<?php echo $data["id_"]; ?>" />
            <br>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>
</html>
