<?php

namespace App\Models\Transformers;

use App\Models\Info;
use Flugg\Responder\Transformers\Transformer;

class InfoTransformer extends Transformer{
    protected $relations = [
        'image' => ImageTransformer::class,
        'feedbacks' => FeedbackTransformer::class,
        'last3feedbacks' => FeedbackTransformer::class,
    ];

    public function transform(Info $model){
        return [
            "id" => $model->id,
            "first_name" => $model->first_name,
            "last_name" => $model->last_name,
            "birthday" => $model->birthday,
            "is_active" => (bool)$model->is_active,
            'averageRating' => $model->averageRating,
        ];
    }
}