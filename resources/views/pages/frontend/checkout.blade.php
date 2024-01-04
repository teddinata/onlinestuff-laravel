@extends('layouts.frontend')

@section('title')
DhillaStuff - Checkout
@endsection

@section('content')
<!-- Breadcrumb Section Begin -->
<div class="breacrumb-section">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-text product-more">
                    <a href="./index.html"><i class="fa fa-home"></i> Home</a>
                    <a href="./shop.html">Shop</a>
                    <span>Check Out</span>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Breadcrumb Section Begin -->

<!-- Shopping Cart Section Begin -->
<section class="checkout-section spad">
    <div class="container">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('checkout.process') }}" class="checkout-form" id="locations" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-6">
                    <h4>Biiling Details</h4>
                    <div class="row">
                        <div class="col-lg-12">
                            <label for="name">Name<span>*</span></label>
                            <input type="text" id="name" name="name" class="form-control">
                        </div>

                        <div class="col-lg-6">
                            {{-- <label for="province">Province<span>*</span></label> --}}
                            {{-- <select
                                name="provinces_id"
                                id="provinces_id"
                                v-model="provinces_id"
                                class="form-control"
                                data-placeholder="Pilih Provinsi"
                                style="width: 100%; height: 36px;"
                            >
                                <option v-for="province in provinces" :value="province.id">@{{ province.name }}</option>
                            </select> --}}
                            <label class="font-weight-bold">PROVINSI TUJUAN</label>
                            <select class="form-control provinsi-tujuan" name="province_id">
                                <option value="0">-- pilih provinsi tujuan --</option>
                                @foreach ($provinces as $province => $value)
                                    <option value="{{ $province  }}">{{ $value }}</option>
                                @endforeach
                            </select>
                        </div>

                        {{-- kota --}}
                        <div class="col-lg-6">
                            <div class="form-group">
                              {{-- <label for="regencies_id">Kabupaten</label>
                              <select
                              name="regencies_id"
                              id="regencies_id"
                              v-model="regencies_id"
                              class="form-control select2"
                              data-placeholder="Pilih Kota"
                              style="width: 100%; height: 36px;"
                          >
                            <option placeholder="Pilih Provinsi terlebih dahulu" disabled value="">Pilih Provinsi Dahulu</option>
                              <option v-for="regency in regencies" :value="regency.id">@{{ regency.name }}</option>
                              </select> --}}
                              <label class="font-weight-bold">KOTA / KABUPATEN TUJUAN</label>
                              <select class="form-control kota-tujuan" name="regency_id">
                                  <option value="">-- pilih kota tujuan --</option>
                              </select>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <label for="address">Address<span>*</span></label>
                            {{-- textarea --}}
                            <textarea name="address" id="address" cols="20" rows="5" class="form-control"></textarea>
                        </div>
                        <div class="col-lg-12">
                            <label for="postal_code">Postcode / ZIP (optional)</label>
                            <input type="text" id="postal_code" name="postal_code" class="form-control">
                        </div>
                        <div class="col-lg-6">
                            <label for="phone">Phone Number<span>*</span></label>
                            <input type="text" id="phone" name="phone" class="form-control">
                        </div>

                        <div class="col-lg-6">
                            <label for="payment_method">Payment Method<span>*</span></label>
                            <select name="payment_method" id="payment_method" class="form-control">
                                <option disabled value="">Pilih Metode Pembayaran</option>
                                <option value="bank_transfer">Transfer Bank</option>
                                <option value="cod">COD</option>
                            </select>
                        </div>

                        <div class="col-lg-6">
                            <label for="courier">Courier<span>*</span></label>
                            <select name="courier" id="courier" class="form-control">
                                <option value="0">Pilih Kurir</option>
                                <option value="jne">JNE</option>
                                <option value="pos">POS</option>
                                <option value="tiki">TIKI</option>
                            </select>
                        </div>

                        <!-- Tambahkan ini di bagian Courier -->
                        <div class="col-lg-6">
                            <label for="courier_service">Courier Service<span>*</span></label>
                            <select name="courier_service" id="courier_service" class="form-control">
                                <option value="0">Pilih Layanan Kurir</option>
                                <!-- Tambahkan opsi layanan dari kurir yang dipilih -->
                            </select>
                        </div>

                        {{-- button pilih ongkir --}}
                        {{-- <div class="col-lg-6 mt-1">
                            <label for="courier">Pilih Ongkir<span>*</span></label>
                            <br>
                            <button class="btn btn-block btn-primary btn-check">Pilih Ongkir</button>
                        </div> --}}

                        <div class="row mt-4">
                            <div class="col-lg-12">
                                <div class="card d-none ongkir">
                                    <div class="card-body">
                                        <ul class="list-group" id="ongkir"></ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="place-order">
                        <h4>Your Order</h4>
                        <div class="order-total">
                            <ul class="order-table">
                                <li>Product <span>Total</span></li>
                                @foreach ($cartItems as $cartItem)
                                <li class="fw-normal">{{ $cartItem['product']['name'] }} x {{ $cartItem['quantity'] }}
                                    {{-- check price --}}
                                    @if ($cartItem['product']['discount_price'] > 0)
                                        <span> Rp. {{ number_format($cartItem['product']['discount_price'] * $cartItem['quantity']) }} </span>

                                        <span class="text-danger"> <del>Rp. {{ number_format($cartItem['product']['price'] * $cartItem['quantity']) }} </del> </span>
                                    @else
                                        <span>Rp. {{ number_format($cartItem['product']['price'] * $cartItem['quantity']) }}</span>
                                    @endif
                                </li>
                                @endforeach
                                <li class="fw-normal">Courier Service <span id="courier-cost">Rp. 0</span></li>
                                <li class="fw-normal">Grand Total <span id="grand-total">Rp. 0</span></li>

                            </ul>
                            <input type="hidden" id="grand-total-input" name="grand_total">
                            <input type="hidden" id="shipping-cost-input" name="shipping_cost">
                            <input type="hidden" id="etd-input" name="etd">
                            <div class="order-btn">
                                <button type="submit" class="site-btn place-btn" id="place-order-button">Place Order</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<!-- Shopping Cart Section End -->
@endsection

@push('addon-script')
    <script src="/frontend/vue/vue.js"></script>
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    <script>
      var locations = new Vue({
        el: "#locations",
        mounted() {
            this.getProvincesData();
            // this.getRegenciesData();
        //   AOS.init();
        },
        data: {
            provinces: null,
            regencies: null,
            districts: null,
            villages: null,
            provinces_id: null,
            regencies_id: null,
            districts_id: null,
            villages_id: null,
            courier: null,
            courier_type: ''
        },
        methods: {
            getProvincesData() {
                var self = this;
                axios.get('{{ route('api-provinces') }}' )
                    .then(function(response){
                        self.provinces = response.data.data;
                        // console.log(response.data.data);
                        // console.log(this.provinces);
                    })
            },
            getRegenciesData(){
                var self = this;
                axios.get('{{ url('api/cities') }}/' + self.provinces_id)
                    .then(function(response){
                        self.regencies = response.data.data;
                    })
            },
            // get districts data
            getDistrictsData(){
                var self = this;
                axios.get('{{ url('api/districts') }}/' + self.regencies_id)
                    .then(function(response){
                        self.districts = response.data;
                    })
            },
            // get villages data
            getVillagesData(){
                var self = this;
                axios.get('{{ url('api/villages') }}/' + self.districts_id)
                    .then(function(response){
                        self.villages = response.data;
                    })
            },


        },
        watch: {
            provinces_id: function(val, oldVal){
                this.regencies_id = null;
                console.log(val);
                this.getRegenciesData();
            },
            regencies_id: function(val, oldVal){
                this.districts_id = null;
                this.getDistrictsData();
            },
            districts_id: function(val, oldVal){
                this.villages_id = null;
                this.getVillagesData();
            },
        }
      });

    </script>

    {{-- select2 --}}
    <script>
        // $(document).ready(function() {
        //     $('#provinces_id').select2({
        //         placeholder: "Pilih Provinsi",
        //         allowClear: true,
        //         width: '100%',
        //         height: '36px'

        //     });
        // });


        // $(document).ready(function() {
        //     $('#regencies_id').select2({
        //         placeholder: "Pilih Kota/Kabupaten",
        //         allowClear: true,
        //         width: '100%',
        //         height: '36px'

        //     });
        // });
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" ></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function(){
            //active select2
            $(".provinsi-tujuan, .kota-tujuan").select2({
                // theme:'bootstrap4',width:'style',
            });
            //ajax select kota asal
            $('select[name="province_origin"]').on('change', function () {
                let provindeId = $(this).val();
                if (provindeId) {
                    jQuery.ajax({
                        url: '/cities/'+provindeId,
                        type: "GET",
                        dataType: "json",
                        success: function (response) {
                            $('select[name="city_origin"]').empty();
                            $('select[name="city_origin"]').append('<option value="">-- pilih kota asal --</option>');
                            $.each(response, function (key, value) {
                                $('select[name="city_origin"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="city_origin"]').append('<option value="">-- pilih kota asal --</option>');
                }
            });
            //ajax select kota tujuan
            $('select[name="province_id"]').on('change', function () {
                let provindeId = $(this).val();
                if (provindeId) {
                    jQuery.ajax({
                        url: '/cities/'+provindeId,
                        type: "GET",
                        dataType: "json",
                        success: function (response) {
                            $('select[name="regency_id"]').empty();
                            $('select[name="regency_id"]').append('<option value="">-- pilih kota tujuan --</option>');
                            $.each(response, function (key, value) {
                                $('select[name="regency_id"]').append('<option value="' + key + '">' + value + '</option>');
                            });
                        },
                    });
                } else {
                    $('select[name="regency_id"]').append('<option value="">-- pilih kota tujuan --</option>');
                }
            });
            //ajax check ongkir
            let isProcessing = false;
            $('.btn-check').click(function (e) {
                e.preventDefault();

                let token            = $("meta[name='csrf-token']").attr("content");
                let city_origin      = $('select[name=city_origin]').val();
                let regency_id = $('select[name=regency_id]').val();
                let courier          = $('select[name=courier]').val();
                let weight           = $('#weight').val();

                if(isProcessing){
                    return;
                }

                isProcessing = true;
                jQuery.ajax({
                    url: "/checkongkir",
                    data: {
                        _token:              token,
                        city_origin:         city_origin,
                        regency_id:    regency_id,
                        courier:             courier,
                        weight:              weight,
                    },
                    dataType: "JSON",
                    type: "POST",
                    success: function (response) {
                        isProcessing = false;
                        if (response) {
                            $('#ongkir').empty();
                            $('.ongkir').addClass('d-block');
                            $.each(response[0]['costs'], function (key, value) {
                                $('#ongkir').append('<li class="list-group-item">'+response[0].code.toUpperCase()+' : <strong>'+value.service+'</strong> - Rp. '+value.cost[0].value+' ('+value.cost[0].etd+' hari)</li>')
                            });

                        }
                    }
                });

            });

        });

        // Tambahkan ini di bagian JavaScript atau jQuery

        // Event handler untuk perubahan pemilihan courier service
        $('select[name="courier"]').on('change', function() {
            var selectedCourier = $(this).val();
            fillServiceOptions(selectedCourier);

            // Setelah mengganti courier, langsung hit endpoint checkongkir
            checkOngkir();
        });

        // ... (kode lainnya)

        // Fungsi untuk mengisi opsi layanan berdasarkan kurir yang dipilih
        function fillServiceOptions(courier) {
            var serviceDropdown = $('select[name="service"]');
            // Hapus opsi layanan sebelumnya
            serviceDropdown.empty();

            // Tambahkan opsi layanan berdasarkan kurir yang dipilih dari function checkOngkir

        }

        // ... (kode lainnya)

        // Fungsi untuk menghitung ongkir setelah pemilihan courier service
        function checkOngkir() {
        // Ambil nilai yang dibutuhkan untuk hit endpoint checkongkir
        var token = $("meta[name='csrf-token']").attr("content");
        var city_origin = $('select[name=city_origin]').val();
        var regency_id = $('select[name=regency_id]').val();
        var courier = $('select[name=courier]').val();
        var weight = $('#weight').val();

        jQuery.ajax({
            url: "/checkongkir",
            data: {
                _token: token,
                city_origin: city_origin,
                regency_id: regency_id,
                courier: courier,
                weight: weight,
            },
            dataType: "JSON",
            type: "POST",
            success: function (response) {
                if (response) {
                    // Tampilkan harga ongkir di dropdown courier service
                    var serviceDropdown = $('select[name="courier_service"]');
                    serviceDropdown.empty(); // Clear the dropdown

                    // Iterate over the response and create a new option for each service
                    $.each(response[0]['costs'], function (index, item) {
                        var service = item['service'];
                        var cost = item['cost'][0]['value'];
                        var etd = item['cost'][0]['etd'];
                        var optionText = service + ' - Rp. ' + cost + ' (' + etd + ' hari)';
                        serviceDropdown.append(new Option(optionText, service));
                    });

                    // Update the shipping cost input field
                    var shippingCost = response[0]['costs'][0]['cost'][0]['value'];
                    $('#shipping-cost-input').val(shippingCost);
                    // Update the ETD input field
                    var etd = response[0]['costs'][0]['cost'][0]['etd'];
                    $('#etd-input').val(etd + ' hari');
                }
            }
        });
    }

    $(document).ready(function () {
        // Listen for the change event on the service dropdown
        $('#courier_service').change(function () {
            var selectedService = $(this).val();

            // Extract the cost from the selected option's text
            var optionText = $(this).find('option:selected').text();
            var costStartIndex = optionText.indexOf('Rp. ') + 4;
            var costEndIndex = optionText.indexOf(' (');
            var cost = optionText.substring(costStartIndex, costEndIndex);

            // Update the courier cost line item
            $('#courier-cost').text('Rp ' + cost);

            // Recalculate the total
            // Replace this with your actual function to recalculate the total
            recalculateTotal();
        });
    });

    function recalculateTotal() {
        var total = 0;

        // Iterate over each line item in the order table
        $('.order-table li').each(function () {
            // Extract the cost from the line item's text
            var lineItemText = $(this).find('span').text();
            var costStartIndex = lineItemText.indexOf('Rp. ') + 4;
            var costText = lineItemText.substring(costStartIndex).replace(/,/g, '');
            var cost = parseInt(costText);

            // Check if the cost is a number
            if (!isNaN(cost)) {
                // Add the cost to the total
                total += cost;
            }
        });

        // Add the courier service cost to the total
        var courierCostText = $('.order-table .courier-service span').text();
        var courierCostStartIndex = courierCostText.indexOf('Rp. ') + 4;
        var courierCostText = courierCostText.substring(courierCostStartIndex).replace(/,/g, '');
        var courierCost = parseInt(courierCostText);

        // Check if the courier cost is a number
        if (!isNaN(courierCost)) {
            total += courierCost;
        }

        // Update the total in the order table
        $('#grand-total').text('Rp ' + total.toLocaleString('id-ID'));
        // Update the grand total input field
        $('#grand-total-input').val(total);
    }


    $(document).ready(function() {
        $('#place-order-button').click(function() {
            var confirmed = confirm('Are you sure you want to place this order?');
            if (confirmed) {
                $('#checkout-form').submit();
            } else {
                // Handle the cancel action here
                alert('Checkout process has been cancelled.');
            }
        });
    });
    </script>

@endpush
