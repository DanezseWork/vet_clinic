<?php
namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Client;

class ClientTable extends Component
{
    public $clients;
    public $showForm = false;
    public $name;
    public $email;

    public function mount()
    {
        $this->clients = Client::all();
    }

    public function toggleForm()
    {
        $this->showForm = !$this->showForm;
    }

    public function addClient()
    {
        $this->validate([
            'name' => 'required',
            'email' => 'required|email|unique:clients,email',
        ]);

        Client::create(['name' => $this->name, 'email' => $this->email]);
        $this->clients = Client::all();
        $this->reset(['name', 'email', 'showForm']);
    }

    public function render()
    {
        return view('livewire.client-table');
    }
}

