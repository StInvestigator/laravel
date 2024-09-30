<?php

namespace App\Models\Transformers;

use App\Models\Feedback;
use Flugg\Responder\Transformers\Transformer;

class FeedbackTransformer extends Transformer{
    protected $relations = [
        'info' => InfoTransformer::class
    ];

    public function transform(Feedback $model){
              return [
                "rating" => $model->rating,
                "comment" => $model->comment,
                "created_at"=>$model->created_at->toDateTimeString(),
            ];
    }
}