<?php

namespace App\Http\Controllers;

use App\Photo;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Session;

class AdminMediaController extends Controller
{
    public function index(){
//        $photos = Photo::all();
        $photos = Photo::paginate(10);  // pagination and all
        return view('admin.media.index',compact('photos'));
    }

    public function create(){
        return view('admin.media.create');
    }

    public function store(Request $request){

//        var_dump($request);
        $file = $request->file('file');
        $name = time() . $file->getClientOriginalName();
        $file->move('images',$name);
        $photo = Photo::create(['file'=>$name]);
    }

    public function destroy($id){
        $photo = Photo::findOrFail($id);
        unlink(public_path() . $photo->file);
        Session::flash('message','Photo "'. $photo->file .'" has been successfully deleted');
        $photo->delete();
        return redirect('admin/media');
    }
}
