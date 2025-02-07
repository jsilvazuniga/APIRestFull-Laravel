<?php

namespace App\Http\Controllers\Category;

use App\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;


class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$categories = Category::all();
        $categories = Category::paginate($this->determinePageSize());

        //  return response()->json(['data' => $buyers], 200);
          return $this->showAll($categories);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $rules = ['name' => 'required|max:255',
                'description' => 'required|max:1000'];

        $data = $this->transformAndValidatedRequest(CategoryResource::class, $request, $rules);
                    
        $category = Category::create($data);

        return $this->showOne($category, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        $rules = ['name' => 'max:255',
                'description' => 'max:1000'];

        $data = $this->transformAndValidatedRequest(CategoryResource::class, $request, $rules);
             
        
        $category->fill($data);

        if($category->isClean()){
            return $this->errorResponse('you need to specify any new value to update category', 422);
        }

        $category->save();

        return $this->showOne($category);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
