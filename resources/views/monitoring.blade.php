@extends('layout.content')

@section('content-css')

<!-- <link href="https://cdn.datatables.net/2.1.2/css/dataTables.dataTables.min.css" rel="stylesheet" type="text/css"> -->
<!-- <link href="https://cdn.datatables.net/2.1.2/css/dataTables.bootstrap4.css" rel="stylesheet" type="text/css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css" rel="stylesheet" type="text/css"> -->



<link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
<link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css">

<!-- Responsive datatable examples -->
<link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css">
 
@endsection

@section('content-card')
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <select id="plant_type" class="form-select mb-3">
                    <option value="cabai">Daun Bawang</option>
                    <option value="tomat">Tomat</option>
                </select>

                <!-- tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-bs-toggle="tab" href="#monitoring" role="tab">
                            <span class="d-none d-md-block">Monitoring</span><span class="d-block d-md-none"><i class="mdi mdi-home-variant h5"></i></span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-bs-toggle="tab" href="#history" role="tab">
                            <span class="d-none d-md-block">History</span><span class="d-block d-md-none"><i class="mdi mdi-account h5"></i></span>
                        </a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active p-3" id="monitoring" role="tabpanel">
                        <div id="monitoring_cabai" class="row card-cabai">
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                        <div>
                                            <h4 class="mb-1 mt-1"> Kelembaban (RF) </h4>
                                        </div>
                                        <div class="d-flex bd-highlight">
                                            <div class="p-2">
                                            <h4 id="cabai_humidity_soil">-</h4>
                                            </div>
                                            <div class="p-2 flex-grow-1 bd-highlight">
                                            <div class="progress" style="height: 25px;">
                                                <div class="progress-bar bg-info cabai_humidity_soil_progress" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            </div>
                                            <div class="p-2 bd-highlight">
                                            <h4>%</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                    <div class="float-end mt-2">
                                        <div class="p-2 flex-grow-1 bd-highlight icon-demo-content">
                                        <div class="col-xl-3">
                                            <i class="uil-raindrops-alt" style="height: 45px; width: 45px;"></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 mt-1"> pH Tanah </h4>
                                        <h4 id="cabai_ph_soil">-</h4>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                    <div class="float-end mt-2">
                                        <div class="p-2 flex-grow-1 bd-highlight icon-demo-content">
                                        <div class="col-xl-3">
                                            <i class="uil-sun" style="height: 45px; width: 45px;"></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 mt-1"> Intensitas Cahaya </h4>
                                        <h4 id="cabai_lux">-</h4>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                        <div>
                                            <h4 class="mb-1 mt-1"> Kelembaban (LoRa) </h4>
                                        </div>
                                        <div class="d-flex bd-highlight">
                                            <div class="p-2">
                                            <h4 id="cabai_lora">-</h4>
                                            </div>
                                            <div class="p-2 flex-grow-1 bd-highlight">
                                            <div class="progress" style="height: 25px;">
                                                
                                            <div class="progress-bar bg-info cabai_lora_progress" role="progressbar" style="width: 0%" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            </div>
                                            <div class="p-2 bd-highlight">
                                            <h4>%</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                            <div class="card bg-secondary">
                                <div class="card-body">
                                    <div class="float-end mt-2">
                                        <div class="p-2 flex-grow-1 bd-highlight icon-demo-content">
                                            <div class="col-xl-3">
                                                <i class="uil-pump" style="height: 45px; width: 45px;"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 mt-1"> Status Penyiraman </h4>
                                        <h4 id="cabai_status_valve">-</h4>
                                    </div>
                                </div>
                            </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div class="p-2 flex-grow-1 bd-highlight icon-demo-content">
                                                <div class="col-xl-3">
                                                    <i class="uil-wifi" style="height: 45px; width: 45px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"> Sinyal (LoRa) </h4>
                                            <h4 id="cabai_rssi"> - dbm</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-12 d-none" id="cabai_alert">
                                <div class="d-flex justify-content-center">
                                    <div class="alert alert-warning d-flex align-items-center" role="alert" style="width: 30%">
                                        <svg height="32" width="32" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                                            viewBox="0 0 512 512" xml:space="preserve">
                                            <polygon style="fill:#FFFFFF;" points="13.728,473.992 256,46.24 498.272,473.992 "/>
                                            <path style="fill:#DB2B42;" d="M256,62.472l228.552,403.52H27.448L256,62.472 M256,30.008L0,481.992h512L256,30.008L256,30.008z"/>
                                            <path style="fill:#2D2D2D;" d="M226.112,396.344c0-17.216,12.024-29.56,29.232-29.56c17.216,0,28.584,12.344,28.912,29.56
                                                c0,16.888-11.368,29.552-28.912,29.552C237.808,425.896,226.112,413.232,226.112,396.344z M236.84,350.536l-7.48-147.144h51.648
                                                l-7.152,147.152L236.84,350.536L236.84,350.536z"/>
                                        </svg>
                                        <div class="mx-2">
                                            pH dibawah 6
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="monitoring_tomat" class="row card-tomat d-none">
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div class="p-2 flex-grow-1 bd-highlight icon-demo-content">
                                            <div class="col-xl-3">
                                                <i class="uil-temperature-three-quarter" style="height: 45px; width: 45px;"></i>
                                            </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"> Suhu </h4>
                                            <h4 id="tomat_temperature">-&deg;C</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                        <div>
                                            <h4 class="mb-1 mt-1"> Kelembaban </h4>
                                        </div>
                                        <div class="d-flex bd-highlight">
                                            <div class="p-2">
                                            <h4 id="tomat_humidity">-</h4>
                                            </div>
                                            <div class="p-2 flex-grow-1 bd-highlight">
                                            <div class="progress" style="height: 25px;">
                                                <div class="progress-bar bg-info" role="progressbar" style="width: 0%" aria-valuenow="89" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            </div>
                                            <div class="p-2 bd-highlight">
                                            <h4>%</h4>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                    <div class="float-end mt-2">
                                        <div class="p-2 flex-grow-1 bd-highlight icon-demo-content">
                                        <div class="col-xl-3">
                                            <i class="uil-raindrops-alt" style="height: 45px; width: 45px;"></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 mt-1"> pH Air </h4>
                                        <h4 id="tomat_ph_soil">-</h4>
                                    </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                        <div class="float-end mt-2">
                                            <div class="p-2 flex-grow-1 bd-highlight icon-demo-content">
                                                <div class="col-xl-3">
                                                    <i class="uil-wifi" style="height: 45px; width: 45px;"></i>
                                                </div>
                                            </div>
                                        </div>
                                        <div>
                                            <h4 class="mb-1 mt-1"> TDS </h4>
                                            <h4 id="tomat_tds"></h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                    <div class="float-end mt-2">
                                        <div class="p-2 flex-grow-1 bd-highlight icon-demo-content">
                                        <div class="col-xl-3">
                                            <i class="uil-sun" style="height: 45px; width: 45px;"></i>
                                        </div>
                                        </div>
                                    </div>
                                    <div>
                                        <h4 class="mb-1 mt-1"> Intensitas Cahaya </h4>
                                        <h4 id="tomat_lux">-</h4>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tab-pane p-3" id="history" role="tabpanel">
                        <div id="history_cabai" class="card-cabai">
                            <table id="datatable_cabai" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Kelembaban RF</th>
                                        <th>Kelembaban LoRa</th>
                                        <th>pH</th>
                                        <th>Intensitas Cahaya</th>
                                        <th>Valve</th>
                                        <th>Dbm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                        <div id="history_tomat" class="card-tomat d-none">
                            <table id="datatable_tomat" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Time</th>
                                        <th>Suhu</th>
                                        <th>Kelembaban</th>
                                        <th>pH Air</th>
                                        <th>TDS</th>
                                        <th>Intensitas Cahaya</th>
                                        <th>Dbm</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-js')
    <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

    <script>
        $(document).ready(function() {
            let grid_cabai = $('#datatable_cabai').dataTable({
                columns: [
                    {
                        data: 'time',
                        name: 'time',
                    },
                    {
                        data: 'humidity_soil',
                        name: 'humidity_soil',
                    },
                    {
                        data: 'humidity_soil_lora',
                        name: 'humidity_soil_lora',
                    },
                    {
                        data: 'ph_soil',
                        name: 'ph_soil',
                    },
                    {
                        data: 'lux',
                        name: 'lux',
                    },
                    {
                        data: 'status_valve',
                        name: 'status_valve',
                    },
                    {
                        data: 'rssi',
                        name: 'rssi',
                    },
                ]
            });
            let grid_tomat = $('#datatable_tomat').dataTable({
                columns: [
                    {
                        data: 'time',
                        name: 'time',
                    },
                    {
                        data: 'temperature',
                        name: 'temperature',
                    },
                    {
                        data: 'humidity',
                        name: 'humidity',
                    },
                    {
                        data: 'DataPH',
                        name: 'DataPH',
                    },
                    {
                        data: 'DataTDS',
                        name: 'DataTDS',
                    },
                    {
                        data: 'lux',
                        name: 'lux',
                    },
                    {
                        data: 'dbm',
                        name: 'dbm',
                    },
                ]
            });
            let flatpickr = $("#selected_date").flatpickr(
                {
                    inline: true,
                    maxDate: "today",
                    onChange: function(dateObj, dateStr) {
                        getData(dateStr)
                    }
                }
            );
            
            $("#plant_type").change(function() {
                if (this.value === 'tomat') {
                    $('.card-cabai').addClass('d-none')
                    $('.card-tomat').removeClass('d-none')
                } else {
                    $('.card-cabai').removeClass('d-none')
                    $('.card-tomat').addClass('d-none')
                }
            });

            // $("li").click(function (event) {        
            //     let active_tab = $(this).find('a').attr('href');        
            //     alert(active_tab);
            // });
 
            getData("{{ Carbon\Carbon::now()->format('Y-m-d') }}")
            function getData(date_selected){
                $.ajax({
                    url: "{{env('APP_URL')}}" + '/api/monitoring/data-device?date=' + date_selected,
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json'
                    },
                    method: "GET",
                    success: function(item) {
                        mapCardTomat(item.tomat.card)
                        mapCardCabai(item.cabai.card)
                        refreshTomatTable(item.tomat.collection)
                        refreshCabaiTable(item.cabai.collection)
                    },
                    error: function(err) {
                        refreshTomatTable([])
                        refreshCabaiTable([])
                    }
                });
            }

            function refreshCabaiTable(data_cabai) {
                $('#datatable_cabai').DataTable().clear().rows.add(data_cabai).draw();
            }

            function refreshTomatTable(data_tomat) {
                $('#datatable_tomat').DataTable().clear().rows.add(data_tomat).draw();
            }

            function mapCardTomat(cards) {
                if (cards != null) {
                    $('#tomat_humidity').html(cards.humidity)
                    $('#tomat_lux').html(cards.lux)
                    $('#tomat_ph_soil').html(cards.DataPH)
                    $('#tomat_tds').html(cards.DataTDS)
                    $('#tomat_rssi').html(cards.rssi)
                    $('#tomat_status_valve').html(cards.status_valve)
                    $('#tomat_temperature').html(cards.temperature)
                } else {
                    $('#tomat_humidity').html("-")
                    $('#tomat_lux').html("-")
                    $('#tomat_ph_soil').html("-")
                    $('#tomat_rssi').html("-")
                    $('#tomat_status_valve').html("-")
                    $('#tomat_tds').html("-")
                    $('#tomat_temperature').html("-")
                }
            }

            function mapCardCabai(cards) {
                if (cards != null) {
                    $('#cabai_humidity_soil').html(cards.humidity_soil)
                    $('#cabai_lux').html(cards.lux)
                    $('#cabai_ph_soil').html(cards.ph_soil)
                    $('#cabai_rssi').html(cards.rssi + " dbm")
                    $('#cabai_status_valve').html(cards.status_valve ? 'Aktif' : 'Tidak Aktif')
                    $('#cabai_ph_soil').html(cards.ph_soil)
                    $('#cabai_lora').html(cards.humidity_soil_lora)
                    $('.cabai_lora_progress').css('width', cards.humidity_soil_lora + '%')
                    $('.cabai_humidity_soil_progress').css('width', cards.humidity_soil + '%')

                    if (cards.ph_soil < 6) {
                        $('#cabai_alert').removeClass('d-none')
                    } else {
                        $('#cabai_alert').addClass('d-none')
                    }
                } else {
                    $('#cabai_humidity_soil').html("-")
                    $('#cabai_lux').html("-")
                    $('#cabai_ph_soil').html("-")
                    $('#cabai_rssi').html("- dbm")
                    $('#cabai_status_valve').html("-")
                    $('#cabai_ph_soil').html("-")
                    $('#cabai_lora').html("-")
                    $('.cabai_lora_progress').css('width', '0%')
                    $('.cabai_humidity_soil_progress').css('width', '0%')
                    $('#cabai_alert').addClass('d-none')
                }
            }
        });
    </script>
@endsection