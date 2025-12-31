<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CompanyController extends Controller
{
    /**
     * Display a listing of companies.
     */
    public function index()
    {
        $companies = Company::latest()->paginate(10);
        return view('companies.index', compact('companies'));
    }

    /**
     * Show the form for creating a new company.
     */
    public function create()
    {
        return view('companies.create');
    }

    /**
     * Store a newly created company in database.
     */
    public function store(Request $request)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:companies,email',
            'website' => 'nullable|url|max:255|unique:companies,website',
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
        ], [
            'name.required' => 'Company name is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'website.url' => 'Please enter a valid URL (e.g., https://example.com).',
            'website.unique' => 'This website is already registered.',
            'logo.image' => 'Logo must be an image file.',
            'logo.mimes' => 'Logo must be a file of type: jpeg, png, jpg, gif, svg.',
            'logo.max' => 'Logo size must not exceed 2MB.',
            'logo.dimensions' => 'Logo dimensions must be at least 100x100 pixels.',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        // Create company
        Company::create($validated);

        return redirect()->route('companies.index')
            ->with('success', 'Company created successfully!');
    }

    /**
     * Display the specified company.
     */
    public function show(Company $company)
    {
        return view('companies.show', compact('company'));
    }

    /**
     * Show the form for editing the specified company.
     */
    public function edit(Company $company)
    {
        // dd(compact('company'));
        return view('companies.edit', compact('company'));
    }

    /**
     * Update the specified company in database.
     */
    public function update(Request $request, Company $company)
    {
        // Validate input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|max:255|unique:companies,email,' . $company->id,
            'website' => 'nullable|url|max:255|unique:companies,website,' . $company->id,
            'logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048|dimensions:min_width=100,min_height=100',
        ], [
            'name.required' => 'Company name is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'website.url' => 'Please enter a valid URL (e.g., https://example.com).',
            'website.unique' => 'This website is already registered.',
            'logo.image' => 'Logo must be an image file.',
            'logo.mimes' => 'Logo must be a file of type: jpeg, png, jpg, gif, svg.',
            'logo.max' => 'Logo size must not exceed 2MB.',
            'logo.dimensions' => 'Logo dimensions must be at least 100x100 pixels.',
        ]);

        // Handle logo upload
        if ($request->hasFile('logo')) {
            // Delete old logo if exists
            if ($company->logo && Storage::disk('public')->exists($company->logo)) {
                Storage::disk('public')->delete($company->logo);
            }

            // Store new logo
            $logoPath = $request->file('logo')->store('logos', 'public');
            $validated['logo'] = $logoPath;
        }

        // Update company
        $company->update($validated);

        return redirect()->route('companies.index')
            ->with('success', 'Company updated successfully!');
    }

    /**
     * Remove the specified company from database.
     */
    public function destroy(Company $company)
    {
        // Delete logo if exists
        if ($company->logo && Storage::disk('public')->exists($company->logo)) {
            Storage::disk('public')->delete($company->logo);
        }

        // Delete company
        $company->delete();

        return redirect()->route('companies.index')
            ->with('success', 'Company deleted successfully!');
    }
}