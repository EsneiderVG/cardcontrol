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
<div class="container_card_history_table change_pc_set">
    <div class="table_contenedor_box_2 mar-bot">
        <h2>Agrega Alumno</h2>
        <div class="ray_letter"></div>
        <div class="container_pri_part">

            <div class="three_inputs_sec">
                <div class="input-container">
                    <input id="usuario_s" class="input" type="text" pattern=".+" required />
                    <label class="label" for="usuario_s">Usuario</label>
                </div>
                <div class="input-container">
                    <input id="nombres" class="input" type="text" pattern=".+" required />
                    <label class="label" for="nombres">nombres</label>
                </div>
                <div class="input-container">
                    <input id="email" class="input" type="text" pattern=".+" required />
                    <label class="label" for="email">Correo electronica</label>
                </div>
            </div>
            <div class="three_inputs_sec">
                <div class="input-container">
                    <input id="contraseña" class="input" type="text" pattern=".+" required />
                    <label class="label" for="contraseña">contraseña</label>
                </div>
                <div class="input-container">
                    <input id="contraseña_confirm_2" class="input" type="text" pattern=".+" required />
                    <label class="label" for="contraseña_confirm_2">contraseña_confirm</label>
                </div>

            </div>
            <div class="three_inputs_sec">

                <!-- <main> -->
                <div class="input-container">
                    <select name="admin" id="admin">
                        <option value="0">No admin</option>
                        <option value="1">Admin</option>
                    </select>
                </div>
                <div class="input-container">
                    <select name="user_inv" id="user_inv">
                        <option value="0">No invitado</option>
                        <option value="1">invitado</option>
                    </select>
                </div>
                <div class="input-container">
                    <!-- <main> -->
                    <form id="img_perfil" method="post" enctype="multipart/form-data">
                        <div id="app" @dragover.prevent @drop.prevent>
                            <div class="container" @dragleave="fileDragOut" @dragover="fileDragIn" @drop="handleFileDrop" @drop="fileDragOut">
                                <div class="file-wrapper">
                                    <input id="foto_user" type="file" name="file-input" multiple="True" @change="handleFileInput"><span class="pointer_tt"> cargar foto <i class="fa-solid fa-upload"></i></span>
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

        </div>

        <button class="btn_filter_history" style="width:100%;" onclick="subir_datos_alumno()">Subir Usuario</button>

    </div>

</div>
</div>