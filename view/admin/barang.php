<?php
session_start();
require '../../../Glowy/koneksi/koneksi.php';

if (isset($_SESSION['flash'])) {
    $flashdata = $_SESSION['flash'];
    unset($_SESSION['flash']);
} else {
    $flashdata = null;
}

if (!($_SESSION['user']['peran'] == 'Admin' or $_SESSION['user']['peran'] == 'Super')) {
    header('Location: ./');
}
$sql = "SELECT * FROM product";
$result = mysqli_query($conn, $sql);
$rows = [];
while ($row = mysqli_fetch_assoc($result)) {
    $rows[] = $row;
}
require 'layouts/header.php';
require 'layouts/sidebar.php';
?>

<div class="flash-data" data-flashdata="<?= htmlspecialchars(json_encode($flashdata)); ?>"></div>

<div class="d-flex flex-column w-100 mx-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2"> Barang</h1>
    </div>

    <div class="table-responsive small">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahBarang">Tambah Barang</button>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Gambar</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row['nama']; ?></td>
                        <td><?= $row['harga']; ?></td>
                        <td><?= '<img style="width: 50px;" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Product Image">'; ?></td>
                        <?php
                        $data = array(
                            'id' => $row['id'],
                            'nama' => $row['nama'],
                            'harga' => $row['harga']
                        );
                        ?>
                        <td class="text-center">
                            <button class="buttonUbah badge bg-warning border-0" data-bs-toggle="modal" data-bs-target="#editBarang" data-id="<?= htmlspecialchars(json_encode($data)); ?>"><i class="bi bi-pencil-square"></i></button>
                            <a href="../admin/barang/delete.php?id=<?= $row['id']; ?>" class="badge bg-danger border-0 tombol-hapus" data-pesan="Hapus Barang"><i class="bi bi-x-circle"></i></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>


<div class="modal fade" id="tambahBarang" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="judulModal">Tambah Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="barang/create.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control " id="nama" name="nama" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga Barang</label>
                        <input type="number" class="form-control " id="harga" name="harga" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar</label>
                        <input class="form-control" name="gambar" type="file" id="gambar" required>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Tambah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="editBarang" tabindex="0" aria-labelledby="modalUbah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="judulModal">Ubah Barang</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="barang/update.php" method="post" enctype="multipart/form-data" id="updateForm">
                    <div class="mb-3">
                        <label for="namaBaru" class="form-label">Nama Barang Baru</label>
                        <input type="text" class="form-control " id="namaBaru" name="namaBaru" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="hargaBaru" class="form-label">Harga Barang Baru</label>
                        <input type="number" class="form-control " id="hargaBaru" name="hargaBaru" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Gambar Baru</label>
                        <input class="form-control" name="gambarBaru" type="file" id="gambarBaru">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                <button type="submit" class="btn btn-primary">Ubah</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    const buttonsUbah = document.querySelectorAll('.buttonUbah');

    buttonsUbah.forEach(buttonUbah => {
        buttonUbah.addEventListener('click', function() {
            const dataId = JSON.parse(this.getAttribute('data-id'));

            document.getElementById('namaBaru').value = dataId.nama;
            document.getElementById('hargaBaru').value = dataId.harga;

            const updateForm = document.getElementById('updateForm');
            updateForm.action = 'barang/update.php?id=' + dataId.id;
        });
    });
</script>


<?php require 'layouts/footer.php' ?>