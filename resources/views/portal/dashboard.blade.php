<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Dashboard</title>

    @extends('portal.layouts.master')
    @section('content')
        <!-- Page Sidebar Ends-->
       
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col">
                  <div class="page-header-left">
                    <h3>Dashboard View</h3>
                    @php
                    echo "<pre>";
                        print_r(checkPermission()[0]->edit)
                    @endphp
                    <!-- <ol class="breadcrumb">
                      <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                      <li class="breadcrumb-item">Dashboard</li>
                     
                    </ol> -->
                  </div>
                </div>
               
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-xl-8 xl-100">
                <div class="row">
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="chart-widget-dashboard">
                          <div class="media">
                            <div class="media-body">
                              <h5 class="mt-0 mb-0 f-w-600"><span class="counter">{{ $product->count() }}</span></h5>
                              <p>Total Products</p>
                            </div><i data-feather="tag"></i>
                          </div>
                          <div class="dashboard-chart-container">
                            <div class="small-chart-gradient-1"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="chart-widget-dashboard">
                          <div class="media">
                            <div class="media-body">
                              <h5 class="mt-0 mb-0 f-w-600"><span class="counter">{{ $BusinessCategory->count() }}</span></h5>
                              <p>Business Categories</p>
                            </div><i data-feather="shopping-cart"></i>
                          </div>
                          <div class="dashboard-chart-container">
                            <div class="small-chart-gradient-2"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-4">
                    <div class="card">
                      <div class="card-body">
                        <div class="chart-widget-dashboard">
                          <div class="media">
                            <div class="media-body">
                              <h5 class="mt-0 mb-0 f-w-600"><span class="counter">{{ $event->count() }}</span></h5>
                              <p>Events</p>
                            </div><i data-feather="sun"></i>
                          </div>
                          <div class="dashboard-chart-container">
                            <div class="small-chart-gradient-3"></div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- <div class="col-lg-12">
                    <div class="card">
                      <div class="card-header">
                        <h5>Production Valuation</h5>
                        <div class="card-header-right">
                          <ul class="list-unstyled card-option">
                            <li><i class="icofont icofont-simple-left"></i></li>
                            <li><i class="view-html fa fa-code"></i></li>
                            <li><i class="icofont icofont-maximize full-card"></i></li>
                            <li><i class="icofont icofont-minus minimize-card"></i></li>
                            <li><i class="icofont icofont-refresh reload-card"></i></li>
                            <li><i class="icofont icofont-error close-card"></i></li>
                          </ul>
                        </div>
                      </div>
                      <div class="card-body">
                        <div class="show-value-top d-flex">
                          <div class="value-left d-inline-block">
                            <div class="square bg-primary d-inline-block"></div><span>Total Earning</span>
                          </div>
                          <div class="value-right d-inline-block">
                            <div class="square d-inline-block bg-secondary"></div><span>Total Tax</span>
                          </div>
                        </div>
                        <div class="smooth-chart flot-chart-container"></div>
                        <div class="code-box-copy">
                          <button class="code-box-copy__btn btn-clipboard" data-clipboard-target="#example-head" title="Copy"><i class="icofont icofont-copy-alt"></i></button>
                          <pre><code class="language-html" id="example-head">&lt;!-- Cod Box Copy begin --&gt;
  &lt;div class="show-value-top d-flex"&gt;
    &lt;div class="value-left d-inline-block"&gt;
      &lt;div class="square bg-primary d-inline-block"&gt;&lt;/div&gt;
      &lt;span&gt;Total Earning&lt;/span&gt;
    &lt;/div&gt;
    &lt;div class="value-right d-inline-block"&gt;
      &lt;div class="square d-inline-block bg-secondary"&gt;&lt;/div&gt;
      &lt;span&gt;Total Tax&lt;/span&gt;
    &lt;/div&gt;
&lt;/div&gt;
&lt;div class="smooth-chart flot-chart-container"&gt;&lt;/div&gt;
&lt;!-- Cod Box Copy end --&gt;</code></pre>
                        </div>
                      </div>
                    </div>
                  </div> -->
                </div>
              </div>
            
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
       

@endsection