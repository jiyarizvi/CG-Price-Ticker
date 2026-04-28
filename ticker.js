document.addEventListener("DOMContentLoaded", () => {
    const el = document.getElementById("cg-advanced-ticker");
    if (!el) return;

    const coins = CGTicker.coins.split(",");
    const position = CGTicker.position;

    el.setAttribute("data-position", position);

    // Sticky only after scroll
    window.addEventListener("scroll", () => {
        if (window.scrollY > 120) {
            el.classList.add("cg-sticky");
        } else {
            el.classList.remove("cg-sticky");
        }
    });

    // Auto-detect theme
    const dark = window.matchMedia("(prefers-color-scheme: dark)").matches;
    if (dark) el.classList.add("cg-dark");

    // Fetch prices (no sparkline)
    fetch(`https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&ids=${coins.join(",")}`)
        .then(res => res.json())
        .then(data => {
            let html = `<div class="cg-ticker-inner">`;

            data.forEach(c => {
                const change = c.price_change_percentage_24h.toFixed(2);
                const color = change >= 0 ? "#0a0" : "#d00";

                html += `
                    <a class="cg-item" href="https://www.coingecko.com/en/coins/${c.id}" target="_blank">
                        <img src="${c.image}" class="cg-logo" />
                        <span class="cg-symbol">${c.symbol.toUpperCase()}</span>
                        <span class="cg-price">$${c.current_price.toLocaleString()}</span>
                        <span class="cg-change" style="color:${color}">${change}%</span>
                    </a>
                `;
            });

            html += `</div>`;
            el.innerHTML = html;

            // Hover pause
            const inner = el.querySelector(".cg-ticker-inner");
            el.addEventListener("mouseenter", () => inner.style.animationPlayState = "paused");
            el.addEventListener("mouseleave", () => inner.style.animationPlayState = "running");
        });
});
