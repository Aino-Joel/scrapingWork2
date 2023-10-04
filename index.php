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
                <li><a href="chart.php" class="btn brand z-depth-0">Chart</a></li>
            </ul>
        </div>
    </nav> 

<h4>Python Jobs</h4>
<!-- <form action="index.php" method="get">
    <div id="searchBar">
    <input id="search" name="unfam" type="text" placeholder="Enter Unfamiliar Skill">
    <input type="submit" name="search" value="Go" class="btn">
    </div>
</form> -->
<br>
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

</body>
</html>