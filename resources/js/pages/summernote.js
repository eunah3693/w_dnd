function sendFile() {
    data = new FormData();
    data.append("file", file);
    url = "./board/imgupload";
    $.ajax({
        data: data,
        type: "POST",
        url: url,
        cache: false,
        contentType: false,
        processData: false,
        success: function (url) {
            editor.insertImage(welEditable, url);
        }
    });
}

class pageSummernote {
    static initSummernote() {
        // Init text editor in air mode (inline)
        jQuery('.js-summernote-air:not(.js-summernote-air-enabled)').each((index, element) => {
            // Add .js-summernote-air-enabled class to tag it as activated and init it
            jQuery(element).addClass('js-summernote-air-enabled').summernote({
                airMode: true,
                tooltip: false
            });
        });

        // Init full text editor
        jQuery('.js-summernote:not(.js-summernote-enabled)').each((index, element) => {
            let el = jQuery(element);

            // Add .js-summernote-enabled class to tag it as activated and init it
            el.addClass('js-summernote-enabled').summernote({
                height: el.data('height') || 350,
                minHeight: el.data('min-height') || null,
                maxHeight: el.data('max-height') || null,
                onImageUpload: function(files, editor, welEditable) {
                    sendFile(files[0],editor,welEditable);
                }
            });
        });
    }
    static init() {
        this.initSummernote();
    }
}
// Initialize when page loads
jQuery(() => { pageSummernote.init(); });
