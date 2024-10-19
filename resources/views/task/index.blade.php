@extends('task_layouts.app')
@section('task_title', 'Task Manager | Welcome')
@section('main_content')
    <nav class="col-12 d-flex justify-content-between align-items-center w-100 bg-greenblue2 vh-10">
        <a class="navbar-brand p-3 w-100" href="/"><img class="fade-in anim1" data-src="{{asset('symstorage/images')}}/logo.png"
            src="{{asset('symstorage/images')}}/logo.png" alt="Task Manager" height="50px">
        </a>
        <div class="d-flex flex-column ms-3 w-100 h-100  align-items-center justify-content-end">
            <div class="text-center">
                <h5 class="text-white mb-0">Your Routine</h5>
            </div>
            <div class="d-flex justify-content-between w-100 text-center">
                @php
                    $todayType = 'Unknown';
                    foreach ($dayCategoriesArray as $value) {
                        if($value['repeat'] != 'everyday'){
                            $todayType = $value['day_name'];
                            break;
                        }
                    }
                @endphp
                <p class="text-white mb-0 mx-1">Today({{$todayType}})</p>
                <p class="text-white mb-0 mx-1">{{\Carbon\Carbon::now()->format('d-M-Y')}}</p>

            </div>
        </div>
        <ul class="navbar-nav flex-row justify-content-end align-items-center w-100">
            @if (Auth::user())
                   <li class="nav-item mx-1">
                        <a href="javascript:void(0)">{{Auth::user()->name}}</a>
                    </li>
                    <li class="nav-item mx-1">
                        <a class="btn btn-sm btn-warning" href="{{route('logout')}}" onclick="event.preventDefault(); document.getElementById('logout_form').submit();">Sign Out
                        </a>
                        <form id="logout_form" action="{{route('logout')}}" method="POST">
                          @csrf
                        </form>
                      </li>
            @else
            <li class="nav-item mx-1">
                <a href="{{route('login')}}" class="btn btn-sm btn-success">Log In</a>
            </li>
            <li class="nav-item mx-1">
                <a href="{{route('register')}}" class="btn btn-sm btn-primary">Sign Up</a>
            </li>
            @endif                 
        </ul>
    </nav>
    <div id="notifications">
        
    </div>
<div class="row d-flex g-0 vh-84">
    <div class="col-3 bg-greenblue2 pt-3 d-flex flex-column justify-content-between">
        <ul class="navbar-nav px-2 maxh200px overflowY-scroll">
            <li class="nav-item bg-white my-1">
                <a href="javascript:void(0)" id="alldays" class="nav-link fw-bold ps-2">Your Days</a>
            </li>
           <li>
            <ul class="ps-2 yourdays">
                @foreach ($dayCategoriesArray as $day)
                       <li class="nav-item bg-white my-1">
                        <a href="javascript:void(0)" class="nav-link fw-bold ps-2">{{$day['day_name']}}</a>
                    </li>
                @endforeach
                <li class="nav-item bg-white my-1 text-center">
                    <a href="javascript:void(0)" class="nav-link fw-bold addday">➕</a>
                </li>                      
            </ul>
           </li>
        </ul>
        <ul class="navbar-nav px-2">
            <li class="nav-item bg-white my-1">
                <a href="javascript:void(0)" class="nav-link fw-bold ps-2">Calender</a>
            </li>
            <li class="nav-item bg-white my-1">
                <a href="javascript:void(0)" class="nav-link fw-bold ps-2">Unfinished</a>
            </li>
            <li class="nav-item bg-white my-1">
                <a href="javascript:void(0)" class="nav-link fw-bold ps-2">Completed</a>
            </li>
            <li class="nav-item bg-white my-1">
                <a href="javascript:void(0)" class="nav-link fw-bold ps-2">Tutorials</a>
            </li>
        </ul>
    </div>
    <div class="col-9 taskindex overflowY-scroll h-100">
       @foreach ($tasks as $time=>$groupedtask)
           <div class="row g-0 d-flex bg-white my-1 mx-2">
            <div class="col-12">
                <table class="table table-striped">
                    @php
                        $parsedTime = \Carbon\Carbon::parse($time);
                    @endphp
                    <thead>
                        <th>{{ $parsedTime->format('H:i') }} - {{ $parsedTime->copy()->addHour()->format('H:i') }}</th>
                    </thead>
                    <tbody>
                        @foreach ($groupedtask as $task)
                        <tr>
                            <td class="col-6 overflow-hidden">     
                                @if (strlen($task['task_body']) >= 20)
                                {{substr($task['task_body'], 0, 20)}}...
                                <a href="javascript:void(0)" class="viewmore"> More</a>
                                <span class="fullTask d-none">{{$task['task_body']}}</span>
                                @else
                                    {{$task['task_body']}}
                                @endif  
                            </td>
                            <td class="col-3 overflow-hidden">{{\Carbon\Carbon::parse($task['alarm_time'])->format('H:i')}}({{$task['day_category']['day_name']}})</td>
                            <td class="col-3 text-end">
                                <a href="javascript:void(0)" class="edit text-secondary pe-2 text-decoration-none" title="Edit" data-id="{{$task['id']}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                        <path fill-rule="evenodd" d="M1 8a7 7 0 1 0 14 0A7 7 0 0 0 1 8m15 0A8 8 0 1 1 0 8a8 8 0 0 1 16 0M5.854 10.803a.5.5 0 1 1-.708-.707L9.243 6H6.475a.5.5 0 1 1 0-1h3.975a.5.5 0 0 1 .5.5v3.975a.5.5 0 1 1-1 0V6.707z"/>
                                      </svg>
                                </a>
                                <a href="javascript:void(0)" class="done text-secondary pe-2 text-decoration-none" title="Done" data-id="{{$task['id']}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 16 16">
                                        <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16"/>
                                        <path d="m10.97 4.97-.02.022-3.473 4.425-2.093-2.094a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-1.071-1.05"/>
                                      </svg>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>
            </div>
           </div>
       @endforeach
    </div>
</div>
@endsection

