// Adapted from http://tutorialzine.com/2009/09/simple-ajax-website-jquery

$(function() {
	$('#main').load("staticContent.htm #home_");
});

$(function(){
	// Check if the URL has a reference to a page and load it
	checkURL();

	// Traverse through the navigation links
	// and assign them a new onclick event, 
	// using their own hash as a parameter
	$('nav a').click(function (e){
			checkURL(this.hash);
	});
	
	// Check for a change in the URL every 250 ms to detect if the history buttons have been used
	setInterval("checkURL()",250);

});

// Store the current URL hash
var lasturl="";

function checkURL(hash)
{
	// If no parameter is provided, use the hash value from the current address
	if(!hash) hash=window.location.hash;

	if(hash != lasturl)	// If the hash value has changed,
	{
		lasturl=hash;	// update the current hash
		loadPage(hash);	// and load the new page
	}

	console.log(hash);
}

// Load page content
function loadPage(url)
{
	switch(url) {
	// Static pages
	case "#features":
		$('#main').load("staticContent.htm #features_");
		break;
	case "#documentation":
		$('#main').load("staticContent.htm #documentation_");
		break;

	// Dynamic
	case "#contact":
		$('#main').load("staticElements.htm #contact");
		break;
	case "#account":
		getUser();
		break;
	case "#classes":
		getCourses("list");
		break;
	case "#assignments":
		getAssigns();
		break;
	case "#projects":
		getProjects();
		break;
	case "#bibiography":
	case "#files":
	case "#discussion":
		$('#main').html("<h3>Under Construction</h3><p>This funcionality has not yet been implemented.</p>");
		break;
	// When all else fails
	default:
		$('#main').load("staticContent.htm #home_");
	}
}


