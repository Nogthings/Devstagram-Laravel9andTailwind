import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
   dictDefaultMessage: 'Draw youre image',
   acceptedFiles: ".png,.jpg,.jpeg,.gif",
   addRemoveLinks: true,
   dictRemoveFile: 'Delete File',
   maxFiles: 1,
   uploadMultiple: false,

   init: function(){
      if(document.querySelector('[name="image"]').value.trim()){
         const imgCache = {}
         imgCache.size = 1234;
         imgCache.name = document.querySelector('[name="image"]').value;
         this.options.addedfile.call(this, imgCache);
         this.options.thumbnail.call(this, imgCache, `/uploads/${imgCache.name}`);
         imgCache.previewElement.classList.add('dz-success', 'dz-complete');
      }
   }
});

dropzone.on("success", function(file, response){
   document.querySelector('[name="image"]').value = response.image;
});

dropzone.on("removedfile", function(){
   document.querySelector('[name="image"]').value ="";
});