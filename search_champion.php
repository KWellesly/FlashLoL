<html>
<body>
<?php
$input = $_GET["champion"];
if (preg_match('[\W]', $input)) {
	echo "Your input contains invalid characters.";
} else {
	$champList = json_decode(file_get_contents('championList.json'));
	if (in_array(strtolower($input), $champList)) {
		echo "Champ Found: ", strtoupper($input);
	} else {
		echo "That champion does not exist!";
	}
}
?>
</body>
</html>