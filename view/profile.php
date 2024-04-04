<?php
require 'C:/xampp/htdocs/Beauty_E-Commerce/koneksi/koneksi.php';

// Mulai sesi
session_start();

// Lakukan koneksi ke database

// Cek apakah pengguna sudah login dengan memeriksa sesi
if (isset($_SESSION["user"])) {
    // Jika sudah login, ambil ID pengguna dari sesi
    $userId = $_SESSION["user"]['id'];

    // Query untuk mengambil data pengguna berdasarkan ID
    $query = "SELECT * FROM user WHERE id = {$userId}";

    // Persiapkan statement
    $result = mysqli_query($conn, $query);

    $user = mysqli_fetch_assoc($result);
} else {
    header('Location: view/login.php');
    exit; // Pastikan script berhenti di sini setelah mengalihkan
}

// Jika formulir dikirim
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data yang dikirimkan dari formulir
    $id = $_POST["id"];
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $username = $_POST["username"];
    $email = $_POST["email"];
    $gender = $_POST["gender"];
    $password = $_POST["password"];
    
    // Jika ada gambar yang diunggah, perbarui juga gambar pengguna
    if ($_FILES["image"]["name"]) {
        $image = $_FILES["image"]["name"];
        $temp_name = $_FILES["image"]["tmp_name"];
        $folder = "C:/xampp/htdocs/Beauty_E-Commerce/assets/images"; // Ubah direktori sesuai dengan kebutuhan Anda
        
        // Pindahkan gambar ke direktori yang diinginkan
        if (move_uploaded_file($temp_name, $folder . $image)) {
            // File berhasil diunggah, lanjutkan dengan query update
        } else {
            // Jika gagal mengunggah gambar, tampilkan pesan kesalahan
            echo "Failed to upload image.";
            exit;
        }
    } else {
        // Jika tidak ada gambar yang diunggah, gunakan gambar yang ada sebelumnya
        $image = $user["image"];
    }
    
    // Query untuk memperbarui data pengguna
    $query = "UPDATE user SET first_name='$first_name', last_name='$last_name', username='$username', email='$email', gender='$gender', password='$password', image='$image' WHERE id=$id";
    
    // Eksekusi query
    if (mysqli_query($conn, $query)) {
        // Jika berhasil, perbarui sesi pengguna dengan data yang baru
        $_SESSION["user"] = [
            "id" => $id,
            "first_name" => $first_name,
            "last_name" => $last_name,
            "username" => $username,
            "email" => $email,
            "gender" => $gender,
            "password" => $password,
            "image" => $image
        ];
        // Alihkan ke halaman profil pengguna setelah pembaruan data pengguna berhasil dilakukan
        header("Location: index.php?page=Profile");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
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
    <form class="form" id="form" style="margin-bottom: 50%;" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data" method="post">
        <div class="upload">
            <h1>Welcome, <?php echo $user['username']; ?></h1>
            <?php
            if (isset($user)) {
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
                    <input type="text" name="first_name" value="<?php echo $first_name; ?>">
                    <input type="text" name="last_name" value="<?php echo $last_name; ?>">
                    <input type="text" name="username" value="<?php echo $username; ?>">
                    <input type="text" name="email" value="<?php echo $email; ?>">
                    <input type="text" name="gender" value="<?php echo $gender; ?>">
                    <input type="text" name="password" value="<?php echo $password; ?>">
                    <input type="file" name="image" id="image" accept=".jpg, .jpeg, .png">
                    <!-- Tombol "Update" dimasukkan ke dalam form -->
                    <button class="update" type="submit" name="update">Update</button>
                </div>
            <?php
            } else {
                echo "No user data found";
            }
            ?>
        </div>
    </form>
    <script type="text/javascript">
        document.getElementById("image").onchange = function() {
            document.getElementById("form").submit();
        };
    </script>
</body>

</html>
