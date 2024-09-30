<?php

namespace App\Http\Controllers\Api;

use App\Models\Feedback;
use Illuminate\Routing\Controller;
use App\Models\Info;
use App\Models\Transformers\FeedbackTransformer;
use App\Models\Transformers\InfoTransformer;
use Flugg\Responder\Responder;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            ->success(Info::all(), InfoTransformer::class)->with(['image', 'feedbacks', 'last3feedbacks'])
            ->respond();
    }
    public function oneInfo(Info $info): JsonResponse
    {
        return $this->responder
            ->success($info, InfoTransformer::class)->with(['image', 'feedbacks', 'last3feedbacks'])
            ->respond();
    }
    public function feedbacks(Info $info): JsonResponse
    {
        return $this->responder
            ->success($info->feedbacks, FeedbackTransformer::class)->with(['info'])
            ->respond();
    }
    public function last3feedbacks(Info $info): JsonResponse
    {
        return $this->responder
            ->success($info->last3feedbacks, FeedbackTransformer::class)
            ->respond();
    }
    public function saveFeedback(Info $info, Request $request)
    {
        $feedback = new Feedback(["rating"=>$request['rating'],"comment"=>$request['comment']]);
        $info->feedbacks()->save($feedback);
        // $info->feedbacks()->save($feedback);
        return $this->responder->success($feedback, FeedbackTransformer::class)->respond();
    }
}
