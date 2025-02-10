<?php

namespace App\Http\Controllers\StandardUser;

use App\Models\Authenticator;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Http\Controllers\Controller;
use App\Models\Tag;

class StandardAuthenticatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $authenticators = Authenticator::latest()
            ->when($request->has('search'), fn($query) => $query->where('name', 'like', "%{$request->search}%"))
            ->where('user_id', auth()->id())
            ->with('tag:id,name')
            ->paginate(10)
            ->withQueryString();
        return Inertia::render('StandardUser/Authenticators/Index', [
            'authenticators' => $authenticators
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return Inertia::render('StandardUser/Authenticators/Create', [
            'tags' => Tag::latest()->where('user_id',  auth()->id())->select(['id', 'name'])->get()->prepend(['id' => null, 'name' => 'Select Tag']),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'key' => 'required', // special validation should be created
            'tag_id' => 'nullable|numeric|exists:tags,id',
        ]);

        $request->merge([
            'user_id' => auth()->id(),
        ]);

        Authenticator::create($request->all());

        return to_route('sauthenticators.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Authenticator $authenticator)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Authenticator $authenticator)
    {
        return Inertia::render('StandardUser/Authenticators/Edit', [
            'authenticator' => $authenticator,
            'tags' => Tag::latest()->where('user_id',  auth()->id())->select(['id', 'name'])->get()->prepend(['id' => null, 'name' => 'Select Tag']),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Authenticator $authenticator)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'key' => 'nullable|string',
            'tag_id' => 'nullable|numeric|exists:tags,id',
        ]);

        if (!$request->key) {
            $validated['key'] = $authenticator->key;
        }

        $authenticator->update($validated);

        return to_route('sauthenticators.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Authenticator $authenticator)
    {
        //
    }
}
