<?php
session_start(); /* Starts the session */
#check to see if user is logged in
if( (isset($_SESSION['Active']) ? $_SESSION['Active'] == false : header("location:login.php") )){ 
	/* Redirects user to Login.php if not logged in */
	header("location:login.php");
	exit;
  } 
#<title>Logged in</title>
$title = 'Logged in';
include 'includes/dom.inc.php';
include 'includes/dbh.inc.php';
include 'includes/template.inc.php';
include 'includes/format.php';
include 'includes/login.inc.php';
$page = new Template();
$format = new Format();
$login = new Login();
#set some links in navigation bar
#<li role="presentation" class="active"><a href="#">Home</a></li>
$page->nav_bar_links('index.php'  , 'Home');
#<li role="presentation"><a href="#">About</a></li>
$page->nav_bar_links('#url'  , 'About');
#<li role="presentation"><a href="#">Contact</a></li>
$page->nav_bar_links('#url'  , 'Contact');
#set values for dropdown menue
$navigate_links = array("button" => 'index.php',
			"Log Out" => 'logout.php');
#magic nav dropdown array
$page->nav_bar_drop_links_get('Nav', $navigate_links);
#sent magic nav bar html to $html
$html = $page->tag_wrap('ul', $page->nav_bar_links);
#<!-- Show password protected content down here -->
#set heading
$body = $page->tag_wrap('h1', 'Status: logged in');
#write some page content
$body .= $page->tag_wrap('p', "And just like that you've created your first password protected area with PHP and a little knowledge of HTML. Change the username and password in login.php for your own and give it a try!
");
#add some more content
$body .= $page->link_wrap("logout.php", "Log out");
#<h3 class="text-muted">PHP Login by @mariofont</h3>
$body .= $page->tag_wrap('h3', 'PHP Login');
#combind the html string
$html .= $body;
#wrap the html in some tags for css
$html = $page->tag_class_wrap('table', 'cellpadding="0" cellspacking="0"',     $html);
#wrap html page again in a div tag
$html = $page->tag_class_wrap('div', 'class="invoice-box"', $html);
#magic format html string for page debug on screen
$html =	$format->HTML($html);
#sent page out for display
#PHP 8 headers(); and redirect logic should be handled before anything is echo(ed); to the page.
#set all of the html to a string and echo the whole string at once
$page->display_page($title, $page->tag_wrap('style', $page->css), $html);
?>
