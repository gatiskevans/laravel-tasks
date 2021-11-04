<form action="{{ route('tasks.complete', $task) }}" method="post">
    @csrf

    <label for="{{ $task->id }}">Complete: </label>

    <input
        type="checkbox"
        name="checkbox[]"
        onChange="this.form.submit()"
        id="{{ $task->id }}"
        @if($task->completed_at) checked @endif
    />

</form>
