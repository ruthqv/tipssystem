<?php

namespace tip\tipsystem;

use tip\tipsystem\Models\Tip;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TipsController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Tip::approved()->get();

        foreach($items as $item){
           $item->category =  $item->tipcategory()->first();
        }
        // Log::info($items);

        print_r($items);
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
            'description' => 'required',
            
        ]);

        $data = $request->all();



        return $data;


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Crud $crud)
    {


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Crud  $crud
     * @return \Illuminate\Http\Response
     */
    public function destroy(Crud $crud)
    {


    }
}
