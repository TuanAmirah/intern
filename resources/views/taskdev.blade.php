@extends('layouts.main')

@section('content')

        <div class="pagetitle">
          <h1>Data Tables</h1>
          <nav>
            <ol class="breadcrumb">
              <li class="breadcrumb-item">System Developer</a></li>
              <li class="breadcrumb-item active" >Task Developer</li>
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
                        <th scope="col">Due</th>
                        <th scope="col">Count Down</th>
                        <th scope="col">Status</th>
                        <th scope="col">Submit By</th>
                        <th scope="col" colspan="3">Action</th>
                        
                      </tr>
                    </thead>
                    <tbody>
                      
                      @foreach($listanalysis as $list => $row)
                      @php
                      
                             // Assuming $analysis->deadline is a timestamp or a valid date string
                                $deadline = \Illuminate\Support\Carbon::parse($row->deadline);

                            // Calculate the difference
                            $diff = $deadline->diffForHumans(\Illuminate\Support\Carbon::now(), [
                                'parts' => 3, // Show days, hours, and minutes
                            ]);
                      

                      @endphp
                      <tr>
                          <td>{{ $list + 1 }}</td>
                          <td>{{ $row->project->project_name}}</td> 
                          <td>{{ $row->phase->phase_name}}</td>
                          <td>{{ $row->notes}}</td>
                          <td>{{ date('d M Y', strtotime($row->deadline))}} - {{ date('h:i A', strtotime($row->timeline)) }} </td>
                          <td>{{ $diff }}</td>

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
                            {{-- <a href="{{ route('view.analyst', $row->id) }}"  class="btn btn-outline-info rounded-pill"><i class="uil-circuit"></i> Info</a> --}}
                            <a href="{{ route('view.analyst', $row->id) }}" class="btn btn-outline-primary">View</a>
                          </td>
                          @if($row->status->status_name=== 'New Analysis')
                          <td>
                            <a href="{{ route('accept.task', $row->id) }}" class="btn btn-outline-success">Accept</a>
                          </td>
                          <td>
                            <a href="#" class="btn btn-outline-danger reject-btn" data-toggle="modal" data-target="#rejectModal" data-item-id="{{ $row->id }}">Reject</a>
                          </td>
                          @elseif ($row->status->status_name === 'In-Progress')
                          <td colspan="2">
                            <a href="" class="btn btn-outline-warning">In-Progress</a>
                          </td>

                          @elseif ($row->status->status_name === 'Completed')
                          <td colspan="2">
                            
                            <a href="" class="btn btn-outline-primary">View</a>
                          </td>

                          @elseif ($row->status->status_name === 'Reject')
                          <td colspan="2">
                            
                            <a href="" class="btn btn-danger">Reject</a>
                          </td>
                          @endif
                      @endforeach

                    </tbody>
                  </table>

                  <div class="modal fade" id="rejectModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Reason for Rejection</h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <form id="rejectForm" action="{{ url('/update/rejection', Auth::user()->id) }}" method="POST">
                          @csrf
                          <div class="modal-body">
                            <div class="form-group">
                              <label for="justification">Provide a reason for rejection:</label>
                              <textarea class="form-control" name="justification" id="justification" rows="3"></textarea>
                            </div>
                            <input type="hidden" name="item_id" id="item_id">
                          </div>
                          <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Submit</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                  
                  

                 
                  
    
                </div>
              </div>
    
            </div>
          </div>
        </section>
        @endsection

        @push('js')

        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      
      <script>
        $(document).ready(function () {

          $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
        });
          // When the "Reject" button is clicked, set the item_id input's value
          $('.reject-btn').on('click', function () {
            
            var itemId = $(this).data('item-id');
            $('#item_id').val(itemId);
          });

      
          //Handle the form submission
          // $('#rejectForm').on('submit', function (e) {
          //   e.preventDefault(); // Prevent the form from submitting normally
           
          //   var justification = $('#justification').val();
          //   var itemId = $('#item_id').val();
            
          //   $.ajax({
          //     type: 'POST',
          //     url: '/update/rejection', // Adjust the URL to your route
          //     data: {
          //       _token: '{{ csrf_token() }}',
          //       justification: justification,
          //       item_id: itemId
          //     },
          //     success: function (response) {
          //       console.log('executed');
          //       // Handle success, e.g., close the modal and display success message
          //       $('#rejectModal').modal('hide');
          //       // Redirect to a new page or the same page to display the success message
          //       window.location.href = '/taskdev';
          //     },
          //     error: function (xhr, status, error) {
          //       // Handle errors
          //       // Display an error message or redirect to handle the error
          //       window.location.href = '/taskdev';
          //     }
          //   });
          // });
        });
      </script>
          
        @endpush

        

      
      
      

      
   

