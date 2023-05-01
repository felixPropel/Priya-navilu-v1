<?php

namespace App\Http\Controllers\master;

use App\Http\Controllers\Controller;
use App\Models\Showroom;
use Illuminate\Http\Request;
use Carbon\Carbon;

class ShowroomController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $models = Showroom::where('active_status', 1)->get();
        return view("pages.master.Showroom.index", compact('models'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("pages.master.Showroom.showroomDetails");
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
            $model = Showroom::find($id);
            $message_type = "Updated";
        } else {
            $model = new Showroom();
            $message_type = "Stored";
        }
        $model->name = $request->name;
        $model->showroom_city = $request->city;
        $model->showroom_address = $request->address;
        $model->showroom_address = $request->address;
        $model->email_id = $request->email_id;
        $model->contact_number = $request->number;
        $model->geo_location= $request->geolocation;
        $model->active_status = 1;
        $model->save();

        return redirect('showroomMaster')->with('success', "Showroom" . $message_type . " successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Showroom::find($id);
        return view("pages.master.Showroom.showroomDetails", compact('model'));
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
        $post_update = Showroom::where("id", $id)->update(["active_status" => 0,'delete_flag'=>1,'deleted_at'=>Carbon::now()]);
        echo json_encode($post_update);
    }
}
