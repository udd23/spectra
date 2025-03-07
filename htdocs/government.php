<?php
// Database Connection
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "government_survey"; // The name of the database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>

<?php
// Include the database connection code
include 'db_connection.php'; // Make sure to save the connection code in db_connection.php

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST['full-name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $satisfaction = $_POST['satisfaction'];
    $services = $_POST['services'];
    $efficiency = $_POST['efficiency'];
    $improvements = $_POST['improvements'];
    $recommend = $_POST['recommend'];
    $contact_email = $_POST['contact-email'];
    $contact_phone = $_POST['contact-phone'];
    $comments = $_POST['comments'];
    $performance = $_POST['performance'];
    $transparency = $_POST['transparency'];
    $accessibility = $_POST['accessibility'];
    $response = $_POST['response'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO government_survey (full_name, age, gender, satisfaction, services, efficiency, improvements, recommend, contact_email, contact_phone, comments, performance, transparency, accessibility, response) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sisssssssssssss", $full_name, $age, $gender, $satisfaction, $services, $efficiency, $improvements, $recommend, $contact_email, $contact_phone, $comments, $performance, $transparency, $accessibility, $response);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Survey response submitted successfully!";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement
    $stmt->close();
}

// Close the connection
$conn->close();
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integral And Advance Polling and Data Collection Form System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
    <script>
        function changeFormTheme(theme) {
            const formContainer = document.getElementById('form-container');
            formContainer.className = theme + ' p-6 rounded-lg shadow-lg w-full max-w-2xl';
        }

        function changeFont(font) {
            document.body.style.fontFamily = font;
        }

        function handleSubmit(event) {
            event.preventDefault();
            const formContainer = document.getElementById('form-container');
            formContainer.innerHTML = `
                <h2 class="text-xl font-bold mb-4">Thank you for submitting the survey!</h2>
                <p class="mb-4">You can see your response below:</p>
                <div class="bg-gray-100 p-4 rounded-lg">
                    <p><strong>Full Name:</strong> ${event.target.elements['full-name'].value}</p>
                    <p><strong>Age:</strong> ${event.target.elements['age'].value}</p>
                    <p><strong>Gender:</strong> ${event.target.elements['gender'].value}</p>
                    <p><strong>How satisfied are you with the current government services?</strong> ${event.target.elements['satisfaction'].value}</p>
                    <p><strong>Which government services do you use the most?</strong> ${event.target.elements['services'].value}</p>
                    <p><strong>How would you rate the efficiency of these services?</strong> ${event.target.elements['efficiency'].value}</p>
                    <p><strong>What improvements would you like to see in government services?</strong> ${event.target.elements['improvements'].value}</p>
                    <p><strong>How likely are you to recommend government services to others?</strong> ${event.target.elements['recommend'].value}</p>
                    <p><strong>Contact Email:</strong> ${event.target.elements['contact-email'].value}</p>
                    <p><strong>Contact Phone:</strong> ${event.target.elements['contact-phone'].value}</p>
                    <p><strong>Do you have any additional comments or suggestions?</strong> ${event.target.elements['comments'].value}</p>
                    <p><strong>How would you rate the overall performance of the government?</strong> ${event.target.elements['performance'].value}</p>
                    <p><strong>How transparent do you find the government’s operations?</strong> ${event.target.elements['transparency'].value}</p>
                    <p><strong>How accessible do you find government officials?</strong> ${event.target.elements['accessibility'].value}</p>
                    <p><strong>How would you rate the government's response to public feedback?</strong> ${event.target.elements['response'].value}</p>
                </div>
            `;
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="flex justify-start mb-4">
            <a href="javascript:history.back()" class="text-gray-800 text-2xl">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1 class="text-3xl font-bold text-center mb-8">Integral And Advance Polling and Data Collection Form System</h1>
       
        <div class="flex justify-center mb-8">
            <div class="mr-4">
                <form method="POST">
                <label for="form-theme" class="block text-gray-800 mb-2">Select Form Theme:</label>
                <select id="form-theme" class="p-2 rounded text-gray-800" onchange="changeFormTheme(this.value)">
                    <option value="bg-white text-black">Default</option>
                    <option value="bg-gray-800 text-white">Dark</option>
                    <option value="bg-blue-500 text-white">Blue</option>
                    <option value="bg-green-500 text-white">Green</option>
                    <option value="bg-red-500 text-white">Red</option>
                    <option value="bg-gray-900 text-white">Gray</option>
                    <option value="bg-yellow-500 text-white">Yellow</option>
                    <option value="bg-orange-500 text-white">Orange</option>
                    <option value="bg-violet-500 text-white">Violet</option>
                </select>
            </div>
            <div>
                <label for="font" class="block text-gray-800 mb-2">Select Font:</label>
                <select id="font" class="p-2 rounded text-gray-800" onchange="changeFont(this.value)">
                    <option value="'Roboto', sans-serif">Roboto</option>
                    <option value="'Open Sans', sans-serif">Open Sans</option>
                    <option value="'Arial', sans-serif">Arial</option>
                    <option value="'Lato', sans-serif">Lato</option>
                    <option value="'Montserrat', sans-serif">Montserrat</option>
                    <option value="'Poppins', sans-serif">Poppins</option>
                    <option value="'Nunito', sans-serif">Nunito</option>
                    <option value="'Raleway', sans-serif">Raleway</option>
                    <option value="'Merriweather', sans-serif">Merriweather</option>
                    <option value="'Playfair Display', serif">Playfair Display</option>
                    <option value="'Great Vibes', cursive">Great Vibes</option>
                    <option value="'Pacifico', cursive">Pacifico</option>
                    <option value="'Dancing Script', cursive">Dancing Script</option>
                    <option value="'New Times Roman', sans-serif">New Times Roman</option>
                </select>
            </div>
        </div>

        <div class="flex justify-center">
            <!-- Government Survey Template -->
            <div id="form-container" class="bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">Government Survey</h2>
                <form onsubmit="handleSubmit(event)">
                    <div class="mb-4">
                        <label class="block text-gray-700">Full Name:</label>
                        <input type="text" name="full-name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter full name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Age:</label>
                        <input type="number" name="age" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter age">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Gender:</label>
                        <select name="gender" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How satisfied are you with the current government services?</label>
                        <select name="satisfaction" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select satisfaction level</option>
                            <option value="very_satisfied">Very Satisfied</option>
                            <option value="satisfied">Satisfied</option>
                            <option value="neutral">Neutral</option>
                            <option value="dissatisfied">Dissatisfied</option>
                            <option value="very_dissatisfied">Very Dissatisfied</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Which government services do you use the most?</label>
                        <input type="text" name="services" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter services">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How would you rate the efficiency of these services?</label>
                        <select name="efficiency" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select rating</option>
                            <option value="excellent">Excellent</option>
                            <option value="good">Good</option>
                            <option value="average">Average</option>
                            <option value="poor">Poor</option>
                            <option value="very_poor">Very Poor</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">What improvements would you like to see in government services?</label>
                        <textarea name="improvements" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your suggestions"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How likely are you to recommend government services to others?</label>
                        <select name="recommend" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select likelihood</option>
                            <option value="very_likely">Very Likely</option>
                            <option value="likely">Likely</option>
                            <option value="neutral">Neutral</option>
                            <option value="unlikely">Unlikely</option>
                            <option value="very_unlikely">Very Unlikely</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Contact Email:</label>
                        <input type="email" name="contact-email" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter contact email">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Contact Phone:</label>
                        <input type="tel" name="contact-phone" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter contact phone number">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Do you have any additional comments or suggestions?</label>
                        <textarea name="comments" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your comments or suggestions"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How would you rate the overall performance of the government?</label>
                        <select name="performance" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select rating</option>
                            <option value="excellent">Excellent</option>
                            <option value="good">Good</option>
                            <option value="average">Average</option>
                            <option value="poor">Poor</option>
                            <option value="very_poor">Very Poor</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How transparent do you find the government’s operations?</label>
                        <select name="transparency" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select transparency level</option>
                            <option value="very_transparent">Very Transparent</option>
                            <option value="transparent">Transparent</option>
                            <option value="neutral">Neutral</option>
                            <option value="opaque">Opaque</option>
                            <option value="very_opaque">Very Opaque</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How accessible do you find government officials?</label>
                        <select name="accessibility" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select accessibility level</option>
                            <option value="very_accessible">Very Accessible</option>
                            <option value="accessible">Accessible</option>
                            <option value="neutral">Neutral</option>
                            <option value="inaccessible">Inaccessible</option>
                            <option value="very_inaccessible">Very Inaccessible</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How would you rate the government's response to public feedback?</label>
                        <select name="response" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select rating</option>
                            <option value="excellent">Excellent</option>
                            <option value="good">Good</option>
                            <option value="average">Average</option>
                            <option value="poor">Poor</option>
                            <option value="very_poor">Very Poor</option>
                        </select>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded">
                            <i class="fas fa-share"></i> Share
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>