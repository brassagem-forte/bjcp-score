<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Style;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{

    public function index()
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

    public function compare(Request $request)
    {

        $users = User::orderBy('name')->get();
        $compareUsers = [];
        foreach(User::whereIn('id', $request->query('user', [1,2]))->get() as $user) {
            $data = new \StdClass();
            $data->info = $user;
            $data->styles = $user->styles()->pluck('style_id');
            $compareUsers[] = $data;
        }
        if(count($compareUsers) == 1) {
            $compareUsers[1] = $compareUsers[0];
        }
        $categories = Category::with('styles')->get();
        $stylesCount = Style::count();

        return view('compare', compact('users', 'compareUsers', 'categories', 'stylesCount'));
    }

    public function chart()
    {
        $data = DB::table('style_user')
             ->select(DB::raw('styles.name, count(1) as total'))
             ->join('styles', 'styles.id', 'style_user.style_id')
             ->orderBy('total', 'desc')
             ->groupBy('styles.name')
             ->get();

        return response()->json([
            'style' => $data->pluck('name'),
            'count' => $data->pluck('total'),
        ]);
    }
}
