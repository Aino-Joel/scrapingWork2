<?php 
    include 'connect.php';

    $sql = 'TRUNCATE TABLE scraped';

    if(mysqli_query($con, $sql)){ ?>
        
        <script>
            window.alert("Table Data deleted");
            window.location = "index.php";
        </script>

<?php }  ?>