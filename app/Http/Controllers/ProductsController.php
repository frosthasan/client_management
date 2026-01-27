<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\ProductGroup;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductsController extends Controller
{
    public function index()
    {
        $products = Product::with('productGroup')->latest()->paginate(10);
        $totalProducts = Product::count();

        return view('product.product', compact('products', 'totalProducts'));
    }

    public function add_product()
    {
        $productGroups = ProductGroup::where('is_active', true)
            ->orderBy('group_name')
            ->get();
        return view('product.add-product', compact('productGroups'));
    }

    public function product_group()
    {
        $productGroups = ProductGroup::latest()->paginate(10);
        $totalUsers = ProductGroup::count();

        return view('product.product-group', compact('productGroups', 'totalUsers'));
    }

    public function add_product_group()
    {
        return view('product.add-product-group');
    }

    public function product_store(Request $request)
    {
        // dd($request);
        try {
            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'product_group_id' => 'required|exists:product_groups,id',
                'pricing_type' => 'required|in:one_time,recurring,both',
                'setup_fee' => 'nullable|numeric|min:0',
                'status' => 'required|in:0,1,2',
                'version' => 'nullable|string|max:50',
                'description' => 'nullable|string',

                // Conditional validation based on pricing type
                'price_one_time' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    function ($attribute, $value, $fail) use ($request) {
                        $pricingType = $request->input('pricing_type');
                        if (in_array($pricingType, ['one_time', 'both']) && empty($value)) {
                            $fail('One-time price is required for this pricing type.');
                        }
                    }
                ],

                'price_monthly' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    function ($attribute, $value, $fail) use ($request) {
                        $pricingType = $request->input('pricing_type');
                        if (in_array($pricingType, ['recurring', 'both']) && empty($value)) {
                            $fail('Monthly price is required for recurring subscriptions.');
                        }
                    }
                ],

                'price_yearly' => 'nullable|numeric|min:0',
                'price_quarterly' => 'nullable|numeric|min:0',
            ]);

            DB::beginTransaction();

            // Create the product with all data
            $product = Product::create([
                'name' => $validated['name'],
                'product_group_id' => $validated['product_group_id'],
                'pricing_type' => $validated['pricing_type'],
                'setup_fee' => $validated['setup_fee'] ?? 0,

                // Price fields
                'price_one_time' => $validated['price_one_time'] ?? null,
                'price_monthly' => $validated['price_monthly'] ?? null,
                'price_yearly' => $validated['price_yearly'] ?? null,
                'price_quarterly' => $validated['price_quarterly'] ?? null,

                'status' => $validated['status'],
                'version' => $validated['version'],
                'description' => $validated['description'],
            ]);

            DB::commit();

            return redirect()->route('product')
                ->with('success', 'Software product created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            // Return validation errors
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Product Creation Error: ' . $e->getMessage());
            \Log::error('Error Trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create product. Please try again.');
        }
    }

    public function edit_product($id)
    {
        try {
            $product = Product::findOrFail($id);
            $productGroups = ProductGroup::where('is_active', true)
                ->orderBy('group_name')
                ->get();

            return view('product.edit-product', compact('product', 'productGroups'));

        } catch (\Exception $e) {
            \Log::error('Edit Product Error: ' . $e->getMessage());
            return redirect()->route('product')
                ->with('error', 'Product not found or you don\'t have permission to edit it.');
        }
    }

    public function product_update(Request $request, $id)
    {
        try {
            $product = Product::findOrFail($id);

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'product_group_id' => 'required|exists:product_groups,id',
                'pricing_type' => 'required|in:one_time,recurring,both',
                'setup_fee' => 'nullable|numeric|min:0',
                'status' => 'required|in:0,1,2',
                'version' => 'nullable|string|max:50',
                'description' => 'nullable|string',

                // Conditional validation based on pricing type
                'price_one_time' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    function ($attribute, $value, $fail) use ($request) {
                        $pricingType = $request->input('pricing_type');
                        if (in_array($pricingType, ['one_time', 'both']) && empty($value)) {
                            $fail('One-time price is required for this pricing type.');
                        }
                    }
                ],

                'price_monthly' => [
                    'nullable',
                    'numeric',
                    'min:0',
                    function ($attribute, $value, $fail) use ($request) {
                        $pricingType = $request->input('pricing_type');
                        if (in_array($pricingType, ['recurring', 'both']) && empty($value)) {
                            $fail('Monthly price is required for recurring subscriptions.');
                        }
                    }
                ],

                'price_yearly' => 'nullable|numeric|min:0',
                'price_quarterly' => 'nullable|numeric|min:0',
            ]);

            DB::beginTransaction();

            // Update the product
            $product->update([
                'name' => $validated['name'],
                'product_group_id' => $validated['product_group_id'],
                'pricing_type' => $validated['pricing_type'],
                'setup_fee' => $validated['setup_fee'] ?? 0,

                // Price fields
                'price_one_time' => $validated['price_one_time'] ?? null,
                'price_monthly' => $validated['price_monthly'] ?? null,
                'price_yearly' => $validated['price_yearly'] ?? null,
                'price_quarterly' => $validated['price_quarterly'] ?? null,

                'status' => $validated['status'],
                'version' => $validated['version'],
                'description' => $validated['description'],
            ]);

            DB::commit();

            return redirect()->route('product')
                ->with('success', 'Product updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Product Update Error: ' . $e->getMessage());
            \Log::error('Error Trace: ' . $e->getTraceAsString());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update product. Please try again.');
        }
    }

    public function product_destroy($id)
    {
        try {
            $product = Product::findOrFail($id);

            // Check if product has any dependent records before deleting
            // Add your dependency checks here if needed

            DB::beginTransaction();
            $product->delete();
            DB::commit();

            return redirect()->route('product')
                ->with('success', 'Product deleted successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Product Deletion Error: ' . $e->getMessage());

            return redirect()->route('product')
                ->with('error', 'Failed to delete product. Please try again.');
        }
    }

    public function product_group_store(Request $request)
    {
        try {
            // Add validation
            $validated = $request->validate([
                'group_name' => 'required|string|max:255',
                'description' => 'nullable|string',
            ]);

            DB::beginTransaction();

            $productGroup = ProductGroup::create([
                'group_name' => $validated['group_name'],
                'description' => $validated['description'],
                'is_active' => true,
            ]);

            DB::commit();

            return redirect()->route('product.group')
                ->with('success', 'Product group created successfully!');

        } catch (\Exception $e) {
            DB::rollBack();

            // Log the error for debugging
            \Log::error('Product Group Creation Error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create product group: ' . $e->getMessage());
        }
    }

    // Edit Product Group - Show Form
    public function edit_product_group($id)
    {
        try {
            $productGroup = ProductGroup::findOrFail($id);
            return view('product.edit-product-group', compact('productGroup'));
        } catch (\Exception $e) {
            \Log::error('Edit Product Group Error: ' . $e->getMessage());
            return redirect()->route('product.group')
                ->with('error', 'Product group not found.');
        }
    }

    // Update Product Group
    public function update_product_group(Request $request, $id)
    {
        try {
            $productGroup = ProductGroup::findOrFail($id);

            $validated = $request->validate([
                'group_name' => 'required|string|max:255|unique:product_groups,group_name,' . $id,
                'description' => 'nullable|string',
                'is_active' => 'required|boolean',
            ]);

            DB::beginTransaction();

            $productGroup->update([
                'group_name' => $validated['group_name'],
                'description' => $validated['description'],
                'is_active' => $validated['is_active'],
            ]);

            DB::commit();

            return redirect()->route('product.group')
                ->with('success', 'Product group updated successfully!');

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error('Update Product Group Error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update product group: ' . $e->getMessage());
        }
    }

    // Delete Product Group
    public function destroy_product_group($id)
    {
        // Simplest approach
        $result = DB::table('product_groups')->where('id', $id)->delete();

        if ($result) {
            return redirect()->route('product.group')
                ->with('success', 'Product group deleted!');
        }

        return redirect()->route('product.group')
            ->with('error', 'Delete failed or group not found.');
    }

    public function services()
    {
        $products = Product::with('productGroup')->latest()->paginate(10);
        $totalProducts = Product::count();

        return view('services.index', compact('products', 'totalProducts'));
    }

    public function add_services()
    {
        $customers = User::where('status', '1') // Active users
            ->orderBy('first_name')
            ->get(['id', 'first_name', 'last_name', 'company_name', 'email']);

        $products = Product::where('status', '1') // Active products
            ->with('productGroup')
            ->orderBy('name')
            ->get(['id', 'name', 'product_group_id', 'pricing_type', 'price_one_time', 'price_monthly']);

        return view('services.add-services', compact('customers', 'products'));
    }

    public function services_store(Request $request)
    {
        try {
            $validated = $request->validate([
                'customer_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id',
                'package_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'paid_date' => 'required|date',
                'expire_date' => 'required|date|after_or_equal:paid_date',
                'status' => 'nullable|in:active,inactive,pending,cancelled',
                'notes' => 'nullable|string',
            ]);

            // Create the service
            $service = Service::create([
                'customer_id' => $validated['customer_id'],
                'product_id' => $validated['product_id'],
                'package_name' => $validated['package_name'],
                'price' => $validated['price'],
                'paid_date' => $validated['paid_date'],
                'expire_date' => $validated['expire_date'],
                'status' => $validated['status'] ?? 'active',
                'notes' => $validated['notes'],
            ]);

            return redirect()->route('services.index')
                ->with('success', 'Service created successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            \Log::error('Service Creation Error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to create service. Please try again.');
        }
    }

    public function edit_service($id)
    {
        try {
            $service = Service::with(['customer', 'product'])->findOrFail($id);

            $customers = User::where('status', '1')
                ->orderBy('first_name')
                ->get(['id', 'first_name', 'last_name', 'company_name']);

            $products = Product::where('status', '1')
                ->with('productGroup')
                ->orderBy('name')
                ->get(['id', 'name', 'product_group_id']);

            return view('services.edit-service', compact('service', 'customers', 'products'));

        } catch (\Exception $e) {
            \Log::error('Edit Service Error: ' . $e->getMessage());
            return redirect()->route('services.index')
                ->with('error', 'Service not found.');
        }
    }

    public function services_update(Request $request, $id)
    {
        try {
            $service = Service::findOrFail($id);

            $validated = $request->validate([
                'customer_id' => 'required|exists:users,id',
                'product_id' => 'required|exists:products,id',
                'package_name' => 'required|string|max:255',
                'price' => 'required|numeric|min:0',
                'paid_date' => 'required|date',
                'expire_date' => 'required|date|after_or_equal:paid_date',
                'status' => 'required|in:active,inactive,pending,cancelled',
                'notes' => 'nullable|string',
            ]);

            $service->update($validated);

            return redirect()->route('services.index')
                ->with('success', 'Service updated successfully!');

        } catch (\Illuminate\Validation\ValidationException $e) {
            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput();

        } catch (\Exception $e) {
            \Log::error('Service Update Error: ' . $e->getMessage());

            return redirect()->back()
                ->withInput()
                ->with('error', 'Failed to update service. Please try again.');
        }
    }

    public function service_destroy($id)
    {
        try {
            $service = Service::findOrFail($id);

            $service->delete();

            return redirect()->route('services.index')
                ->with('success', 'Service moved to trash successfully!');

        } catch (\Exception $e) {
            \Log::error('Service Deletion Error: ' . $e->getMessage());

            return redirect()->route('services.index')
                ->with('error', 'Failed to delete service. Please try again.');
        }
    }

    public function service_restore($id)
    {
        try {
            $service = Service::onlyTrashed()->findOrFail($id);
            $service->restore();

            return redirect()->route('services.index', ['trashed' => 'true'])
                ->with('success', 'Service restored successfully!');

        } catch (\Exception $e) {
            \Log::error('Service Restore Error: ' . $e->getMessage());

            return redirect()->route('services.index', ['trashed' => 'true'])
                ->with('error', 'Failed to restore service. Please try again.');
        }
    }


    public function service_force_delete($id)
    {
        try {
            $service = Service::onlyTrashed()->findOrFail($id);
            $service->forceDelete();

            return redirect()->route('services.index', ['trashed' => 'true'])
                ->with('success', 'Service permanently deleted!');

        } catch (\Exception $e) {
            \Log::error('Service Force Delete Error: ' . $e->getMessage());

            return redirect()->route('services.index', ['trashed' => 'true'])
                ->with('error', 'Failed to permanently delete service. Please try again.');
        }
    }


    public function service_empty_trash()
    {
        try {
            $count = Service::onlyTrashed()->count();
            Service::onlyTrashed()->forceDelete();

            return redirect()->route('services.index')
                ->with('success', "Trash emptied successfully! {$count} services permanently deleted.");

        } catch (\Exception $e) {
            \Log::error('Empty Trash Error: ' . $e->getMessage());

            return redirect()->route('services.index')
                ->with('error', 'Failed to empty trash. Please try again.');
        }
    }
}
