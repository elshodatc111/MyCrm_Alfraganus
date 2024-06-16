<?php

namespace App\Http\Controllers\SuperAdmin;
use App\Models\User;
use App\Models\FilialKassa;
use App\Models\IshHaqi;
use App\Models\Guruh;
use App\Models\Tulov;
use App\Models\Filial;
use App\Models\GuruhUser;
use App\Models\GuruhTime;
use App\Models\Davomat;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SuperAdminTecherController extends Controller{
    public function __construct(){
        $this->middleware('auth');
    }
    public function tulovlar($techer_id,$guruh_id){
        $tulov = 0;
        $IshHaqi = IshHaqi::where('user_id',$techer_id)->where('status',$guruh_id)->get();
        foreach ($IshHaqi as $items) {$tulov = $tulov + $items->summa;}
        return $tulov;
    }
    public function ishHaqiHisoblash($guruh_id){
        $Summa = 0;
        foreach (Tulov::where('guruh_id',$guruh_id)->get() as $key => $value) {
            if($value['type']=='Naqt'){
                $Summa = $Summa + $value->summa;
            }
            if($value['type']=='Plastik'){
                $Summa = $Summa + $value->summa;
            }
            if($value['type']=='Payme'){
                $Summa = $Summa + $value->summa;
            }
        }
        return $Summa;
    }
    public function index(){
        $time = date('Y-m-d',strtotime('-1 month',time()));
        $Report = array();
        $Guruhlar = Guruh::where('guruh_end','>=',$time)->get();
        foreach ($Guruhlar as $key => $value) {
            $Report[$key]['filial_name'] = Filial::find($value->filial_id)->filial_name;
            $Report[$key]['guruh_name'] = $value->guruh_name;
            $Report[$key]['techer'] = User::find($value->techer_id)->name;
            $Report[$key]['JamiTolov'] = number_format($this->ishHaqiHisoblash($value->id), 0, '.', ' ');
            $Report[$key]['HisoblanganIshHaqi'] = number_format($this->ishHaqiHisoblash($value->id)*$value->techer_price/100, 0, '.', ' ');
            $Report[$key]['IshHaqiTolovi'] = number_format($this->tulovlar($value->techer_id,$value->id), 0, '.', ' ');
        }
        return view('SuperAdmin.techer.index',compact('Report'));
    }
}
