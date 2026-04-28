<?php
/**
 * Plugin Name: Coin Gazette - Advanced Crypto Ticker
 * Description: Minimalist, responsive crypto ticker with sparkline charts, theme auto-detect, hover-pause, and exchange logos.
 * Version: 2.0
 * Author: Coin Gazette
 */

if (!defined('ABSPATH')) exit;

class CG_Advanced_Ticker {

    public function __construct() {
        add_action('admin_menu', [$this, 'settings_menu']);
        add_action('admin_init', [$this, 'register_settings']);
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets']);
        add_action('wp_footer', [$this, 'render_ticker']);
    }

    public function enqueue_assets() {
        wp_enqueue_style('cg-ticker-style', plugin_dir_url(__FILE__) . 'ticker.css');
        wp_enqueue_script('cg-ticker-js', plugin_dir_url(__FILE__) . 'ticker.js', [], null, true);

        wp_localize_script('cg-ticker-js', 'CGTicker', [
            'coins' => get_option('cg_ticker_coins', 'bitcoin,ethereum,solana'),
            'position' => get_option('cg_ticker_position', 'bottom'),
        ]);
    }

    public function settings_menu() {
        add_options_page(
            'Crypto Ticker Settings',
            'Crypto Ticker',
            'manage_options',
            'cg-price-ticker',
            [$this, 'settings_page']
        );
    }

    public function register_settings() {
        register_setting('cg_ticker_group', 'cg_ticker_position');
        register_setting('cg_ticker_group', 'cg_ticker_coins');
    }

    public function settings_page() {
        ?>
        <div class="wrap">
            <h1>Crypto Ticker Settings</h1>

            <form method="post" action="options.php">
                <?php settings_fields('cg_ticker_group'); ?>

                <h2>Placement</h2>
                <select name="cg_ticker_position">
                    <?php $pos = get_option('cg_ticker_position', 'bottom'); ?>
                    <option value="top" <?php selected($pos, 'top'); ?>>Top</option>
                    <option value="bottom" <?php selected($pos, 'bottom'); ?>>Bottom</option>
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
        echo '<div id="cg-advanced-ticker"></div>';
    }
}

new CG_Advanced_Ticker();
