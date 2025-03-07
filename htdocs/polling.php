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
    $age = isset($_POST['age']) ? (int)$_POST['age'] : null;
    $gender = $conn->real_escape_string(trim($_POST['gender']));
    $political_affiliation = $conn->real_escape_string(trim($_POST['political-affiliation']));
    $satisfaction = $conn->real_escape_string(trim($_POST['satisfaction']));
    $important_issues = $conn->real_escape_string(trim($_POST['important-issues']));
    $vote_likelihood = $conn->real_escape_string(trim($_POST['vote-likelihood']));
    $vote_party = $conn->real_escape_string(trim($_POST['vote-party']));
    $comments_suggestions = $conn->real_escape_string(trim($_POST['comments-suggestions']));

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO political_survey (full_name, email, phone_number, age, gender, political_affiliation, satisfaction, important_issues, vote_likelihood, vote_party, comments_suggestions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssissssssss", $full_name, $email, $phone_number, $age, $gender, $political_affiliation, $satisfaction, $important_issues, $vote_likelihood, $vote_party, $comments_suggestions);

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
                    <p><strong>Age:</strong> ${event.target.elements['age'].value}</p>
                    <p><strong>Gender:</strong> ${event.target.elements['gender'].value}</p>
                    <p><strong>Political Affiliation:</strong> ${event.target.elements['political-affiliation'].value}</p>
                    <p><strong>How satisfied are you with the current government?</strong> ${event.target.elements['satisfaction'].value}</p>
                    <p><strong>What are the most important issues to you?</strong> ${event.target.elements['important-issues'].value}</p>
                    <p><strong>How likely are you to vote in the next election?</strong> ${event.target.elements['vote-likelihood'].value}</p>
                    <p><strong>Which party do you intend to vote for?</strong> ${event.target.elements['vote-party'].value}</p>
                    <p><strong>Any additional comments or suggestions?</strong> ${event.target.elements['comments-suggestions'].value}</p>
                </div>
            `;
        }

        function shareSurvey() {
            const surveyLink = window.location.href;
            const shareText = Check out this survey: ${surveyLink};
            if (navigator.share) {
                navigator.share({
                    title: 'Political Polling Survey',
                    text: shareText,
                    url: surveyLink
                }).then(() => {
                    console.log('Thanks for sharing!');
                }).catch(console.error);
            } else {
                prompt('Copy this link to share the survey:', surveyLink);
            }
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
            <!-- Political Polling Survey Template -->
            <div id="form-container" class="bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">Political Polling Survey</h2>
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
                        <label class="block text-gray-700">Age:</label>
                        <input type="number" name="age" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your age">
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
                        <label class="block text-gray-700">Political Affiliation:</label>
                        <select name="political-affiliation" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select affiliation</option>
                            <option value="democrat">Democrat</option>
                            <option value="republican">Republican</option>
                            <option value="independent">Independent</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How satisfied are you with the current government?</label>
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
                        <label class="block text-gray-700">What are the most important issues to you?</label>
                        <textarea name="important-issues" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter the issues that matter most to you"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How likely are you to vote in the next election?</label>
                        <select name="vote-likelihood" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select likelihood</option>
                            <option value="very_likely">Very Likely</option>
                            <option value="likely">Likely</option>
                            <option value="neutral">Neutral</option>
                            <option value="unlikely">Unlikely</option>
                            <option value="very_unlikely">Very Unlikely</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Which party do you intend to vote for?</label>
                        <select name="vote-party" class="w-full p-2 border border-gray-300 rounded">
                            <option value="">Select party</option>
                            <option value="democrat">Democrat</option>
                            <option value="republican">Republican</option>
                            <option value="independent">Independent</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Any additional comments or suggestions?</label>
                        <textarea name="comments-suggestions" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your comments or suggestions"></textarea>
                    </div>
                    <div class="flex space-x-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded" onclick="shareSurvey()">
                            <i class="fas fa-share"></i> Share
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>