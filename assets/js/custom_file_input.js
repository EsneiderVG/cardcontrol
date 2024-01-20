var app = new Vue({
    el: '#app',
    data: {
      files: [],
      color: '#444444',
    },
    methods: {
      handleFileDrop(e) {
        let droppedFiles = e.dataTransfer.files;
        if(!droppedFiles) return;
        // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
        ([...droppedFiles]).forEach(f => {
      
      this.files.push(f);
        });
        this.color="#444444"
      },
      handleFileInput(e) {
        let files = e.target.files;
        files = e.target.files
              if(!files) return;
        // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
        ([...files]).forEach(f => {
      
      this.files.push(f);
        });
      },
      removeFile(fileKey){
        this.files.splice(fileKey, 1)
      },
      fileDragIn(){
        // alert("oof")
        // alert("color")
        this.color="white"
      },
      fileDragOut(){
        this.color="#444444"
      }
    }
  })