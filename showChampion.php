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
?>
<head>
  <title>FlashOnF <?php echo $championName; ?></title>
  <link rel="stylesheet" href="/stylePages.css">
</head>
<body>
    <div id="titleLine">
        <p class="aligncenter">
            <a href="/">
                <img src="logo.jpg">
            </a>
        </p>
    </div>
<p class="alignright">
    <form action = "/">
        <ul class="floating">
            <input type="submit" value="Search" id="submit" style="float:right;">
        </ul>
        <ul class="floating">
            <input type="text" placeholder= "Search for a champion... " maxlength="20" id="search" style="width:300px; height:15px; float:right;">
        </ul>
    </form>
</p>
<br>
<br>
<center>
<h1>
    <?php
    echo $championName;
    ?>
</h1></center>



<ul class="floating">
    <div id="content">
        <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/champion/".$icon; ?>" class="champIcon" width = "200" height = "200" alt="Champ Pic">
        <h2 class="descriptionForChamp">
        <?php echo $championDictionary['description']; ?>
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
            <p class="abilities">Skill Order</p>
            <table class="tableForAbilities">
                <tr>
                    <th>
                        <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$q['image']; ?>" class="abilityIcon" width = "75" height = "75" alt="Q Ability">
                    </th>
                    <th>
                        <?php echo $q['description']; ?>
                    </th>
                </tr>
                <tr>
                    <th>
                        <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$w['image']; ?>" class="abilityIcon" width = "75" height = "75" alt="W Ability">
                    </th>
                    <th>
                        <?php echo $w['description']; ?>
                    </th>
                </tr>
                <tr>
                    <th>
                        <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$e['image']; ?>" class="abilityIcon" width = "75" height = "75" alt="E Ability">
                    </th>
                    <th>
                        <?php echo $e['description']; ?>
                    </th>
                </tr>
                <tr>
                    <th>
                        <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$r['image']; ?>" class="abilityIcon" width = "75" height = "75" alt="R Ability">
                    </th>
                    <th>
                        <?php echo $r['description']; ?>
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
            echo "
            <div id=\"standardBuildOrder\">
                <p class=\"standardBuildOrder\">".ucwords($setKey, "_")."</p>
                <table class=\"tableForStandardBuildOrder\">
                    <tr>
                    ";
                foreach ($set as $item) {
                    echo "<th>";
                    echo $item['name'];
                    echo "<img class=\"alignleft\" src=\"http://ddragon.leagueoflegends.com/cdn/".$version."/img/item/".$item['image']."\" class=\"abilityIcon\" width = \"50\" height = \"50\" alt=\"".$item['name']."\">";
                    echo "</th>";
                }
            echo "
                    </tr>
                </table>
            </div>
            ";
        }
        ?>
    </div>
</ul>