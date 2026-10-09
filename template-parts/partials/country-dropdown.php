<?php
/**
 * Country dial-code dropdown for phone fields.
 *
 * @param array $args {
 *     @type string $theme 'dark' (default) or 'light'.
 * }
 */

$countries = function_exists('hale_get_countries') ? hale_get_countries() : array();
$theme     = isset($args['theme']) ? $args['theme'] : 'dark';
$is_dark   = ($theme === 'dark');

$default_dial = '+92';
$default_flag = '🇵🇰';

$toggle_classes = $is_dark ? 'text-white/85 hover:text-white' : 'text-coff_black hover:text-primary';

$panel_classes = $is_dark
    ? 'border-white/15 bg-[#0d1733] shadow-[0_20px_50px_rgba(0,0,0,0.35)]'
    : 'border-gray-200 bg-white shadow-[0_20px_50px_rgba(0,0,0,0.15)]';

$item_classes = $is_dark ? 'text-white/85 hover:bg-white/10' : 'text-coff_black hover:bg-primary/5';
$dial_classes = $is_dark ? 'text-white/55' : 'text-secondaryLight';
$active_class = $is_dark ? 'bg-white/5' : 'bg-primary/5';
?>
<div class="hale-country relative shrink-0" data-default-dial="<?php echo esc_attr($default_dial); ?>"
    data-default-flag="<?php echo esc_attr($default_flag); ?>">
    <button type="button"
        class="hale-country-toggle flex h-full items-center gap-1.5 pl-4 pr-2 text-[13px] transition cursor-pointer <?php echo esc_attr($toggle_classes); ?>"
        aria-haspopup="listbox" aria-expanded="false" aria-label="<?php esc_attr_e('Select country code', 'hale_dental'); ?>">
        <span class="hale-country-flag text-[17px] leading-none"><?php echo esc_html($default_flag); ?></span>
        <span class="hale-country-dial"><?php echo esc_html($default_dial); ?></span>
        <svg class="h-3 w-3 <?php echo esc_attr($dial_classes); ?>" viewBox="0 0 24 24" fill="none" stroke="currentColor"
            stroke-width="2" aria-hidden="true">
            <path d="m6 9 6 6 6-6" />
        </svg>
    </button>

    <input type="hidden" name="country_code" value="<?php echo esc_attr($default_dial); ?>">

    <ul class="hale-country-list absolute left-0 top-full z-30 mt-2 hidden max-h-64 w-64 overflow-y-auto rounded-xl border py-1 <?php echo esc_attr($panel_classes); ?>"
        role="listbox">
        <?php foreach ($countries as $country) : ?>
            <li role="option" tabindex="-1" data-dial="<?php echo esc_attr($country['dial']); ?>"
                data-flag="<?php echo esc_attr($country['flag']); ?>"
                class="flex cursor-pointer items-center gap-2 px-4 py-2 text-[13px] <?php echo esc_attr($item_classes); ?><?php echo ($country['dial'] === $default_dial && $country['flag'] === $default_flag) ? ' ' . esc_attr($active_class) : ''; ?>">
                <span class="text-[16px] leading-none"><?php echo esc_html($country['flag']); ?></span>
                <span class="flex-1 truncate"><?php echo esc_html($country['name']); ?></span>
                <span class="text-[12px] <?php echo esc_attr($dial_classes); ?>"><?php echo esc_html($country['dial']); ?></span>
            </li>
        <?php endforeach; ?>
    </ul>
</div>
