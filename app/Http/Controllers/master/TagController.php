<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Tag::where(['active_status'=>1,'type'=>0,'category_id'=>0])->get();

        return view("pages.master.tag.index", compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.master.tag.tagDetails");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $id = $request->id;
        if ($id) {
            $model = Tag::find($id);
            $message_type = "Updated";
        } else {
            $model = new Tag();
            $message_type = "Stored";
        }
        $model->name = $request->name;
        $model->category_id =0;
        $model->type = 0;   
        $model->active_status = 1;
        $model->save();
        return redirect('tagMaster')->with('success', "Tag".$message_type." successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $model = Tag::find($id);
        return view("pages.master.tag.tagDetails", compact('model'));
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
    public function destroy(Request $request)
    {
      
        $id = $request->id;
        $post_update = Tag::where("id", $id)->update(["active_status" => 0,'delete_flag'=>1,'deleted_at'=>Carbon::now()]);
        echo json_encode($post_update);
    }
}
