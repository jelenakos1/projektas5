<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\paginationSetting;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('name', 'asc' )->get();
      
        $sortCollumn = $request->sortCollumn; 
        $sortOrder = $request->sortOrder; 

        $tem_book = Post::all();
        $book_collumns = array_keys($tem_book->first()->getAttributes());

        if(empty($sortCollumn) || empty($sortOrder)) {
            $posts = Post::all();
        } else {

            if($sortCollumn == "post_id") {
                $sortBool = true;
                
                if($sortOrder == "asc"){
                    $sortBool = false;
    }
    $posts = Post::get()->sortBy(function($query){
        return $query->post->name;
    }, SORT_REGULAR, $sortBool )->all();

} else {
    $posts = Post::orderBy($sortCollumn, $sortOrder )->get();
}
}   

$select_array =  $book_collumns;


return view('post.index', ['posts' => $posts, 'sortCollumn' =>$sortCollumn, 'sortOrder'=> $sortOrder, 'select_array' => $select_array,  ]);
}

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $posts = Post::all();
        return view('post.create', ['posts' =>$posts]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $post = new Post;

        $post->title = $request->post_title;
        $post->description = $request->post_description;
     
        if($request->post_newpost){
            $post = new Post;

            $post->name=$request->post_name;
            $post->surname=$request->post_surname;
         
            $post->description = $request->post_description;
            $post->save();

            $post->post_id = $post->id;

        } else {
            $post->post_id = $request->post_postid;
        }

        $post->save();

        return redirect()->route('post.index');
    }
}

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        //comm
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
    public function postfilter(Request $request) {
        

        $post_id = $request-> post_id;
        $posts =  Post::where(' post_id', '=' , $post_id)->get();
        return view('post. postfilter', ['posts' =>$posts]);
    }

    public function indexpagination(Request $request) {
    

        $sortCollumn = $request->sortCollumn; 
        $sortOrder = $request->sortOrder; 


        $tem_post =  Post::all();
        $post_collumns = array_keys($tem_post->first()->getAttributes());


        if(empty($sortCollumn) || empty($sortOrder)) {
            $posts =  Post::paginate(15);
        } else {
            $posts = post::orderBy($sortCollumn, $sortOrder )->paginate(15);
        }   

         $select_array =  $post_collumns;


        return view('post.indexpagination', ['posts' => $posts,'sortCollumn' =>$sortCollumn, 'sortOrder'=> $sortOrder, 'select_array' => $select_array]);
    }

    private function isPaginateFilter($page_limit, $post_id, $sortCollumn, $sortOrder ) {
        if($page_limit == 1) {
          return $posts = Post::where('post_id', '=', $post_id)->orderBy($sortCollumn, $sortOrder)->get();
        } 
        return $posts = Post::where('post_id', '=', $post_id)->orderBy($sortCollumn, $sortOrder)->paginate($page_limit);
        
    }

    private function isPaginateSort($page_limit, $sortCollumn, $sortOrder) {
        if($page_limit == 1) {
          
            if($sortCollumn == 'post_id')
            {
              return $posts = Post::select('posts.*')->join('posts','posts.post_id', '=', 'posts.id')->orderBy('posts.name', $sortOrder)->get();
               
            } 
                return $posts= Post::orderBy($sortCollumn, $sortOrder)->get();

        } else {
           
            if($sortCollumn == 'post_id') {
              return $posts = Post::select('posts.*')->join('posts','posts.posts_id', '=', 'posts.id')->orderBy('posts.name', $sortOrder)->paginate($page_limit);
          
            } 
            
            return $posts= Post::orderBy($sortCollumn, $sortOrder)->paginate($page_limit);
            
        }
        return 0;
    }

    public function indexsortfilter(Request $request) {

        $sortCollumn = $request->sortCollumn;
        $sortOrder = $request->sortOrder;
        $post_id = $request->post_id;

        
        $paginationSettings = paginationSetting::where('visible', '=', 1)->get();
        
        $sortBool = true;
                
        if($sortOrder == "asc"){
            $sortBool = false;
        }

        $page_limit = $request->page_limit;

            
        $tem_post = Post::all();
        $post_collumns = array_keys($tem_post->first()->getAttributes());
        $select_array =  $post_collumns;

        if(empty( $sortCollumn) || empty($sortOrder) || empty($author_id) )
        {   
            $posts = Post::paginate($page_limit);     
        } else {
            if($post_id == 'all') {
                $posts = $this->isPaginateSort($page_limit, $sortCollumn, $sortOrder);
            } else {
                $posts = $this->isPaginateFilter($page_limit, $author_id, $sortCollumn, $sortOrder);
            }   
        }
        $posts = Post::all();

        return view('post.indexsortfilter', [
            'posts'=> $posts, 
           
            'select_array'=>$select_array, 
            'sortCollumn'=>$sortCollumn, 
            'sortOrder' => $sortOrder, 
            'post_id'=> $post_id, 
            'paginationSettings' => $paginationSettings, 
            'page_limit' => $page_limit ]);
    }
