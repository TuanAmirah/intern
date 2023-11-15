@extends('layouts.main')
@section('content')
    <div class="pagetitle">
      <h1>Task Analyst</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item">System Analyst</a></li>
          <li class="breadcrumb-item" ><a href="{{route('list.analyst')}}">List Analyst</a></li>
          <li class="breadcrumb-item active">Analyst</a></li>
           
        </ol>
      </nav>
    </div><!-- End Page Title -->
    <section class="section">
      <div class="row">
        <div class="col-lg-6">
        
        </div>
        <div class="col-lg-6">
          @if( $analysis->status_id == "4")
          <div class="card" style="padding-top:15px;"> 
          <form action="{{ route('chat.respon', Auth::user()->id) }}" method="POST">
            @csrf
    
            <div class="card-body">
                <div class="row mb-3">
                  <label for="" class="col-sm-2 col-form-label" style="font-weight:bold;">Reason </label>
                  <div class="col-sm-10">
                    <input type="text" class="col-sm-10 form-control" id="inputText" value="{{ $analysis->reason->issue}}" readonly>
                    <input type="hidden" name="reasonid"  value="{{ $analysis->reason->id}}" readonly>
                  </div>
                </div>
            
                <div class="row mb-3">
                  <div class="modal-body" id="msgBody" style="height:400px; overflow-y:scroll; overflow-x:hidden;">
                    @foreach ( $respon as $responses )

                    @php
                      $respon = $responses->created_at;
                      $datetime = $respon->format('d M Y g:i A');
                    @endphp

                    @if($responses->user->id  == Auth::user()->id)
                    <div class="chat__item-wrapper-right d-flex flex-row mb-3">
                      <div class="chat__item chat__item-right ml-auto text-right">
                        <p class="mb-0">{{ $responses->comment }}</p>
                        <div class="meta text-dark mt-2">
                          <strong style="font-size: small"><i>{{ ucfirst(Auth::user()->name) }}</i></strong> - 
                          <small><i>{{ $datetime }}</i></small>
                        </div>
                      </div>
                      <div class="chat__item__avatar bg-dark"></div>
                    </div>
                    @else
                      <div class="chat__item-wrapper d-flex flex-row mb-3">
                        <div class="chat__item__avatar bg-dark"></div>
                        <div class="chat__item chat__item-left mr-auto">
                          
                          <p class="mb-0">{{ $responses->comment }}</p> 
                          <div class="meta text-dark mt-2" >
                            <strong style="font-size: small;"><i>{{ ucfirst($responses->user->name) }}</i></strong> - 
                            <small><i>{{ $datetime }}</i></small>
                          </div>
                        </div>
                      </div>

                    @endif
            
                      
                    @endforeach
                   
                     
                  </div>
                </div>

                <div class="row mb-3">
                  <textarea id="comment" name="comment" class="col-sm-10 col-form-control" style="height:70px"></textarea>
                  <div class="col-sm-2 d-flex align-items-center">
                  <button id="send" class="btn btn-primary " type="submit">Send</button>
                </div>
                </div>
            </form>
              
            </div>
            
          </div>
          @endif
        </div>
        
        
      </div>
    </section>

 @endsection
 @push('js')
 <script>
    // const pusher = new Pusher ('{{ config('broadcasting.connections.pusher.key') }}', {cluster:'ap1'});
    // const channel = pusher.subscribe('channel');

    // channel.bind('chat', function($data){
    //     $.post("/receive", )
    // })
 </script>
     
 @endpush