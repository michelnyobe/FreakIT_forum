@extends('layouts.forum')

@section('content')
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf

            <div class="mb-4">
                <label for="intitule" class="block text-gray-700 text-sm font-bold mb-2">Intitulé :</label>
                <input type="text" name="intitule" id="intitule" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500" required>
            </div>

            <div class="mb-4">
                <label for="details" class="block text-gray-700 text-sm font-bold mb-2">Détail :</label>
                <textarea name="details" id="detail" class="w-full border border-gray-300 rounded-md p-2 focus:outline-none focus:border-blue-500" required></textarea>
            </div>

            <div class="flex justify-end">
                <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Enregistrer</button>
            </div>
        </form>
@endsection
