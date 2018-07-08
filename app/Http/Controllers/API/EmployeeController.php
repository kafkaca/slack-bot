<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Rule;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    public function carbon()
    {
        $now = Carbon::now();
        //echo $now->addDays(29);
        $columns = \DB::connection()->getSchemaBuilder()->getColumnListing('departments');
        //return $columns;
        return \App\Employee::find(1)->first()
            ->append([
                'calisilan_gun',
                'kac_gun_kaldi',
                'kullanilan_izin',
                'vacations',
                'department',
            ]);

        /*
        ::whereHas('comments', function ($query) {
        $query->where('content', 'like', 'foo%');
        })->get();
         */
        //\App\Department::find(2)->employees()->has('vacations')->get();
        //\App\Employee::find(1)->department()->first()->employees()->select('id')->get()->pluck('id');
        //->department();
        //->first()->employess()->get();

        //auth()->user()->roles()->sync((array) [2], true);

        $rule = Rule::where('rule_name', 'vacation_rules')->first();
        $current = Carbon::now();

        $giris_date = "2018-01-01 23:59:00";
        $istek_tarihi = "2018-08-21 23:59:00";
        $giris_tarihi = Carbon::createFromFormat('Y-m-d H:i:s', $giris_date);

        $izin_baslangic = Carbon::createFromFormat('Y-m-d H:i:s', $istek_tarihi);
        if ($current->diffInDays($izin_baslangic) < $rule->rule_data['min_out_date']) {
            return "kapali";
        }

        return $current->diffInDays($izin_baslangic);

    }

    public function izinler()
    {
        $rule = Rule::where('rule_name', 'vacation_rules')->first();
        $current = Carbon::now();

        $giris_date = "2018-01-01 23:59:00";
        $istek_tarihi = "2018-08-21 23:59:00";
        $giris_tarihi = Carbon::createFromFormat('Y-m-d H:i:s', $giris_date);

        $izin_baslangic = Carbon::createFromFormat('Y-m-d H:i:s', $istek_tarihi);
        if ($current->diffInDays($izin_baslangic) < $rule->rule_data['min_out_date']) {
            return "kapali";
        }

        return $current->diffInDays($izin_baslangic);

    }

    public function getWorkInterval(\DateTime $dateTime = null)
    {
        $startDate = $thi->getDateStart();
        if (!$startDate) {
            return null;
        }
        // reset start date to first day of next month
        if ((int) $startDate->format('d') != 1) {
            $month = $startDate->format('m');
            $month += 1;
            $startDate->setDate($startDate->format('Y'), $month, 1);
            $startDate->setTime(0, 0, 0);
        }

        $currentDate = $dateTime ? clone ($dateTime) : new \DateTime();
        $currentDate->modify('+1 day');
        $currentDate->setTime(0, 0, 0);
        if ($startDate > $currentDate) {
            return null;
        }
        return $currentDate->diff($startDate);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

//SOURCES

/*
https://laracasts.com/discuss/channels/eloquent/laravel-timstamp-get-from-carbonparse */
