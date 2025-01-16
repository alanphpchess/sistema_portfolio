
const uppy = Uppy.Core({
    autoProceed: false,
    restrictions: {
        allowedFileTypes: ['image/*']
      },
})
uppy.use(Uppy.Dashboard, {
    target: '#upload_img_principal',
    inline: true,
    height: 100, // Altura desejada
    width: 600, // Largura desejada
})


const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
uppy.setMeta({
    _token: csrfToken
});
var baseURL = window.location.origin;

// UPLOAD DE ARQUIVO
uppy.use(Uppy.XHRUpload, {
    endpoint: baseURL + "/admin/clientes/upload_img/" + $("#id_cliente").data("target"),
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    formData: true,
    fieldName: "files",
    multiple: true,
    locale: {
        strings: {
            dropHereOr: 'Solte seus arquivos aqui ou %{browse}',
            browse: 'selecione-os',
            dropFilesTitle: 'Arraste os arquivos para cá',
            // Aqui você pode personalizar o texto do título
        }
    }
})
// EVENTO ACIONA QUANDO É COMPLETADO TUDO
uppy.on('complete', (result) => {
    if (result.successful.length > 0) {

    }
});




const uppy_img_principal = Uppy.Core({
    autoProceed: false,
    restrictions: {
        allowedFileTypes: ['image/*'],
        maxNumberOfFiles: 1
      },
})
uppy_img_principal.use(Uppy.Dashboard, {
    target: '#upload_img',
    inline: true,
    height: 100, // Altura desejada
    width: 600, // Largura desejada
})

const csrfToken_2 = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
uppy_img_principal.setMeta({
    _token: csrfToken_2
});
var baseURL = window.location.origin;

// UPLOAD DE ARQUIVO
uppy_img_principal.use(Uppy.XHRUpload, {
    endpoint: baseURL + "/admin/clientes/upload_img_principal/" + $("#id_cliente").data("target"),
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content")
    },
    formData: true,
    fieldName: "files",
    multiple: false,
    locale: {
        strings: {
            dropHereOr: 'Solte seus arquivos aqui ou %{browse}',
            browse: 'selecione-os',
            dropFilesTitle: 'Arraste os arquivos para cá',
            // Aqui você pode personalizar o texto do título
        }
    }
})
// EVENTO ACIONA QUANDO É COMPLETADO TUDO
uppy_img_principal.on('complete', (result) => {
    if (result.successful.length > 0) {

    }
});