<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi – Bookify</title>

    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=DM+Sans:wght@300;400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">

    <style>
        *, *::before, *::after{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'DM Sans',sans-serif;
            background:#070711;
            min-height:100vh;
            overflow:hidden;
            color:#fff;
            position:relative;
        }

        /* BACKGROUND */

        .bg-grid{
            position:fixed;
            inset:0;
            background-image:
                linear-gradient(rgba(255,255,255,0.03) 1px, transparent 1px),
                linear-gradient(90deg, rgba(255,255,255,0.03) 1px, transparent 1px);
            background-size:48px 48px;
            z-index:0;
        }

        .orb{
            position:absolute;
            border-radius:50%;
            filter:blur(80px);
        }

        .orb1{
            width:500px;
            height:500px;
            background:rgba(124,106,247,0.15);
            top:-150px;
            left:-120px;
        }

        .orb2{
            width:400px;
            height:400px;
            background:rgba(79,70,229,0.15);
            bottom:-150px;
            right:-100px;
        }

        /* NAVBAR */

        nav{
            position:relative;
            z-index:10;
            display:flex;
            justify-content:space-between;
            align-items:center;
            padding:16px 40px;
            border-bottom:1px solid rgba(255,255,255,0.06);
            background:rgba(8,8,16,0.7);
            backdrop-filter:blur(20px);
        }

        .logo{
            display:flex;
            align-items:center;
            gap:10px;
            text-decoration:none;
        }

        .logo-icon{
            width:38px;
            height:38px;
            border-radius:10px;
            background:linear-gradient(135deg,#7c6af7,#4f46e5);
            display:flex;
            align-items:center;
            justify-content:center;
            font-size:18px;
        }

        .logo-title{
            font-family:'Playfair Display',serif;
            font-size:18px;
            color:#fff;
            font-weight:700;
        }

        .logo-sub{
            font-size:9px;
            letter-spacing:2px;
            color:#8880c0;
        }

        /* MAIN */

        .container{
            position:relative;
            z-index:2;
            min-height:calc(100vh - 70px);
            display:flex;
            align-items:center;
            justify-content:center;
            padding:20px;
        }

        .card{
            width:100%;
            max-width:430px;
            background:rgba(255,255,255,0.03);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:24px;
            padding:40px 35px;
            backdrop-filter:blur(20px);
            position:relative;
            overflow:hidden;
        }

        .card::before{
            content:'';
            position:absolute;
            top:0;
            left:0;
            width:100%;
            height:1px;
            background:linear-gradient(
                90deg,
                transparent,
                rgba(124,106,247,0.8),
                transparent
            );
        }

        .badge{
            display:inline-flex;
            align-items:center;
            gap:6px;
            padding:5px 14px;
            border-radius:999px;
            border:1px solid rgba(124,106,247,0.3);
            color:#a99ef5;
            background:rgba(124,106,247,0.06);
            font-size:10px;
            letter-spacing:2px;
            text-transform:uppercase;
            margin-bottom:18px;
        }

        .dot{
            width:6px;
            height:6px;
            background:#7c6af7;
            border-radius:50%;
        }

        .title{
            font-family:'Playfair Display',serif;
            font-size:36px;
            line-height:1.2;
            margin-bottom:10px;
        }

        .title span{
            color:#a99ef5;
            font-style:italic;
        }

        .subtitle{
            color:#7b76a8;
            font-size:14px;
            margin-bottom:28px;
            line-height:1.6;
        }

        /* FORM */

        .form-group{
            margin-bottom:20px;
        }

        .label{
            display:block;
            margin-bottom:8px;
            font-size:12px;
            color:#9e97d9;
            text-transform:uppercase;
            letter-spacing:1px;
        }

        .input-box{
            display:flex;
            align-items:center;
            background:rgba(255,255,255,0.92);
            border-radius:12px;
            overflow:hidden;
            border:1px solid rgba(255,255,255,0.1);
        }

        .input-icon{
            width:50px;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#7c6af7;
            font-size:18px;
        }

        .input{
            flex:1;
            border:none;
            outline:none;
            background:transparent;
            padding:14px 14px 14px 0;
            font-size:14px;
            color:#1a1a2e;
            font-family:'DM Sans',sans-serif;
        }

        .input::placeholder{
            color:#8b8ba7;
        }

        .btn{
            width:100%;
            border:none;
            border-radius:999px;
            padding:14px;
            background:linear-gradient(135deg,#7c6af7,#5144dc);
            color:#fff;
            font-size:14px;
            font-weight:600;
            cursor:pointer;
            transition:0.2s;
            box-shadow:0 6px 30px rgba(124,106,247,0.35);
        }

        .method-selection{
            display:flex;
            flex-direction:column;
            gap:12px;
            margin-bottom:30px;
        }

        .method-option{
            display:flex;
            align-items:center;
            gap:12px;
            padding:16px;
            background:rgba(255,255,255,0.05);
            border:1px solid rgba(255,255,255,0.08);
            border-radius:12px;
            cursor:pointer;
            transition:0.2s;
        }

        .method-option:hover{
            background:rgba(255,255,255,0.08);
            border-color:rgba(124,106,247,0.3);
        }

        .method-option input[type="radio"]{
            display:none;
        }

        .method-option input[type="radio"]:checked + label{
            color:#7c6af7;
        }

        .method-option input[type="radio"]:checked ~ label .method-icon{
            background:#7c6af7;
            color:#fff;
        }

        .method-option label{
            display:flex;
            align-items:center;
            gap:12px;
            cursor:pointer;
            margin:0;
            width:100%;
        }

        .method-icon{
            width:40px;
            height:40px;
            background:rgba(255,255,255,0.1);
            border-radius:8px;
            display:flex;
            align-items:center;
            justify-content:center;
            color:#8880c0;
            transition:0.2s;
        }

        .method-content{
            flex:1;
        }

        .method-title{
            font-size:14px;
            font-weight:600;
            color:#fff;
            margin-bottom:2px;
        }

        .method-desc{
            font-size:12px;
            color:#8880c0;
        }

        .back{
            margin-top:22px;
            text-align:center;
        }

        .back a{
            color:#a99ef5;
            text-decoration:none;
            font-size:13px;
        }

        .back a:hover{
            color:#d0c9ff;
        }

        @media(max-width:500px){

            nav{
                padding:14px 20px;
            }

            .card{
                padding:35px 25px;
            }

            .title{
                font-size:30px;
            }
        }

    </style>
</head>
<body>

    <div class="bg-grid"></div>

    <div class="orb orb1"></div>
    <div class="orb orb2"></div>

    <!-- NAVBAR -->
    <nav>
        <a href="/" class="logo">
            <div class="logo-icon"><svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H12"/><path d="M18 8V7a1 1 0 0 0-1-1H5a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h14a1 1 0 0 0 1-1v-5a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1v4"/></svg></div>

            <div>
                <div class="logo-title">Bookify</div>
                <div class="logo-sub">BELI BUKU ONLINE</div>
            </div>
        </a>
    </nav>

    <!-- CONTENT -->
    <div class="container">

        <div class="card">

            <div class="badge">
                <span class="dot"></span>
                Reset Password
            </div>

            <h1 class="title">
                Lupa <span>Kata Sandi?</span>
            </h1>

            <p class="subtitle">
                Pilih metode reset password yang kamu inginkan.
            </p>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <!-- Method Selection -->
            <div class="method-selection">
                <div class="method-option" onclick="selectMethod('email')">
                    <input type="radio" id="method_email" name="reset_method" value="email" checked>
                    <label for="method_email">
                        <div class="method-icon">
                            <i class="ti ti-mail"></i>
                        </div>
                        <div class="method-content">
                            <div class="method-title">Reset via Email</div>
                            <div class="method-desc">Kirim link reset ke email kamu</div>
                        </div>
                    </label>
                </div>

                <div class="method-option" onclick="selectMethod('code')">
                    <input type="radio" id="method_code" name="reset_method" value="code">
                    <label for="method_code">
                        <div class="method-icon">
                            <i class="ti ti-device-mobile"></i>
                        </div>
                        <div class="method-content">
                            <div class="method-title">Reset dengan Kode</div>
                            <div class="method-desc">Dapatkan kode reset langsung</div>
                        </div>
                    </label>
                </div>
            </div>

            <form id="resetForm" method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label class="label">Alamat Email</label>

                    <div class="input-box">
                        <div class="input-icon">
                            <i class="ti ti-mail"></i>
                        </div>

                        <input
                            type="email"
                            name="email"
                            class="input"
                            placeholder="Masukkan email kamu"
                            required
                        >
                    </div>

                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-400 text-sm" />
                </div>

                <button type="submit" class="btn" id="submitBtn">
                    Kirim Link Reset →
                </button>

                <div class="back">
                    <a href="{{ route('login') }}">
                        ← Kembali ke halaman login
                    </a>
                </div>

            </form>

        </div>

    </div>

    <script>
        function selectMethod(method) {
            document.getElementById('method_' + method).checked = true;
            
            const form = document.getElementById('resetForm');
            const submitBtn = document.getElementById('submitBtn');
            
            if (method === 'email') {
                form.action = '{{ route("password.email") }}';
                submitBtn.textContent = 'Kirim Link Reset →';
            } else if (method === 'code') {
                form.action = '{{ route("password.send-code") }}';
                submitBtn.textContent = 'Dapatkan Kode Reset →';
            }
        }

        // Set initial state
        selectMethod('email');
    </script>

</body>
</html>