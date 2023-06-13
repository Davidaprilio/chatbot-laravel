<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $device->label ?? 'Device view'}} </title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
</head>

<body class="w-100 vh-70 d-flex justify-content-center align-content-center text-center pt-4" style="background-color: {{ $bgColor }}">
    <div class="row justify-content-center align-content-center">
        <div class="col-12">
            <div class="shadow rounded-4 px-4 pt-2" style="background-color: {{ $bgCard }}">
                <div class="row">
                    <div class="col-12 border-bottom mb-3">
                        <h5 class="mb-0">{{ $device->label }}</h5>
                        <div>
                            <span>{{ $device->id }}</span> / <span>{{ $device->server_id }}</span>
                        </div>
                    </div>
                    <div class="col-6">
                        <img alt="" id="qrcode" class="rounded img-fluid" width="270" height="270">
                        <div>
                            <div class="d-flex justify-content-center text-center flex-column">
                                <strong id="status-device">{{ $device->status }}</strong>
                                <span>                                    
                                    <small id="id_Device">{{ ($device->name=='null' ? '-' : $device->name) ?? '-' }} | {{ $device->phone }}</small>
                                </span>
                            </div>
                            <br>
                            
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex flex-column">
                            <button class="mb-2 btn btn-success" data-text="Test Kirim" id="test-kirim-pesan">Test Kirim</button>
                            <button class="mb-2 btn btn-primary" data-href="{{ url('/device/'.$device->id.'/start')}}" id="start-device">Start Device</button>
                            <button href="{{ url('/device/'.$device->id.'/restart')}}" class="mb-2 btn btn-warning">Restart Device</button>                           
                            <button data-href="{{ url('device/'.$device->id.'/logout')}}" id="logout-device" class="mb-2 btn btn-danger">Logout Device</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src='https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js'
        integrity='sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=='
        crossorigin='anonymous'></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous">
    </script>
    <script>
        const btnTestKirim          = document.getElementById('test-kirim-pesan');
        const btnStartDevice        = document.getElementById('start-device');
        const qrcode                = document.getElementById('qrcode');
        const statusDevice          = document.getElementById('status-device');
        const btnlogoutDevice       = document.getElementById('logout-device');
        var mePhone                 = '{{ $device->phone }}';
        var requestIntervalAgain    = true;

        var device = {
            connected: false,
        }

        function loading() {
            $('#qrcode').attr('src', '{{ url('/') }}/loading.gif');
        }
        loading();

        function setStatusDevice(status, className) {
            statusDevice.innerHTML = status;
            if (status == "AUTHENTICATED") {
                statusDevice.setAttribute('class', className);
            } else {
                statusDevice.setAttribute('class', 'text-dark');
            }
        }

        // Jika sudah connect dari awal
        if (device.connected) {
            $('#qrcode').attr('src', 'https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=dsdsd');
        } else {
            $('#qrcode').attr('src', 'https://via.placeholder.com/500?text=Start+Device');
        }
        
        // Test Kirim Pesan
        btnTestKirim.addEventListener('click', function() {
            const textBtn = this.dataset.text;
            this.innerText = 'Mengirim...';
            mePhone = prompt('Masukkan nomor handphone anda', mePhone);
            testKirimPesan(mePhone, function() {
                btnTestKirim.innerText = textBtn;
            });
        });

        btnlogoutDevice.addEventListener('click', function() {
            const url = this.getAttribute('data-href');
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    if (data.qrcode) {
                        $('#qrcode').attr('src', qrcode);
                    }
                    console.log('start-device:', data);
                },
                error: function(data) {
                    console.error('start-device:', data);
                },
                complete: function() {
                    btn.innerText = textBtn;
                }
            });
        });

        async function testKirimPesan(phoneNumber, onComplete) {
            await $.ajax({
                url: '{{ url('/') }}/device/{{ $device->id }}/test',
                type: 'GET',
                data: {
                    phone: phoneNumber
                },
                success: function(data) {
                    console.log('test kirim:', data);
                },
                error: function(data) {
                    console.error('test kirim:', data);
                },
                complete: function() {
                    onComplete();
                }
            });
        };

        btnStartDevice.addEventListener('click', function() {
            var btn = this;
            var textBtn = btn.innerText;
            btn.innerText = 'Starting ...';
            if (device.connected) {
                return false;
            } else {
                loading();
            }
            const url = btn.getAttribute('data-href');
            $.ajax({
                url: url,
                method: 'POST',
                data: {
                    '_token': '{{ csrf_token() }}'
                },
                dataType: 'json',
                success: function(data) {
                    if (data.qrcode) {
                        $('#qrcode').attr('src', qrcode);
                    }else if(data.pic){
                        setStatusDevice('AUTHENTICATED', 'text-success');
                        $('#qrcode').attr('src', data.pic);
                        $('#id_Device').html(data.name + ' | ' + data.phone);
                    }
                    console.log('start-device:', data);
                },
                error: function(data) {
                    console.error('start-device:', data);
                },
                complete: function() {
                    btn.innerText = textBtn;
                }
            });
        });

        function getQRcode() {
            const url = '{{ url('/') }}/device/{{ $device->id }}/qrcode';
            console.log('Request to:', url);
            $.ajax({
                url,
                method: 'GET',
                dataType: 'json',
                success: function(data) {                    
                    const message = data.message || undefined;
                    if(message == "AUTHENTICATED"){
                        setStatusDevice('AUTHENTICATED', 'text-success');
                        $('#qrcode').attr('src', data.pic);
                        $('#id_Device').html(data.name + ' | ' + data.phone);
                    }else if (data.qrcode) {
                        $('#qrcode').attr('src', data.qrcode);                        
                    } else if (status == 'qrocde expired') {
                        $('#qrcode').attr('src', 'https://via.placeholder.com/270?text=QR+Code+Expired');
                    } else {
                        console.log(data);                        
                        $('#qrcode').attr('src', data.pic ?? 'https://via.placeholder.com/270?text=Default+Image');
                    }
                    setStatusDevice(status);
                },
                error: function(data) {
                    console.log(data);
                },
                complete: async function(data) {
                    if (!requestIntervalAgain) {
                        return false;
                    }
                    var time = 0;
                    if (data.statusText == "timeout") {
                        time = 1
                    } else {
                        var json = data.responseJSON
                        if (json.message == "Server offline") {
                            time = 10
                        } else if (json.scan) {
                            time = 3
                        } else {
                            // Jika Sudah Scan
                            time = 15
                        }
                    }
                    time = time * 1000;
                    console.log('next request in', time, 'ms');
                    await sleep(time);
                    return getQRcode();
                }
            });
        }
        getQRcode();

        

        function sleep(time) {
            return new Promise(resolve => setTimeout(resolve, time));
        }

            
    </script>


</body>

</html>
