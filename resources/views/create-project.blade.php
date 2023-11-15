@extends('layouts.main')

<main id="main" class="main">

    <div class="pagetitle">
      <h1>Project</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="{{route('dashboard')}}">Home</a></li>
          <li class="breadcrumb-item">Project</li>
          <li class="breadcrumb-item active">Create Project</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">

        <div class="col-lg-10">

          <div class="card">
            <div class="card-body">
              <h5 class="card-title">Create New Project</h5>
              
              <!-- Custom Styled Validation -->
              <form class="row g-3 needs-validation" novalidate>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Project Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Project Cost</label>
                  <div class="col-sm-10">
                    <input type="number" class="form-control" placeholder="RM ">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Project Contract</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="1 years">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Tender Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Tender Phone</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputEmail" class="col-sm-2 col-form-label">Tender Email</label>
                  <div class="col-sm-10">
                    <input type="email" class="form-control">
                  </div>
                </div>

                <div class="row mb-3">
                  <label for="inputText" class="col-sm-2 col-form-label">Staff Name</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control">
                  </div>
                </div>


                  <div class="row mb-3">
                    <label class="col-sm-2 col-form-label" for="validationCustom02">Staff Designation</label>
                    <div class="col-sm-10">
                      <select class="form-select" id="validationCustom02" required>
                        <option selected disabled value="">Select...</option>
                        <option value="0">System Analyst </option>
                        <option value="1">System Developer</option>
                      </select>
                      <div class="invalid-feedback">
                        Please select a valid Designation.
                      </div>
                    </div>
                    
                  </div>

                  <div class="row mb-3">
                    <label for="inputNumber" class="col-sm-2 col-form-label"  for="validationCustom04">File Approval</label>
                    <div class="col-sm-10">
                      <input class="form-control" type="file" id="formFile" id="validationCustom04" required>
                      <div class="invalid-feedback">
                        Please upload approval file.
                      </div>
                    </div>
                  </div>

                  <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label"  for="validationCustom05">Start Date</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="validationCustom05" required>
                      <div class="invalid-feedback">
                        Please select the start date.
                      </div>
                    </div>
                    
                  </div>

                  <div class="row mb-3">
                    <label for="inputDate" class="col-sm-2 col-form-label"  for="validationCustom05">End Date</label>
                    <div class="col-sm-10">
                      <input type="date" class="form-control" id="validationCustom05" required>
                      <div class="invalid-feedback">
                        Please select the end date.
                      </div>
                    </div>
                    
                  </div>


                
                <div class="text-center">
                  <button class="btn btn-primary" type="submit">Submit</button>
                </div>
              </form><!-- End Custom Styled Validation -->

            </div>
          </div>

        

        </div>
      </div>
    </section>

  </main><!-- End #main -->