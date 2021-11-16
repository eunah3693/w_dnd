class pageFlatpickr {
    static initFlatpickr() {

        // Init Flatpickr (with .js-flatpickr class)
        jQuery('.js-flatpickr:not(.js-flatpickr-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-flatpickr-enabled class to tag it as activated
            el.addClass('js-flatpickr-enabled');

            // Init it
            flatpickr(el, {
                enableTime: true,
                dateFormat: "Y-m-d H:i",
            });
        });

    }
    static init() {
        this.initFlatpickr();
    }
}
// Initialize when page loads
jQuery(() => { pageFlatpickr.init(); });
