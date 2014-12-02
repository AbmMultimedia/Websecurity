<?php
    @apache_setenv('no-gzip', 1); 
    @ini_set('zlib.output_compression', 0);
    ob_implicit_flush(true);
    ob_end_flush();
    
    $numberOfStrings = 500000;
    $stringLength = 20;
?>

<h1>Hash functions</h1>
<h2>Time for hashing <?php echo $numberOfStrings ?> strings with the length <?php echo $stringLength ?> </h2>

<?php
$strings = addStrings($numberOfStrings, $stringLength);

foreach (hash_algos() as $hashMethode)
{
    hashStrings($hashMethode, $strings);
}

function hashStrings($hashMethode, $strings)
{
    $time_start = microtime(true);
    for($i=0; $i < count($strings); $i++)
    {
        hash($hashMethode, $strings[$i]);
    }

    $time_end = microtime(true);
    $time = $time_end - $time_start;

    echo "Hash ". $hashMethode ." in ". $time ." seconds <br/>\n";
}

function getRandomString($stringLenght)
{
    $characters = array_merge(range('A','Z'), range('a','z'), range(0,9));
    $randomSring = "";
    for ($i=0; $i < $stringLenght; $i++)
    {
        $randomSring .= $characters[rand(0, count($characters)-1)];
    }
    return $randomSring;
}

function addStrings($numberOfStrings, $stringLength)
{
    $strings = [];
    for($i=0; $i < $numberOfStrings; $i++)
    {
        array_push($strings, getRandomString($stringLength));
    }
    return $strings;
}

?>