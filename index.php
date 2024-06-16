<?php

include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];
if($_SESSION['user_id']== null)
{
    header('location:user&admin.php');
}

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:userlogin.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    <title>Document</title>
</head>
<body class="bg-white">
   

<nav class="border-y-8 border-y-2 p-auto border-indigo-700 border-double  rounded-lg">
    <div class="w-full flex flex-wrap items-center justify-between mx-auto p-2">
    <a href="index.php" class="flex items-center space-x-3 rtl:space-x-reverse">
     <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-12 h-12 text-indigo-700 ">
     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18.5A2.5 2.5 0 0 1 7.5 20h0a2.5 2.5 0 0 1-2.4-3.2 3 3 0 0 1-.8-5.2 2.5 2.5 0 0 1 .9-3.2A2.5 2.5 0 0 1 7 5a2.5 2.5 0 0 1 5 .5m0 13v-13m0 13a2.5 2.5 0 0 0 4.5 1.5h0a2.5 2.5 0 0 0 2.4-3.2 3 3 0 0 0 .9-5.2 2.5 2.5 0 0 0-1-3.2A2.5 2.5 0 0 0 17 5a2.5 2.5 0 0 0-5 .5m-8 5a2.5 2.5 0 0 1 3.5-2.3m-.3 8.6a3 3 0 0 1-3-5.2M20 10.5a2.5 2.5 0 0 0-3.5-2.3m.3 8.6a3 3 0 0 0 3-5.2"/>
     </svg>
        <span class="self-center text-3xl font-serif  text-indigo-700">College Link</span>
    </a>

    
    
<div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
    <button type="button" class="flex text-sm rounded-full" id="user-menu-button" aria-expanded="false" data-dropdown-toggle="user-dropdown" data-dropdown-placement="bottom">
        <span class="sr-only">Open user menu</span>
        <div class="relative flex justify-center items-center">
            <div class="h-10 w-10 border border-y-2 rounded-xl border-indigo-700 animate-spin absolute"></div>
                        
                            <?php
                              $select = mysqli_query($conn, "SELECT * FROM `student_form` WHERE id = '$user_id'") or die('query failed');
                              if(mysqli_num_rows($select) > 0){
                               $fetch = mysqli_fetch_assoc($select);
                                }
                              if($fetch['image'] == ''){
                              echo '<img src="images/default-avatar.png">';
                              }else{
                               echo '<img src="uploaded_img/'.$fetch['image'].'" class="rounded-full w-8 md:w-10 border-2 border-indigo-700" ">';
                              }
                         ?>
                     </button>
    <!-- Dropdown menu -->
    <div class="w-96 z-50 hidden my-4 text-base bg-white border-4 border-indigo-700 border-dashed divide-y divide-gray-100 rounded-lg shadow" id="user-dropdown">
        <ul class="py-2" aria-labelledby="user-menu-button">
            <li>
                <a href="#" class="block px-4 py-2 text-lg font-serif text-black"><?php echo $fetch['name']; ?></a>
            </li>
            <li>
                <a href="#" class="block px-4 py-2 text-lg font-serif text-black"><?php echo $fetch['email']; ?></a>
            </li>
            <li>
            <a href="userlogout.php" class="block px-4 py-2 md:text-xl text-sm text-indigo-700 hover:text-white hover:bg-indigo-700 font-serif ">Sign out</a>
            </li>
        </ul>
    </div>
</div>
        
</nav>
<header class="bg-white md:h-screen">
    <div class="container mx-auto md:h-full">
        <div class="items-center flex justify-center md:h-full"> <!-- Added justify-center class -->
            <div class="w-full md:w-1/2">
                <div class="md:max-w-4xl">
                    <h1 class="text-3xl font-serif text-indigo-700 text-xl md:text-8xl mb-4">College Link</h1>
                    <p class="font-serif text-gray-700 text-sm md:text-3xl text-start">helps educators create engaging learning experiences they can personalize, manage, and measure.</p>
                </div>
            </div>
            <div class="flex items-center justify-center w-full mt-6 lg:mt-0 lg:w-1/2">
                <img class="w-full h-full lg:max-w-3xl" src="myimage_img/ClassRoom.svg" alt="Catalogue-pana.svg">
            </div>
        </div>
    </div>
</header>

<?php
    
    // checking if connection is working or not
    if(!$conn)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // Output Form Entries from the Database
    $sql = "SELECT * FROM class";
    // fire query
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0)
    {
        echo '<section class="text-gray-700 body-font">';
        echo '<div class="container px-5 py-24 mx-auto">';
        // Apply flexbox properties to center the flex items
        echo '<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">';
       
        while($row = mysqli_fetch_assoc($result)){
            // to output mysql data in HTML card format
            
            echo '<div class="bg-indigo-700 p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">';
            echo '<a href="viewdata.php?classId=' . $row["classId"] . '">';
            echo '<img class=" bg-white h-64 w-full object-cover object-center rounded-lg mb-4" src="myimage_img/ClassRoom.svg" alt="class image">';
            echo '<div class="p-2">';
            echo '<h2 class="text-xl font-serif text-white text-center">' . $row["techerName"] . '</h2>';
            echo '<p class="text-sm font-serif text-white text-center">' . $row["className"] . '</p>';
            echo '</div>';
            echo '</a>';
            echo '</div>';
            
        }
        
        echo '</div>';
        echo '</div>';
        echo '</section>';
    }
    else
    {
        echo '<p class="text-center text-xl font-serif">NO DATA FOUND</p>';
    }
    // closing connection
    mysqli_close($conn);
?>



</body>
</html>