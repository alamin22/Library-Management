@extends('Layouts.library-index')
@section('css')
    <link rel="stylesheet" href="{{asset('css')}}/Chart.min.css">
@endsection
@section('js')
    <script src="{{asset('js')}}/Chart.min.js"></script>
@endsection
@section('title')
   Dashboard
@endsection
@section('container')
    <!-- ============================================================== -->
    <!-- end pageheader  -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper m-b-30">
        <div class="edumaster-widget">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 m-t-20">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <h3 class="text-muted">Total Member</h3>
                                    <h1 class="mb-1">{{$totalMember}}</h1>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 m-t-20">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <h3 class="text-muted">Total Books</h3>
                                    <h1 class="mb-1">{{$totalBook}}</h1>
                                </div>
                                <div class="row">
                                    <div class="col-6">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 m-t-20">
                        <div class="card h-100 shadow">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <h3 class="text-muted">Library Book</h3>
                                    <h1 class="mb-1"></h1>
                                </div>
                                <div class="row">
                                    <div class="col-6">
                                        <h3>Issue : {{$totalIssue}}</h3>
                                    </div>
                                    <div class="col-6">
                                        <div class="m-l-p-30">
                                            <h3>Return : {{$totalReturn}}</h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 m-t-30">
                        <div class="card h-auto shadow">
                            <div class="card-body">
                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-5 col-sm-12 col-12">
                                                <img src="{{asset('images/admin')}}/{{$admin->admin_image}}" class="img-fluid" alt="" width="200" height="200">
                                        </div>
                                        <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12">
                                            <div class="">
                                                <h3>{{$admin->admin_name}}</h3>
                                                <h4>designation: &nbsp;:&nbsp; {{$admin->designation}}</h4>
                                                <h5>Mobile: &nbsp;:&nbsp; {{$admin->admin_phone}}</h5>
                                                <h5>Email: &nbsp;:&nbsp; {{$admin->admin_email}}</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" style="margin-top: 20%;">
                                        <div class="col-12">
                                            <hr/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-10 col-lg-4 col-md-12 col-sm-12 col-12">
                                            <h2>
                                            </h2>
                                        </div>
                                        <div class="col-xl-2 col-lg-4 col-md-12 col-sm-12 col-12">
                                            <a class="btn btn-primary" href="{{route('admin.adminProfile')}}">Change</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 col-12 m-t-30">
                        <div class="card h-auto shadow">
                            <div class="card-header">
                                <div class="text-center">
                                    <h3>Calender</h3>
                                </div>
                            </div>
                            <div class="row">
                                <h3 class="card-header" id="monthAndYear" style="margin-top:0.5rem;"></h3>
                                <form class="form-inline col-sm-8" id="jumpto">
                                        <label class="lead mr-2 ml-2 col-sm-4" style="margin-top:0.5rem;" for="month">Jump To: </label>
                                        <select class="custom-select" name="month" id="month" onchange="jump()" style="margin-top:0.5rem;">
                                            <option value=0>January</option>
                                            <option value=1>February</option>
                                            <option value=2>March</option>
                                            <option value=3>April</option>
                                            <option value=4>May</option>
                                            <option value=5>June</option>
                                            <option value=6>July</option>
                                            <option value=7>August</option>
                                            <option value=8>September</option>
                                            <option value=9>October</option>
                                            <option value=10>November</option>
                                            <option value=11>December</option>
                                        </select>
                                        &emsp;
                                        &emsp;
                                        &emsp;
                                        <label for="year"></label><select class="custom-select col-sm-" name="year" id="year" onchange="jump()" style="margin-top:0.5rem;">
                                            <option value=1990>1990</option>
                                            <option value=1991>1991</option>
                                            <option value=1992>1992</option>
                                            <option value=1993>1993</option>
                                            <option value=1994>1994</option>
                                            <option value=1995>1995</option>
                                            <option value=1996>1996</option>
                                            <option value=1997>1997</option>
                                            <option value=1998>1998</option>
                                            <option value=1999>1999</option>
                                            <option value=2000>2000</option>
                                            <option value=2001>2001</option>
                                            <option value=2002>2002</option>
                                            <option value=2003>2003</option>
                                            <option value=2004>2004</option>
                                            <option value=2005>2005</option>
                                            <option value=2006>2006</option>
                                            <option value=2007>2007</option>
                                            <option value=2008>2008</option>
                                            <option value=2009>2009</option>
                                            <option value=2010>2010</option>
                                            <option value=2011>2011</option>
                                            <option value=2012>2012</option>
                                            <option value=2013>2013</option>
                                            <option value=2014>2014</option>
                                            <option value=2015>2015</option>
                                            <option value=2016>2016</option>
                                            <option value=2017>2017</option>
                                            <option value=2018>2018</option>
                                            <option value=2019>2019</option>
                                            <option value=2020>2020</option>
                                            <option value=2021>2021</option>
                                            <option value=2022>2022</option>
                                            <option value=2023>2023</option>
                                            <option value=2024>2024</option>
                                            <option value=2025>2025</option>
                                            <option value=2026>2026</option>
                                            <option value=2027>2027</option>
                                            <option value=2028>2028</option>
                                            <option value=2029>2029</option>
                                            <option value=2030>2030</option>
                                        </select>
                                </form>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="calendar">
                                    <thead class="bg-light">
                                    <tr class="border-0">
                                        <th class="border-0">Sun</th>
                                        <th class="border-0">Mon</th>
                                        <th class="border-0">Tue</th>
                                        <th class="border-0">Wed</th>
                                        <th class="border-0">Thu</th>
                                        <th class="border-0">Fri</th>
                                        <th class="border-0">Sat</th>
                                    </tr>
                                    </thead>
                                    <tbody id="calendar-body">
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-inline mt-2">
                                <button class="btn btn-outline-primary col-sm-5 d-block m-auto" id="previous" onclick="previous()">Previous</button>
                                &emsp;
                                &emsp;
                                &emsp;
                                <button class="btn btn-outline-primary col-sm-5 d-block m-auto" id="next" onclick="next()">Next</button>
                            </div>
                            <br/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        let today = new Date();
        let currentMonth = today.getMonth();
        let currentYear = today.getFullYear();
        let selectYear = document.getElementById("year");
        let selectMonth = document.getElementById("month");
        let months = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        let monthAndYear = document.getElementById("monthAndYear");
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
            let firstDay = (new Date(year, month)).getDay();
            let daysInMonth = 32 - new Date(year, month, 32).getDate();
            let tbl = document.getElementById("calendar-body"); // body of the calendar
            // clearing all previous cells
            tbl.innerHTML = "";
            // filing data about month and in the page via DOM.
            monthAndYear.innerHTML = months[month] + " " + year;
            selectYear.value = year;
            selectMonth.value = month;
            // creating all cells
            let date = 1;
            for (let i = 0; i < 6; i++) {
                // creates a table row
                let row = document.createElement("tr");
                //creating individual cells, filing them up with data.
                for (let j = 0; j < 7; j++) {
                    if (i === 0 && j < firstDay) {
                        let cell = document.createElement("td");
                        let cellText = document.createTextNode("");
                        cell.appendChild(cellText);
                        row.appendChild(cell);
                    }
                    else if (date > daysInMonth) {
                        break;
                    }
                    else {
                        let cell = document.createElement("td");
                        let cellText = document.createTextNode(date);
                        if (date === today.getDate() && year === today.getFullYear() && month === today.getMonth()) {
                            cell.classList.add("bg-one");
                        } // color today's date
                        cell.appendChild(cellText);
                        row.appendChild(cell);
                        date++;
                    }
                }

                tbl.appendChild(row); // appending each row into calendar body.
            }

        }
    </script>
    <script>
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = 'Nunito', '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#858796';

        function number_format(number, decimals, dec_point, thousands_sep) {
            // *     example: number_format(1234.56, 2, ',', ' ');
            // *     return: '1 234,56'
            number = (number + '').replace(',', '').replace(' ', '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function(n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }

        // Area Chart Example
        var ctx = document.getElementById("myAreaChart");
        var myLineChart = new Chart(ctx, {
            type: 'line',
            data: {
                labels: ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"],
                datasets: [{
                    label: "Earnings",
                    lineTension: 0.3,
                    backgroundColor: "rgba(240, 90, 40, 0.2)",
                    borderColor: "rgba(240, 90, 40, 1)",
                    pointRadius: 3,
                    pointBackgroundColor: "rgba(240, 90, 40, 1)",
                    pointBorderColor: "rgba(240, 90, 40, 1)",
                    pointHoverRadius: 3,
                    pointHoverBackgroundColor: "rgba(240, 90, 40, 1)",
                    pointHoverBorderColor: "rgba(240, 90, 40, 1)",
                    pointHitRadius: 10,
                    pointBorderWidth: 2,
                    data: [0, 10000, 5000, 15000, 10000, 20000, 15000, 25000, 20000, 30000, 25000, 40000],
                }],
            },
            options: {
                maintainAspectRatio: false,
                layout: {
                    padding: {
                        left: 10,
                        right: 25,
                        top: 25,
                        bottom: 0
                    }
                },
                scales: {
                    xAxes: [{
                        time: {
                            unit: 'date'
                        },
                        gridLines: {
                            display: false,
                            drawBorder: false
                        },
                        ticks: {
                            maxTicksLimit: 7
                        }
                    }],
                    yAxes: [{
                        ticks: {
                            maxTicksLimit: 5,
                            padding: 10,
                            // Include a dollar sign in the ticks
                            callback: function(value, index, values) {
                                return 'Tk. ' + number_format(value);
                            }
                        },
                        gridLines: {
                            color: "rgb(234, 236, 244)",
                            zeroLineColor: "rgb(234, 236, 244)",
                            drawBorder: false,
                            borderDash: [2],
                            zeroLineBorderDash: [2]
                        }
                    }],
                },
                legend: {
                    display: false
                },
                tooltips: {
                    backgroundColor: "rgb(255,255,255)",
                    bodyFontColor: "#858796",
                    titleMarginBottom: 10,
                    titleFontColor: '#6e707e',
                    titleFontSize: 14,
                    borderColor: '#dddfeb',
                    borderWidth: 1,
                    xPadding: 15,
                    yPadding: 15,
                    displayColors: false,
                    intersect: false,
                    mode: 'index',
                    caretPadding: 10,
                    callbacks: {
                        label: function(tooltipItem, chart) {
                            var datasetLabel = chart.datasets[tooltipItem.datasetIndex].label || '';
                            return datasetLabel + ': Taka ' + number_format(tooltipItem.yLabel);
                        }
                    }
                }
            }
        });

    </script>
@endsection
