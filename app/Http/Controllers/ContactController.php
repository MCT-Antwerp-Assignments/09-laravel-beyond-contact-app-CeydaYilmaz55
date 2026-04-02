<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function create()
    {
        return view('contacts.create');
    }

    

    public function store(Request $request)
    {
        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|max:255',
            'address' => 'nullable|max:255',
         ], [
            'first_name.required' => 'Voornaam is verplicht.',
            'last_name.required' => 'Achternaam is verplicht.',
            'email.required' => 'E-mail is verplicht.',
            'email.email' => 'Geef een geldig e-mailadres in.',
       ]);

        Contact::create([
            'user_id' => Auth::id(),
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('home')->with('success', 'Contact saved!');
    }

    public function edit(Contact $contact)
    {
        if ($contact->user_id !== Auth::id()) {
            abort(403);
        }

        return view('contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        if ($contact->user_id !== Auth::id()) {
            abort(403);
        }

        $request->validate([
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|max:255',
            'address' => 'nullable|max:255',
         ], [
            'first_name.required' => 'Voornaam is verplicht.',
            'last_name.required' => 'Achternaam is verplicht.',
            'email.required' => 'E-mail is verplicht.',
            'email.email' => 'Geef een geldig e-mailadres in.',
        ]);

        $contact->update([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        return redirect()->route('home')->with('success', 'Contact updated!');
    }

    public function destroy(Contact $contact)
    {
        if ($contact->user_id !== Auth::id()) {
            abort(403);
        }

        $contact->delete();

        return redirect()->route('home')->with('success', 'Contact deleted!');
    }
    public function restore($id)
{
    $contact = Contact::withTrashed()
        ->where('id', $id)
        ->where('user_id', Auth::id())
        ->firstOrFail();
    $contact->restore();

    return redirect()->route('home')->with('success', 'Contact restored!');
}
}