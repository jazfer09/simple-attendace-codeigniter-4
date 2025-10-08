<?php
namespace App\Controllers;

class Home extends BaseController
{
    public function index()
    {
        $session = session();
        if ($session->get('logged_in')) {
            return redirect()->to('/dashboard');
        }
        
        return view('home');
    }
    public function aboutDeveloper()
   {
       return view('about_developer');
   }
}