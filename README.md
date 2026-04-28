# CG-Price-Ticker

A lightweight, minimalist, fully responsive crypto price ticker for WordPress — designed with Coin Gazette’s editorial aesthetic, cobalt‑blue accents, and a clean white interface.
Displays live prices, logos, and 24h changes for any set of cryptocurrencies using the CoinGecko API.

## ✨ Features

Minimalist design 

Top or bottom placement (admin setting)

Hover‑pause for readability

Sticky on scroll (appears after user scrolls down)

Exchange logos (CoinGecko icons)

Mobile‑optimized compact mode

External CoinGecko links for each token

No dependencies (no jQuery, no frameworks)

Fast + lightweight (pure JS + CSS)

## 📦 Installation
Download or clone the repository:

```
git clone https://github.com/jiyarizvi/CG-Price-Ticker.git
```
Upload the folder to:

```
/wp-content/plugins/cg-price-ticker/
```

Activate CG‑Price‑Ticker in the WordPress admin panel.

Go to:

Settings → Crypto Ticker

Choose:

Ticker position (Top / Bottom)

Comma‑separated CoinGecko IDs (e.g., bitcoin,ethereum,solana)

## ⚙️ Configuration

Ticker Position

Choose where the ticker appears:

Top of the page

Bottom of the page

Coins List
Enter CoinGecko IDs (not symbols), separated by commas.

Example:

```
bitcoin,ethereum,solana,cardano,chainlink
```

Recommended: Top 30 Coins

```
bitcoin,ethereum,tether,binancecoin,solana,usd-coin,xrp,staked-ether,cardano,avalanche,dogecoin,tron,shiba-inu,wrapped-bitcoin,chainlink,polkadot,bitcoin-cash,uniswap,polygon,near,leo-token,stellar,monero,okb,ethereum-classic,cosmos,crypto-com-chain,filecoin,internet-computer
```

## 🎨 Design Philosophy

CG‑Price‑Ticker follows Coin Gazette’s visual identity, you can fork this plugin to your liking and set your own styles.


## 🧩 How It Works
The plugin fetches real‑time market data from the CoinGecko Markets API:

```
https://api.coingecko.com/api/v3/coins/markets
```
For each coin, it displays:

Logo

Symbol

Price (USD)

24h % change

External link to CoinGecko 

## 📱 Mobile Mode

On screens under 600px:

Prices are hidden for compactness

Logos + symbols remain visible

Layout spacing tightens

This keeps the ticker readable without overwhelming mobile users.

## 🛠️ Developer Notes

No PHP templating required

No shortcodes

No jQuery

No external libraries

Fully self‑contained plugin

## 🔗 External Links

CoinGecko API Docs: https://www.coingecko.com/en/api

WordPress Plugin Handbook: https://developer.wordpress.org/plugins/

## 📄 License
MIT License — free to use, modify, and distribute.

## 🤝 Contributing

Pull requests are welcome.
If you’d like to add features (e.g., trending coins, top movers, volume display), feel free to open an issue.
