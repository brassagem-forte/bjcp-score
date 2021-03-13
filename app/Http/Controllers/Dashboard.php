<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Style;
use App\Models\User;
use Illuminate\Support\Facades\DB;

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

    public function ranking(Request $request)
    {
        $users = $users = DB::table('users')
             ->select(DB::raw('count(*) as total, users.name, users.id'))
             ->join('style_user', 'style_user.user_id', 'users.id')
             ->groupBy('users.name', 'users.id')
             ->orderBy('total', 'desc')
             ->get();

        return view('ranking', compact('users'));
    }
}
