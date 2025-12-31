
/**
 * Case Study Meta Box JavaScript
 * 
 * @package WGBG
 * @version 2.0.0
 */

(function($) {
    'use strict';

    /**
     * Initialize on document ready
     */
    $(document).ready(function() {
        // Initialize media uploader
        initMediaUploader();
        
        // Initialize gallery uploader
        initGalleryUploader();
        
        // Initialize layout toggle
        initLayoutToggle();
        
        // Initialize image removal
        initImageRemoval();
        
        // Initialize gallery image removal
        initGalleryImageRemoval();
    });

    /**
     * Media Uploader for single images
     */
    function initMediaUploader() {
        let mediaUploader;

        $(document).on('click', '.gc-upload-btn', function(e) {
            e.preventDefault();

            const button = $(this);
            const targetInput = button.data('target');
            const targetPreview = button.data('preview');

            // If the uploader already exists, reopen it
            if (mediaUploader) {
                mediaUploader.open();
                return;
            }

            // Create a new media uploader
            mediaUploader = wp.media({
                title: 'Select or Upload Image',
                button: {
                    text: 'Use this image'
                },
                multiple: false
            });

            // When an image is selected
            mediaUploader.on('select', function() {
                const attachment = mediaUploader.state().get('selection').first().toJSON();
                
                // Set the image URL to the hidden input
                $('#' + targetInput).val(attachment.url);
                
                // Show the preview image
                $('#' + targetPreview)
                    .attr('src', attachment.url)
                    .show();
                
                // Show remove button if it exists
                button.next('.gc-remove-single-image').show();
            });

            // Open the uploader
            mediaUploader.open();
        });
    }

    /**
     * Gallery Uploader for multiple images
     */
    function initGalleryUploader() {
        let galleryUploader;

        $('#gc_add_large_image_btn').on('click', function(e) {
            e.preventDefault();

            // If the uploader already exists, reopen it
            if (galleryUploader) {
                galleryUploader.open();
                return;
            }

            // Create a new media uploader
            galleryUploader = wp.media({
                title: 'Select or Upload Images',
                button: {
                    text: 'Add Images'
                },
                multiple: true
            });

            // When images are selected
            galleryUploader.on('select', function() {
                const attachments = galleryUploader.state().get('selection').toJSON();
                
                attachments.forEach(function(attachment) {
                    // Create gallery item HTML
                    const galleryItem = `
                        <div class="gc-gallery-item">
                            <img src="${attachment.url}" style="max-width:100px;">
                            <input type="hidden" name="gc_cs_large_image[]" value="${attachment.url}">
                            <button type="button" class="button button-small gc-remove-gallery-image">Remove</button>
                        </div>
                    `;
                    
                    // Append to container
                    $('#gc_large_images_container').append(galleryItem);
                });
            });

            // Open the uploader
            galleryUploader.open();
        });
    }

    /**
     * Layout Toggle
     */
    function initLayoutToggle() {
        $('#gc_cs_use_extended_layout').on('change', function() {
            if ($(this).is(':checked')) {
                $('#gc_extended_fields').addClass('active');
                $('#gc_box_fields').addClass('hidden');
            } else {
                $('#gc_extended_fields').removeClass('active');
                $('#gc_box_fields').removeClass('hidden');
            }
        });
    }

    /**
     * Remove Single Image
     */
    function initImageRemoval() {
        $(document).on('click', '.gc-remove-single-image', function(e) {
            e.preventDefault();
            
            const button = $(this);
            const targetInput = button.data('target');
            const targetPreview = button.data('preview');
            
            // Clear the input value
            $('#' + targetInput).val('');
            
            // Hide the preview
            $('#' + targetPreview).hide().attr('src', '');
            
            // Hide the remove button
            button.hide();
        });
    }

    /**
     * Remove Gallery Image
     */
    function initGalleryImageRemoval() {
        $(document).on('click', '.gc-remove-gallery-image', function(e) {
            e.preventDefault();
            $(this).closest('.gc-gallery-item').fadeOut(300, function() {
                $(this).remove();
            });
        });
    }

})(jQuery);