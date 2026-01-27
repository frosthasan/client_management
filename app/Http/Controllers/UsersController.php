<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Str;
use Illuminate\View\View;

class UsersController extends Controller
{

    public function index()
    {
        $users = User::latest()->paginate(10);
        $totalUsers = User::count();

        return view('clients.index', compact('users', 'totalUsers'));
    }

    public function create()
    {
        return view('clients.add-new');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'email' => 'required|email|unique:users|max:255',
            'phone' => 'required|string|max:20',
            // 'username' => 'required|string|unique:users|max:255',
            'password_option' => 'required|in:auto,manual',
            'password' => $request->password_option === 'manual' ? 'required|string|min:8|confirmed' : 'nullable',
            'password_confirmation' => $request->password_option === 'manual' ? 'required' : 'nullable',
            'address_line_1' => 'required|string|max:255',
            // 'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postcode' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'language' => 'nullable|string|max:10',
            'currency' => 'required|string|in:BDT,USD,EUR,GBP',
            'status' => 'required|string|in:0,1,2',
            'client_group' => 'required|string|in:retail,reseller,corporate,wholesale',
            'permissions' => 'nullable|array',
            'permissions.*' => 'string',
        ], [
            'first_name.required' => 'The first name field is required.',
            'last_name.required' => 'The last name field is required.',
            'email.required' => 'The email field is required.',
            'email.email' => 'Please enter a valid email address.',
            'email.unique' => 'This email is already registered.',
            'phone.required' => 'The phone number field is required.',
            // 'username.required' => 'The username field is required.',
            // 'username.unique' => 'This username is already taken.',
            'password.required_if' => 'The password field is required when selecting manual password.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
            'address_line_1.required' => 'The address line 1 field is required.',
            'city.required' => 'The city field is required.',
            'state.required' => 'The state/region field is required.',
            'postcode.required' => 'The postcode field is required.',
            'country.required' => 'The country field is required.',
            'currency.required' => 'The currency field is required.',
            'status.required' => 'The status field is required.',
            'client_group.required' => 'The client group field is required.',
        ]);

        // Generate password if auto option is selected
        $password = null;
        if ($validated['password_option'] === 'auto') {
            $password = Str::random(12); // Generate random 12 character password
        } else {
            $password = $validated['password'];
        }

        // Create the user
        $user = User::create([
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'company_name' => $validated['company_name'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            // 'username' => $validated['username'],
            'show_passwoed' => $password,
            'password' => Hash::make($password),
            'address_line_1' => $validated['address_line_1'],
            'address_line_2' => $validated['address_line_2'] ?? null,
            'city' => $validated['city'],
            'state' => $validated['state'],
            'postcode' => $validated['postcode'],
            'country' => $validated['country'],
            'language' => $validated['language'] ?? 'en',
            'currency' => $validated['currency'],
            'status' => $validated['status'],
            'client_group' => $validated['client_group'],
            'email_verified_at' => now(),
        ]);

        // Send email with auto-generated password if applicable
        if ($validated['password_option'] === 'auto') {
            // You can implement email sending logic here
            // Mail::to($user->email)->send(new WelcomeMail($user, $password));
        }

        // Redirect with success message
        return redirect()->route('users')
            ->with('success', 'Client created successfully!')
            ->with('auto_password', $validated['password_option'] === 'auto' ? $password : null);
    }

    public function edit(User $user)
    {
        // Pass the user to the edit view
        return view('clients.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        // Validate the request
        $validated = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'company_name' => 'nullable|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
            'phone' => 'required|string|max:20',
            // 'username' => 'required|string|max:255|unique:users,username,' . $user->id,
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'state' => 'required|string|max:100',
            'postcode' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'language' => 'nullable|string|max:10',
            'currency' => 'required|string|in:BDT,USD,EUR,GBP',
            'status' => 'required|string|in:1,0,2',
            'client_group' => 'required|string|in:retail,reseller,corporate,wholesale',
            'password' => $request->has('password') && !empty($request->password) ? 'nullable|string|min:8|confirmed' : 'nullable',
            'password_confirmation' => $request->has('password') && !empty($request->password) ? 'required' : 'nullable',
        ], [
            'email.unique' => 'This email is already registered by another user.',
            'password.min' => 'The password must be at least 8 characters.',
            'password.confirmed' => 'The password confirmation does not match.',
        ]);

        // Prepare update data
        $updateData = [
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'company_name' => $validated['company_name'] ?? null,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            // 'username' => $validated['username'],
            'address_line_1' => $validated['address_line_1'],
            'address_line_2' => $validated['address_line_2'] ?? null,
            'city' => $validated['city'],
            'state' => $validated['state'],
            'postcode' => $validated['postcode'],
            'country' => $validated['country'],
            'language' => $validated['language'] ?? 'en',
            'currency' => $validated['currency'],
            'status' => $validated['status'],
            'client_group' => $validated['client_group'],
        ];

        // Update password only if provided
        if (!empty($validated['password'])) {
            $updateData['password'] = Hash::make($validated['password']);
        }

        // Update the user
        $user->update($updateData);

        // Redirect with success message
        return redirect()->route('users')
            ->with('success', 'User updated successfully!');
    }

    public function destroy(User $user)
    {
        try {
            $userName = $user->first_name . ' ' . $user->last_name;
            $user->delete();

            return redirect()->route('users')
                ->with('success', "User '$userName' deleted successfully!");

        } catch (\Exception $e) {
            return redirect()->route('users')
                ->with('error', 'Error deleting user: ' . $e->getMessage());
        }
    }

}
