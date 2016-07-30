<?php

namespace App\Http\Controllers\Frontend\User;

use App\Repositories\Frontend\Access\User\UserRepositoryContract;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\Frontend\User\UpdateProfileRequest;

class ProfileController extends Controller
{
    /**
     * @return mixed
     */
    public function edit()
    {
        return view('frontend.user.profile.edit')
            ->withUser(access()->user());
    }

    /**
     * @param UserRepositoryContract $user
     * @param UpdateProfileRequest $request
     */
    public function update(UserRepositoryContract $user, UpdateProfileRequest $request)
    {
        $user->updateProfile(access()->id(), $request->all());
        return redirect()->route('frontend.user.dashboard')->withFlashSuccess(trans('strings.frontend.user.profile.profile_updated'));
    }
}
