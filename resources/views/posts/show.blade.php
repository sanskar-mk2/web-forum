<x-app-layout>
    <x-slot name="header">
        
        <a href="{{ route('boards.show', $post->board->id) }}">
        <h2 x-data :style="{ backgroundColor: uniqolor('{{ $post->board->name }}', {lightness: 25}).color}" class="badge font-semibold text-xl p-4 leading-tight">
            {{ $post->board->name }}
        </h2>
        </a>
        <span>{{ $post->title }}</span>
    </x-slot>

    <div x-data="{modal: ''}" class="py-12">
        <div x-show="modal" class="fixed bg-black/30 top-0 left-0 w-screen h-screen flex justify-center items-center">
            <div class="w-11/12 flex justify-center">
                <img x-on:click.outside="modal=''" :src="modal" alt="modal" />
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if(session()->has('success'))
                <div class="alert alert-success shadow-lg my-4">
                    <div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="stroke-current flex-shrink-0 h-6 w-6" fill="none" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" /></svg>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            <div class="p-4 sm:p-8 bg-primary shadow sm:rounded-lg text-white">
                <div class="w-full">
                    <div>
                        <h3 class="text-xl">{{ $post->is_op ? '[OP]' : ''}} {{ $post->title }}</h3>
                        <p class="mt-4">{{ $post->content }}</p>
                        <div class="flex mt-2 overflow-x-auto">
                            @foreach ($post->medias as $media)
                                <img x-on:click="modal='{{ $media->path }}'" class="h-64" src="{{ $media->path }}" alt="{{ $media->name }}">
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <small class="text-sm">Posted by {{ $post->user->name }} {{ $post->created_at }}</small>
                            <br>
                            <span class="badge badge-accent">Last activity {{ $post->last_reply->created_at ?? $post->created_at }}</span>
                            <span class="badge badge-accent">{{ count($post->replies) }} Replies</span>
                        </div>
                    </div>
                </div>
            </div>
            @foreach ($post->replies as $reply)
            <div class="p-4 mt-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <div>
                        <h3 class="text-xl">{{ $reply->title }}</h3>
                        <p class="mt-4">{{ $reply->content }}</p>
                        <div class="mt-2 flex overflow-x-auto">
                            @foreach ($reply->medias as $media)
                                <img x-on:click="modal='{{ $media->path }}'" class="h-36" src="{{ $media->path }}" alt="{{ $media->name }}">
                            @endforeach
                        </div>
                        <div class="mt-4">
                            <span class="badge badge-secondary">Replied {{ $reply->created_at }} by {{ $reply->user->name }}</span>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            <div class="p-4 mt-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="w-full">
                    <form class="grid w-full grid-cols-1" method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
                        @csrf
                        {{-- @if($errors->any())
                            {{ implode('', $errors->all('<div>:message</div>')) }}
                        @endif --}}
                        <input type="hidden" name="board_id" value="{{ $post->board->id }}">
                        <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
                        <input type="hidden" name="is_op" value="0">
                        <input type="hidden" name="post_id" value="{{ $post->id }}">
                        <div class="form-control w-full max-w-xs">
                            <label class="label" for="title">
                                <span class="label-text">Reply title</span>
                            </label>
                            <input type="text" id="title" name="title" placeholder="Reply title" value="{{ old('title') }}" class="input input-bordered w-full max-w-xs" />
                            @error('title')
                                <span class="text-red-500 text-xs italic">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-control">
                            <label class="label" for="content">
                                <span class="label-text">Reply content</span>
                            </label> 
                            <textarea name="content" id="content" class="textarea textarea-bordered h-24" placeholder="Reply content">{{ old('content') }}</textarea>
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
                            <input type="submit" class="btn btn-primary" value="Post Reply">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
