<?php
$pythonScriptPath = "C:\wamp64\www\scrape\graph.py";

$output = exec("python " . $pythonScriptPath);

// Output the result or handle errors as needed
if ($output !== null) {
    echo "Python script executed successfully: ".$output;
    // header('location: index.php');
} else {
    echo "Error executing Python script.";
}
?>