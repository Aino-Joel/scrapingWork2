<!DOCTYPE html>
<html lang="en">
<head>
    <title>Web Scraping</title>
    <link rel="stylesheet" type="text/css" href="view.css">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <style>
        .brand{
            background: #cbb09c !important;
            width: 200px;
            height: 50px;
            font-size:x-large;
            font-weight:bold;   
        }
            .brand-text{
            color: #cbb09c !important;
        }
        #searchBar{
            display: flex;
            margin-left: 150px;
        }
        #search{
            width: 300px;
            margin: 10px;
        }
        #search::placeholder{
            color:black;
            opacity:0.7;
        }

    </style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Group ALPHA</a>
            <ul id="nav-mobile" class="right hide-on-small-and-down">
                <li><button class="btn brand" id="scrapeBtn">SCRAPE</button></li>
                <li><a href="chart.php" class="btn brand z-depth-0">Chart</a></li>
                <li>
                <li><a href="clear.php" class="btn brand z-depth-0">Clear</a></li>
                </li>
            </ul>
        </div>
    </nav> 

<h4>Python Jobs</h4>

<br>
<div class="loading-overlay">
  <div class="loader"></div>
</div>

<div id="view">
    <table border="1">
        <thead>
            <tr>
                <th>Company Name</th>
                <th>Required Skills</th>
                <th>More Info</th>
            </tr>
        </thead>
        <tbody>
            <!-- Fetch the row data -->
            <?php
    include 'connect.php';

    $sql = 'SELECT * FROM scraped';
    
    $result = mysqli_query($con,$sql);
                
    while($row = mysqli_fetch_assoc($result)){
        echo "<tr>";
    echo "<td>".$row['company_name']."</td>";
    echo "<td>".$row['required_skills']."</td>";
    echo "<td>".$row['more_info']."</td>";
} 
    ?>

        </tbody>
    </table>
    </div>

<script>
    // Function to show the loading overlay
    function showLoadingOverlay() {
    const overlay = document.querySelector('.loading-overlay');
    overlay.style.display = 'block';
    }

    // Function to hide the loading overlay
    function hideLoadingOverlay() {
    const overlay = document.querySelector('.loading-overlay');
    overlay.style.display = 'none';
    }

    // Get the button element with the ID 'scrapeBtn' and store it in the 'scrapeButton' variable.
    const scrapeButton = document.getElementById('scrapeBtn');

    // Add a click event listener to the 'scrapeButton'.
    scrapeButton.addEventListener('click', () => {
        showLoadingOverlay();
        // Send an HTTP POST request to the flask server.
        fetch('http://127.0.0.1:5000/execute-scraping', {
            method: 'POST' // Specify the HTTP method as POST.
        })
        // Once the response is received, parse it as JSON.
        .then(response => response.json())
        // Handle the parsed JSON data.
        .then(data => {
            // Check if the 'status' property in the JSON data is 'success'.
            if (data.status == 'success') {     // If 'status' is 'success', show a success alert to the user.
                alert('Scraping completed successfully.');
                // Reload the current page.
                location.reload();
                hideLoadingOverlay();
            } else {
                // If 'status' is not 'success', show an error alert with the error message from the JSON data.
                alert('Error: ' + data.message);
                hideLoadingOverlay();
            }
        })
        // Catch and handle any errors that occur during the fetch operation.
        .catch(error => {
            console.error('Error:', error);
        });
    });

    </script>
</body>
</html>