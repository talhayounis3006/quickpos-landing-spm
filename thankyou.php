<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You – QuickPOS</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>

        *{
            margin:0;
            padding:0;
            box-sizing:border-box;
        }

        body{
            font-family:'Inter',sans-serif;

            min-height:100vh;

            display:flex;
            align-items:center;
            justify-content:center;

            background:#070b17;

            overflow:hidden;

            color:white;

            position:relative;
        }

        /* =========================================================
           BACKGROUND GLOWS
        ========================================================= */

        body::before,
        body::after{
            content:"";
            position:fixed;

            width:500px;
            height:500px;

            border-radius:50%;

            filter:blur(120px);

            z-index:-1;

            opacity:0.4;
        }

        body::before{
            background:#7c3aed;

            top:-120px;
            left:-120px;
        }

        body::after{
            background:#06b6d4;

            bottom:-150px;
            right:-120px;
        }

        /* =========================================================
           CARD
        ========================================================= */

        .card{

            width:90%;
            max-width:520px;

            padding:4rem 3rem;

            text-align:center;

            border-radius:32px;

            background:rgba(255,255,255,0.06);

            backdrop-filter:blur(22px);
            -webkit-backdrop-filter:blur(22px);

            border:1px solid rgba(255,255,255,0.08);

            box-shadow:
            0 25px 60px rgba(0,0,0,0.35);

            position:relative;

            overflow:hidden;
        }

        .card::before{
            content:"";

            position:absolute;

            width:180px;
            height:180px;

            background:linear-gradient(
                135deg,
                rgba(103,232,249,0.18),
                rgba(168,85,247,0.18)
            );

            border-radius:50%;

            top:-70px;
            right:-70px;

            filter:blur(10px);
        }

        /* =========================================================
           ICON
        ========================================================= */

        .icon{

            width:100px;
            height:100px;

            margin:0 auto 2rem;

            border-radius:28px;

            display:flex;
            align-items:center;
            justify-content:center;

            font-size:3rem;

            background:
            linear-gradient(135deg,#06b6d4,#7c3aed);

            box-shadow:
            0 20px 40px rgba(124,58,237,0.35);
        }

        /* =========================================================
           TEXT
        ========================================================= */

        h1{
            font-size:2.4rem;
            font-weight:800;

            margin-bottom:1rem;

            letter-spacing:-1px;
        }

        p{
            color:#b8c4d4;

            font-size:1.05rem;

            line-height:1.9;

            margin-bottom:2.5rem;
        }

        /* =========================================================
           BUTTON
        ========================================================= */

        .btn{

            display:inline-block;

            padding:1rem 2rem;

            border-radius:16px;

            background:
            linear-gradient(135deg,#06b6d4,#7c3aed);

            color:white;

            font-weight:700;

            transition:0.3s ease;

            box-shadow:
            0 15px 35px rgba(124,58,237,0.35);
        }

        .btn:hover{

            transform:
            translateY(-3px);

            box-shadow:
            0 20px 45px rgba(124,58,237,0.45);
        }

        /* =========================================================
           RESPONSIVE
        ========================================================= */

        @media(max-width:600px){

            .card{
                padding:3rem 2rem;
            }

            h1{
                font-size:2rem;
            }

            p{
                font-size:1rem;
            }

        }

    </style>
</head>

<body>

    <div class="card">

        <div class="icon">
            ✅
        </div>

        <h1>
            Message Sent Successfully
        </h1>

        <p>
            Thank you for contacting QuickPOS.<br>
            Our team has received your message and will respond within 24 hours.
        </p>

        <a href="index.php" class="btn">
            ← Back to Home
        </a>

    </div>

</body>
</html>