<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password dengan Kode – Bookify</title>

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
            width:300px;
            height:300px;
            background:rgba(255,107,107,0.1);
            bottom:-100px;
            right:-100px;
        }

        .nav{
            position:relative;
            z-index:2;
            padding:20px 40px;
        }

        .nav a{
            text-decoration:none;
            color:#fff;
            font-weight:500;
        }

        .logo{
            font-family:'Playfair Display',serif;
            font-size:24px;
            font-weight:900;
        }

        .logo-main{
            color:#7c6af7;
        }

        .logo-sub{
            font-size:9px;
            letter-spacing:2px;
            color:#8880c0;
        }

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
            background:rgba(124,106,247,0.1);
            border:1px solid rgba(124,106,247,0.2);
            color:#7c6af7;
            font-size:12px;
            font-weight:500;
            margin-bottom:20px;
        }

        .dot{
            width:6px;
            height:6px;
            border-radius:50%;
            background:#7c6af7;
        }

        .title{
            font-family:'Playfair Display',serif;
            font-size:32px;
            font-weight:700;
            margin-bottom:8px;
            line-height:1.2;
        }

        .title span{
            color:#7c6af7;
        }

        .subtitle{
            color:#b8b8c7;
            font-size:14px;
            line-height:1.5;
            margin-bottom:30px;
        }

        .form-group{
            margin-bottom:20px;
        }

        .label{
            display:block;
            font-size:14px;
            font-weight:500;
            margin-bottom:8px;
            color:#fff;
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

        .btn:hover{
            transform:translateY(-2px);
            box-shadow:0 8px 35px rgba(124,106,247,0.5);
        }

        .link{
            text-align:center;
            margin-top:20px;
        }

        .link a{
            color:#7c6af7;
            text-decoration:none;
            font-size:14px;
        }

        .link a:hover{
            text-decoration:underline;
        }
    </style>
</head>
<body>
    <!-- BACKGROUND -->
    <div class="bg-grid"></div>
    <div class="orb orb1"></div>
    <div class="orb orb2"></div>

    <!-- NAV -->
    <nav class="nav">
        <a href="{{ route('welcome') }}">
            <div class="logo">
                <span class="logo-main">Bookify</span>
                <div class="logo-sub">DIGITAL LIBRARY</div>
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
                Reset <span>Password</span>
            </h1>

            <p class="subtitle">
                Masukkan alamat email akun Bookify kamu.
                Kami akan berikan kode reset password.
            </p>

            @if(session('status'))
                <div class="alert alert-success mb-4">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('password.send-code') }}">
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
                            value="{{ old('email') }}"
                            required
                        >
                    </div>

                    @error('email')
                        <div class="mt-2 text-red-400 text-sm">{{ $message }}</div>
                    @enderror
                </div>

                <button type="submit" class="btn">
                    Dapatkan Kode Reset →
                </button>
            </form>

            <div class="link">
                <a href="{{ route('login') }}">← Kembali ke Login</a>
            </div>
        </div>
    </div>
</body>
</html>