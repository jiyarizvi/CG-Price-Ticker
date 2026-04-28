<?php
/**
 * Plugin Name: Coin Gazette - Crypto Price Ticker
 * Description: A custom Minimalist crypto price ticker with top/bottom placement for Coin Gazette.
 * Version: 1.0
 * Author: Coin Gazette
 */

if (!defined('ABSPATH')) exit;

class CG_Price_Ticker {

    public function __construct() {
        add_action('admin_menu', [$this, 'settings_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('wp_footer', [$this, 'render_ticker']);
        add_action('wp_head', [$this, 'render_ticker']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
    }

    public function enqueue_assets() {
        wp_enqueue_script('cg-price-ticker', plugin_dir_url(__FILE__) . 'ticker.js', [], null, true);
        wp_enqueue_style('cg-price-ticker-style', plugin_dir_url(__FILE__) . 'ticker.css');
    }

    public function settings_menu() {
        add_options_page(
            'Crypto Price Ticker',
            'Crypto Price Ticker',
            'manage_options',
            'cg-price-ticker',
            [$this, 'settings_page']
        );
    }

    public function register_settings() {
        register_setting('cg_price_ticker_group', 'cg_ticker_position');
        register_setting('cg_price_ticker_group', 'cg_ticker_coins');
    }

    public function settings_page() {
        ?>
        <div class="wrap">
            <h1>Crypto Price Ticker Settings</h1>

            <form method="post" action="options.php">
                <?php settings_fields('cg_price_ticker_group'); ?>

                <h2>Placement</h2>
                <select name="cg_ticker_position">
                    <?php $pos = get_option('cg_ticker_position', 'bottom'); ?>
                    <option value="top" <?php selected($pos, 'top'); ?>>Top of Page</option>
                    <option value="bottom" <?php selected($pos, 'bottom'); ?>>Bottom of Page</option>
                </select>

                <h2>Coins (comma-separated CoinGecko IDs)</h2>
                <input type="text" name="cg_ticker_coins"
                       value="<?php echo esc_attr(get_option('cg_ticker_coins', 'bitcoin,ethereum,solana')); ?>"
                       class="regular-text" />

                <?php submit_button(); ?>
            </form>
        </div>
        <?php
    }

    public function render_ticker() {
        $position = get_option('cg_ticker_position', 'bottom');
        $coins = get_option('cg_ticker_coins', 'bitcoin,ethereum,solana');

        // Only render once
        if (($position === 'top' && did_action('wp_head') > 1) ||
            ($position === 'bottom' && did_action('wp_footer') > 1)) {
            return;
        }

        echo '<div id="cg-price-ticker" data-coins="' . esc_attr($coins) . '"></div>';
    }
}

new CG_Price_Ticker();
