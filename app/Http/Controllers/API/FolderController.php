<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\Folder\StoreFolderRequest;
use App\Http\Requests\API\Folder\UpdateFolderRequest;
use App\Models\Folder;
use App\Transformers\FolderTransformer;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class FolderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->only('store', 'index');
    }

    public function index(): JsonResponse
    {
        $folders = Auth::user()->folders()->paginate(10);

        return responder()->success($folders, FolderTransformer::class)->meta(['message' => 'All Folders!'])->respond(201);
    }

    public function store(StoreFolderRequest $request): JsonResponse
    {
        $folder = Folder::create($request->validated());

        return responder()->success($folder, FolderTransformer::class)->meta(['message' => 'Folder Created successfully!'])->respond(201);
    }
}
