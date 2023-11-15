@extends('layouts.main')

@section('content')

        <div class="pagetitle">
          <h1>Data Tables</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">System Analyst</a></li>
              <li class="breadcrumb-item active" >List Analyst</li>
            </ol>
          </nav>
        </div><!-- End Page Title -->
    
        <section class="section">
          <div class="row">
            <div class="col-lg-12">

              @if(session('success'))
                <div class="alert alert-success">
                  {{ session('success') }}
                </div>
              @endif

              @if(session('error'))
                <div class="alert alert-danger">
                  {{ session('error') }}
                </div>
              @endif
        
    
              <div class="card">
                <div class="card-body">
                  <h5 class="card-title">Task</h5>
                 
                  <!-- Table with stripped rows -->
                  <table class="table datatable" >
                    <thead>
                      <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Project Name</th>
                        <th scope="col">Phase</th>
                        <th scope="col">Analyst</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Timeline</th>
                        <th scope="col">Status</th>
                        <th scope="col">Submit By</th>
                        <th scope="col" colspan="3">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      @foreach($listanalysis as $list => $row)
                      <tr>
                          <td>{{ $list + 1 }}</td>
                          <td>{{ $row->project->project_name}}</td>
                          <td>{{ $row->phase->phase_name}}</td>
                          <td>{{ $row->notes}}</td>
                          <td>{{ date('d M Y', strtotime($row->deadline))}}</td>
                          <td>{{ date('h:i A', strtotime($row->timeline)) }}</td>

                          {{-- <td><a href="{{ asset('storage/' . $row->file->file_name) }}">Download</a></td>
                           --}}
                          
                          <td>@if($row->status->status_name === 'New Analysis')
                            <i class="mdi mdi-circle text-primary"></i> New Analysis
                              @elseif ($row->status->status_name === 'In-Progress')
                              <i class="mdi mdi-circle text-warning"></i> In-Progress
                              @elseif ($row->status->status_name === 'Completed')
                              <span class="badge bg-success">Completed</span>
                              @elseif ($row->status->status_name === 'Rejected')
                              <i class="mdi mdi-circle text-danger"></i> Rejected
                              @endif
                          </td>
              
                          <td>{{ $row->user->name}}</td>
                          <td>
                            <a href="{{ route('view.analyst', $row->id) }}" class="btn btn-outline-primary">View</a>
                          </td>
                          @if($row->status->status_name=== 'New Analysis')
                          <td>
                            <button type="button" class="btn btn-outline-danger comfirmModal" data-item-id="{{ $row->id }}">Delete</button>
                          </td>
                          @endif
                      @endforeach
                      
                    </tbody>
                  </table>
                </div>
              </div>
    
            </div>
          </div>
        </section>
<!-- Modal -->
<div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered " >
    <div class="modal-content delete">
      <div class="modal-header">
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body delete-body">
        <form id="rejectForm" action="{{ url('/delete') }}" method="POST">
          @csrf
          <i class="bx bxs-trash icon" ></i>
          <h2>Are you sure ?</h2>
          <label>Do you really want to delete this record ? This record can not be view once deleted </label>
        

        <input type="hidden" name="item_id" id="item_id" value="">
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-danger">Delete</button>
      </div>
    </div>
  </div>
</div>
@endsection



        
@push('js')
<script>
  // Get the modal and button elements
  const modal = new bootstrap.Modal(document.getElementById("exampleModal"));
  const openButton = document.querySelectorAll(".comfirmModal");
  const item_id = document.getElementById("item_id");

  // Add an event listener to the "Open" button
  for(let i = 0; i < openButton.length; i++){
      openButton[i].addEventListener("click", function () {
      const id = openButton[i].getAttribute("data-item-id");
      item_id.value = id;
      modal.show();
  });
  }
</script>
  
@endpush
    
      
      

      
   

