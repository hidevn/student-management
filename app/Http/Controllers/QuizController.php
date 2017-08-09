<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Quiz as QuizModel;
use Storage;
use Illuminate\Support\Facades\File;

class QuizController extends Controller
{
    public function uploadQuiz(Request $request){
        $this->validate($request, array(
            'hint' => 'required',
            'file' => 'required|max:10000'
        ));
        $file = $request->file('file');
        if ($file->extension() != 'txt')
            return redirect('indexQuiz')->with('error', 'Wrong file type');
        File::deleteDirectory(storage_path('app/quiz'));
        $path = $file->storeAs('quiz', $file->getClientOriginalName());
        $count = QuizModel::where('id', '=', 1)->update(array(
            'hint' => $request->input('hint'),
        ));
        if ($count == 1)
            return redirect()->route('indexQuiz')->with('status', 'Updated');
        else
            return redirect()->route('indexQuiz')->with('error', 'Error');
    }
    
    public function index(){
        return view('quiz');
    }
    
    public function indexAnswer(){
        $quiz = QuizModel::where('id', '=', 1)->get();
        return view('answerQuiz', ['quiz' => $quiz[0]]);
    }
    
    public function uploadAnswer(Request $request){
        $this->validate($request, array(
            'answer' => 'required'    
        ));
        $files = File::files(storage_path('app/quiz'));
        $file_name = basename($files[0]);
        if (strtolower($request->input('answer')) == strtolower($file_name) || strtolower($request->input('answer').'.txt') == strtolower($file_name))
            return redirect()->route('answerQuiz')->with('status', File::get($files[0]));
        else
            return redirect()->route('answerQuiz')->with('error', 'Wrong!');
    }
}
