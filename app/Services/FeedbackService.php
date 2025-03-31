<?php
namespace App\Services;

use App\Http\Requests\Feedback\StoreFeedbackRequest;
use App\Http\Requests\Feedback\UpdateFeedbackRequest;
use App\Http\Resources\Feedback\FeedbackAdminResource;
use App\Http\Resources\Feedback\FeedbackUserResource;
use App\Models\Feedback;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class FeedbackService {
    public function create(StoreFeedbackRequest $request)
    {
        $data = $request->validated();
        $data[Feedback::USER_ID] = Auth::id();
        return new FeedbackUserResource(Feedback::create($data));
    }

    public function update(UpdateFeedbackRequest $request, Feedback $existingFeedback)
    {
        if (! Gate::allows('update', $existingFeedback)) {
            throw new AuthorizationException('Only admins can update feedbacks.');
        }

        if (! Gate::allows('isEditable', $existingFeedback)) {
            throw new AuthorizationException('This feedback has already been acknowledged and cannot be updated.');
        }

        $data = $request->validated();
        $data[Feedback::ACKNOWLEDGED] = true;
        $existingFeedback->update($data);
        return new FeedbackAdminResource($existingFeedback);
    }

    public function all()
    {
        if(Auth::user()->isAdmin()){
            return FeedbackAdminResource::collection(Feedback::all());
        } else {
            return FeedbackUserResource::collection(Feedback::where(Feedback::USER_ID, Auth::id())->get());
        }
    }

    public function get(Feedback $feedback)
    {
        Gate::authorize('view', $feedback);
        return new FeedbackAdminResource($feedback);
    }
}
