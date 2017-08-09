<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exercise as ExerciseModel;
use App\StudentWork as SolutionModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ExercisesController extends Controller
{
    public function uploadIndex(){
        return view('upload');
    }
    
    public function fileName($name){
        $date = date('YmdHis');
        return $date.'-'.$name;
    }
    
    public function add(Request $request){
        $this->validate($request, array(
            'name' => 'required',
            'file' => 'required|max:10000'
        ));
        $file = $request->file('file');
        if ($file->extension() != 'txt')
            return redirect('upload')->with('error', 'Wrong file type');
        $path = $file->storeAs('exercises', $this->fileName($file->getClientOriginalName()));
        ExerciseModel::insert(array(
            'title' => $request->input('name'),
            'created_by' => Auth::user()->id,
            'url' => $path
        ));
        return redirect()->back()->with('status', 'Uploaded!');
    }
    
    public function download($id){
        $exercise = ExerciseModel::where('id','=',$id)->get();
        if (count($exercise) == 0){
            abort(404);
        }
        return response()->download(storage_path('app/'.$exercise[0]->url));
    }
    
    public function index(){
        $exercises = ExerciseModel::all();
        return view('exercises-list', ['exercises' => $exercises]);
    }
    
    public function delete($id){
        $solutions = SolutionModel::where('exercise_id', '=', $id)->get();
        foreach ($solutions as $solution)
            File::delete(storage_path('app/'.$solution->url));
        SolutionModel::where('exercise_id','=',$id)->delete();
        $exercise = ExerciseModel::where('id', '=', $id)->get();
        File::delete(storage_path('app/'.$exercise[0]->url));
        $count = ExerciseModel::where('id','=', $id)->delete();
        if ($count == 1)
            return redirect()->route('listExercises')->with('status', 'Exercise Deleted');
        else {
            abort(404);
        }
    }
    
    public function downloadSolution($id){
        $solution = SolutionModel::where('id','=',$id)->get();
        if (count($solution) == 0){
            abort(404);
        }
        return response()->download(storage_path('app/'.$solution[0]->url));
    }
    
    public function studentUpload(Request $request, $id){
        $this->validate($request, array(
            'file' => 'required|max:10000'
        ));
        $file = $request->file('file');
        if ($file->extension() != 'txt')
            return redirect('exercises-list')->with('error', 'Wrong file type');
        $path = $file->storeAs('solutions', $this->fileName($file->getClientOriginalName()));
        $count = SolutionModel::insert(array(
            'note' => $request->input('note'),
            'url' => $path,
            'exercise_id' => $id,
            'created_by' => Auth::user()->id,
        ));
        if ($count == 1)
            return redirect()->route('listExercises')->with('status', 'Uploaded');
        else {
            return redirect()->route('listExercises')->with('error', 'Error upload file');
        }
    }
}
