<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<form method="post" action="encryption.php" > 
            <div class="form-group">
                <label>Event Id</label>
                <input type="text" name="event_id" id="ID" placeholder="Enter Event ID" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup" class="form-control" />
                <label>Participant Mail</label>
                <input type="text" name="p_mail" id="p_mail" placeholder="Enter Participant Mail" required data-parsley-pattern="^[a-zA-Z]+$" data-parsley-trigger="keyup" class="form-control" />
            </div>
            <div class="form-group">
                <input type="submit" name="sbt-btn" value="QR Generate" class="btn btn-success" />
            </div>
        </form>
</body>
</html>

<?php

if(isset($_POST['sbt-btn'])){
    $key = "eventbuddy";

    $event_id= $_POST['event_id'];
    $p_mail = $_POST['p_mail'];

    function encryption($data,$key){
        $encryption_key = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data,'aes-256-cbc',$encryption_key,0,$iv);
        return base64_encode($encrypted.'::'.$iv);
    }
    
    function decryption($data,$key){
        $encryption_key = base64_decode($key);
        list($encrypted_data,$iv) = array_pad(explode('::',base64_decode($data),2),2,null);
        return openssl_decrypt($encrypted_data,'aes-256-cbc',$encryption_key,0,$iv);

    }
    $en_event_id = encryption($event_id,$key);
    $en_p_mail = encryption($p_mail,$key);


    $de_event_id = decryption($en_event_id,$key);
    $de_p_mail = decryption($en_p_mail,$key);



    echo "<h2>Encrypted Text</h2>";
    echo "Event ID";
    echo "<p>$en_event_id</p>";
    echo "p mail";
    echo "<p>$en_p_mail</p>";

    echo "<h2>Decrypted Text</h2>";
    echo "Event ID";
    echo "<p>$de_event_id</p>";
    echo "p mail";
    echo "<p>$de_p_mail</p>";
}

?>
