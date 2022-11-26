<?php
  session_start(); /* Starts the session */

  if( (isset($_SESSION['Active']) ? $_SESSION['Active'] == false : header("location:login.php") )){ /* Redirects user to Login.php if not logged in */
    header("location:login.php");
	  exit;
  }
$id = "";
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
#<li role="presentation" class="active"><a href="#">Home</a></li>
$page->nav_bar_links('index.php'  , 'Home');
#<li role="presentation"><a href="#">About</a></li>
$page->nav_bar_links('#url'  , 'About');
#<li role="presentation"><a href="#">Contact</a></li>
$page->nav_bar_links('#url'  , 'Contact');
$navigate_links = array("button" => 'index.php',
			"Log Out" => 'logout.php');
#nav dropdown array
$page->nav_bar_drop_links_get('Nav', $navigate_links);
#<!-- Show password protected content down here -->
$html = $page->tag_wrap('ul', $page->nav_bar_links);
$body = $page->tag_wrap('h1', 'Status: logged in');
$body .= $page->tag_wrap('p', "And just like that you've created your first password protected area with PHP and a little knowledge of HTML. Change the username and password in login.php for your own and give it a try!
");
$body .= $page->link_wrap("logout.php", "Log out");
#<h3 class="text-muted">PHP Login by @mariofont</h3>
$body .= $page->tag_wrap('h3', 'PHP Login');
$html .= $body;
$html = $page->tag_class_wrap('table', 'cellpadding="0" cellspacking="0"',     $html);
$html = $page->tag_class_wrap('div', 'class="invoice-box"', $html);
$html =	$format->HTML($html);
$page->display_page($title, $page->tag_wrap('style', $page->css), $html);

?>


