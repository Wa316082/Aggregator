<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;
use App\Mail\DemoMail;
use Illuminate\Support\Facades\Auth;

class MailController extends Controller
{
    public function index()
    {
        $mailData = [
            'title' => 'Mail from laravel',
            'body' => 'This is for testing email using smtp.',

        ];

        Mail::to(Auth::user()->email)->send(new DemoMail($mailData));



        dd("Email is sent successfully.");
    }
}
