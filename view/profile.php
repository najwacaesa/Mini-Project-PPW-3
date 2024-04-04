<?php
// Mulai sesi
session_start();

// Lakukan koneksi ke database
require '../Beauty_E-Commerce/koneksi/koneksi.php';

// Cek apakah pengguna sudah login dengan memeriksa sesi
if (isset($_SESSION["user"])) 
    // Jika sudah login, ambil ID pengguna dari sesi
    $userId = $_SESSION["user"];

    // Query untuk mengambil data pengguna berdasarkan ID
    $query = "SELECT * FROM user WHERE id = ?";

    // Persiapkan statement
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameter ke statement
    mysqli_stmt_bind_param($stmt, "i", $userId);

    // Eksekusi statement
    mysqli_stmt_execute($stmt);

    // Ambil hasil query
    $result = mysqli_stmt_get_result($stmt);

    // Periksa apakah query berhasil dieksekusi dan mengembalikan hasil yang valid
    if ($result && mysqli_num_rows($result) > 0) {
        // Ambil data pengguna
        $user = mysqli_fetch_assoc($result);

        // Tampilkan formulir atau lakukan tindakan lainnya
        // Misalnya:
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8">
    <title>Update Image Profile</title>
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="../assets/css/style.map.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <form class="form" id="form" action="" enctype="multipart/form-data" method="post">
        <div class="upload">
            <h1>Welcome, <?php echo $user['username']; ?></h1>
            <p>Email: <?php echo $user['email']; ?></p>
            <?php
            if(isset($user)) {
                $id = $user["id"];
                $first_name = $user["first_name"];
                $last_name = $user["last_name"];
                $username = $user["username"];
                $email = $user["email"];
                $gender = $user["gender"];
                $password = $user["password"];
                $image = $user["image"];
            ?>
            <img src="img/<?php echo $image; ?>" width="125" height="125" title="<?php echo $image; ?>" alt="Profile Picture">
            <div class="round">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                <input type="text"" name="first_name" value="<?php echo $first_name; ?>">
                <input type="text" name="last_name" value="<?php echo $last_name; ?>">
                <input type="text" name="username" value="<?php echo $username; ?>">
                <input type="text" name="email" value="<?php echo $email; ?>">
                <input type="text" name="gender" value="<?php echo $gender; ?>">
                <input type="text" name="password" value="<?php echo $password; ?>">
                <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                <label for="image" style="color: #fff;"><i class="fa fa-camera"></i></label>
            </div>
            <?php
            } else {
                echo "No user data found";
            }
            ?>
        </div>
    </form>
    <script type="text/javascript">
        document.getElementById("image").onchange = function(){
            document.getElementById("form").submit();
        };
    </script>
</body>
</html>
<?php
    } else {
        // Jika data pengguna tidak ditemukan
        echo "No user data found.";
    }

    // Tutup statement dan koneksi database
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
?>
