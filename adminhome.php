<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];



if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
};

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
    

</head>
<body class="bg-white">




<div class="mt-44">

    <!-- Card start -->
        <div class="max-w-sm mx-auto bg-white  border-2 border-blue-700 rounded-lg overflow-hidden shadow-2xl">
            <div class=" px-4 pb-6">
                <div class="text-center my-4">
                  <div class="relative flex justify-center items-center">
                        <div class="absolute animate-spin rounded-full h-36 w-36 border-t-2 border-b-2 border-blue-700"></div>
                            <?php
                              $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
                              if(mysqli_num_rows($select) > 0){
                               $fetch = mysqli_fetch_assoc($select);
                                }
                              if($fetch['image'] == ''){
                              echo '<img src="images/default-avatar.png">';
                              }else{
                               echo '<img src="uploaded_img/'.$fetch['image'].'" class="rounded-full w-32" ">';
                              }
                         ?>
                     </div>
                    <div class="py-2">
                    <div class=" font-serif text-2xl text-black"><?php echo $fetch['name']; ?></div>
                    <div class=" font-serif text-xl text-black"><?php echo $fetch['email']; ?></div>
                    </div>
                </div>
                <div class="flex gap-2 px-2">
                    <button 
                        class=" w-full px-6 py-3 text-sm font-serif tracking-wide text-white text-white capitalize transition-colors duration-300 transform bg-blue-700 rounded-lg hover:bg-blue-900"><a href="update_profile.php">
                        Update Profile</a>
                    </button>
                    <button
                        class=" w-full px-6 py-3 text-sm font-serif tracking-wide text-white text-white capitalize transition-colors duration-300 transform bg-blue-700 rounded-lg hover:bg-blue-900"><a href="adminindex.php">
                        Get Start
                    </button>
                </div>
            </div>
            
        </div>
    

</div>

<!--footer-->


</body>
</html>