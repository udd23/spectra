<?php
include 'research'; // Include database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $research_title = $_POST['research-title'];
    $principal_investigator = $_POST['principal-investigator'];
    $institution = $_POST['institution'];
    $department = $_POST['department'];
    $funding_source = $_POST['funding-source'];
    $research_duration = $_POST['research-duration'];
    $research_abstract = $_POST['research-abstract'];
    $research_objectives = $_POST['research-objectives'];
    $methodology = $_POST['methodology'];
    $expected_outcomes = $_POST['expected-outcomes'];
    $research_team_members = $_POST['research-team-members'];
    $contact_email = $_POST['contact-email'];
    $contact_phone = $_POST['contact-phone'];

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO research (research_title, principal_investigator, institution, department, funding_source, research_duration, research_abstract, research_objectives, methodology, expected_outcomes, research_team_members, contact_email, contact_phone)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssssssss", $research_title, $principal_investigator, $institution, $department, $funding_source, $research_duration, $research_abstract, $research_objectives, $methodology, $expected_outcomes, $research_team_members, $contact_email, $contact_phone);

    if ($stmt->execute()) {
        echo "<script>alert('New record created successfully'); window.location.href='index.php';</script>";
    } else {
        echo "<script>alert('Error: " . $stmt->error . "');</script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integral And Advance Polling and Data Collection Form System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&family=Open+Sans:wght@400;600;700&family=Lato:wght@400;700&family=Montserrat:wght@400;700&family=Poppins:wght@400;700&family=Nunito:wght@400;700&family=Raleway:wght@400;700&family=Merriweather:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Open Sans', sans-serif;
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
            
        }
    </script>
</head>
<body class="bg-white text-gray-800">
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
                    <option value="'Open Sans', sans-serif">Open Sans</option>
                    <option value="'Roboto', sans-serif">Roboto</option>
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
            <!-- Scientific Research Survey Template -->
            <div id="form-container" class="bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">Scientific Research Survey</h2>
                <form onsubmit="handleSubmit(event)">
                    <div class="mb-4">
                        <label class="block text-gray-700">Research Title:</label>
                        <input type="text" name="research-title" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter research title">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Contact Phone:</label>
                        <input type="tel" name="contact-phone" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter contact phone number">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Contact Email:</label>
                        <input type="email" name="contact-email" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter contact email">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Research Team Members:</label>
                        <textarea name="research-team-members" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter research team members"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Principal Investigator:</label>
                        <input type="text" name="principal-investigator" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter principal investigator name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Institution:</label>
                        <input type="text" name="institution" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter institution name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Department:</label>
                        <input type="text" name="department" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter department name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Funding Source:</label>
                        <input type="text" name="funding-source" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter funding source">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Research Duration:</label>
                        <input type="text" name="research-duration" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter research duration">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Research Abstract:</label>
                        <textarea name="research-abstract" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter research abstract"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Research Objectives:</label>
                        <textarea name="research-objectives" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter research objectives"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Methodology:</label>
                        <textarea name="methodology" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter methodology"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Expected Outcomes:</label>
                        <textarea name="expected-outcomes" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter expected outcomes"></textarea>
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