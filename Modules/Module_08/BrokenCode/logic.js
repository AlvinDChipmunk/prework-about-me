
// When the factButton is clicked...
$("#factButton").on("click", function() {
	// We generate a random number between 0 and 4 (the number of facts in the catFactArray)
	var number = Math.floor((Math.random() * booFacts.length));
	// We display the fact from the booFacts that is in the random position we just generated.
	$("#factText").text(booFacts[number]);
});

// This array holds all of our Grumpy Cat facts!
var catFactArray = ["Grumpy was born on April 4, 2012", "Grumpy's unique look comes from feline dwarfism and an underbite", "Grumpy has a brother named Pokey", "Her favorite Friskies food is Savory Shreds"];


// string array broken due to not having the needed double quotes to partition the different strings from each other
// string array initialization tip - have each element on a separate line

var booFacts = [
	"Boo is a pomeranian", 
	"Boo's best friend is another pomeranian named Buddy", 
	"Boo the Pomeranian was born on March 16, making him a Pisces", 
	"Boo's favourite food is grass", 
	"Boo has released two books" 
];

$("#textPink").on("click", function() 
	{
		$("#funText").css("color", "pink")
	}
)

$("#textOrange").on("click", function() 
	{
		$("#funText").css("color", "orange")
	}
)

$("#textGreen").on("click", function() 
	{
		$("#funText").css("color", "green")
	}
)


$("#boxGrow").on("click", function() 
	{
		//Should enlarge the box
		$("#box").animate 
		(
			{
				height:"+=35px", width:"+=35px"
			}, "fast"
		);
	}
)

$("#boxShrink").on("click", function() 
	{
		//Should shrink the box
		$("#box").animate
		(
			{
				height:"-=35px", width:"-=35px"
			}, "fast"
		);
	}
)