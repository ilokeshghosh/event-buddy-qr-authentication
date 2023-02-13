<?php
include "conn.php";


if(isset($_POST['text'])){

    $text = $_POST['text'];
    $code = explode(':',$text);

    $event_id = $code[0];
    $p_mail= $code[1];   
    $flag =1;


    $sql="INSERT INTO participants(event_id, p_mail, flag) VALUES('$event_id', '$p_mail', '$flag')";

    $query = mysqli_query($conn,$sql);


    if($query)
	{
		?>
		<script>
			alert("Data save successfully");
            window.location.href = "index.php";
            
		</script>
		<?php
       

	}
    else{
        ?>
		<script>
			alert("Data not saved successfully");
            window.location.href = "index.php";
		</script>
		<?php
       

    }
}else{

    ?>
    <script>
        alert("Data not saved successfully");
        window.location.href = "index.php";
    </script>
    <?php
    
}


$conn->close();



?>