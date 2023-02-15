<?php
require_once 'conn.php';
require_once 'phpqrcode/qrlib.php';
$path = 'images/';
$qrcode = $path.time().".png";
$qrimage = time().".png";

if(isset($_REQUEST['sbt-btn']))
{
$event_id = $_POST['event_id'];
$p_mail= $_POST['p_mail'];

$query = mysqli_query($conn,"insert into qr_code set event_id='$event_id', p_mail='$p_mail',qrimage='$qrimage'");
	if($query)
	{
		?>
		<script>
			alert("Data save successfully");
            // window.location.href = "index.php";
		</script>
		<?php
	}
}

//Encrypting event id
// $cipher_algo = "AES-128-CTR";
$key = "eventbuddy";

    $event_id= $_POST['event_id'];
    $p_mail = $_POST['p_mail'];

	//Encrypting
    function encryption($data,$key){
        $encryption_key = base64_decode($key);
        $iv = openssl_random_pseudo_bytes(openssl_cipher_iv_length('aes-256-cbc'));
        $encrypted = openssl_encrypt($data,'aes-256-cbc',$encryption_key,0,$iv);
        return base64_encode($encrypted.'::'.$iv);
    }


	$en_event_id = encryption($event_id,$key);
    $en_p_mail = encryption($p_mail,$key);






QRcode :: png("{$en_event_id}:{$en_p_mail}", $qrcode, 'H', 4, 4);
// QRcode :: png("{$ID}:{$STUDENTID}");
// QRcode :: png($ID,$STUDENTID, $qrcode, 'H','H', 4, 4);
echo "<img src='".$qrcode."'>";
?>

<html>
    <a href="index.php">home</a>
</html>