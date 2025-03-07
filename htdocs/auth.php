<?php
// Enable error reporting
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();

// Database connection
$host = "localhost";
$dbname = "user_system";
$username = "root";  // Change this if needed
$password = "";  // Change this if needed

$conn = new mysqli($host, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if users table exists
$result = $conn->query("SHOW TABLES LIKE 'users'");
if ($result->num_rows == 0) {
    // Create users table if it doesn't exist
    $sql = "CREATE TABLE users (
        id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) NOT NULL UNIQUE,
        email VARCHAR(100) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";
    
    if (!$conn->query($sql)) {
        die("Error creating table: " . $conn->error);
    }
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $uname = $_POST['username'];
    $pass = $_POST['password'];
    if (isset($_POST['signup'])) {
        $email = $_POST['email'];
        $hashed_pass = password_hash($pass, PASSWORD_DEFAULT);

        $stmt = $conn->prepare("INSERT INTO users (username, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $uname, $email, $hashed_pass);
        
        if ($stmt->execute()) {
            echo "<div class='bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4' role='alert'>
                    <span class='block sm:inline'>Signup successful. Please log in.</span>
                  </div>";
        } else {
            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                    <span class='block sm:inline'>Error: " . htmlspecialchars($stmt->error) . "</span>
                  </div>";
        }
        $stmt->close();
    }

    if (isset($_POST['login'])) {
        $stmt = $conn->prepare("SELECT id, password FROM users WHERE username = ?");
        $stmt->bind_param("s", $uname);
        $stmt->execute();
        $stmt->store_result();
        
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($id, $hashed_password);
            $stmt->fetch();
            if (password_verify($pass, $hashed_password)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $uname;
                header("Location: home.php");
                exit();
            } else {
                echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                        <span class='block sm:inline'>Invalid password!</span>
                      </div>";
            }
        } else {
            echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>
                    <span class='block sm:inline'>No user found. Please sign up.</span>
                  </div>";
        }
        $stmt->close();
    }
}

// Logout handling
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: auth.php");
    exit();
}

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
    echo "<h2>Welcome, " . $_SESSION['username'] . "!</h2>";
    echo "<a href='auth.php?logout=true'>Logout</a>";
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup & Login</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <script>
        function showSignup() {
            document.getElementById("signup-form").classList.remove("hidden");
            document.getElementById("login-form").classList.add("hidden");
        }

        function showLogin() {
            document.getElementById("login-form").classList.remove("hidden");
            document.getElementById("signup-form").classList.add("hidden");
        }

        // Basic client-side validation
        function validateForm(form) {
            if (form.querySelector('input[name="username"]').value.length < 3) {
                alert("Username must be at least 3 characters long.");
                return false;
            }
            
            if (form.querySelector('input[name="password"]').value.length < 6) {
                alert("Password must be at least 6 characters long.");
                return false;
            }
            
            if (form.querySelector('input[name="email"]') && !form.querySelector('input[name="email"]').value.includes("@")) {
                alert("Enter a valid email address.");
                return false;
            }
            return true;
        }
    </script>
    <style>
        /* Video Background */
.video-container {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    overflow: hidden;
    z-index: -1;
}

.video-container video {
    min-width: 100%;
    min-height: 100%;
    object-fit: cover;
}

/* Overlay for better readability */
.overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: -1;
}

/* Highlights Section */
.highlights {
            padding: 50px 20px;
            text-align: center;
            background: linear-gradient(to right,rgb(3, 3, 3),rgb(0, 0, 0)); /* Modern gradient */
            color: rgb(11, 207, 57);
        }

        .highlights h2 {
            font-size: 2.5rem;
            margin-bottom: 30px;
            text-transform: uppercase;
            letter-spacing: 1px;    
        }

        .cards {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            gap: 20px;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgb(242, 240, 240);
            max-width: 260px;
            text-align: center;
            transition: transform 0.3s ease-in-out, box-shadow 0.3s ease-in-out;
            position: relative;
            overflow: hidden;
            color: #333;
        }

        .card i {
            font-size: 2.5rem;
            color: #27ae60;
            margin-bottom: 15px;
            transition: transform 0.3s ease-in-out;
        }

        .card h3 {
            font-size: 1.6rem;
            margin-bottom: 10px;
            font-weight: bold;
        }

        .card p {
            font-size: 1rem;
            line-height: 1.5;
        }

        /* Glowing Hover Effect */
        .card:hover {
            transform: scale(1.05);
            box-shadow: 0 0 15px #22c55e, 0 0 30px #22c55e, 0 0 45px #22c55e;
        }

/* Fixing Glow Button Effect */
.glow-button {
    position: relative;
    overflow: hidden;
    transition: 0.3s ease-in-out;
}

.glow-button:hover {
    box-shadow: 0 0 10px #22c55e, 0 0 20px #22c55e, 0 0 40px #22c55e;
    transform: scale(1.05);
}


    </style>
</head>
<body class="flex flex-col min-h-screen text-white">
    <!-- Video Background -->
    <div class="video-container">
        <video autoplay loop muted playsinline>
            <source src="videocloud.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>
    </div>
    
    <!-- Dark Overlay -->
    <div class="overlay"></div>

    <!-- Header -->
    <header class="bg-white bg-opacity-50 shadow-md py-4 fixed top-0 left-0 w-full z-10">
        <div class="container mx-auto px-6 flex justify-between items-center">
            <div class="text-2xl font-bold">
                <span class="text-green-600">Spectra</span>
            </div>
            <nav class="space-x-6 flex items-center">
                <a class="hover:text-green-600" href="auth.php">HOME</a>
                <a class="hover:text-green-600" href="working.html">HOW IT WORKS</a>
                <a class="hover:text-green-600" href="about.html">ABOUT US</a>
                <a class="hover:text-green-600" href="features.html">FEATURES</a>
                <button onclick="showSignup()" class="glow-button bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-800 transition">
                    Sign Up
                </button>
            </nav>
        </div>
    </header>

    <!-- Forms Container -->
    <main class="flex flex-1 items-center justify-center pt-40">
        <div class="w-full max-w-xs bg-white bg-opacity-10 backdrop-blur-md shadow-lg rounded-lg p-8 hidden" id="signup-form">
            <h2 class="text-2xl font-semibold text-center mb-4">Create an Account</h2>
            <form method="POST" action="" onsubmit="return validateForm(this)">
                <input class="w-full px-4 py-2 bg-transparent border border-white rounded-lg mb-3 text-white placeholder-gray-300 focus:ring-2 focus:ring-green-400" type="text" name="username" placeholder="Username" required />
                <input class="w-full px-4 py-2 bg-transparent border border-white rounded-lg mb-3 text-white placeholder-gray-300 focus:ring-2 focus:ring-green-400" type="email" name="email" placeholder="Email" required />
                <input class="w-full px-4 py-2 bg-transparent border border-white rounded-lg mb-3 text-white placeholder-gray-300 focus:ring-2 focus:ring-green-400" type="password" name="password" placeholder="Password" required />
                <button class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition" type="submit" name="signup">Sign Up</button>
            </form>
            <p class="text-center mt-4">Already have an account? <a class="text-green-400 hover:underline" onclick="showLogin()">Log in</a></p>
        </div>

        <!-- Login Form (Hidden by default) -->
        <div id="login-form" class="hidden w-full max-w-xs bg-white bg-opacity-10 backdrop-blur-md shadow-lg rounded-lg p-8">
            <h2 class="text-2xl font-semibold text-center mb-4">Welcome Back</h2>
            <form method="POST" action="" onsubmit="return validateForm(this)">
                <input class="w-full px-4 py-2 bg-transparent border border-white rounded-lg mb-3 text-white placeholder-gray-300 focus:ring-2 focus:ring-green-400" type="text" name="username" placeholder="Username" required />
                <input class="w-full px-4 py-2 bg-transparent border border-white rounded-lg mb-3 text-white placeholder-gray-300 focus:ring-2 focus:ring-green-400" type="password" name="password" placeholder="Password" required />
                <button class="w-full bg-green-500 text-white py-2 rounded-lg hover:bg-green-600 transition" type="submit" name="login">Log In</button>
            </form>
            <p class="text-center mt-4">Don't have an account? <a class="text-green-400 hover:underline" onclick="showSignup()">Sign Up</a></p>
        </div>
    </main>

    <!-- About Spectra Section -->
    <section class="flex flex-col md:flex-row items-center justify-center text-white p-8">
        <div class="md:w-1/2 text-center md:text-left p-6">
            <h2 class="text-3xl font-bold mb-4">Create Powerful <span class="text-green-400">Online Surveys</span></h2>
            <p class="text-lg mb-4">Need to create a survey or a quiz easily? Get the answers you need with Spectra.</p>
            <button onclick="showSignup()" class="glow-button bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-800 transition">
                Create a Free Account
            </button>
        </div>
    </section>

    <section id="about" class="py-20 bg-gray-900 text-white text-center px-6">
    </script>
    <style>
        .video-container { position: fixed; top: 0; left: 0; width: 100%; height: 100%; z-index: -1; }
        .video-container video { object-fit: cover; width: 100%; height: 100%; }
        .overlay { position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.6); z-index: -1; }
        .chart-container { width: 60%; min-width: 600px; margin: auto; }
    </style>
</head>
<body class="text-white bg-black">
     <div class="overlay"></div>
    
    <main class="flex flex-col items-center justify-center min-h-screen text-center">
        <h2 class="text-3xl font-semibold mb-6">AI-Powered Polling & Data Collection</h2>
        <div class="chart-container">
            <canvas id="growthChart"></canvas>
        </div>
    </main>
  
    <script>
        const ctx = document.getElementById('growthChart').getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: ['2020', '2021', '2022', '2023', '2024'],
                datasets: [{
                    label: 'User Growth',
                    data: [100, 400, 800, 1600, 3200],
                    borderColor: '#22c55e',
                    borderWidth: 2,
                    fill: true,
                    backgroundColor: 'rgba(34, 197, 94, 0.2)'
                }]
            },
            options: {
                responsive: true,
                animation: { duration: 2000 },
            }
        });
    </script>
    </section>

     <!-- Why Choose Spectra? -->
     <section class="highlights">
      <h2>Why Choose Spectra?</h2>
      <div class="cards">
          <div class="card">
              <i class="fas fa-brain"></i>
              <h3>AI-Powered Analytics</h3>
              <p>Gain deep insights with real-time data processing and predictive analytics.</p>
          </div>
          <div class="card">
              <i class="fas fa-shield-alt"></i>
              <h3>End-to-End Encryption</h3>
              <p>Ensure maximum security for all your polling and survey data.</p>
          </div>
          <div class="card">
              <i class="fas fa-mobile-alt"></i>
              <h3>Seamless Multi-Device Access</h3>
              <p>Access Spectra effortlessly across web, mobile, and tablet devices.</p>
          </div>
          <div class="card">
              <i class="fas fa-expand"></i>
              <h3>Customizable & Scalable</h3>
              <p>From small surveys to nationwide elections, Spectra adapts to your needs.</p>
          </div>
      </div>
  </section>
 

    <!-- Footer -->
    <footer class="py-20 bg-black text-gray-400">
   <div class="container mx-auto grid grid-cols-1 md:grid-cols-4 gap-8">
    <div>
        <div class="text-2xl font-bold text-teal-400">
      SPECTRA.
     </div>
     <p class="mt-4">
     Integral And Advance Polling and Data Collection Form System.
     </p>
     <p class="mt-4">
      Phone:1234567890
     </p>
     <p>
      Email: spectra@gmail.com
     </p>
    </div>
    <div>
     <h3 class="text-xl font-bold">
      QUICK LINKS
     </h3>
     <ul class="mt-4 space-y-2">
      <li>
       <a class="hover:text-teal-400" href="auth.php">
        Home
       </a>
      </li>
      <li>
       <a class="hover:text-teal-400" href="about.html">
        About
       </a>
      </li>
      <li>
       <a class="hover:text-teal-400" href="features.html">
        Services
       </a>
      </li>
      <li>
       <a class="hover:text-teal-400" href="working.html">
        Work
       </a>
      </li>
      <li>
       <a class="hover:text-teal-400" href="#">
        Blog
       </a>
      </li>
      <li>
       <a class="hover:text-teal-400" href="contact.html">
        Contact
       </a>
      </li>
     </ul>
    </div>
    <div>
     <h3 class="text-xl font-bold">
      MORE
     </h3>
     <ul class="mt-4 space-y-2">
      <li>
       <a class="hover:text-teal-400" href="#">
        Privacy Policy
       </a>
      </li>
      <li>
       <a class="hover:text-teal-400" href="#">
        Terms of Service
       </a>
      </li>
      <li>
       <a class="hover:text-teal-400" href="#">
        FAQ
       </a>
      </li>
     </ul>
    </div>
    <div>
     <h3 class="text-xl font-bold">
      SIGNUP A NEWSLETTER
     </h3>
     <form class="mt-4">
      <input class="w-full p-2 rounded bg-gray-800 text-white" placeholder="Your Email" type="email"/>
      <button class="mt-4 w-full bg-teal-400 text-black px-4 py-2 rounded">
       Submit
      </button>
     </form>
    </div>
   </div>
   <div class="mt-12 text-center text-gray-600">
    © 2021 SPECTRA. All rights reserved. Designed by 
    <a class="text-teal-400">
     Uday Sapkale
    </a>
   </div>
</body>
</html>