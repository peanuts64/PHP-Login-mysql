<?php
session_start();
/* Check if login form has been submitted */
#set the title of the page
$title = 'log in';
#load php class files
#dom.inc.php is a class that spits out html
include 'includes/dom.inc.php';
#dbh.inc.php holds the credentials for logging into the database
#if there is no database then dbh.inc.php becomes the default credentials 
include 'includes/dbh.inc.php';
#template.inc.php assembles the last html details
include 'includes/template.inc.php';
#format.php to make the html easier to read in browser
include 'includes/format.php';
#login.inc.php handles the login logic
include 'includes/login.inc.php';
#call the classes
$page = new Template();
$format = new Format();
$login = new Login();
#create a html form inputs label => type
$form_inputs = array(
	'Username' => 'text', 
	'Password' => 'password' 
	);
#dump the array into self validating html form function
$page->form_new_list($form_inputs);
#add the output from the function onto the output var
#this takes the output html of the previous function and appends it to a string
$body = $page->form;
# if the $input_flag is valid, check credentials with validate_login();
#echo $page->input_flag;
$body .= ($page->input_flag == 'TRUE' ? $login->validate_login($page->post_data_inputs, $page->input_flag) : 'Please fill out the form');
#navigation button
$page->nav_bar_links('index.php'  , 'Home');
#navigation drop menu links
$navigatoin_links = array('Log In' => 'login.php',
			'README' => 'README.md');
#magic drop down menu links
$page->nav_bar_drop_links_get('Nav', $navigatoin_links);
#add the navigation bar html to the html string
$html = $page->tag_wrap('ul', $page->nav_bar_links);
#combine navigation
$html .= $body;
#wrapping the html string in a table tag for CSS
$html = $page->tag_class_wrap('table', 'cellpadding="0" cellspacking="0"',     $html);
#wrapping the html string in a div tag
$html = $page->tag_class_wrap('div', 'class="invoice-box"', $html);
#magic html format for debugging html output of a page
$html =	$format->HTML($html);
#sent the page out to the browser with the wrapping html heading tags and style sheets
$page->display_page($title, $page->tag_wrap('style', $page->css), $html);
#debug forms post data
#(isset($page->post_data_inputs) ? print_r($page->post_data_inputs) : '' );
