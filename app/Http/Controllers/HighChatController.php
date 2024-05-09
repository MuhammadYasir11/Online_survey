<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HighChatController extends Controller
{
    public function handleChart()
    {
        $questionData = Question::select('question_type')->get();
        $optionData = Option::select('option')->get();
      return view('admin.Chart', compact('questionData','optionData'));
    }
}
