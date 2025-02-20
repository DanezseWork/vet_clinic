<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    // public function index()
    // {
    //     $clients = Client::all();
    //     return view('livewire.clients.index', ['clients' => $clients]);
    // }

    public function index(Request $request)
{
    // Get the per_page value from the request, default to 10
    $perPage = $request->input('per_page', 10);

    // Fetch clients with pagination
    $clients = Client::paginate($perPage);

    // If AJAX request, return partial view
    if ($request->ajax()) {
        $view = view('livewire.clients.partials.table_body', ['clients' => $clients])->render();
        $pagination = $clients->appends(['per_page' => $perPage])->links()->toHtml();
        
        return response()->json(['clients' => $view, 'pagination' => $pagination]);
    }

    return view('livewire.clients.index', compact('clients', 'perPage'));
}


    public function create()
    {
        return view('clients.create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable',
            'age' => 'required|numeric',
            'occupation' => 'required|string|max:255',
        ]);

        // Save the product
        Client::create($validatedData);

        return response()->json(['success' => true]);
    }

    public function update(Request $request, Client $client){
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'nullable',
            'age' => 'required|numeric',
            'occupation' => 'required|string|max:255',
        ]);

        $client->update($data);

        return redirect(route('clients.index'))->with('success', 'Client Updated Successfully.');
    }

    public function delete(Client $client){
        $client->delete();

        return redirect(route('clients.index'))->with('success', 'Client Deleted.');
    }
}
