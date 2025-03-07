<?php
// Database connection details
$servername = "localhost"; // Your database server
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "user_system"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $full_name = $conn->real_escape_string(trim($_POST['full-name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone_number = $conn->real_escape_string(trim($_POST['phone-number']));
    $organization_name = $conn->real_escape_string(trim($_POST['organization-name']));
    $satisfaction = $conn->real_escape_string(trim($_POST['satisfaction']));
    $likelihood = $conn->real_escape_string(trim($_POST['likelihood']));
    $liked_most = $conn->real_escape_string(trim($_POST['liked-most']));
    $disliked = $conn->real_escape_string(trim($_POST['disliked']));
    $additional_comments = $conn->real_escape_string(trim($_POST['additional-comments']));
    $experience = isset($_POST['experience']) ? (int)$_POST['experience'] : null;
    $contact = $conn->real_escape_string(trim($_POST['contact']));
    $quality = isset($_POST['quality']) ? (int)$_POST['quality'] : null;
    $value = isset($_POST['value']) ? (int)$_POST['value'] : null;

    // Handle file upload (optional)
    $document = null;
    if (isset($_FILES['document']) && $_FILES['document']['error'] == UPLOAD_ERR_OK) {
        $upload_dir = 'uploads/'; // Make sure this directory exists and is writable
        $document = $upload_dir . basename($_FILES['document']['name']);
        move_uploaded_file($_FILES['document']['tmp_name'], $document);
    }

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO profit_survey (full_name, email, phone_number, organization_name, satisfaction, likelihood, liked_most, disliked, additional_comments, experience, contact, document, quality, value) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssiisss", $full_name, $email, $phone_number, $organization_name, $satisfaction, $likelihood, $liked_most, $disliked, $additional_comments, $experience, $contact, $document, $quality, $value);

    // Execute the statement
    if ($stmt->execute()) {
        echo "New record created successfully";
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
                    <p><strong>Organization Name:</strong> ${event.target.elements['organization-name'].value}</p>
                    <p><strong>Satisfaction Level:</strong> ${event.target.elements['satisfaction'].value}</p>
                    <p><strong>Likelihood to Recommend:</strong> ${event.target.elements['likelihood'].value}</p>
                    <p><strong>Liked Most:</strong> ${event.target.elements['liked-most'].value}</p>
                    <p><strong>Disliked:</strong> ${event.target.elements['disliked'].value}</p>
                    <p><strong>Additional Comments:</strong> ${event.target.elements['additional-comments'].value}</p>
                    <p><strong>Overall Experience Rating:</strong> ${event.target.elements['experience'].value}</p>
                    <p><strong>Contact for Further Feedback:</strong> ${event.target.elements['contact'].value}</p>
                    <p><strong>Quality of Services Rating:</strong> ${event.target.elements['quality'].value}</p>
                    <p><strong>Value for Money Rating:</strong> ${event.target.elements['value'].value}</p>
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
                <form action="" method="POST">
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
            <!-- Non-Profit/Charity Feedback Survey Template -->
            <div id="form-container" class="bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">Non-Profit/Charity Feedback Survey</h2>
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
                        <label class="block text-gray-700">Organization Name:</label>
                        <input type="text" name="organization-name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter organization name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How satisfied are you with our services?</label>
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
                        <label class="block text-gray-700">How likely are you to recommend our organization to others?</label>
                        <select name="likelihood" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select likelihood</option>
                            <option value="very_likely">Very Likely</option>
                            <option value="likely">Likely</option>
                            <option value="neutral">Neutral</option>
                            <option value="unlikely">Unlikely</option>
                            <option value="very_unlikely">Very Unlikely</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">What did you like most about our services?</label>
                        <textarea name="liked-most" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your feedback"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">What did you dislike about our services?</label>
                        <textarea name="disliked" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your feedback"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Any additional comments or suggestions?</label>
                        <textarea name="additional-comments" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your comments or suggestions"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Rate the overall experience:</label>
                        <div class="flex space-x-2">
                            <label class="flex items-center">
                                <input type="radio" name="experience" value="1" class="mr-2"> 1
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="experience" value="2" class="mr-2"> 2
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="experience" value="3" class="mr-2"> 3
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="experience" value="4" class="mr-2"> 4
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="experience" value="5" class="mr-2"> 5
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Would you like to be contacted for further feedback?</label>
                        <div class="flex space-x-2">
                            <label class="flex items-center">
                                <input type="radio" name="contact" value="yes" class="mr-2"> Yes
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="contact" value="no" class="mr-2"> No
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Upload any relevant documents (optional):</label>
                        <input type="file" class="w-full p-2 border border-gray-300 rounded">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Rate the quality of our services:</label>
                        <div class="flex space-x-2">
                            <label class="flex items-center">
                                <input type="radio" name="quality" value="1" class="mr-2"> 1
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="quality" value="2" class="mr-2"> 2
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="quality" value="3" class="mr-2"> 3
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="quality" value="4" class="mr-2"> 4
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="quality" value="5" class="mr-2"> 5
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Rate the value for money of our services:</label>
                        <div class="flex space-x-2">
                            <label class="flex items-center">
                                <input type="radio" name="value" value="1" class="mr-2"> 1
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="value" value="2" class="mr-2"> 2
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="value" value="3" class="mr-2"> 3
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="value" value="4" class="mr-2"> 4
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="value" value="5" class="mr-2"> 5
                            </label>
                        </div>
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