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
          <div class="card" style="padding-top:15px;">
            <div class="card-body">
              {{-- @foreach($analysis->file as $file)
              {{-- <h5 class="card-title">{{ $file->ref_no  }}</h5> --}}
              {{-- @endforeach --}} 

              <!-- Horizontal Form -->
              <div class="row g-3">
                  <div class="col-md-7">
                    <label class="form-label">Project Name</label>
                    <input type="text" class="form-control" value="{{ $analysis->project->project_name }}">
                  </div>
                  <div class="col-md-5">
                    <label class="form-label">Phases</label>
                    <input type="text" class="form-control" value="{{ $analysis->phase->phase_name }}">
                  </div>

                  <div class="col-md-7">
                    <label for="" class="form-label">Software Requirement Analysis (SRS)</label>
                    <textarea class="form-control" style="height: 135px" id="validationCustom03" name="notes" required>{{ $analysis->notes}}</textarea>
                  </div>
                  <div class="col-md-5">
                    <label for="" class="form-label">Deadline</label>
                    <input type="text" class="form-control" value="{{date('d M Y', strtotime($analysis->deadline))}}">
                    <br>
                    <label for="" class="form-label">Timeline</label>
                    <input type="text" class="form-control" value="{{ date('h:i A', strtotime($analysis->timeline)) }}">
                  </div>
                        <!-- Table with stripped rows -->
                        <div class="col-md-12">
                          <label for="" class="form-label">Document</label>
                          

                          <table  class="table table-hover">
                            <thead>
                              <tr>
                                <th scope="col">No.</th>
                                <th scope="col">File Name</th>
                                <th scope="col">Type</th>
                                <th scope="col">Size</th>
                                <th scope="col">Action</th>

                              </tr>
                            </thead>
                            <tbody>
                              @foreach($analysis->file as $file =>$row)

                              @php
                                $fileSizeInBytes =$row->file_size; // Replace with the actual file path
                                $fileSizeInMB = $fileSizeInBytes / 1048576; // Convert bytes to megabytes
                              @endphp   
                              <tr>
                                <td>{{ $file + 1 }}</td>
                                <td>
                                {{-- <a href="{{ asset('public/storage/' . $row->file_path) }}">{{  strtoupper($row->file_name) }}</a>  --}}
                                <a href="{{ asset('storage/' . $row->file_path) }}" target="_blank">{{ strtoupper($row->file_name) }}</a>
                                {{-- <a href="{{ route('fetch.pdf') }}" target="_blank">{{ strtoupper($row->file_name) }}</a> --}}

                                </td>
                                <td>
                                  {{   strtoupper($row->file_type); }}
                                </td>
                                <td>
                                  {{ $fileSizeInMB = number_format($fileSizeInMB, 2) . ' MB'; }}
                                </td>

                                <td style="text-align: center">
                                  <a class="ri-folder-open-line open-modal-button" data-src="{{ asset('storage/' . $row->file_path) }}">
                      
                                  </a>
                                  {{-- <button class="icon-button ">
                                      <i class="fas fa-file-pdf"></i> Open PDF
                                  </button> --}}
                                </td>
                                {{-- <td style="text-align: center">
                                    <button class="icon-button" id="openModal"><i class="fas fa-file-pdf"></i> Open PDF</button> --}}
                                    {{-- <embed src="{{ asset('storage/' . $row->file_name) }}" width="100" height="100"> --}}
                                    {{-- <i class="ri-folder-open-line"></i> --}}
                                {{-- </td> --}}
                                  {{-- <a href=""><i class="ri-folder-open-line"></i></a> --}}

                              </tr>
                              @endforeach
    
                            </tbody>
                          </table>
                          <!-- End Table with stripped rows -->

                          <!-- The Modal -->
                         
    

                        </div>
                  <div>
                    
                  </div>
              </div>

            </div>
          </div>
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

 <!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Document</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <embed id="pdfEmbed" src="" width="100%" height="500">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

@endsection

@push('js')

<script>
  // Get the modal and button elements
  const modal = new bootstrap.Modal(document.getElementById("exampleModal"));
  const openButton = document.querySelectorAll(".open-modal-button");
  const pdfEmbed = document.getElementById("pdfEmbed");

  // Add an event listener to the "Open" button
  for(let i = 0; i < openButton.length; i++){
      openButton[i].addEventListener("click", function () {
      const src = openButton[i].getAttribute("data-src");
      pdfEmbed.src = src;
      modal.show();
  });
  }
</script>
@endpush




  {{-- <script>
    // Get the modal and button elements
    const modal = document.getElementById("pdfModal");
    const openButtons = document.querySelectorAll(".icon-button");
    const closeModal = document.getElementById("closeModal");
    const pdfEmbed = document.getElementById("pdfEmbed");

    // Add an event listener to each "Open PDF" button
    openButtons.forEach(button => {
        button.addEventListener("click", function () {
            const src = button.getAttribute("data-src");
            pdfEmbed.src = src;
            modal.style.display = "block";
        });
    });

    // Add an event listener to the close button
    closeModal.addEventListener("click", function () {
        modal.style.display = "none";
        // Clear the src attribute of the embed element to stop PDF rendering
        pdfEmbed.src = "";
    });
</script> --}}