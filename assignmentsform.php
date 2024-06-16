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
   <Script>
    if(window.history.replaceState){
        window.history.replaceState(null, null, window.location.href );
    }
   </Script>

</head>
<body >
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
<h1 class="font-serif text-2xl md:text-6xl text-center text-blue-700 mt-6 mb-6 ">Assignments</h1>

<?php
// Checking if connection is working or not
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the delete button is clicked
if (isset($_POST['delete_id'])) {
    $delete_id = $_POST['delete_id'];
    // Query to delete the assignment with the given ID
    $delete_sql = "DELETE FROM studentassignments WHERE id = '$delete_id'";
    // Execute the delete query
    if (mysqli_query($conn, $delete_sql)) {
        // Redirect to the same page after deletion
        header("Location: ".$_SERVER['PHP_SELF']);
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }
}

// Output Form Entries from the Database
$sql = "SELECT id, classid, Title, Description, Date, Type, Image FROM studentassignments";
// Fire query
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) > 0) {
    echo '<div class="flex flex-wrap justify-center">';
    while ($row = mysqli_fetch_assoc($result)) {
        // Output MySQL data in HTML card format
        echo '<div class="w-96 mx-4 my-4 bg-white shadow-lg rounded-lg overflow-hidden">';
        echo '<div class="p-4">';
        echo '<h2 class="text-sm font-mono text-gray-800">ClassID:' . $row["classid"] . '</h2>';
        echo '<h2 class="text-2xl font-serif text-gray-800">' . $row["Title"] . '</h2>';
        echo '<p class="text-lg font-mono text-gray-600 mt-2">Date: ' . $row["Date"] . '</p>';
        echo '<p class="text-lg font-mono text-gray-600">Type: ' . $row["Type"] . '</p>';
        // Display Description with a "Show More" button
        echo '<div class="mt-2">';
        echo '<p class="text-lg font-mono text-gray-700">' . substr($row["Description"], 0, 100) . '...</p>';
        echo '<button class="text-indigo-600 font-semibold hover:text-indigo-800 focus:outline-none" onclick="showMore(`' . $row['Description'] . '`, this)">Show More</button>';
        echo '</div>';
        echo '<img class="w-full h-96 object-cover object-center rounded-lg mt-4" src="assignments_img/' . $row["Image"] . '" alt="Image">';
        
        echo '<div class="mt-4">';
        echo '<a href="assignments_img/' . $row["Image"] . '" download class="block bg-indigo-600 text-white font-serif py-2 px-4 rounded-md text-center transition duration-300 ease-in-out transform hover:bg-indigo-700 hover:scale-105">Download Image</a>';
        echo '<form method="post">';
        // Here's the correct placement of the form tag
        echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
        echo ' <button type="submit" class="w-full my-2 block bg-red-600 text-white font-serif py-2 px-4 rounded-md text-center transition duration-300 ease-in-out transform hover:bg-red-700 hover:scale-105">Delete</button>';
        echo '</form>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    // Display message if no files uploaded yet
    echo '<div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-4">';
    echo '<div class="p-4">';
    echo '<p class="text-gray-700">No files uploaded yet.</p>';
    echo '</div>';
    echo '</div>';
}


?>



<script>
    function showMore(description, button) {
        button.previousElementSibling.textContent = description;
        button.remove();
    }
</script>




<!-- insert form -->
<?php
if(isset($_POST['Insert'])){

   $Title = mysqli_real_escape_string($conn, $_POST['Title']);
   $Description = mysqli_real_escape_string($conn, $_POST['Description']);
   $Date = mysqli_real_escape_string($conn, ($_POST['Date']));
   $Type = mysqli_real_escape_string($conn,($_POST['Type']));
   $classidtype = mysqli_real_escape_string($conn,($_POST['classidtype']));
   
   // Handling file upload
   $image_name = $_FILES['Image']['name'];
   $image_tmp = $_FILES['Image']['tmp_name'];
   $image_type = $_FILES['Image']['type'];

   $insert = mysqli_query($conn, "INSERT INTO `studentassignments` (Title, Description, Date, Type, Image, classid) VALUES ('$Title', '$Description', '$Date', '$Type', '$image_name','$classidtype')") or die('query failed');

   // Move uploaded image to desired location
   move_uploaded_file($image_tmp, "assignments_img/$image_name");

}


?>
<section class="bg-white my-24">
    <div class="container flex items-center justify-center  px-6 mx-auto">
        <form class="w-full max-w-md" action="" method="post" enctype="multipart/form-data">
        
            <div class="flex justify-center mx-auto">
            <h1 class="text-3xl font-serif">UploadAssignments</h1>
            </div>
            
           
            <div class="relative flex items-center mt-8">
                <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-3 text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                  </svg>
                </span>

                <input type="text" name="Title"  required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="Title">
            </div>
          
            <div class="relative flex items-center mt-4">
                <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-3 text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                  </svg>
                </span>

                <input  type="text" name="Description"  required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="Description">
            </div>

            <div class="relative flex items-center mt-4">
                <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-3 text-blue-700">
                  <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 0 1 2.25-2.25h13.5A2.25 2.25 0 0 1 21 7.5v11.25m-18 0A2.25 2.25 0 0 0 5.25 21h13.5A2.25 2.25 0 0 0 21 18.75m-18 0v-7.5A2.25 2.25 0 0 1 5.25 9h13.5A2.25 2.25 0 0 1 21 11.25v7.5m-9-6h.008v.008H12v-.008ZM12 15h.008v.008H12V15Zm0 2.25h.008v.008H12v-.008ZM9.75 15h.008v.008H9.75V15Zm0 2.25h.008v.008H9.75v-.008ZM7.5 15h.008v.008H7.5V15Zm0 2.25h.008v.008H7.5v-.008Zm6.75-4.5h.008v.008h-.008v-.008Zm0 2.25h.008v.008h-.008V15Zm0 2.25h.008v.008h-.008v-.008Zm2.25-4.5h.008v.008H16.5v-.008Zm0 2.25h.008v.008H16.5V15Z" />
                </svg>
                </span>

                <input type="Date" name="Date"  required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="Date">
            </div>
            
            <!-- Image Upload Field -->
            <div class="relative flex items-center mt-4">
                <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-3 text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                  </svg>
                </span>

                <input type="file" name="Image" accept="image/*" class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="Image">
            </div>
            <!-- End of Image Upload Field -->
            
            <div class="relative flex items-center mt-4">
                <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-3 text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                  </svg>
                </span>

                <select type="Category" name="Type" required  class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="Type">
                      <option value="Precticel">Precticel</option>
                      <option value="Paper">Paper</option>
                </select>
            </div>
            <?php
    
    // checking if connection is working or not
    if(!$conn)
    {
        die("Connection failed!" . mysqli_connect_error());
    }

    // Output Form Entries from the Database
    $sql = "SELECT classId FROM class";
    // fire query
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result) > 0) {
        echo '
        <div class="relative flex items-center mt-4">
            <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-3 text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 7.5h1.5m-1.5 3h1.5m-7.5 3h7.5m-7.5 3h7.5m3-9h3.375c.621 0 1.125.504 1.125 1.125V18a2.25 2.25 0 0 1-2.25 2.25M16.5 7.5V18a2.25 2.25 0 0 0 2.25 2.25M16.5 7.5V4.875c0-.621-.504-1.125-1.125-1.125H4.125C3.504 3.75 3 4.254 3 4.875V18a2.25 2.25 0 0 0 2.25 2.25h13.5M6 7.5h3v3H6v-3Z" />
                </svg>
            </span>
            <select type="classidtype" name="classidtype" required  class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="Type">
        ';
    
        foreach($result as $row) {
            // output each classId once
            echo '<option value="' . $row["classId"] . '">' . $row["classId"] . '</option>';       
        }
    
        echo '</select></div>';
    } else {
        echo '<p class="text-center text-xl font-serif">NO DATA FOUND</p>';
    }
    

    // closing connection
   
?>
            
            <div class="mt-12">
                <button type="submit" name="Insert" value="Insert Record" class="w-full px-6 py-3 text-2xl font-serif tracking-wide text-white hover:text-white capitalize transition-colors duration-300 transform bg-blue-700 rounded-lg hover:bg-blue-900">
                    Insert
                </button>
            </div>
            
        </form>
    </div>
</section>

?>
</body>
</html>
