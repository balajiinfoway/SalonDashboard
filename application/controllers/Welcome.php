<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends AdminController {
	public function index()
	{
		$this->checkSessionAdmin();
		$this->adminView('dashboard');
	}
}
