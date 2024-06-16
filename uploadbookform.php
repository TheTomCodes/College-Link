<?php
include 'config.php';
session_start();
$user_id = $_SESSION['user_id'];



if(isset($_GET['logout'])){
   unset($user_id);
   session_destroy();
   header('location:login.php');
}
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>File upload and download</title>
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
<h1 class="font-serif text-2xl md:text-6xl text-center text-blue-700 mt-6 mb-6">Book</h1>




<div class="flex flex-wrap justify-center mx-auto ">
    <?php
    $sql = "SELECT id, filename, classid, upload_date, Image FROM book ";
    // fire query
    $result = mysqli_query($conn, $sql);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    // Check if the delete button is clicked
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['delete_id'])) {
            $delete_id = $_POST['delete_id'];
            // Query to delete the assignment with the given ID
            $delete_sql = "DELETE FROM book WHERE id = '$delete_id'";
            // Execute the delete query
            if (mysqli_query($conn, $delete_sql)) {
                // Redirect to the same page after deletion
                header("Location: ".$_SERVER['PHP_SELF']);
            } else {
                echo "Error deleting record: " . mysqli_error($conn);
            }
        }
    }
    // Display the uploaded files and download links
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $file_path = "uploads/" . $row['filename'];
    ?>
            <div class="w-96 mx-4 my-4">
                <div class=" p-4 bg-white rounded-lg shadow-md overflow-hidden">
                    <?php
                    // Displaying the image if available
                    if (!empty($row["Image"])) {
                        echo '<img src="bookimage_img/' . $row["Image"] . '" alt="Book Cover" class="w-full h-96 object-cover">';
                    }
                    ?>
                    <div class="p-4">
                        <p class="text-sm font-mono text-gray-600 mb-2">ClassID: <?php echo $row['classid']; ?></p>
                        <h5 class="text-2xl font-serif text-gray-900"><?php echo $row['filename']; ?></h5>
                        <p class="text-lg font-mono text-gray-600 mb-2">Date: <?php echo $row['upload_date']; ?></p>
                        <a href="<?php echo $file_path; ?>" class="block bg-indigo-600 text-white font-serif py-2 px-4 rounded-md text-center transition duration-300 ease-in-out transform hover:bg-indigo-700 hover:scale-105">
                            Get the Book
                        </a>
                        <form method="post">
                            <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="w-full my-2 block bg-red-600 text-white font-serif py-2 px-4 rounded-md text-center transition duration-300 ease-in-out transform hover:bg-red-700 hover:scale-105">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php
        }
    } else {
        ?>
        <div class="max-w-sm p-6 bg-white border border-gray-200 rounded-lg shadow text-center">
            No files uploaded yet.
        </div>
    <?php
    }
    ?>
</div>


<section class="bg-white my-24">
    <div class="container flex items-center justify-center  px-6 mx-auto">
        <form class="w-full max-w-md"method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" enctype="multipart/form-data">
        
            <div class="flex justify-center mx-auto">
                <h1 class="text-3xl font-serif">UploadBook</h1>
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
            <div class="relative flex items-center mt-8">
                <span class="absolute">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 mx-3 text-blue-700">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 9h3.75M15 12h3.75M15 15h3.75M4.5 19.5h15a2.25 2.25 0 0 0 2.25-2.25V6.75A2.25 2.25 0 0 0 19.5 4.5h-15a2.25 2.25 0 0 0-2.25 2.25v10.5A2.25 2.25 0 0 0 4.5 19.5Zm6-10.125a1.875 1.875 0 1 1-3.75 0 1.875 1.875 0 0 1 3.75 0Zm1.294 6.336a6.721 6.721 0 0 1-3.17.789 6.721 6.721 0 0 1-3.168-.789 3.376 3.376 0 0 1 6.338 0Z" />
                </svg>

                </span>

                <input type="file" name="file" id="file" required class="block w-full py-3 font-serif text-xl text-black bg-white border-2 border-blue-700 rounded-lg px-11" placeholder="Id">
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
                <button type="submit"  class="w-full px-6 py-3 text-2xl font-serif tracking-wide text-white hover:text-white capitalize transition-colors duration-300 transform bg-blue-700 rounded-lg hover:bg-blue-900">
                    Upload
                </button>
            </div>
        </form>
    </div>
</section>
</body>
</html>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if a file was uploaded without errors
    if (isset($_FILES["file"]) && $_FILES["file"]["error"] == 0) {
        $target_dir = "uploads/"; // Change this to the desired directory for uploaded files
        $target_file = $target_dir . basename($_FILES["file"]["name"]);
        $file_type = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        // Check if the file is allowed (you can modify this to allow specific file types)
        $allowed_types = array("jpg", "jpeg", "png", "gif", "pdf");
        if (!in_array($file_type, $allowed_types)) {
            echo "Sorry, only JPG, JPEG, PNG, GIF, and PDF files are allowed.";
        } else {
            // Move the uploaded file to the specified directory
            if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
                // File upload success, now store information in the database
                $filename = $_FILES["file"]["name"];
                $filesize = $_FILES["file"]["size"];
                $filetype = $_FILES["file"]["type"];
                $classidtype = mysqli_real_escape_string($conn,($_POST['classidtype']));
                $image_name = $_FILES['Image']['name'];
                $image_tmp = $_FILES['Image']['tmp_name'];
                $image_type = $_FILES['Image']['type'];

                // Insert the file information into the database
                $sql = "INSERT INTO book (filename, filesize, filetype, Image,classid) VALUES ('$filename', $filesize, '$filetype', '$image_name','$classidtype')";

                // Move uploaded image to desired location
                move_uploaded_file($image_tmp, "bookimage_img/$image_name");

                if ($conn->query($sql) === TRUE) {
                    echo "The file " . basename($_FILES["file"]["name"]) . " has been uploaded and the information has been stored in the database.";
                } else {
                    echo "Sorry, there was an error uploading your file and storing information in the database: " . $conn->error;
                }

                $conn->close();
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        }
    } else {
        echo "No file was uploaded.";
    }
}
?>
