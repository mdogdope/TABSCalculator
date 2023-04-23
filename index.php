<!DOCTYPE html>

<?php  
$ip = $_SERVER['REMOTE_ADDR'];

$servername = "sql202.epizy.com";
$username = "epiz_34058658";
$password = "u1Lj2kEVSj330OV";
$dbname = "epiz_34058658_users";

$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "INSERT INTO users (ipaddress) VALUES ('$ip')";

if ($conn->query($sql) === TRUE){
}else {
	$sqlUpdate = "UPDATE users SET timestamp = CURRENT_TIMESTAMP WHERE ipaddress = '$ip'";
	$conn->query($sqlUpdate);
}

$conn->close();
?>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	
	<link rel="stylesheet" href="index.css">
	<link rel="shortcut icon" href="images/icon.png" type="image/x-icon">
	
	<title>TABS Army Builder</title>
</head>
<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-VNR4SGMLND"></script>
<script>
  window.dataLayer = window.dataLayer || [];
  function gtag(){dataLayer.push(arguments);}
  gtag('js', new Date());

  gtag('config', 'G-VNR4SGMLND');
</script>
<body>
	<h1 class="title">TABS Army Builder</h1>
	<main>
		<p class="desc">Build your army!</p>
		
		<!-- Start of category lists -->
		<div class="categories-container">
			<div class="categories">
				<h3>Base Troop Categories</h3>
				<div class="category">
					<input type="checkbox" id="tribalCheck" checked onclick="updateTroopLists()">
					<p>Tribal</p>
				</div>
				<div class="category">
					<input type="checkbox" id="farmerCheck" checked onclick="updateTroopLists()">
					<p>Farmer</p>
				</div>
				<div class="category">
					<input type="checkbox" id="medievalCheck" checked onclick="updateTroopLists()">
					<p>Medieval</p>
				</div>
				<div class="category">
					<input type="checkbox" id="ancientCheck" checked onclick="updateTroopLists()">
					<p>Ancient</p>
				</div>
				<div class="category">
					<input type="checkbox" id="vikingCheck" checked onclick="updateTroopLists()">
					<p>Viking</p>
				</div>
				<div class="category">
					<input type="checkbox" id="dynastyCheck" checked onclick="updateTroopLists()">
					<p>Dynasty</p>
				</div>
				<div class="category">
					<input type="checkbox" id="renaissanceCheck" checked onclick="updateTroopLists()">
					<p>Renaissance</p>
				</div>
				<div class="category">
					<input type="checkbox" id="pirateCheck" checked onclick="updateTroopLists()">
					<p>Pirate</p>
				</div>
				<div class="category">
					<input type="checkbox" id="spookyCheck" checked onclick="updateTroopLists()">
					<p>Spooky</p>
				</div>
				<div class="category">
					<input type="checkbox" id="wild-westCheck" checked onclick="updateTroopLists()">
					<p>Wild West</p>
				</div>
			</div>
			<div class="categories">
				<h3>Bonus Troop Categories</h3>
				<div class="category">
					<input type="checkbox" id="legacyCheck" onclick="updateTroopLists()">
					<p>Legacy</p>
				</div>
				<div class="category">
					<input type="checkbox" id="fantasy-goodCheck" onclick="updateTroopLists()">
					<p>Fantasy Good</p>
				</div>
				<div class="category">
					<input type="checkbox" id="fantasy-evilCheck" onclick="updateTroopLists()">
					<p>Fantasy Evil</p>
				</div>
				<div class="category">
					<input type="checkbox" id="secretCheck" onclick="updateTroopLists()">
					<p>Secret</p>
				</div>
			</div>
			<div class="output-container">
				<div class="output-header">
					<h2>Generated Message</h2>
					<img src="images/copy.png" alt="Copy" onclick="copy()">
				</div>
				<p id="output">This is where the generated text will appear.</p>
			</div>
		</div>
		<!-- End of category lists -->
		
		<!-- Start of troop lists -->
		<h1>Troop List</h1>
		<div class="troop-list-header">
			<div class="limit-container">
				<p>Set Limit</p>
				<input type="number" id="limit" min="0" onchange="setLimit()" value="10000">
			</div>
		</div>
		<div class="troops-container">
			<div class="tribal">
				<h2>Tribal</h2>
				<div class="troops" id="tribalTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="farmer">
				<h2>Farmer</h2>
				<div class="troops" id="farmerTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="medieval">
				<h2>Medieval</h2>
				<div class="troops" id="medievalTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="ancient">
				<h2>Ancient</h2>
				<div class="troops" id="ancientTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="viking">
				<h2>Viking</h2>
				<div class="troops" id="vikingTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="dynasty">
				<h2>Dynasty</h2>
				<div class="troops" id="dynastyTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="renaissance">
				<h2>Renaissance</h2>
				<div class="troops" id="renaissanceTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="pirate">
				<h2>Pirate</h2>
				<div class="troops" id="pirateTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="spooky">
				<h2>Spooky</h2>
				<div class="troops" id="spookyTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="wild-west">
				<h2>Wild West</h2>
				<div class="troops" id="wild-westTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="legacy">
				<h2>Legacy</h2>
				<div class="troops" id="legacyTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="fantasy-good">
				<h2>Fantasy Good</h2>
				<div class="troops" id="fantasy-goodTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="fantasy-evil">
				<h2>Fantasy Evil</h2>
				<div class="troops" id="fantasy-evilTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
			<div class="secret">
				<h2>Secret</h2>
				<div class="troops" id="secretTroops">
					<!-- Start of headers -->
					<p>Name</p>
					<p>Cost</p>
					<p>Hit Points</p>
					<p> </p>
					<!-- End of headers -->
					
				</div>
			</div>
		</div>
		<!-- End of troop lists -->
		
	</main>
	<div style="height: 100px;"></div>
	<!-- Start of the footer -->
	<footer>
		
		<!-- Start of donation -->
		<form action="https://www.paypal.com/donate" method="post" target="_top">
			<input type="hidden" name="business" value="G9BWFPRYBRYBE" />
			<input type="hidden" name="no_recurring" value="0" />
			<input type="hidden" name="item_name" value="Get this site a real url!" />
			<input type="hidden" name="currency_code" value="USD" />
			<input type="image" src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_SM.gif" border="0" name="submit" title="PayPal - The safer, easier way to pay online!" alt="Donate with PayPal button" />
			<img alt="" border="0" src="https://www.paypal.com/en_US/i/scr/pixel.gif" width="1" height="1" />
		</form>
		<!-- End of donation -->
		
		<!-- Cost indicator  -->
		<div class="container">
			<h2>Cost:</h2>
			<h2 id="total">0</h2>
		</div>
		<!-- Remaining indicator -->
		<div class="container">
			<h2 id="remaining-label">Remaining:</h2>
			<h2 id="remaining">10000</h2>
		</div>
		<!-- Total HP indicator -->
		<div class="container">
			<h2>HP:</h2>
			<h2 id="hp">0</h2>
		</div>
		<!-- Troop count indicator -->
		<div class="container">
			<h2>Troops:</h2>
			<h2 id="troopCount">0</h2>
		</div>
		<!-- Start of buttons -->
		<button onclick="generate()">Generate Message</button>
		<button onclick="autoFill()">Auto Fill Rest</button>
		<button onclick="clearAll()">Clear All</button>
		<!-- End of buttons -->
	</footer>
	<!-- End of the footer -->
</body>
<script type="module" src="index.js"></script>
</html>