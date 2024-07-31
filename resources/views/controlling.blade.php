@extends('layout.content')

@section('content-css')
@endsection

@section('content-card')
    <div class="col-12">
        <div class="card">
            <div class="card-body bg-secondary">
                <div class="text-center py-2"><h2>Penyiraman</h2></div>
                <div class="card pt-4">
                    <div class="card-body">
                        <div class="row my-2">
                            <div class="col-4">
                                <form id="form-request">
                                    <div class="text-center">
                                        <div class="my-4">
                                            <p>Set Automatic</p>
                                            <input class="form-check form-switch" type="checkbox" id="otomatis" checked switch="none">
                                            <label class="form-label" for="otomatis" data-on-label="On" data-off-label="Off"></label>
                                        </div>
                                        <div class="my-4">
                                            <p>Set Penyiraman</p>
                                            <input class="form-check form-switch" type="checkbox" id="penyiraman" switch="none">
                                            <label class="form-label" for="penyiraman" data-on-label="On" data-off-label="Off"></label>
                                        </div>

                                        <button id="controlling_button" class="btn btn-info">Send Data</button>
                                    </div>
                                </form>
                            </div>
                            <div class="col-8">
                                <div class="card bg-secondary">
                                    <div class="card-body">
                                        <h5 class="card-title">
                                            <p class="text-center">Informasi!</p>
                                            <ol>
                                                <li>Selalu klik send data apabila ada perubahan</li>
                                                <li>Hanya bisa mengaktifkan salah satu</li>
                                            </ol>
                                        </h5>
                                    </div>
                                </div>
                            </div>
                        
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('content-js')
    <script>
        $(document).ready(function() {
            let status_otomatis = 1;
            let status_penyiraman = 0;
            let flatpickr = $("#selected_date").flatpickr(
                {
                    inline: true,
                }
            );

            $("#otomatis").change(function (){
                if ($(this).prop('checked') === true) {
                    $('#penyiraman').prop('checked', false);
                    status_penyiraman = 0;
                    status_otomatis = 1;
                    // $('#show').text($(this).attr('value'));
                } else {
                    $('#penyiraman').prop('checked', true);
                    status_penyiraman = 1;
                    status_otomatis = 0;
                }
            })

            $("#penyiraman").change(function (){
                if ($(this).prop('checked') === true) {
                    $('#otomatis').prop('checked', false);
                    status_otomatis = 0;
                    status_penyiraman = 1;
                } else {
                    $('#otomatis').prop('checked', true);
                    status_otomatis = 1;
                    status_penyiraman = 0;
                }
            })

            $("#controlling_button").click(function (e) {
                e.preventDefault();
                const payload = {
                    "m2m:cin": {
                        "con": JSON.stringify({
                            "setAutomatic": status_otomatis,
                            "setValve": status_penyiraman
                        })
                    }
                };
                if (confirm("Data akan dikirim. Apakah anda yakin?")) {
                    $.ajax({
                        url: "{{env('APP_URL')}}" + '/api/controlling/send-data',
                        headers: {
                            'Accept': 'application/json',
                            'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                        },
                        method: "POST",
                        dataType: 'json',
                        data: payload,
                        success: function(item) {
                            alert('Berhasil kirim data!')
                        },
                        error: function(err) {
                            alert('Gagal kirim data!')
                        }
                    });
                }
            })
        });
    </script>
@endsection