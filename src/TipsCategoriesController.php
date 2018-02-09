<?php

namespace tip\tipsystem;

use tip\tipsystem\Models\TipCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipsCategoriesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Log::info($items);
        return $items;
    }





    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'     => 'required',
        ]);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tip $tip)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tip $tip)
    {


    }
}
