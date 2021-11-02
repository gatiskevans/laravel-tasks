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
                    <b style="color: darkblue"><a href="{{ route('tasks.create') }}">CREATE NEW TASK</a></b><br/><br/>
                    @foreach($tasks as $task)
                        @if($task->status === 'Completed')
                            @include('tasks._statusCompleted', ['task' => $task])
                        @else
                            @include('tasks._statusInProgress', ['task' => $task])
                        @endif
                        <p><b style="color: blue"><a href="{{ route('tasks.edit', $task) }}">EDIT</a></b></p>
                        <form method="post" action="{{ route('tasks.destroy', $task) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="confirm('Are You Sure?')"><b style="color: red">DELETE</b></button>
                        </form><br/><br/>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
