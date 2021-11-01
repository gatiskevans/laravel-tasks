<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Tasks') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <a href="{{ route('tasks.create') }}">Create new task</a>
                    @foreach($tasks as $task)
                        <h3>{{ $task->title }}</h3>
                        <p>{{ $task->content }}</p>
                        <p>{{ $task->status }}</p>
                        <p><a href="{{ route('tasks.edit', $task) }}">EDIT</a></p>
                        <form method="post" action="{{ route('tasks.destroy', $task) }}"></p>
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirm('Are You Sure?')">DELETE</button>
                        </form>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
