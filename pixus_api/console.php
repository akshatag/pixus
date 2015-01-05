<?php
require_once('defines.php');
require_once(CORE_LIB.'/functions.php');
?>

<form method="POST" action="console.php">
Request URL: akshatagrawal.me/sandbox/pixus/api/ <input type="text" name="url"/><br/>
POST Fields: <input type="text" name="postfields"/><br/>
<input type="submit" name="submit" value="SUBMIT"/>
</form>


<?php
if(isset($_POST['submit'])){

    echo'lol';

    $endpoint = 'http://www.akshatagrawal.me/sandbox/pixus/api/'.$_POST['url'];
    $postfields = explode('&', $_POST['postfields'] );

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $endpoint);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

    if(strlen($_POST['postfields']) > 0 && count($postfields) > 0){
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postfields);
    }

    $curl_res = curl_exec($curl);

    if($curl_res == false){
        echo curl_getinfo($curl);
    }

    curl_close($curl);

    printQueryResults($curl_res);

}

?>