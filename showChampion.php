<!DOCTYPE html>
<?php
//Ability Images
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
<html>
<head>
  <title>FlashOnF <?php echo $championName; ?></title>
  <link rel="stylesheet" href="/stylePages.css">
</head>
<body>




    <div id="titleLine">
      <p class="alignleft"><a href="/">FlashOnF Logo/Fancy writing</a></p>
      <p class="alignright">Search Bar</p>
    </div>



    <br>
    <br>
    <center><h1>
    <?php
    echo $championName;
    ?>
    </h1></center>




  <div id="content">
      <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/champion/".$icon; ?>" class="champIcon" width = "200" height = "200" alt="Champ Pic">
      <h2 class="descriptionForChamp">Insert description of champion here Insert description of champion here Insert description of champion here Insert description of champion here Insert description of champion here Insert description of champion here Insert description of champion here Insert description of champion here
      </h2>
      <!-- CODE FOR THE ADVERTISEMENT SECTION
      <div id="advertisement">
        ADVERTISEMENT
      </div>
    -->
  </div>


  <br><br>

  <div id="runesAndMasteries">
    <p class="runesAndMasteries">Insert runes and masteries here <p>
    <table class="tableForRunes">
      <tr>
        <th>Image of rune ("alt"=description of rune) X 9... etc</th>
        <th>Image of rune ("alt"=description of rune) X 9... etc</th>
        <th>Image of rune ("alt"=description of rune) X 9... etc</th>
      </tr>
    </table>

  </div>

  <br><br>


  <div id="tableForAbilities">
    <p class="abilities">Skill Order</p>
    <table class="tableForAbilities">
      <tr>
        <th>
        <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$q['image']; ?>" class="abilityIcon" width = "75" height = "75" alt="Q Ability">
        </th>
        <th><?php echo $q['description']; ?></th>
        <th>Max this skill first/second...etc</th>
      </tr>
      <tr>
        <th>
        <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$w['image']; ?>" class="abilityIcon" width = "75" height = "75" alt="W Ability">
        </th>
        <th><?php echo $w['description']; ?></th>
        <th>Max this skill first/second...etc</th>
      </tr>
      <tr>
        <th>
        <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$e['image']; ?>" class="abilityIcon" width = "75" height = "75" alt="E Ability">
        </th>
        <th><?php echo $e['description']; ?></th>
        <th>Max this skill first/second...etc</th>
      </tr>
      <tr>
        <th>
        <img class="alignleft" src="<?php echo "http://ddragon.leagueoflegends.com/cdn/".$version."/img/spell/".$r['image']; ?>" class="abilityIcon" width = "75" height = "75" alt="R Ability">
        </th>
        <th><?php echo $r['description']; ?></th>
        <th>Max this skill first/second...etc</th>
      </tr>
    </table>
    </div>

      <br><br>

    <div id="standardBuildOrder">
      <p class="standardBuildOrder">Standard Build Order</p>
      <table class="tableForStandardBuildOrder">
        <tr>
          <th class="aligncenter">1</th>
          <th class="aligncenter">2</th>
          <th class="aligncenter">3</th>
          <th class="aligncenter">4</th>
          <th class="aligncenter">5</th>
          <th class="aligncenter">6</th>
        </tr>

        <tr>
          <th>Insert picture of item here</th>
          <th>Insert picture of item here</th>
          <th>Insert picture of item here</th>
          <th>Insert picture of item here</th>
          <th>Insert picture of item here</th>
          <th>Insert picture of item here</th>
        </tr>

      </table>
    </div>

    <div id="alternateBuildOrder">
      <p class="alternateBuildOrder">Alternate Build Order</p>
      <table class="tableForAlternateBuildOrder">
        <tr>
          <th class="aligncenter">1</th>
          <th class="aligncenter">2</th>
          <th class="aligncenter">3</th>
          <th class="aligncenter">4</th>
          <th class="aligncenter">5</th>
          <th class="aligncenter">6</th>
        </tr>

        <tr>
          <th>Insert picture of item here</th>
          <th>Insert picture of item here</th>
          <th>Insert picture of item here</th>
          <th>Insert picture of item here</th>
          <th>Insert picture of item here</th>
          <th>Insert picture of item here</th>
        </tr>
      </table>
    </div>

    <div id="quickAdvice">
      <p class="advice">Insert quick advice</p>
    </div>

    <br><br>
