<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Glowy</title>
    <link rel="stylesheet" href="../Beauty_E-Commerce/assets/css/bootstrap.min.css"> 
    <link rel="stylesheet" href="../Beauty_E-Commerce/assets/css/style.css">
    <link rel="stylesheet" href="../Beauty_E-Commerce//assets/css/style.map.css">
    <link href="../assets/css/font-awesome.min.css" rel="stylesheet" />

</head>
<body>
    <header>
    <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="header_top">
        <div class="container-fluid">
          <div class="top_nav_container">
            <div class="contact_nav">
              <a href="" style="text-decoration: none;">
                <i class="fa fa-phone" aria-hidden="true"></i>
                <span>
                  Call : +01 123455678990
                </span>
              </a>
              <a href="" style="text-decoration: none;">
                <i class="fa fa-envelope" aria-hidden="true"></i>
                <span>
                  Email : glowy@gmail.com
                </span>
              </a>
            </div>
            <div class="user_option_box">
              <a href="index.php?page=Profile" class="account-link" style="text-decoration: none;">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>
                  My Account
                </span>
              </a>
              <a href="index.php?page=cart" class="cart-link" style="text-decoration: none;">
                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                <span>
                  Cart
                </span>
              </a>
              <a href="../Beauty_E-Commerce/view/login.php" class="cart-link" style="text-decoration: none; background-color: #333; padding-inline:1rem; padding-top:0.5rem; padding-bottom:0.5rem; border-radius:2rem; font-weight:600;">
                <span>
                  LOGIN
                </span>
              </a>
            </div>
          </div>
          </div>
      </div>
    </header>
    <nav class="navbar navbar-expand sticky-top" style="background-color: #F8FF95;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Glowy<span>.</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.php?page=Home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=Shop">Shop</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=Riwayat">Riwayat Pemesanan</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="index.php?page=About">About</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div id="contents">
        <?php
          if (isset($_GET['page'])) {
            $page = $_GET['page'];
            switch ($page) {
                case 'Home':
                    include "../Beauty_E-Commerce/view/home.php";
                    break;
                case 'Shop':
                    include "../Beauty_E-Commerce/view/shop.php";
                    break;
                case 'Profile':
                    include "../Beauty_E-Commerce/view/profile.php";
                    break;
                case 'Checkout':
                    include "../Beauty_E-Commerce/view/checkout.php";
                    break;
                case 'Riwayat':
                    include "../Beauty_E-Commerce/view/riwayat.php"; // Perhatikan penulisan huruf besar dan kecil
                    break;
                case 'cart':
                    include "../Beauty_E-Commerce/view/cart.php";
                    break;
                case 'About':
                    include "../Beauty_E-Commerce/view/about.php";
                    break;
                default:
                    include "../Beauty_E-Commerce/view/home.php";
                    break;
            }
        } else {
            include "../Beauty_E-Commerce/view/home.php";
        }
        ?>
    </div>


    <footer>
         <div class="container">
            <div class="row">
               <div class="col-md-4">
                   <div class="full">
                      <div class="logo_footer">
                        <a href="#" style="align-items: center;"><img width="100" src="../Beauty_E-Commerce/assets/images/GLOWY.png" alt="#" style="align-items: center;" /></a>
                      </div>
                      <div class="information_f">
                        <p><strong>ADDRESS:</strong> KH.Wahid Hasyim, Samarinda, Indonesia</p>
                        <p><strong>TELEPHONE:</strong> +91 987 654 3210</p>
                        <p><strong>EMAIL:</strong> Glowy@gmail.com</p>
                      </div>
                   </div>
               </div>
               <div class="col-md-8">
                  <div class="row">
                  <div class="col-md-7">
                     <div class="row">
                        <div class="col-md-6">
                     <div class="widget_menu">
                        <h3>Menu</h3>
                        <ul>
                           <li><a href="index.php?page=Home">Home</a></li>
                           <li><a href="index.php?page=Shop">Shop</a></li>
                           <li><a href="index.php?page=Riwayat">Riwayat Pemesanan</a></li>
                           <li><a href="index.php?page=About">About Us</a></li>
                        </ul>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="widget_menu">
                        <h3>Account</h3>
                        <ul>
                           <li><a href="index.php?page=Profile">Account</a></li>
                           <li><a href="index.php?page=cart">Checkout</a></li>
                           <li><a href="../Beauty_E-Commerce/view/login.php">Login</a></li>
                           <li><a href="../Beauty_E-Commerce/view/register.php">Register</a></li>

                        </ul>
                     </div>
                  </div>
                     </div>
                  </div>     
                  <div class="col-md-5">
                     <div class="widget_menu">
                        <h3>Newsletter</h3>
                        <div class="information_f">
                          <p>Subscribe by our newsletter and get update protidin.</p>
                        </div>
                        <div class="form_sub">
                           <form>
                              <fieldset>
                                 <div class="field">
                                    <input type="email" placeholder="Enter Your Mail" name="email" />
                                    <input type="submit" value="Subscribe" />
                                 </div>
                              </fieldset>
                           </form>
                        </div>
                     </div>
                  </div>
                  </div>
               </div>
            </div>
         </div>
      </footer>


    <script src="../../assets/js/jquery.min.js"></script> <!-- Sesuaikan path ini dengan lokasi file jQuery di dalam folder assets/js -->
    <script src="../../assets/js/bootstrap.min.js"></script> <!-- Sesuaikan path ini dengan lokasi file JavaScript Bootstrap di dalam folder assets/js -->
</body>
</html>
