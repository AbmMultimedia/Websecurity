<?php
for ($i=0; $i<10; $i++) {
    // open ten processes
    for ($j=0; $j<10; $j++) {
        $pipe[$j] = popen('script2.php', 'w');
    }

    // wait for them to finish
    for ($j=0; $j<10; ++$j) {
        pclose($pipe[$j]);
    }
}

echo $pipe[0] = popen("bruteForcePassword.php", "r");
echo $pipe[1] = popen("bruteForcePassword_1.php", "w");

pclose($pipe[0]);
pclose($pipe[1]);