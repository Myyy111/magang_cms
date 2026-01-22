<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use Toastr;
use Image;
use File;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = 'Products';
        $this->route = 'admin.product';
        $this->view = 'admin.product';
        $this->path = 'product';
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['rows'] = Product::orderBy('id', 'desc')->get();

        return view($this->view.'.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;

        return view($this->view.'.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:products,title',
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'description' => 'required',
            'image' => 'required|image',
        ]);

        // image upload, fit and store inside public folder 
        if($request->hasFile('image')){
            //Upload New Image
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Crete Folder Location
            $path = public_path('uploads/'.$this->path.'/');
            if (! File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            //Resize And Crop as Fit image here (800 width, 500 height)
            $thumbnailpath = $path.$fileNameToStore;
            if (extension_loaded('gd') || extension_loaded('imagick')) {
                Image::make($request->file('image')->getRealPath())->fit(800, 800, function ($constraint) { $constraint->upsize(); })->save($thumbnailpath);
            } else {
                $request->file('image')->move($path, $fileNameToStore);
            }
        }
        else{
            $fileNameToStore = 'noimage.jpg'; // if no image selected this will be the default image
        }

        // Insert Data
        $product = new Product;
        $product->title = $request->title;
        $product->slug = Str::slug($request->title, '-');
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->image_path = $fileNameToStore;
        $product->status = 1;
        $product->save();

        Toastr::success(__('dashboard.created_successfully'), __('dashboard.success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return redirect()->route($this->route.'.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
        $data['title'] = $this->title;
        $data['route'] = $this->route;
        $data['view'] = $this->view;
        $data['path'] = $this->path;

        $data['row'] = $product;

        return view($this->view.'.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        // Field Validation
        $request->validate([
            'title' => 'required|max:191|unique:products,title,'.$product->id,
            'price' => 'required|numeric',
            'stock' => 'required|numeric|min:0',
            'description' => 'required',
            'image' => 'nullable|image',
        ]);

        // image upload, fit and store inside public folder 
        if($request->hasFile('image')){

            $file_path = public_path('uploads/'.$this->path.'/'.$product->image_path);
            if(File::isFile($file_path)){
                File::delete($file_path);
            }

            //Upload New Image
            $filenameWithExt = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME); 
            $extension = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $filename.'_'.time().'.'.$extension;

            //Crete Folder Location
            $path = public_path('uploads/'.$this->path.'/');
            if (! File::exists($path)) {
                File::makeDirectory($path, 0777, true, true);
            }

            //Resize And Crop as Fit image here (800 width, 800 height)
            $thumbnailpath = $path.$fileNameToStore;
            if (extension_loaded('gd') || extension_loaded('imagick')) {
                Image::make($request->file('image')->getRealPath())->fit(800, 800, function ($constraint) { $constraint->upsize(); })->save($thumbnailpath);
            } else {
                $request->file('image')->move($path, $fileNameToStore);
            }
        }
        else{
            $fileNameToStore = $product->image_path; 
        }

        // Update Data
        $product->title = $request->title;
        $product->slug = Str::slug($request->title, '-');
        $product->description = $request->description;
        $product->price = $request->price;
        $product->stock = $request->stock;
        $product->image_path = $fileNameToStore;
        $product->status = $request->status;
        $product->save();

        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->route($this->route.'.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        // Delete Data
        $image_path = public_path('uploads/'.$this->path.'/'.$product->image_path);
        if(File::isFile($image_path)){
            File::delete($image_path);
        }

        $product->delete();

        Toastr::success(__('dashboard.deleted_successfully'), __('dashboard.success'));

        return redirect()->back();
    }
}
