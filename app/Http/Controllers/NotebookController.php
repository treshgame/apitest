<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;

use Validator;

class NotebookController extends Controller
{
    /**
     * Show Notes
     * @OA\Get(
     *     path="/notebook",
     *     tags={"Notes"},
     *     summary="Get list of notes",
     *     @OA\Response(
     *         response=200,
     *         description="successful operation",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="full_name", type="string", example="Sergeev Vladimir"),
     *             @OA\Property(property="company", type="string", example="myRich company"),
     *             @OA\property(property="phone_number", type="stringg", example="88005553535"),
     *             @OA\Property(property="email", type="string", example="bigcompany@gmail.com"),
     *             @OA\Property(property="birthday", type="string", example="8.10.2002"),
     *             @OA\Property(property="photo", type="string", example="AnyBlobData")
     *         )
     *     )
     * )
     */
    public function getNotes()
    {
        $notesList = Note::paginate();
        return response()->json($notesList, 200);
    }

    /**
     * Show Note by ID
     * @OA\Get(
     *     path="/notebook/{id}",
     *     summary="Get note by the id",
     *     tags={"Notes"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number"
     *                     )  
     *                 ),
     *                 example={
     *                     "id":23
     *                 }
     *            )
     *             
     *         )
     *     ),
     *     @OA\Response(
     *         response="200",
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="number", example="1"),
     *             @OA\Property(property="full_name", type="string", example="Sergeev Vladimir"),
     *             @OA\Property(property="company", type="string", example="myRich company"),
     *             @OA\property(property="phone_number", type="stringg", example="88005553535"),
     *             @OA\Property(property="email", type="string", example="bigcompany@gmail.com"),
     *             @OA\Property(property="birthday", type="string", example="8.10.2002"),
     *             @OA\Property(property="photo", type="string", example="AnyBlobData")
     *         )
     *     )
     * )
     */
    public function getNoteById($id){
        $note = Note::find($id);
        if(is_null($note))
            return response()->json(['message' => 'Record not found'], 404);
        return response()->json($note, 200);
    }
    /**
     * Create Notes
     * @OA\Post(
     *     path="/notebook",
     *     tags={"Notes"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number"
     *                     )  
     *                 ),
     *                 example={
     *                     "id":1
     *                 }
     *            )
     *             
     *         )
     *     ),
     *     @OA\Response(
     *         response="201",
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="number", example=1),
     *             @OA\Property(property="full_name", type="string", example="Sergeev Vladimir"),
     *             @OA\Property(property="company", type="string", example="myRich company"),
     *             @OA\property(property="phone_number", type="stringg", example="88005553535"),
     *             @OA\Property(property="email", type="string", example="bigcompany@gmail.com"),
     *             @OA\Property(property="birthday", type="string", example="8.10.2002"),
     *             @OA\Property(property="photo", type="string", example="AnyBlobData")
     *         )
     *     ),
     *       @OA\Response(
     *         response="400",
     *         description="validation failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Validation failed")
     *         )
     *     )
     * )
     */
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
    /**
     * Update Note
     * @OA\Put(
     *     path="/notebook",
     *     tags={"Notes"},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     type="object",
     *                     @OA\Property(
     *                         property="id",
     *                         type="number"
     *                     )
     *                 ),
     *                 example={
     *                     "id":1
     *                 }
     *            )
     *             
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="success",
     *         @OA\JsonContent(
     *             @OA\Property(property="note", type="string", example="{id = 1, full_name=FIO, company=null, phone_number=+79999999999, emil=email.@na.na}")
     *         )
     *     ),
     *     @OA\Response(
     *         response=400,
     *         description="validation failed",
     *         @OA\JsonContent(
     *             @OA\Property(property="message", type="string", example="Validation failed")
     *         )
     *     )
     * )
     */
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
    /**  
     *   Delete Note
     *   @OA\Delete(
     *     path="/notebook/{id}",
     *     tags={"Notes"},
     *     @OA\Property(
     *         property="id",
     *         type="integer",
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="successful operation"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Record not found"
     *     )
     * )
     */
    public function deleteNote(Request $request, $id){
        $note = Note::find($id);
        if(is_null($note))
            return response()->json(['message' => 'Record not found'], 404);

        $note->delete();
        return response()->json(null, 204);
    }
}
