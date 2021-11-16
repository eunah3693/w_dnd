
Dropzone.options.myDropzone = {
    init: function() {
        this.on("success", function(file, serverResponse) {
            // Create the remove button
            var removeButton = Dropzone.createElement("<button>Remove file</button>");


            // Capture the Dropzone instance as closure.
            var _this = this;

            // Listen to the click event
            removeButton.addEventListener("click", function(e) {
                // Make sure the button click doesn't submit the form:
                e.preventDefault();
                e.stopPropagation();

                jQuery.ajax({
                    headers: {
                    'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
                    },
                    method: 'DELETE',
                    url: '/files/'+serverResponse.idx,
                    cache: false,
                    success: function success(data) {},
                    error: function error(jqXHR, textStatus, errorThrown) {
                    console.error(jqXHR, textStatus + " " + errorThrown);
                    }
                });
                // Remove the file preview.
                _this.removeFile(file);
                // If you want to the delete the file on the server as well,
                // you can do the AJAX request here.
            });

            // Add the button to the file preview element.
            file.previewElement.appendChild(removeButton);

            this.emit('thumbnail', file, '/thum/'+serverResponse.idx);
        });
    }
};
