<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="theme-color" content="#0D9748"/>
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>@yield('title') - Someah Kreatif Nusantara</title>

	<link rel="icon" type="image/png" href="{{asset('assets')}}/images/favicon.png">
	<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">

	<!-- CSS Files -->
	<link rel="stylesheet" href="{{ asset('assets/admin') }}/css/bootstrap.min.css">
	<link rel="stylesheet" href="{{ asset('assets/admin') }}/css/millenium.min.css">
	<!-- owl carousel -->
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/OwlCarousel2-2.2.1/owl.carousel.css">
    <link rel="stylesheet" type="text/css" href="{{ asset('assets') }}/OwlCarousel2-2.2.1/owl.theme.default.css">
	<!-- datatables -->
	<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-print-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sl-1.3.1/datatables.min.css"/>
	<!-- tail custom select -->
    <link rel="stylesheet" href="{{ asset('assets/admin') }}/pytesNET-tail.select-d6454ba/css/bootstrap4/tail.select-default.css">
    <!-- Select2 Bootstrap 4 theme -->
    <link href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.4.0/dist/select2-bootstrap4.min.css" rel="stylesheet" />
	<style>
	@media screen and (max-width: 991px)
	{
		.navbar.navbar-header
		{
			top: -62px !important;
		}
	}
	</style>

	@stack('extras-css')

</head>
<body>
	<div class="wrapper">

		@include('admin.partials.header')
		@include('admin.partials.sidebar')

		<div class="main-panel">

			@yield('content')
			@include('admin.partials.footer')

		</div>
	</div>

    <!-- cheditor -->
    <script type="text/javascript" src="{{ asset('assets') }}/admin/ckeditor/ckeditor.js"></script>

	<!--   Core JS Files   -->
	<script src="{{ asset('assets/admin') }}/js/core/jquery.3.2.1.min.js"></script>
	<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
	<script src="{{ asset('assets/admin') }}/js/core/popper.min.js"></script>
	<script src="{{ asset('assets/admin') }}/js/core/bootstrap.min.js"></script>

	<!-- data tables -->
	<script type="text/javascript" src="https://cdn.datatables.net/v/bs4-4.1.1/dt-1.10.20/af-2.3.4/b-1.6.1/b-colvis-1.6.1/b-print-1.6.1/cr-1.5.2/fc-3.3.0/fh-3.1.6/kt-2.5.1/r-2.2.3/rg-1.1.1/rr-1.2.6/sc-2.0.1/sl-1.3.1/datatables.min.js"></script>

    <script src="{{ asset('assets') }}/OwlCarousel2-2.2.1/owl.carousel.js"></script>

	<!-- jQuery UI -->
	<script src="https://code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
	<script src="{{ asset('assets/admin') }}/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

	<!-- jQuery Scrollbar -->
	<script src="{{ asset('assets/admin') }}/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>

	<!-- Bootstrap Tagsinput -->
	<script src="{{ asset('assets/admin') }}/js/plugin/bootstrap-tagsinput/bootstrap-tagsinput.min.js"></script>

	<!-- Bootstrap Wizard -->
	<script src="{{ asset('assets/admin') }}/js/plugin/bootstrap-wizard/bootstrapwizard.js"></script>

	<!-- jQuery Validation -->
	<script src="{{ asset('assets/admin') }}/js/plugin/jquery.validate/jquery.validate.min.js"></script>

	<!-- Summernote -->
	<script src="{{ asset('assets/admin') }}/js/plugin/summernote/summernote-bs4.min.js"></script>

	<!-- Select2 -->
	<script src="{{ asset('assets/admin') }}/js/plugin/select2/select2.full.min.js"></script>

	<!-- Sweet Alert -->
	<script src="{{ asset('assets/admin') }}/js/plugin/sweetalert/sweetalert.min.js"></script>

    <!-- Moment JS -->
    <script src="{{ asset('assets/admin') }}/js/plugin/moment/moment.min.js"></script>

    <!-- Datepicker -->
	<script src="{{ asset('assets/admin') }}/js/plugin/datepicker/bootstrap-datetimepicker.min.js"></script>

	<!-- Millenium JS -->
	<script src="{{ asset('assets/admin') }}/js/millenium.min.js"></script>

	<script src="{{ asset('assets/admin') }}/js/millenium.min.js"></script>

	<!-- Script js -->
	<script src="{{ asset('assets') }}/admin/js/jquery.mask.min.js"></script>

	<!-- Tail Select -->
	<script src="{{ asset('assets/admin') }}/pytesNET-tail.select-d6454ba/js/tail.select.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/numeral.js/2.0.6/numeral.min.js"></script>

	<!-- Fonts and icons -->
	<script src="{{ asset('assets/admin') }}/js/plugin/webfont/webfont.min.js"></script>

	@include('sweetalert::alert')
	<script>


        numeral.register('locale', 'id', {
            delimiters: {
                thousands: '.',
                decimal: ','
            },
            abbreviations: {
                thousand: 'k',
                million: 'm',
                billion: 'b',
                trillion: 't'
            },
            ordinal : function (number) {
                return number === 1 ? '' : '';
            },
            currency: {
                symbol: 'Rp'
            }
        });

        function unmask(uang){
            uang = uang.replace(/\./g,'');
            return uang;
        }

        function mask(uang) {
            numeral.locale('id');
            uang = numeral(uang).format('0,0');
            return uang;
        }

		WebFont.load({
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['{{ asset('assets/admin') }}/css/fonts.min.css']},
			active: function() {
				sessionStorage.fonts = true;
			}
		});

		var has_error = {{ $errors->count() > 0 ? 'true' : 'false' }};



        function terbilang(bilangan) {

            bilangan    = String(bilangan);
            var angka   = new Array('0','0','0','0','0','0','0','0','0','0','0','0','0','0','0','0');
            var kata    = new Array('','Satu','Dua','Tiga','Empat','Lima','Enam','Tujuh','Delapan','Sembilan');
            var tingkat = new Array('','Ribu','Juta','Milyar','Triliun');

            var panjang_bilangan = bilangan.length;

            /* pengujian panjang bilangan */
            if (panjang_bilangan > 15) {
                kaLimat = "Diluar Batas";
                return kaLimat;
            }

            /* mengambil angka-angka yang ada dalam bilangan, dimasukkan ke dalam array */
            for (i = 1; i <= panjang_bilangan; i++) {
                angka[i] = bilangan.substr(-(i),1);
            }

            i = 1;
            j = 0;
            kaLimat = "";


            /* mulai proses iterasi terhadap array angka */
            while (i <= panjang_bilangan) {

                subkaLimat = "";
                kata1 = "";
                kata2 = "";
                kata3 = "";

                /* untuk Ratusan */
                if (angka[i+2] != "0") {
                    if (angka[i+2] == "1") {
                        kata1 = "Seratus";
                    } else {
                        kata1 = kata[angka[i+2]] + " Ratus";
                    }
                }

                /* untuk Puluhan atau Belasan */
                if (angka[i+1] != "0") {
                    if (angka[i+1] == "1") {
                        if (angka[i] == "0") {
                            kata2 = "Sepuluh";
                        } else if (angka[i] == "1") {
                            kata2 = "Sebelas";
                        } else {
                            kata2 = kata[angka[i]] + " Belas";
                        }
                    } else {
                        kata2 = kata[angka[i+1]] + " Puluh";
                    }
                }

                /* untuk Satuan */
                if (angka[i] != "0") {
                    if (angka[i+1] != "1") {
                        kata3 = kata[angka[i]];
                    }
                }

                /* pengujian angka apakah tidak nol semua, lalu ditambahkan tingkat */
                if ((angka[i] != "0") || (angka[i+1] != "0") || (angka[i+2] != "0")) {
                    subkaLimat = kata1+" "+kata2+" "+kata3+" "+tingkat[j]+" ";
                }

                /* gabungkan variabe sub kaLimat (untuk Satu blok 3 angka) ke variabel kaLimat */
                kaLimat = subkaLimat + kaLimat;
                i = i + 3;
                j = j + 1;

            }

            /* mengganti Satu Ribu jadi Seribu jika diperlukan */
            if ((angka[5] == "0") && (angka[6] == "0")) {
                kaLimat = kaLimat.replace("Satu Ribu","Seribu");
            }

            return kaLimat + "Rupiah";
        }

	</script>

	@stack('extras-js')
</body>
</html>
