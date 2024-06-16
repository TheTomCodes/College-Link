<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_POST['update_profile'])){

   $Type = mysqli_real_escape_string($conn, $_POST['Usertype']);
  {
         mysqli_query($conn, "UPDATE `user_form`  WHERE id = '$user_id'") or die('query failed');
         $message[] = 'password updated successfully!';
      }
   }

  


?>

<!DOCTYPE html>
<html lang="en">
<head>
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
<?php
      $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
      if(mysqli_num_rows($select) > 0){
         $fetch = mysqli_fetch_assoc($select);
      }
   ?>
     
    <div class="container flex items-center justify-center min-h-screen px-6 mx-auto">
        <form class="w-full max-w-md" action="" method="post" enctype="multipart/form-data">
       
            
            <div class="flex justify-center">
            <div class="relative flex justify-center items-center mt-6">
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
           </div>
             <!-- End of Image Upload Field -->
            
             <div class="relative flex items-center mt-4">
                <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-3 text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                  </svg>
                </span>

                <select type="Category" name="Type" required  class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="Type">
                      <option value="user">User</option>
                      <option value="admin">Admin</option>
                </select>
            </div>
            <div class="mt-12">
                <button type="submit" value="update profile" name="update_profile" class="w-full px-6 py-3 text-2xl font-serif tracking-wide text-white hover:text-white capitalize transition-colors duration-300 transform bg-blue-700 rounded-lg hover:bg-blue-900">
                    Update Profile
                </button>  
                          
            </div>
            <div class="mt-6 mb-6">
                <button type="submit" value="update profile" name="update_profile" class="w-full px-6 py-3 text-2xl font-serif tracking-wide text-white hover:text-white capitalize transition-colors duration-300 transform bg-blue-700 rounded-lg hover:bg-blue-900"><a href="home.php" >
                Go Back
                </a>
                </button>  
                          
            </div>
            
            
           
            
           <?php 
           if(isset($message)){
            foreach($message as $message){
               echo '<div class="font-serif text-xl text-gray-700 ">'.$message.'</div>';
            }
         }
           ?>
          
            
      </form>
   </div>
</section>


</body>
</html>