<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<div class="flex justify-center items-center h-screen bg-white ">
  <div class="w-auto bg-white p-8 rounded-lg shadow-lg border border-gray-200 transition duration-300 hover:scale-105">
    <h2 class="text-2xl font-serif mb-4">Welcome to Collage Link</h2>
    <p class="text-gray-600 mb-6">Create or join a class to get started.</p>

    <div class="grid grid-cols-2 gap-4 ">
      <!-- Create Class -->
      <a href="login.php" class="border border-indigo-300 rounded-lg flex items-center justify-center p-4 hover:bg-gray-100 transition duration-300 hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-indigo-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
        </svg>
        <span>Create Class</span>
      </a>

      <!-- Join Class -->
      <a href="userlogin.php" class="border border-green-300 rounded-lg flex items-center justify-center p-4 hover:bg-gray-100 transition duration-300 hover:scale-105">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
        </svg>
        <span>Join Class</span>
      </a>
    </div>
  </div>
</div>


</body>
</html>