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
$sql = "SELECT * FROM user";
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
        <h1 class="h2">Akun</h1>
    </div>

    <div class="table-responsive small">
        <button class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#tambahAkun">Tambah Akun</button>
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Nama Depan</th>
                    <th scope="col">Nama Belakang</th>
                    <th scope="col">Username</th>
                    <th scope="col">Email</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Peran</th>
                    <th scope="col" class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $i = 1; ?>
                <?php foreach ($rows as $row) : ?>
                    <tr>
                        <td><?= $i; ?></td>
                        <td><?= $row['first_name']; ?></td>
                        <td><?= $row['last_name']; ?></td>
                        <td><?= $row['username']; ?></td>
                        <td><?= $row['email']; ?></td>
                        <td><?= $row['gender']; ?></td>
                        <td><?= '<img style="width: 50px;" src="data:image/jpeg;base64,' . base64_encode($row['image']) . '" alt="Profile Picture">'; ?></td>
                        <td><?= $row['peran']; ?></td>
                        <?php
                        $data = array(
                            'id' => $row['id'],
                            'namaDepan' => $row['first_name'],
                            'namaBelakang' => $row['last_name'],
                            'username' => $row['username'],
                            'email' => $row['email'],
                            'gender' => $row['gender'],
                            'peran' => $row['peran'],
                        );
                        ?>
                        <td class="text-center">
                            <button class="buttonUbah badge bg-warning border-0" data-bs-toggle="modal" data-bs-target="#editAkun" data-id="<?= htmlspecialchars(json_encode($data)); ?>"><i class="bi bi-pencil-square"></i></button>
                            <a href="../admin/account/delete.php?id=<?= $row['id']; ?>" class="badge bg-danger border-0 tombol-hapus" data-pesan="Hapus Akun"><i class="bi bi-x-circle"></i></a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                <?php endforeach; ?>

            </tbody>
        </table>
    </div>
</div>

<div class="modal fade" id="tambahAkun" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="judulModal">Tambah Akun</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="account/create.php" method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="namaDepan" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control " id="namaDepan" name="namaDepan" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="namaBelakang" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control " id="namaBelakang" name="namaBelakang" required>
                    </div>
                    <div class="mb-3">
                        <label for="username" class="form-label">Username</label>
                        <input type="text" class="form-control" name="username" id="username" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="email" required>
                    </div>
                    <div class="mb-3">
                        <label for="gender" class="form-label">Gender</label>
                        <select class="form-select" aria-label="Default select example" id="gender" name="gender">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Profile Picture</label>
                        <input type="file" class="form-control" name="gambar" id="gambar">
                    </div>
                    <div class="mb-3">
                        <label for="peran" class="form-label">Peran</label>
                        <select class="form-select" aria-label="Default select example" id="peran" name="peran">
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                            <option value="Super">Super Admin</option>
                        </select>
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
<div class="modal fade" id="editAkun" tabindex="-1" aria-labelledby="modalTambah" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="judulModal">Edit Akun</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="account/create.php" method="post" enctype="multipart/form-data" id="updateForm">
                    <div class="mb-3">
                        <label for="namaDepanBaru" class="form-label">Nama Depan</label>
                        <input type="text" class="form-control " id="namaDepanBaru" name="namaDepanBaru" required autofocus>
                    </div>
                    <div class="mb-3">
                        <label for="namaBelakangBaru" class="form-label">Nama Belakang</label>
                        <input type="text" class="form-control " id="namaBelakangBaru" name="namaBelakangBaru" required>
                    </div>
                    <div class="mb-3">
                        <label for="usernameBaru" class="form-label">Username</label>
                        <input type="text" class="form-control" name="usernameBaru" id="usernameBaru" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailBaru" class="form-label">Email</label>
                        <input type="email" class="form-control" name="emailBaru" id="emailBaru" required>
                    </div>
                    <div class="mb-3">
                        <label for="genderBaru" class="form-label">Gender</label>
                        <select class="form-select" aria-label="Default select example" id="genderBaru" name="genderBaru">
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="gambar" class="form-label">Profile Picture</label>
                        <input class="form-control" name="gambarBaru" type="file" id="gambarBaru">
                    </div>
                    <div class="mb-3">
                        <label for="peranBaru" class="form-label">Peran</label>
                        <select class="form-select" aria-label="Default select example" id="peranBaru" name="peranBaru">
                            <option value="User">User</option>
                            <option value="Admin">Admin</option>
                            <option value="Super">Super Admin</option>
                        </select>
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

            document.getElementById('namaDepanBaru').value = dataId.namaDepan;
            document.getElementById('namaBelakangBaru').value = dataId.namaBelakang;
            document.getElementById('usernameBaru').value = dataId.username;
            document.getElementById('emailBaru').value = dataId.email;
            document.getElementById('genderBaru').value = dataId.gender;
            document.getElementById('peranBaru').value = dataId.peran;

            const updateForm = document.getElementById('updateForm');
            updateForm.action = 'account/update.php?id=' + dataId.id;
        });
    });
</script>


<?php require 'layouts/footer.php' ?>