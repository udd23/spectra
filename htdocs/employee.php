<?php
// Database connection
$servername = "localhost"; // Change if your database server is different
$username = "root"; // Your database username
$password = ""; // Your database password
$dbname = "user_system"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO employee_survey (full_name, email, department, job_title, job_satisfaction, work_environment, management, growth_opportunities, compensation_benefits, like_most, dislike_most, comments_suggestions, experience, contact) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssssssssss", $full_name, $email, $department, $job_title, $job_satisfaction, $work_environment, $management, $growth_opportunities, $compensation_benefits, $like_most, $dislike_most, $comments_suggestions, $experience, $contact);

    // Set parameters and execute
    $full_name = $_POST['full-name'];
    $email = $_POST['email'];
    $department = $_POST['department'];
    $job_title = $_POST['job-title'];
    $job_satisfaction = $_POST['job-satisfaction'];
    $work_environment = $_POST['work-environment'];
    $management = $_POST['management'];
    $growth_opportunities = $_POST['growth-opportunities'];
    $compensation_benefits = $_POST['compensation-benefits'];
    $like_most = $_POST['like-most'];
    $dislike_most = $_POST['dislike-most'];
    $comments_suggestions = $_POST['comments-suggestions'];
    $experience = $_POST['experience'];
    $contact = $_POST['contact'];

    if ($stmt->execute()) {
        echo "<h2 class='text-xl font-bold mb-4'>Thank you for submitting the survey!</h2>";
        echo "<p>You can see your response below:</p>";
        echo "<div class='bg-gray-100 p-4 rounded-lg'>";
        echo "<p><strong>Full Name:</strong> $full_name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Department:</strong> $department</p>";
        echo "<p><strong>Job Title:</strong> $job_title</p>";
        echo "<p><strong>How satisfied are you with your current job role?</strong> $job_satisfaction</p>";
        echo "<p><strong>How satisfied are you with the work environment?</strong> $work_environment</p>";
        echo "<p><strong>How satisfied are you with the management?</strong> $management</p>";
        echo "<p><strong>How satisfied are you with the opportunities for growth?</strong> $growth_opportunities</p>";
        echo "<p><strong>How satisfied are you with the compensation and benefits?</strong> $compensation_benefits</p>";
        echo "<p><strong>What do you like most about working here?</strong> $like_most</p>";
        echo "<p><strong>What do you dislike about working here?</strong> $dislike_most</p>";
        echo "<p><strong>Any additional comments or suggestions?</strong> $comments_suggestions</p>";
        echo "<p><strong>Rate the overall experience:</strong> $experience</p>";
        echo "<p><strong>Would you like to be contacted for further feedback?</strong> $contact</p>";
        echo "</div>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Integral And Advance Polling and Data Collection Form System</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-4">
        <div class="flex justify-start mb-4">
            <a href="javascript:history.back()" class="text-gray-800 text-2xl">
                <i class="fas fa-arrow-left"></i>
            </a>
        </div>
        <h1 class="text-3xl font-bold text-center mb-8">Integral And Advance Polling and Data Collection Form System</h1>
        <div class="flex justify-center">
            <div id="form-container" class="bg-white text-gray-800 p-6 rounded-lg shadow-lg w-full max-w-2xl">
                <h2 class="text-xl font-bold mb-4">Employee Satisfaction Survey</h2>
                <form action="" method="POST">
                    <div class="mb-4">
                        <label class="block text-gray-700">Full Name:</label>
                        <input type="text" name="full-name" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter full name" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Email:</label>
                        <input type="email" name="email" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter email" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Department:</label>
                        <input type="text" name="department" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter department" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Job Title:</label>
                        <input type="text" name="job-title" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter job title" required>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How satisfied are you with your current job role?</label>
                        <select name="job-satisfaction" class="w-full p-2 border border-gray-300 rounded" required>
                            <option value="">Select satisfaction level</option>
                            <option value="very_satisfied">Very Satisfied</option>
                            <option value="satisfied">Satisfied</option>
                            <option value="neutral">Neutral</option>
                            <option value="dissatisfied">Dissatisfied</option>
                            <option value="very_dissatisfied">Very Dissatisfied</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How satisfied are you with the work environment?</label>
                        <select name="work-environment" class="w-full p-2 border border-gray-300 rounded" required>
                            <option value="">Select satisfaction level</option>
                            <option value="very_satisfied">Very Satisfied</option>
                            <option value="satisfied">Satisfied</option>
                            <option value="neutral">Neutral</option>
                            <option value="dissatisfied">Dissatisfied</option>
                            <option value="very_dissatisfied">Very Dissatisfied</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How satisfied are you with the management?</label>
                        <select name="management" class="w-full p-2 border border-gray-300 rounded" required>
                            <option value="">Select satisfaction level</option>
                            <option value="very_satisfied">Very Satisfied</option>
                            <option value="satisfied">Satisfied</option>
                            <option value="neutral">Neutral</option>
                            <option value="dissatisfied">Dissatisfied</option>
                            <option value="very_dissatisfied">Very Dissatisfied</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How satisfied are you with the opportunities for growth?</label>
                        <select name="growth-opportunities" class="w-full p-2 border border-gray-300 rounded" required>
                            <option value="">Select satisfaction level</option>
                            <option value="very_satisfied">Very Satisfied</option>
                            <option value="satisfied">Satisfied</option>
                            <option value="neutral">Neutral</option>
                            <option value="dissatisfied">Dissatisfied</option>
                            <option value="very_dissatisfied">Very Dissatisfied</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">How satisfied are you with the compensation and benefits?</label>
                        <select name="compensation-benefits" class="w-full p-2 border border-gray-300 rounded" required>
                            <option value="">Select satisfaction level</option>
                            <option value="very_satisfied">Very Satisfied</option>
                            <option value="satisfied">Satisfied</option>
                            <option value="neutral">Neutral</option>
                            <option value="dissatisfied">Dissatisfied</option>
                            <option value="very_dissatisfied">Very Dissatisfied</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">What do you like most about working here?</label>
                        <textarea name="like-most" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your feedback" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">What do you dislike about working here?</label>
                        <textarea name="dislike-most" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your feedback" required></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Any additional comments or suggestions?</label>
                        <textarea name="comments-suggestions" class="w-full p-2 border border-gray-300 rounded" placeholder="Enter your comments or suggestions"></textarea>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700">Rate the overall experience:</label>
                        <div class="flex space-x-2">
                            <label class="flex items-center">
                                <input type="radio" name="experience" value="1" class="mr-2" required> 1
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
                                <input type="radio" name="contact" value="yes" class="mr-2" required> Yes
                            </label>
                            <label class="flex items-center">
                                <input type="radio" name="contact" value="no" class="mr-2"> No
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