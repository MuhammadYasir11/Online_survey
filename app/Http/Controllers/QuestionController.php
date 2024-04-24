<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Survey;
use App\Models\Question;

class QuestionController extends Controller
{
    public function create(Survey $survey)
{
    // Check if the survey title attribute exists in the $survey object
    if ($survey->survey_title) {
        $survey_title = $survey->survey_title;
        
    } else {
        dd('Survey title not found');
    }
    
    // Pass the survey and survey_title to the view
    return view('admin.Question.create', compact('survey', 'survey_title'));
}

    
    


    public function store(Request $request, Survey $survey)
    {
        $request->validate([
            'type' => 'required|in:mcq,text', // Adjusted validation rule
            
            
        ]);

        $options = [
            $request->input('txtoption'),
            $request->input('txtoption1'),
        ];
    
        $question = new Question([
            'type' => $request->input('type'),
            'text' => $request->input('text'), // Corrected field name from 'text' to 'question'
            'options' => $options,
        ]);

        $survey->questions()->save($question);

        return redirect()->route('questions.create', $survey)->with('success', 'Question added successfully!');
    }

    public function show(Request $request, $surveyId, $surveyTitle)
    {
        // Retrieve questions related to the survey ID
        $questions = Question::where('survey_id', $surveyId)->get();

        // Pass the survey title and questions to the view
        return view('admin.Question.create', ['surveyTitle' => $surveyTitle, 'questions' => $questions]);
    }
}
