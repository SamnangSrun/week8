<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FeatureController extends Controller
{
    public function index()
    {
        $features = Feature::all();
        return view('features.index', compact('features'));
    }

    public function create()
    {
        return view('features.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $data = ['title' => $request->title];

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('features', 'public');
        }

        Feature::create($data);

        return redirect()->route('features.index')->with('success', 'Feature created successfully.');
    }

    public function edit($id)
    {
        $feature = Feature::findOrFail($id);
        return view('features.edit', compact('feature'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif',
        ]);

        $feature = Feature::findOrFail($id);
        $data = ['title' => $request->title];

        if ($request->hasFile('image')) {
            // Delete old image
            if ($feature->image && Storage::disk('public')->exists($feature->image)) {
                Storage::disk('public')->delete($feature->image);
            }

            // Upload new image
            $data['image'] = $request->file('image')->store('features', 'public');
        }

        $feature->update($data);

        return redirect()->route('features.index')->with('success', 'Feature updated successfully.');
    }

    public function destroy($id)
    {
        $feature = Feature::findOrFail($id);

        // Delete image from storage
        if ($feature->image && Storage::disk('public')->exists($feature->image)) {
            Storage::disk('public')->delete($feature->image);
        }

        $feature->delete();

        return redirect()->route('features.index')->with('success', 'Feature deleted successfully.');
    }
}
