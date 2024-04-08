document.addEventListener('DOMContentLoaded', function () {
    const dropArea = document.getElementById('dropArea');
    const fileUploadForm = document.getElementById('fileUploadForm');
    const table = document.getElementById('displayTable');

    function unhighlight() {
        dropArea.classList.remove('dragover');
    }


    document.getElementById('file').addEventListener('change', function (event) {
        const files = event.target.files;

        // Ensure that the selected files are not null or undefined
        if (files && files.length > 0) {
            handleFiles(files);
        }
    });
    function handleFiles(files) {
        // Iterate over the files using a for loop
        for (let i = 0; i < files.length; i++) {
            const file = files[i];
            const row = table.insertRow();

            // Create cells and populate them with file information
            const cell1 = row.insertCell(0);
            const inputFileName = document.createElement("input");
            inputFileName.type = "text";
            inputFileName.value = file.name;
            cell1.appendChild(inputFileName);

            const cell2 = row.insertCell(1);
            cell2.innerHTML = formatBytes(file.size);

            const cell3 = row.insertCell(2);
            cell3.innerHTML = file.type;

            const cell4 = row.insertCell(3);
            const removeButton = document.createElement("button");
            removeButton.textContent = "Remove";
            removeButton.addEventListener("click", function () {
                table.deleteRow(row.rowIndex);
            });
            cell4.appendChild(removeButton);

            // Append the file to the FormData
            fileUploadForm.append('file[]', file);
        }
    }

    function formatBytes(bytes, decimals = 2) {
        if (bytes === 0) return '0 Bytes';

        const k = 1024;
        const dm = decimals < 0 ? 0 : decimals;
        const sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB', 'PB', 'EB', 'ZB', 'YB'];

        const i = Math.floor(Math.log(bytes) / Math.log(k));

        return parseFloat((bytes / Math.pow(k, i)).toFixed(dm)) + ' ' + sizes[i];
    }

    fileUploadForm.addEventListener('submit', function (event) {
        event.preventDefault();

        const formData = new FormData(this);

        // Display form data for testing (remove this in production)
        for (const pair of formData.entries()) {
            console.log(pair[0] + ': ' + pair[1]);
        }

        $.ajax({
            type: 'POST',
            url: 'includes/UploadHandler.php',
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                console.log(response);
                alert('Files successfully uploaded!');
                // Clear the form and table after successful submission
                fileUploadForm.reset();
                table.innerHTML = '';
            },
            error: function (error) {
                console.log(error);
                alert('Error uploading files.');
            }
        });
    });
});