// jQuery(document).ready(function($){
//     var mediaUploader;

//     // Single image upload
//     $('.gc-upload-btn').click(function(e){
//         e.preventDefault();
//         var button = $(this);
//         var targetInput = $('#' + button.data('target'));
//         var previewImg = $('#' + button.data('preview'));

//         mediaUploader = wp.media.frames.file_frame = wp.media({
//             title: 'Choose Image',
//             button: { text: 'Choose Image' },
//             multiple: false
//         });

//         mediaUploader.on('select', function(){
//             var attachment = mediaUploader.state().get('selection').first().toJSON();
//             targetInput.val(attachment.url);
//             previewImg.attr('src', attachment.url);
//         });

//         mediaUploader.open();
//     });

//     // Gallery upload
//     $('#gc_add_large_image_btn').click(function(e){
//         e.preventDefault();
//         var galleryUploader = wp.media.frames.file_frame = wp.media({
//             title: 'Select Images',
//             button: { text: 'Add to Gallery' },
//             multiple: true
//         });

//         galleryUploader.on('select', function(){
//             var selection = galleryUploader.state().get('selection');
//             selection.map(function(attachment){
//                 attachment = attachment.toJSON();
//                 $('#gc_large_images_container').append(
//                     '<div class="gc-large-image-item" style="margin-bottom:5px;">'+
//                     '<img src="'+attachment.url+'" style="max-width:150px; display:block; margin-bottom:2px;">'+
//                     '<input type="hidden" name="gc_cs_large_image[]" value="'+attachment.url+'">'+
//                     '<button class="button gc-remove-image-btn">Remove</button>'+
//                     '</div>'
//                 );
//             });
//         });

//         galleryUploader.open();
//     });

//     // Remove image
//     $(document).on('click', '.gc-remove-image-btn', function(e){
//         e.preventDefault();
//         $(this).closest('.gc-large-image-item').remove();
//     });
// });
