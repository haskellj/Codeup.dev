var colors = ['red', 'orange', 'yellow', 'green', 'blue', 'indigo', 'violet'];
var color = colors[Math.floor(Math.random()*colors.length)];

var favorite = 'blue'; 


if (color=='red'){
	console.log(color + " is supposed to make you hungry and/or angry");
} else if (color=='orange'){
	console.log(color + " is a complementary color to blue");
} else if (color=='yellow'){
	console.log(color + " is the color of \"most\" pee");
} else if (color=='green'){
	console.log(color + " is the color of money, grass, and envy");
} else if (color=='blue'){
	console.log(color + " is the color of pure water");
} else {
	console.log("I do not know anything about " + color);
}

var message=(color==favorite) ? "Wow, that's my favorite color!" : "But, that is not my favorite color.";
	console.log(message);












