<?php
include_once("koneksi.php");
?>

<form class="form row" method="POST" action="" name="myForm" onsubmit="return(validate());">


    <?php 
        $nama = '';
        $alamat = '';
        $no_hp = '';
        if (isset ($_GET['id'])) {
            $ambil = mysqli_query($mysqli, "SELECT * FROM dokter where id ='" . $_GET['id'] . "'");
            while ($row = mysqli_fetch_array($ambil)) {
                $nama = $row['nama'];
                $alamat = $row ['alamat'];
                $no_hp = $row ['no_hp'];
            }
    ?>
        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
        <?php
        }
?>

    <div class="mb-3">
        <label for="inputnama" class="form-label fw-bold">
            nama
        </label>
        <input type="text" class="form-control" name="nama" id="inputnama" placeholder="nama" value="<?php echo $nama ?>">
    </div>
    <div class="mb-3">
        <label for="inputalamat" class="form-label fw-bold">
            alamat
        </label>
        <input type="text" class="form-control" name="alamat" id="inputalamat" placeholder="alamat" value="<?php echo $alamat ?>">
    </div>
    <div class="mb-3 mb-2">
        <label for="inputno_hp" class="form-label fw-bold">
        No HP
        </label>
        <input type="text" class="form-control" name="no_hp" id="inputno_hp" placeholder="no_hp" value="<?php echo $no_hp ?>">
    </div>
    <div class="mb-3">
        <button type="submit" class="btn btn-primary rounded-pill px-3" name="simpan">Simpan</button>
    </div>
</form>


<!-- Table-->
<table class="table table-hover">
    <!--thead atau baris judul-->
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama</th>
            <th scope="col">Alamat</th>
            <th scope="col">No Hp</th>
            <th scope="col">Aksi</th>
        </tr>
    </thead>
    <!--tbody bernama nama tabel sesuai dengan judul atau head-->
    <tbody>
       
    <!-- Kode PHP untuk menampilkan semua nama dari tabel urut
        berdasarkan status dan tanggal awal-->
        <?php
        $result = mysqli_query(
            $mysqli,"SELECT * FROM dokter ORDER BY nama"
            );
        $no = 1;
        while ($data = mysqli_fetch_array($result)) {
        ?>
            <tr>
                <th scope="row"><?php echo $no++ ?></th>
                <td><?php echo $data['nama'] ?></td>
                <td><?php echo $data['alamat'] ?></td>
                <td><?php echo $data['no_hp'] ?></td>
                <td>
                    <a class="btn btn-info rounded-pill px-3" 
                    href="index.php?page=dokter&id=<?php echo $data['id'] ?>">Ubah
                    </a>
                    <a class="btn btn-danger rounded-pill px-3" 
                    href="index.php?page=dokter&id=<?php echo $data['id'] ?>&aksi=hapus">Hapus
                    </a>
                </td>
            </tr>
        <?php
        }
        ?>
    </tbody>
</table>

<?php
if (isset($_POST['simpan'])) {
    if (isset($_POST['id'])) {
        $ubah = mysqli_query($mysqli, "UPDATE dokter SET 
                                        nama = '" . $_POST['nama'] . "',
                                        alamat = '" . $_POST['alamat'] . "',
                                        no_hp = '" . $_POST['no_hp'] . "'
                                        WHERE
                                        id = '" . $_POST['id'] . "'");
    } else {
        $tambah = mysqli_query($mysqli, "INSERT INTO dokter(nama,alamat,no_hp) 
                                        VALUES ( 
                                            '" . $_POST['nama'] . "',
                                            '" . $_POST['alamat'] . "',
                                            '" . $_POST['no_hp'] . "'
                                            )");
    }

    echo "<script> 
            document.location='index.php?page=dokter';
            </script>";
}

if (isset($_GET['aksi'])) {
    if ($_GET['aksi'] == 'hapus') {
        $hapus = mysqli_query($mysqli, "DELETE FROM dokter WHERE id = '" . $_GET['id'] . "'");
    } else if ($_GET['aksi'] == 'ubah_status') {
        $ubah_status = mysqli_query($mysqli, "UPDATE dokter SET 
                                        status = '" . $_GET['status'] . "' 
                                        WHERE
                                        id = '" . $_GET['id'] . "'");
    }

    echo "<script> 
            document.location='index.php?page=dokter';
            </script>";
}


?>