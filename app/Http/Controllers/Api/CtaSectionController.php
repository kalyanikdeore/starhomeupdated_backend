<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use App\Models\CtaSection;
use Illuminate\Http\Request;

class CtaSectionController extends Controller
{
    /**
     * Display the active CTA section.
     */
    public function showActive()
    {
        $ctaSection = CtaSection::where('is_active', true)->first();
        
        if (!$ctaSection) {
            return response()->json([
                'message' => 'No active CTA section found'
            ], 404);
        }
        
        return response()->json($ctaSection);
    }

    /**
     * Display a listing of the resource (optional, for admin purposes).
     */
    public function index()
    {
        $ctaSections = CtaSection::all();
        
        return response()->json($ctaSections);
    }

    /**
     * Store a newly created resource in storage (optional).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image_url' => 'required|url|max:255',
            'phone_number' => 'required|string|max:20',
            'is_active' => 'boolean'
        ]);

        $ctaSection = CtaSection::create($validated);

        return response()->json($ctaSection, 201);
    }

    /**
     * Display the specified resource (optional).
     */
    public function show($id)
    {
        $ctaSection = CtaSection::find($id);
        
        if (!$ctaSection) {
            return response()->json([
                'message' => 'CTA section not found'
            ], 404);
        }
        
        return response()->json($ctaSection);
    }

    /**
     * Update the specified resource in storage (optional).
     */
    public function update(Request $request, $id)
    {
        $ctaSection = CtaSection::find($id);
        
        if (!$ctaSection) {
            return response()->json([
                'message' => 'CTA section not found'
            ], 404);
        }

        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'description' => 'sometimes|required|string',
            'image_url' => 'sometimes|required|url|max:255',
            'phone_number' => 'sometimes|required|string|max:20',
            'is_active' => 'sometimes|boolean'
        ]);

        $ctaSection->update($validated);

        return response()->json($ctaSection);
    }

    /**
     * Remove the specified resource from storage (optional).
     */
    public function destroy($id)
    {
        $ctaSection = CtaSection::find($id);
        
        if (!$ctaSection) {
            return response()->json([
                'message' => 'CTA section not found'
            ], 404);
        }

        $ctaSection->delete();

        return response()->json([
            'message' => 'CTA section deleted successfully'
        ]);
    }
}