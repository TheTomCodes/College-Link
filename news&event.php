<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];

if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:userlogin.php');
};
$classId = $_SERVER['QUERY_STRING'];
if(isset($_GET['classId'])) {
    // Retrieve the value of the classId parameter
    $classId = $_GET['classId'];
} else {
    echo "No classId parameter found in the URL.";
    header('location:index.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Database Records</title>
    
</head>
<body>
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
      <h1 class="font-serif text-2xl md:text-6xl text-center text-blue-700 mt-6 mb-6">News & Event</h1>
      <?php
// checking if connection is working or not
if(!$conn) {
    die("Connection failed!" . mysqli_connect_error());
}

// Output Form Entries from the Database
$sql = "SELECT id, Title, Description, Date, Type, Image FROM news_event WHERE classId = $classId";
// fire query
$result = mysqli_query($conn, $sql);
if(mysqli_num_rows($result) > 0) {
    echo '<div class="flex flex-wrap justify-center">';
    while($row = mysqli_fetch_assoc($result)) {
        // to output mysql data in HTML card format
        echo '<div class="max-w-md mx-4 my-4 bg-white shadow-lg rounded-lg overflow-hidden">';
        echo '<div class="p-6">';
        echo '<h2 class="text-2xl font-serif text-gray-800">'.$row["Title"].'</h2>';
        echo '<p class=" text-lg font-mono text-gray-600 mt-2 ">Date: ' . $row["Date"].'</p>';
        echo '<p class=" text-lg font-mono text-gray-600 mb-4 ">Type: ' . $row["Type"].'</p>';
        
        // Display Description with a "Show More" button
        echo '<div class="mt-2">';
        echo '<p class="text-lg font-mono text-gray-700">' . substr($row["Description"], 0, 100) . '...</p>';
        echo '<button class="text-indigo-600 font-semibold hover:text-indigo-800 focus:outline-none" onclick="showMore(`' . $row['Description'] . '`, this)">Show More</button>';
        echo '</div>';

        // Displaying the image if available
        if(!empty($row["Image"])) {
            echo '<img src="newsimage_img/' . $row["Image"] . '" alt="Image" class="w-full h-96 mb-4 rounded-lg border-2 border-black">';
        }

        echo '<div class="flex justify-end">';
        echo '<a href="newsimage_img/' . $row["Image"] . '" download class="block bg-indigo-600 text-white font-serif py-2 px-4 rounded-md text-center transition duration-300 ease-in-out transform hover:bg-indigo-700 hover:scale-105">Download Image</a>';
        echo '</div>';
        echo '</div>';
        echo '</div>';
    }
    echo '</div>';
} else {
    echo ' <div class="max-w-md mx-auto bg-white shadow-lg rounded-lg overflow-hidden my-4">
    <div class="p-4">
    <p class="text-gray-700">No files uploaded yet.</p>
    </div>
    </div>';
}
// closing connection
mysqli_close($conn);
?>

<script>
    function showMore(description, button) {
        button.previousElementSibling.textContent = description;
        button.remove();
    }
</script>



</body>
</html>



