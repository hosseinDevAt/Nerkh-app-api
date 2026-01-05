<?php

namespace App\Http\Controllers;

use App\Services\AnalysisService;
use Illuminate\Http\JsonResponse;

class GoldController extends Controller
{
    protected AnalysisService $analysisService;

    public function __construct(AnalysisService $service)
    {
        $this->analysisService = $service;
    }

    public function getAnalysis(): JsonResponse
    {
        // لیست مواردی که تحلیل میشوند
        $targets = ['طلای 18 عیار', 'طلای 24 عیار', 'سکه امامی'];

        $finalResult = [];

        foreach ($targets as $target) {
            $finalResult[$target] = $this->analysisService->getPrediction($target);
        }

        return response()->json([
            'status' => 'success',
            'data' => $finalResult
        ]);
    }
}
