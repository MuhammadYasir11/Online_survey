<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;
use App\Models\User;
use App\Models\Option;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class QuestionController extends Controller
{
    public function create(Survey $survey, User $user)
    {
        // Initialize variables
        $survey_title = null;
        $survey_id = null;

        // Check if the survey title attribute exists in the $survey object
        if ($survey->survey_title) {
            $survey_title = $survey->survey_title;
            $survey_id = $survey->id;
        } elseif ($user->id) {
            // If survey title not found, try to retrieve survey ID based on user ID
            $survey = Survey::where('user_id', $user->id)->first();
            if ($survey) {
                $survey_title = $survey->survey_title;
                $survey_id = $survey->id;
            }
        } else {
            // If neither survey title nor user ID is found, return an error
            return redirect()->back()->with('error', 'Survey title not found');
        }
        // Retrieve questions related to the survey or user
        $questions = Question::where(function ($query) use ($survey_id, $user) {
            $query->where('survey_id', $survey_id);
            $query->orWhere('user_id', $user->id);
        })->get();
        $user = User::first();

        // Pass the survey, survey_title, and questions, user to the view
        return view('admin.Question.create', compact('survey', 'survey_title', 'questions', 'user'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required',
            'type' => 'required|in:mcq,text-box,radio,customRange',
        ]);
        // Additional validation rules for specific question types
        if ($request->input('type') == 'mcq') {
            $validator->sometimes('options', 'required|array|min:2', function ($input) {
                return $input->type == 'mcq';
            });
        } elseif ($request->input('type') == 'text-box') {
            $validator->sometimes('add_text', 'required|string', function ($input) {
                return $input->type == 'text-box';
            });
        } elseif ($request->input('type') == 'radio') {
            $validator->sometimes('radioOption', 'required|string', function ($input) {
                return $input->type == 'radioOption';
            });
        } elseif ($request->input('type') == 'customRange') {
            $validator->sometimes('min','max','mid', 'required|string', function ($input) {
                return $input->type == 'min';
                return $input->type == 'max';
                return $input->type == 'mid';
            });
        }

        if ($validator->passes()) {

            // Create a new Question instance
            $question = new Question();
            $question->question = $request->input('question');
            $question->question_type = $request->input('type');
            if ($request->input('type') == 'text-box') {
                $question->answer = $request->input('add_text');
            }
            $question->survey_id = $request->input('survey_id');
            $question->user_id = $request->input('user_id');
            $question->save();

            // Store data when question_type == mcq
            if ($request->input('type') == 'mcq') {
                // Save the options
                if ($request->has('options')) {
                    $options = $request->input('options');
                    foreach ($options as $optionText) {
                        // Create a new Option instance for each option
                        $option = new Option();
                        $option->option = $optionText; // Save the option text
                        $option->question_id = $question->id; // Associate option with question
                        $option->save();
                    }
                }
            }
            // Check if the question type requires additional checks (custom range)
            if ($request->input('type') == 'customRange') {
                // Ensure all necessary input fields are present
                if ($request->has('min') && $request->has('max') && $request->has('mid')) {
                    $min = $request->input('min');
                    $max = $request->input('max');
                    $mid = $request->input('mid');

                    // Create a new Option instance
                    $option = new Option();
                    // Assign min, max, and mid values to the corresponding attributes
                    $option->min = $min;
                    $option->max = $max;
                    $option->mid = $mid;
                    // Associate option with the question
                    $option->question_id = $question->id;
                    // Save the option
                    $option->save();
                } else {
                    return response()->json([
                        'status' => false,
                        'errors' => $validator->errors()
                    ]);
                }
            }
            // Store data when question_type == radio
            if ($request->input('type') == 'radio') {
                if ($request->has('radioOption')) {
                    $radioOption = $request->input('radioOption');
                    foreach ($radioOption as $option) {
                        // Create a new Option instance for each option
                        $newOption = new Option();
                        $newOption->option = $option;
                        $newOption->question_id = $question->id; // Associate option with question
                        $newOption->save();
                    }
                }
            }
            Session::flash('success', 'Survey Title added successfully');
            return response()->json([
                'status' => true,
                'message' => 'Survey Title added successfully '
            ]);
        } else {
            return response()->json([
                'status' => false,
                'errors' => $validator->errors()
            ]);
        }
    }


    public function show(Request $request, $surveyId, $surveyTitle)
    {
        // Retrieve questions related to the survey ID
        $questions = Question::where('survey_id', $surveyId)->get();
        return view('admin.Question.create', ['surveyTitle' => $surveyTitle, 'questions' => $questions]);
    }
}
