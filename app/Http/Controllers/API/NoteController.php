<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Note\StoreNoteRequest;
use App\Models\Note;
use App\Transformers\NoteTransformer;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store', 'index');
    }
    
    public function store(StoreNoteRequest $request)
    {
        $note = Note::create($request->validated());
        
        return responder()->success($note, NoteTransformer::class)->meta(['message' => 'Note Created successfully!'])->respond(201);
    }

}
