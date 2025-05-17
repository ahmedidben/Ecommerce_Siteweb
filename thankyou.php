<?php
session_start();
include_once("./connection.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Thank You!</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            background: #f8f8f8;
            font-family: 'Roboto', sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
        }

        .thankyou-container {
            text-align: center;
            background: white;
            padding: 60px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            animation: pop 0.5s ease;
        }

        @keyframes pop {
            0% { transform: scale(0.5); opacity: 0; }
            100% { transform: scale(1); opacity: 1; }
        }

        .checkmark {
            font-size: 80px;
            color: #28a745;
            animation: bounce 1s infinite alternate;
        }

        @keyframes bounce {
            0% { transform: translateY(0); }
            100% { transform: translateY(-10px); }
        }

        h1 {
            font-size: 36px;
            color: #333;
            margin-top: 20px;
        }

        p {
            color: #666;
            margin: 10px 0 20px;
        }

        .redirect-msg {
            color: #999;
            font-size: 14px;
        }

        .confetti {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            pointer-events: none;
        }
    </style>
</head>
<body>

<div class="thankyou-container">
    <div class="checkmark"><i class="fa-solid fa-circle-check"></i></div>
    <h1>Thank You!</h1>
    <p>Your order was successful 🛍️</p>
    <p>you will pay With Cash</p>
    <p>We hope you enjoy your purchase.</p>
    <div class="redirect-msg">Redirecting to home in <span id="countdown">5</span> seconds...</div>
</div>


<canvas class="confetti"></canvas>

<script>
    // Countdown before redirect
    let seconds = 5;
    const countdown = document.getElementById("countdown");
    const interval = setInterval(() => {
        seconds--;
        countdown.textContent = seconds;
        if (seconds <= 0) {
            clearInterval(interval);
            window.location.href = "index.php";
        }
    }, 1000);

    // 🎉 Confetti animation
    const canvas = document.querySelector(".confetti");
    const ctx = canvas.getContext("2d");
    canvas.width = window.innerWidth;
    canvas.height = window.innerHeight;

    const pieces = [];
    for (let i = 0; i < 150; i++) {
        pieces.push({
            x: Math.random() * canvas.width,
            y: Math.random() * canvas.height - canvas.height,
            size: Math.random() * 10 + 5,
            color: `hsl(${Math.random() * 360}, 100%, 50%)`,
            speed: Math.random() * 3 + 1,
            swing: Math.random() * 10
        });
    }

    function update() {
        ctx.clearRect(0, 0, canvas.width, canvas.height);
        for (const p of pieces) {
            p.y += p.speed;
            p.x += Math.sin(p.y * 0.01) * p.swing * 0.1;
            ctx.fillStyle = p.color;
            ctx.beginPath();
            ctx.arc(p.x, p.y, p.size, 0, Math.PI * 2);
            ctx.fill();

            if (p.y > canvas.height) p.y = -p.size;
        }
        requestAnimationFrame(update);
    }
    update();
</script>

</body>
</html>
<?php
if(isset($_SESSION['$id_commandes_Buy'])&& $_SESSION['$id_user_de_commande']){
    $cmds=$_SESSION['$id_commandes_Buy'];
    $user_id=$_SESSION['$id_user_de_commande'];
    foreach($cmds as $cmd){
        // cas de livrision
        $rqt="UPDATE commande
        set Statut='EN livrision'
        WHERE Num=$cmd and IDClient=$user_id";
        $rp=mysqli_query($conn,$rqt);
        if(! $rp){
            echo "error de Update table de commande";
        }

        //cas de arrivee (apres 3 jour)
        $rqt1="SELECT * from commande WHERE Num=$cmd and IDClient=$user_id";
        $rp1=mysqli_query($conn,$rqt1);
        if($rp1){
            while($row=mysqli_fetch_assoc($rp1)){
                $dateFromDB = $row['DateCommande']; // example date from database
                $date = new DateTime($dateFromDB);
                $date->modify('+3 days');
                $newDate = $date->format('Y-m-d');
                $currentDate=date("Y-m-d");
                $rqt2="UPDATE commande
                set Statut='EN livrision'
                WHERE Num=$cmd and IDClient=$user_id" and $currentDate=$newDate;
                $rp2=mysqli_query($conn,$rqt2);
                if(! $rp2){
                     echo "error de Update table de commande";
                }

            }
        }else{
            echo "error";
        }
    }
}
?>
