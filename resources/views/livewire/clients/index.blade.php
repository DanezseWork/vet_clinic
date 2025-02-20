<style>
#clients-pagination, #clients-pagination * {
    @apply !bg-white !border-gray-300 !text-gray-700;
}
</style>
<x-app-layout>
    <x-slot name="title">
        {{ __('Clients') }}
    </x-slot>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Clients') }}
        </h2>
    </x-slot>

    <!-- Clients Table -->
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="py-4">
                <!-- Create Product Button -->
                <button data-modal-target="create-modal" data-modal-toggle="create-modal" class="block border-2 border-gray-500 hover:border-black hover:text-black text-gray-500 hover:scale-125 bg-white font-medium rounded-lg text-sm px-5 py-2.5 text-center" type="button">
                    + Add Client
                </button>
            </div>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
 
                    <div id="clients-table" class="overflow-auto">
                        <table class="w-full">
                            <thead>
                                <tr>
                                    <th class="rounded-l-xl py-2 text-left pl-1">Name</th>
                                    <th class="py-2 text-left">Address</th>
                                    <th class="py-2 text-left">Age</th>
                                    <th class="py-2 text-left">Occupation</th>
                                    <th class="rounded-r-xl py-2 text-left">Action</th>
                                </tr>
                            </thead>
                            
                            <tbody id="clients-table-body">
                                @include('livewire.clients.partials.table_body', ['clients' => $clients])
                            </tbody>
                        </table>
                        
                    </div>

                    <div class="flex justify-between items-center mb-4">
    <div>
        <label for="perPage" class="text-sm font-medium text-gray-700">Show</label>
        <select id="perPage" class="text-[15px] text-left py-2 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500">
            <option value="10" selected>10</option>
            <option value="25">25</option>
            <option value="50">50</option>
            <option value="100">100</option>
        </select>
        <span class="ml-2 text-sm font-medium text-gray-700">entries</span>
    </div>
</div>
                        <!-- Pagination -->
<div id="clients-pagination" class="mt-4 w-fit-content">
    {!! $clients->appends(['per_page' => $perPage])->links() !!}
</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div id="create-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-md max-h-full">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow-sm">
                <!-- Modal header -->
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                    <h3 class="text-xl font-semibold text-gray-900">
                        Add Client
                    </h3>
                    <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="create-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-4 md:p-5">
                    <!-- Error Messages -->
                    <ul id="error-list">
                        @if($errors->any())
                            @foreach($errors->all() as $error)
                                <li class="text-red-500">{{ $error }}</li>
                            @endforeach
                        @endif
                    </ul>

                    <!-- Form -->
                    <form id="create-form" action="{{ route('clients.store') }}" method="post" class="flex flex-col gap-2">
                        @csrf
                        @method('post')

                        <!-- Name Input -->
                        <input type="text" name="name" placeholder="Name" value="{{ old('name') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                        <!-- Description Input -->
                        <input type="textbox" name="address" placeholder="Address" value="{{ old('description') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                        <!-- Price Input -->
                        <input type="int" name="age" placeholder="Age" value="{{ old('price') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                        <!-- Quantity Input -->
                        <input type="text" name="occupation" placeholder="Occupation" value="{{ old('quantity') }}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">

                        <!-- Submit Button -->
                        <button type="submit" class="w-full text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:outline-none focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Product Modal -->
    @foreach($clients as $client)
            <div id="edit-modal-{{$client->id}}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                <div class="relative p-4 w-full max-w-md max-h-full">
                    <!-- Modal content -->
                    <div class="relative bg-white rounded-lg shadow-sm">
                        <!-- Modal header -->
                        <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t border-gray-200">
                            <h3 class="text-xl font-semibold text-gray-900">
                                Edit Client
                            </h3>
                            <button type="button" class="end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center" data-modal-hide="edit-modal-{{$client->id}}">
                                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                </svg>
                                <span class="sr-only">Close modal</span>
                            </button>
                        </div>
                        <!-- Modal body -->
                        <div class="p-4 md:p-5">
                            <!-- Error Messages -->
                            <ul id="error-list">
                                @if($errors->any())
                                    @foreach($errors->all() as $error)
                                        <li class="text-red-500">{{ $error }}</li>
                                    @endforeach
                                @endif
                            </ul>

                            <!-- Form -->
                            <form  method="post" action="{{route('clients.update', ['client' => $client])}}" class="flex flex-col gap-2">
                                @csrf
                                @method('put')
                                <input type="text" name="name" placeholder="Name" value="{{$client->name}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" name="description" placeholder="Description" value="{{$client->address}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" name="price" placeholder="Price" value="{{$client->age}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <input type="text" name="quantity" placeholder="Quantity"  value="{{$client->occupation}}" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5">
                                <div>
                                    <input type="submit" value="Update" class="w-full text-white bg-blue-300 px-2 py-1 rounded">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach

</x-app-layout>
<script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
<script>
$(document).ready(function () {
    const createForm = $('#create-form');
    const errorList = $('#error-list');
    const createModal = $('#create-modal');

    if (createForm.length) {
        createForm.on('submit', function (event) {
            event.preventDefault(); // Prevent default form submission

            // Clear previous errors
            errorList.html('');

            // Submit the form using jQuery AJAX
            $.ajax({
                url: createForm.attr('action'), // Form action URL
                method: 'POST',
                data: new FormData(this), // Form data
                processData: false, // Required for FormData
                contentType: false, // Required for FormData
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'), // CSRF token
                },
                success: function (data) {
                    // If the form submission is successful, close the modal and optionally refresh the page
                    createModal.addClass('hidden');
                    window.location.reload(); // Reload the page to reflect changes
                },
                error: function (xhr) {
                    // If there are validation errors, display them
                    const errors = xhr.responseJSON.errors;
                    if (errors) {
                        for (const [field, messages] of Object.entries(errors)) {
                            messages.forEach(message => {
                                errorList.append(`<li class="text-red-500">${message}</li>`);
                            });
                        }
                    } else if (xhr.responseJSON.message) {
                        // Display a generic error message if no specific errors are returned
                        errorList.append(`<li class="text-red-500">${xhr.responseJSON.message}</li>`);
                    }
                },
            });
        });
    }

    // Handle pagination link clicks
    $(document).on('click', '#clients-pagination a', function (e) {
        e.preventDefault();
        const url = $(this).attr('href'); // Get the pagination URL
        fetchClients(url);
    });

    // Function to fetch clients via AJAX
    function fetchClients(url) {
        $.ajax({
            url: url,
            type: 'GET',
            dataType: 'json',
            success: function (response) {
                $('#clients-table-body').html(response.clients); // Update table body
                $('#clients-pagination').html(response.pagination); // Update pagination links
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    }

    

});
</script>