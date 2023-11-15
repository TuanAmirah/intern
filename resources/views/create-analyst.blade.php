@extends('layouts.main')
@section('content')

    <div class="pagetitle">
      <h1>Software Requirement Specification (SRS)</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item">System Analyst</li>
          <li class="breadcrumb-item active">Software Requirement Specification (SRS)</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-10">

          @if (session('success'))
          <div class="alert alert-success">
              {{ session('success') }}
          </div>
          @elseif (session('Error'))
          <div class="alert alert-danger">
            {{ session('error') }}
          </div>
          @endif 

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Analyst Project</h5>
              
              <!-- Custom Styled Validation -->
              <form class="row g-3 needs-validation" novalidate method="POST" action="{{ route('submit.analyst', Auth::user()->id) }}"  enctype="multipart/form-data" id="file-upload" >
                @csrf

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="validationCustom01">Ref No.</label> </label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" id="referenceNumber" name="referenceNumber" value="{{ $referenceNumber }}" readonly>
                  </div>
                </div>

                
                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="validationCustom01">Project</label> </label>
                  <div class="col-sm-10">
                    <select name="project" class="form-select"  required>
                          <option value="" selected disabled>Select Project</option>
                          @foreach($projects as $project)              
                          <option value=" {{ $project->id }}">{{ $project->project_name }}</option>                  
                          @endforeach  
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid project.
                  </div>
                  </div>
                </div>

                <div class="row mb-3">
                  <label class="col-sm-2 col-form-label" for="validationCustom01">Phase</label> </label>
                  <div class="col-sm-10">
                    <select name="phase" class="form-select"  required>
                          <option value="" selected disabled>Select Phase</option>
                          @foreach($phases as $phase)              
                          <option value=" {{ $phase->id }}">{{ $phase->phase_name }}</option>                  
                          @endforeach  
                  </select>
                  <div class="invalid-feedback">
                    Please select a valid phase task.
                  </div>
                  </div>
                </div>

                  <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label"  for="validationCustom03">Software Requirement Analysis (SRS)</label>
                    <div class="col-sm-10">
                      <textarea class="form-control" style="height: 100px" id="validationCustom03" name="notes" required></textarea>
                      <div class="invalid-feedback">
                        Please provide any description for reference project.
                      </div>
                    </div>
                    
                  </div>
                  {{-- <div class="row mb-3">
                    <label for="fileupload"class="col-sm-2 col-form-label"  >File Upload</label>
                    <div class="col-sm-10"> --}}
                        {{-- <input type="file" id="document-upload" name="document-upload" accept=".pdf" class="form-control" id="validationCustom04" required >                         --}}
                        {{-- <input type="file" name="files[]" id="fileInput" multiple>
                        
                        <div id="pdfLinkContainer"></div> --}}

                        {{-- <input type="file" name="documentupload[]" multiple id="fileInput" >
                        <div id="downloadLinks"></div> --}}

                        {{-- <input type="file" name="pdf_file" accept=".pdf" onchange="addFileLink(this)">
                        <div id="fileLinks"></div> --}}
                        {{-- <div class="invalid-feedback">
                          Please upload reference file.
                        </div>
                      </div>
                  </div> --}}

                  {{-- <div>
                    <p class="mt-5 text-center">
                      <label for="attachment">
                        <a class="btn btn-primary text-light" role="button" aria-disabled="false">+ Add</a>
                        
                      </label>
                      <input type="file" name="file[]" accept=".pdf" id="attachment" style="visibility: hidden; position: absolute;" multiple/>
                      
                    </p>
                    <p id="files-area">
                      <span id="filesList">
                        <span id="files-names"></span>
                      </span>
                    </p>
                  </div> --}}

                  

                  

                  <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label"  for="validationCustom05">Deadline</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="deadline" id="validationCustom05" name="deadline" required>
                      <div class="invalid-feedback">
                        Please select the deadline.
                      </div>
                    </div>
                    
                  </div>

                  <div class="row mb-3">
                    <label for="inputTime" class="col-sm-2 col-form-label"  for="validationCustom06">Time</label>
                    <div class="col-sm-10">
                      <input type="time" class="form-control" id="validationCustom06" name="timeline" required>
                      <div class="invalid-feedback">
                        Please select the timeline.
                      </div>
                    </div>
                  </div>
                  <div class="row mb-3">
                    <label for="fileupload"class="col-sm-2 col-form-label"  >File Upload</label>
                    <div class="col-sm-10">
                      <div class="dropzone dropzoneDragArea" id="myDropzone" name="filename" style="border: 1px dashed #c0ccda; ">
                      </div>
                  </div>
                <div class="text-center">
                  <button class="btn btn-primary submit-btn" type="submit" >Submit</button>
                </div>
          </form>
          </div>
        </div>
      </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body warning-body">
            <i class="bi bi-exclamation-triangle icon"></i>
            <h2>Alert !</h2>
            <label>Please select a date that is after today. Choosing a date in the past is <strong style="color: red">not allowed.</strong></label>

          </div>
          <div class="modal-footer">
          </div>
        </div>
      </div>
    </div>

    

@endsection

@push('js')

{{-- validate date after current date --}}

<script>
  document.getElementById('deadline').addEventListener("change", function () {
    const selectedDate = new Date(this.value);
    const today = new Date();

    if (selectedDate <= today) {
      $('#exampleModal').modal('show');
      this.value = ''; // Clear the input field
    }
  });
</script>

{{-- multiple file --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
  Dropzone.autoDiscover = false;
  const myDropzone = new Dropzone("#myDropzone", {
      url: "{{ url('/api/uploadfile') }}",
      autoProcessQueue: true,
      addRemoveLinks:true,
      paramName: "file", 
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }  
  });

  myDropzone.on("sending", function (file, xhr, formData) {
        // Get the reference ID from the hidden input field
        const referenceNumber = document.getElementById("referenceNumber").value;
        // Include the reference ID in the data sent to the server
        formData.append("referenceNumber", referenceNumber);
    });


    myDropzone.on("success", function (file, response) {
        // Handle the response from the server after each file upload.
        console.log('File uploaded:', file.name);
        console.log('Server response:', response);

    });

    myDropzone.on("removedfile", function (file) {

      // const filename = file.previewElement.getAttribute("data-filename");
      if (file.status === 'success') {
        $.ajax({
          type: 'POST',
          url: "{{ url('/api/removefile') }}",
          data: { 
            filename: file.name,
            referenceNumber : "{{ $referenceNumber }}"
           },

          success: function (data) {
            console.log('File removed:', file.name);
          },
          error: function (data) {
            console.error('Error removing file:', file.name);
          }
        });
      }
    });
</script>

@endpush

