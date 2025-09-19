<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FishTracker - Login</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/bootstrap/bootstrap.min.css">
    <link rel="stylesheet" href="./assets/css/customize.css">
    <link rel="stylesheet" href="./assets/css/dashboard.css">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="shortcut icon" href="./assets/img/fishLogo.png" type="image/x-icon">

    <style>
    body {
        margin: 0;
        /* background: linear-gradient(to right, #EF9E28, #FA8A5F); */
        min-height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden;
    }

    .background-fish {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        z-index: 1;
        overflow: hidden;
    }

    .fish {
        position: absolute;
        width: 60px;
        opacity: 0.9;
        pointer-events: none;
        will-change: transform;
    }

    .login-card {
        border-radius: 1rem;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
        position: relative;
        z-index: 10;
        background: white;
    }
    </style>
</head>

<body>
    <!-- Fullscreen fish layer -->
    <div class="background-fish" id="fishLayer"></div>

    <!-- Login form -->
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card login-card p-4">
                    <div class="card-body">
                        <div class="flex-center gap-3 mb-4">
                            <img src="./assets/img/fishLogo.png" alt="Logo" style="height:50px;">
                            <h3 class="text-center m-0">FishTracker Login</h3>
                        </div>
                        <form action="login.php" method="POST">
                            <div class="form-group">
                                <input type="text" id="email" class="form-control-custom" required placeholder="">
                                <label for="email" class="form-label-custom">Username or Email</label>
                            </div>
                            <div class="form-group">
                                <input type="password" id="password" class="form-control-custom" required
                                    placeholder="">
                                <label for="password" class="form-label-custom">Password</label>
                            </div>
                            <div class="d-grid">
                                <button type="submit" class="btn btn-lg btn-orange login">Login</button>
                            </div>
                        </form>
                        <p class="text-center mt-3 mb-0">
                            <a href="#" class="text-decoration-none text-danger">Forgot Password?</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- JavaScript for realistic fish swimming -->
    <script>
    const fishImg = "./assets/img/fishLogo.png";
    const numFish = 10;
    const fishes = [];

    class Fish {
        constructor(layer) {
            this.el = document.createElement("img");
            this.el.src = fishImg;
            this.el.classList.add("fish");
            layer.appendChild(this.el);

            this.x = Math.random() * window.innerWidth;
            this.y = Math.random() * window.innerHeight;
            this.angle = Math.random() * Math.PI * 2;
            this.speed = 1.5 + Math.random() * 1.5;

            this.updatePosition();
        }

        updatePosition() {
            // Offset so fish face their swimming direction
            const offset = -Math.PI / 1; // adjust this if your fish points another way
            this.el.style.transform = `translate(${this.x}px, ${this.y}px) rotate(${this.angle + offset}rad)`;
        }

        move(targetDir = null) {
            if (targetDir && Math.random() < 0.7) {
                this.angle += (targetDir - this.angle) * 0.05;
            } else {
                this.angle += (Math.random() - 0.5) * 0.05;
            }

            this.x += Math.cos(this.angle) * this.speed;
            this.y += Math.sin(this.angle) * this.speed;

            // keep inside window
            if (this.x < 0) this.x = 0, this.angle = 0;
            if (this.x > window.innerWidth - 50) this.x = window.innerWidth - 50, this.angle = Math.PI;
            if (this.y < 0) this.y = 0, this.angle = Math.PI / 2;
            if (this.y > window.innerHeight - 50) this.y = window.innerHeight - 50, this.angle = -Math.PI / 2;

            this.updatePosition();
        }
    }

    const layer = document.getElementById("fishLayer");
    for (let i = 0; i < numFish; i++) {
        fishes.push(new Fish(layer));
    }

    function animate() {
        let groupAngle = null;
        if (Math.random() < 0.01) {
            const leader = fishes[Math.floor(Math.random() * fishes.length)];
            groupAngle = leader.angle;
        }
        fishes.forEach(f => f.move(groupAngle));
        requestAnimationFrame(animate);
    }
    animate();
    </script>
</body>

</html>