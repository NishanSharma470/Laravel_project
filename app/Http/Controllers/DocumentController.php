<?php

namespace App\Http\Controllers;

use App\Models\Document; 
use Illuminate\Http\Request;
use App\Http\Requests\StoreDocumentRequest;
use Illuminate\Support\Facades\Storage;

class DocumentController extends Controller
{

    
   
    public function index()
    {
        $documents = Document::all(); 
        return view('documents.index', compact('documents')); 
    }

    
    public function create()
    {
        return view('documents.create');
    }

    public function store(StoreDocumentRequest $request)
    {
       
        $filePath = $request->file('file')->store('documents');

        Document::create([
            'title' => $request->title,
            'description' => $request->description,
            'file_path' => $filePath, 
        ]);

        return redirect()->route('documents.index')->with('success', 'Document uploaded successfully!'); 
    }

    
    public function edit(Document $document)
    {
        return view('documents.edit', compact('document')); 
    }

 
    public function update(Request $request, Document $document)
    {

        $document->title = $request->title;
        $document->description = $request->description;

       
        if ($request->hasFile('file')) {
           
            if ($document->file_path) {
                Storage::delete($document->file_path);
            }          
            $document->file_path = $request->file('file')->store('documents');
        }
        $document->save();

        return redirect()->route('documents.index')->with('success', ' Your Document successfully updated'); 
    }

    public function delete(Document $document)
    {
        
        if ($document->file_path) {
            Storage::delete($document->file_path);
        }

        $document->delete(); 
        return redirect()->route('documents.index')->with('success', 'Document successfully removed from the dataset'); 
    }
}
