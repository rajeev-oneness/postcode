<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Community</title>

  @extends('portal.layouts.master')
  @section('content')

  <!-- Page Body Start-->
  <div class="page-body-wrapper">
    <div class="page-body">
      <div class="container-fluid flowid">
        <div class="page-header">
          <div class="row">
            <div class="col">
              <div class="page-header-left">
                <h3>Community CSV Upload</h3>

              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- Container-fluid starts-->
      <div class="container-fluid flowid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">

              <div class="card-body">
              <div class="alert alert-warning" id="error-msg" style="display:none;">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <div id="error-message"></div>
              </div>
                <form class="needs-validation" method="post" action="{{route('admin.community.store.csv')}}" enctype="multipart/form-data">
                  <input type="hidden" id="hid_id" name="hid_id">
                  {{csrf_field()}}
                  <div class="form-row">
                    <div class="col-md-3 mb-3">
                      <a href="{{route('download.csv', 'community')}}" class="btn btn-primary" ><i class="fas fa-file-csv"></i> Download Sample CSV</a>
                    </div>
                    <div class="col-md-8 mb-3">
                      <a href="{{route('download.community.category.csv')}}" class="btn btn-primary" ><i class="fas fa-file-csv"></i> Download Community Ctaegory List</a>
                    </div>
                    <div class="col-md-8 mb-3">
                      <label for="validationCustomUsername">Upload CSV</label>
                      <input class="form-control offrimg" type="file" id="ommunity_csv" name="ommunity_csv" required="">
                      @error('ommunity_csv')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                  
                  <button class="btn btn-primary" id="submit_business" name="submit_business" type="submit">Submit</button>
                </form>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- Container-fluid Ends-->
    </div>

    <script>

        $("form").submit(function() {
            $(this).submit(function() {
                return false;
            });
            return true;
        });
    </script>

    @endsection