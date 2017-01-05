<!DOCTYPE html>
<html>
<head>
    <title>FlashOnF</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
  <div class="content parallax">
  <div class = "centered">
    <h2>Champion Name </h2>
<!-- *** Find a way to make this search within the site *** //-->
<form method="GET">
  <input type="text" placeholder= "Search for a champion... " maxlength="20" id="champion" name="champion">
  <br>
  <br>
  <input type="submit" value="Search" id="submit" name="submit">
  <br>
  <br>
  <a href="/champion">List of Champions</a>
</div>
</div>
<div>
<a>
<?php
if (isset($_GET["submit"])) {
    $input = "";
    if (isset($_GET["champion"])) {
        $input = $_GET["champion"];
    }
    if (preg_match('/[$&+,:;=?@#|<>.^*()%!-]/', $input)) {
        echo "Your input contains invalid characters.";
    } else {
        $champList = json_decode(file_get_contents('championList.json'));
        if (in_array(strtolower($input), $champList)) {
            $key = ucwords($input, "\'");
            $key = ucwords($input);
            $dictionary = json_decode(file_get_contents('championPageData.json'), true)['championKeysAndNames'];
            $champion = $dictionary['nameToKey'][$key];
            header( "Location: champion/".$champion );
            die();
        } else {
            echo "That champion does not exist! Make sure you search with the exact lettering, e.g. Cho'Gath, not ChoGath";
        }
    }
}
?>
</a>
</div>

</form>
<br>
<br>

</body>

</html>