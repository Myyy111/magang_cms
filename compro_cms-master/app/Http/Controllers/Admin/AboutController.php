<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\About;
use App\Traits\ContentProcessor;
use Toastr;
use Image;
use File;

class AboutController extends Controller
{
    use ContentProcessor;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Module Data
        $this->title = trans_choice('dashboard.about', 1);
        $this->route = 'admin.about';
        $this->view = 'admin.about';
        $this->path = 'about';
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

        $data['row'] = About::first();

        return view($this->view.'.index', $data);
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
            'title' => 'required|max:191',
            'description' => 'required',
            'image' => 'nullable|image',
            'video_id' => 'nullable|max:100',
        ]);


        $id = $request->id;


        // Image upload, fit and store inside public folder 
        if($request->hasFile('image')){

            //Delete Old Image
            $old_file = About::find($id);

            if(isset($old_file->image_path)){
                $file_path = public_path('uploads/'.$this->path.'/'.$old_file->image_path);
                if(File::isFile($file_path)){
                    File::delete($file_path);
                }
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

            if (extension_loaded('gd') || extension_loaded('imagick')) {
                Image::make($request->file('image')->getRealPath())->resize(600, 600, function ($constraint) { $constraint->aspectRatio(); })->save($thumbnailpath);
            } else {
                $request->file('image')->move($path, $fileNameToStore);
            }
        }
        else{

            $old_file = About::find($id);

            if(isset($old_file->image_path)){
                $fileNameToStore = $old_file->image_path; 
            }
            else {
                $fileNameToStore = Null;
            }
            
        }


        // Get content with media file
        $processed_description = $this->processInnerImages($request->input('description'));



        // -1 means no data row found
        if($id == -1){
            // Insert Data
            $data = new About;
            $data->title = $request->title;
            $data->slug = Str::slug($request->title, '-');
            $data->description = $processed_description;
            $data->image_path = $fileNameToStore;
            $data->video_id = $request->video_id;
            $data->mission_title = $request->mission_title;
            $data->mission_desc = $request->mission_desc;
            $data->vision_title = $request->vision_title;
            $data->vision_desc = $request->vision_desc;
            $data->status = $request->status;
            $data->save();
        }
        else{
            // Update Data
            $data = About::find($id);
            $data->title = $request->title;
            $data->slug = Str::slug($request->title, '-');
            $data->description = $processed_description;
            $data->image_path = $fileNameToStore;
            $data->video_id = $request->video_id;
            $data->mission_title = $request->mission_title;
            $data->mission_desc = $request->mission_desc;
            $data->vision_title = $request->vision_title;
            $data->vision_desc = $request->vision_desc;
            $data->status = $request->status;
            $data->save();
        }


        Toastr::success(__('dashboard.updated_successfully'), __('dashboard.success'));

        return redirect()->route($this->route.'.index');
    }
}
