import {data} from "./data.js";

window.autoFill = autoFill;
window.updateTroopLists = updateTroopLists;
window.calculate = calculate;
window.generate = generate;
window.copy = copy;
window.minus = minus;
window.plus = plus;
window.setLimit = setLimit;
window.clearAll = clearAll;

var categories = Object.keys(data);


// Generate and populate the troop tables.
for(var iCategory = 0; iCategory < categories.length; iCategory++){
	
	var table = document.getElementById(categories[iCategory].concat("Troops"));
	var names = Object.keys(data[categories[iCategory]]);
	
	for(var iName = 0; iName < names.length; iName++){
		var name = document.createElement("p");
		
		var nameString = names[iName].replaceAll("-", " ");
		var parts = nameString.split(" ");
		
		var buff = "";
		for(var i = 0; i < parts.length; i++){
			buff = buff.concat(parts[i][0].toUpperCase() + parts[i].substring(1));
			buff += " ";
		}
		
		name.innerHTML = buff.trim();
		
		
		// Adds pop up image when hoving over a name.
		name.className = "tooltip";
		var tooltipText = document.createElement("img");
		tooltipText.className = "tooltiptext";
		tooltipText.src = "images/" + names[iName] + ".webp";
		
		name.appendChild(tooltipText);
		
		
		// Create the cost element for the troop.
		var cost = document.createElement("p");
		cost.innerHTML = data[categories[iCategory]][names[iName]].cost;
		
		// Create the hp element for the troop.
		var hp = document.createElement("p");
		hp.innerHTML = data[categories[iCategory]][names[iName]].hp;
		
		// Make a container for the count indicator and the plus/minus buttons.
		var selector = document.createElement("div");
		selector.className = "selector"
		
		// Create the minus button for the troop.
		var btnMinus = document.createElement("button");
		btnMinus.setAttribute("onclick", "minus(this.parentElement)");
		btnMinus.className = "minus";
		btnMinus.disabled = true;
		btnMinus.id = categories[iCategory] + "-" + names[iName] + "Minus"
		btnMinus.innerHTML = "-";
		
		// Create the input element for the troop to show the count.
		var troopCount = document.createElement("input");
		troopCount.setAttribute("type", "number");
		troopCount.setAttribute("onchange", "calculate()");
		troopCount.id = names[iName].concat("Count");
		troopCount.min = 0;
		troopCount.value = 0;
		
		// Create the plus button for the troop.
		var btnPlus = document.createElement("button");
		btnPlus.setAttribute("onclick", "plus(this.parentElement)");
		btnPlus.className = "plus";
		btnPlus.id = categories[iCategory] + "-" + names[iName] + "Plus"
		btnPlus.innerHTML = "+";
		
		// Add plus minus and counter to the selector element.
		selector.appendChild(btnMinus);
		selector.appendChild(troopCount);
		selector.appendChild(btnPlus);
		
		// Add all the child elements to the parent grid.
		table.appendChild(name);
		table.appendChild(cost);
		table.appendChild(hp);
		table.appendChild(selector);
	}
}

// This function will spend all remainging points on random troops.
// Called when the user hits the "Auto Fill Rest" button.
function autoFill(){
	var pointsLeft = Number(document.getElementById("remaining").innerHTML);
	
	
	// Make an array of booleans that determine if list is included.
	var checks = [];
	for(var i = 0; i < categories.length; i++){
		var category = categories[i];
		checks = checks.concat(document.getElementById(category + "Check").checked);
	}
	
	// Find the lowest priced troop in the selected lists.
	var lowestCost = 9999999;
	for(var iCategory = 0; iCategory < categories.length; iCategory++){
		if(checks[iCategory]){
			var troops = Object.keys(data[categories[iCategory]])
			for(var iTroop = 0; iTroop < troops.length; iTroop++){
				var cost = Number(data[categories[iCategory]][troops[iTroop]].cost);
				if(cost < lowestCost){
					lowestCost = cost;
				}
			}
		}
	}
	
	// Loop through available troops and add a random one to army.
	while(pointsLeft >= lowestCost){
		var availableTroops = [];
		for(var iCategory = 0; iCategory < categories.length; iCategory++){
			if(checks[iCategory]){
				var troops = Object.keys(data[categories[iCategory]]);
				for(var iTroop = 0; iTroop < troops.length; iTroop++){
					var cost = Number(data[categories[iCategory]][troops[iTroop]].cost);
					if(cost <= pointsLeft){
						availableTroops = availableTroops.concat(troops[iTroop]);
					}
				}
			}
		}
		
		// Pick and add one troop to the army.
		var choiceNum = Math.floor(Math.random() * availableTroops.length);
		var choice = availableTroops[choiceNum];
		
		for(var iCategory = 0; iCategory < categories.length; iCategory++){
			var troops = Object.keys(data[categories[iCategory]]);
			for(var iTroop = 0; iTroop < troops.length; iTroop++){
				if(choice === troops[iTroop]){
					var counter = document.getElementById(troops[iTroop] + "Count").parentElement;
					plus(counter);
					pointsLeft -= Number(data[categories[iCategory]][troops[iTroop]].cost);
				}
			}
		}
	}
}

// Run the function once to make sure everything is displayed correctly on refresh.
updateTroopLists();
// This function will show and hide lists.
// Called when a category is checked or unchecked.
function updateTroopLists(){
	
	var checks = [];
	for(var i = 0; i < categories.length; i++){
		var category = categories[i];
		checks = checks.concat(document.getElementById(category + "Check").checked);
	}
	
	// Check if table should be hidden or not.
	for(var i = 0; i < checks.length; i++){
		var searchString = categories[i];
		
		var table = document.getElementsByClassName(searchString);
		if(checks[i]){
			table[0].style.display = "block";
		}else{
			table[0].style.display = "none";
			clearList(searchString);
		}
	}
}

// Reduces the counter for the desired troop by one if not 0.
// Called each time a minus button is clicked and is passed the parent element.
function minus(parent){
	var count = parent.querySelector("input");
	if(count.value > 0){
		count.value--;
	}
	
	if(count.value <= 0){
		parent.querySelector(".minus").disabled = true;
	}
	
	calculate();
	setLimit();
	updateRemaining();
}

// Increases the counter for the desired troop by one.
// Called each time a plus button is clicked and is passed the parent element.
function plus(parent){
	var count = parent.querySelector("input");
	count.value++;
	parent.querySelector(".minus").disabled = false;
	calculate();
	setLimit();
	updateRemaining();
}

// Calculates the totals listed at the bottom of the page.
// Called when ever a plus/minus is clicked or when an input is changed.
function calculate(){
	var totalCost = 0;
	var totalHp = 0;
	var totalTroops = 0;
	for(var iCategory = 0; iCategory < categories.length; iCategory++){
		var troops = Object.keys(data[categories[iCategory]]);
		for(var iTroop = 0; iTroop < troops.length; iTroop++){
			var countString = troops[iTroop].concat("Count");
			var count = document.getElementById(countString).value;
			var cost = data[categories[iCategory]][troops[iTroop]].cost;
			var hp = data[categories[iCategory]][troops[iTroop]].hp;
			
			totalCost += count*cost;
			totalHp += count*hp;
			totalTroops += count*1;
		}
	}
	document.getElementById("total").innerHTML = totalCost;
	document.getElementById("hp").innerHTML = totalHp;
	document.getElementById("troopCount").innerHTML = totalTroops;
	setLimit();
}

function generate(){
	var message = "";
	for(var iCategory = 0; iCategory < categories.length; iCategory++){
		var troops = Object.keys(data[categories[iCategory]]);
		for(var iTroop = 0; iTroop < troops.length; iTroop++){
			var name = troops[iTroop];
			var count = document.getElementById(troops[iTroop].concat("Count")).value;
			if(count !== "0"){
				message += "(" + name + ":" + count + ") ";
			}
		}
	}
	document.getElementById("output").innerHTML = message;
	
}

function copy(){
	var message = document.getElementById("output").innerHTML;
	navigator.clipboard.writeText(message);
}


setLimit();
function setLimit(){
	var limit = document.getElementById("limit").value;
	var total = document.getElementById("total").innerHTML;
	
	document.getElementById("remaining").innerHTML = Math.abs(limit - total);
	
	if(limit - total < 0){
		document.getElementById("remaining-label").innerHTML = "Over by:";
	}else{
		document.getElementById("remaining-label").innerHTML = "Remaining:"
	}
	updateRemaining();
}

function updateRemaining(){
	var totalLeft = Number(document.getElementById("remaining").innerHTML);
	
	for(var iCategory = 0; iCategory < categories.length; iCategory++){
		var troops = Object.keys(data[categories[iCategory]]);
		for(var iTroop = 0; iTroop < troops.length; iTroop++){
			var cost = data[categories[iCategory]][troops[iTroop]].cost;
			
			if(cost > totalLeft){
				document.getElementById(categories[iCategory] + "-" + troops[iTroop] + "Plus").disabled = true;
			}else{
				document.getElementById(categories[iCategory] + "-" + troops[iTroop] + "Plus").disabled = false;
			}
		}
	}
}


function clearAll(){
	for(var iCategory = 0; iCategory < categories.length; iCategory++){
		clearList(categories[iCategory]);
	}
}

function clearList(listName){
	var troops = Object.keys(data[listName]);
	for(var iTroop = 0; iTroop < troops.length; iTroop++){
		while(document.getElementById(troops[iTroop] + "Count").value > 0){
			minus(document.getElementById(troops[iTroop] + "Count").parentElement);
		}
	}
}