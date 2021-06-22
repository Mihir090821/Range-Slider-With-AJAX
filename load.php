<?php
$con = mysqli_connect("localhost", "root", "", "ranges");

$output = "";

if ($con) {

    if (isset($_POST['r1']) &&  isset($_POST['r2'])) {
        $range1 = $_POST['r1'];
        $range2 = $_POST['r2'];
        $sql = "SELECT * FROM  `pro` Where `price` BETWEEN $range1 AND $range2";
    } else {
        $sql = "SELECT * FROM  `pro`";
    }

    $result = mysqli_query($con, $sql);

    if (mysqli_num_rows($result) > 0) {
        $i = 1;
        while ($row = mysqli_fetch_assoc($result)) {

            $output .= "<tr class='text-center'>
               <td>{$i}</td>               
                <td>{$row['Pname']}</td>                 
                <td>{$row['price']}</td>  
               </tr>";
            $i++;
        }
    } else {
        $output .= "<td colspan='3'><h3>Data Not Found In This Price Range</h3> </td> ";
    }
} else {
    $output .= "Connection Failled" . "<br>";
    $output .= mysqli_connect_error();
}

echo $output;
mysqli_close($con);
