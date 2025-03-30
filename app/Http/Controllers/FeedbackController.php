<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Feedback\StoreFeedbackRequest;
use App\Http\Requests\Feedback\UpdateFeedbackRequest;
use App\Models\Feedback;
use App\Services\FeedbackService;

class FeedbackController extends Controller
{
    protected FeedbackService $feedbackService;

    public function __construct(FeedbackService $feedbackService) {
        $this->feedbackService = $feedbackService;
    }

    public function index()
    {
        $feedbacks = $this->feedbackService->all();
        return $feedbacks;
    }

    public function store(StoreFeedbackRequest $request)
    {
        $createdFeedbackResponse = $this->feedbackService->create($request);
        return $createdFeedbackResponse;
    }

    public function show(Feedback $feedback)
    {
        return $this->feedbackService->get($feedback);
    }

    public function update(UpdateFeedbackRequest $request, Feedback $feedback)
    {
        $updatedFeedbackResponse = $this->feedbackService->update($request, $feedback);
        return $updatedFeedbackResponse;
    }
}
