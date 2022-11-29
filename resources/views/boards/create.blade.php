<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Board') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 w-full text-gray-900 flex flex-wrap gap-4 justify-center">
                    <form class="grid w-full grid-cols-1" method="POST" action="{{ route('boards.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-control w-full max-w-xs">
                            <label class="label" for="name">
                                <span class="label-text">Board title</span>
                            </label>
                            <input type="text" id="name" name="name" placeholder="Board title" value="{{ old('name') }}" class="input input-bordered w-full max-w-xs" />
                            @error('name')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label class="label" for="description">
                                <span class="label-text">Board description</span>
                            </label> 
                            <textarea name="description" id="description" class="textarea textarea-bordered h-24" placeholder="Board description">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label class="label" for="banner">
                                <span class="label-text">Board banner</span>
                            </label> 
                            <input name="banner" id="banner" type="file" class="file-input file-input-bordered file-input-primary w-full max-w-xs" />
                            @error('banner')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="card-actions mt-4 justify-center">
                            <input type="submit" class="btn btn-primary" value="Sumbit Board">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
