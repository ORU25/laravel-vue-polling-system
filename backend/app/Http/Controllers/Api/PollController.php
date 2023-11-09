<?php

namespace App\Http\Controllers\Api;

use App\Models\Option;
use App\Models\Poll;
use App\Models\Vote;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PollController extends Controller
{
    public function index(){
        $polls = Poll::all();
        $data = $polls->map(function($poll){
            $totalVote = Vote::where('poll_id',$poll->id)->groupBy('poll_id')->selectRaw('poll_id, count(*) as total_vote')->first();

            return [
                // 'user' => Auth::user()->id,
                'id' => $poll->id,
                'total_vote' => $totalVote ? $totalVote->total_vote : 0,
                'question' => $poll->question,
                'options' => $poll->option->map(function($option) use ($poll) { 
                    $vote = Vote::where('option_id',$option->id)->count();      
                    return [
                        'id' => $option->id,
                        'option' => $option->option,
                        'vote' => $vote
                    ];
                })
            ];
            // $options = Vote::where('poll_id',$poll->id)->groupBy('option_id')->selectRaw('option_id, count(*) as vote')->get();
        });
        return response()->json($data);
    }

    public function poll(Request $req, $poll_id){
        $poll = Poll::findOrFail($poll_id);
        $data = [
            'id' => $poll->id,
            'question' => $poll->question,
            'options' => $poll->option->map(function($option){
                return [
                    'id' => $option->id,
                    'option' => $option->option,
                ];
            })
        ];

        return response()->json($data);
    }



    public function vote(Request $req){
        try {
            $vote = new Vote();
            $vote->poll_id = $req->input('poll_id');
            $vote->option_id = $req->input('option_id');
            $vote->user_id = Auth::user()->id;
            $vote->save();
        } catch (\Throwable $th) {
            return response()->json($th);
        }
        return response()->json('success');
        
    }

    public function pollCreate(Request $r){
        $r->validate([
            'question' => ['required']
        ]);

        try {
            $poll = new Poll;
            $poll->user_id = Auth::user()->id;
            $poll->question = $r->input('question');
            $poll->save();

            return response([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            throw $th;
            return response([
                'success' => false,
            ]);
        }
    }

    public function optionCreate(Request $r, $id){
        try {
            $option = new Option;
            $option->poll_id = $id;
            $option->option = $r->input('option');
            $option->save();
            return response([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            throw $th;
            return response([
                'success' => false,
            ]);
        }
    }

    public function pollEdit(Request $r, $id){
        try {
            $poll = Poll::find($id);
            $poll->question = $r->input('question');
            $poll->save();
            return response([
                'success' => true,
            ]);
        } catch (\Throwable $th) {
            throw $th;
            return response([
                'success' => false,
            ]);
        }
    }

    public function optionEdit(Request $r,$id){
        try {
            $option = Option::find($id);
            $option->option = $r->input('option');
            $option->save();
            return response([
                'success' => true,
            ]);

        } catch (\Throwable $th) {
            throw $th;
            return response([
                'success' => false,
            ]);
        }
    }

    public function pollDelete($id){
        try {
            $poll = Poll::find($id);
            $poll->delete();
            return response([
                'success' => true,
            ]);

        } catch (\Throwable $th) {
            throw $th;
            return response([
                'success' => false,
            ]);
        }
    }

    public function OptionDelete($id){
        try {
            $option = Option::find($id);
            $option->delete();
            return response([
                'success' => true,
            ]);

        } catch (\Throwable $th) {
            throw $th;
            return response([
                'success' => false,
            ]);
        }
    }


}
