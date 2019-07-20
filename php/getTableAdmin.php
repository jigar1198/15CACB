<?php
session_start();

$$sessionHolder = $_SESSION['user'];

include 'connectionDb15CACB.php';

$orderBy = $_GET['orderByAdmin'];
$holder = $_GET['holderAdmin'];

if($orderBy == 'A') {
    $counter = 1;
    $sql = "SELECT submitTime, firstName, lastName, dateRegistered, identityUser, remarks, ackNumber, trackingNumber, uidNumber, clientUploadedDoc, taskStatus FROM documentStore WHERE identityUser ='client' ORDER BY submitTime DESC";
    $querySql = mysqli_query($connect, $sql);
    if(!$querySql) {
        echo "error: " . mysqli_error($connect);
    }
    while ($result = mysqli_fetch_array($querySql)) {
        echo "<tr>";
        echo "<th scope='row'>$counter</th>";
        echo "<td>" . $result['firstName'] . " " .$result['lastName'] . "</td>";
        echo "<td>" . $result['dateRegistered'] . "</td>";
        echo "<td><button type='button' data-container='body' class='btn btn-outline-light btn-sm' style='color: black;' data-toggle='tooltip' data-placement='left' title='". $result['remarks'] . "'>
        Remark
        </button></td>";

        echo "<td><input type='text' name='ackNumber_" . $counter . "' value='" . $result['ackNumber'] . "' required></td>";
        
        echo "<td>" . $result['trackingNumber'] . "</td>";
        echo "<td><input type='text' name='uidNumber_" . $counter . "' value='" . $result['uidNumber'] . "' required></td>";
        echo "<td align='center'><a href='" . $result['clientUploadedDoc'] . "' download><i class='fas fa-download fa-lg'></i></a></td>";
        echo "<td align='center'>
            <label for='fileUpload" . $counter . "'>
                <i class='fas fa-upload fa-lg'></i>
            </label>
            <input id='fileUpload" . $counter ."' name='fileFinal_".$counter."' type='file' style='display:none;'>
            <input type='hidden' name='fileID_".$counter."' value='" . $result['trackingNumber'] . "'>
        </td>
        <script>
            $('#fileUpload" . $counter . "').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#fileUpload" . $counter . "')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        </script>
        ";
        echo "<td><input type='submit' class='btn btn-success btn-sm' name='submitFinal_" . $counter . "'></td>";
        echo "<td align='center'><img class='statusLogo' src='".$result['taskStatus'] . "'></td>";
        echo "</tr>";
        ++$counter;
    }
} else {
    $counter = 1;
    $sql = "SELECT submitTime, firstName, lastName, dateRegistered, identityUser, ackNumber, trackingNumber, uidNumber, clientUploadedDoc, taskStatus, process FROM documentStore WHERE identityUser ='client' AND process='$orderBy' ORDER BY submitTime DESC";
    $querySql = mysqli_query($connect, $sql);
    while ($result = mysqli_fetch_array($querySql)) {
        echo "<tr>";
        echo "<th scope='row'>$counter</th>";
        echo "<td>" . $result['firstName'] . " " .$result['lastName'] . "</td>";
        echo "<td>" . $result['dateRegistered'] . "</td>";
        echo "<td><button type='button' data-container='body' class='btn btn-outline-light btn-sm' style='color: black;' data-toggle='tooltip' data-placement='left' title='". $result['remarks'] . "'>
        Remark
        </button></td>";
        echo "<td><input type='text' name='ackNumber_" . $counter . "' value='" . $result['ackNumber'] . "' required></td>";
        
        echo "<td>" . $result['trackingNumber'] . "</td>";
        echo "<td><input type='text' name='uidNumber_" . $counter . "' value='" . $result['uidNumber'] . "' required></td>";
        echo "<td align='center'><a href='" . $result['clientUploadedDoc'] . "' download><i class='fas fa-download fa-lg'></i></a></td>";
        echo "<td align='center'>
            <label for='fileUpload" . $counter . "'>
                <i class='fas fa-upload fa-lg'></i>
            </label>
            <input id='fileUpload" . $counter ."' name='fileFinal_".$counter."' type='file' style='display:none;'>
            <input type='hidden' name='fileID_".$counter."' value='" . $result['trackingNumber'] . "'>
        </td>
        <script>
            $('#fileUpload" . $counter . "').change(function() {
                var i = $(this).prev('label').clone();
                var file = $('#fileUpload" . $counter . "')[0].files[0].name;
                $(this).prev('label').text(file);
            });
        </script>
        ";
        echo "<td><input type='submit' class='btn btn-success btn-sm' name='submitFinal_" . $counter . "'></td>";
        echo "<td align='center'><img class='statusLogo' src='".$result['taskStatus'] . "'></td>";
        echo "</tr>";
        ++$counter;
    }
}

?>