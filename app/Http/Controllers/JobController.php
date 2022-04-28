<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Job;
use App\Models\Comment;
use App\Models\Company;
use App\Models\Favorite;
use App\Models\User;
use Auth;
use Illuminate\Support\Facades\Gate;

class JobController extends Controller
{
    public function index() {
        $jobs = Job::with(['company'])->orderBy('created_at', 'desc')->get();

        

        return view('jobs.index', [
            'jobs' => $jobs,
        ]);
     }

     public function comment($id) {
         $job = Job::where('id', '=', $id)->first();
         $comments = Comment::with(['user'])->where('job_id', '=', $id)->orderBy('created_at', 'desc')->get();

         return view('jobs.comment', [
             'job' => $job,
             'comments' => $comments,
         ]);
     } 
    

    public function add() {
        $jobs = Job::with(['company'])->get();
        $companies = Company::all();
        
        return view('jobs.add', [
            'jobs' => $jobs,
            'companies' => $companies,
        ]);
    }

    public function create(Request $request) {
        $request->validate([
            'company' => 'required:min:2',
            'role' => 'required:min:2',
            'location' => 'required:min:2',
            'salary' => 'required:min:1',
        ]);

        $jobs = new Job();
        $jobs->body = $request->input('role');
        $jobs->company_id = $request->input('company');
        $jobs->salary = $request->input('salary');
        $jobs->user_id = Auth::id();
        $jobs->location = $request->input('location');


        $jobs-> save();

        return redirect()
        //->route('questions.more', ['id' => $question->id])
        ->route('jobs.index')
        ->with('success', "Your job '{$request->input('role')}' was succesfully posted.");
    }

    public function create_comment($id, Request $request) {
        $request->validate([
            'comment' => 'required|min:5',
        ]);

         $comment = new Comment();
         
         $comment->body = $request->input('comment');
         $comment->job_id = $id;
         $comment->user_id = Auth::id();
         $comment->save();

         return redirect()
                ->route('jobs.comment', ['id' => $id])
                ->with('success', "Your answer '{$request->input('comment')}' was succesfully posted.");
    }

    public function edit($id) {
        $job = Job::where('id', '=', $id)->first();
        $companies = Company::all();

        return view('jobs.edit', [
            'job' => $job,
            'companies' => $companies,
        ]);
    }

    public function update($id, Request $request) {
        $request->validate([
            'company' => 'required:min:2',
            'role' => 'required:min:2',
            'location' => 'required:min:2',
            'salary' => 'required:min:1',
        ]);

        $job = Job::where('id', '=', $id)->first();
        $job->body = $request->input('role');
        $job->salary = $request->input('salary');
        $job->location = $request->input('location');
        $job->user_id = Auth::id();

        $job->save();

        return redirect()
        ->route('jobs.index')
        ->with('success', "Your job was succesfully updated.");

    }

    public function add_favorite($id) {
        $favorite = Favorite::where(['job_id' => $id, 
        'user_id' => Auth::id()])
        ->first();

        if ($favorite === null) {
            $n_favorite = new Favorite();
            $n_favorite->job_id = $id;
            $n_favorite->user_id = Auth::id();
            $n_favorite->save();
            return redirect()->route('profile.index')->with('success', "Sucessfully added to your favorites.");
           
        }
        else {
            return redirect()->route('jobs.index')->with('error', 'This job is already in your favorites.');
        }
      
    }

    public function remove_favorite($id){

        $favorite = Favorite::where(['job_id' => $id, 
        'user_id' => Auth::id()])
        ->first();

        $favorite-> delete();

        return redirect()
        ->route('profile.index')
        ->with('success', "You've succesfully deleted this job from your favorites.");

    }

    public function edit_comment($id) {
        $comment = Comment::where(['id' => $id])->first();
        
        if (Gate::allows('edit_comment', $comment)) {
            return view('jobs.edit_comment', [
                'comment' => $comment,
            ]);
        }
        else {
            abort(403);
        }

        
    }

    public function update_comment($id, Request $request) {
        $request->validate([
            'comment' => 'required:min:2',
        ]);

        $comment = Comment::with(['job'])->where(['id' => $id])->first();
        $comment->body = $request->input('comment');
        $comment->save();

        return redirect()
        ->route('jobs.comment', ['id' => $comment->job])
        ->with('success', "You've succesfully updated this comment.");
    }

    public function delete_comment($id) {

       

        $comment = Comment::with(['job'])->where(['id' => $id])->first();
        $comment->delete();

        return redirect()
        ->route('jobs.comment', ['id' => $comment->job])
        ->with('success', "You've succesfully deleted this comment.");

        if (Gate::denies('delete_comment', $comment)) {
            abort(403);
        }
    }
}

