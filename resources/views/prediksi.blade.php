@extends('layout.base')

@section('css')
    <style>
        body video {
            transition: filter 250ms linear;
        }

        body.loading video {
            filter: grayscale(1) brightness(0.25);
        }

        video, canvas {
            width: 100%;
            height: 100%;
            margin: 0;
            padding: 0;
        }

        canvas {
            z-index: 2000; 
            position: absolute;
            left: 0px;
        }
    </style>
@endsection

@section('content-body')
    <div class="page-content">
        <div class="container-fluid">
            <div>
                <div class="row">
                    <div class="col-2" style="width: 8% !important">
                        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 128 128"><path fill="#ff2a23" d="M119.77 69.38s1.71-13.05-1.4-18.95s-12.71-18.93-32.62-21.28c-10.56-1.24-17.71.16-24.23.93c-4.13.49-11.82-2.05-25.63 1.09C25.65 33.5 10.11 42.51 5.06 61.93C2.4 72.16 3.41 83.21 7.94 92.52c8.7 17.86 24.85 22.21 24.85 22.21l32.46 2.64l39.3-16.62z"/><path fill="#dc0d27" d="M82.03 119.08c20.66-4.04 38.52-22.52 41.63-42.09c2.91-18.31-7.79-30.58-7.79-30.58s1.22 9.77-1.06 20.18c-2.45 11.14-9.54 29.71-32 40.23c-27.57 12.91-57.77 4.4-57.77 4.4s20.52 14.99 56.99 7.86"/><path fill="#fed3b0" d="M24.92 52.76c-5.49-1.42-12.34 2.73-13.33 14.88c-.91 11.13 5.12 24.54 11.03 22.94c5.02-1.36.19-10.66 1.98-18.29c1.81-7.63 8.69-17.36.32-19.53"/><path fill="#bdcf44" d="M31.87 46.05c-.78 1.01 1.03 5.45 10.22 5.39c9.18-.06 10.72-2.83 14.81-1.59s7.28 6.16 11.8 8.85c6.32 3.76 15.44 2.8 15.38 1.13c-.06-1.68-2.29-.82-4.21-3.17c-1.92-2.36-5.32-8.59-5.32-8.59s.95-2.92 2.96-2.81c4.64.25 9.8-.67 12.64-2.45c3.4-2.12 4.68-5.39 4.06-6.14c-.62-.74-2.55 1.26-3.6 1.07s-7.88-.06-7.88-.06l-8.25-1.34s1.13-4.83 3.36-7.31c2.23-2.48 5.73-5.89 5.66-6.32s-2.88-.05-2.88-.05l-8.69 3.97l-6.08 8l-11.54 1.49l-11.11-7.45s-6.37-5.14-6.66-5.02c-1.61.66.84 3.11 2.69 6.07c1.6 2.57 1.93 3.86 4.09 5.65c2.11 1.74 5.65 3.47 5.65 3.47l-2.54 4.59s-8.19 3.23-9.62 3.23c-1.42.01-4.51-1.16-4.94-.61"/><path fill="#94a61d" d="M57.51 43.28c3.35.25 5.77 4.7 8.79 7.73c4.41 4.41 7.86 6.71 11.57 7.58c1.86.43 6.13 1.14 6.13 1.14s.62-.43-1.49-1.61c-2.11-1.18-3.38-3.44-3.69-4.49c-.31-1.05-1.28-4.5-3.32-7.36s-4.36-4.07-3.62-5.37c.74-1.3 7.14.9 13.3-.09c8.13-1.3 9.37-3.91 9-4.22c-.37-.31-5.4 1.18-7.94.62c-2.54-.56-4.72-2.3-8.56-2.3c-2.62 0-5.18.95-5.87-.48c-.58-1.2 1.6-5.21 3.26-6.72c4.03-3.66 8.38-4.53 8.38-5.03c0-1.03-7.07-1.61-11.97 2.3c-4.88 3.89-3.96 9-10.3 9c-2.11 0-2.92-.5-2.92-.5s-2.83-2.33-6.61-4.38c-3.78-2.05-6.63-1.14-8.81-2.19c-2.17-1.05-6.02-3.77-6.39-3.22s2.89 4.27 6.99 7.31s8.69 4.59 7.38 5.83c-1.3 1.24-3.47 2.05-5.52 3.6c-2.05 1.55-3.85 3.78-6.33 4.59s-6.56.24-7.12.92c-.56.68 4.32 3.03 11.95 1.61c7.61-1.42 7.63-4.72 13.71-4.27"/><path fill="#728035" d="M65.12 4.94c-1.67-.08-3.78 1.24-3.78 1.24s-3.06 3.73-4.27 12.99c-.56 4.28.05 10.03-.07 13.2c-.12 3.16-.81 4.34-.62 5.96c.19 1.61 1.88 3.43 5.79 3.39c3.14-.03 4.76-2.46 4.7-3.33c-.06-.87-2.75-9.74-1.99-17.56c.71-7.27 3.36-12.29 3.47-13.34c.06-.57-.69-2.43-3.23-2.55"/></svg>
                    </div>
                    <div class="col">
                        <h1 class="pt-2">Tanaman Tomat</h1>
                    </div>
                </div>
                <div class="row my-4">
                    <div class="col" style="width: 8% !important">
                    <table class="table table-borderless h3">
                        <tbody>
                            <tr>
                                <td style="font-weight: bolder;">Kualitas Tanaman </td>
                                <td style="font-weight: normal;">: {{ $data['quality'] ?? "-"}} </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bolder;">Masukan </td>
                                <td style="font-weight: normal;">
                                    <p>
                                        : {{ $data['suggestion'] ?? "-"}}
                                    </p>
                                </td>
                            </tr>
                            <tr>
                                <td style="font-weight: bolder;">Keakuratan </td>
                                <td style="font-weight: normal;">: {{ $data['percentage'] ?? "-"}} </td>
                            </tr>
                        </tbody>
                    </table>
                    </div>
                    <div class="col">
                        <div class="col-md-12 mb-4">
                            <div class="card">
                                <div class="card-block p-3">
                                    <div id="video-canvas">
                                        <video id="video" autoplay muted playsinline width="640" height="320"></video>
                                        
                                    </div>
                                    <!-- <video controls autoplay width="640" height="320">
                                        <source src="assets/videos/tomatoes.mp4" type="video/mp4">
                                        Your browser does not support the video tag.
                                    </video> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/lodash.js/4.17.20/lodash.min.js"
        integrity="sha512-90vH1Z83AJY9DmlWa8WkjkV79yfS2n2Oxhsi2dZbIv0nC4E6m5AbH8Nh156kkM7JePmqD6tcZsfad1ueoaovww=="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/async/3.2.0/async.min.js"
        integrity="sha512-6K6+H87tLdCWvY5ml9ZQXLRlPlDEt8uXmtELhuJRgFyEDv6JvndWHg3jadJuBVGPEhhA2AAt+ROMC2V7EvTIWw=="
        crossorigin="anonymous"></script>
    <script src="https://cdn.roboflow.com/0.2.26/roboflow.js"></script>
    <script src="assets/js/main.js"></script>
@endsection