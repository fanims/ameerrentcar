<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\Admin\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }


    public function index()
    {
        $brands = $this->brandService->index();
        return view('admin.brands.index', compact('brands'));
    }

    public function create()
    {
        $users = User::all();
        return view('admin.brands.create', compact('users'));
    }

    public function store(Request $request)
    {
        try {
            $this->brandService->store($request);
            return redirect()->route('brand.index')->with('success', 'Brand created successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }


    public function edit($id)
    {
        $brand = $this->brandService->find($id);
        $users = User::all();
        return view('admin.brands.edit', compact('brand', 'users'));
    }

    public function update(Request $request, $id)
    {
        try {
            $this->brandService->update($request, $id);
            return redirect()->route('brand.index')->with('success', 'Brand updated successfully.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()->withErrors($e->validator)->withInput();
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy($id)
    {
        try {
            $this->brandService->delete($id);
            return redirect()->route('brand.index')->with('success', 'Brand deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to delete brand: ' . $e->getMessage());
        }
    }
}
