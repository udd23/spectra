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
    <title>Survey Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
    </style>
</head>
<body class="bg-gray-100">
    <!-- Header -->
    <header class="bg-white shadow-sm">
        <div class="container mx-auto px-4 py-2 flex justify-between items-center">
            <div class="text-2xl font-bold">
                <span class="text-green-400">Spectra</span>
            </div>
            <div class="flex items-center space-x-4">
                <a class="text-gray-600" href="home.php">Home</a>
                <a class="text-gray-600" href="contact.php">Help center</a>
                <a class="bg-green-600 text-white px-4 py-2 rounded" href="survey.php">+ New Survey</a>
                <a class="bg-blue-600 text-white px-4 py-2 rounded" href="quizz.php">+ New Quiz</a>

                <!-- User Dropdown Section -->
                <div class="relative">
                    <button id="user-dropdown-btn" class="text-gray-600 flex items-center focus:outline-none">
                        <i class="fas fa-user-circle text-2xl"></i>
                        <span id="username-display" class="ml-2"><?php echo htmlspecialchars($username); ?></span>
                        <i class="fas fa-caret-down ml-1"></i>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="user-dropdown-menu" class="absolute right-0 mt-2 w-48 bg-white rounded shadow-md hidden">
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Profile</a>
                        <a href="#" class="block px-4 py-2 text-gray-700 hover:bg-gray-100">Settings</a>
                        <a href="auth.php?logout=true" class="block px-4 py-2 text-red-600 hover:bg-gray-100">Logout</a>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="container mx-auto px-4 py-8">
        <h1 class="text-3xl font-semibold mb-6">Welcome, <?php echo htmlspecialchars($username); ?>!</h1>

        <!-- My Surveys Section -->
        <div class="w-full px-4 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">My Surveys</h2>
                <div class="overflow-x-auto">
                    <table class="min-w-full bg-white">
                        <thead>
                            <tr>
                                <th class="py-2 px-4 bg-green-600 text-white">Title</th>
                                <th class="py-2 px-4 bg-green-600 text-white">Created At</th>
                                <th class="py-2 px-4 bg-green-600 text-white">Answers</th>
                                <th class="py-2 px-4 bg-green-600 text-white">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php if ($last_survey_title): ?>
                            <tr>
                                <td class="text-center py-4"><?php echo htmlspecialchars($last_survey_title); ?></td>
                                <td class="text-center py-4">Just now</td>
                                <td class="text-center py-4">0</td>
                                <td class="text-center py-4">
                                    <button class="bg-blue-500 text-white px-2 py-1 rounded hover:bg-blue-600">View</button>
                                </td>
                            </tr>
                            <?php else: ?>
                            <tr>
                                <td class="text-center py-4" colspan="4">No survey to display</td>
                            </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Survey Templates Section -->
        <div class="w-full px-4 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Survey Templates</h2>
                <div class="relative">
                    <button class="absolute left-0 top-1/2 transform -translate-y-1/2 bg-gray-200 text-gray-600 p-2 rounded-full focus:outline-none" id="scroll-left">
                        <i class="fas fa-chevron-left"></i>
                    </button>
                    <div class="overflow-x-auto whitespace-nowrap" id="templates-container">
                        <div class="inline-block border p-4 rounded mx-2">
                            <img alt="Template thumbnail for Customer Satisfaction Survey" class="w-full h-32 object-cover mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/iv_MLu_9Any-tzjUXLKfKYySQQTwse70Zn23OccV6xs.jpg" width="300"/>
                            <h3 class="text-md font-semibold mb-2">Customer Satisfaction Survey</h3>
                            <p class="text-gray-600 mb-4">Gather feedback from your customers to improve your services.</p>
                            <a class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" href="customer.php">Use Template</a>
                        </div>
                        <div class="inline-block border p-4 rounded mx-2">
                            <img alt="Template thumbnail for Employee Engagement Survey" class="w-full h-32 object-cover mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/EP0XhLNgLNkjFS_aFXRw7u9aqY6LFZ5BFKNUdHo4Uyg.jpg" width="300"/>
                            <h3 class="text-md font-semibold mb-2">Employee Engagement Survey</h3>
                            <p class="text-gray-600 mb-4">Measure the engagement and satisfaction of your employees.</p>
                            <a class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" href="employee1.php">Use Template</a>
                        </div>
                        <div class="inline-block border p-4 rounded mx-2">
                            <img alt="Template thumbnail for Product Feedback Survey" class="w-full h-32 object-cover mb-4" height="200" src="https://storage.googleapis.com/a1aa/image/fhZTbiikkgb7UOh9GEG9kSGqNJS1uAepFJhrLgkxZYM.jpg" width="300"/>
                            <h3 class="text-md font-semibold mb-2">Product Feedback Survey</h3>
                            <p class="text-gray-600 mb-4">Collect feedback on your products to enhance their quality.</p>
                            <a class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" href="product.php">Use Template</a>
                        </div>
                    </div>
                    <button class="absolute right-0 top-1/2 transform -translate-y-1/2 bg-gray-200 text-gray-600 p-2 rounded-full focus:outline-none" id="scroll-right">
                        <i class="fas fa-chevron-right"></i>
                    </button>
                </div>
            </div>
        </div>

        <!-- User Statistics Section -->
        <div class="w-full px-4 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">User Statistics</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <div class="text-center p-4 border rounded-lg">
                        <h3 class="text-3xl font-semibold text-green-600 mb-2">150</h3>
                        <p class="text-gray-600">Total Surveys</p>
                    </div>
                    <div class="text-center p-4 border rounded-lg">
                        <h3 class="text-3xl font-semibold text-green-600 mb-2">1200</h3>
                        <p class="text-gray-600">Total Responses</p>
                    </div>
                    <div class="text-center p-4 border rounded-lg">
                        <h3 class="text-3xl font-semibold text-green-600 mb-2">300</h3>
                        <p class="text-gray-600">Active Users</p>
                    </div>
                    <div class="text-center p-4 border rounded-lg">
                        <h3 class="text-3xl font-semibold text-green-600 mb-2">50</h3>
                        <p class="text-gray-600">Shared Surveys</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Recent Activities Section -->
        <div class="w-full px-4 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Recent Activities</h2>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span>You created a new survey titled "Customer Satisfaction Survey".</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span>You received 10 new responses for "Employee Engagement Survey".</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-check-circle text-green-600 mr-2"></i>
                        <span>You shared "Product Feedback Survey" with 5 new users.</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Upcoming Surveys Section -->
        <div class="w-full px-4 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Upcoming Surveys</h2>
                <ul class="space-y-4">
                    <li class="flex items-center">
                        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                        <span>"Market Research Survey" is scheduled for tomorrow.</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                        <span>"Customer Feedback Survey" is scheduled for next week.</span>
                    </li>
                    <li class="flex items-center">
                        <i class="fas fa-calendar-alt text-blue-600 mr-2"></i>
                        <span>"Employee Satisfaction Survey" is scheduled for next month.</span>
                    </li>
                </ul>
            </div>
        </div>

        <!-- Interactive Section: Create a Poll -->
        <div class="w-full px-4 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Create a Poll</h2>
                <form>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2" for="poll-title">Poll Title</label>
                        <input class="w-full px-4 py-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600" id="poll-title" name="poll-title" type="text"/>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2" for="poll-options">Poll Options</label>
                        <div id="poll-options">
                            <input class="w-full px-4 py-2 mb-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600" name="poll-option[]" type="text"/>
                            <input class="w-full px-4 py-2 mb-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600" name="poll-option[]" type="text"/>
                        </div>
                        <button class="mt-2 text-green-600 hover:text-green-800" id="add-option" type="button">+ Add another option</button>
                    </div>
                    <button class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700" type="submit">Create Poll</button>
                </form>
            </div>
        </div>

        <!-- Interactive Section: Data Visualization -->
        <div class="w-full px-4 mb-8">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4">Data Visualization</h2>
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Survey Responses</h3>
                    <select class="border rounded-lg px-4 py-2 focus:outline-none focus:ring-2 focus:ring-green-600" id="survey-select">
                        <option value="survey1">Customer Satisfaction Survey</option>
                        <option value="survey2">Employee Engagement Survey</option>
                        <option value="survey3">Product Feedback Survey</option>
                    </select>
                </div>
                <div class="relative h-64">
                    <canvas id="survey-chart"></canvas>
                </div>
            </div>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Dropdown Toggle
        document.getElementById('user-dropdown-btn').addEventListener('click', function () {
            document.getElementById('user-dropdown-menu').classList.toggle('hidden');
        });

        // Scroll buttons
        document.getElementById('scroll-left').addEventListener('click', function () {
            document.getElementById('templates-container').scrollBy({
                left: -300,
                behavior: 'smooth'
            });
        });

        document.getElementById('scroll-right').addEventListener('click', function () {
            document.getElementById('templates-container').scrollBy({
                left: 300,
                behavior: 'smooth'
            });
        });

        // Add Poll Option
        document.getElementById('add-option').addEventListener('click', function () {
            const pollOptions = document.getElementById('poll-options');
            const newOption = document.createElement('input');
            newOption.type = 'text';
            newOption.name = 'poll-option[]';
            newOption.className = 'w-full px-4 py-2 mb-2 border rounded-lg focus:outline-none focus:ring-2 focus:ring-green-600';
            pollOptions.appendChild(newOption);
        });

        // Chart.js Initialization
        const ctx = document.getElementById('survey-chart').getContext('2d');
        const surveyChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Option 1', 'Option 2', 'Option 3', 'Option 4'],
                datasets: [{
                    label: 'Responses',
                    data: [12, 19, 3, 5],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(153, 102, 255, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(153, 102, 255, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Update Chart Data on Survey Select Change
        document.getElementById('survey-select').addEventListener('change', function () {
            const selectedSurvey = this.value;
            // Update chart data based on selected survey
            // This is just a placeholder. You should replace it with actual data fetching logic.
            if (selectedSurvey === 'survey1') {
                surveyChart.data.datasets[0].data = [12, 19, 3, 5];
            } else if (selectedSurvey === 'survey2') {
                surveyChart.data.datasets[0].data = [7, 11, 5, 8];
            } else if (selectedSurvey === 'survey3') {
                surveyChart.data.datasets[0].data = [14, 9, 6, 4];
            }
            surveyChart.update();
        });
    </script>
</body>
</html> 