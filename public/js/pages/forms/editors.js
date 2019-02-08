$(function () {
    //CKEditor
    var editor = CKEDITOR.instances['short_description'];
    if (editor) { editor.destroy(true); }
    CKEDITOR.replace('short_description');
    CKEDITOR.config.height = 300;
    CKEDITOR.config.extraPlugins = 'youtube';

    //CKEditor 2
    var editor = CKEDITOR.instances['description'];
    if (editor) { editor.destroy(true); }
    CKEDITOR.replace('description');
    CKEDITOR.config.height = 300;

    //TinyMCE
    tinymce.init({
        selector: "textarea#tinymce",
        theme: "modern",
        height: 300,
        plugins: [
            'advlist autolink lists link image charmap print preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars code fullscreen',
            'insertdatetime media nonbreaking save table contextmenu directionality',
            'emoticons template paste textcolor colorpicker textpattern imagetools'
        ],
        toolbar1: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
        toolbar2: 'print preview media | forecolor backcolor emoticons',
        image_advtab: true
    });
    tinymce.suffix = ".min";
    tinyMCE.baseURL = '../../plugins/tinymce';
});