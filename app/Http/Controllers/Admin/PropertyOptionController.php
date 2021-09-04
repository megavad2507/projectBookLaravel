<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PropertyOptionRequest;
use App\Models\Property;
use App\Models\PropertyOption;
use Illuminate\Http\Response;

class PropertyOptionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(Property $property)
    {
        $propertyOptions = $property->options()->orderBy('id','asc')->paginate(10);
        return view('admin.property_options.index',compact('property','propertyOptions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Property $property)
    {
        return view('admin.property_options.form-create',compact('property'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PropertyOptionRequest  $request
     * @param  Property  $property
     *
     * @return Response
     */
    public function store(PropertyOptionRequest $request, Property $property)
    {
        $params = $request->all();
        $params['property_id'] = $request->property->id;
        PropertyOption::create($params);
        return redirect()->route('property_options.index',$property);
    }

    /**
     * Display the specified resource.
     *
     * @param  PropertyOption  $propertyOption
     *
     * @return Response
     */
    public function show(Property $property,PropertyOption $propertyOption)
    {
        return view('admin.property_options.show',compact('property','propertyOption'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  PropertyOption  $propertyOption
     *
     * @return Response
     */
    public function edit(Property $property,PropertyOption $propertyOption)
    {
        return view('admin.property_options.form-create',compact('property','propertyOption'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PropertyOptionRequest  $request
     * @param  Property  $property
     * @param  PropertyOption  $propertyOption
     *
     * @return Response
     */
    public function update(PropertyOptionRequest $request,Property $property, PropertyOption $propertyOption)
    {
        $params = $request->all();
        $propertyOption->update($params);
        return redirect()->route('property_options.index',$property);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  PropertyOption  $propertyOption
     *
     * @return Response
     */
    public function destroy(Property $property,PropertyOption $propertyOption)
    {
        $propertyOption->delete();
        return redirect()->route('property_options.index',$property);
    }
}
