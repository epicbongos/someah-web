@extends('layout.layout')
@section('title','Beranda')

@section('content')
<main>

    <!-- Header -->
    <header class="masthead">
        <div class="container pt-5 text-white masthead-content">
            <div class="row align-items-content justify-content-center my-5">
                <div class="col my-1 pt-5 content-header">
                    <h1 class="mb-4 font-weight-bold">Penuhi Kebutuhan Anda <br>bersama kami!</h1>
                    <p class="my-4 h5">
                        Kami hadir untuk memastikan perangkat digital anda bekerja dengan baik dan terlihat menarik, membuat segalanya jadi lebih efektif dan menawan.                    </p>
                    <a target="_blank" href="{{asset('uploaded')}}/pdf/Company_Profile_PT_Someah_Kreatif_Nusantara_2022.pdf" class="btn btn-lg mulai btn-white btn-round mt-4 px-4">Unduh Company Profile</a>
                </div>
                <div class="col-lg-6 d-none d-lg-block illustrasi-wrapper" data-aos="fade-down-left">
                    <img src="{{asset('assets')}}/images/Illustrasi.svg" alt="Header Image">
                </div>
            </div>
        </div>
    </header>

    <!-- Section Services -->
    <div class="section-services py-5">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
{{--                    <p class="judul-page text-left color-green">Layanan <span class="color-black">Kami</span></p>--}}
                    <p class="judul-page text-left " style="color: #008A85 ">Layanan <span class="color-black">Kami</span></p>
                    <hr class="underline">
                    <p class="color-gray mt-5">
                        Kami memberikan berbagai jenis layanan sesuai dengan media dan aplikasi yang anda butuhkan.
                        Berikut adalah jasa dan layanan kami yang dapat anda pilih untuk mendukung kenyamanan bisnis dan aktivitas anda di dunia digital.
                    </p>
                </div>
            </div>
            <div class="row my-3">
                <div class="col-md-3 layanan-kami">
                    <figure>
                        <img src="assets/images/ic_mobile.svg" alt="Aplikasi Mobile" style="height: 128px;">
                    </figure>
                    <h5 class="font-weight-bold">Aplikasi Mobile</h5>
                    <p class="color-gray mt-3 mb-5">
                        Layanan terbaik untuk membangun aplikasi mobile untuk mendukung kebutuhan bisnis dan organisasi anda.
                        Menjadikan aplikasi mobile sebagai kunci untuk menyampaikan pesan dan citra lembaga anda dengan menarik.
                        Nyaman, efisien, dan langsung ke tangan para pengguna.
                    </p>
                </div>
                <div class="col-md-3 layanan-kami">
                    <figure>
                        <img src="assets/images/ic_website.svg" alt="Aplikasi Website" style="height: 128px;">
                    </figure>
                    <h5 class="font-weight-bold mt-4">Aplikasi Website</h5>
                    <p class="color-gray mt-3 mb-5">
                        Layanan terbaik untuk membangun website untuk segala macam tujuan.
                        Memastikan anda dapat memiliki website yang praktis, efektif, dan sesuai dengan harapan yang diinginkan.
                        Memiliki website yang mampu menjadi platform utama dalam setiap aktivitas bisnis dan organisasi anda.
                    </p>
                </div>
                <div class="col-md-3 layanan-kami">
                    <figure>
                        <img src="assets/images/ic_desktop.svg" alt="Aplikasi Desktop" style="height: 128px;">
                    </figure>
                    <h5 class="font-weight-bold mt-4">Aplikasi Desktop</h5>
                    <p class="color-gray mt-3 mb-5">
                        Layanan terbaik untuk membangun aplikasi desktop untuk segala macam kebutuhan offline.
                    </p>
                </div>
                <div class="col-md-3 layanan-kami">
                    <figure>
                        <img src="assets/images/ic_is.svg" alt="Sistem Informasi" style="height: 128px;">
                    </figure>
                    <h5 class="font-weight-bold mt-4">Sistem Informasi</h5>
                    <p class="color-gray mt-3 mb-5">
                        Layanan terbaik untuk membangun sistem informasi untuk segala macam kebutuhan offline dan online.
                        Mulai dari sistem informasi keuangan, pemasaran, manufaktur, manajamen, olahraga, hingga pengetahuan.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- Section Portfolio -->
    <div class="section-portfolio py-5 position-relative">
        <div class="container">
            <div class="row my-4">
                <div class="col-md-8">
{{--                    <h2 class="judul-page text-left color-green">Portofolio <span class="color-black">Kami</span></h2>--}}
                    <h2 class="judul-page text-left " style="color: #008A85;">Portofolio <span class="color-black">Kami</span></h2>
                    <hr class="underline">
                </div>
            </div>
            <div class="row align-items-content justify-content-center my-5">
                <div class="owl-carousel owl-theme d-block">
                    @foreach($portfolio as $port)
                    <div class="item">
                        <div class="col-md-8 d-md-none d-lg-none d-xl-none float-left">
                            <img src="assets/images/img_portfolio_bureport.png" alt="Portfolio BU Report"
                                class="img-fluid mr-0">
                        </div>
                        <div class="col-md-4 float-left">
                            <figure style="width: 206px;">
                                <img src="{{ asset('uploaded/client/' . $port->client->mini_logo ) }}"
                                    alt="Logo BU Report" class="mt-4" style="width: 100%;">
                            </figure>
                            <p class="color-gray mb-5">
                                {{ $port->desc }}
                            </p>
                            <a href="{{url('portofolio/detail-portfolio/' . $port->slug)}}" class="btn btn-lihatselengkapnya btn-round mt-4 px-4 btn-selengkapnya">Lihat
                                Selengkapnya</a>
                        </div>
                        <div class="col-md-8 d-none d-md-block float-left">
                            <img src="{{ asset('uploaded/portfolio/' . $port->product_img[0]) }}" alt="" id="porto-image"
                                class="img-fluid">
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <!-- Section Client -->
    <div class="section-client text-center py-5">
        <div class="container">
{{--            <p class="judul-page color-green">Klien <span class="color-black">Kami</span></p>--}}
            <p class="judul-page " style="color: #008A85">Klien <span class="color-black">Kami</span></p>
            <hr class="underline-center">
            <p class="color-gray mt-4">
                Layanan profesional bersama klien profesional, kunci terciptanya integritas dan kredibilitas.
            </p>
            <div class="row mt-4">
                @foreach($clients as $client)
                @if($client->status == "1")
                    <div class="col-md-3 my-3">
                        <a href="{{ url('klien/detail-klien/' . $client->slug ) }}">
                            <img src="{{ asset('uploaded/client/' . $client->logo)  }}" class="img-fluid w-100"
                                alt="Biro Perencanaan Kerjasama dan Luar Negeri">
                        </a>
                    </div>
                @endif
                @endforeach
                <div class="col-md-3 my-3 pt-3">
                    <a href="{{ url('/klien') }}" class="footer-link" style="text-decoration: none;">
                        <h3 class="font-weight-bold">{{ $clientsNotShow->count() }} +</h3>
                        <p class="color-gray">Klien lainnya</p>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="section-teknologi text-center py-5">
        <div class="container">
            {{--            <p class="judul-page color-green">Klien <span class="color-black">Kami</span></p>--}}
            <p class="judul-page " style="color: #008A85">Teknologi <span class="color-black">Terkini</span></p>
            <hr class="underline-center">
            <p class="color-gray mt-4">
                Mengikuti perkembangan teknologi, perusahaan kami aktif dalam
                menggunakan teknologi terbaru guna mendukung proses pengembangan aplikasi. Hal ini guna menghasilkan
                aplikasi yang terbaik untuk mendukung bisnis Anda.
            </p>
            <div class="container section-keahlian-option mb-5">
                <!-- teknologi -->
                <div class="row  justify-content-center">
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Vuejs"
                                 src="{{asset('assets/images/layanan/vuejs.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Nodejs"
                                 src="{{asset('assets/images/layanan/nodejs.png')}}"
                                 style="width: 100%;padding: 5px;"/>

                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Express"
                                 src="{{asset('assets/images/layanan/express.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Golang"
                                 src="{{asset('assets/images/layanan/golang.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Java"
                                 src="{{asset('assets/images/layanan/java.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Laravel"
                                 src="{{asset('assets/images/layanan/laravel.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Flutter"
                                 src="{{asset('assets/images/layanan/flutter.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Swift"
                                 src="{{asset('assets/images/layanan/swift.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Kotlin"
                                 src="{{asset('assets/images/layanan/kotlin.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Amazon Web Services"
                                 src="{{asset('assets/images/layanan/aws.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Google Cloud Services"
                                 src="{{asset('assets/images/layanan/googlecloud.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Docker"
                                 src="{{asset('assets/images/layanan/docker.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Sentry"
                                 src="{{asset('assets/images/layanan/sentry.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Kubernetes"
                                 src="{{asset('assets/images/layanan/kubernetes.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Ansible"
                                 src="{{asset('assets/images/layanan/ansible.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Rabbitmq"
                                 src="{{asset('assets/images/layanan/rabbitmq.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Openstack"
                                 src="{{asset('assets/images/layanan/openstack.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="analytics"
                                 src="{{asset('assets/images/layanan/analytics.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="MySQL"
                                 src="{{asset('assets/images/layanan/mysql.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="PostgreSQL"
                                 src="{{asset('assets/images/layanan/postgresql.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="MongoDB"
                                 src="{{asset('assets/images/layanan/mongodb.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="Gitlab Runner"
                                 src="{{asset('assets/images/layanan/gitlab.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <div class="text-center">
                            <img class="teknologi" data-toggle="tooltip" data-placement="bottom" title="More"
                                 src="{{asset('assets/images/layanan/more.png')}}"
                                 style="width: 100%;padding: 5px;"/>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Section Contact -->

    <div class="row top-footer p-5 mb-4">
        <div class="container mt-5 mb-5">
            <h2 class="text-center text-light">Mulai proyek Anda bersama kami</h2><br>
            <a href="{{ url('/estimasi-project') }}">
                Estimasi Proyek
            </a>
        </div>
    </div>
</main>
@endsection

@push('extras-css')
<style>
    #porto-image{
        height: auto;
        width: auto;
        max-width: 730px;
        max-height: 410px;
    }

    .owl-nav {
        background: transparent !important;
        position: absolute;
        top: -100px;
        right: 30px;
    }

    .owl-nav .owl-prev,
    .owl-nav .owl-next {
        width: 40px !important;
        height: 40px !important;
        box-shadow: 0px 5px 18px rgba(0, 0, 0, 0.15);
        background-color: #FFFFFF !important;
        border-radius: 100% !important;
    }

    @media (min-width: 968px) and (max-width: 1200px) {


        .illustrasi-wrapper {
            height: 100%;
            flex: 0 0 45% !important;
            max-width: 45%;
        }

        .content-header>h1 {
            font-size: 35px;
        }

        .content-header>p.h5 {
            font-size: 18px;
        }

        .illustrasi-wrapper>img {
            width: 400px;
            margin-top: 20px;
            margin-left: -20px;
        }
    }

    @media (min-width: 568px) and (max-width: 991px) {

        .content-header {
            margin-top: -20px !important;
            margin-left: -23px !important;
        }

        .col-md-3.my-3 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .content-header>h1 {
            font-size: 35px;
        }

        .content-header>p.h5 {
            font-size: 20px;
        }

        .col-md-3.layanan-kami {
            flex: 0 0 50%;
            max-width: 50%;
        }
    }
    @media (max-width: 751px) {
        .teknologi{
            width: 35% !important;
        }
    }

    @media (max-width: 568px) {
        .teknologi{
            width: 35% !important;
        }

        .masthead {
            height: 200px;
        }

        .masthead,
        .section-services,
        .section-client,
        .section-portofolio,
        .section-client {
            padding: 30px;
        }

        .owl-nav {
            position: relative !important;
        }

        .owl-nav>.owl-prev {
            position: absolute;
            left: 50px;
            top: -230px;
        }

        .owl-nav>.owl-next {
            position: absolute;
            right: -5px;
            top: -235px;
        }

        .py-5>h2 {
            font-size: 30px;
        }

        .section-portfolio {
            padding-top: 20px !important;
            padding-bottom: 20px !important;
        }


        figure {
            margin-bottom: 30px;
            display: flex;
            justify-content: center;
        }

        .btn-selengkapnya {
            width: 100% !important;
        }

        .col-md-3>h5,
        .col-md-3>p {
            text-align: center;

        }

        .content-header {
            padding-top: 40px !important;
            margin-top: 30px !important;
        }
    }

    @media (max-width: 368px) {
        .teknologi{
            width: 35% !important;
        }
        .content-header>h1 {
            font-size: 40px;
        }

        .content-header>p.h5 {
            margin-top: -10px !important;
            font-size: 17px;
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
