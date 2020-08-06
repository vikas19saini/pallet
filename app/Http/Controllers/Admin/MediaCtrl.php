<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;

class MediaCtrl extends Controller
{

    public function index(Request $request)
    {
        $data['mediaList'] = Media::paginate(50);
        return view('admin.media.list')->with($data);
    }

    public function add()
    {
        $data['type'] = ['IMAGE'];
        $data['media'] = null;
        return view('admin.media.edit')->with($data);
    }

    public function edit($id)
    {
        $data['type'] = ['IMAGE'];
        $data['media'] = Media::find($id);
        return view('admin.media.edit')->with($data);
    }

    public static function getMediaObj($request) 
    {
        $media = new Media();
        $media->title = $request->post('title');
        $media->caption = $request->post('caption');
        $media->alt = $request->post('alt');
        $media->type = $request->post('type');
        return $media; 

    }
    public function create(Request $request)
    {
        $allowedfileExtension=['jpeg','jpg','png'];
        $files = $request->file('attachment');
        if($request->has('attachment'))
        {
            foreach($files as $file){ 
                $newMedia = self::getMediaObj($request); 
                $filename = $file->getClientOriginalName();
                $extension = $file->getClientOriginalExtension();
                $check=in_array($extension,$allowedfileExtension);
                if($check) 
                {                
                    $name = "m-".str_random(3)."-".time().".".$extension;
                    $file->storeAs('public/media',$name);
                    $newMedia->location = "storage/media/".$name;
                    $newMedia->save();
                }
            }        
        }
        else
        {
            return redirect()->back()->with('message','Attachment is necessary');
        }


        return redirect('admin/media/upload');
    }


    public function update(Request $request,$id)
    {
        $media = Media::find($id);

        if(!$media)
            return redirect()->back()->with('message','Media record not found');

        $media->title = $request->post('title');
        $media->caption = $request->post('caption');
        $media->alt = $request->post('alt');
        $media->type = $request->post('type');

        if($request->has('attachment'))
        {
            $name = "m-".str_random(3)."-".time().".png";
            $request->file('attachment')->storeAs('public/media',$name);
            $media->location = "storage/media/".$name;
        }

        $media->save();

        return redirect('admin/media/upload');
    }

    public function search(Request $request)
    {
        $query = $request->get('q'); 

        $list = Media::where('title','like','%'.$query.'%')->get(); 

        return $list; 

    }

    public function delete($id)
    {
        $media = Media::find($id); 
        if(!$media) 
            return response()->json([
                'status' => false,
                'message' => "Unable to deleted Media"
            ]); 

        $media->delete(); 
        return response()->json([
            'status' => true
        ]); 

    }

}
