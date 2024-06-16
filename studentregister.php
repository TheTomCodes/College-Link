<?php

include 'config.php';

if(isset($_POST['submit'])){

   $name = mysqli_real_escape_string($conn, $_POST['name']);
   $email = mysqli_real_escape_string($conn, $_POST['email']);
   $pass = mysqli_real_escape_string($conn, md5($_POST['password']));
   $cpass = mysqli_real_escape_string($conn, md5($_POST['cpassword']));
   $image = $_FILES['image']['name'];
   $image_size = $_FILES['image']['size'];
   $image_tmp_name = $_FILES['image']['tmp_name'];
   $image_folder = 'uploaded_img/'.$image;

   $select = mysqli_query($conn, "SELECT * FROM `student_form` WHERE email = '$email' AND password = '$pass'") or die('query failed');

   if(mysqli_num_rows($select) > 0){
      $message[] = 'user already exist'; 
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }elseif($image_size > 2000000){
         $message[] = 'image size is too large!';
      }else{
         $insert = mysqli_query($conn, "INSERT INTO `student_form`(name, email, password, image) VALUES('$name', '$email', '$pass', '$image')") or die('query failed');

         if($insert){
            move_uploaded_file($image_tmp_name, $image_folder);
            $message[] = 'registered successfully!';
            header('location:studentregister.php');
         }else{
            $message[] = 'registeration failed!';
         }
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title >My Library</title>
    
   <!-- custom css file link  -->
   
   <script src="https://cdn.tailwindcss.com"></script>
   <Script>
    if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href );
    }
   </Script>
</head>
<body >
    

   

<section class="bg-white">
    <div class="container flex items-center justify-center min-h-screen px-6 mx-auto">
        <form class="w-full max-w-md" action="" method="post" enctype="multipart/form-data">
        
            <div class="flex justify-center mx-auto">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-indigo-700 ">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18.5A2.5 2.5 0 0 1 7.5 20h0a2.5 2.5 0 0 1-2.4-3.2 3 3 0 0 1-.8-5.2 2.5 2.5 0 0 1 .9-3.2A2.5 2.5 0 0 1 7 5a2.5 2.5 0 0 1 5 .5m0 13v-13m0 13a2.5 2.5 0 0 0 4.5 1.5h0a2.5 2.5 0 0 0 2.4-3.2 3 3 0 0 0 .9-5.2 2.5 2.5 0 0 0-1-3.2A2.5 2.5 0 0 0 17 5a2.5 2.5 0 0 0-5 .5m-8 5a2.5 2.5 0 0 1 3.5-2.3m-.3 8.6a3 3 0 0 1-3-5.2M20 10.5a2.5 2.5 0 0 0-3.5-2.3m.3 8.6a3 3 0 0 0 3-5.2"/>
            </svg>
            </div>
            
            <div class="flex items-center justify-center mt-12">
                <a href="studentregister.php" class=" w-1/3 pb-4 font-serif text-xl text-center text-blue-700 capitalize border-b-2 border-gray-900 hover:border-blue-700">
                    sign up
                </a>
            </div>
            <div class="relative flex items-center mt-8">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                    </svg>
                </span>

                <input type="text" name="name"  required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="Username">
            </div>
            <label for="dropzone-file" class="flex items-center px-3 py-4 mx-auto mt-4 text-center bg-white border-2 border-blue-700 rounded-lg cursor-pointer ">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12" />
                </svg>

                <h2 class="mx-3 text-gray-400 font-serif text-xl">Profile Photo</h2>

                <input type="file" name="image"  accept="image/jpg, image/jpeg, image/png" id="dropzone-file"  class="hidden" />
            </label>
            <div class="relative flex items-center mt-4">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                    </svg>
                </span>

                <input  type="email" name="email"  required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="Email address">
            </div>

            <div class="relative flex items-center mt-4">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>

                <input type="password" name="password"  required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="Password">
            </div>
            <div class="relative flex items-center mt-4">
                <span class="absolute">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 mx-3 text-blue-700" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                    </svg>
                </span>

                <input type="password" name="cpassword"  required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="ConfigPassword">
            </div>
           
            <div class="mt-12">
                <button type="submit" name="submit" value="register now" class="w-full px-6 py-3 text-2xl font-serif tracking-wide text-white hover:text-white capitalize transition-colors duration-300 transform bg-blue-700 rounded-lg hover:bg-blue-900">
                    Sign Up
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
<section class="px-4 sm:px-6 lg:px-8">
    <?php 
    // Database connection
    
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Check if the form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_student'])) {
        // Process delete operation
        $student_id = $_POST['student_id'];
        $sql = "DELETE FROM `student_form` WHERE `id` = $student_id";
        if (mysqli_query($conn, $sql)) {
            echo '<div class="text-green-600">Student record deleted successfully.</div>';
        } else {
            echo '<div class="text-red-600">Error deleting student record: ' . mysqli_error($conn) . '</div>';
        }
    }

    $sql = "SELECT * FROM `student_form`";
    $result = mysqli_query($conn, $sql);
    ?>
    <div class="max-w-7xl mx-auto py-8">
        <h1 class="text-4xl font-serif text-center mb-6">All Student Information</h1>
        
        <?php if (mysqli_num_rows($result) > 0): ?>
        <div class="overflow-x-auto">
            <table class="w-full table-auto border-collapse">
                <thead>
                    <tr class="bg-blue-700 text-white font-serif text-xl">
                        <th class="px-4 py-2">Name</th>
                        <th class="px-4 py-2">Email</th>
                        <th class="px-4 py-2">Profile Image</th>
                        <th class="px-4 py-2">Actions</th> <!-- New column for actions -->
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr class="font-mono text-lg">
                        <td class="border border-gray-400 px-4 py-2"><?php echo $row['name']; ?></td>
                        <td class="border border-gray-400 px-4 py-2"><?php echo $row['email']; ?></td>
                        <td class="border border-gray-400 px-4 py-2 flex justify-center items-center">
                            <img src="uploaded_img/<?php echo $row['image']; ?>" alt="Student Image" class="w-20 h-20 object-cover rounded-full border-2 border-indigo-700">
                        </td>
                        <td class="border border-gray-400 px-4 py-2">
                            <form method="post">
                                <input type="hidden" name="student_id" value="<?php echo $row['id']; ?>">
                                <button type="submit" name="delete_student" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
        <?php else: ?>
        <p class="text-center">No students found.</p>
        <?php endif; ?>
    </div>
</section>


</body>
</html>