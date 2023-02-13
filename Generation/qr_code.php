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

QRcode :: png("{$event_id}:{$p_mail}", $qrcode, 'H', 4, 4);
// QRcode :: png("{$ID}:{$STUDENTID}");
// QRcode :: png($ID,$STUDENTID, $qrcode, 'H','H', 4, 4);
echo "<img src='".$qrcode."'>";
?>

<html>
    <a href="index.php">home</a>
</html>