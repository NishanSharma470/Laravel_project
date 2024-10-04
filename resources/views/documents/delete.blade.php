
    @section('content')
    <title>Delete Confirmation</title>
</head>
<body class="font-sans text-gray-900 antialiased">

  
    <form id="deleteForm" action="{{ route('documents.delete', $document) }}" method="POST" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="text-red-600 hover:underline ml-2" onclick="document.getElementById('deleteModal').style.display='block'">Delete</button>
    </form>

   
    <div id="deleteModal" style="display:none; position:fixed; top:0; left:0; width:100%; height:100%; background:rgba(0, 0, 0, 0.5); z-index:1000; justify-content:center; align-items:center;">
        <div style="background:white; padding:20px; border-radius:5px; text-align:center; width:300px; margin:auto;">
            <h2 class="text-xl font-bold text-gray-800">Confirm Deletion</h2>
            <p class="text-gray-600">Are you sure you want to delete this document?</p>
            <form action="{{ route('documents.delete', $document) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" style="background:red; color:white; padding:5px 10px; border:none; border-radius:3px;">Delete</button>
                <button type="button" onclick="document.getElementById('deleteModal').style.display='none';" style="margin-left:10px;">Cancel</button>
            </form>
        </div>
    </div>

</body>
@endsection

