<?php 
require_once("../koneksi/koneksi.php");

if(isset($_POST['login'])){
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);

    // Buat query SQL
    $sql = "SELECT * FROM user WHERE username=? AND password=?";
    
    // Siapkan statement SQL
    $stmt = $conn->prepare($sql);

    // Bind parameter ke query
    $stmt->bind_param("ss", $username, $password);

    // Eksekusi query
    try {
        $stmt->execute();
    } catch (mysqli_sql_exception $e) {
        // Tangani kesalahan database
        echo "Error: " . $e->getMessage();
        exit; // Hentikan eksekusi script
    }

    // Ambil hasil query
    $result = $stmt->get_result();

    // Ambil data hasil query
    $user = $result->fetch_assoc();

    // Jika user terdaftar
    if($user){
        session_start();
        $_SESSION["user"] = $user;
        // Login sukses, alihkan ke halaman timeline
        header("Location: ../index.php?page=Home");
        exit; // Hentikan eksekusi script setelah redirect
    } else {
        // Password salah
        echo "<script>alert('Username atau password Anda salah. Silakan coba lagi!')</script>";
    }
} else {
    // User tidak ditemukan
    echo "<script>alert('Username atau email tidak terdaftar. Silakan coba lagi!')</script>";
}

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
</head>
<body>
    <div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<div class="booking-bg">
							<div class="form-header">
								<h2>LOGIN</h2>
								<p>Nikmati perjalanan kuliner yang tak terlupakan dengan mereservasi di Seoul Flavor. Jadikan momen bersama keluarga, teman, atau rekan bisnis Anda lebih istimewa dengan hidangan-hidangan lezat kami yang dipenuhi dengan aroma dan rasa Korea yang autentik.</p>
							</div>
						</div>
						<form action="" method="POST">
                            <div class="mb-3">
                                <div class="form-group">
									<input name="username" type="text" class="form-control" placeholder="username" maxlength = "50" required>
								</div>
							</div>
							<div class="mb-3">
                                <div class="form-group">
								    <input name="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="password" maxlength = "50" required>
                                </div>
							</div>

							<div class="form-btn">
								<button name="login" class="submit-btn">Login</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>  
</body>
</html>