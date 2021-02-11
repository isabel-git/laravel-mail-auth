<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;//includo Auth
use Illuminate\Support\Facades\Mail; //includo Mail
use App\Mail\TestMail; //includo TestMail

use Illuminate\Http\Request;


class HomeController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function sendMail(Request $request) {
        $data = $request -> validate([
            'mailText' => 'required|min:5'
        ]);

        // dd($data);
        
        Mail::to(Auth::user() -> email)
            -> send(new TestMail($data['mailText']));


        return redirect() -> back();
    }

    public function index()
    {   
       // dd(Auth::user());
    //    $mail = (Auth::user() -> email); //ottengo l'email dell'ute collegato

    //    Mail::to($mail) //mandiamo un email all'utente collegato 
    //     -> send(new TestMail('Welcome from Laravel')); //mandando il messaggio contenuto nel TastMail

        return view('home');
    }
}
