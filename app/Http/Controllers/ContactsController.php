<?php

namespace App\Http\Controllers;

use App\Contact;

class ContactsController extends Controller
{
    public function create()
    {
        return view('contacts.create');
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required'
        ]);

        Contact::create(request(['name', 'email', 'subject', 'message']));

        return redirect()->home();
    }
}
