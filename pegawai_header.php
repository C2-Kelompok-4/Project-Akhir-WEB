<?php
if(isset($message)){
   foreach($message as $message){
      echo '
      <div class="message">
         <span>'.$message.'</span>
         <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
      </div>
      ';
   }
}
?>

<header class="header">

   <div class="flex">

      <a href="pegawai_page.php" class="logo">Staff<span> 4Your Phone</span></a>

      <nav class="navbar">
         <a href="pegawai_page.php">Home</a>
         <a href="pegawai_orders.php">Orders</a>
      </nav>

      <div class="icons">
         <div id="menu-btn" class="fas fa-bars"></div>
         <div id="user-btn" class="fas fa-user"></div>
      </div>

      <div class="account-box">
         <p>Username : <span><?php echo $_SESSION['staff_name']; ?></span></p>
         <p>Email : <span><?php echo $_SESSION['staff_email']; ?></span></p>
         <a href="logout.php" class="delete-btn">Logout</a>
         <div><a href="login.php">Login</a> | <a href="register.php">Register</a></div>
      </div>

   </div>

</header>