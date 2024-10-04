@extends('layouts.app')
@section('content')
<div class="container mx-auto">
   

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 mb-4">
            {{ session('success') }}
        </div>
    @endif
    @can('upload documents')
    <div class="flex justify-center py-6">
    <a href="{{ route('documents.create') }}" class="bg-blue-600 text-black py-2 px-4 rounded-md mb-4 inline-block">Upload New Document</a>
     </div> 
    @endcan
    <div class="flex justify-center py-6">
    <table class="min-w-full bg-white border border-gray-300 shadow-lg rounded-lg overflow-hidden">
        <thead>
            <tr class="bg-gray-200">
                <th class="py-2 px-4 border-b text-left">Title</th>
                <th class="py-2 px-4 border-b text-left">Description</th>
                <th class="py-2 px-4 border-b text-left">File Path</th>
                <th class="py-2 px-4 border-b text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($documents as $document)
                <tr class="hover:bg-gray-100">
                    <td class="py-2 px-4 border-b">{{ $document->title }}</td>
                    <td class="py-2 px-4 border-b">{{ $document->description }}</td>
                    <td class="py-2 px-4 border-b">{{ $document->file_path }}</td>
                    @can('edit documents')
                    <td class="py-2 px-4 border-b">
                        <a href="{{ route('documents.edit', $document) }}" class="text-blue-600 hover:underline">Update</a>
                        <form action="{{ route('documents.delete', $document) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-600 hover:underline ml-2">Delete</button>
                        </form>
                    @endcan
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

</div>
@endsection