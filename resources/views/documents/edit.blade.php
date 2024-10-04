@extends('layouts.app')

@section('content')
    <div class="container">
       

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

       
        <div class="flex justify-center py-6">
    <form action="{{ route('documents.update', $document->id) }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-lg shadow-md w-full max-w-lg">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="title" class="block text-sm font-medium text-gray-700">Title</label>
            <input type="text" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" id="title" name="title" value="{{ old('title', $document->title) }}" required>
        </div>

        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Description (Optional)</label>
            <textarea class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" id="description" name="description">{{ old('description', $document->description) }}</textarea>
        </div>

        <div class="mb-4">
            <label for="file" class="block text-sm font-medium text-gray-700">Upload New File (Optional)</label>
            <input type="file" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm" id="file" name="file">
            @if ($document->file_path)
                <p class="mt-2 text-sm text-gray-600"> <a href="{{ Storage::url($document->file_path) }}" target="_blank" class="text-blue-600 underline"></a></p>
            @endif
        </div>

        <div class="flex justify-between mt-4">
            <button type="submit" class="bg-blue-600 text-black py-2 px-4 rounded-md">Update Document</button>
            <a href="{{ route('documents.index') }}" class="bg-gray-300 text-gray-800 py-2 px-4 rounded-md">Cancel</a>
        </div>
    </form>
</div>

    </div>
@endsection
