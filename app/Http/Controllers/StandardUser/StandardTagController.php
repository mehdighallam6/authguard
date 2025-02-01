<?php

namespace App\Http\Controllers\StandardUser;

use App\Models\Tag;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Gate;

class StandardTagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $tags = Tag::latest()
            ->when($request->has('search'), fn($query) => $query->where('name', 'like', "%{$request->search}%"))
            ->where('user_id', auth()->id())
            ->paginate(10)
            ->withQueryString();
        return Inertia::render('StandardUser/Tags/Index', [
            'tags' => $tags
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('StandardUser/Tags/Create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
        ]);

        Tag::create([
            'name' => $request->name,
            'user_id' => auth()->user()->id,
        ]);

        return to_route('stags.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tag $tag)
    {
        Gate::authorize('update', $tag);

        return Inertia::render('StandardUser/Tags/Edit', [
            'tag' => $tag,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        Gate::authorize('update', $tag);

        $request->validate([
            'name' => 'required',
        ]);

        $tag->update([
            'name' => $request->name,
        ]);

        return to_route('stags.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        Gate::authorize('delete', $tag);

        $tag->delete();
        return to_route('stags.index');
    }
}
