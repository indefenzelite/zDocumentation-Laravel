<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Vote;

class VoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        if ($request->faq_id == null) {
            return response()->json([
                    'status'=>'error',
                    'message' => 'Error',
                    'title' => 'FAQ not found!'
                ]
            );
        }
        $ip_address = request()->ip();
        if (auth()->check()) {
            $user_id = auth()->id();
            $vote = Vote::where('faq_id',$request->faq_id)->where('user_id',$user_id)->first();
        }else{
            $user_id = null;
            $vote = Vote::where('faq_id',$request->faq_id)->where('ip_address',$ip_address)->first();
        }
        if ($vote){
            $vote->update([
                'status' => $request->status,
            ]);
        }else{
            $vote = Vote::create([
                'faq_id' => $request->faq_id,
                'status' => $request->status,
                'ip_address' => $ip_address,
                'user_id' => $user_id,
            ]);
        }
        return response()->json([
            'status'=>'success',
            'message' => 'Success',
            'title' => 'Feedback Submitted!',
            'status_id' => $vote->status
        ]
    );

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
