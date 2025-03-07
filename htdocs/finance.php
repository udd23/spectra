<?php
// Database Connection
$host = "localhost";
$username = "root"; // Change if needed
$password = ""; // Change if needed
$database = "user_system";

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle Form Submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = $_POST['full-name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $occupation = $_POST['occupation'];
    $annual_income = $_POST['annual-income'];
    $monthly_expenses = $_POST['monthly-expenses'];
    $savings = $_POST['savings'];
    $investments = $_POST['investments'];
    $debts = $_POST['debts'];
    $financial_goals = $_POST['financial-goals'];
    $preferred_investment_types = $_POST['preferred-investment-types'];
    $risk_tolerance = $_POST['risk-tolerance'];
    $contact_email = $_POST['contact-email'];
    $contact_phone = $_POST['contact-phone'];

    $sql = "INSERT INTO finance_survey (full_name, age, gender, occupation, annual_income, monthly_expenses, savings, investments, debts, financial_goals, preferred_investment_types, risk_tolerance, contact_email, contact_phone)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sissdddsdsssss", $full_name, $age, $gender, $occupation, $annual_income, $monthly_expenses, $savings, $investments, $debts, $financial_goals, $preferred_investment_types, $risk_tolerance, $contact_email, $contact_phone);

    if ($stmt->execute()) {
        $message = "Survey submitted successfully!";
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Create Table If Not Exists
$conn->query("CREATE TABLE IF NOT EXISTS finance_survey (
    id INT AUTO_INCREMENT PRIMARY KEY,
    full_name VARCHAR(255) NOT NULL,
    age INT NOT NULL,
    gender ENUM('male', 'female', 'other') NOT NULL,
    occupation VARCHAR(255),
    annual_income DECIMAL(10,2),
    monthly_expenses DECIMAL(10,2),
    savings DECIMAL(10,2),
    investments TEXT,
    debts TEXT,
    financial_goals TEXT,
    preferred_investment_types TEXT,
    risk_tolerance ENUM('low', 'medium', 'high'),
    contact_email VARCHAR(255),
    contact_phone VARCHAR(20),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)");

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Finance Survey</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style> body { font-family: 'Open Sans', sans-serif; } </style>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-center mb-6">Finance Survey</h1>

        <?php if (!empty($message)) : ?>
            <div class="bg-green-500 text-white p-4 rounded mb-4"><?= $message ?></div>
        <?php endif; ?>


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


        <form action="" method="post" class="bg-white p-6 rounded-lg shadow-lg max-w-lg mx-auto">
            <div class="mb-4">
                <label class="block text-gray-700">Full Name:</label>
                <input type="text" name="full-name" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Age:</label>
                <input type="number" name="age" class="w-full p-2 border border-gray-300 rounded" required>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Gender:</label>
                <select name="gender" class="w-full p-2 border border-gray-300 rounded" required>
                    <option value="">Select</option>
                    <option value="male">Male</option>
                    <option value="female">Female</option>
                    <option value="other">Other</option>
                </select>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Contact Email:</label>
                <input type="email" name="contact-email" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Occupation:</label>
                <input type="text" name="occupation" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Annual Income:</label>
                <input type="number" name="annual-income" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Monthly Expenses:</label>
                <input type="number" name="monthly-expenses" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Savings:</label>
                <input type="number" name="savings" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Investments:</label>
                <textarea name="investments" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Debts:</label>
                <textarea name="debts" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Financial Goals:</label>
                <textarea name="financial-goals" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Preferred Investment Types:</label>
                <textarea name="preferred-investment-types" class="w-full p-2 border border-gray-300 rounded"></textarea>
            </div>
            <div class="mb-4">
                <label class="block text-gray-700">Risk Tolerance:</label>
                <select name="risk-tolerance" class="w-full p-2 border border-gray-300 rounded">
                    <option value="">Select</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>
            </div>
            <div class="flex space-x-4">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
                        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded">
                            <i class="fas fa-share"></i> Share
                        </button>
                    </div>  
        </head>
</body>
</html>
