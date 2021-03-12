<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Style;
use App\Models\User;

class Dashboard extends Controller
{

    function index()
    {
        $user = User::find(\Auth::user()->id);
        $categories = Category::with('styles')->get();
        $stylesCount = Style::count();
        $userStyles = $user->styles()->pluck('style_id');

        return view('dashboard', compact('user', 'categories', 'stylesCount', 'userStyles'));
    }

    public function show(Request $request, $userId, $slug)
    {
        $user = User::findOrFail($userId);
        $categories = Category::with('styles')->get();
        $stylesCount = Style::count();
        $userStyles = $user->styles()->pluck('style_id');

        return view('show', compact('user', 'categories', 'stylesCount', 'userStyles'));
    }

    public function store(Request $request)
    {
        $user = User::find(\Auth::user()->id);
        $user->styles()->sync($request->get('style'));

        return redirect('dashboard')->with('status', 'Estilos atualizados com sucesso!');
    }
}
