<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return \App\Tag::all();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new \App\Tag;
        $tag->name = $request->name;
        $tag->user_id = \Auth::user()->id;
        $tag->bookmark_id = $request->bookmark_id;
       
        $tag->save();

        return $tag;

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
         return \App\Tag::with([
            'user'
            ])->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = \App\Tag::find($id);
        if ($tag->user_id == Auth::user()->id) {
        $tag->name = $request->name;
        $tag->bookmark_id = $request->bookmark_id;
        $tag->save();
    } else {
        return response("Unauthorized", 403);
    }
        
        return $tag;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = \App\Tag::find($id);
        if ($tag->user_id == Auth::user()->id) {
        $tag->delete();
        return $tag;
        } else {
            return response("Unauthorized", 403);
        }
    }
}
