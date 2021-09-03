<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Quote;
use App\Video;
use App\Http\Controllers\Auth;
use Illuminate\Support\Facades\Hash;
use DataTables;
use FideloperProxyTrustProxies as Middleware;


class SiteController extends Controller
{
    protected $proxies = '*';
    protected $headers = Request:: HEADER_X_FORWARDED_AWS_ELB;

    
    public function quote_index(){
        $quote = DB::table('quote')->all();
        return view('quote.index',['quote'=>'$quote']);
    }
    
    public function edit($param) {
        
    }

    
    public function index($id=0)
    {
        
     $arrClient= DB::select(DB::raw("SELECT * FROM client")); 
     $arrCms = DB::select(DB::raw("SELECT * FROM cms WHERE type='services'"));
     $arrConfig = DB::select(DB::raw("SELECT *FROM configuration"));
     $arrGallery = DB::select(DB::raw("SELECT * FROM gallery WHERE type='portfolio'"));
     $arrMenu = DB::select(DB::raw("SELECT * FROM menu order BY menu_order ASC "));
     $arrSlider = DB::select(DB::raw("SELECT * FROM slider"));
     $arrSocial = DB::select(DB::raw("SELECT * FROM socialmedia"));
     $arrTextblock= DB::select(DB::raw("SELECT * FROM cms WHERE id='52'"));
     $arrAbout=DB::select(DB::raw("SELECT * FROM cms  WHERE  type='company'"));
     $arrTestimonial=DB::select(DB::raw("SELECT * FROM testimonial"));
     $arr_Bott_Menu= DB::select(DB::raw("SELECT * FROM menu WHERE  location='bottom'"));


      return view('site.home',['arrCms'=>$arrCms,'arrConfig'=>$arrConfig[0],'arrGallery'=>$arrGallery,'arrMenu'=>$arrMenu,'arrSlider'=>$arrSlider,'arrSocial'=>$arrSocial,'arrClient'=>$arrClient,'arrTextblock'=>$arrTextblock[0],
          'arrAbout'=>$arrAbout[0],'arrTestimonial'=>$arrTestimonial,'arr_Bott_Menu'=>$arr_Bott_Menu] );

    }



    public function quote() {

        $arrStatus = array(
            "Proposed", "Active", "On Hold", "Completed", "Canceled", "Archived"
        );
        return view('quote.index',["arrStatus"=>$arrStatus]);
    }

    public function videoindex($id = null){


            return view('quote.video');
    }

   public function quote_update(Request $request ,$id = null)
    {
                 $data = $request->all();
                  $VL_id =   $data['id'];
                //parse_str($_POST['data'], $data);
     if(!empty($VL_id))

        {


     unset($data['id']);
     unset($data['_token']);

         if($data){
      $image = $request->file('video');
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('video'), $new_name);
       $data['video'] =  $new_name;
                       $arrFinalData = $data;
                DB::table("video")
                ->where("id",$VL_id)
                ->update($arrFinalData);
              }
        }
        else{
            unset($data['id']);
            unset($data['_token']);

            if($data){
      $image = $request->file('video');
      $new_name = rand() . '.' . $image->getClientOriginalExtension();
      $image->move(public_path('video'), $new_name);
       $data['video'] =  $new_name;
                       $arrFinalData = $data;

            DB::table("video")
                ->insert($arrFinalData);
                }
        }
         if(!empty($id))

        {
        $data =   Video::find($id);

        return view('quote.video' , ['data' => $data]);
         }
        return response()->json([
            "status"=>1
        ]);


    }

    public function update_video(Request $request) {
        $data = $request->all();
          if($data){
              unset($data['_token']);
       if ($request->hasFile('video')) {

            $file = $request->file('video');
            $path = 'video/';
            $filenameWithExt = $file->getClientOriginalName();
            $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);
            $extension = 'webm';
            $fileNameToStore = preg_replace('/\s+/', '_', $filename . '_' . time() . '.' . $extension);

            \Storage::disk('public')->putFileAs($path, $file, $fileNameToStore);
            $file->move(public_path('video'), $fileNameToStore);
       $data['video'] =  $fileNameToStore;
                       $arrFinalData = $data;

            DB::table("video")
                ->insert($arrFinalData);
                }    }

       return response()->json([
            "status"=>1
        ]);


    }

    public function quote_delete($id) {

        $obj = Video::find($id);
        $obj->delete();
        return $id;
    }

    public function quote_data(Request $request) {
          //   $items = Quote::select('quote.*');
        if ($request->ajax()) {
            $data = Video::latest()->get();

            return Datatables::of($data)
                ->addIndexColumn()
                 ->addColumn('video', function ($row) {
                            $url = asset("public/video/$row->video");
                            $video = '<video width="200" height="100" align="center" controls><source src=' . $url . ' ></video>';
                             return $video;

                        })
                ->addColumn('action', function($row){
                    $actionBtn = '<a class="edit btn btn-success btn-sm" onclick="editData('.$row->id.')"  href="javascript:;"><i class="fa fa-pencil m-r-5"></i> Edit</a> <a href="#" class="delete btn btn-danger btn-sm" data-remote="' . route('quote_delete', ['id' => $row->id]) . '"><i class="fa fa-trash-o m-r-5"></i> Delete</a>';
                    return $actionBtn;
                })
                ->rawColumns(['video','action'])
                ->make(true);
        }
    }

    public function quote_form(Request $request) {
        $arrRules = array(
            'name'=>'required',
            'email'=>'required',
            'company'=>'required',
            'phone'=>'required',
            'message'=>'required',
        );
        $this->validate(request(),$arrRules);
         $objRequest=$request->all();

         Quote::create($objRequest);
         return redirect()->route('site');
    }

        public function quote_add(Request $request) {
        $arrRules = array(
            'name'=>'required',
            'email'=>'required',
            'company'=>'required',
            'phone'=>'required',
            'message'=>'required',
        );
        $this->validate(request(),$arrRules);
         $objRequest=$request->all();
         
         Quote::create($objRequest);
         return redirect()->back()->with('msg' ,'sucsses ful add');
    }
    
     public function quote_edit($id = null) {
        $arrData = Quote::find($id);
        
        return view('quote.edit', ['arrData' => $arrData]);
    }
    
    public function redrit() {
        return view('quote.add');
    }
    
    

}