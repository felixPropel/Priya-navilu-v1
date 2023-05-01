<?php

namespace App\Http\Controllers\FrontView;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Posts;
use App\Models\PostsCategory;
use App\Models\PostsImages;
use App\Models\Showroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrontUserViewController extends Controller
{
    public function index()
    {

        $catloguePosts = $this->getCategoryBasedData('Catalogue');
        $knowledgeBasedPosts = $this->getCategoryBasedData('Knowledge Base');
        $kitchenPosts = $this->getCategoryBasedData('Kitchen');

        $tilePosts = $this->getCategoryBasedData('Tile');

        $fittingPosts = $this->getCategoryBasedData('Fitting');
        $showroomPosts = $this->getCategoryBasedData('Showroom');

        $awardPosts = $this->getCategoryBasedData('Award');

        // dd($knowledgeBasedPosts);
        $kitchenSamplePosts = $this->getSamplePostData('Kitchen');

        $tileSamplePosts = $this->getSamplePostData('Tile');

        $fittingSamplePosts = $this->getSamplePostData('Fitting');

        $ids = Category::where('active_status', 1)->pluck('id');

        foreach ($ids as $id) {
            $posts = PostsCategory::where('category_id', $id)->pluck('post_id');
            foreach ($posts as $post) {
                $get_url = PostsImages::where('post_id', $post)->pluck('medium_thumbnail');
            }
        }

        $showroomMasterModels = Showroom::where('active_status', 1)->get();
        return view('Web/webPageIndex', ['showroomMasterModels' => $showroomMasterModels, 'fittingSamplePosts' => $fittingSamplePosts, 'tileSamplePosts' => $tileSamplePosts, 'awardPosts' => $awardPosts, 'showroomPosts' => $showroomPosts, 'kitchenSamplePosts' => $kitchenSamplePosts, 'fittingPosts' => $fittingPosts, 'catloguePosts' => $catloguePosts, 'knowledgeBasedPosts' => $knowledgeBasedPosts, 'kitchenPosts' => $kitchenPosts, 'tilePosts' => $tilePosts]);
    }
    public function getCategoryBasedData($category = null, $tag = null)
    {
        $todayDate = date('Y-m-d');
        $datas = Posts::select('posts.id', 'posts.id as postId', 'posts.title', 'category.name as catname', 'post_images.image_path', 'post_images.id as imageId', 'posts.id as postId', 'post_images.medium_thumbnail', 'post_images.small_thumbnail')
            ->leftjoin('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->leftjoin('category', 'category.id', '=', 'post_categories.category_id')
            ->leftjoin('post_images', 'post_images.post_id', '=', 'posts.id')
            ->where('category.name', $category)
            ->where('pin_to_home', 1)
            ->where('posts.approval_status', 1)
            ->where(function ($q) use ($todayDate) {
                $q->where('posts.post_now', '=', 1)
                    ->orWhere(
                        [
                            ['schedule_date', '<=', $todayDate],
                            ['post_end_date', '>=', $todayDate],
                        ]
                    );
            })

            ->orderby('posts.rating', 'DESC')
            ->orderby('post_images.id')
            ->groupby('posts.id')
            ->get();

        return $datas;
    }
    public function getSamplePostData($category)
    {
        $datas = Posts::select('posts.id', 'posts.title', 'category.name as catname', 'post_images.image_path', 'posts.id as postId', 'post_images.medium_thumbnail', 'post_images.large_thumbnail')
            ->leftjoin('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->leftjoin('category', 'category.id', '=', 'post_categories.category_id')
            ->leftjoin('post_images', 'post_images.post_id', '=', 'posts.id')
            ->where('category.name', $category)
            ->where('pin_to_home', 1)
            ->orderby('post_images.id')
            ->orderBy('posts.created_at', 'desc')
            ->where('posts.approval_status', 1)
            ->where(function ($q) {
                $q->where('posts.post_now', '=', 1)
                    ->orWhere(
                        [
                            ['schedule_date', '<=', date('Y-m-d')],
                            ['post_end_date', '>=', date('Y-m-d')],
                        ]
                    );
            })

            ->orderby('posts.rating', 'DESC')
            ->groupby('posts.id')
            ->get();
        return $datas;
    }
    public function getSearchBasedData($key)
    {
        $datas = Posts::select('posts.id', 'posts.title', 'posts.title_text_color', 'category.name as catname', 'post_images.image_path', 'posts.id as postId', 'post_images.medium_thumbnail', 'post_social_media.social_media_url')
            ->leftjoin('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->leftjoin('category', 'category.id', '=', 'post_categories.category_id')
            ->leftjoin('post_tags', 'post_tags.post_id', '=', 'posts.id')
            ->leftjoin('post_social_media', 'post_social_media.post_id', '=', 'posts.id')
            ->leftjoin('tags', 'tags.id', '=', 'post_tags.tag_id')
            ->leftjoin('post_images', 'post_images.post_id', '=', 'posts.id')
            ->whereIn('category.name', $key)
            ->where('posts.approval_status', 1)
            ->where(function ($q) {
                $q->where('posts.post_now', '=', 1)
                    ->orWhere(
                        [
                            ['schedule_date', '<=', date('Y-m-d')],
                            ['post_end_date', '>=', date('Y-m-d')],
                        ]
                    );
            })

            ->orderby('posts.rating', 'DESC')
            ->orWhereIn('tags.name', $key)
            ->orderby('post_images.id')
            ->groupby('posts.id')
            ->get();
        return $datas;
    }
    public function searchingCategory($catName,$key){
        dd($key,$catName);
    }
    public function serachingKeyword($key)
    {
        $key = explode(',', $key);
        $filterDatas = $this->getSearchBasedData($key);
        $showroomMasterModels = Showroom::where('active_status', 1)->get();

        return view('Web/gallery', compact('filterDatas', 'showroomMasterModels','key'));
    }
    public function serachingKeywordByForm(Request $request)
    {
        $key = explode(',', $request->keywords);

        $filterDatas = $this->getSearchBasedData($key);

        return view('Web/gallery', compact('filterDatas'));
    }
    public function gallery()
    {
        return view('Web/gallery');
    }
    public function serachingByPostId($postId)
    {

        $postImages = Posts::select('posts.id', 'posts.title', 'category.name as catname', 'post_images.image_path', 'post_images.id as imageId', 'posts.id as postId', 'post_images.medium_thumbnail', 'post_social_media.social_media_url')
            ->leftjoin('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->leftjoin('category', 'category.id', '=', 'post_categories.category_id')
            ->leftjoin('post_social_media', 'post_social_media.post_id', '=', 'posts.id')
            ->leftjoin('post_tags', 'post_tags.post_id', '=', 'posts.id')
            ->leftjoin('tags', 'tags.id', '=', 'post_tags.tag_id')
            ->leftjoin('post_images', 'post_images.post_id', '=', 'posts.id')
            ->where('posts.id', $postId)
            ->where('posts.approval_status', 1)
            ->where(function ($q) {
                $q->where('posts.post_now', '=', 1)
                    ->orWhere(
                        [
                            ['schedule_date', '<=', date('Y-m-d')],
                            ['post_end_date', '>=', date('Y-m-d')],
                        ]
                    );
            })

            ->orderby('posts.rating', 'DESC')
            ->orderby('post_images.id')
            ->groupby('post_images.id')
            ->get();

        $pdfs = DB::table('post_pdfs as p')
            ->select('*')
            ->where('p.post_id', '=', $postId)
            ->get();

        $postDetailDatas = Posts::select('posts.id', 'category.id as categoryId', 'tags.id as tagId', 'posts.title', 'posts.content', 'category.name as catname', 'post_images.image_path', 'posts.id as postId', 'post_images.medium_thumbnail')
            ->leftjoin('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->leftjoin('category', 'category.id', '=', 'post_categories.category_id')
            ->leftjoin('post_tags', 'post_tags.post_id', '=', 'posts.id')
            ->leftjoin('tags', 'tags.id', '=', 'post_tags.tag_id')
            ->leftjoin('post_images', 'post_images.post_id', '=', 'posts.id')
            ->where('posts.approval_status', 1)
            ->where(function ($q) {
                $q->where('posts.post_now', '=', 1)
                    ->orWhere(
                        [
                            ['schedule_date', '<=', date('Y-m-d')],
                            ['post_end_date', '>=', date('Y-m-d')],
                        ]
                    );
            })

            ->orderby('posts.rating', 'DESC')
            ->where('posts.id', $postId)
            ->orderby('post_images.id')
            ->first();

        $categoryId = $postDetailDatas->categoryId;
        $tagId = $postDetailDatas->tagId;
        $categoryDatas = $this->getPostDataByCategoryId($categoryId, $postId);
        $tagDatas = $this->getPostDataByTagId($tagId, $postId);
        $relatedDatas = array_merge($categoryDatas, $tagDatas);
        ///dd($categoryDatas);

        $relatedPosts = array();
        $tempArray = array();
        foreach ($relatedDatas as $key => $line) {

            if (!in_array($line['ImgId'], $tempArray)) {
                $tempArray[] = $line['ImgId'];
                $relatedPosts[$key] = $line;
            }
        }
        $showroomMasterModels = Showroom::where('active_status', 1)->get();

        return view('Web/detail', compact('postImages', 'postDetailDatas', 'relatedPosts', 'pdfs', 'showroomMasterModels'));
    }

    public function getPostDataByCategoryId($categoryId, $postId)
    {

        return Posts::select('posts.id', 'category.id as categoryId', 'posts.title', 'posts.content', 'category.name as catname', 'post_images.image_path', 'posts.id as postId', 'post_images.medium_thumbnail', 'post_images.id as ImgId')
            ->leftjoin('post_categories', 'post_categories.post_id', '=', 'posts.id')
            ->leftjoin('category', 'category.id', '=', 'post_categories.category_id')
            ->leftjoin('post_images', 'post_images.post_id', '=', 'posts.id')
        //->where('category.id', $categoryId)
            ->where('posts.id', '!=', $postId)
            ->where('posts.approval_status', 1)
            ->where(function ($q) {
                $q->where('posts.post_now', '=', 1)
                    ->orWhere(
                        [
                            ['schedule_date', '<=', date('Y-m-d')],
                            ['post_end_date', '>=', date('Y-m-d')],
                        ]
                    );
            })

            ->orderby('posts.rating', 'DESC')
            ->orderby('post_images.id')
            ->groupby('posts.id')
            ->get()->toArray();
    }
    public function getPostDataByTagId($tagId, $postId)
    {

        return Posts::select('posts.id', 'tags.id as tagId', 'posts.title', 'posts.content', 'post_images.image_path', 'posts.id as postId', 'post_images.medium_thumbnail', 'post_images.id as ImgId')
            ->leftjoin('post_tags', 'post_tags.post_id', '=', 'posts.id')
            ->leftjoin('tags', 'tags.id', '=', 'post_tags.tag_id')
            ->leftjoin('post_images', 'post_images.post_id', '=', 'posts.id')
            ->where('tags.id', $tagId)
            ->where('posts.id', '!=', $postId)
            ->orderby('post_images.id')
            ->where('posts.approval_status', 1)
            ->where(function ($q) {
                $q->where('posts.post_now', '=', 1)
                    ->orWhere(
                        [
                            ['schedule_date', '<=', date('Y-m-d')],
                            ['post_end_date', '>=', date('Y-m-d')],
                        ]
                    );
            })

            ->orderby('posts.rating', 'DESC')
            ->groupby('posts.id')
            ->get()->toArray();
    }
}
