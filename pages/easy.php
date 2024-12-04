<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/bananaGame.css">
    <title>The Banana Game</title>
</head>
<style>
th, td {
  border-radius: 20px;
}
	
.icons
{
	margin-top: 10px;
    position: absolute;
    top: 80%;
    left: 50%;
    transform: translate(-50%, -50%); /* Centering adjustment */
    display: flex;
	width: 800px;
}

.small-img {
    display: block;
    margin: 0px 450px;
    width: 50px; /* Adjust the width to make the buttons smaller */
    height: auto;
	left: 10px;
}

.small-img {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.small-img:hover {
    transform: scale(1.2); /* Zoom in slightly */
    box-shadow: 0px 4px 15px rgba(255, 255, 255, 0); /* Add a glowing effect */
}

</style>
<body >
    <div class="container">
		<h1 class="note" id="note">Quest is ready.</h1>
        <div class="game-info" align="center">
			<table width="552" border="0" align="center">
  <tbody>
    <tr>
      <td colspan="2" style="font-size: 12px">&nbsp;</td>
      <td width="94" style="font-size: 12px">&nbsp;</td>
      <td width="37"   class="time-cell" style="font-size: 12px">&nbsp;<img src="../images/time.png" width="28" height="37" alt=""/></td>
      <td width="200" bgcolor="#FF0004" class="time-cell" style="font-size: 16px; padding-left: 20px; color: #000000;"> Time Left: <span id="time">40</span> seconds</td>
    </tr>
    <tr>
      <td width="41" style="font-size: 12px">&nbsp;<span class="time-cell"><img src="../images/score.png" width="34" height="37" alt=""/></span></td>
      <td width="158" bgcolor="#94C3C9" style="font-size: 16px; padding-left: 20px; color: #000000;">Score: <span id="score">0</span></td>
      <td style="font-size: 12px">&nbsp;</td>
		<td width="37"   class="time-cell" style="font-size: 12px"><img src="../images/error.png" width="38" height="37" alt=""/></td>
      <td width="200" bgcolor="#AE9A5E" class="time-cell" style="font-size: 16px; padding-left: 20px; color: #000000;">Errors Left: <span id="errors">Unlimited</span></td>
    </tr>
    <tr>
      <td style="font-size: 12px">&nbsp;<span class="time-cell"><img src="../images/rounds.png" width="28" height="37" alt=""/></span></td>
      <td bgcolor="#F19ACA" style="font-size: 16px; padding-left: 20px; color: #000000;">Rounds: <span id="round">1/10</span></td>
      <td style="font-size: 12px">&nbsp;</td>
      <td style="font-size: 12px">&nbsp;<span class="time-cell"><img src="../images/mode.png" width="28" height="37" alt=""/></span></td>
      <td bgcolor="#BD8FEA" style="font-size: 16px; padding-left: 20px; color: #000000;">Mode: <span id="mode">Easy</span></td>
    </tr>
  </tbody>
</table>     
      </div>
        <img id="quest" src="./bananaGame_files/t280481bed5d239d6be3f798dc5n57.png" alt="Banana Image">
        <div id="answers" class="answers">
            <!-- Buttons for answers will be dynamically added here -->
        </div><a href="levelMenu.php"><img src="../images/quit.png" alt="Leaderboard" class="small-img" id="button6"></a>
    </div>
    <script src="../js/easy.js"></script>

</body>
</html>
