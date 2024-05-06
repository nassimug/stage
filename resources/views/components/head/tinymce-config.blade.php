<script src="https://cdn.tiny.cloud/1/mddix0jds8oq1ehvyeold9hccs97c40sght5mk74bwzy8xai/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>
<script>
tinymce.init({
  selector: 'textarea#myeditorinstance', // Utiliser votre sélecteur existant
  plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount checklist mediaembed casechange export formatpainter pageembed preview linkchecker a11ychecker tinymcespellchecker permanentpen powerpaste advtable advcode editimage advtemplate mentions tinycomments tableofcontents footnotes mergetags autocorrect typography inlinecss markdown',
  toolbar: 'undo redo | blocks fontfamily fontsize | bold italic underline strikethrough | link image media table mergetags | addcomment showcomments | spellcheckdialog a11ycheck typography | align lineheight | checklist numlist bullist indent outdent | emoticons charmap | removeformat',
  height: 300, // Ajustez selon vos besoins
  setup: function(editor) {
    editor.on('init', function() {
      // Surcharge la fonction de notification pour bloquer toutes les notifications
      editor.notificationManager.open = function () { return false; };
    });
  },
  tinycomments_mode: 'embedded',
  tinycomments_author: 'Author name',
  mergetags_list: [
    { value: 'First.Name', title: 'First Name' },
    { value: 'Email', title: 'Email' },
  ],
  ai_request: (request, respondWith) => respondWith.string(() => Promise.reject("See docs to implement AI Assistant")),
  image_title: true, 
  automatic_uploads: true,
  file_picker_types: 'file image media',
  

  file_picker_callback: function(cb, value, meta) {
    var input = document.createElement('input');
    if (meta.filetype === 'image') {
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'image/*');
    } else if (meta.filetype === 'media') {
      input.setAttribute('type', 'file');
      input.setAttribute('accept', 'video/*');
    } else {
      input.setAttribute('type', 'file');
      input.setAttribute('accept', '*/*');
    }

    input.onchange = function() {
      var file = this.files[0];
      var reader = new FileReader();
      reader.onload = function () {
        var id = 'blobid' + (new Date()).getTime();
        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
        var base64 = reader.result.split(',')[1];
        var blobInfo = blobCache.create(id, file, base64);
        blobCache.add(blobInfo);

        // Pour les images et vidéos, utilisez blobInfo.blobUri() comme source
        // Pour d'autres fichiers, vous pourriez vouloir uploader le fichier à votre serveur d'abord et ensuite insérer un lien vers celui-ci
        cb(blobInfo.blobUri(), { title: file.name });
      };
      reader.readAsDataURL(file);
    };
    
    
    input.click();
  }
  
  
});
</script>
