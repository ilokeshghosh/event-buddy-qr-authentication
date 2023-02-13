<!DOCTYPE html>
<html lang="en">

<head>
    <title>QR Authentication</title>
    <script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/webrtc-adapter/3.3.3/adapter.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.1.10/vue.min.js"></script>
    <script type="text/javascript" src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" />

</head>

<body>
    <div class="container">
        <nav class="navbar navbar-inverse">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand">EVENT BUDDY</a>
                </div>
                
                
                <a href="display.php" class="btn btn-success">Live Participant</a>
            </div>
        </nav>

        <div class="row">
            <div class="col-md-6">
                <video id="preview" width="100%"></video>
            </div>

            <div class="col-mid-6">
               

            <form id="myForm"action="insert.php" method="post" class="form-horizontal">
                    <label>Scan QR Code</label>
                    <input type="text" name="text" id="text" value=" " readonly placeholder="scan qrcode" class="form-control" />
            </form>

            </div>
        </div>
    </div>

    <script>
        let scanner = new Instascan.Scanner({video:document.getElementById('preview')});
        Instascan.Camera.getCameras().then(function(cameras){
            if(cameras.length > 0){
                scanner.start(cameras[0]);
            }else{
                alert('No Camera Found');
            }
        }).catch(function(e){
            console.error(e);
        });

        scanner.addListener('scan',function(c){
            // alert(c);
            document.getElementById('text').value=c;
            // window.location.href = 'insert.php'+'?c='+c;
            document.getElementById("myForm").submit();

            
        });
    </script>

    

   
</body>

</html>