$(window).ready(function() {
	// Create the dropdown base
	$("<select />").appendTo(".navigation");
	
	// Create default option "Navigation"
	$("<option />", {
		"selected": "selected",
		"value"   : "",
		"text"    : "Menu"
	}).appendTo(".navigation select"); 
	

	
	// Populate dropdown with menu items
	$(".navigation a").each(function() {
		var el = $(this);
		$("<option />", {
			"value"   : el.attr("href"),
			"text"    : el.text()
		}).appendTo(".navigation select");
		
	});
	$(".navigation select").change(function() {
		window.location = $(this).find("option:selected").val();
		
	});
 
	});
