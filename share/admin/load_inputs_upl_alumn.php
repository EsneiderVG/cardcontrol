<script>
    var app = new Vue({
        el: '#app',
        data: {
            files: [],
            color: '#444444',
        },
        methods: {
            handleFileDrop(e) {
                let droppedFiles = e.dataTransfer.files;
                if (!droppedFiles) return;
                // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
                ([...droppedFiles]).forEach(f => {

                    this.files.push(f);
                });
                this.color = "#444444"
            },
            handleFileInput(e) {
                let files = e.target.files;
                files = e.target.files
                if (!files) return;
                // this tip, convert FileList to array, credit: https://www.smashingmagazine.com/2018/01/drag-drop-file-uploader-vanilla-js/
                ([...files]).forEach(f => {

                    this.files.push(f);
                });
            },
            removeFile(fileKey) {
                this.files.splice(fileKey, 1)
            },
            fileDragIn() {
                // alert("oof")
                // alert("color")
                this.color = "white"
            },
            fileDragOut() {
                this.color = "#444444"
            }
        }
    })
</script>
<div class="content_form_container">
    <h2>Agrega Alumno</h2>
    <div class="ray_letter"></div>
    <div class="container_pri_part">

        <div class="three_inputs_sec">
            <div class="input-container">
                <input id="nombres" class="input" type="text" pattern=".+" required />
                <label class="label" for="nombres">Nombres</label>
            </div>
            <div class="input-container">
                <input id="apellidos" class="input" type="text" pattern=".+" required />
                <label class="label" for="apellidos">Apellidos</label>
            </div>
            <div class="input-container">
                <input id="id" class="input" type="text" pattern=".+"  />
                <label class="label" for="id">TI o CC</label>
            </div>
        </div>
        <div class="three_inputs_sec">
            <div class="input-container">
                <input id="estado" class="input" type="text" pattern=".+" required />
                <label class="label" for="estado">estado</label>
            </div>
            <div class="input-container">
                <input id="barrio" class="input" type="text" pattern=".+"  />
                <label class="label" for="barrio">barrio</label>
            </div>
            <div class="input-container">
                <input id="direccion" class="input" type="text" pattern=".+"  />
                <label class="label" for="direccion">direccion</label>
            </div>
        </div>
        <div class="three_inputs_sec">
            <div class="input-container">
                <input id="ciudad" class="input" type="text" pattern=".+"  />
                <label class="label" for="ciudad">ciudad</label>
            </div>
            <div class="input-container">
                <input id="telefono" class="input" type="text" pattern=".+"  />
                <label class="label" for="telefono">telefono</label>
            </div>
            <div class="input-container">
                <input id="correo" class="input" type="text" pattern=".+" />
                <label class="label" for="correo">correo</label>
            </div>
        </div>
        <div class="two_inputs_sec">
            <div class="input-container">
                <input id="instituto" class="input" type="text" pattern=".+" required />
                <label class="label" for="instituto">instituto</label>
            </div>
            <div class="input-container">
                <input id="sede" class="input" type="text" pattern=".+" required />
                <label class="label" for="sede">sede</label>
            </div>
        </div>
        <div class="two_inputs_sec">
            <div class="input-container">
                <input id="grado" class="input" type="text" pattern=".+" required />
                <label class="label" for="grado">grado</label>
            </div>
            <div class="input-container">
                <input id="jornada" class="input" type="text" pattern=".+" required />
                <label class="label" for="jornada">jornada</label>
            </div>
        </div>
        <div class="two_inputs_sec">
            <div class="input-container">
                <input id="cod_estudiante" class="input" type="text" pattern=".+" required />
                <label class="label" for="cod_estudiante"><i class="fa-solid fa-caret-right"></i>codº estudiante</label>
            </div>
            <div class="input-container">
                <!-- <main> -->
                <form id="img_perfil" method="post" enctype="multipart/form-data">
                    <div id="app" @dragover.prevent @drop.prevent>
                        <div class="container" @dragleave="fileDragOut" @dragover="fileDragIn" @drop="handleFileDrop" @drop="fileDragOut">
                            <div class="file-wrapper">
                                <input id="foto_alumn" type="file" name="file-input" multiple="True" @change="handleFileInput"><span class="pointer_tt"> cargar foto <i class="fa-solid fa-upload"></i></span>
                            </div>
                            <div class="name_img">

                                <div v-for="(file, index) in files">
                                    {{ file.name }} ({{ file.size }} b)
                                    <button @click="removeFile(index)" title="Remove">X</button>
                                </div>

                            </div>
                        </div>
                    </div>
                    <!-- </main> -->
            </div>
        </div>
        <button class="btn_filter_history" style="width:100%;" onclick="subir_datos_alumno()">Subir alumno</button>

    </div>
    <!-- <div class="simple_inputs">
                <input type="text" class="text_inp" name="" id="">
            </div>
            <input type="text" class="text_inp" name="" id="">
            <input type="text" class="text_inp" name="" id=""> -->
</div>