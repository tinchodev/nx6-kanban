<?php

namespace GitScrum\Http\Controllers\Web;

use Auth;
use Illuminate\Http\Request;

class ApiTokenController extends Controller
{
    public function index()
    {
        $tokens = Auth::user()->tokens()->orderBy('created_at', 'DESC')->get();

        return view('account.api-tokens')
            ->with('tokens', $tokens);
    }

    public function store(Request $request)
    {
        $request->validate(['name' => 'required|min:2|max:255']);

        $newToken = Auth::user()->createToken($request->name);

        return redirect()->route('account.api-tokens.index')
            ->with('plainTextToken', $newToken->plainTextToken)
            ->with('success', trans('API token created successfully.'));
    }

    public function destroy($id)
    {
        Auth::user()->tokens()->where('id', $id)->delete();

        return redirect()->route('account.api-tokens.index');
    }
}
