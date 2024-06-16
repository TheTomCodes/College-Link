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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
   <Script>
    if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href );
    }
   </Script>
</head>
<body>
<nav class="border-y-8 border-y-2 p-auto border-indigo-700 border-double  rounded-lg">
    <div class="w-full flex flex-wrap items-center justify-between mx-auto p-2">
    <a href="adminindex.php" class="flex items-center space-x-3 rtl:space-x-reverse">
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
                              $select = mysqli_query($conn, "SELECT * FROM `user_form` WHERE id = '$user_id'") or die('query failed');
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
            <a href="logout.php" class="block px-4 py-2 md:text-xl text-sm text-indigo-700 hover:text-white hover:bg-indigo-700 font-serif ">Sign out</a>
            </li>
        </ul>
    </div>
</div>
        
</nav>
<h1 class="font-serif text-2xl md:text-6xl text-center text-blue-700 mt-6 mb-6 ">Add Class</h1>

    <!-- insert form -->
<?php
if(isset($_POST['Insert'])){

   $techerName = mysqli_real_escape_string($conn, $_POST['techerName']);
   $className = mysqli_real_escape_string($conn,($_POST['className']));
   
   

   $insert = mysqli_query($conn, "INSERT INTO `class` (techerName, className) VALUES ('$techerName', '$className')") or die('query failed');

  

}


?>
<section class="bg-white my-24">
    <div class="container flex items-center justify-center  px-6 mx-auto">
        <form class="w-full max-w-md" action="" method="post" enctype="multipart/form-data">
        
            <div class="flex justify-center mx-auto">
            <h1 class="text-3xl font-serif">AddNewClass</h1>
            </div>
            
           
            <div class="relative flex items-center mt-8">
                <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-3 text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                  </svg>
                </span>

                <input type="text" name="techerName"  required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="TecherName">
            </div>
            <div class="relative flex items-center mt-8">
                <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-3 text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                  </svg>
                </span>

                <input type="text" name="className"  required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="ClassName">
            </div>
                      
           
            
            <div class="mt-12">
                <button type="submit" name="Insert" value="Insert Record" class="w-full px-6 py-3 text-2xl font-serif tracking-wide text-white hover:text-white capitalize transition-colors duration-300 transform bg-blue-700 rounded-lg hover:bg-blue-900">
                    Insert
                </button>
            </div>
            
        </form>
    </div>
</section>
<?php
    // Start output buffering to prevent headers sent error
    ob_start();
    
    // checking if connection is working or not
    if(!$conn)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // Check if delete request is sent
    if(isset($_POST['delete_class_id'])) {
        // Sanitize the input to prevent SQL injection
        $delete_class_id = mysqli_real_escape_string($conn, $_POST['delete_class_id']);
        
        // SQL to delete a record
        $sql = "DELETE FROM class WHERE classId='$delete_class_id'";
        
        // Attempt to execute the query
        if(mysqli_query($conn, $sql)) {
            // Refresh the page after deletion
           
            exit();
        } else {
            // If deletion fails, display an error message
            echo "Error deleting record: " . mysqli_error($conn);
        }
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
            
            echo '<img class=" bg-white h-64 w-full object-cover object-center rounded-lg mb-4" src="myimage_img/ClassRoom.svg" alt="class image">';
            echo '<div class="p-2">';
            echo '<h2 class="text-xl font-serif text-white text-center">' . $row["techerName"] . '</h2>';
            echo '<p class="text-sm font-serif text-white text-center">' . $row["className"] . '</p>';
            echo '<p class="text-sm font-serif text-white text-center">' . $row["classId"] . '</p>';
            
            // Add delete button within a form
            echo '<form method="POST" action="">';
            echo '<input type="hidden" name="delete_class_id" value="' . $row["classId"] . '">';
            echo '<button type="submit" class="text-white bg-red-500 px-3 py-1 rounded-lg">Delete</button>';
            echo '</form>';
            
            echo '</div>';
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

    // Flush output buffer and turn off buffering
    ob_end_flush();
?>


</body>
</html>