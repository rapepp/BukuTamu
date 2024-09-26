<?php
session_start();

if (isset($_SESSION['login'])) {
    header('location:index.php');
    exit;
}

require 'function.php';

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $result = mysqli_query($koneksi, "SELECT * FROM user WHERE username = '$username'");

    $cek = mysqli_num_rows($result);

    if ($cek > 0) {
        $_SESSION['login'] = true;

        if (isset($_POST['remember'])) {
      
            setcookie('id', $row['id'], time() + 60);

           
            setcookie('key', hash('sha256', $row['username']), time() + 60);
        }

        header('location:index.php');
        exit;
    }
 
    $error = true;  
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     
     <link rel="icon" href="img/bg/logo.png" type="image/x-icon">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
  
     <link rel="preconnect" href="https://fonts.gstatic.com">
     <link href="https://fonts.googleapis.com/css2?family=Righteous&display=swap" rel="stylesheet">
    
     <link rel="stylesheet" href="css/login.css">

     <title>From Login</title>
</head>

<body background="img/bg/bg.jpg">

   <div class="container">
  <div class="row my-5">
    <div class="col-md-6 text-center login" style="background-color: rgba(102, 193, 250, 0.7); backdrop-filter: blur(10px); border-radius: 10px;">
      <h4 class="fw-bold" style="color: white;">Login</h4>

                   
                    <?php if (isset($error)) : ?>
                    <?php echo '<script>alert("Username atau Password Salah!");</script>'; ?>
                    <?php endif; ?>
                    <form action="" method="post">
                         <div class="form-group user " > 
                              <input type="text" class="form-control w-50 " placeholder="Masukkan Username"
                                   name="username" autocomplete="off" required>
                         </div>
                         <div class="form-group my-5">
                              <input type="password" class="form-control w-50" placeholder="Masukkan Password"
                                   name="password" autocomplete="off" required>
                         </div>
                         <style>
                              .btn-check:checked + .btn-outline-primary {
                              background-color: #00FF00;
                              border-color: #00FF00;
                              color: #fff; 
                              }
                              
                              .btn-check:not(:checked) + .btn-outline-primary:hover {
                              background-color: lime;
                              border-color: lime;
                              color: #fff; 
                              }
                         </style>
                         <div class="btn-group" role="group" aria-label="Basic checkbox toggle button group">
                              <input type="checkbox" class="btn-check" name="remember" id="remember" autocomplete="off">
                              <label class="btn btn-outline-primary" for="remember">Remember Me</label>

                         </div>
                         <div>
                         <button class="btn btn-primary text-uppercase" type="submit" name="login">Login</button>
                         <a href="registrasi.php" class="btn btn-danger text-uppercase"><i
                                   class="bi bi-pencil-square"></i>SIGN UP</a> 

                         </div>
                         
                    </form>
               </div>
          </div>
     </div>




     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous">
     </script>
</body>

</html>
