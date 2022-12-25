<?php

namespace App\Transformers;

use App\Models\Note;
use Flugg\Responder\Transformers\Transformer;

class NoteTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'user' => UserTransformer::class,
        'folder' => FolderTransformer::class,
    ];

    /**
     * List of autoloaded default relations.
     *
     * @var array
     */
    protected $load = [];

    /**
     * Transform the model.
     *
     * @param  \App\Models\Note  $note
     * @return array
     */
    public function transform(Note $note)
    {
        return [
            'id' => $note->id,
            'name' => $note->getName(),
            'content' => $note->getContent(),
            'type' => $note->getType(),
        ];
    }
}
