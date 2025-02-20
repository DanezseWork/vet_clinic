<?php
namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Client;

class ClientsTable extends Component
{
    use WithPagination; // Enables pagination

    public function render()
    {
        return view('livewire.clients-table', [
            'clients' => Client::paginate(10) // Customize per page
        ]);
    }
}
