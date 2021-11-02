<div class="py-4 px-8">

    <div class="mb-4">
        <label for="title" class="block text-grey-darker text-sm font-bold mb-2">Title</label>
        <input class=" border rounded w-full py-2 px-3 text-grey-darker" type="text"
               name="title" id="title" value="{{ old('title', $task->title ?? '') }}">
        @error('title')
            <p style="color: red">{{ $message }}</p>
        @enderror
    </div>


    <div class="mb-4">
        <label class="block text-grey-darker text-sm font-bold mb-2">Content</label>
        <textarea class=" border rounded w-full py-2 px-3 text-grey-darker" name="content">{{ old('content', $task->content ?? '') }}</textarea>
        @error('content')
            <p style="color: red">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <label for="status" class="block text-grey-darker text-sm font-bold mb-2">Status</label>
        <select class=" border rounded w-full py-2 px-3 text-grey-darker" type="text"
                name="status" id="status">
            <option>In Progress</option>
            <option>Completed</option>
        </select>
        @error('status')
            <p style="color: red">{{ $message }}</p>
        @enderror
    </div>

    <div class="mb-4">
        <button
            class="mb-2 mx-16 rounded-full py-1 px-24 bg-gradient-to-r from-green-400 to-blue-500 ">
            {{ $task->exists ? 'Save' : 'Create' }}
        </button>
    </div>
</div>
