<?php
include "conn.php";





?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="2">
    <title>Live Participant</title>

    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <!-- <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script> -->

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />

</head>
<body>
<table class="table table-bordered">
    <thead>
        <tr>
            <td>ID</td>
            <td>STUDENT ID</td>
            <td>TIME IN</td>
        </tr> 
    </thead>

    <tbody>
    <?php
        $sql = "SELECT event_id, p_mail FROM participants WHERE flag=1";
        $query = $conn->query($sql);
        while ($row = $query->fetch_assoc()) {
    ?>

        <tr>
    
            <td><?php echo $row['event_id']; ?></td>
            <td><?php echo $row['p_mail']; ?></td>
        </tr>
    <?php
                    }

    ?>
</tbody>

</table>


<a href="index.php" class="btn btn-danger">Home</a>
</body>
</html>


