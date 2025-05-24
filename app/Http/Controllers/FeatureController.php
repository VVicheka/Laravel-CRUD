<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feature;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class FeatureController extends Controller
{
    public function index(Request $request)
    {
        // Authorize 'viewAny' action
        $this->authorize('viewAny', Feature::class);

        $order = $request->get('order', 'asc');
        $features = Feature::orderBy('id', $order)->get();
        
        return view('features.index', compact('features', 'order'));
    }

    public function display()
    {
        // Authorize 'viewAny' action
        $this->authorize('viewAny', Feature::class);

        $features = Feature::orderBy('id', 'asc')->get();
        return view('features.features', ['features' => $features]);
    }

    public function create()
    {
        // Authorize 'create' action
        $this->authorize('create', Feature::class);

        return view('features.create');
    }

    public function store(Request $request)
    {
        // Authorize 'create' action
        $this->authorize('create', Feature::class);

        $data = $request->validate([
            'name' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }
        
        $data['user_id'] = Auth::id();

        $newFeature = Feature::create($data);

        return redirect(route('features.index'))->with('success', 'Feature created successfully');
    }

    public function edit(Feature $feature)
    {
        // Authorize 'update' action
        $this->authorize('update', $feature);

        return view('features.edit', ['feature' => $feature]);
    }

    public function update(Feature $feature, Request $request)
    {
        // Authorize 'update' action
        $this->authorize('update', $feature);

        $data = $request->validate([
            'name' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($feature->image && Storage::disk('public')->exists($feature->image)) {
                Storage::disk('public')->delete($feature->image);
            }
            
            // Store new image
            $path = $request->file('image')->store('images', 'public');
            $data['image'] = $path;
        }

        $feature->update($data);

        return redirect(route('features.index'))->with('success', 'Feature Updated Successfully');
    }

    public function destroy(Feature $feature)
    {
        // Authorize 'delete' action
        $this->authorize('delete', $feature);

        $feature->delete();
        return redirect(route('features.index'))->with('success', 'Feature Deleted Successfully');
    }
}