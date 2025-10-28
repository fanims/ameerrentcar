<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactMessageMail;
use App\Models\WebsiteSetting;

class ContactController extends Controller
{

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $contact = Contact::create($request->all());

        // Get admin email
        $adminEmail = WebsiteSetting::first()->email;

        if ($adminEmail) {
            Mail::to($adminEmail)->send(new ContactMessageMail($contact));
        }

        return back()->with('success', 'Message sent successfully.');
    }
}
