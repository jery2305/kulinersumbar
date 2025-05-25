<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;

class ContactAdminController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'asc')->paginate(10);
        return view('admin.contact.index', compact('contacts'));
    }

    public function create()
    {
        return view('admin.contact.create-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string',
        ]);

        Contact::create($request->only('nama', 'email', 'pesan'));

        return redirect()->route('admin.contact.index')->with('success', 'Pesan berhasil disimpan.');
    }

    public function edit(Contact $contact)
    {
        return view('admin.contact.create-edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'pesan' => 'required|string',
        ]);

        $contact->update($request->only('nama', 'email', 'pesan'));

        return redirect()->route('admin.contact.index')->with('success', 'Pesan berhasil diperbarui.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();

        return redirect()->route('admin.contact.index')->with('success', 'Pesan berhasil dihapus.');
    }
}
