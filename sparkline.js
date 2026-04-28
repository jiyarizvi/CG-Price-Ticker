function drawSparkline(canvas, data) {
    const ctx = canvas.getContext("2d");
    const w = canvas.width = 80;
    const h = canvas.height = 30;

    const min = Math.min(...data);
    const max = Math.max(...data);

    ctx.strokeStyle = "#333cee";
    ctx.lineWidth = 1.5;
    ctx.beginPath();

    data.forEach((v, i) => {
        const x = (i / (data.length - 1)) * w;
        const y = h - ((v - min) / (max - min)) * h;
        if (i === 0) ctx.moveTo(x, y);
        else ctx.lineTo(x, y);
    });

    ctx.stroke();
}
