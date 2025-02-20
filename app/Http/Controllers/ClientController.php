<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::all();
        return view('livewire.clients.index', ['clients' => $clients]);
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


    // public function store(Request $request){
    //     $data = $request->validate([
    //         'name' => 'required',
    //         'price' => 'required|decimal:0,2',
    //         'quantity' => 'required|numeric',
    //         'description' => 'nullable',
    //     ]);

    //     $newProduct = Products::create($data);

    //     return redirect(route('products.index'));
    // }

}
