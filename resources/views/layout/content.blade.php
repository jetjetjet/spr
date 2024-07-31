@extends('layout.base')

@section('css')
    @yield('content-css')
@endsection

@section('content-body')
    <div class="page-content">
        <div class="container-fluid">
            <div class="d-flex bd-highlight">
                <div class="p-2 bd-highlight">
                    <!-- DATEPICKER -->
                     <input type="text" class="d-none" name="selected_date" id="selected_date">
                </div>
                <div class="p-2 flex-grow-1">
                    <div class="row">
                        <div class="col-12">
                            <div class="card mb-3" style="border-color: #007bff !important; border-width: 1px !important; border-radius: 20px !important">
                                <div class="card-body mb-3">
                                    <div class="media d-flex">
                                    <div class="ms-3 me-4">
                                        <h1 class="display-1 my-2 text-center">
                                        <i class="uil uil-{{ $data['weather_icon']}} fa-lg"></i>
                                        </h1>
                                    </div>
                                    <div class="media-body align-self-center">
                                        <p class="mb-2 fs-5">
                                        <strong>Lembang</strong> - {{ $data['weather']}}
                                        </p>
                                        <div class="">
                                        <table class="table">
                                            <tbody>
                                            <tr>
                                                <td scope="row" class="align-middle border-right border-top-0 border-bottom-0 fw-bold fs-1">{{$data['temperature']}}° C</td>
                                                <td class="align-middle border-right border-top-0 border-bottom-0" style="border-width: 2px; border-color: black;">
                                                <span class="fs-4 fw-bold">{{$data['humidity']}}</span>
                                                <p class="mb-0">
                                                    <small>Humidity</small>
                                                </p>
                                                </td>
                                                <td class="align-middle border-right border-top-0 border-bottom-0" style="border-width: 2px; border-color: black;">
                                                <span class="fs-4 fw-bold">{{$data['lux']}}</span>
                                                <p class="mb-0">
                                                    <small>Lux</small>
                                                </p>
                                                </td>
                                                <td class="align-middle border-right border-top-0 border-bottom-0 border-right-0">
                                                <span class="fs-4 fw-bold">-</span>
                                                <p class="mb-0">
                                                    <small>Wind</small>
                                                </p>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        @yield('content-card')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    @yield('content-js')
@endsection