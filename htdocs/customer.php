<?php
// Database Connection
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Your database username
$password = ""; // Your database password
$database = "user_system"; // The name of the database you created

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $full_name = $_POST['full-name'];
    $email = $_POST['email'];
    $phone_number = $_POST['phone-number'];
    $satisfaction = $_POST['satisfaction'];
    $recommend = $_POST['recommend'];
    $quality = $_POST['quality'];
    $customer_service = $_POST['customer-service'];
    $value_for_money = $_POST['value-for-money'];
    $like_most = $_POST['like-most'];
    $dislike_most = $_POST['dislike-most'];
    $suggestions = $_POST['suggestions'];

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO customer_survey (full_name, email, phone_number, satisfaction, recommend, quality, customer_service, value_for_money, like_most, dislike_most, suggestions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssss", $full_name, $email, $phone_number, $satisfaction, $recommend, $quality, $customer_service, $value_for_money, $like_most, $dislike_most, $suggestions);

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
                    <p><strong>Email:</strong> ${event.target.elements['email'].value}</p>
                    <p><strong>Phone Number:</strong> ${event.target.elements['phone-number'].value}</p>
                    <p><strong>How satisfied are you with our product/service?</strong> ${event.target.elements['satisfaction'].value}</p>
                    <p><strong>How likely are you to recommend our product/service to others?</strong> ${event.target.elements['recommend'].value}</p>
                    <p><strong>How would you rate the quality of our product/service?</strong> ${event.target.elements['quality'].value}</p>
                    <p><strong>How would you rate our customer service?</strong> ${event.target.elements['customer-service'].value}</p>
                    <p><strong>How would you rate the value for money of our product/service?</strong> ${event.target.elements['value-for-money'].value}</p>
                    <p><strong>What do you like most about our product/service?</strong> ${event.target.elements['like-most'].value}</p>
                    <p><strong>What do you dislike most about our product/service?</strong> ${event.target.elements['dislike-most'].value}</p>
                    <p><strong>Do you have any suggestions for improvement?</strong> ${event.target.elements['suggestions'].value}</p>
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
            <!-- Customer Feedback Survey Template -->
            <div id="form-container" class="bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">Customer Feedback Survey</h2>
                <form onsubmit="handleSubmit(event)">
                    <div class="mb-4">
                        <label class="block text-gray-700">Full Name:</label>
                        <input type="text" name="full-name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter full name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email:</label>
                        <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter email">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Phone Number:</label>
                        <input type="tel" name="phone-number" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter phone number">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How satisfied are you with our product/service?</label>
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
                        <label class="block text-gray-700">How likely are you to recommend our product/service to others?</label>
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
                        <label class="block text-gray-700">How would you rate the quality of our product/service?</label>
                        <select name="quality" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select quality rating</option>
                            <option value="excellent">Excellent</option>
                            <option value="good">Good</option>
                            <option value="average">Average</option>
                            <option value="poor">Poor</option>
                            <option value="very_poor">Very Poor</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How would you rate our customer service?</label>
                        <select name="customer-service" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select customer service rating</option>
                            <option value="excellent">Excellent</option>
                            <option value="good">Good</option>
                            <option value="average">Average</option>
                            <option value="poor">Poor</option>
                            <option value="very_poor">Very Poor</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How would you rate the value for money of our product/service?</label>
                        <select name="value-for-money" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select value for money rating</option>
                            <option value="excellent">Excellent</option>
                            <option value="good">Good</option>
                            <option value="average">Average</option>
                            <option value="poor">Poor</option>
                            <option value="very_poor">Very Poor</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">What do you like most about our product/service?</label>
                        <textarea name="like-most" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your response"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">What do you dislike most about our product/service?</label>
                        <textarea name="dislike-most" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your response"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Do you have any suggestions for improvement?</label>
                        <textarea name="suggestions" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your suggestions"></textarea>
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