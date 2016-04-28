<?php

namespace Furbook\Http\Controllers;

use Furbook\Cat;
use Furbook\Http\Requests\SaveCatRequest;
use Illuminate\Http\Request;

use Furbook\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class CatController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'admin'], ['except' => ['index', 'show']]);
    }

    public function index()
    {
        $cats = Cat::all();
        return view('cats.index')->with('cats', $cats);
    }

    public function create()
    {
        return view('cats.create');
    }

    public function store(SaveCatRequest $request)
    {
        $inputs = $request->all();
        $user = Auth::user();
        $inputs['user_id'] = $user->id;
        $cat = Cat::create($inputs);
        return redirect('cat/' . $cat->id)
            ->withSuccess('Cat has been created.');
    }

    public function show($cat)
    {
        return view('cats.show')->with('cat', $cat);
    }

    public function edit($cat){
        return view('cats.edit')->with('cat', $cat);
    }

    public function update(SaveCatRequest $request, Cat $cat){
        $cat->update($request->all());
        return redirect('cat/' . $cat->id)
            ->withSuccess('Cat has been updated.');
    }
    
    public function destroy($cat){
        $cat->delete();
        return redirect('cat')
            ->withSuccess('Cat has been deleted.');
    }
}
