<?php

require_once("../koneksi/koneksi.php");

if(isset($_POST['regis'])){

    $first_name = filter_input(INPUT_POST, 'first_name', FILTER_SANITIZE_STRING);
    $last_name = filter_input(INPUT_POST, 'last_name', FILTER_SANITIZE_STRING);
    $username = filter_input(INPUT_POST, 'username', FILTER_SANITIZE_STRING);
    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
    $password = filter_input(INPUT_POST, 'password', FILTER_UNSAFE_RAW);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);


    // menyiapkan query
    $sql = "INSERT INTO user (first_name, last_name, username, email, gender, password) 
            VALUES (:first_name, :last_name, :username,  :email, :gender, :password)";
    $stmt = $conn->prepare($sql);

    // bind parameter ke query
    $params = array(
        ":first_name" => $first_name,
        ":last_name" => $last_name,
        ":username" => $username,
        ":email" => $email,
        ":gender" => $gender,
        ":password" => $password
    );

    // eksekusi query untuk menyimpan ke database
    $saved = $stmt->execute($params);

    // jika query simpan berhasil, maka user sudah terdaftar
    // maka alihkan ke halaman login
    if($saved) header("Location: login.php");
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="http://fonts.googleapis.com/css?family=Playfair+Display:900" rel="stylesheet" type="text/css" />
	<link href="http://fonts.googleapis.com/css?family=Alice:400,700" rel="stylesheet" type="text/css" />
    <link type="text/css" rel="stylesheet" href="../assets/css/bootstrap.min.css" />
	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="../assets/css/style.css" />
</head>
<body>
    <div id="booking" class="section">
		<div class="section-center">
			<div class="container">
				<div class="row">
					<div class="booking-form">
						<div class="booking-bg">
							<div class="form-header">
								<h2>Make your reservation</h2>
								<p>Nikmati perjalanan kuliner yang tak terlupakan dengan mereservasi di Seoul Flavor. Jadikan momen bersama keluarga, teman, atau rekan bisnis Anda lebih istimewa dengan hidangan-hidangan lezat kami yang dipenuhi dengan aroma dan rasa Korea yang autentik.</p>
							</div>
						</div>
						<form action="" method="POST">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="first_name" type="text" class="form-control" placeholder="First Name" maxlength = "50" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <input name="last_name" type="text" class="form-control" placeholder="Last Name" maxlength = "50" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
									<input name="username" type="text" class="form-control" placeholder="Username" maxlength = "50" required>
								</div>
							</div>
							<div class="mb-3">
                                <div class="form-group">
								    <input name="email" type="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com" maxlength = "50" required>
                                </div>
							</div>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<select name="gender" class="form-control">
											<option>Female</option>
											<option>Male</option>
											<option>Other</option>
										</select>
										<span class="select-arrow"></span>
									</div>
								</div>
                            </div>
                            <div class="mb-3">
                                <div class="form-group">
								    <input name="password" type="password" class="form-control" id="exampleFormControlInput1" placeholder="Password" maxlength = "50" minlength="5" required>
                                </div>
							</div>


							<div class="form-btn">
								<button name="regis" class="submit-btn">Register Now</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

    
    <script src="../../assets/js/jquery.min.js"></script> <!-- Sesuaikan path ini dengan lokasi file jQuery di dalam folder assets/js -->
    <script src="../../assets/js/bootstrap.min.js"></script> <!-- Sesuaikan path ini dengan lokasi file JavaScript Bootstrap di dalam folder assets/js -->
</body>
</html>