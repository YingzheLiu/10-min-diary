<?php

namespace App\Rules;

use App\Models\Diary;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Contracts\Validation\Rule;

class HasntPostToday implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return Diary::where('user_id', Auth::user()->id)
            ->wheredate('created_at', '=', Carbon::today('America/Los_Angeles'))
            ->count() === 0;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'You have posted a diary today. Edit that one or come back tomorrow!';
    }
}
