<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Post') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 w-full text-gray-900 flex flex-wrap gap-4 justify-center">
                    <form class="grid w-full grid-cols-1" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- @if($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif --}}
                        <input type="hidden" name="board_id" value="{{ $board->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="is_op" value="1">
                        <h2 x-data :style="{ backgroundColor: uniqolor('{{ $board->name }}', {lightness: 25}).color}" class="p-3 badge card-title">{{ $board->name }}</h2>
                        <div class="form-control w-full max-w-xs">
                            <label class="label" for="title">
                                <span class="label-text">Post title</span>
                            </label>
                            <input type="text" id="title" name="title" placeholder="Post title" value="{{ old('title') }}" class="input input-bordered w-full max-w-xs" />
                            @error('title')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label class="label" for="content">
                                <span class="label-text">Post content</span>
                            </label> 
                            <textarea name="content" id="content" class="textarea textarea-bordered h-24" placeholder="Post content">{{ old('content') }}</textarea>
                            @error('content')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label class="label" for="images">
                                <span class="label-text">Images</span>
                            </label> 
                            <input name="images[]" id="images" type="file" multiple class="file-input file-input-bordered file-input-primary w-full max-w-xs" />
                            @error('images')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="card-actions mt-4 justify-center">
                            <input type="submit" class="btn btn-primary" value="Create Post">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
