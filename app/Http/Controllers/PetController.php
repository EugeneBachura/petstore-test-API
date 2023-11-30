<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;

class PetController extends Controller
{
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
            'photos' => 'required|array',
            'photos.*' => 'image|max:2000',
        ]);

        $pet = new Pet();
        $pet->name = $request->name;
        $pet->status = $request->status;

        $photoUrls = [];

        if ($request->hasFile('photos')) {
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('pets', 'public');
                $photoUrls[] = url('storage/' . $path);
            }
        }

        $pet->photoUrls = $photoUrls;

        $response = Http::put("https://petstore.swagger.io/v2/pet", $pet->toArray());

        if ($response->clientError()) {
            return redirect()->back()->withErrors(['Client error occurred.']);
        }

        if ($response->serverError()) {
            return redirect()->back()->withErrors(['Server error occurred.']);
        }

        if ($response->successful()) {
            return redirect()->route('pet.create')->with('success', 'Pet Added!');
        } else {
            return redirect()->route('pet.create')->withErrors(['Error Adding a Pet.']);
        }
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'status' => 'required|in:available,pending,sold',
            'photos' => 'sometimes|array',
            'photos.*' => 'image|max:2000',
        ]);

        $response = Http::get("https://petstore.swagger.io/v2/pet/{$id}");

        if (!$response->successful()) {
            return redirect()->route('pets.index')->withErrors(['Pet not found.']);
        }

        $petData = $response->json();
        $petData['name'] = $request->name;
        $petData['status'] = $request->status;

        if ($request->hasFile('photos')) {
            foreach ($petData['photoUrls'] as $url) {
                $path = str_replace(url('storage/'), '', $url);
                Storage::disk('public')->delete($path);
            }

            $photoUrls = [];
            foreach ($request->file('photos') as $photo) {
                $path = $photo->store('pets', 'public');
                $photoUrls[] = url('storage/' . $path);
            }

            $petData['photoUrls'] = $photoUrls;
        }

        $response = Http::put("https://petstore.swagger.io/v2/pet", $petData);

        if ($response->clientError()) {
            return redirect()->back()->withErrors(['Client error occurred.']);
        }

        if ($response->serverError()) {
            return redirect()->back()->withErrors(['Server error occurred.']);
        }

        if ($response->successful()) {
            return redirect()->route('pet.edit', $id)->with('success', 'Pet Updated!');
        } else {
            return redirect()->route('pet.edit', $id)->withErrors(['Error Updating Pet.']);
        }
    }


    public function edit($id)
    {
        $response = Http::get("https://petstore.swagger.io/v2/pet/$id");
        if ($response->successful()) {
            $pet = $response->json();
            return view('pet.edit', compact('pet'));
        } else {
            return back()->withErrors(['Error Getting Pet.']);
        }
    }

    public function findByStatus($status)
    {
        $response = Http::get("https://petstore.swagger.io/v2/pet/findByStatus", [
            'status' => $status
        ]);

        if ($response->successful()) {
            $pets = $response->json();
            return view('pet.index', compact('pets', 'status'));
        } else {
            return back()->withErrors(['Error Getting List of Pets.']);
        }
    }

    public function destroy($id)
    {
        $response = Http::delete("https://petstore.swagger.io/v2/pet/{$id}");

        if ($response->successful()) {
            return redirect()->back()->with('success', 'The Pet Was Successfully Removed.');
        } else {
            return redirect()->back()->withErrors(['Error When Deleting a Pet.']);
        }
    }

    public function show($petId)
    {
        $response = Http::get("https://petstore.swagger.io/v2/pet/{$petId}");

        if ($response->successful()) {
            $pet = $response->json();
            return view('pet.show', compact('pet'));
        } else {
            return redirect()->route('pets.index')->withErrors(['Pet not found.']);
        }
    }
}
