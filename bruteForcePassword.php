<?php

ini_set('max_execution_time', 300);
$passwordLength = 4;
$hashedPassword = hash("sha1", "9999");
$characters = array_merge(range('a', 'z'), range(0, 9));
$timeStart = microtime(true);

//getPasswordTwo();

$password = getPassword($hashedPassword, $passwordLength);

$timeEnd = microtime(true);
$timeElapsed = $timeEnd - $timeStart;

echo "Password is " . $password . " hacked in " . $timeElapsed . " seconds";

function getPassword($password, $passwordLength) {
    $characters = array_merge(range('a', 'z'), range(0, 9));

    foreach ($characters as $charOne) {
        foreach ($characters as $charTwo) {
            foreach ($characters as $charThree) {

                $testPassword = $charOne . $charTwo . $charThree;

                if (hash("sha1", $testPassword) == $password) {
                    return $testPassword;
                    break;
                }

                if ($passwordLength > 3) {
                    foreach ($characters as $charFour) {

                        $testPassword = $charOne . $charTwo . $charThree . $charFour;

                        if (hash("sha1", $testPassword) == $password) {
                            return $testPassword;
                            break;
                        }

                        if($passwordLength >4)
                        {
                            foreach ($characters as $chaFive) {
                                $testPassword = $charOne . $charTwo . $charThree . $charFour . $chaFive;

                                if (hash("sha1", $testPassword) == $password) {
                                    return $testPassword;
                                    break;
                                }
                            }
                        }
                    }
                }
            }
        }
    }
}

function getPasswordTwo()
{
    global $timeStart, $passwordLength;
    
    echo "\n<br />" . "Checking passwords with length:" .$passwordLength;
    $time_check = microtime(true);
    $time = $time_check - $timeStart;
    echo "\n<br />" . "Runtime: " . $time . " seconds";
    recurse($passwordLength, 0, '');

    echo "Execution complete, no password found\r\n";
}

function check($password)
{
        global $timeStart, $hashedPassword;     
        if (hash("sha1", $password) == $hashedPassword) {
 
                echo "\n\n" . "FOUND MATCH, password: " . $password . "\n\n";
                $time_end = microtime(true);
                $time = $time_end - $timeStart; 
                echo "Found in " . $time . " seconds\n";
                exit;
        }
}

function recurse($width, $position, $base_string)
{
        global $characters;
      
        $charsetLength = count($characters); 
        for ($i = 0; $i < $charsetLength; ++$i) {
                if ($position  < $width - 1) {
                        recurse($width, $position + 1, $base_string . $characters[$i]);
                }
                check($base_string . $characters[$i]);
        }
}



function getPasswordForLoop() {
    $characters = array_merge(range('a', 'z'), range(0, 9));
    $randomSring = "";
    for ($i = 0; $i < $characters; $i++) {
        $randomSring .= $characters[$i];
        for ($j = 0; $j < $characters; $j++) {
            $randomSring .= $characters[$j];
            echo $randomSring;
            for ($k = 0; $k < $characters; $k++) {
                $randomSring .= $characters[$k];
                echo $randomSring;
            }
        }
    }
}
