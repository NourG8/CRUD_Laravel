<?php

namespace App\Http\Controllers;

use App\Models\Film;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use DateTime;
use Carbon\Carbon;

class FilmController extends Controller
{

    public function index($description = null)
    {
        $categories = Category::all();
        $film = Film::all();
        // return response()->json(compact('films', 'categories', 'description'), 200);
        return response()->json($film, 200);
    }


    public function create()
    {
        //
    }


    public function search($description=null)
    {
        // $film = DB::table('films')->where('title', $description)->first(); //traja3li awel ligne yo3rodhha
        $film = DB::table('films')->where('title', $description)->get();   // traja3li les lignes lkol
        return response()->json($film,200);
    }



    public function store(Request $request)
    {
        $film = Film::create($request->all());
        // return response()->json($film,200);
        return new EmployeResource($film);
    }


    public function show(Film $film)
    {

    }


    public function edit(Film $film)
    {
        //
    }


    public function update(Request $request, Film $film)
    {
        //
    }


    public function destroy(Film $film)
    {
        //
    }

    // La somme de chaque nom des films exp: film Titanic :1 film abcd:2
    public function count(){
        $film = DB::table('films')
             ->select(DB::raw('count(*) as film_count, title'))
             ->where('title', '<>', 1)
             ->groupBy('title')
             ->get();
            return $film;;
    }

//La somme des films
    public function count1(){
        $film = DB::table('films')
             ->select(DB::raw('count(*) as film_count'))
             ->get();
            return $film;;
    }

//jointure entre 2 tables
public function count2(){
    $films = DB::table('categories')
            ->join('films', 'categories.id', '=', 'films.category_id')
            ->select('categories.*', 'films.*')
            ->get();
            return $films;
}

public function getDate(){
    $date = DB::table('films')
    ->select(DB::raw('films.created_at'))
    ->first();

    $dt = new DateTime();   
    $sysdate=$dt->format('Y-m-d');

    $formatted_dt1=Carbon::parse($sysdate)->format('Y-m-d');
    $formatted_dt2=Carbon::parse($dt)->format('Y-m-d');
    $date_diff=$formatted_dt1->diffInDays($formatted_dt2);
    return $date_diff;
    // return $sysdate->diffInDays($date);
            // return date('d-m-Y', strtotime($date->created_at));
}


}
