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
    if (preg_match('[\W]', $input)) {
        echo "Your input contains invalid characters.";
    } else {
        $champList = json_decode(file_get_contents('championList.json'));
        if (in_array(strtolower($input), $champList)) {
            header( "Location: http://localhost/champion/".$input );
            die();
        } else {
            echo "That champion does not exist!";
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