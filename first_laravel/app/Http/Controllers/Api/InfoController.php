<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use Illuminate\Routing\Controller;
use App\Models\Info;
use App\Models\Transformers\FeedbackTransformer;
use App\Models\Transformers\InfoTransformer;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;

class InfoController extends Controller
{
    private Responder $responder;
    public function __construct(Responder $responder)
    {
        $this->responder = $responder;
    }
    public function index(): JsonResponse
    {
        return $this->responder
            ->success(Info::all(), InfoTransformer::class)->with(['image','feedbacks','last3feedbacks'])
            ->respond();

    }
    public function oneInfo(Info $info): JsonResponse
    {
        return $this->responder
            ->success($info, InfoTransformer::class)->with(['image','feedbacks','last3feedbacks'])
            ->respond();
    }
    public function feedback(Feedback $feedback): JsonResponse
    {
        return $this->responder
            ->success($feedback, FeedbackTransformer::class)->with(['info.image'])
            ->respond();
    }
    public function last3feedbacks(Info $info): JsonResponse
    {
        return $this->responder
            ->success($info->last3feedbacks, FeedbackTransformer::class)
            ->respond();
    }
}
