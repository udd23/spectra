<?php
session_start();

// Redirect to login if not authenticated
if (!isset($_SESSION['user_id'])) {
    header("Location: home.php");
    exit();
}

$username = $_SESSION['username'];
$last_survey_title = isset($_SESSION['last_survey_title']) ? $_SESSION['last_survey_title'] : null;

// Clear the session variable after displaying it
unset($_SESSION['last_survey_title']);
?>
<html lang="en">
 <head>
  <meta charset="utf-8"/>
  <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
  <title>
   Integral And Advance Polling and Data Collection Form System
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
 </head>
 <body class="font-roboto bg-gray-100">
  <!-- Header -->
  <header class="bg-white shadow-sm">
   <div class="container mx-auto px-4 py-2 flex justify-between items-center">
    <div class="text-2xl font-bold">
     <span class="text-green-400">
      Spectra
     </span>
    </div>
    <div class="flex items-center space-x-4">
     <a class="text-gray-600" href="home.php">
      Home
     </a>
     <a class="text-gray-600" href="contact.php">
      Help center
     </a>
     <a href="survey.php">
      <button class="bg-green-600 text-white px-4 py-2 rounded">
       + New Survey
      </button>
     </a>
     <a href="quizz.php">
      <button class="bg-blue-600 text-white px-4 py-2 rounded">
       + New Quiz
      </button>
     </a>
     <!-- User Dropdown Section -->
     <div class="relative">
      <button class="text-gray-600 flex items-center focus:outline-none" id="user-dropdown-btn">
       <i class="fas fa-user-circle text-2xl">
       </i>
       <span class="ml-2" id="username-display">
        <?php echo htmlspecialchars($username); ?>
       </span>
       <i class="fas fa-caret-down ml-1">
       </i>
      </button>
      <!-- Dropdown Menu -->
      <div class="absolute right-0 mt-2 w-48 bg-white rounded shadow-md hidden" id="user-dropdown-menu">
       <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#">
        Profile
       </a>
       <a class="block px-4 py-2 text-gray-700 hover:bg-gray-100" href="#">
        Settings
       </a>
       <a class="block px-4 py-2 text-red-600 hover:bg-gray-100" href="auth.php?logout=true">
        Logout
       </a>
      </div>
     </div>
    </div>
   </div>
  </header>
  <script>
    // Dropdown Toggle
    document.getElementById('user-dropdown-btn').addEventListener('click', function () {
        document.getElementById('user-dropdown-menu').classList.toggle('hidden');
    });
</script>
  <div class="container mx-auto p-4">
   <h1 class="text-3xl font-bold text-center mb-8">
    Quiz Templates Gallery
   </h1>
   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
    <a class="block" href="general.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="General Knowledge quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/Ao0LnTecHngzGx9UQH2uT5jbdc2be0AP-gXnRoUrzpI.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       General Knowledge
      </h2>
      <p class="text-gray-600">
       Explore the world of general knowledge with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="science.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Science quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/6ORsEMCxzaQYtdYs2-YqXCE0ID8WQd2hZgDwnpKF8r4.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Science
      </h2>
      <p class="text-gray-600">
       Explore the world of science with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="history.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="History quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/R2MV9i4d5C02UvMmLggD0XKzhC6C7jU060ocfvHjMK0.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       History
      </h2>
      <p class="text-gray-600">
       Dive into history with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="math.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Math quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/LzetvVjNALKuwzkpaee5O2jALQAsI5hSCMoOdJcuY38.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Math
      </h2>
      <p class="text-gray-600">
       Challenge your math skills with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="literature.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Literature quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/0hLxGJ6432qeb5tH0_mk64dff8BRo6yKW2GRv3OiMns.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Literature
      </h2>
      <p class="text-gray-600">
       Test your knowledge of literature with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="geography.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Geography quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/WeHhWiCSK7tzUPKLPFntWN4sIHGsE8tnHMrHVDL5d9g.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Geography
      </h2>
      <p class="text-gray-600">
       Explore the world with this geography quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="sports.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Sports quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/Ttryc3TXoZeQ8kjm9MVwI7Y1qTe01MF6u-f2vYj-AJ8.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Sports
      </h2>
      <p class="text-gray-600">
       Test your sports knowledge with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="movies.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Movies quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/JhxbcSsXOWdHt2lsc7xXua9hFVsULds_lRVCrHqN8DI.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Movies
      </h2>
      <p class="text-gray-600">
       Test your movie knowledge with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="music.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Music quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/n7YtoxmgBGyLrJFyAFBKqYrymgzJOyj2Nfi5qfbaunY.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Music
      </h2>
      <p class="text-gray-600">
       Test your music knowledge with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="technology1.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Technology quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/T60BBIJZuCKQ38CwqF76yQh29ktqbOkxguPEUtGwSmM.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Technology
      </h2>
      <p class="text-gray-600">
       Test your technology knowledge with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="food.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Food quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/Z1DmGSmMHw7JmpkxDn6DXHWqC5fpmuwueprVW9AUDBE.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Food
      </h2>
      <p class="text-gray-600">
       Test your food knowledge with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="travel1.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Travel quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/k14e-WgVEYZzTXVcwrhaEpJfTSM23Z_uIotKmjwWI5M.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Travel
      </h2>
      <p class="text-gray-600">
       Test your travel knowledge with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="art.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Art quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/lfBZWeQPy0rircpHl3W_uxa9FItRHUczVZ01Vpq5VKQ.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Art
      </h2>
      <p class="text-gray-600">
       Test your art knowledge with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="language.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Language quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/dwQWeM2SfiHS1fJts-Z4dAt-edc2LBB9DTKRs6_7RpI.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Language
      </h2>
      <p class="text-gray-600">
       Test your language skills with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="business1.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Business quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/qzmgQNezMVIhMCAOEnJmA2UWUVmILymAHYJUhxw6kQs.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Business
      </h2>
      <p class="text-gray-600">
       Test your business knowledge with this quiz template.
      </p>
     </div>
    </a>
    <a class="block" href="fashion.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Fashion quiz template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/2kXNz85djqnHHWriElJkr5c3F6eNVamT5pYHhzviCA0.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Fashion
      </h2>
      <p class="text-gray-600">
       Test your fashion knowledge with this quiz template.
      </p>
     </div>
    </a>
   </div>
  </div>
  <footer class="bg-blue-600 text-white p-4 mt-8">
   <div class="container mx-auto text-center">
    <p>
     © 2023 Integral And Advance Polling and Data Collection Form System. All rights reserved.
    </p>
   </div>
  </footer>
 </body>
</html>
