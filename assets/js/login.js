
const fishImg = "../assets/img/fishLogo.png";
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