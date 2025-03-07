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
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect and sanitize form data
    $full_name = $conn->real_escape_string(trim($_POST['full-name']));
    $email = $conn->real_escape_string(trim($_POST['email']));
    $phone_number = $conn->real_escape_string(trim($_POST['phone-number']));
    $age_group = $conn->real_escape_string(trim($_POST['age-group']));
    $gender = $conn->real_escape_string(trim($_POST['gender']));
    $community_duration = $conn->real_escape_string(trim($_POST['community-duration']));
    $event_frequency = $conn->real_escape_string(trim($_POST['event-frequency']));
    $satisfaction = $conn->real_escape_string(trim($_POST['satisfaction']));
    $improvements = $conn->real_escape_string(trim($_POST['improvements']));
    $challenges = $conn->real_escape_string(trim($_POST['challenges']));
    $contributions = $conn->real_escape_string(trim($_POST['contributions']));
    $comments_suggestions = $conn->real_escape_string(trim($_POST['comments-suggestions']));

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO community_survey (full_name, email, phone_number, age_group, gender, community_duration, event_frequency, event_types, satisfaction, improvements, challenges, contributions, comments_suggestions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $full_name, $email, $phone_number, $age_group, $gender, $community_duration, $event_frequency, $event_types, $satisfaction, $improvements, $challenges, $contributions, $comments_suggestions);

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
                    <p><strong>Age Group:</strong> ${event.target.elements['age-group'].value}</p>
                    <p><strong>Gender:</strong> ${event.target.elements['gender'].value}</p>
                    <p><strong>How long have you lived in this community?</strong> ${event.target.elements['community-duration'].value}</p>
                    <p><strong>How often do you participate in community events?</strong> ${event.target.elements['event-frequency'].value}</p>
                    <p><strong>What types of community events do you prefer?</strong> ${Array.from(event.target.elements['event-types']).filter(el => el.checked).map(el => el.value).join(', ')}</p>
                    <p><strong>How satisfied are you with the current community services?</strong> ${event.target.elements['satisfaction'].value}</p>
                    <p><strong>What improvements would you like to see in the community?</strong> ${event.target.elements['improvements'].value}</p>
                    <p><strong>What are the biggest challenges facing your community?</strong> ${event.target.elements['challenges'].value}</p>
                    <p><strong>How can you contribute to improving the community?</strong> ${event.target.elements['contributions'].value}</p>
                    <p><strong>Any additional comments or suggestions?</strong> ${event.target.elements['comments-suggestions'].value}</p>
                </div>
            `;
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <form action="" method="POSt">
        <div class="flex justify-start mb-4">
            <a href="javascript:history.back()" class="text-gray-800 text-2xl">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1 class="text-3xl font-bold text-center mb-8">Integral And Advance Polling and Data Collection Form System</h1>
        <div class="flex justify-center mb-8">
            <div class="mr-4">
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
            <!-- Community Engagement Survey Template -->
            <div id="form-container" class="bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">Community Engagement Survey</h2>
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
                        <label class="block text-gray-700">Age Group:</label>
                        <select name="age-group" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select age group</option>
                            <option value="18-24">18-24</option>
                            <option value="25-34">25-34</option>
                            <option value="35-44">35-44</option>
                            <option value="45-54">45-54</option>
                            <option value="55-64">55-64</option>
                            <option value="65+">65+</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Gender:</label>
                        <select name="gender" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="non_binary">Non-binary</option>
                            <option value="prefer_not_to_say">Prefer not to say</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How long have you lived in this community?</label>
                        <select name="community-duration" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select duration</option>
                            <option value="less_than_1_year">Less than 1 year</option>
                            <option value="1_5_years">1-5 years</option>
                            <option value="5_10_years">5-10 years</option>
                            <option value="more_than_10_years">More than 10 years</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How often do you participate in community events?</label>
                        <select name="event-frequency" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select frequency</option>
                            <option value="never">Never</option>
                            <option value="rarely">Rarely</option>
                            <option value="sometimes">Sometimes</option>
                            <option value="often">Often</option>
                            <option value="always">Always</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">What types of community events do you prefer? (Select all that apply)</label>
                        <div class="flex flex-wrap">
                            <label class="flex items-center mr-4 mb-2">
                                <input type="checkbox" name="event-types" value="Cultural" class="mr-2"> Cultural
                            </label>
                            <label class="flex items-center mr-4 mb-2">
                                <input type="checkbox" name="event-types" value="Sports" class="mr-2"> Sports
                            </label>
                            <label class="flex items-center mr-4 mb-2">
                                <input type="checkbox" name="event-types" value="Educational" class="mr-2"> Educational
                            </label>
                            <label class="flex items-center mr-4 mb-2">
                                <input type="checkbox" name="event-types" value="Social" class="mr-2"> Social
                            </label>
                            <label class="flex items-center mr-4 mb-2">
                                <input type="checkbox" name="event-types" value="Environmental" class="mr-2"> Environmental
                            </label>
                            <label class="flex items-center mr-4 mb-2">
                                <input type="checkbox" name="event-types" value="Other" class="mr-2"> Other
                            </label>
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How satisfied are you with the current community services?</label>
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
                        <label class="block text-gray-700">What improvements would you like to see in the community?</label>
                        <textarea name="improvements" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your suggestions"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">What are the biggest challenges facing your community?</label>
                        <textarea name="challenges" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter the challenges"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How can you contribute to improving the community?</label>
                        <textarea name="contributions" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your contributions"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Any additional comments or suggestions?</label>
                        <textarea name="comments-suggestions" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your comments or suggestions"></textarea>
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