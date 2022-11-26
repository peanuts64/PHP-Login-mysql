<?php
require_once ('config.php'); // For storing username and password.
session_start();
        /* Check if login form has been submitted */
##########################################################################
# index9.php
########################################################################
$id = "";
$title = 'log in';
include 'includes/dom.inc.php';
include 'includes/dbh.inc.php';
include 'includes/template.inc.php';
include 'includes/format.php';
include 'includes/login.inc.php';
$page = new Template();
$format = new Format();
$login = new Login();
$form_inputs = array(
	'Username' => 'text', 
	'Password' => 'password' 
	);
$page->form_new_list($form_inputs);
$body = $page->form;
$body .= ($page->input_flag == 'TRUE' ? $login->validate_login($page->post_data_inputs, $page->input_flag) : 'Please fill out the form');
$page->nav_bar_links('index.php'  , 'Home');
$page->nav_bar_drop_links_get('Nav', $page->nav_page_locations);
$html = $page->tag_wrap('ul', $page->nav_bar_links);
$html .= $body;
$html = $page->tag_class_wrap('table', 'cellpadding="0" cellspacking="0"',     $html);
$html = $page->tag_class_wrap('div', 'class="invoice-box"', $html);
$html =	$format->HTML($html);
$page->display_page($title, $page->tag_wrap('style', $page->css), $html);
(isset($page->post_data_inputs) ? print_r($page->post_data_inputs) : '' );
echo $page->input_flag;

