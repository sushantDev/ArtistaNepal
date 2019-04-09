<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        $contacts = Contact::all();

        $featured_contact = Contact::latest()->paginate('1');

        return view('backend.contact.index', compact('contacts', 'featured_contact'));
    }

    /**
     * @param Contact $contact
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(Contact $contact)
    {
        $contacts = Contact::all();

        $featured_contact = Contact::where('id', $contact->id)->paginate('1');

        return view('backend.contact.index', compact('contacts', 'featured_contact'));
    }

    /**
     * @param Contact $contact
     * @return mixed
     * @throws \Exception
     */
    public function destroy(Contact $contact)
    {
        $contact->delete();

        return back()->withSuccess(trans('message.delete_success', [ 'entity' => 'Event' ]));
    }
}
