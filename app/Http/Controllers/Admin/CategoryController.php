<?php

namespace App\Http\Controllers\Admin;

<<<<<<< HEAD
use App\Category;
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
=======
use App\Http\Controllers\Controller;
use Brian2694\Toastr\Facades\Toastr;
use App\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
>>>>>>> 78134d595fe4aa8c57c6b996d9f2cdf52e2bd44d

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
<<<<<<< HEAD
        //
=======
        $categories = Category::latest()->get();
        return view('admin.category.index', compact('categories'));
>>>>>>> 78134d595fe4aa8c57c6b996d9f2cdf52e2bd44d
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
<<<<<<< HEAD
        $levels = Category::where('parent_id',0)->get();
        return view('admin.category.add_category', compact('levels'));
=======

        return view('admin.category.create');
>>>>>>> 78134d595fe4aa8c57c6b996d9f2cdf52e2bd44d
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
<<<<<<< HEAD
        $this->validate($request,[
          'category_name'=>'required',
          'parent_id'=>'required',     
          'category_description'=>'required',     
        ]);
        $category = new Category();
        $category->name = $request->category_name;
        $category->parent_id = $request->parent_id;
        $category->slug = str_slug($request->name);
        $category->description = $request->category_description;
        $category->save();
        Toastr::success('Category added successfully','Success');
        return redirect()->route('admin.category.create');



=======
        $this->validate($request, [
            'name' => 'required|unique:categories',
            'image' => 'required|mimes:jpeg,bmp,png,jpg',
        ]);
        //get form image
        $image = $request->file('image');
        $slug  = str_slug($request->name);
        if (isset($image)) {
            //make unique name for image
            $currentDate = Carbon::now()->toDateString();
            $imagename   = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            //check directory and if not then make it
            if (!storage::disk('public')->exists('category')) {
                storage::disk('public')->makeDirectory('category');
            }
            //resize image for category & upload
            //must insatll image.intervention.io before using image resize or any other ,,,

            $category = Image::make($image)->resize(1600, 479)->stream();
            storage::disk('public')->put('category/' . $imagename, $category);

            //check category slider dir is exists
            if (!storage::disk('public')->exists('category/slider')) {
                storage::disk('public')->makeDirectory('category/slider');
            }
            //resize for category slider & upload
            $slider = Image::make($image)->resize(500, 533)->stream();
            storage::disk('public')->put('category/slider/' . $imagename, $slider);
        } else {
            $imagename = "default.png";
        }

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image = $imagename;
        $category->save();
        Toastr::success('Category Successfully save:', 'success');
        return redirect()->route('admin.category.index');
>>>>>>> 78134d595fe4aa8c57c6b996d9f2cdf52e2bd44d
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
<<<<<<< HEAD
        //
=======
        $category = Category::find($id);
        return view('admin.category.edit', compact('category'));
>>>>>>> 78134d595fe4aa8c57c6b996d9f2cdf52e2bd44d
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
<<<<<<< HEAD
        //
    }

=======
        $this->validate($request, [
            'name' => 'required',
            'image' => 'mimes:jpeg,bmp,jpg,png',

        ]);

        $image = $request->file('image');
        $slug  = str_slug($request->name);
        $category = Category::find($id);
        if (isset($image)) {
            $currentDate = carbon::now()->toDateString();
            $imagename   = $slug . '-' . $currentDate . '-' . uniqid() . '.' . $image->getClientOriginalExtension();

            if (!storage::disk('public')->exists('category')) {
                storage::disk('public')->makeDirectory('category');
            }
            //delete old category image
            if (storage::disk('public')->exists('category/' . $category->image)) {
                storage::disk('public')->delete('category/'.$category->image);
            }
            //resize image for category  & upload

            $categoryimage = Image::make($image)->resize(1600, 479)->stream();
            storage::disk('public')->put('category/' . $imagename, $categoryimage);

            if (!storage::disk('public')->exists('category/slider')) {
                Storage::disk('public')->makeDirectory('category/slider');
            }
            //delete old slider image
            if (storage::disk('public')->exists('category/slider/' . $category->image)) {
                storage::disk('public')->delete('category/slider/' . $category->image);
            }

            //resize image for category slider & upload
            $slider = Image::make($image)->resize(500, 333)->stream();
            storage::disk('public')->put('category/slider/' . $imagename, $slider);
        }else{
            $imagename = $category->image;
        }
        $category->name = $request->name;
        $category->slug = $slug;
        $category->image= $imagename;
        $category->save();
        Toastr::success('Category successfully updated','success');
        return redirect()->route('admin.category.index');


    }



>>>>>>> 78134d595fe4aa8c57c6b996d9f2cdf52e2bd44d
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
<<<<<<< HEAD
        //
=======
        $category = Category::find($id);
        if(storage::disk('public')->exists('category/'.$category->image)){
            storage::disk('public')->delete('category/'.$category->image);
        }

        if (Storage::disk('public')->exists('category/slider/'.$category->image))
        {
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }

        $category->delete();
        Toastr::success('Category Successfully Deleted :)','Success');
        return redirect()->back();


>>>>>>> 78134d595fe4aa8c57c6b996d9f2cdf52e2bd44d
    }
}
