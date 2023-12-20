<?php

namespace App\Http\Controllers;

use App\Http\Requests\PropertyFormRequest;
use App\Http\Resources\PropertyResource;
use App\Models\Property;
use Illuminate\Http\Request;

class PropertyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return PropertyResource::collection(Property::all());
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(PropertyFormRequest $request)
    {
        $property = Property::create([
            'broker_id' => $request->broker_id,
            'address' => $request->address,
            'listing_type' => $request->listing_type,
            'city' => $request->city,
            'zip_code' => $request->zip_code,
            'description' => $request->description,
            'build_year' => $request->build_year,
        ]);
        $property->characteristic()->create([
            'price' => $request->price,
            'bedrooms' => $request->bedrooms,
            'bathrooms' => $request->bathrooms,
            'sqft' => $request->sqft,
            'price_sqft' => $request->price_sqft,
            'property_type' => $request->property_type,
            'status' => $request->status,
        ]);
        return new PropertyResource($property);
    }

    /**
     * Display the specified resource.
     */
    public function show(Property $property)
    {
        return new PropertyResource($property);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(PropertyFormRequest $request, Property $property)
    {
        $property->update($request->only(['address', "listing_type", "description", "city", "zip_code", "build_year", "broker_id"]));
        $property->characteristic()->update($request->only(['property_type', 'price', 'bedrooms', 'bathrooms', 'price_sqft', 'sqft', 'status']));
        return new PropertyResource($property);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Property $property)
    {
        $property->delete();
        return response()->json([
            'success' => true,
            'message' => 'Property has been deleted'
        ]);
    }
}
