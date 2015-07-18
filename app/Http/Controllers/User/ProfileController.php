<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\User;
use App\CV;

class ProfileController extends Controller
{
    public function __construct(Request $request)
    {
        $this->request=$request;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function getIndex()
    {
       return view('auth/profile');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return redirect
     */
    public function postUpdate()
    {
        $user=User::find(Auth::user()->id);

        $this->validate($this->request, [
            'name' => 'required|max:255',
        ]);
        $user->name = $this->request->input('name');
        if($this->request->input('email') != Auth::user()->email) {
            $this->validate($this->request, [
                'email' => 'required|email|max:255|unique:users',
            ]);
            $user->email = strtolower($this->request->input('email'));
        }
        if($this->request->input('password') != "" ) {
            $this->validate($this->request, [
                'password' => 'min:6',
            ]);
            $user->password = bcrypt( $this->request->input('password') );
        }
        $user->update();
        Auth::setUser($user);
        return redirect('profile');
    }

    /**
     * Publish cv
     *
     * @param  int  $id
     * @return redirect
     */
    public function postPublish()
    {
        $cv=CV::where('user_id','=',Auth::user()->id)->first();

        if($cv->slug != $this->request->input('slug')) {
            $this->validate($this->request, [
                'slug' => 'required|max:255|alpha_dash|unique:cvs|'+
                'not_in:auth,password,profile,admin,home,api',
            ]);
        }
        $cv->slug = strtolower($this->request->input('slug'));
        $cv->published=true;
        $cv->save();
        return redirect('profile');
    }

    /**
     * UnPublish cv
     *
     * @param  int  $id
     * @return redirect
     */
    public function postUnpublish()
    {
        $cv=CV::where('user_id','=',Auth::user()->id)->first();

        $cv->published=false;
        $cv->save();
        return redirect('profile');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return redirect
     */
    public function postDestroy()
    {
        User::destroy(Auth::user()->id);

       return redirect('/');
    }

    /**
     *  Redirects to profile
     *
     * @return redirect
     */
    public function getUpdate()
    {
       return redirect('profile');
    }
}
