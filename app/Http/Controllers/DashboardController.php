<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document; 
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function show()
    {
        $user = Auth::user();
        

        if ($user->usertype === 'internal') {
            return redirect()->route('documents.index');
        } elseif ($user->usertype === 'external') {
            return redirect()->route('documents.index');
        }

        return abort(403); 
    }

    public function internalPage()
    {
        $user = Auth::user(); 
        $documents = Document::all(); 
        return view('documents.index',compact('user','documents')); 
    }

    public function externalPage()
    {
        $user = Auth::user(); 
        $documents = Document::all();
        return view('documents.index',compact('user','documents')); 
}
}
