<!DOCTYPE html>
<?php
$dictionary = json_decode(file_get_contents('championPageData.json'), true);
$championName = "";
$championKey = "";
$version = $dictionary['version'];
$keyDictionary = $dictionary['championKeysAndNames'];
if (isset($_GET["champion"])) {
    $lowerKey = strtolower($_GET["champion"]);
    if (array_key_exists($lowerKey, $keyDictionary['lowerKeyToName'])) {
        $championName = $keyDictionary['lowerKeyToName'][$lowerKey];
        $championKey = $keyDictionary['nameToKey'][$championName];
    } else {
        header($_SERVER["SERVER_PROTOCOL"]." 404 Not Found", true, 404);
        include("error.php");
        exit();
    }
}
$championDictionary = $dictionary['data'][$championKey];
$icon = $championDictionary['icon'];
$abilities = $championDictionary['abilities'];
$q = $abilities[0];
$w = $abilities[1];
$e = $abilities[2];
$r = $abilities[3];
if (isset($_POST["submit"])) {
    $input = "";
    if (isset($_POST["champion"])) {
        $input = $_POST["champion"];
        header( "Location: /?champion=".$input."&submit=Search" );
        die();
    }
}
?>
<head>
    <title>FlashOnF <?php echo $championName; ?></title>
    <link rel="stylesheet" href="/stylePages.css">
</head>
<body>
    <div id="titleLine">
        <p class="alignleft">
            <a href="/">
                <img src="/newLogo.jpg" width = "75" height = "75" class="alignleft">
            </a>
        </p>
        <p class="alignright">
            <form class="searchBar" method="POST">
                <input type="submit" value="Search" id="submit" style="float:right;" name="submit">
                <input type="text" placeholder= "Search for a champion... " maxlength="20" id="search" style="width:300px; height:15px; float:right;" name="champion">
            </form>
        </p>
    </div>

    <br><br>

    <center>
        <h1>
            <?php echo $championName."\n"; ?>
        </h1>
    </center>

    <ul class="floating">
        <div id="content">
            <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/champion/".$icon; ?>" class="champIcon" width = "200" height = "200" alt="Champ Pic">
            <h2 class="descriptionForChamp">
                <?php echo $championDictionary['description']."\n"; ?>
            </h2>
            <!-- CODE FOR THE ADVERTISEMENT SECTION
                <div id="advertisement">
                ADVERTISEMENT
                </div>
            -->
        </div>
    </ul>

    <br><br>

    <ul class="floating">
        <div class="content parallax">
            <div id="tableForAbilities">
                <p class="abilities">Skill</p>
                <table class="tableForAbilities">
                    <tr>
                        <th>
                            <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$q['image']; ?>" class="alignleft" width = "75" height = "75" alt="Q Ability">
                        </th>
                        <th>
                            <?php echo $q['description']."\n"; ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$w['image']; ?>" class="alignleft" width = "75" height = "75" alt="W Ability">
                        </th>
                        <th>
                            <?php echo $w['description']."\n"; ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$e['image']; ?>" class="alignleft" width = "75" height = "75" alt="E Ability">
                        </th>
                        <th>
                            <?php echo $e['description']."\n"; ?>
                        </th>
                    </tr>
                    <tr>
                        <th>
                            <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$r['image']; ?>" class="alignleft" width = "75" height = "75" alt="R Ability">
                        </th>
                        <th>
                            <?php echo $r['description']."\n"; ?>
                        </th>
                    </tr>
                </table>
            </div>
        </div>
    </ul>

        <br><br>

    <ul class="floating">
        <div class="content parallax">
        <?php
            foreach ($dictionary['data'][$championKey]['recommended'] as $setKey => $set) {
                echo "            <div id=\"standardBuildOrder\">\n";
                echo "                <p class=\"standardBuildOrder\">".ucwords($setKey, "_")."</p>\n";
                echo "                <center><table class=\"tableForStandardBuildOrder\">\n";
                echo "                <tr>\n";
                    foreach ($set as $item) {
                        echo "                    <th>\n";
                        echo "                        <center><img class=\"aligncenter\" src=\"http://ddragon.leagueoflegends.com/cdn/".$version."/img/item/".$item['image']."\" class=\"abilityIcon\" width = \"50\" height = \"50\" alt=\"".$item['name']."\"></center>\n";
                        echo "                        ".$item['name']."\n";
                        echo "                    </th>\n";
                    }
                echo "                </tr>\n";
                echo "                </table></center>\n";
                echo "            </div>\n";
            }
        ?>
        </div>
    </ul>
</body>
