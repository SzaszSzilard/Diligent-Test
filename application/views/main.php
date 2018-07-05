<?php
	$this->load->view('header');
	$this->load->view('navbar');
	// -------------------------
	
	if ( $page != "" )
		$this->load->view($page);
	else
		$this->load->view('welcome');
	
	// -------------------------
	$this->load->view('footer');