<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Style;
use App\Models\User;
use DateTime;
use Illuminate\Support\Facades\DB;

class Dashboard extends Controller
{

    public function index()
    {
        $user = User::find(\Auth::user()->id);
        $categories = Category::orderedWithStyles()->get();
        $stylesCount = Style::count();
        $userStyles = $user->styles()->pluck('style_id');
        $userMedals = $user->medals()->get();

        return view('dashboard', compact('user', 'categories', 'stylesCount', 'userStyles', 'userMedals'));
    }

    public function missing()
    {
        $user = User::find(\Auth::user()->id);
        $categories = Category::orderedMissingWithStyles(\Auth::user()->id)->get();
        $stylesCount = Style::count();
        $userStyles = $user->styles()->pluck('style_id');
        $userMedals = $user->medals()->get();

        return view('dashboard', compact('user', 'categories', 'stylesCount', 'userStyles', 'userMedals'));
    }

    public function show(Request $request, $userId, $slug)
    {
        $user = User::findOrFail($userId);
        $categories = Category::orderedWithStyles()->get();
        $stylesCount = Style::count();
        $userStyles = $user->styles()->pluck('style_id');

        return view('show', compact('user', 'categories', 'stylesCount', 'userStyles'));
    }

    public function store(Request $request, $filtered = false)
    {
        $user = User::find(\Auth::user()->id);
        $styles = $request->get('style');
        if($filtered){
            $user->styles()->syncWithoutDetaching($styles);
        } else {
            $user->styles()->sync($styles);
        }

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

        $moreBrewed = DB::table('style_user')
        ->select(DB::raw('styles.name, count(1) as total'))
        ->join('styles', 'styles.id', 'style_user.style_id')
        ->orderBy('total', 'desc')
        ->groupBy('styles.name')
        ->limit(10)
        ->get();
        $lessBrewed = DB::table('style_user')
        ->select(DB::raw('styles.name, count(1) as total'))
        ->join('styles', 'styles.id', 'style_user.style_id')
        ->orderBy('total', 'asc')
        ->groupBy('styles.name')
        ->limit(10)
        ->get();;

        return view('ranking', compact('users', 'moreBrewed', 'lessBrewed'));
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
        $categories = Category::orderedWithStyles()->get();
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

    public function yearChart($id = null)
    {
        if(!$id) {
            $id = \Auth::user()->id;
        }
        $data = DB::table('style_user')
            ->select(DB::raw('DATE_FORMAT(created_at, "%Y-%m-01") as date, count(1) as total'))
            ->orderBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-01")'))
            ->groupBy(DB::raw('DATE_FORMAT(created_at, "%Y-%m-01")'))
            ->where('user_id', $id)
            ->get();

        $startDate = new DateTime('2023-01-01');
        $endDate = new DateTime();

        $return = [
            'date' => [],
            'total' => [],
        ];

        while($startDate < $endDate) {
            $return['date'][] = $startDate->format('m/Y');
            $return['total'][] = $data->where('date', $startDate->format('Y-m-01'))->count() ? $data->where('date', $startDate->format('Y-m-01'))->first()->total : 0;
            $startDate->add(new \DateInterval('P1M'));
        }

        return response()->json($return);
    }

    public function medals()
    {
        return view('medals');
    }
}
