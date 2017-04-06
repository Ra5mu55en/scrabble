<?php 

	//***********************************************************************************
	//								PAGE
	//***********************************************************************************

	// Data sent from form
	// $strWord		= MakeSafe($_POST["strWord"]);
	if (isset($_POST['strWord'])) {
		$strWord = $_POST['strWord'];
	} else {
		$strWord = "";
	}

	// Declare totalPoints variable and set to empty
	$totalPoints = "";
	
	if (isset($_POST['btnSubmit'])) {
		$btnSubmit = $_POST['btnSubmit'];
		if ($btnSubmit == "SUBMIT")
		{
			$ErrorMessage	= "";

			if ($strWord == "")
			{
				$ErrorMessage	= "<tr>".
									"<td align=\"right\" class=\"td1\">&nbsp;</td>".
									"<td align=\"left\" class=\"td2\"><span class=\"error\">Please write in your word.</span></td>".
								 "</tr>";
			}
			else
			{
				// Process input and set score here
				 $totalPoints = 10;
			}
		}
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
		function validate_required(field,alerttxt)  {
			with (field) {
				if (value==null||value=='') {
					alert(alerttxt); 
					return false;
				}
			}
		}
		
		function checkform(thisform) {
			with(thisform) {
				if (validate_required(strWord,'Please enter a word.')==false)
				{ strWord.focus(); return false;}
				return true; // passed all tests.
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
				<form name="Form1" id="Form1" method="POST" action="index.php" onSubmit="return checkform(this)" language="JavaScript">
					<div>
						<div class="form-container-left"><b>Your word</b><br /><span class="required-text">* required</span></div>
						<div class="form-container-right"><input type="text" name="strWord" value="<?=$strWord?>" id="strWord" size="30" maxlength="40" /></div>
					</div>
					<div class="clear"></div>
					<div>
						<div class="form-container-left"><b>Bonus Points</b></div>
						<div class="form-container-right">
							<input type="radio" name="bonus-points" id="none" value="None" /><label for="none">None</label><br />
							<input type="radio" name="bonus-points" id="double" value="Double word score" /><label for="double">Double word score</label><br />
							<input type="radio" name="bonus-points" id="triple" value="Triple word score" /><label for="triple">Triple word score</label><br />
						</div>
					</div>
					<div class="clear"></div>
					<div>
						<div class="form-container-left"><b>Include 50 point "bingo"?</b><br />(words that use all 7 tiles)</div>
						<div class="form-container-right">
							<input type="checkbox" name="bingo" id="bingo" /><label for="bingo">Yes</label>
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
				
				
			
			
			q!
			
		</div>
		
		</body>
		</html>
<?

	function MakeSafe($unsafestring) 
	{
		return $unsafestring;
	} 
?>