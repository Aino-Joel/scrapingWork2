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
    var xValues = [];
     <?php 
     $skillArr = array();
     foreach($jobs as $job){ 
         foreach(explode(',',$job['required_skills']) as $skill){
            array_push($skillArr, $skill) ;}
        $skills = json_encode($skillArr);
        echo("\nxValues =".$skills);
     } ?>

function count(arr){
    const counts = {};
    arr.forEach(element =>{
        counts[element]=(counts[element] || 0)+1;
    });
    return counts;
}

    plotVals = ["rest","javascript","django","others","database","sql"]
    vals = count(xValues);
    const popular = ["sql","rest", "javascript", "django", "database","python","\npython","\r\n\r\nrest","restapi","sql","postgresql","mysql"]
    var others = 0
    for(const key in vals){
        if(!popular.includes(key)){
            others+=vals[key];
        }else{
            continue;
        }
    }
    // console.log(others);
    console.log(vals);
    const yValues = [(vals.rest+vals.restapi),vals.javascript,vals.django,others,vals.database,(vals.sql+vals.postgresql+vals.mysql)]

    var barColors = [
    "#b91d47",
    "#00aba9",
    "#2b5797",
    "#e8c3b9",
    "#0a121d",
    "#1e7145"
    ];

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