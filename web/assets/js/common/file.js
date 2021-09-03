function fileValidation(
    allowedExtensionsRegex,
    fileInput,
    label,
    callback,
    errorCallback
) {
    var filePath = fileInput.value;
    if (!allowedExtensionsRegex.exec(filePath)) {
        showAlert('error', 'El archivo no es válido');
        fileInput.value = '';
        if (errorCallback != undefined) {
            errorCallback();
        }
        label.innerHTML = 'Seleccione su archivo';
        return false;
    } else {
        if (callback != undefined) {
            label.innerHTML = fileInput.files[0].name;
            fileInput.disabled = false;
            callback();
        }
    }
}

function clearFileInput(fileInput, label) {
    fileInput.value = '';
    label.innerHTML = 'Seleccione su archivo';
}
