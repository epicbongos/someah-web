@extends('layout.layout')
@section('title','Layanan Kami')

@section('content')
    <div class="container-fluid">

        <!-- judul -->

        <div class="row">
            <div class="container wrapper-container">
                {{--            <h1 class="judul-page"><span style="color: #0E9D4B;">Layanan</span> Kami</h1>--}}
                <h1 class="judul-page"><span style="color: #008A85;">Layanan</span> Kami</h1>
                <hr class="underline-center">
                <p class="ml-5 mr-5 mt-4 text-center">Kami memberikan berbagai jenis layanan sesuai dengan media dan
                    aplikasi yang anda butuhkan.
                    Berikut adalah jasa dan layanan kami yang dapat anda pilih untuk mendukung kenyamanan bisnis dan
                    aktivitas anda di dunia digital.</p>
            </div>
        </div>

        <!-- layanan 1 -->
        @foreach($layanan as $val)
            <div class="container item">
                <div class="row">
                    <a href="{{ url('layanan/detail-layanan/'.$val->slug) }}">
                        <div class="col-4 left">
                            <img src="{{asset("uploaded/tipe_project/$val->gambar")}}" alt="Aplikasi Mobile">
                        </div>
                        <div class="col-8 right">
                            <h2>{{$val->tipe_project}}</h2>
                            <p>{{$val->desc}}</p><br>
                            <p class="text-keahlian">Keahlian kami menggunakan :</p>
                            <ul>
                                @foreach($val->tipe_project_detail as $value)
                                    <li>{{$value->bahasa_pemrograman}}</li>
                                @endforeach
                            </ul>
                        </div>
                        <div class="clearfix"></div>
                    </a>
                </div>
            </div>
        @endforeach

        <div class="row">
            <div class="container">
                {{--            <h1 class="judul-page"><span style="color: #0E9D4B;">Layanan</span> Kami</h1>--}}
                <h1 class="judul-page"><span style="color: #008A85;">Teknologi</span> Terkini</h1>
                <hr class="underline-center">
                <p class="ml-5 mr-5 mt-4 text-center">Mengikuti perkembangan teknologi, perusahaan kami aktif dalam
                    menggunakan teknologi terbaru guna mendukung proses pengembangan aplikasi. Hal ini guna menghasilkan
                    aplikasi yang terbaik untuk mendukung bisnis Anda.</p>
            </div>
        </div>
        <div class="container section-keahlian-option mb-5">

            <!-- teknologi -->

            <div class="row  justify-content-center">
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Vuejs"
                             src="{{asset('assets/images/layanan/vuejs.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Nodejs"
                             src="{{asset('assets/images/layanan/nodejs.png')}}"
                             style="width: 80%;padding: 15px;"/>

                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Express"
                             src="{{asset('assets/images/layanan/express.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Golang"
                             src="{{asset('assets/images/layanan/golang.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Java"
                             src="{{asset('assets/images/layanan/java.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Laravel"
                             src="{{asset('assets/images/layanan/laravel.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Flutter"
                             src="{{asset('assets/images/layanan/flutter.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Swift"
                             src="{{asset('assets/images/layanan/swift.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Kotlin"
                             src="{{asset('assets/images/layanan/kotlin.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Amazon Web Services"
                             src="{{asset('assets/images/layanan/aws.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Google Cloud Services"
                             src="{{asset('assets/images/layanan/googlecloud.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Docker"
                             src="{{asset('assets/images/layanan/docker.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Sentry"
                             src="{{asset('assets/images/layanan/sentry.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Kubernetes"
                             src="{{asset('assets/images/layanan/kubernetes.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Ansible"
                             src="{{asset('assets/images/layanan/ansible.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Rabbitmq"
                             src="{{asset('assets/images/layanan/rabbitmq.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Openstack"
                             src="{{asset('assets/images/layanan/openstack.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="analytics"
                             src="{{asset('assets/images/layanan/analytics.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="MySQL"
                             src="{{asset('assets/images/layanan/mysql.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="PostgreSQL"
                             src="{{asset('assets/images/layanan/postgresql.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="MongoDB"
                             src="{{asset('assets/images/layanan/mongodb.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="Gitlab Runner"
                             src="{{asset('assets/images/layanan/gitlab.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="text-center">
                        <img data-toggle="tooltip" data-placement="bottom" title="More"
                             src="{{asset('assets/images/layanan/more.png')}}"
                             style="width: 80%;padding: 15px;"/>
                    </div>
                </div>
            </div>
        </div>


        <!-- mulai proyek -->

        <div class="row top-footer p-5 mb-4 mt-4">
            <div class="container mt-5 mb-5">
                <h2 class="text-center text-light">Mulai proyek Anda bersama kami</h2><br>
                <a href="{{ url('/estimasi-project') }}">
                    Estimasi Proyek
                </a>
            </div>
        </div>
        @endsection

@push('extras-css')
    <style>
        .container.item {
            width: 80%;
            transition: .2s;
            background: white;
            height: auto;
            padding-top: 32px !important;
            padding-bottom: 25px;
            border-radius: 30px;
            box-shadow: 0px 2.3px 12px rgba(0, 0, 0, 0.1);
            margin-bottom: 50px;
        }

        .container.item:nth-child(5) {
            margin-bottom: 100px;
        }

        .col-8 ul {
            margin-left: -40px;
        }

        .col-8 ul li {
            border: 2px solid #008A85;
            padding: 5px 15px;
            border-radius: 10px;
            margin-right: 10px;
            color: #008A85;
            display: inline-block;
        }

        .item .row a > .right {
            float: left;
            color: black !important;
        }

        .item > .row > a > .left > img {
            width: 70%;
        }

        .item .row > a > .left {
            float: left;
            height: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .item:hover {
            transform: translate(0%, -1.5%);
            cursor: pointer;
            text-decoration: none !important;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.2);
        }

        .item:hover .right > h2 {
            color: #008A85;
        }

        @media (min-width: 962px) and (max-width: 1200px) {
            .item .row a .col-4.left > img {
                width: 220px;
            }
        }

        @media (min-width: 668px) and (max-width: 968px) {
            .item .row a .col-4.left > img {
                width: 470px;
            }

        }

        @media (max-width: 668px) {
            .item .row a .col-4.left {
                flex: 0 0 100% !important;
                max-width: 100%;
                height: 23%;
            }

            .container.item {
                padding: 15px;
                padding-top: 50px !important;
            }

            .item .row a .col-4.left > img {
                width: 160px;
            }

            .item .row a .col-8.right {
                flex: 0 0 100% !important;
                max-width: 100%;
            }

            .item .row .col-8.right > ul > li {
                margin-top: 10px;
                width: 100%;
                text-align: center;
            }

            .item .row .col-8.right > .text-keahlian {
                margin-top: -25px;
            }

            .item .row .col-8.right > h2 {
                font-size: 23px;
                margin-top: 28px;
                margin-bottom: 20px;
                font-weight: 600;
            }

            .wrapper-container {
                margin-top: 160px;
            }

            .top-footer .container > h1 {
                font-size: 28px;
            }

            .container.item:not(.text-keahlian) {
                text-align: center;
            }
        }

    </style>
@endpush
@push('extras-js')
    <script>
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>
@endpush
