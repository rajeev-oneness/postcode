<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>User | My calendar</title>

    @extends('user-portal.layouts.master')
    @section('content')
        <!-- Page Sidebar Ends-->
       
        <div class="page-body">
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-xl-8 xl-100">
                <div class="row">
                    <div class="col-12 ">
                        <h3 style="color: black !important;" class="mt-3">My events</h3>
                        <hr>
                        <div class="row">
                            <div class="col-md-6 mt-3">
                                <div class="wrapper">
                                    <div class="container-calendar">
                                        <h3 id="monthAndYear"></h3>
                                        <div class="button-container-calendar">
                                            <button id="previous" onclick="previous()">&#8249;</button>
                                            <button id="next" onclick="next()">&#8250;</button>
                                        </div>
                                        
                                        <table class="table-calendar" id="calendar" data-lang="en">
                                            <thead id="thead-month"></thead>
                                            <tbody id="calendar-body"></tbody>
                                        </table>
                                        
                                        <div class="footer-container-calendar">
                                            <label for="month">Jump To: </label>
                                            <select id="month" onchange="jump()">
                                                <option value=0>Jan</option>
                                                <option value=1>Feb</option>
                                                <option value=2>Mar</option>
                                                <option value=3>Apr</option>
                                                <option value=4>May</option>
                                                <option value=5>Jun</option>
                                                <option value=6>Jul</option>
                                                <option value=7>Aug</option>
                                                <option value=8>Sep</option>
                                                <option value=9>Oct</option>
                                                <option value=10>Nov</option>
                                                <option value=11>Dec</option>
                                            </select>
                                            <select id="year" onchange="jump()"></select>       
                                        </div>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-md-6 mt-3">
                              @foreach ($events as $event)
                                  <div class="border border-secondary rounded m-2">
                                    <div class="p-3">
                                        <p><strong>Date : </strong>{{date('d M,y', strtotime($event['event']['start']))}} - {{date('d M,y', strtotime($event['event']['end']))}}</p>
                                        <h5><a href="{{route('details',['name' => 'event', 'id' => $event['event']['id']])}}">{{$event['event']['name']}}</a></h5>
                                      <strong></strong>
                                    </div>
                                  </div>
                              @endforeach
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

<style>
.wrapper {
  margin: 15px auto;
  max-width: 1100px;
}

.container-calendar {
  background: #ffffff;
  padding: 15px;
  max-width: 475px;
  margin: 0 auto;
  overflow: auto;
}

.button-container-calendar button {
  cursor: pointer;
  display: inline-block;
  zoom: 1;
  background: #00a2b7;
  color: #fff;
  border: 1px solid #0aa2b5;
  border-radius: 4px;
  padding: 5px 10px;
}

.table-calendar {
  border-collapse: collapse;
  width: 100%;
}

.table-calendar td, .table-calendar th {
  padding: 5px;
  border: 1px solid #e2e2e2;
  text-align: center;
  vertical-align: top;
}

.date-picker.selected {
  font-weight: bold;
  /* outline: 1px dashed #00BCD4; */
  background: #00bbd43a;
}

.date-picker.selected-event {
  font-weight: bold;
  /* outline: 2px dashed #d80000; */
  background: #d8000052;
}

.date-picker.selected span {
  border-bottom: 2px solid currentColor;
}

/* sunday */
.date-picker:nth-child(1) {
color: red;
}

/* friday */
.date-picker:nth-child(7) {
color: green;
}

#monthAndYear {
  text-align: center;
  margin-top: 0;
}

.button-container-calendar {
  position: relative;
  margin-bottom: 1em;
  overflow: hidden;
  clear: both;
}

#previous {
  float: left;
}

#next {
  float: right;
}

.footer-container-calendar {
  margin-top: 1em;
  border-top: 1px solid #dadada;
  padding: 10px 0;
}

.footer-container-calendar select {
  cursor: pointer;
  display: inline-block;
  zoom: 1;
  background: #ffffff;
  color: #585858;
  border: 1px solid #bfc5c5;
  border-radius: 3px;
  padding: 5px 1em;
}
</style>

@endsection

@section('script')
<script>
function generate_year_range(start, end) {
  var years = "";
  for (var year = start; year <= end; year++) {
      years += "<option value='" + year + "'>" + year + "</option>";
  }
  return years;
}

var today = new Date();
var currentMonth = today.getMonth();
var currentYear = today.getFullYear();
var selectYear = document.getElementById("year");
var selectMonth = document.getElementById("month");


var createYear = generate_year_range(1970, 2050);
/** or
* createYear = generate_year_range( 1970, currentYear );
*/

document.getElementById("year").innerHTML = createYear;

var calendar = document.getElementById("calendar");
var lang = calendar.getAttribute('data-lang');

var months = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
var days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

var dayHeader = "<tr>";
for (day in days) {
  dayHeader += "<th data-days='" + days[day] + "'>" + days[day] + "</th>";
}
dayHeader += "</tr>";

document.getElementById("thead-month").innerHTML = dayHeader;


monthAndYear = document.getElementById("monthAndYear");
showCalendar(currentMonth, currentYear);



function next() {
  currentYear = (currentMonth === 11) ? currentYear + 1 : currentYear;
  currentMonth = (currentMonth + 1) % 12;
  showCalendar(currentMonth, currentYear);
}

function previous() {
  currentYear = (currentMonth === 0) ? currentYear - 1 : currentYear;
  currentMonth = (currentMonth === 0) ? 11 : currentMonth - 1;
  showCalendar(currentMonth, currentYear);
}

function jump() {
  currentYear = parseInt(selectYear.value);
  currentMonth = parseInt(selectMonth.value);
  showCalendar(currentMonth, currentYear);
}

function showCalendar(month, year) {

  var firstDay = ( new Date( year, month ) ).getDay();

  tbl = document.getElementById("calendar-body");

  
  tbl.innerHTML = "";

  
  monthAndYear.innerHTML = months[month] + " " + year;
  selectYear.value = year;
  selectMonth.value = month;

  // creating all cells
  var date = 1;
  for ( var i = 0; i < 6; i++ ) {
      var row = document.createElement("tr");

      for ( var j = 0; j < 7; j++ ) {
          if ( i === 0 && j < firstDay ) {
              cell = document.createElement( "td" );
              cellText = document.createTextNode("");
              cell.appendChild(cellText);
              row.appendChild(cell);
          } else if (date > daysInMonth(month, year)) {
              break;
          } else {
              cell = document.createElement("td");
              cell.setAttribute("data-date", date);
              cell.setAttribute("data-month", month + 1);
              cell.setAttribute("data-year", year);
              cell.setAttribute("data-month_name", months[month]);
              cell.className = "date-picker";
              cell.innerHTML = "<span>" + date + "</span>";
              if ( date === today.getDate() && year === today.getFullYear() && month === today.getMonth() ) {
                  cell.className = "date-picker selected";
                  cell.title = "Today";
              }
              if ( date === {{date('d', strtotime($event['event']['start']))}} && year === {{date('Y', strtotime($event['event']['start']))}} && month === {{date('m', strtotime($event['event']['start']))-1}} ) {
                  cell.className = "date-picker selected-event";
                  cell.title = "Event : {{$event['event']['name']}}";
              }
              row.appendChild(cell);
              date++;
          }


      }

      tbl.appendChild(row);
  }

}

function daysInMonth(iMonth, iYear) {
  return 32 - new Date(iYear, iMonth, 32).getDate();
}
</script>

@endsection