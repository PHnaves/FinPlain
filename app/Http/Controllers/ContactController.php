<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Mail\ContactEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function store(ContactRequest $request)
    {
        $infomations = $request->validated();

        Mail::to(env('MAIL_FROM_ADDRESS'))->send(new ContactEmail($infomations));

        return back()->with('success', 'Enviado com sucesso! Em breve entraremos em contato.');
    }
}
