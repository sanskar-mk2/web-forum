<x-app-layout>
    <x-slot name="header">
        <h2 x-data :style="{ backgroundColor: uniqolor('{{ $board->name }}', {lightness: 25}).color}" class="badge font-semibold text-xl p-4 leading-tight">
            {{ $board->name }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="card h-56 lg:card-side bg-base-100 shadow-xl mb-4">
                        <img class="object-cover" src="{{ $board->banner }}" alt="Shoes" />
                    <div class="card-body">
                        <h2 x-data :style="{ backgroundColor: uniqolor('{{ $board->name }}', {lightness: 25}).color}" class="p-3 badge card-title">{{ $board->name }}</h2>
                        <p>{{ $board->description }}</p>
                        <div class="card-actions justify-end">
                            <a href="{{ route('posts.create', ['id' => $board->id]) }}" class="btn btn-primary">{{ "Create Post" }}</a>
                        </div>
                    </div>
                </div>
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                {{-- <th>Board</th> --}}
                                <th>Title</th>
                                {{-- <th>Content</th> --}}
                                <th>Created At</th>
                                <th>Last Posted At</th>
                                <th>Replies</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($board->posts as $post)
                            @if($post->is_op)
                            <tr class="hover">
                                {{-- <td>
                                    <a class="link" href="{{ route('boards.show', $post->board->id) }}">
                                        {{ $post->board->name }}
                                    </a>
                                </td> --}}
                                <td>
                                    <a class="link" href="{{ route('posts.show', $post->id) }}">
                                        {{ $post->title }}
                                    </a>
                                </td>
                                {{-- <td>{{ $post->content }}</td> --}}
                                <td>{{ $post->created_at }}</td>
                                <td>{{ $post->last_reply->created_at ?? $post->created_at }}</td>
                                <td>{{ count($post->replies) }}</td>
                            </tr>
                            @endif
                            @endforeach
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
