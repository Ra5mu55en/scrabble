<?php

// Data sent from form
if (isset($_POST['strWord'])) {
	// Sanitize string data
	$strWord = filter_var($_POST['strWord'], FILTER_SANITIZE_STRING);
} else {
	$strWord = "";
}
// Declare totalPoints, bonus and bingoChecked variables and set to empty
$totalPoints = "";
$bonus = "";
$bingoChecked = "";


if(isset($_POST['btnSubmit'])){
	if(!empty($_POST['bonus'])) {
		$bonus=$_POST['bonus'];
	}
}
	
if(isset($_POST['btnSubmit'])){
    $bingoChecked = !empty($_POST['bingo']) ? 'on' : '';
}

if (isset($_POST['btnSubmit'])) {
	$btnSubmit = $_POST['btnSubmit'];
	if ($btnSubmit == "SUBMIT"){
		if (!$strWord == ""){
			$stringToProcess = strtoupper($strWord);
			// Process input and set score here
			 $totalPoints = calculateScore($stringToProcess,$bonus,$bingoChecked);
		}	
	}
}

function calculateScore($stringToProcess,$bonus,$bingoChecked){
	
	$letterValues = [
    'A' => 1,
    'B' => 3,
    'C' => 3,
    'D' => 2,
    'E' => 1,
	'F' => 4,
    'G' => 2,
    'H' => 4,
    'I' => 1,
    'J' => 8,
	'K' => 5,
    'L' => 1,
    'M' => 3,
    'N' => 1,
    'O' => 1,
	'P' => 3,
    'Q' => 10,
    'R' => 1,
    'S' => 1,
    'T' => 1,
	'U' => 1,
    'V' => 4,
    'W' => 4,
    'X' => 8,
    'Y' => 4,
	'Z' => 10,
];
	$score = 0;
	$length = strlen($stringToProcess);

	for($i = 0; $i <= $length; $i++) {
		$char = substr($stringToProcess, $i, 1);
		if (isset($letterValues[$char])) {
		$score += $letterValues[$char];
		}
	}
	if($bonus == "Double word score"){
		$score = $score * 2;
	}
	elseif($bonus == "Triple word score"){
		$score = $score * 3;
	}

	if($bingoChecked == "on"){  
        $score += 50;
    }
	
	return $score;   
}

// Page UI
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Scrabble Scorer</title>

<script language='JavaScript' type='text/JavaScript'>
<!--
function validate(thisForm) {
	with(thisForm) {
		if (strWord.value==null||strWord.value==""){ 
			alert("Please enter a word."); 
			strWord.focus(); 
			return false;
		}
		return true;
	}
}
 -->
</script>
		
<link rel="stylesheet" type="text/css" media="all" href="css/scrabblestyles.css" >
</head>
<body>
<div class="main-container">
	<div id="top">
		<h1>Scrabble Word Score Calculator</h1>
		<img src="images/scrabble-tiles-graphic.jpg" alt="Scrabble Tiles" border="0" />
	</div>
	<div id="form-container">
		<form name="Form1" id="Form1" method="POST" action="index.php" onSubmit="return validate(this)" language="JavaScript">
			<div>
				<div class="form-container-left"><b>Your word</b><br /><span class="required-text">* required</span></div>
				<div class="form-container-right"><input type="text" name="strWord" value="<?=$strWord?>" id="strWord" size="30" maxlength="40" /></div>
			</div>
			<div class="clear"></div>
			<div>
				<div class="form-container-left"><b>Bonus Points</b></div>
				<div class="form-container-right">
					<input type="radio" name="bonus" id="none" value="None" <?php if ($bonus == 'None') { echo "checked"; } ?> /><label for="none">None</label><br />
					<input type="radio" name="bonus" id="double" value="Double word score" <?php if ($bonus == 'Double word score') { echo "checked"; } ?> /><label for="double">Double word score</label><br />
					<input type="radio" name="bonus" id="triple" value="Triple word score" <?php if ($bonus == 'Triple word score') { echo "checked"; } ?> /><label for="triple">Triple word score</label><br />
				</div>
			</div>
			<div class="clear"></div>
			<div>
				<div class="form-container-left"><b>Include 50 point "bingo"?</b><br />(words that use all 7 tiles)</div>
				<div class="form-container-right">
					<input type="checkbox" name="bingo" id="bingo" <?php if($bingoChecked == "on") { echo "checked='checked'"; } ?> /><label for="bingo">Yes</label>
				</div>
			</div>
			<div class="clear"></div>
			<div class="form-button1"><input type="submit" name="btnSubmit" id="btnSubmit" value="SUBMIT" /></div>
		</form>
	</div>
	
	<?php
		if ( !$totalPoints == "") {
			print "<div id=\"score-container\">Your word is worth " . $totalPoints . " points.</div>";
		}
	?>
		
	
</div>
		
</body>
</html>