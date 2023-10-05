<?php 

include 'connect.php';

$sql = 'SELECT * FROM scraped';

$result = mysqli_query($con,$sql);

$jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);

//free results from memory
mysqli_free_result($result);

mysqli_close($con);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Web Scraping</title>
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
      <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.4/Chart.js"></script>
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
        canvas{
            display: block;
            margin: 0 auto;
        }

    </style>
</head>
<body class="grey lighten-4">
    <nav class="white z-depth-0">
        <div class="container">
            <a href="index.php" class="brand-logo brand-text">Group ALPHA</a>
        </div>
    </nav> 

<br><br><canvas id="myChart" style="width:100%;max-width:700px"></canvas>

<script>
    // Define an empty array to hold skill values
    var xValues = [];

    <?php 
    // Initialize an empty array to store the skills
    $skillArr = array();

    //Loop through each job item 
    foreach($jobs as $job){ 
        
        //Loop through the 'required_skills' element of each job and seperate the skills where a comma appears
        foreach(explode(',',$job['required_skills']) as $skill){

            //Append each skill to the skillArr array
            array_push($skillArr, $skill);
        }

        //Convert the PHP array into JSON for transfer to Javascript
        $skills = json_encode($skillArr);
    }

        //Store the final values from skillArr in the xValues javascript array
        echo("xValues =".$skills);
     ?>

    // Function to count occurrences of elements in an array
    function count(arr){
        const counts = {};
        arr.forEach(element =>{
            counts[element]=(counts[element] || 0)+1;
        });
        return counts;
    }

    // Define an array of popular skills for the chart
    plotVals = ["rest","javascript","django","others","database","sql"];

    // Count the occurrences of skills in xValues array
    vals = count(xValues);

    // Define an array of popular skills to be excluded from the 'others' section
    const popular = ["sql","rest", "javascript", "django", "database","python","\npython","\r\n\r\nrest","restapi","sql","postgresql","mysql"]
    
    // Initialize a variable for counting other skills
    var others = 0
    
    // Loop through the counted values
    for(const key in vals){
        // Check if the skill is not in the popular array
        if(!popular.includes(key)){
            others+=vals[key];
        }else{
            continue;
        }
    }
    
    // Define an array of yValues for the chart
    const yValues = [(vals.rest+vals.restapi),vals.javascript,vals.django,others,vals.database,(vals.sql+vals.postgresql+vals.mysql)]

    // Define an array of colors for pie chart
    var barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#0a121d",
    "#1e7145"
    ];

    // Create a pie chart using Chart.js
    new Chart("myChart", {
    type: "pie",
    data: {
        labels: plotVals,
        datasets: [{
        backgroundColor: barColors,
        data: yValues
        }]
    },
    options: {
        title: {
        display: true,
        text: "Required skills for Python jobs",
        fontSize: 16
        }
    }
    });
</script>

</body>
</html>