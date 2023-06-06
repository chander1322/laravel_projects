<?php
namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    #registraion
    public function insert_user(Request $req){
         $req->validate([
            'name'=>'required',
            'email'=>'required',
            'password'=>'required|min:4|max:16',
            'confirm_password'=>'required|same:password'
        ]);
         $data=[
            'name'=>$req->name,
            'email'=>$req->email,
            'password'=>Hash::make($req->password),
        ];
        User::create($data);  
        return back()->with('success','You are Registered');
    }

    #Login user
    public function login_user(Request $request)
    {
         $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        if (Auth::attempt(['email'=>$request->email,'password'=>$request->password])) {
            $request->session()->regenerate();
            return redirect('dashboard');
        }
    }

    #Register view
    public function register_user(){
        return view('auth/register');
    }
    #login view
    public function login_Form(){
        return view('auth/login');
    }
    #dashboard view using middlewere
    public function dashboard(){
        return view('adminDashboard');
    }
    #show all post
    public function all_post(){
        $data=Post::paginate(5);
        return view('allpost',compact('data'));
    }

    #Register a new Post
    public function imagepost(Request $request){
        $title= $request->title;
        $desc= $request->desc;
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
            $data=['title'=>$title,'description'=>$desc,'image'=>$imageName];
            Post::create($data);
            return response()->json(['success' => true, 'message' => $data]);
        }
        return response()->json(['success' => false]);
    }

    #dalete a post
    public function delete($id=null)
    {
        $data = Post::find($id);
        if (!$data) {
            return response()->json(['success' => false, 'message' => 'Data not found.']);
        }
        $data->delete();
        return response()->json(['success' => true, 'message' => 'Data deleted successfully.']);
    }

    #edit a row
    public function postupdata($id=null){
        $edit= Post::where('id',$id)->get();
        return view('updatepost',compact('edit'));
    }
    
    #update post
    public function updatepost(Request $request){
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('uploads'), $imageName);
        }
        $update=Post::where('id',$request->id)->update(['title'=>$request->title,'description'=>$request->desc,'image'=>$request->image]);
        if($update){
            return response()->json(['success' => true, 'message' => " post update successfully"]);

        }else{
            return response()->json(['success' => false]);
        }

    }
    #logout user
    public function Logout(){
        Auth::logout(); 
        return redirect('login');
    }
}
