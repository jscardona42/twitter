<?php

namespace App\Http\Controllers;

use App\Tweet;
use Illuminate\Http\Request;

class TweetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $datos['tweets'] = Tweet::select('tweets.id', 'tweets.content', 'tweets.created_at', 'users.name')
            ->join('users', 'users.id', '=', 'tweets.user_id')
            ->orderBy('created_at', 'DESC')
            ->get();

        // $datos['tweets'] =  Tweet::orderBy('created_at', 'DESC')->get();
        return view('tweets.home', $datos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $datosTweet = $request->except('_token');
        $user = auth()->user();
        $datosTweet['user_id'] = $user->id;
        Tweet::insert($datosTweet);
        $datos['tweets'] =  Tweet::orderBy('created_at', 'DESC')->get();
        return view('tweets.home', $datos);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $tweet = Tweet::findOrFail($id);
        return view('tweets.home', compact('tweet'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function edit(Tweet $tweet)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $datosTweet = $request->except(['_token', '_method']);
        Tweet::where('id', '=', $id)->update($datosTweet);

        $datos['tweets'] =  Tweet::orderBy('created_at', 'DESC')->get();
        return view('tweets.home', $datos);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tweet  $tweet
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $empleado = Tweet::findOrFail($id);
        Tweet::destroy($id);

        $datos['tweets'] =  Tweet::orderBy('created_at', 'DESC')->get();
        return view('tweets.home', $datos);
    }
}
