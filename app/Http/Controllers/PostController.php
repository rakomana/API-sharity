<?php

namespace App\Http\Controllers;
use App\Models\post;
use Auth;

use Illuminate\Http\Request;

class PostController extends Controller
{

    public function index()
    {
        //
        $user = post::where('user_id',Auth::user()->id)->get();
        
        return view('post.index', compact('user'));
    }
    public function create()
    {
        //
        return view('post.create');
    }
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'jobTitle'    =>  'required',
            'companyName'   =>  'required',
            'location'     =>  'required',
            'salary'       => 'required',
            'fullDescription'       => 'required',
            'experience'       => 'required',
            'skills'       => 'required',
            'phoneNumber'       => 'required',
            'email'       => 'required',
            'type'       => 'required',

        ]);
        $post = new post([
            'jobTitle'    =>  $request->get('jobTitle'),
            'companyName'  =>  $request->get('companyName'),
            'location'    =>  $request->get('location'),
            'salary'      =>  $request->get('salary'),
            'fullDescription'      =>  $request->get('fullDescription'),
            'experience'      =>  $request->get('experience'),
            'skills'      =>  $request->get('skills'),
            'phoneNumber'      =>  $request->get('phoneNumber'),
            'email'      =>  $request->get('email'),
            'type'      =>  $request->get('type'),
            'user_id'      =>  $request->get('user_id'),


        ]);
        $post->save();
        return redirect()->route('post.index')->with('success', 'Data Added');
    }

    public function show()
    {
        //
        $r = post::all();
        return view('index')->with('r',$r);
    }
    public function details($id)
    {
        //
        $post = post::find($id);
        return view('post.single', compact('post', 'id'));
    }
    public function edit($id)
    {
        //
        $post = post::find($id);
        return view('post.edit', compact('post', 'id'));
    }

    public function update(Request $request, $id)
    {
        //
        $this->validate($request, [
            'jobTitle'    =>  'required',
            'companyName'   =>  'required',
            'location'     =>  'required',
            'salary'       => 'required',
            'fullDescription'       => 'required',
            'experience'       => 'required',
            'skills'       => 'required',
            'phoneNumber'       => 'required',
            'email'       => 'required',
            'type'       => 'required',

        ]);
        $post = post::find($id);
        $post->jobTitle = $request->get('jobTitle');
        $post->companyName = $request->get('companyName');
        $post->location = $request->get('location');
        $post->salary = $request->get('salary');
        $post->fullDescription = $request->get('fullDescription');
        $post->experience = $request->get('experience');
        $post->skills = $request->get('skills');
        $post->phoneNumber = $request->get('phoneNumber');
        $post->email = $request->get('email');
        $post->email = $request->get('type');

        $post->save();
        return redirect()->route('post.index')->with('success', 'Data Updated');
    }


    public function destroy($id)
    {
        //
        $post = post::find($id);
        $post->delete();
        return redirect()->back();
    }
}
