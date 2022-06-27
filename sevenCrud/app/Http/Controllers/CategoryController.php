<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function allCategory() {

        $trashCategory = Category::onlyTrashed()->latest()->paginate(3) ;

        //By using eloquent ORM
        $categories = Category::all();            //Place inserted data at the bottom of the ListView.
        // $categories = Category::latest()->get();  //Place inserted data at the top of the ListView.  //Without Paginate Function
        $categories = Category::latest()->paginate(5); //with paginate Function
        

        //By using Query Builder
        // $categories = DB::table('categories')->latest()->get();  //Place inserted data at the top of the ListView.  //without paginate function 
        // $categories = DB::table('categories')->latest()->paginate(5);  //With Paginate Function
        // return view('admin.category.index', compact('categories')); // Normally Executed code without soft Delete / Delete Functionality
        return view('admin.category.index', compact('categories', 'trashCategory')); //Using Delete Functionality
    }

    public function addCategory(Request $request) {
        $request->validate([
            'category_name' => 'required|max:20',
        ],
        [
            'category_name.required' => 'Please Input Category Name',
            'category_name.max' => 'Category name must be in between twenty characters.',
            ]);
            
        $category = Category::insert([
            'category_name'=>$request->category_name,
            'user_id'=>Auth::user()->id,
            'created_at' => Carbon::now()
        ]);

        // IN THIS PROCESS, updated_at COLUMN IN DATABASE ALSO GETS FILLED UP BY created_at()'S TIME. IT IS NOT LOGICAL OR MAINTAINABLE.

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();


        // DATA INSERTION INTO DATABASE THROUGH QUERY BUILDER
        // $data = array();
        // $data['category_name'] = $request -> category_name;
        // $data['user_id'] = Auth::user()->id;
        
        // DB::table('categories')->insert($data);
        return redirect()->back()->with('success', 'Category Inserted.');
    }

    public function editCategory($id) {
        // $categories = Category::find($id);  // Eloquent ORM
        $categories = DB::table('categories')->where('id', $id)->first(); //Query Builder
        return view('admin.category.edit', compact('categories'));
    }

    public function updateCategory(Request $request, $id) {
        $request->validate([
            'category_name' => 'required|max:20',
        ],
        [
            'category_name.required' => 'Please Input Category Name',
            'category_name.max' => 'Category name must be in between twenty characters.',
            ]);
        // By Using Eloquent ORM
        // $update = Category::find($id)->update([
        //     'category_name' => $request -> category_name,
        //     'user_id' => Auth::user()->id
        // ]);

        $data = array();
        $data ['category_name'] = $request -> category_name;
        $data['user_id'] = Auth::user()->id;

        DB::table('categories')->where('id', $id)->update($data);
    
     return redirect()->route('all.category')->with('success', 'Category Updated.');
    
    }

    // Soft Delete
    public function softDelete($id) 
    {
        // dd($id);
        $delete = Category::find($id)->delete();
        return redirect()->back()->with('success', 'Category Deleted');
    }

    public function restoreCategory($id) {
        $restore = Category::withTrashed()->find($id)->restore();
        return redirect()->back()->with('success', 'Category Restored.'); 
    }

    public function deleteCategory($id) {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return redirect()->back()->with('success', 'Category Permanantly Deleted.');
    }
}
