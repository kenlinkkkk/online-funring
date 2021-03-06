<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Funring</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <style>
        body {
            margin: 0;
            padding: 0;
            scroll-behavior: smooth;
            font-size: 14px
        }

        body span {
            font-weight: bold;
        }
        .wrapper {
            height: 100%;
            background-color: #f5f6fa;
        }

        .wave-btn {
            color: #fff;
            text-decoration: none;
            border: 3px solid #fff;
            padding: 5px 30px;
            font-size: 22px;
            font-weight: 600;
            font-family: "Noto Sans";
            line-height: 52px;
            border-radius: 10px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            overflow: hidden;
            transition: all 1s;
        }

        .wave-btn:before {
            content: "";
            position: absolute;
            width: 320px;
            height: 320px;
            border-radius: 130px;
            background-color: #0097e6;
            top: 30px;
            left: 50%;
            transform: translate(-50%);
            animation: wave 5s infinite linear;
            transition: all 1s;
        }

        .wave-btn:hover:before {
            top: 15px;
        }

        @keyframes wave {
            0% {
                transform: translate(-50%) rotate(-180deg);

            }


            100% {
                transform: translate(-50%) rotate(360deg);
            }
        }
    </style>
</head>
<body>
<section id="navbar">
    <div class="container-fluid bg-primary">
        <div class="container">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <a class="navbar-brand" href="#">
                    <img src="{{ asset('assets/home/images/logo_funring.png') }}" class="img-fluid">
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavDropdown">
                    <ul class="navbar-nav">
                        <li class="nav-item active">
                            <a class="nav-link" href="#">TRANG CH???<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">B??I H??T</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">B???NG X???P H???NG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">LI??N H???</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
</section>
<section id="content">
    <div class="container-fluid p-0">
        <div>
            <img src="{{ asset('assets/home/images/banner-funring.jpg') }}" class="img-fluid">
        </div>
        <div class="container">
            @if(!empty($msisdn))
                <p>Xin ch??o: {{ substr($msisdn, 0, 7) .'xxxx' }}</p>
            @endif
            <h1 class="text-danger">CHI TI???T</h1>
            <h3>H?????NG D???N ????NG K?? NH???C CH??? FUNRING GI?? R???</h3>
            <p>So???n ngay <span class="text-danger">DK N1</span> g???i <span class="text-danger">9224</span> ????? ????ng k?? d???ch v??? nh???c ch??? funring c???a MobiFone v?? t??? tin th??? hi???n c?? t??nh c???a m??nh</p>
            <h4>1. Gi???i thi???u</h4>
            <p>Nh???c ch??? Funring gi??p b???n l???a ch???n nh???ng ??o???n nh???c h???p d???n thay cho h???i chu??ng ch??? th??ng th?????ng khi c?? ng?????i kh??c g???i ??i???n ?????n b???n.</p>
            <h4>2. Gi?? c?????c d???ch v??? nh???c ch??? Funring</h4>
            <p>Ch??? v???i m???c ph?? SI??U R??? 1000 ?????ng/ng??y, b???n ???? c?? th??? s??? d???ng ngay d???ch v??? nh???c ch??? Funring ?????y c?? t??nh v?? h???p d???n t??? nh?? m???ng MobiFone.</p>
            <h4>3. H?????ng d???n ????ng k?? nh???c ch??? Funring</h4>
            <p>C??ch ????ng k?? r???t ????n gi???n. B???n ch??? c???n th???c hi???n theo 1 trong 2 c??ch sau:</p>
            <p>- So???n tin nh???n <span class="text-danger">DKY N1</span> g???i <span class="text-danger">9224</span></p>
            <p>- C??ch 2: B???m v??o n??t <span><a href="javascript://" class="btn btn-primary  btn-reg">????NG K?? NGAY</a></span> v?? ch???n ?????ng ??.</p>
            <h4>4. H?????ng d???n s??? d???ng d???ch v??? Funring c???a MobiFone</h4>
            <p>Sau khi ????ng k?? th??nh c??ng, ????? ch???n b??i h??t y??u th??ch ??a th??ch l??m nh???c ch???, b???n vui l??ng so???n: <span>CHON 5409390</span> g???i <span>9224</span>.</p>
        </div>
        <div class="container d-flex justify-content-center">
            <a href="javascript://" class="btn btn-lg btn-primary btn-reg">????NG K?? NGAY</a>
        </div>
        <div class="container">
            <h1 class="text-danger">B??I H??T</h1>
        </div>
    </div>
</section>
<section id="footer">
    <div class="container-fluid bg-primary">
        <div class="container text-white">
            <p>T???ng ????i h??? tr???: (024) 85860616</p>
            <p>Ph??? tr??ch: Mrs. Hi???n</p>
            <p>??? All rights reserved</p>
        </div>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js" integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js" integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2" crossorigin="anonymous"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $('.btn-reg').on('click', function (e) {
        $.ajax({
            url: '/log',
            method: "POST",
            data: {
                pkg: "N3",
                cp: "VANO",
                name: "VANO",
                code: "abcabc"
            },
            success: function (response) {
                // window.location.href = response.url
            }
        })
    });
</script>
</body>
</html>
