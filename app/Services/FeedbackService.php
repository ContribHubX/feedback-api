<?php

use App\Http\Requests\Feedback\StoreFeedbackRequest;
use App\Http\Requests\Feedback\UpdateFeedbackRequest;
use App\Models\Feedback;
use Illuminate\Support\Facades\Auth;

class FeedbackService {
    public function create(StoreFeedbackRequest $request)
    {
        $data = $request->validated();
        $data[Feedback::USER_ID] = Auth::id();
        return Feedback::create($data);
    }

    public function update(UpdateFeedbackRequest $request, Feedback $existingFeedback){
        $data = $request->validated();
        $data[Feedback::ACKNOWLEDGED] = true;
        $existingFeedback->update($data);
        return $existingFeedback;
    }

    public function all(){
        $currentUser = Auth::user();
        if($currentUser->isAdmin()){
            return Feedback::all();
        } else {
            return Feedback::where(Feedback::USER_ID, Auth::id())->get();
        }
    }

    public function get(Feedback $feedback)
    {
        return $feedback;
    }
}
