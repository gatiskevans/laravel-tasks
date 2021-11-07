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

                    @if( !$tasks->isEmpty() )
                        @foreach($tasks as $task)

                            <form action="{{ route('tasks.deleteTask', $task) }}" method="post">
                                @csrf
                                @method('DELETE')

                                <div style="font-weight: bold;">
                                    {{ $task->title }}
                                    - Deleted at: {{ $task->deleted_at }}
                                </div>

                                <button type="submit" onclick="return confirm('Are You Sure?')"><b
                                        style="color: red">Delete For Good</b></button>
                            </form>

                            <form action="{{ route('tasks.restoreTask', $task) }}" method="get">
                                @csrf
                                <button type="submit" onclick="return confirm('Are You Sure?')"><b
                                        style="color: green">Restore</b></button>
                            </form>
                            <br/>

                        @endforeach
                    @else

                        <h2 style="font-weight: bold">Trash is Empty</h2>

                    @endif

                </div>
            </div>
        </div>
    </div>
</x-app-layout>
