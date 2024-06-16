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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <a href="logout.php" class="block px-4 py-2 md:text-xl text-sm text-indigo-700 hover:text-white hover:bg-indigo-700 font-serif ">Sign out</a>
            </li>
        </ul>
    </div>
</div>
        
</nav>    
<div class="bg-white">
  <div class="container mx-auto px-4 py-6 md:px-0">
    <h2 class="text-4xl md:text-7xl font-serif text-center text-indigo-700 mb-12">FEATURES</h2>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
      <a href="assignments.php<?php echo "?" . $_SERVER['QUERY_STRING'] ?>" class="group">
        <div class="bg-indigo-700 p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
          <img src="myimage_img/Assignments.svg" alt="Assignment Image" class=" bg-white h-64 w-full  object-cover object-center rounded-lg mb-4">
          <h3 class="text-xl font-serif text-white text-center">Assignments</h3>
        </div>
      </a>
      <a href="news&event.php<?php echo "?" . $_SERVER['QUERY_STRING'] ?>" class="group">
        <div class="bg-indigo-700 p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
          <img src="myimage_img/News.svg" alt="News & Event Image" class="bg-white  h-64 w-full object-cover object-center rounded-lg mb-4">
          <h3 class="text-xl font-serif text-white text-center">News & Event</h3>
        </div>
      </a>
      <a href="dwonloadbook.php<?php echo "?" . $_SERVER['QUERY_STRING'] ?>" class="group">
        <div class="bg-indigo-700 p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
          <img src="myimage_img/Books.svg" alt="Download Book Image" class="bg-white  h-64 w-full object-cover object-center rounded-lg mb-4">
          <h3 class="text-xl font-serif text-white text-center">Books</h3>
        </div>
      </a>
      <a href="dwonloadtimetable.php<?php echo "?" . $_SERVER['QUERY_STRING'] ?>" class="group">
        <div class="bg-indigo-700 p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
          <img src="myimage_img/Timetable.svg" alt="Download Timetable Image" class="bg-white  h-64 w-full object-cover object-center rounded-lg mb-4">
          <h3 class="text-xl font-serif text-white text-center">Timetable</h3>
        </div>
      </a>
      <a href="dwonloadsyllabus.php<?php echo "?" . $_SERVER['QUERY_STRING'] ?>" class="group">
        <div class="bg-indigo-700 p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
          <img src="myimage_img/Syllabus.svg" alt="Download Syllabus Image" class="bg-white  h-64 w-full object-cover object-center rounded-lg mb-4">
          <h3 class="text-xl font-serif text-white text-center">Syllabus</h3>
        </div>
      </a>
      <a href="result.php<?php echo "?" . $_SERVER['QUERY_STRING'] ?>" class="group">
        <div class="bg-indigo-700 p-4 rounded-lg shadow-md transition-transform transform hover:scale-105">
          <img src="myimage_img/Result.svg" alt="Student Result Image" class="bg-white  h-64 w-full object-cover object-center rounded-lg mb-4">
          <h3 class="text-xl font-serif text-white text-center">Student Result</h3>
        </div>
      </a>
    </div>
  </div>
</div>


</body>
</html>