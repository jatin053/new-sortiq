@extends('layouts.frontend')

@section('title', 'Case studies | Sortiq Solutions')

@section('body_attributes')
    data-route="/cases"
@endsection

@section('content')

<main class="font-raleway">

    <div class="min-h-screen bg-[#f5f5f5] flex items-center justify-center px-6 py-20">

        <div class="text-center">

            <!-- Top Heading -->
            <div class="flex items-center justify-center gap-4 mb-6">

                <span class="construction-icon">
                    🚧
                </span>

                <h1 class="coming-title">
                    Coming Soon
                </h1>

            </div>

            <!-- Main Text -->
            <p class="coming-text">
                Our case studies are under preparation.
            </p>

            <!-- Small Bottom Text -->
            <p class="small-text">
                Please visit again soon.
            </p>

        </div>

    </div>

</main>

<style>

    *{
        margin:0;
        padding:0;
        box-sizing:border-box;
    }

    body{
        font-family:'Nunito',sans-serif;
    }

    .construction-icon{
        font-size:42px;
        line-height:1;
    }

    .coming-title{
        font-family:'Nunito',sans-serif;
        font-size:2.5rem;
        font-weight:700;
        color:#0f172a;
        line-height:1.1;

    }

    .coming-text{
        font-family:'Nunito',sans-serif;
        font-size:1rem;
        font-weight:500;
        color:#1e293b;
        margin-bottom:22px;
        margin-top: 15px;
    }

    .small-text{
        font-family:'Nunito',sans-serif;
        font-size:16px;
        font-weight:400;
    }

    @media(max-width:768px){

        .coming-title{
            font-size:2.2rem;
        }

        .construction-icon{
            font-size:34px;
        }

        .coming-text{
            font-size:15px;
        }

        .small-text{
            font-size:11px;
        }

    }

</style>

@endsection