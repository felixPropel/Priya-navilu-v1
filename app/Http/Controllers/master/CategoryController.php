<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\tag;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Category::where('active_status', 1)->get();
        return view("pages.master.Category.index", compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.master.Category.CategoryDetails");
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
            $model = Category::find($id);
            $modelTag = Tag::where('category_id', $id)->first();
            $message_type = "Updated";
        } else {
            $model = new Category();
            $modelTag = new Tag();
            $message_type = "Stored";
        }
        $model->name = $request->name;
        $model->active_status = 1;
        $model->save();
        $modelTag->name = $request->name;
        $modelTag->category_id = $model->id;
        $modelTag->type = 1;
        $modelTag->active_status = 1;
        $modelTag->save();
        return redirect('categoryMaster')->with('success', "Category" . $message_type . " successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $model = Category::find($id);
        return view("pages.master.Category.CategoryDetails", compact('model'));
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
        $post_update = Category::where("id", $id)->update(["active_status" => 0,'delete_flag'=>1,'deleted_at'=>Carbon::now()]);
        $tag_update = Tag::where("category_id", $id)->update(["active_status" => 0,'delete_flag'=>1,'deleted_at'=>Carbon::now()]);

        echo json_encode($post_update);
    }
}
