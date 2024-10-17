{{-- @extends('layouts.guest') --}}

{{-- @section('title', 'Apprendre HTML') --}}

{{-- @section('content') --}}
<x-app-layout>
<div class="bg-white shadow-md rounded-lg p-6">
    <h1 class="text-2xl font-bold mb-4">Apprendre HTML</h1>
    <div x-data="{ selected: null }">
        <div class="border-t border-gray-200">
            <button @click="selected !== 1 ? selected = 1 : selected = null"
                    class="w-full text-left px-4 py-2 bg-gray-100 border-b border-gray-200 focus:outline-none">
                <span class="font-semibold">Qu'est-ce que HTML ?</span>
            </button>
            <div x-show="selected === 1" class="p-4">
                <p class="text-gray-700">HTML signifie HyperText Markup Language...</p>
            </div>
        </div>
        <div class="border-t border-gray-200">
            <button @click="selected !== 2 ? selected = 2 : selected = null"
                    class="w-full text-left px-4 py-2 bg-gray-100 border-b border-gray-200 focus:outline-none">
                <span class="font-semibold">Les bases de HTML</span>
            </button>
            <div x-show="selected === 2" class="p-4">
                <p class="text-gray-700">Les bases de HTML incluent...</p>
            </div>
        </div>
        <!-- Ajouter d'autres sections comme nécessaire -->
    </div>
</div>
{{-- @endsection --}}
</x-app-layout>