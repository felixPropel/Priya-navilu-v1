<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PostPdf;
use App\Models\Posts;
use App\Models\PostsCategory;
use App\Models\PostShowroom;
use App\Models\PostsImages;
use App\Models\PostsTags;
use App\Models\Showroom;
use App\Models\SocialMedia;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Intervention\Image\ImageManagerStatic as Image;

class PostController extends Controller
{
    public function newPost(Request $request)
    {
        if (auth()->user()->id) {
            $id = DB::table('posts')->where('active_status', 1)->pluck('id')->last();
            $post_id = (int) $id + 1;
            $category = Category::where('active_status', 1)->get()->toArray();
            $tag = Tag::where(['active_status'=>1,'delete_flag'=>null])->orderBy('name')->get()->toArray();
            $showrooms = Showroom::where('active_status', 1)->get();

            return view("pages.posts.add", ['showrooms' => $showrooms, 'post_id' => $post_id, "category" => $category, "tag" => $tag]);
        } else {
            redirect('/logout');
        }
    }

    public function getCategoryDetails(Request $request)
    {
        $category_id = $request->category_id;
        $category = Category::where('id', $category_id)->get()->toArray();
        echo json_encode($category);
    }

    public function getCategoryDetailsByIds(Request $request)
    {
        $category_id = $request->category_id;
        $category = Category::whereIn('id', $category_id)->get()->toArray();
        echo json_encode($category);
    }

    public function getTagDetails(Request $request)
    {
        $tag_id = $request->tag_id;
        $tag = Tag::where('id', $tag_id)->get()->toArray();
        echo json_encode($tag);
    }

    public function getTagDetailsByIds(Request $request)
    {
        $tag_id = $request->tag_id;
        $tag = Tag::whereIn('id', $tag_id)->get()->toArray();
        echo json_encode($tag);
    }

    public function updateCategory(Request $request)
    {

        $category_name = json_decode($request->category, true);
        $new_category_id = json_decode($request->new_category_id, true);
        $type = json_decode($request->type, true);
        for ($x = 0; $x < count($category_name); $x++) {
            if ($type[$x] == 'update') {
                $id = Category::where("id", $new_category_id[$x])->update(["name" => $category_name[$x]]);
            } else {
                $name = DB::table('category')->where("name", $category_name[$x])->value('name');
                if ($name == "") {
                    $category = new Category();
                    $category->name = $category_name[$x];
                    $category->active_status = 1;
                    $category->save();
                    $id = $category->id;
                }
            }
        }
        $category = Category::where('active_status', 1)->get()->toArray();
        echo json_encode($category);
    }

    public function updateTag(Request $request)
    {
        //       echo json_encode($request->all());
        // die();
        $tag_name = json_decode($request->tag, true);
        $new_tag_id = json_decode($request->new_tag_id, true);
        $type = json_decode($request->tag_type, true);
        for ($x = 0; $x < count($tag_name); $x++) {
            if ($type[$x] == 'update') {
                $id = Tag::where("id", $new_tag_id[$x])->update(["name" => $tag_name[$x]]);
            } else {
                $name = DB::table('tags')->where("name", $tag_name[$x])->value('name');
                if ($name == "") {
                    $tag = new Tag();
                    $tag->name = $tag_name[$x];
                    $tag->active_status = 1;
                    $tag->save();
                    $id = $tag->id;
                }
            }
        }
        $tags = Tag::where('active_status', 1)->get()->toArray();
        echo json_encode($tags);
    }
    public function webPageIndex(Request $request)
    {

        $ids = Category::where('active_status', 1)->pluck('id');
        foreach ($ids as $id) {
            $posts = PostsCategory::where('category_id', $id)->pluck('post_id');
            foreach ($posts as $post) {
                $get_url = PostsImages::where('post_id', $post)->pluck('thumbnail');
                return view('Web/webPageIndex', ['get_url' => $get_url]);
            }
        }
    }
    public function storePost(Request $request)
    {
     

        if (auth()->user()->id) {
            if ($request->post_btn) {
                $pdfs = $request->file('sfiles');

                $post_id = $request->post_id;
                // $post_image = $request->post_image;
                $youtube_url = $request->youtube_url;
                $title = $request->title;
                $text_color = $request->text_color;
                $post_now = $request->post_now;
                $schedule_date = $request->schedule_date;
                $end_date_post = $request->end_date_post;
                $category = $request->category;
                $tags = $request->tags;
                $mediaUrl = $request->socialMediaUrl;
                $comment = $request->comment;
                $rating = $request->rating;
                $content = $request->content;
                $pin_to_home = $request->pin_to_home;
                $showroom = $request->showroom;
                $approvalStatus = 0;
                if ($post_now) {
                    $approvalStatus = ($request->post_btn == 1) ? 0 : 1;
                } else {
                    $approvalStatus = ($request->post_btn == 1) ? 0 : 1;
                }

                $post = new Posts();
                // $post->transaction_Id = 1;
                $post->title = $title;
                $post->title_text_color = $text_color;
                $post->pin_to_home = $pin_to_home ? 1 : 0;
                // $post->posting_type = 1;
                $post->schedule_date = $schedule_date;
                $post->post_end_date = $end_date_post;
                // $post->reschedule_count = $post_now ? 1 : 0;
                $post->post_now = $post_now ? 1 : 0;
                $post->comment = $comment;
                $post->rating = $rating;
                $post->content = $content;
                $post->approval_status = $approvalStatus;
                // $post->post_type = $post_image ? 1 : 0;
                $post->active_status = 1;
                $post->save();
                $post_id = $post->id;
                if (isset($request->pdf_upload)) {
                    if ($post_id > 0) {
                        for ($i = 0; $i < count($request->pdf_upload); $i++) {
                            if ($request->pdf_upload[$i]) {
                                $name = $request->pdf_upload[$i]->getClientOriginalName();
                                $request->pdf_upload[$i]->move(public_path() . '/pdffiles/', $post_id . '&' . $name);
                                $model[$i] = new PostPdf();
                                $model[$i]->post_id = $post_id;
                                $model[$i]->pdf_description = $request->pdf_description[$i];
                                $model[$i]->file_path = $post_id . '&' . $name;
                                $model[$i]->active_status = 1;
                                $model[$i]->save();
                            }
                        }
                    }
                }
                if (isset($mediaUrl)) {
                    if ($post_id > 0) {
                        $model = new SocialMedia;
                        $model->post_id = $post_id;
                        $model->social_media_url = $mediaUrl;
                        $model->active_status = 1;
                        $model->save();
                    }

                }
                if ($post_id > 0) {
                    $model = new PostShowroom;
                    $model->post_id = $post_id;
                    $model->showroom_id = $showroom;
                    $model->active_status = 1;
                    $model->save();
                }

                // if ($request->hasfile('sfiles')) {

                //     foreach ($request->file('sfiles') as $pdffile) {
                //         $name = $pdffile->getClientOriginalName();
                //         $imagePath = $post_id . '/' . $name;

                //         $model = new PostPdf();
                //         $model->post_id = $post_id;
                //         $model->file_path = $imagePath;
                //         $model->save();

                //         $pdffile->move(public_path() . '/pdffiles/' . $post_id . '/', $name);
                //     }
                // }

                if ($post_id > 0) {
                    if ($tags) {
                        foreach ($tags as $tag) {
                            $post_tags = new PostsTags();
                            $post_tags->post_id = $post_id;
                            $post_tags->tag_id = $tag;
                            $post_tags->active_status = 1;
                            $post_tags->save();
                        }
                    }
                    foreach ($category as $cat) {
                        $post_category = new PostsCategory();
                        $post_category->post_id = $post_id;
                        $post_category->category_id = $cat;
                        $post_category->active_status = 1;
                        $post_category->save();
                    }

                    $files = $request->file('my_files');

                    if ($request->hasFile('my_files')) {

                        foreach ($files as $file) {

                            //get filename with extension
                            $filenamewithextension = $file->getClientOriginalName();

                            //get filename without extension
                            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                            //get file extension
                            $extension = $file->getClientOriginalExtension();

                            //filename to store
                            $filenametostore = $filename . '_' . time() . '.' . $extension;

                            //small thumbnail name
                            $smallthumbnail = $filename . '_small_' . time() . '.' . $extension;

                            //medium thumbnail name
                            $mediumthumbnail = $filename . '_medium_' . time() . '.' . $extension;

                            //large thumbnail name
                            $largethumbnail = $filename . '_large_' . time() . '.' . $extension;

                            //Upload File
                            $file->storeAs('public/post', $filenametostore);
                            $file->storeAs('public/post/thumbnail', $smallthumbnail);
                            $file->storeAs('public/post/thumbnail', $mediumthumbnail);
                            $file->storeAs('public/post/thumbnail', $largethumbnail);

                            //create small thumbnail
                            $smallthumbnailpath = public_path('storage/post/thumbnail/' . $smallthumbnail);

                            $this->createThumbnail($smallthumbnailpath, 150, 93);

                            //create medium thumbnail
                            $mediumthumbnailpath = public_path('storage/post/thumbnail/' . $mediumthumbnail);
                            $this->createThumbnail($mediumthumbnailpath, 300, 185);

                            //create large thumbnail
                            $largethumbnailpath = public_path('storage/post/thumbnail/' . $largethumbnail);
                            $this->createThumbnail($largethumbnailpath, 550, 340);

                            $image = new PostsImages();
                            $image->post_id = $post_id;
                            $image->image_path = '/storage/post/' . $filenametostore;
                            $image->small_thumbnail = '/storage/post/thumbnail/' . $smallthumbnail;
                            $image->medium_thumbnail = '/storage/post/thumbnail/' . $mediumthumbnail;
                            $image->large_thumbnail = '/storage/post/thumbnail/' . $largethumbnail;
                            $image->active_status = 1;
                            $image->save();
                        }
                    }
                }

                return redirect('newPost')->with('success', "Post Uploaded Successfully.");
            } else {
                $id = DB::table('posts')->where('active_status', 1)->pluck('id')->last();
                $post_id = (int) $id + 1;
                $category = Category::where('active_status', 1)->get()->toArray();
                $tag = Tag::where('active_status', 1)->get()->toArray();
                return view("pages.posts.add", ['post_id' => $post_id, "category" => $category, "tag" => $tag]);
            }
        } else {
            redirect('/logout');
        }
    }

    public function updatePost(Request $request)
    {

        $id = $request->id;
        $post_id = $request->post_id;
        $post_image = $request->post_image;
        $youtube_url = $request->youtube_url;
        // dd($youtube_url);
        $title = $request->title;
        $text_color = $request->text_color;
        $post_now = $request->post_now;
        $schedule_date = $request->schedule_date;
        $end_date_post = $request->end_date_post;
        $category = $request->category;
        $tags = $request->tags;
        $comment = $request->comment;
        $rating = $request->rating;
        $content = $request->content;
        $pin_to_home = $request->pin_to_home;
        $current_files = $request->old_files;
        $pdf_deletes = $request->pdf_delete;

        // dd($current_files);
        $oldFile = PostsImages::where('post_id', $id)->pluck('id')->toArray();
        if (is_array($current_files)) {
            $uniqueValues = array_diff($oldFile, $current_files);
        } else {
            $uniqueValues = $oldFile;
        }

        $post_update = Posts::where("id", $id)->update(["post_now" => $post_now ? 1 : 0, "post_type" => $post_image ? 1 : 0, "title" => $title, "title_text_color" => $text_color, "pin_to_home" => $pin_to_home ? 1 : 0, "schedule_date" => $schedule_date, "post_end_date" => $end_date_post, "comment" => $comment, "rating" => $rating, "content" => $content]);
        if ($post_update > 0) {

            if (!empty($uniqueValues)) {
                foreach ($uniqueValues as $uniqueValue) {
                    $delete_url = PostsImages::where('id', $uniqueValue)->pluck('image_path')[0];
                    $delete_small = PostsImages::where('id', $uniqueValue)->pluck('small_thumbnail')[0];
                    $delete_medium = PostsImages::where('id', $uniqueValue)->pluck('medium_thumbnail')[0];
                    $delete_large = PostsImages::where('id', $uniqueValue)->pluck('large_thumbnail')[0];

                    if (file_exists(public_path() . $delete_url)) {

                        unlink(public_path() . $delete_url);
                    }

                    if (file_exists(public_path() . $delete_small)) {
                        unlink(public_path() . $delete_small);
                    }

                    if (file_exists(public_path() . $delete_medium)) {
                        unlink(public_path() . $delete_medium);
                    }

                    if (file_exists(public_path() . $delete_large)) {
                        unlink(public_path() . $delete_large);
                    }

                    $image_delete = PostsImages::where('id', $uniqueValue)->delete();
                }
            }
            if ($pdf_deletes != null) {
                foreach ($pdf_deletes as $pdf_delete) {
                    $delete_pdf = PostPdf::where('id', $pdf_delete)->pluck('file_path')[0];
                    if (file_exists(public_path() . "/pdffiles/" . $delete_pdf)) {
                        unlink(public_path() . "/pdffiles/" . $delete_pdf);
                    }

                    $delete_pdf = PostPdf::where('id', $pdf_delete)->delete();
                }
            }

            $tres = PostsTags::where('post_id', $id)->delete();
            $cres = PostsCategory::where('post_id', $id)->delete();

            foreach ($tags as $tag) {
                $post_tags = new PostsTags();
                $post_tags->post_id = $id;
                $post_tags->tag_id = $tag;
                $post_tags->active_status = 1;
                $post_tags->save();
            }

            foreach ($category as $cat) {
                $post_category = new PostsCategory();
                $post_category->post_id = $id;
                $post_category->category_id = $cat; 
                $post_category->active_status = 1;
                $post_category->save();
            }
            if (isset($request->pdf_file)) {
                if ($post_id > 0) {
                    for ($i = 0; $i < count($request->pdf_file); $i++) {
                        if ($request->pdf_file[$i]) {
                            $name = $request->pdf_file[$i]->getClientOriginalName();
                            $request->pdf_file[$i]->move(public_path() . '/pdffiles/', $post_id . '&' . $name);
                            $model[$i] = new PostPdf();
                            $model[$i]->post_id = $post_id;
                            $model[$i]->pdf_description = $request->pdf_title[$i];
                            $model[$i]->file_path = $post_id . '&' . $name;
                            $model[$i]->active_status = 1;
                            $model[$i]->save();
                        }
                    }
                }
            }

            // if ($request->hasfile('sfiles')) {

            //     foreach ($request->file('sfiles') as $pdffile) {
            //         $name = $pdffile->getClientOriginalName();
            //         $imagePath = $post_id . '/' . $name;

            //         $model = new PostPdf();
            //         $model->post_id = $post_id;
            //         $model->file_path = $imagePath;
            //         $model->save();

            //         $pdffile->move(public_path() . '/pdffiles/' . $post_id . '/', $name);
            //     }
            // }
            $files = $request->file('my_files');

            if ($request->hasFile('my_files')) {
                //$res = PostsImages::where('post_id', $id)->delete();

                foreach ($files as $file) {
                    //get filename with extension
                    $filenamewithextension = $file->getClientOriginalName();

                    //get filename without extension
                    $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);

                    //get file extension
                    $extension = $file->getClientOriginalExtension();

                    //filename to store
                    $filenametostore = $filename . '_' . time() . '.' . $extension;

                    //small thumbnail name
                    $smallthumbnail = $filename . '_small_' . time() . '.' . $extension;

                    //medium thumbnail name
                    $mediumthumbnail = $filename . '_medium_' . time() . '.' . $extension;

                    //large thumbnail name
                    $largethumbnail = $filename . '_large_' . time() . '.' . $extension;

                    //Upload File
                    $file->storeAs('public/post', $filenametostore);
                    $file->storeAs('public/post/thumbnail', $smallthumbnail);
                    $file->storeAs('public/post/thumbnail', $mediumthumbnail);
                    $file->storeAs('public/post/thumbnail', $largethumbnail);

                    //create small thumbnail
                    $smallthumbnailpath = public_path('storage/post/thumbnail/' . $smallthumbnail);

                    $this->createThumbnail($smallthumbnailpath, 150, 93);

                    //create medium thumbnail
                    $mediumthumbnailpath = public_path('storage/post/thumbnail/' . $mediumthumbnail);
                    $this->createThumbnail($mediumthumbnailpath, 300, 185);

                    //create large thumbnail
                    $largethumbnailpath = public_path('storage/post/thumbnail/' . $largethumbnail);
                    $this->createThumbnail($largethumbnailpath, 550, 340);

                    $image = new PostsImages();
                    $image->post_id = $post_id;
                    $image->image_path = '/storage/post/' . $filenametostore;
                    $image->small_thumbnail = '/storage/post/thumbnail/' . $smallthumbnail;
                    $image->medium_thumbnail = '/storage/post/thumbnail/' . $mediumthumbnail;
                    $image->large_thumbnail = '/storage/post/thumbnail/' . $largethumbnail;
                    $image->active_status = 1;
                    $image->save();
                }
                return redirect()->back()->with('success', "Post Updated Successfully.");
            }
            return redirect()->back()->withErrors(['error' => ['Inappropriate Submisssion']]);
        }
    }

    public function createThumbnail($path, $width, $height)
    {
        $img = Image::make($path)->resize($width, $height, function ($constraint) {
            $constraint->aspectRatio();
        });
        $img->save($path);

        return $img;
    }

    public function postOnApproval()
    {
        if (auth()->user()->id) {

            //$posts = Posts::with('category', 'tags', 'ratings')->where("status",1)->get();
            $posts = DB::table('posts as p')
                ->select('p.id as post_id', 'p.post_type', 'p.title as post_title', 'p.approval_status', 'p.schedule_date')
                ->where('p.approval_status', 0)
                ->where('p.force_stop_status', 0)
                ->get();
            $result = array();
            foreach ($posts as $p) {

                $category = DB::table('posts as p')
                    ->select('category.name')
                    ->join('post_categories', 'post_categories.post_id', '=', 'p.id')
                    ->join('category', 'category.id', '=', 'post_categories.category_id')
                    ->where('p.id', $p->post_id)
                    ->get();
                $c = array();
                foreach ($category as $cat) {
                    $c[] = $cat->name;
                }

                $tags = DB::table('posts as p')
                    ->select('tags.name')
                    ->join('post_tags', 'post_tags.post_id', '=', 'p.id')
                    ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
                    ->where('p.id', $p->post_id)
                    ->get();
                $t = array();
                foreach ($tags as $tag) {
                    $t[] = $tag->name;
                }

                $result[] = array(
                    'post_id' => $p->post_id,
                    'post_type' => $p->post_type,
                    'post_title' => $p->post_title,
                    'approval_status' => $p->approval_status,
                    'category_name' => implode(" ,", $c),
                    'tag_name' => implode(" ,", $t),
                );
            }

            return view("pages.posts.approval", ['result' => $result]);
        } else {
            redirect('/logout');
        }
    }

    public function postOnSchedule()
    {
        if (auth()->user()->id) {
            //$posts = Posts::with('category', 'tags', 'ratings')->where("status",1)->get();
            $posts = DB::table('posts as p')
                ->select('p.id as post_id', 'p.post_type', 'p.schedule_date', 'p.title as post_title', 'p.approval_status')
                ->where('p.approval_status', '=', 1)
                ->where('p.post_now', '!=', 1)
                ->where('p.force_stop_status', 0)
                ->where(function ($query) {
                    $query->whereDate('schedule_date', '>=', date('Y-m-d H:i:s'))
                        ->orWhereNull('schedule_date');
                })
                ->get();
            $result = array();
            foreach ($posts as $p) {

                $category = DB::table('posts as p')
                    ->select('category.name')
                    ->join('post_categories', 'post_categories.post_id', '=', 'p.id')
                    ->join('category', 'category.id', '=', 'post_categories.category_id')
                    ->where('p.id', $p->post_id)
                    ->get();
                $c = array();
                foreach ($category as $cat) {
                    $c[] = $cat->name;
                }

                $tags = DB::table('posts as p')
                    ->select('tags.name')
                    ->join('post_tags', 'post_tags.post_id', '=', 'p.id')
                    ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
                    ->where('p.id', $p->post_id)
                    ->get();
                $t = array();
                foreach ($tags as $tag) {
                    $t[] = $tag->name;
                }

                $result[] = array(
                    'post_id' => $p->post_id,
                    'post_type' => $p->post_type,
                    'post_title' => $p->post_title,
                    'approval_status' => $p->approval_status,
                    'schedule_date' => $p->schedule_date,
                    'category_name' => implode(" ,", $c),
                    'tag_name' => implode(" ,", $t),
                );
            }
            return view("pages.posts.schedule", ['posts' => $result]);
        } else {
            redirect('/logout');
        }
    }

    public function postOnSite()
    {
        if (auth()->user()->id) {

            $posts = DB::table('posts as p')
                ->select('p.id as post_id', 'p.created_at', 'p.post_type', 'p.schedule_date', 'p.title as post_title', 'p.approval_status')
                ->where('p.approval_status', 1)
                ->where('p.force_stop_status', 0)
                ->where(function ($query) {
                    $query->whereDate('schedule_date', '<=', date('Y-m-d H:i:s'))
                        ->orWhereNull('schedule_date');
                })
                ->where(function ($query) {
                    $query->whereDate('post_end_date', '>=', date('Y-m-d H:i:s'))
                        ->orWhereNull('post_end_date');
                })
                ->get();
            $result = array();
            foreach ($posts as $p) {

                $category = DB::table('posts as p')
                    ->select('category.name')
                    ->join('post_categories', 'post_categories.post_id', '=', 'p.id')
                    ->join('category', 'category.id', '=', 'post_categories.category_id')
                    ->where('p.id', $p->post_id)
                    ->get();
                $c = array();
                foreach ($category as $cat) {
                    $c[] = $cat->name;
                }

                $tags = DB::table('posts as p')
                    ->select('tags.name')
                    ->join('post_tags', 'post_tags.post_id', '=', 'p.id')
                    ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
                    ->where('p.id', $p->post_id)
                    ->get();
                $t = array();
                foreach ($tags as $tag) {
                    $t[] = $tag->name;
                }

                $result[] = array(
                    'post_id' => $p->post_id,
                    'post_type' => $p->post_type,
                    'post_title' => $p->post_title,
                    'approval_status' => $p->approval_status,
                    'schedule_date' => $p->schedule_date,
                    'created_at' => $p->created_at,
                    'category_name' => implode(" ,", $c),
                    'tag_name' => implode(" ,", $t),
                );
            }

            return view("pages.posts.site", ['posts' => $result]);
        } else {
            redirect('/logout');
        }
    }

    public function postOnExpired()
    {
        if (auth()->user()->id) {
            $date = date('Y-m-d');

            $posts = DB::table('posts as p')
                ->select('p.id as post_id', 'p.force_stop_status', 'p.post_end_date', 'p.created_at', 'p.post_type', 'p.schedule_date', 'p.title as post_title', 'p.approval_status')

            // ->whereDate('p.post_end_date', '<=', $date)
                ->where(function ($query) {
                    $query->whereDate('post_end_date', '<=', date('Y-m-d H:i:s'))
                        ->orWhere('p.force_stop_status', 1)
                        ->orWhere('p.force_stop_status', 2);
                })
                ->get();

            $result = array();
            foreach ($posts as $p) {

                $category = DB::table('posts as p')
                    ->select('category.name')
                    ->join('post_categories', 'post_categories.post_id', '=', 'p.id')
                    ->join('category', 'category.id', '=', 'post_categories.category_id')
                    ->where('p.id', $p->post_id)
                    ->get();
                $c = array();
                foreach ($category as $cat) {
                    $c[] = $cat->name;
                }

                $tags = DB::table('posts as p')
                    ->select('tags.name')
                    ->join('post_tags', 'post_tags.post_id', '=', 'p.id')
                    ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
                    ->where('p.id', $p->post_id)
                    ->get();
                $t = array();
                foreach ($tags as $tag) {
                    $t[] = $tag->name;
                }

                $result[] = array(
                    'force_stop_status' => $p->force_stop_status,
                    'post_id' => $p->post_id,
                    'post_type' => $p->post_type,
                    'post_title' => $p->post_title,
                    'approval_status' => $p->approval_status,
                    'schedule_date' => $p->schedule_date,
                    'post_end_date' => date("Y-m-d", strtotime($p->post_end_date)),
                    'created_at' => date("Y-m-d", strtotime($p->created_at)),
                    'category_name' => implode(" ,", $c),
                    'tag_name' => implode(" ,", $t),
                );
            }
            return view("pages.posts.expired", ['posts' => $result]);
        } else {
            redirect('/logout');
        }
    }

    public function editApprovalPost(Request $request)
    {

        $post_id = $request->id;
        $category = Category::where('active_status', 1)->get()->toArray();
        $tag = Tag::where('active_status', 1)->get()->toArray();
        $default = $this->get_default_post($post_id);
        $default_categories = $this->get_default_post_categories($post_id);
        $default_tags = $this->get_default_post_tags($post_id);
        $default_images = $this->get_default_post_images($post_id);
        $pdf_upload = PostPdf::where(['post_id' => $post_id, 'active_status' => 1])->get();

        $getSocialMediaUrl = SocialMedia::where('post_id', $post_id)->first();
        return view("pages.posts.edit", ['link' => "/postOnApproval", 'page' => "Post on Approval", "default_tags" => $default_tags, "default_categories" => $default_categories, 'post_id' => $post_id, "category" => $category, "tag" => $tag, 'default' => $default, 'default_images' => $default_images, 'socialMediaUrl' => $getSocialMediaUrl, 'pdfUploads' => $pdf_upload]);
    }

    public function editSchedulePost(Request $request)
    {
        $post_id = $request->id;
        $category = Category::where('active_status', 1)->get()->toArray();
        $tag = Tag::where('active_status', 1)->get()->toArray();
        $default = $this->get_default_post($post_id);
        $default_categories = $this->get_default_post_categories($post_id);
        $default_tags = $this->get_default_post_tags($post_id);
        $default_images = $this->get_default_post_images($post_id);
        // dd($default);
        return view("pages.posts.edit", ['link' => "/postOnSchedule", 'page' => "Post on Schedule", "default_tags" => $default_tags, "default_categories" => $default_categories, 'post_id' => $post_id, "category" => $category, "tag" => $tag, 'default' => $default, 'default_images' => $default_images]);
    }
    public function editSitePost(Request $request)
    {
        $post_id = $request->id;
        $category = Category::where('active_status', 1)->get()->toArray();
        $tag = Tag::where('active_status', 1)->get()->toArray();
        $default = $this->get_default_post($post_id);
        $default_categories = $this->get_default_post_categories($post_id);
        $default_tags = $this->get_default_post_tags($post_id);
        $default_images = $this->get_default_post_images($post_id);
        $default_pdfs = $this->get_default_post_pdf($post_id);

        return view("pages.posts.edit", ['link' => "/postOnSite", 'page' => "Post on Site", 'default_pdfs' => $default_pdfs, "default_tags" => $default_tags, "default_categories" => $default_categories, 'post_id' => $post_id, "category" => $category, "tag" => $tag, 'default' => $default, 'default_images' => $default_images]);
    }
    public function editExpiredPost(Request $request)
    {
        $post_id = $request->id;
        $category = Category::where('active_status', 1)->get()->toArray();
        $tag = Tag::where('active_status', 1)->get()->toArray();
        $default = $this->get_default_post($post_id);

        $default_categories = $this->get_default_post_categories($post_id);
        $default_tags = $this->get_default_post_tags($post_id);
        $default_images = $this->get_default_post_images($post_id);
        $default_pdfs = $this->get_default_post_pdf($post_id);
        // dd($default);
        return view("pages.posts.edit", ['link' => "/postOnExpired", 'page' => "Post on Expired", "default_tags" => $default_tags, "default_categories" => $default_categories, 'post_id' => $post_id, "category" => $category, "tag" => $tag, 'default' => $default, 'default_images' => $default_images, 'default_pdfs' => $default_pdfs]);
    }

    public function get_default_post($post_id)
    {
        $posts = DB::table('posts as p')
            ->select('p.id as post_id', 'p.post_type', 'p.title', 'p.title_text_color', 'p.pin_to_home', 'p.schedule_date', 'p.post_end_date', 'p.comment', 'p.rating', 'p.content', 'p.title as post_title', 'p.approval_status', 'p.post_now')
            ->where('p.id', '=', $post_id)
            ->first();
        return $posts;
    }

    public function get_default_post_categories($post_id)
    {
        $posts = DB::table('posts as p')
            ->select('post_categories.category_id')
            ->join('post_categories', 'post_categories.post_id', '=', 'p.id')
            ->join('category', 'category.id', '=', 'post_categories.category_id')
            ->where('p.id', '=', $post_id)
            ->get();
        $category_id = array();
        foreach ($posts as $p) {
            $category_id[] = $p->category_id;
        }
        return $category_id;
    }

    public function get_default_post_tags($post_id)
    {
        $posts = DB::table('posts as p')
            ->select('post_tags.tag_id')
            ->join('post_tags', 'post_tags.post_id', '=', 'p.id')
            ->join('tags', 'tags.id', '=', 'post_tags.tag_id')
            ->where('p.id', '=', $post_id)
            ->get();
        $tag_id = array();
        foreach ($posts as $p) {
            $tag_id[] = $p->tag_id;
        }
        return $tag_id;
    }

    public function get_default_post_images($post_id)
    {
        $images = DB::table('post_images as p')
            ->select('*')
            ->where('p.post_id', '=', $post_id)
            ->where('p.active_status', '=', 1)
            ->get();
        return $images;
    }
    public function get_default_post_pdf($post_id)
    {
        $models = DB::table('post_pdfs as p')
            ->select('*')
            ->where('p.post_id', '=', $post_id)
            ->get();
        return $models;
    }

    public function deletePost(Request $request)
    {
        $id = $request->id;
        $model = Posts::with('images', 'pdf')->where("id", $id)->first();
        $imageModels = $model['images'];
        $pdfModels = $model['pdf'];

        foreach ($imageModels as $imageModel) {

            $original = public_path($imageModel->image_path);

            if (File::exists($original)) {
                File::delete($original);
            }
            $small = public_path($imageModel->small_thumbnail);

            if (File::exists($small)) {
                File::delete($small);
            }
            $medium = public_path($imageModel->medium_thumbnail);

            if (File::exists($medium)) {
                File::delete($medium);
            }
            $large = public_path($imageModel->large_thumbnail);

            if (File::exists($large)) {
                File::delete($large);
            }
            $imageModel->delete();
        }
        foreach ($pdfModels as $pdfModel) {

            $pdffile = public_path('/' . $pdfModel->file_path);

            if (File::exists($pdffile)) {
                File::delete($pdffile);
            }
            $pdfModel->delete();
        }
        $model->delete();
        $res = "deleted";
        echo json_encode($res);
    }

    public function approvePost(Request $request)
    {

        $id = $request->id;
        $type = $request->typeStatus;

        if ($type == "Approve") {
            $current_status = DB::table('posts')->where('id', $id)->value('approval_status');
            $change_status = ($current_status == 1) ? 0 : 1;
            $post_update = Posts::where("id", $id)->update(["approval_status" => $change_status]);
        } else if ($type == "Remove") {
            // dd("Remove");
            $post_update = Posts::where("id", $id)->update(["force_stop_status" => 2]);
        } else if ($type == "Undo") {
            // dd("Remove");
            $post_update = Posts::where("id", $id)->update(["force_stop_status" => 0]);
        } else {
            //dd("Remove else");
            $post_update = Posts::where("id", $id)->update(["force_stop_status" => 1]);
        }
        echo json_encode($post_update);
    }
    public function deletePdf(Request $request)
    {
        if ($request->id) {
            $pdf = PostPdf::where("id", $request->id)->update(["active_status" => 0, 'delete_flag' => 1, 'deleted_at' => Carbon::now()]);
            $pdf_path = unlink(public_path() . "/pdffiles/" . $request->name);
        }
        return 1;
    }
}
