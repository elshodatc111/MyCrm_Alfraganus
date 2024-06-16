@extends('User.layout.app')
@section('title','Bosh sahifa')
@section('content')
<main id="main" class="main">
    <div class="pagetitle">
        <h1>Bosh sahifa</h1>
        <nav>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('User') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Bosh sahifa</li>
            </ol>
        </nav>
    </div>
        <div class="row dashboard">
            <div class="col-lg-4 col-6">
                <div class="card info-card sales-card text-center">
                    <div class="bg-primary text-white mt-4" style="width:60px;border-radius:50%;font-size:35px;padding:5px;height:60px;margin:0 auto;">
                        {{ $Stat['new'] }}
                    </div>
                    <h5 class="card-title">Yangi guruhlar</h5>
                </div>
            </div>
            <div class="col-lg-4 col-6">
                <div class="card info-card sales-card text-center">
                    <div class="bg-warning text-white mt-4" style="width:60px;border-radius:50%;font-size:35px;padding:5px;height:60px;margin:0 auto;">
                        {{ $Stat['activ'] }}
                    </div>
                    <h5 class="card-title">Aktiv guruhlar</h5>
                </div>
            </div>
            <div class="col-lg-4">
                <div class="card info-card sales-card text-center">
                    <div class="bg-danger text-white mt-4" style="width:60px;border-radius:50%;font-size:35px;padding:5px;height:60px;margin:0 auto;">
                        {{ $Stat['end'] }}
                    </div>
                    <h5 class="card-title">Yakunlangan guruhlar</h5>
                </div>
            </div>
        </div>

</main>
@endsection