<?php

class BaseController extends Controller {

   /**
    * Show the home page
    */
	public function showHome() {
		return View::make('base.home');
	}
    
   /**
    * Show the about page
    */
	public function showAbout() {
		return View::make('base.about');
	}

}
