<?php

namespace App\Transformers;

use App\Models\Folder;
use App\Transformers\UserTransformer;
use Flugg\Responder\Transformers\Transformer;

class FolderTransformer extends Transformer
{
    /**
     * List of available relations.
     *
     * @var string[]
     */
    protected $relations = [
        'user' => UserTransformer::class,
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
     * @param  \App\Models\Folder  $folder
     * @return array
     */
    public function transform(Folder $folder)
    {
        return [
            'id' => $folder->id,
            'name' => $folder->getName(),
        ];
    }
}
