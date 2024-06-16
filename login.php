<?php

include 'config.php';
session_start();

if(isset($_POST['submit'])){
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $password = mysqli_real_escape_string($conn, $_POST['password']);
   $encrypted_password = md5($password);

   $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE email = '$email' AND password = '$encrypted_password'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $row = mysqli_fetch_assoc($select);
      $_SESSION['user_id'] = $row['id'];
       if($row["Usertype"] == "admin") {
        $_SESSION['user_id'] = $row['id'];
           header('location:adminhome.php');
      }
   } else{
      $message[] = 'Incorrect email or password!';
   }
}



?>


<!-- Your HTML login form here -->


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >My Library</title>
    
   <!-- custom css file link  -->
   
   <script src="https://cdn.tailwindcss.com"></script>

</head>
<body class="">
     




<section class="bg-white">
    <div class="container flex items-center justify-center min-h-screen px-6 mx-auto">
        <form class="w-full max-w-md" action="#" method="POST" enctype="multipart/form-data">
        
            <div class="flex justify-center mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-indigo-700 ">
                   <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18.5A2.5 2.5 0 0 1 7.5 20h0a2.5 2.5 0 0 1-2.4-3.2 3 3 0 0 1-.8-5.2 2.5 2.5 0 0 1 .9-3.2A2.5 2.5 0 0 1 7 5a2.5 2.5 0 0 1 5 .5m0 13v-13m0 13a2.5 2.5 0 0 0 4.5 1.5h0a2.5 2.5 0 0 0 2.4-3.2 3 3 0 0 0 .9-5.2 2.5 2.5 0 0 0-1-3.2A2.5 2.5 0 0 0 17 5a2.5 2.5 0 0 0-5 .5m-8 5a2.5 2.5 0 0 1 3.5-2.3m-.3 8.6a3 3 0 0 1-3-5.2M20 10.5a2.5 2.5 0 0 0-3.5-2.3m.3 8.6a3 3 0 0 0 3-5.2"/>
            </svg>
            </div>
            
            <div class="flex items-center justify-center mt-12">
                <a href="login.php" class="w-1/3 pb-4 font-serif text-xl text-center text-blue-700 capitalize border-b-2 border-gray-900 hover:border-blue-700 ">
                    sign In
                </a>
                <a href="register.php" class=" w-1/3 pb-4 font-serif text-xl text-center text-blue-700 capitalize border-b-2 border-gray-900 hover:border-blue-700">
                    sign up
                </a>
            </div>

            
            <div class="relative flex items-center mt-8">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>

                <input  type="email" name="email"  required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11 " placeholder="Email address">
            </div>

            <div class="relative flex items-center mt-4">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>

                <input type="password" name="password"  required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11 " placeholder="Password">
            </div>

           
            <div class="mt-12">
                <button type="submit" name="submit" value="login now" class="w-full px-6 py-3 text-2xl font-serif tracking-wide text-white hover:text-white capitalize transition-colors duration-300 transform bg-blue-700 rounded-lg hover:bg-blue-900">
                    Sign In
                </button>
                

               
            </div>
            <?php
      if(isset($message)){
         foreach($message as $message){
            echo '<div class="message">'.$message.'</div>';
         }
      }
      ?>
        </form>
    </div>
</section>




</body>
</html>