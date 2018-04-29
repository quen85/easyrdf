<?php
require 'vendor/autoload.php';

if(isset($_GET["id"]) && !empty($_GET["id"])){
    $id = $_GET["id"];
    $uri = 'http://dx.doi.org/'.$id;
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, $uri);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($curl,  CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'accept: text/turtle'
    ));

    $return = curl_exec($curl);

    curl_close($curl);

    $graph = new EasyRdf_Graph($uri, $return, 'turtle');

    $title = $graph->get($uri, "dcterms:title");
    $date = $graph->get($uri, "dcterms:date");

    echo "<h1>".$title."</h1>";
    echo "<p style='font-style: italic;'>".$date."</p>";
    echo "<h2>Auteurs :</h2>";

    $auteurs = $graph->all($uri, "dcterms:creator", "resource");
    foreach ($auteurs as $auteur){
        echo "<p>".$auteur->get("foaf:name")."</p>";
    }
}

else{
    ?>

    <form action="" method="get">
        <input type="text" placeholder="Tap ID here" name="id">
        <input type="submit" value="Submit">
    </form>

<?php
}