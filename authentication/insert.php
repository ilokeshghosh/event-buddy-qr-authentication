<?php
include "conn.php";


if(isset($_POST['text'])){

    $text = $_POST['text'];
    $code = explode(':',$text);

    $event_id = $code[0];
    $p_mail= $code[1];   
    $flag =1;

    $key = "eventbuddy";

    //Decryption
    function decryption($data,$key){
        $encryption_key = base64_decode($key);
        list($encrypted_data,$iv) = array_pad(explode('::',base64_decode($data),2),2,null);
        return openssl_decrypt($encrypted_data,'aes-256-cbc',$encryption_key,0,$iv);

    }

    $de_event_id = decryption($event_id,$key);
    $de_p_mail = decryption($p_mail,$key);

    $sql = "SELECT * from participants  WHERE event_id='$de_event_id'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
    {

        
        while ($row = $result->fetch_assoc()) {
            
            if($row["flag"]==1){
                $flag=0;


                // $stmt = $conn->prepare("UPDATE participants SET flag=? WHERE event_id=?");
                // $stmt->bind_param("ss",$flag,$event_id);
                // $stmt->execute();
                // $stmt->close();


                $sql="UPDATE participants SET flag =0 WHERE event_id='$de_event_id'";
                $query = mysqli_query($conn,$sql);
                if($query)
                {
                    ?>
                    <script>
                        alert("Marked as absent");
                        window.location.href = "index.php";
                        
                    </script>
                    <?php
                   
            
                }
                else{
                    ?>
                    <script>
                        alert("Attendance not done 1");
                        window.location.href = "index.php";
                    </script>
                    <?php
                }

            }
            else{
                $flag = 1;
                $sql="UPDATE participants SET flag = 1 WHERE event_id='$de_event_id'";
                $query = mysqli_query($conn,$sql);
                if($query)
                {
                    ?>
                    <script>
                        alert("Marked as present");
                        window.location.href = "index.php";
                        
                    </script>
                    <?php
                   
            
                }
                else{
                    ?>
                    <script>
                        alert("Attendance not done 2");
                        window.location.href = "index.php";
                    </script>
                    <?php
                }
            }
        }


    }else{
        $sql="INSERT INTO participants(event_id, p_mail, flag) VALUES('$de_event_id', '$de_p_mail', 1)";
        $query = mysqli_query($conn,$sql);
    }

   

    // $sql="INSERT INTO participants(event_id, p_mail, flag) VALUES('$de_event_id', '$de_p_mail', '$flag')";

    // $query = mysqli_query($conn,$sql);


    if($query)
	{
		?>
		<script>
			alert("Marked as present");
            window.location.href = "index.php";
            
		</script>
		<?php
       

	}
    else{
        ?>
		<script>
			alert("Attendance not done 3");
            window.location.href = "index.php";
		</script>
		<?php
    }
}else{

    ?>
    <script>
        alert("Attendance not done 4");
        window.location.href = "index.php";
    </script>
    <?php
    
}


$conn->close();



?>