<div class="quill-editor-default ql-container ql-snow" style="height:300px;">
    <div class="ql-editor" id="ql-editor" data-gramm="false" contenteditable="true"></div>
    <div class="ql-tooltip ql-hidden"><a class="ql-preview" rel="noopener noreferrer" target="_blank" href="about:blank"></a>
    <input type="text" name="evolucao" data-formula="e=mc^2" data-link="https://quilljs.com" data-video="Embed URL">
    <a class="ql-action"></a><a class="ql-remove"></a>
    </div>
</div>

<script>
    function enviarForm(){
        let texto = document.querySelector('.ql-editor').innerHTML;
        let input = document.querySelector('#input');

        if(texto == '<p><br></p>'){
            Swal.fire("Verifique se todos os campos estão preenchidos.")
        }else{
            input.value = texto;
            document.querySelector('#form').submit();
        }
    }
</script>