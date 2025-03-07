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
    Survey Templates Gallery
   </h1>
   <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
   <a class="block" href="custom.html">
    <div class="bg-white p-4 rounded-lg shadow-md">
     <img alt="Personal Use survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/fq38suD1MjIrEFa5ABVkOrdQKMI2qdISTtYBkiOmQ2o.jpg" width="300"/>
     <h2 class="text-xl font-semibold mb-2">
      Personal Use
     </h2>
     <p class="text-gray-600">
      Templates for personal surveys and data collection.
     </p>
    </div>
    <a class="block" href="healthcare.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="HealthCare survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/T53xcpiYJj3r7aBZDgxXKkALi3FPr3w4wKXPYZv_1ic.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       HealthCare
      </h2>
      <p class="text-gray-600">
       Templates for healthcare-related surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="research.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Research survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/1CLqGioR5pomgy4Zgu7r0ycBfXkoIdRJBexZaQZ3j4w.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Research
      </h2>
      <p class="text-gray-600">
       Templates for research-related surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="finance.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Finance survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/K7cXZikl5MMJhO44Xep4OI9dyWRVbnS_B6DUzmdsyHU.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Finance
      </h2>
      <p class="text-gray-600">
       Templates for finance-related surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="technology.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Technology survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/_W5fzuQXo9GHORe90_BTbf2ypd4dUsX_OkppxTEK87I.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Technology
      </h2>
      <p class="text-gray-600">
       Templates for technology-related surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="education.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Education survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/0rHKyFvCiyqyNUre5LXgHNtlRles5XMAoumv_fL9ULc.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Education
      </h2>
      <p class="text-gray-600">
       Templates for education-related surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="retail.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Retail survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/n1csP1SP94gBR9j8ez8hy7VyFuajoBVByYVk_I4PX-Y.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Retail
      </h2>
      <p class="text-gray-600">
       Templates for retail-related surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="hospital.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Hospitality survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/5CSuw0uNEcMutO0eKVB1OhS7Y14H7noCjWiVs9bjcUk.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Hospitality
      </h2>
      <p class="text-gray-600">
       Templates for hospitality-related surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="government.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Government survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/k9aKi_bnRfx4m6YeYDbOLjF4Bw3cW_bCCQaeSqoKtlA.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Government
      </h2>
      <p class="text-gray-600">
       Templates for government surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="customer.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Customer Feedback survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/tR7iCGuC0VHOYZpxo5lwJtNJozkhlxq3MoIgzIp1waM.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Customer Feedback
      </h2>
      <p class="text-gray-600">
       Templates for Customer Feedback surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="employee.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Employee Satisfaction survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/v48yw0cnEpRhqbdHYIHo8IofT7VBloktJEior8IkBaM.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Employee Satisfaction
      </h2>
      <p class="text-gray-600">
       Templates for Employee Satisfaction surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="product.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Product Feedback survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/CZv-861D82ZE09XipW776mHefBPfSK-rC_FAXAkkfcE.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Product Feedback
      </h2>
      <p class="text-gray-600">
       Templates for Product Feedback surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="market.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Market Research survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/BPK3rRzyofRyY1oc-8OiD9r9BAxJrzYms5XovgQHJto.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Market Research
      </h2>
      <p class="text-gray-600">
       Templates for Market Research surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="event.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Event Feedback survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/7JEocjbkHfOXg66HyRkjo1rpa2QV_KOdEdtK73sBbtg.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Event Feedback
      </h2>
      <p class="text-gray-600">
       Templates for Event Feedback surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="training.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Training Evaluation survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/8e7bAFPZENqC0HqjhFvh8u5PcgU67uTksR75LoAdr7o.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Training Evaluation
      </h2>
      <p class="text-gray-600">
       Templates for Training Evaluation surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="user.html">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="User Experience survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/dyTJz7f2JupgVusZ239ISQsHxCRDQ-RD3P4skMyn6Yg.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       User Experience
      </h2>
      <p class="text-gray-600">
       Templates for User Experience surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="profit.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Non-Profit/Charity Feedback survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/779L2QnZiGdtc7VxD1E6WuaqRiydRmKBKhfefqqsDq8.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Non-Profit/Charity Feedback
      </h2>
      <p class="text-gray-600">
       Templates for Non-Profit/Charity Feedback surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="polling.php">
        <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
         <img alt="Political Polling survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/ToK73aRiEPVopvWAERl-DggLBZyt-vzuFLIvLEZ8dnY.jpg" width="300"/>
         <h2 class="text-xl font-semibold mb-2">
            Political Polling
         </h2>
         <p class="text-gray-600">
          Templates for Political Polling surveys and data collection.
         </p>
        </div>
       </a>
    <a class="block" href="travel.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Travel and Tourism Feedback survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/46xoHz5de7_UhB5HIcGxE6ADzfQUChxl8DoOtVG2aug.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Travel and Tourism
      </h2>
      <p class="text-gray-600">
       Templates for Travel and Tourism Feedback surveys and data collection.
      </p>
     </div>
    </a>
    <a class="block" href="community.php">
     <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition-shadow">
      <img alt="Community Engagement Feedback survey template image" class="w-full h-40 object-cover rounded-md mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/LtnmhyoEs4sibsTmtIYKNTwveBZHiIW9L8gB8HetpLU.jpg" width="300"/>
      <h2 class="text-xl font-semibold mb-2">
       Community Engagement
      </h2>
      <p class="text-gray-600">
       Templates for Community Engagement Feedback surveys and data collection.
      </p>
     </div>
    </a>
   </div>
  </div>
  <footer class="bg-green-600 text-white p-4 mt-8">
   <div class="container mx-auto text-center">
    <p>
     © 2023 Integral And Advance Polling and Data Collection Form System. All rights reserved.
    </p>
   </div>
  </footer>
 </body>
</html>
