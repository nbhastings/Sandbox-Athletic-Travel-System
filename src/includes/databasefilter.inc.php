<?php

if(isset($_POST['search']))
{
    $valueToSearch = $_POST['valueToSearch'];
    // search in all table columns
    // using concat mysql function
    $query = "SELECT * FROM `databasefiltertest` WHERE CONCAT(`id`, `fname`, `lname`, `age`) LIKE '%".$valueToSearch."%'";
    $search_result = filterTable($query);
    
}
 else {
    $query = "SELECT * FROM `databasefiltertest`";
    $search_result = filterTable($query);
}

// function to connect and execute the query
function filterTable($query)
{
	require 'dbh.inc.php';
    $filter_Result = mysqli_query($conn, $query);
    return $filter_Result;
}

?>

