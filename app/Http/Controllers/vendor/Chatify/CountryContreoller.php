<?php

// app/Http/Controllers/CountryController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Country;

class CountryController extends Controller
{
    public function index()
    {
        $countries = Country::all();
        return view('countries.index', compact('countries'));
    }

    public function create()
    {
        return view('countries.create');
    }

    public function store(Request $request)
    {
        Country::create($request->all());
        return redirect()->route('countries.index');
    }

    public function edit($id)
    {
        $country = Country::find($id);
        return view('countries.edit', compact('country'));
    }

    public function update(Request $request, $id)
    {
        $country = Country::find($id);
        $country->update($request->all());
        return redirect()->route('countries.index');
    }

    public function destroy($id)
    {
        Country::destroy($id);
        return redirect()->route('countries.index');
    }
}