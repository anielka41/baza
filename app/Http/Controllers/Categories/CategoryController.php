<?php

namespace App\Http\Controllers\Categories;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{

    public function allCategories()
    {

        $categories = Category::where('parent_id', null)->orderby('id', 'asc')->get();
        return view('backend.categories.all-category', compact('categories'));
    }


    public function createCategory(Request $request)
    {
        $categories = Category::where('parent_id', null)->orderby('id', 'asc')->get();
        if($request->method()=='GET')
        {
            return view('backend.categories.create', compact('categories'));
        }
        if($request->method()=='POST')
        {
            $validator = $request->validate([
                'name'      => 'required',
                'slug'      => 'unique:categories',
                'parent_id' => 'nullable|numeric'
            ]);

            Category::create([
                'name' => $request->name,
                'slug' => $request->slug,
                'parent_id' =>$request->parent_id
            ]);

            return redirect()->back()->with('success', 'Kategoria została utworzona!');
        }
    }

    public function editCategory($id, Request $request)
    {
        $category = Category::findOrFail($id);
        if($request->method()=='GET')
        {
            $categories = Category::where('parent_id', null)->where('id', '!=', $category->id)->orderby('name', 'asc')->get();
            return view('backend.categories.edit-category', compact('category', 'categories'));
        }

        if($request->method()=='POST')
        {
            $validator = $request->validate([
                'name'     => 'required',
                'slug' => ['required', Rule::unique('categories')->ignore($category->id)],
                'parent_id'=> 'nullable|numeric'
            ]);
            if($request->name != $category->name || $request->parent_id != $category->parent_id)
            {
                if(isset($request->parent_id))
                {
                    $checkDuplicate = Category::where('name', $request->name)->where('parent_id', $request->parent_id)->first();
                    if($checkDuplicate)
                    {
                        return redirect()->back()->with('error', 'Category already exist in this parent.');
                    }
                }
                else
                {
                    $checkDuplicate = Category::where('name', $request->name)->where('parent_id', null)->first();
                    if($checkDuplicate)
                    {
                        return redirect()->back()->with('error', 'Category already exist with this name.');
                    }
                }
            }

            $category->name = $request->name;
            $category->parent_id = $request->parent_id;
            $category->slug = $request->slug;
            $category->save();
            return redirect()->back()->with('success', 'Category has been updated successfully.');
        }
    }

    public function deleteCategory(int $id): JsonResponse
    {
        $category = Category::findOrFail($id);
        if(count($category->subcategory))
        {
            $subcategories = $category->subcategory;
            foreach($subcategories as $cat)
            {
                $cat = Category::findOrFail($cat->id);
                $cat->parent_id = null;
                $cat->save();
            }
        }
        $category->delete();
        return response()->json([
            'status' => 'success'
        ]);
//        return redirect()->back()->with('delete', 'Category has been deleted successfully.');
    }
}
