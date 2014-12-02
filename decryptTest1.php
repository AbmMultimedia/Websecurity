<h1>Decrypted messages</h1>
<?php

include 'dbConnect.php';

$key = hash("md5", "use this key");
$encryptAlgo = "blowfish";
$encryptMethode = "ecb";
$td = mcrypt_module_open($encryptAlgo, "", $encryptMethode, "");

$strSql = "SELECT * FROM encryption";
if($result = $myConnection->query($strSql))
{
    while($row = $result->fetch_assoc())
    {
        $encryptedMessage = base64_decode($row["message"]);
        $iv = base64_decode($row["iv"]);
        mcrypt_generic_init($td, $key, $iv);
        
        $message = mdecrypt_generic($td, $encryptedMessage);
       
        echo $message. "<br>";
        
        mcrypt_generic_deinit($td);
    }
    
    $result->free();
}

$myConnection->close();
mcrypt_module_close($td);
