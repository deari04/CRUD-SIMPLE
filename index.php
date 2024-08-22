<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <br>
        <h4>Simple CRUD</h4>
        <?php
        include "conn.php";

        if (isset($_GET['id_'])) {
            $id_ = $_GET['id_'];

            $sql = "DELETE FROM `mahasiswa` WHERE id_ = $id_";  
            $result = mysqli_query($conn, $sql);

            if ($result) {
                header("location:index.php");
            } else {
                echo "<div class='alert alert-danger'>Data gagal dihapus</div>";
            }
        }
        ?>

        <table class="table table-bordered table-hover">
            <br>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Prodi</th>
                    <th>Jurusan</th>
                    <th>Alamat</th>
                    <th colspan="2">Action</th>
                </tr>
            </thead>
            <?php
            include "conn.php";

            $sql = "SELECT * FROM mahasiswa ORDER BY id_ DESC";  
            $result = mysqli_query($conn, $sql);
            $no = 0;
            while ($data = mysqli_fetch_array($result)) {
                $no++;
            ?>
            <tbody>
                <tr>
                    <td><?php echo $no; ?></td>
                    <td><?php echo $data['nama_mahasiswa']; ?></td>
                    <td><?php echo $data['prodi_mahasiswa']; ?></td>
                    <td><?php echo $data['jurusan'];  ?></td>
                    <td><?php echo $data['alamat']; ?></td>
                    <td>
                        <a href="update.php?id_=<?php echo htmlspecialchars($data['id_']); ?>" class="btn btn-warning" role="button">Update</a>
                        <a href="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>?id_=<?php echo $data['id_']; ?>" class="btn btn-danger" role="button">Delete</a>
                    </td>
                </tr>
            </tbody>
            <?php
        }
        ?>
        </table>
        <a href="create.php" class="btn btn-primary" role="button">Create</a>
    </div>
</body>
</html>
