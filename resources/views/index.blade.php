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
                            <a class="nav-link" href="#">TRANG CHỦ<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">BÀI HÁT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">BẢNG XẾP HẠNG</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">LIÊN HỆ</a>
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
            <h1 class="text-danger">CHI TIẾT</h1>
            <h3>HƯỚNG DẪN ĐĂNG KÝ NHẠC CHỜ FUNRING GIÁ RẺ</h3>
            <p>Soạn ngay <span class="text-danger">DK {{ $url->package_code }}</span> gửi <span class="text-danger">9224</span> để đăng ký dịch vụ nhạc chờ funring của MobiFone và tự tin thể hiện cá tính của mình</p>
            <h4>1. Giới thiệu</h4>
            <p>Nhạc chờ Funring giúp bạn lựa chọn những đoạn nhạc hấp dẫn thay cho hồi chuông chờ thông thường khi có người khác gọi điện đến bạn.</p>
            <h4>2. Giá cước dịch vụ nhạc chờ Funring</h4>
            <p>Chỉ với mức phí SIÊU RẺ 1000 đồng/ngày, bạn đã có thể sử dụng ngay dịch vụ nhạc chờ Funring đầy cá tính và hấp dẫn từ nhà mạng MobiFone.</p>
            <h4>3. Hướng dẫn đăng ký nhạc chờ Funring</h4>
            <p>Cách đăng ký rất đơn giản. Bạn chỉ cần thực hiện theo 1 trong 2 cách sau:</p>
            <p>- Soạn tin nhắn <span class="text-danger">DKY {{ $url->package_code }}</span> gửi <span class="text-danger">9224</span></p>
            <p>- Cách 2: Bấm vào nút <span><a href="#" class="btn btn-primary  btn-reg">ĐĂNG KÝ NGAY</a></span> và chọn Đồng ý.</p>
            <h4>4. Hướng dẫn sử dụng dịch vụ Funring của MobiFone</h4>
            <p>Sau khi đăng ký thành công, để chọn bài hát yêu thích ưa thích làm nhạc chờ, bạn vui lòng soạn: <span>CHON 5409390</span> gửi <span>9224</span>.</p>
        </div>
        <div class="container d-flex justify-content-center">
            <a href="#" class="btn btn-lg btn-primary btn-reg">ĐĂNG KÝ NGAY</a>
        </div>
        <div class="container">
            <h1 class="text-danger">BÀI HÁT</h1>
        </div>
    </div>
</section>
<section id="footer">
    <div class="container-fluid bg-primary">
        <div class="container text-white">
            <p>Tổng đài hỗ trợ: (024) 85860616</p>
            <p>Phụ trách: Mrs. Hiền</p>
            <p>Ⓒ All rights reserved</p>
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
               pkg: "{{ $url->package_code }}",
               cp: "{{ $url->cp_id }}"
           },
           success: function (response) {
               // window.location.href = response.url
           }
       })
    });
</script>
</body>
</html>