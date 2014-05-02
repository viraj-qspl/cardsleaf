<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml"><head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $site_title; ?></title>
<LINK rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_theme_url')?>Dynamic Drive DHTML Scripts- Smooth Navigational Menu_files/ddsmoothmenu.css">

<!--<script src="<?php echo $this->config->item('admin_theme_url')?>js/jquery.js" type="text/javascript"></script>-->

<SCRIPT type="text/javascript" src="<?php echo $this->config->item('admin_theme_url')?>Dynamic Drive DHTML Scripts- Smooth Navigational Menu_files/jquery.min.js"></SCRIPT>
<SCRIPT type="text/javascript" src="<?php echo $this->config->item('admin_theme_url')?>Dynamic Drive DHTML Scripts- Smooth Navigational Menu_files/ddsmoothmenu.js"></SCRIPT>
<SCRIPT type="text/javascript">
ddsmoothmenu.init({
	mainmenuid: "smoothmenu1", //menu DIV id
	orientation: 'h', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu', //class added to menu's outer DIV
	//customtheme: ["#1c5a80", "#18374a"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

ddsmoothmenu.init({
	mainmenuid: "smoothmenu2", //Menu DIV id
	orientation: 'v', //Horizontal or vertical menu: Set to "h" or "v"
	classname: 'ddsmoothmenu-v', //class added to menu's outer DIV
	//customtheme: ["#804000", "#482400"],
	contentsource: "markup" //"markup" or ["container_id", "path_to_menu_file"]
})

ddsmoothmenu.init({
	mainmenuid: "smoothmenu-ajax",
	orientation: 'h',
	classname: 'ddsmoothmenu',
	customtheme: ["#1c5a80", "#18374a"], //override default menu CSS background values? Uncomment: ["normal_background", "hover_background"]
	contentsource: ["smoothcontainer", "smoothmenu.htm"] //"markup" or ["container_id", "path_to_menu_file"]
})

</SCRIPT>
<LINK rel="stylesheet" type="text/css" href="<?php echo $this->config->item('admin_theme_url')?>Dynamic Drive DHTML Scripts- Smooth Navigational Menu_files/widget12.css" media="">
<link href="<?php echo $this->config->item('admin_theme_url')?>css/adminstyle.css" rel="stylesheet" type="text/css" />

<script src="<?php echo $this->config->item('admin_theme_url')?>js/jquery.validate.js" type="text/javascript"></script>

<script type="text/javascript" src="<?php echo $this->config->item('admin_theme_url')?>menujs/jquery.min.js"></script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_theme_url')?>menujs/ddaccordion.js"></script>
<script type="text/javascript">
    ddaccordion.init({
	headerclass: "submenuheader", //Shared CSS class name of headers group
	contentclass: "submenu", //Shared CSS class name of contents group
	revealtype: "click", //Reveal content when user clicks or onmouseover the header? Valid value: "click", "clickgo", or "mouseover"
	mouseoverdelay: 3200, //if revealtype="mouseover", set delay in milliseconds before header expands onMouseover
	collapseprev: true, //Collapse previous content (so only one open at any time)? true/false 
	defaultexpanded: [], //index of content(s) open by default [index1, index2, etc] [] denotes no content
	onemustopen: false, //Specify whether at least one header should be open always (so never all headers closed)
	animatedefault: false, //Should contents open by default be animated into view?
	persiststate: true, //persist state of opened contents within browser session?
	toggleclass: ["", ""], //Two CSS classes to be applied to the header when it's collapsed and expanded, respectively ["class1", "class2"]
	togglehtml: ["suffix", "<img src='plus.gif' class='statusicon' />", "<img src='minus.gif' class='statusicon' />"], //Additional HTML added to the header when it's collapsed and expanded, respectively  ["position", "html1", "html2"] (see docs)
	animatespeed: "fast", //speed of animation: integer in milliseconds (ie: 200), or keywords "fast", "normal", or "slow"
	oninit:function(headers, expandedindices){ //custom code to run when headers have initalized
		//do nothing
	},
	onopenclose:function(header, index, state, isuseractivated){ //custom code to run whenever a header is opened or closed
		//do nothing
	}
})
</script>
<script type="text/javascript" src="<?php echo $this->config->item('admin_theme_url')?>ckeditor/ckeditor.js"></script>
<?php /*?><!-- TinyMCE -->
<script type="text/javascript" src="<?php echo $this->config->item('admin_theme_url')?>tinymce/jscripts/tiny_mce/tiny_mce.js"></script>
<script type="text/javascript">
	tinyMCE.init({
		// General options
		mode : "textareas",
		theme : "advanced",
		plugins : "autolink,lists,pagebreak,style,layer,table,save,advhr,advimage,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template,wordcount,advlist,autosave,visualblocks",

		// Theme options
		theme_advanced_buttons1 : "save,newdocument,|,bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,styleselect,formatselect,fontselect,fontsizeselect",
		theme_advanced_buttons2 : "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
		theme_advanced_buttons3 : "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
		theme_advanced_buttons4 : "insertlayer,moveforward,movebackward,absolute,|,styleprops,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,pagebreak,restoredraft,visualblocks",
		theme_advanced_toolbar_location : "top",
		theme_advanced_toolbar_align : "left",
		theme_advanced_statusbar_location : "bottom",
		theme_advanced_resizing : true,

		// Example content CSS (should be your site CSS)
		content_css : "css/content.css",

		// Drop lists for link/image/media/template dialogs
		template_external_list_url : "lists/template_list.js",
		external_link_list_url : "lists/link_list.js",
		external_image_list_url : "lists/image_list.js",
		media_external_list_url : "lists/media_list.js",

		// Style formats
		style_formats : [
			{title : 'Bold text', inline : 'b'},
			{title : 'Red text', inline : 'span', styles : {color : '#ff0000'}},
			{title : 'Red header', block : 'h1', styles : {color : '#ff0000'}},
			{title : 'Example 1', inline : 'span', classes : 'example1'},
			{title : 'Example 2', inline : 'span', classes : 'example2'},
			{title : 'Table styles'},
			{title : 'Table row 1', selector : 'tr', classes : 'tablerow1'}
		],

		// Replace values for the template plugin
		template_replace_values : {
			username : "Some User",
			staffid : "991234"
		}
	});
</script>
<!-- /TinyMCE --><?php */?>


<!-- DATE PICKER -->
<link rel="stylesheet" href="<?php echo $this->config->item('admin_theme_url')?>themes/base/jquery.ui.all.css">
<script src="<?php echo $this->config->item('admin_theme_url')?>ui/jquery.ui.core.js"></script>
<script src="<?php echo $this->config->item('admin_theme_url')?>ui/jquery.ui.widget.js"></script>
<script src="<?php echo $this->config->item('admin_theme_url')?>ui/jquery.ui.datepicker.js"></script>


<style type="text/css">
#ui-datepicker-div {
    font-size: 62.5%;
}
</style>


<script>
/*
$(function() {
    $( "#from_date" ).datepicker();
    $("#to_date").datepicker();
});
*/
</script>

<!-- DATE PICKER -->
</head>
<body>
<div id="maindiv">
<div id="header">
<div class="header-left"></div>
<div class="header-mid">
<h1>Administration</h1>
</div>
<div class="header-mid">
<h1 style="font-size:18px; padding:0; cursor:pointer; float: right;"><a href="<?php echo base_url(); ?>" target="_blank">View Site</>&nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo site_url('admin/home/logout'); ?>" title="Logout">Logout</a></h1>
</div>
<div class="header-right"></div>
</div>
<!--<div style="height:30px;"></div>-->
<div style="border: 1px solid #CCC; width: 98.2%; margin: 0 auto 14px auto; float:none;">
<div class="clear"></div>
<div id="maincontainer">
<div class="mid_bg">
