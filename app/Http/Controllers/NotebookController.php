<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

class NotebookController extends Controller
{
    public function getNotes()
    {
        return response()->json(Note::get(), 200);
    }

    public function getNoteById($id){
        return response()->json(Note::find($id)->get(), 200);
    }
    public function addNote(Request $request)
    {
        // $fullName = isset($request->full_name) ? $request->full_name : null;
        // if($fullName == null)
        //     return response("There is no required data", 0);
        
        // $company = isset($request->company) ? $request->company : null;
        // $phoneNumber = isset($request->phone_number) ? $request->phone_number : null;
        // if($phoneNumber == null)
        //     return response("There is not required data", 0)->header("Content-type", "text/plain");

        // $email = isset($request->email) ? $request->email : null;
        // if($email == null)
        //     return response("There is no required data", 200)->header("Content-type", "text/plain");
        
        // $birthday = isset($request->birthday) ? $request->birthday : null;
        // $photo = isset($request->photo) ? $request->photo : null;

        // $note = new Note;
        // $note->full_name = $fullName;
        // $note->company = $company;
        // $note->phone_company = $phoneNumber;
        // $note->email = $email;
        // $note->birthday =  $birthday;
        // $note->photo = $photo;
        // $note->save();
        $newNote = Note::create($request->all()); 
        return response()->json($newNote, 201);
    }

}
