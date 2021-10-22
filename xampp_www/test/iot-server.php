<?php
$servername = "localhost";
$username = "admin_vp";
$password = "Dli2work.";
$method = $_SERVER['REQUEST_METHOD'];
echo "$method::Welcome to iot-server\n";

// Create connection
echo "DATABASE_URL=mysql://$username:$password@$servername:PORT_NUMBER/\r\n";
$conn = mysqli_connect($servername, $username, $password);

//error logging
// ini_set("log_errors", 1);
// ini_set("error_log", "/var/www/html/php-error.log");
// error_reporting(E_ALL);
// ini_set('display_errors', 1);


// Check connection
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
echo "Connected successfully!\r\n";

// get posted data
if( $_SERVER['REQUEST_METHOD'] === 'POST' ){
    $data = json_decode(file_get_contents("php://input"));

    $sql = "INSERT INTO admin_iot.eMeter (identifier, value) VALUES ('$data->identifier', '$data->value')";
    if(mysqli_query($conn, $sql)){
        echo "Records added successfully!!\r\n";
    } else{
        $php_errormsg = "ERROR: Could not able to execute $sql.\r\n" . mysqli_error($conn);
        error_log( $php_errormsg );
        error_log( $php_errormsgmysqli_error($conn) );
        echo $php_errormsg;
    }
    echo json_encode($data);
}

?>
