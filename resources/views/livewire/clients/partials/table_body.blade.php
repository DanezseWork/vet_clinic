@foreach($clients as $client)
    <tr>
        <td class="border-y border-gray-200 text-left text-gray-500 capitalize py-5 pl-1">{{ $client->name }}</td>
        <td class="border-y border-gray-200 text-left text-gray-500 capitalize">{{ $client->address }}</td>
        <td class="border-y border-gray-200 text-left text-gray-500 capitalize">{{ $client->age }}</td>
        <td class="border-y border-gray-200 text-left text-gray-500 capitalize">{{ $client->occupation }}</td>
        <td class="border-y border-gray-200 text-left">
            <div class="flex justify-left gap-2 items-center">
                <button data-modal-target="edit-modal-{{$client->id}}" data-modal-toggle="edit-modal-{{$client->id}}" class="bg-transparent text-blue-300 px-2 py-1 rounded"><i class="fas fa-edit"></i></button>
                <form method="post" action="{{ route('clients.delete', ['client' => $client]) }}">
                    @csrf
                    @method('delete')
                    <label for="delete-button" class="hover:cursor-pointer">
                        <i class="fas fa-trash bg-transparent text-red-400 px-2 py-1 rounded"></i>
                    </label>
                    <input id="delete-button" type="submit" class="hidden">
                </form>
            </div>
        </td>
    </tr>
@endforeach