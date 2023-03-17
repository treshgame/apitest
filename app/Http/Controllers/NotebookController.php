<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

use Validator;

class NotebookController extends Controller
{
    public function getNotes()
    {
        $notesList = Note::paginate();
        return response()->json($notesList, 200);
    }

    public function getNoteById($id){
        $note = Note::find($id);
        if(is_null($note))
            return response()->json(['message' => 'Record not found'], 404);
        return response()->json($note, 200);
    }
    public function addNote(Request $request)
    {
        $rules = [
            'full_name' => 'required|min:3|max:150',
            'phone_number' => 'required|min:11|max:15',
            'email' => 'email:rfc,dns|max:100',
            'birthday' => 'nullable|date'
        ];

        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return response()->json($validator->errors(), 400);
        
        $newNote = Note::create($request->all()); 
        return response()->json($newNote, 201);
    }
    
    public function updateNote(Request $request, $id){
        $note = Note::find($id);
        if(is_null($note))
            return response()->json(['message' => 'Record not found'], 404);

        $rules = [
            'full_name' => 'required|min:3|max:150',
            'phone_number' => 'required|min:11|max:15',
            'email' => 'email:rfc,dns|max:100',
            'birthday' => 'nullable|date'
        ];
        $validator = Validator::make($request->all(), $rules);
        if($validator->fails())
            return response()->json($validator->errors(), 400);

        $note->update($request->all());
        return response()->json($note,200);
    }
    
    public function deleteNote(Request $request, $id){
        $note = Note::find($id);
        if(is_null($note))
            return response()->json(['message' => 'Record not found'], 404);

        $note->delete();
        return response()->json(null, 204);
    }
}
