<?php
include 'server/connection.php';

if (isset($_GET['Id'])) {
    $Id = $_GET['Id'];

    $delete_query = "DELETE from user where Id = '$Id'";
    $result = mysqli_query($conn,$delete_query);

    if ($result) {
        header("location: tables_user.php?succes=Telah dihapus");
    } else {
        header("location: tables_user.php");
    }
} else {
    header("location: tables_user.php");
}

?>