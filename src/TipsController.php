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

        // Log::info($items);
        return ['items' => $items ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($tip)
    {
        $item = Tip::find($tip);

        // Log::info($items);
        return ['item' => $item ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function search(Request $request, $category)
    {        



        $result= Tip::where('category', 'like', '%'.$category.'%')->get();

        if(!empty($result)){
            $arraycategories=[];
            foreach($result as $res){
                $arraycategories[] = $res['category'];

            }

            return response()->json(array_unique($arraycategories));

        }

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
            'question'     => 'required',
            'solution' => 'required',
            
        ]);

        $data = $request->all();
        
        $data['approved'] = 1;


        $tip = new Tip;
        
        $tip->setConnection('mongodb');
        
        $tip = Tip::create($data);


        $items = Tip::approved()->get();


        // Log::info($items);
        return ['items' => $items ];


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $tip)
    {
        $tip = Tip::find($tip);
        $tip->update($request->all());
        $items = Tip::approved()->get();

        // Log::info($items);

        return ['items' => $items ];



    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Tip  $tip
     * @return \Illuminate\Http\Response
     */
    public function destroy($tip)
    {
        
        $tips = Tip::find($tip);
        $tips->delete();

        $items = Tip::approved()->get();

        // Log::info($items);

        return ['items' => $items ];


    }
}
