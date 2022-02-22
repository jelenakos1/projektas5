<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sortCollumn = $request->sortCollumn; 
        $sortOrder = $request->sortOrder; 

        if(empty($sortCollumn) || empty($sortOrder)) {
            $categories = Category::all();
        } else {
            $categories = Category::orderBy($sortCollumn, $sortOrder )->get();
        }   


        // $select_array = array('id','name','surname','username','description');

        $select_array =  array_keys($categories->first()->getAttributes());
        return view('category.index', ['categories' => $categories, 'sortCollumn' =>$sortCollumn, 'sortOrder'=> $sortOrder, 'select_array' => $select_array,  ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreCategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $category = new Category;
        $category->name = $request->category_name;
        $category->surname = $request->category_surname;
        $category->username = $request->category_username;
        $category->description = $request->category_description;

        $category->save();
       
        if($request->category_newposts) {
     
            $books_count = count($request->post_title);

            for($i=0; $i< $posts_count; $i++) {
                $post = new Post;
                $post->title = $request->post_title[$i];
                $post->description = $request->post_description[$i];
                $post->post_id = $post->id;
                $post->save();
            }
        }

        return redirect()->route('post.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
