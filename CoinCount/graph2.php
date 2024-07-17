
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Monthly Expenses and Income Bar Graphs</title>
<style>
    body {
        font-family: Arial, sans-serif;
        margin: 20px;
    }
    .chart-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: flex-start;
    }
    .chart-container .chart {
        width: 45%;
        margin: 10px;
    }
    .back-button {
        display: inline-block;
        padding: 10px 20px;
        background-color: #007bff;
        color: white;
        text-decoration: none;
        border: none;
        cursor: pointer;
        font-size: 16px;
        margin-bottom: 20px;
    }
    .back-button:hover {
        background-color: #0056b3;
    }
</style>
</head>
<body>
    <h2>Monthly Expenses and Income Bar Graphs</h2>

    <!-- Back button -->
    <a href="dashboard.php" class="back-button">Back to Dashboard</a>

    <div class="chart-container">
        <!-- Monthly Expenses Chart -->
        <div class="chart">
            <h3>Monthly Expenses</h3>
            <canvas id="monthlyExpensesChart"></canvas>
        </div>

        <!-- Monthly Income Chart -->
        <div class="chart">
            <h3>Monthly Income</h3>
            <canvas id="monthlyIncomeChart"></canvas>
        </div>
    </div>

    <!-- Include Chart.js library -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Data for monthly expenses chart
        var expenseLabels = [];
        var expenseData = [];

        // Data for monthly income chart
        var incomeLabels = [];
        var incomeData = [];

        <?php

        session_start(); // Start session if not already started

        // Check if user is logged in
        if(!isset($_SESSION['UID'])) {
            // Redirect to login page or handle unauthorized access
            header('Location: index.php');
            exit();
        }

        // Database connection
        $servername="localhost";
		$username="root";
		$password="";
		$db_name="expense";

        $conn = new mysqli($servername,$username,$password,$db_name,3307);
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        $user_id = $_SESSION['UID']; // Get user ID from session

        // Query to fetch monthly expenses
        $expenseQuery = "SELECT DATE_FORMAT(`expense_date`, '%Y-%m') AS `month`, SUM(`price`) AS `total` 
                         FROM `expense`
                         WHERE `added_by` = $user_id 
                         GROUP BY `month` 
                         ORDER BY `month` ASC";

        $expenseResult = $conn->query($expenseQuery);

        if ($expenseResult->num_rows > 0) {
            while ($row = $expenseResult->fetch_assoc()) {
                echo "expenseLabels.push('" . htmlspecialchars($row['month']) . "');\n";
                echo "expenseData.push(" . $row['total'] . ");\n";
            }
        }

        // Query to fetch monthly income
        $incomeQuery = "SELECT DATE_FORMAT(`date`, '%Y-%m') AS `month`, amount AS `total` 
                        FROM `income`
                        WHERE `added_by` = $user_id
                        GROUP BY `month` 
                        ORDER BY `month` ASC";

        $incomeResult = $conn->query($incomeQuery);

        if ($incomeResult->num_rows > 0) {
            while ($row = $incomeResult->fetch_assoc()) {
                echo "incomeLabels.push('" . htmlspecialchars($row['month']) . "');\n";
                echo "incomeData.push(" . $row['total'] . ");\n";
            }
        }

        // Close connection
        $conn->close();
        ?>

        // Create the monthly expenses chart
        var ctx1 = document.getElementById('monthlyExpensesChart').getContext('2d');
        var monthlyExpensesChart = new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: expenseLabels,
                datasets: [{
                    label: 'Monthly Expenses',
                    data: expenseData,
                    backgroundColor: 'rgba(255, 99, 132, 0.6)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) { return '$' + value; }
                        }
                    }]
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: 'black'
                    }
                }
            }
        });

        // Create the monthly income chart
        var ctx2 = document.getElementById('monthlyIncomeChart').getContext('2d');
        var monthlyIncomeChart = new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: incomeLabels,
                datasets: [{
                    label: 'Monthly Income',
                    data: incomeData,
                    backgroundColor: 'rgba(54, 162, 235, 0.6)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true,
                            callback: function(value) { return '$' + value; }
                        }
                    }]
                },
                legend: {
                    display: true,
                    position: 'top',
                    labels: {
                        fontColor: 'black'
                    }
                }
            }
        });
    </script>
</body>
</html>



