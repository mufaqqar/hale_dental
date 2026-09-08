<?php
/**
 * Custom search form
 *
 * @package Hale_Dental
 */
?>
<form role="search" method="get" class="flex" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <input type="search" name="s" placeholder="<?php esc_attr_e( 'Search...', 'hale-dental' ); ?>" value="<?php echo get_search_query(); ?>"
        class="flex-1 px-4 py-2 border border-dental-light-gray rounded-l-theme text-sm focus:outline-none focus:ring-2 focus:ring-primary focus:border-transparent transition-all" />
    <button type="submit" class="px-4 py-2 bg-primary text-white rounded-r-theme hover:bg-primary-dark transition-colors" aria-label="<?php esc_attr_e( 'Search', 'hale-dental' ); ?>">
        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    </button>
</form>
