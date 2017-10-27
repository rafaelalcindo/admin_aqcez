<?php

	namespace App\Http\Controllers;

	class feedController extends Controller{
		public  function getIndex(){
			return view('pages.home');
		}

		public function getAbout(){

		}

		public function getContact(){
			return "Hello Contact Page";
		}
	}
