<!DOCTYPE html>
<html>
<body>
<title>FlashOnF Champions</title>
<h1> Champions </h1>
<?php
    $dictionary = json_decode(file_get_contents('championPageData.json'), true);
    $version = $dictionary['version'];
    foreach ($dictionary['data'] as $key => $champion) {
        echo "<a href=\"/champion/".$key."\">";
        echo "<img class=\"alignleft\" src=\"http://ddragon.leagueoflegends.com/cdn/".$version."/img/champion/".$champion['icon']."\" class=\"champIcon\" width = \"50\" height = \"50\" alt=\"Champ Pic\">";
        echo "<br>";
        echo $champion['name'];
        echo "</a>";
        echo "<br><br><br>";
    }
?>
</body>
</html>
