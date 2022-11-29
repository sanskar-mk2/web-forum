<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Boards') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                @if(session()->has('success'))
                <div class="alert alert-success shadow-lg my-4">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
                @endif
                <div class="card-actions justify-end mt-4 mr-4">
                    <a href="{{ route('boards.create') }}" class="btn btn-primary">{{ "Create Board" }}</a>
                </div>
                <div class="p-6 text-gray-900 flex flex-wrap gap-4 justify-center">
                    @foreach ($boards as $board)
                        <div class="card w-72 h-96 bg-base-100 shadow-xl image-full">
                            <figure>
                                <img class="object-none" src="{{ $board->banner }}" alt="Shoes" />
                            </figure>
                            <div x-data class="card-body">
                                <h2 :style="{ backgroundColor: uniqolor('{{ $board->name }}', {lightness: 25}).color}" class="p-3 badge card-title">{{ $board->name }}</h2>
                                <p>{{ $board->description }}</p>
                                <div class="card-actions justify-end">
                                    <a href="{{ route('boards.show', $board->id) }}" class="btn btn-primary">{{ "View Board" }}</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
