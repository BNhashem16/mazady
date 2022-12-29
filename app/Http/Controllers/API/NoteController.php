<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Note\StoreNoteRequest;
use App\Models\Note;
use App\Transformers\NoteTransformer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class NoteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth.optional:api')->only('index');
        $this->middleware('auth:api')->only('store');
    }

    public function index()
    {
        $note = Note::query();

        if (Auth::guard('api')->check()) {
            $note->whereHas('folder', function ($query) {
                $query->where('user_id', Auth::guard('api')->id());
            });
        }

        if (! Auth::guard('api')->check()) {
            $note->where('type', Note::PUBLIC_TYPE);
        }

        $note = $note->paginate();

        return responder()->success($note, NoteTransformer::class)->meta(['message' => 'Notes!'])->respond(200);
    }

    public function store(StoreNoteRequest $request)
    {
        $note = Note::create($request->validated());

        return responder()->success($note, NoteTransformer::class)->meta(['message' => 'Note Created successfully!'])->respond(201);
    }

    public function generatePDF(Request $request)
    {
        $note = Note::where('id', $request->note_id)->firstOrFail();
        $path = 'document-'.$note->id.'.pdf';
        $pdf = Pdf::loadView('pdf', ['note' => $note])->save($path);

        return responder()->success()->meta([
            'link' => url($path),
            'message' => 'PDF Created successfully!', ])->respond(200);
    }
}
