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
   Contact Us - Spectra
  </title>
  <script src="https://cdn.tailwindcss.com">
  </script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
 </head>
 <body class="bg-white">
<!-- Header -->
<header class="bg-white shadow-sm">
    <div class="container mx-auto px-4 py-2 flex justify-between items-center">
         <div class="text-2xl font-bold">
                <span class="text-green-400">Spectra</span>
            </div>
        <div class="flex items-center space-x-4">
            <a class="text-gray-600" href="home.php">Home</a>
            <a class="text-gray-600" href="contact.php">Help center</a>
            <a class="bg-green-600 text-white px-4 py-2 rounded" href="survey.php">+ New Survey</a>
            <a class="bg-blue-600 text-white px-4 py-2 rounded" href="quizz.php">+ New Quiz</a>

            <!-- User Dropdown Section -->
            <div class="relative">
                <button id="user-dropdown-btn" class="text-gray-600 flex items-center focus:outline-none">
                    <i class="fas fa-user-circle text-2xl"></i>
                    <span id="username-display" class="ml-2"><?php echo htmlspecialchars($username); ?></span>
                    <i class="fas fa-caret-down ml-1"></i>
                </button>

                <!-- Dropdown Menu -->
                <div id="user-dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white rounded shadow-md hidden">
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                    <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
                    <a href="auth.php?logout=true" class="block px-4 py-2 text-red-600 hover:bg-gray-100">Logout</a>
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
  <section class="bg-white py-12">
   <div class="container mx-auto text-center">
    <h1 class="text-4xl font-bold mb-4">
     Contact Us
    </h1>
    <p class="text-gray-700 mb-6">
     We'd love to hear from you! Whether you have a question about features, pricing, or anything else, our team is ready to answer all your questions.
    </p>
   </div>
  </section>
  <section class="bg-gray-100 py-12">
   <div class="container mx-auto flex flex-col md:flex-row items-center">
    <div class="md:w-1/2">
     <img alt="Illustration of a person contacting customer support" height="400" src="https://storage.googleapis.com/a1aa/image/v79GbXBJuW43DN7MzLpyENEGHNKR1kFYhKAfSP9m7iayJaEKA.jpg" width="600"/>
    </div>
    <div class="md:w-1/2 mt-8 md:mt-0">
     <form class="bg-white p-8 rounded-lg shadow-lg">
      <div class="mb-4">
       <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
        Name
       </label>
       <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" name="name" placeholder="Your Name" type="text"/>
      </div>
      <div class="mb-4">
       <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
        Email
       </label>
       <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="email" name="email" placeholder="Your Email" type="email"/>
      </div>
      <div class="mb-4">
       <label class="block text-gray-700 text-sm font-bold mb-2" for="message">
        Message
       </label>
       <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="message" name="message" placeholder="Your Message" rows="5">
       </textarea>
      </div>
      <div class="flex items-center justify-between">
       <button class="bg-blue-600 text-white px-6 py-3 rounded-full hover:bg-blue-700" type="submit">
        Send Message
       </button>
      </div>
     </form>
    </div>
   </div>
  </section>
  <footer class="bg-blue-600 text-white py-6">
   <div class="container mx-auto text-center">
    <p>
     © 2023 Spectra. All rights reserved.
    </p>
   </div>
  </footer>
 </body>
</html>
