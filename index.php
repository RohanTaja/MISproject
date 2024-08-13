<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Undefined</title>
    <!--material cdn-->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <aside>
            <div class="top">
            <div class="logo">
                <h2>UND<span class="danger">EFiNED</span></h2>
            </div>
            <!-- <div class="close" id="close-btn">
                <span class="material-symbols-outlined">close</span> 
            </div>-->
           
            </div>
            <div class="sidebar">
                <a href="#" class="active">
                    <span class="material-symbols-outlined">dashboard</span>
                    <h3>Dashboard</h3>
                </a>
                <a href="#">
                    <span class="material-symbols-outlined">
                        search
                        </span>
                    <h3>Search</h3>
                </a>
            </div>
        </aside>
        <main>
            <h1> Dashboard</h1>
            <div class="bikes">
                <h2>
                    MotorBike Price Comparison
                </h2>
                <table>
                    <thead>
                        <tr>
                            <th>Model Name</th>
                            <th>Price (INR)</th>
                            <th>Price (NPR)</th>
                            <th>Price (NPR) adding <br>customduty in INR</th>
                        </tr>
                    </thead>
                    <?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "mysql";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define duty rates and charges
$basic_customs_duty_rate = 0.40; // 40% Basic Customs Duty
$excise_duty_rate = 0.60; // 60% Excise Duty
$road_maintenance_charge = 10000; // Road Maintenance Charge
$vat_rate = 0.13; // 13% VAT

// Query to fetch data from the 'bikes' table
$sql = "SELECT model_name, price_inr, price_npr FROM bikes";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Fetch rows
    while($row = $result->fetch_assoc()) {
        // Get the price in NPR
        $price_npr = $row['price_inr'];
        
        // Calculate customs duty
        $customs_duty = $price_npr * $basic_customs_duty_rate;
        
        // Calculate total before excise duty
        $total_before_excise = $price_npr + $customs_duty;
        
        // Calculate excise duty
        $excise_duty = $total_before_excise * $excise_duty_rate;
        
        // Calculate total before VAT
        $total_before_vat = $total_before_excise + $excise_duty + $road_maintenance_charge;
        
        // Calculate VAT
        $vat = $total_before_vat * $vat_rate;
        
        // Calculate total cost in Nepalese Rupees
        $total_cost_npr = $total_before_vat + $vat;

        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['model_name']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price_inr']) . "</td>";
        echo "<td>" . htmlspecialchars($row['price_npr']) . "</td>";
        echo "<td>" . htmlspecialchars(number_format($total_cost_npr, 2)) . "</td>";
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>No data available</td></tr>";
}

// Close connection
$conn->close();
?>

                </table>
                <a href="#">Show all</a>
            </div>
        </main>
        <div class="right">
            <div class="top">
                <button id="btn-menu">
                    <span class="material-symbols-outlined">
                        menu
                        </span>
                </button>
                    <div class="theme-toggler">
                        <span class="material-symbols-outlined active">light_mode</span>
                        <span class="material-symbols-outlined">dark_mode</span>
                    </div>
                    <div class="profile">
                        <div class="info">
                            <p><b>ADMIN
                            </b></p>
                        </div> 
                        <div class="profile-photo">
                            <img src="./pfp.jpg" alt="">
                        </div>   
                    </div>
            </div>
            <div class="recent-updates">
                <h2>Recent updates</h2>
                <div class="updates">
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./s1.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>NS 200</b> assembly started in Nepal</p>
                            <small class="text-muted">2 Days ago</small>
                        
                        </div>
                    </div>
                    <div class="update">
                        <div class="profile-photo">
                            <img src="./s2.jpg" alt="">
                        </div>
                        <div class="message">
                            <p><b>N 160</b> recently launched in Nepal</p>
                            <small class="text-muted">1 Day ago</small>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <script src="index.js"></script>    
</body>

</html>