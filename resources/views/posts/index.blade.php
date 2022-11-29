<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 overflow-x-auto">
                    <table class="table table-zebra w-full">
                        <thead>
                            <tr>
                                <th>Board</th>
                                <th>Title</th>
                                {{-- <th>Content</th> --}}
                                <th>Created At</th>
                                <th>Last Posted At</th>
                                <th>Replies</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($posts as $post)
                                <tr x-data class="hover">
                                    <td>
                                        <a :style="{ backgroundColor: uniqolor('{{ $post->board->name }}', {lightness: 25}).color}" class="link badge p-3" href="{{ route('boards.show', $post->board->id) }}">
                                            {{ $post->board->name }}
                                        </a>
                                    </td>
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
                            @endforeach
                        <tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
