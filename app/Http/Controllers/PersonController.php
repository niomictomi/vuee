<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Person;

class PersonController extends Controller
{
    public function all()
    {
        return Person::orderBy('id','DESC')->paginate(10);
    }

    public function search(Request $request)
    {
        return Person::where('first_name','LIKE','%'.$request->get('q').'%')
        ->orWhere('last_name','LIKE','%'.$request->get('q').'%')
        ->take(10)->get();
    }

    public function by_id($id)
    {
        return Person::find($id);
    }

    public function store(Request $request)
    {
        return Person::create($request->all());
    }

    public function update($id, Request $request)
    {
        $person = Person::find($id);
        $person->first_name = $request->input('first_name');
        $person->last_name = $request->input('last_name');
        $person->email = $request->input('email');
        $person->save();
        return $person;
    }

    public function delete($id){
        $person = Person::find($id);
        $person->delete();
        return ['status'=>'deleted'];
    }
}
