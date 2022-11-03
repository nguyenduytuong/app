<?php

namespace App\Http\Controllers;

use App\Http\Resources\profanityResource;
use App\Models\profanity;
use Illuminate\Http\Request;
use Askedio\Laravel5ProfanityFilter\ProfanityFilter;
use ConsoleTVs\Profanity\Facades\Profanity as profanityty;

use Validator;

class ProfanityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profan = profanity::all();
        // $profan->name = profanityty::blocker($profan->name)->filter();
        // $string = app('profanityFilter')->replaceWith('*')->replaceFullWords(false)->filter('bitch bitch bitch');
        // dd($string);
        return  profanityResource::collection($profan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|profanity',
        ]);
        if ($validator->fails()) {
            return false;
        }
        $name = $request->input('name');
        

        profanity::create([
            'name' => $name
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\profanity  $profanity
     * @return \Illuminate\Http\Response
     */
    public function show(profanity $profanity)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\profanity  $profanity
     * @return \Illuminate\Http\Response
     */
    public function edit(profanity $profanity)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\profanity  $profanity
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, profanity $profanity)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\profanity  $profanity
     * @return \Illuminate\Http\Response
     */
    public function destroy(profanity $profanity)
    {
        //
    }
}
