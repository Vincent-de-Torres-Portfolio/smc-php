
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>File Upload</title>
    <style>
        #drop_zone {
            border: 2px dashed #ccc;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        #list {
            list-style: none;
            padding: 0;
        }
    </style>
</head>

<main>
    <div class="container">


<form id="uploadForm" action="src/Controls/UploadHandler.php" method="post" enctype="multipart/form-data">
    <label for="destination">Destination:</label>
    <input type="text" id="destination" name="destination" value="Uploads/"><br><br>

    <div id="drop_zone">Drop files here</div>
    <input type="file" id="fileInput" name="files[]" multiple><br><br>

    <ul id="list"></ul>

    <p id="fileCount">No files selected.</p>

    <input type="submit" value="Submit">
</form>
    </div>
</main>

<script>
    var filesToUpload = [];

    function formatFileSize(bytes) {
        var sizes = ['Bytes', 'KB', 'MB', 'GB', 'TB'];
        if (bytes == 0) return '0 Byte';
        var i = parseInt(Math.floor(Math.log(bytes) / Math.log(1024)));
        return Math.round(bytes / Math.pow(1024, i), 2) + ' ' + sizes[i];
    }

    function handleFileSelect(evt) {
        evt.stopPropagation();
        evt.preventDefault();

        var files = evt.dataTransfer ? evt.dataTransfer.files : evt.target.files; // FileList object.

        // files is a FileList of File objects. List some properties.
        for (var i = 0, f; f = files[i]; i++) {
            filesToUpload.push(f);

            var output = document.getElementById('list');
            var listItem = document.createElement('li');
            var input = document.createElement('input');
            input.type = 'text';
            input.placeholder = f.name;
            input.defaultValue = f.name;
            listItem.appendChild(input);
            listItem.innerHTML += ' (' + formatFileSize(f.size) + ')';
            var deleteButton = document.createElement('button');
            deleteButton.textContent = 'Delete';
            deleteButton.addEventListener('click', (function (file) {
                return function (e) {
                    e.preventDefault();
                    var index = filesToUpload.indexOf(file);
                    if (index > -1) {
                        filesToUpload.splice(index, 1);
                    }
                    listItem.parentNode.removeChild(listItem);
                    document.getElementById('fileCount').textContent = filesToUpload.length + ' file(s) selected.';
                };
            })(f));
            listItem.appendChild(deleteButton);
            output.appendChild(listItem);
        }

        document.getElementById('fileCount').textContent = filesToUpload.length + ' file(s) selected.';
    }

    function handleDragOver(evt) {
        evt.stopPropagation();
        evt.preventDefault();
        evt.dataTransfer.dropEffect = 'copy'; // Explicitly show this is a copy.
    }

    // Setup the dnd listeners.
    var dropZone = document.getElementById('drop_zone');
    dropZone.addEventListener('dragover', handleDragOver, false);
    dropZone.addEventListener('drop', handleFileSelect, false);
    dropZone.addEventListener('click', function () {
        document.getElementById('fileInput').click();
    }, false);

    var fileInput = document.getElementById('fileInput');
    fileInput.addEventListener('change', handleFileSelect, false);

    var uploadForm = document.getElementById('uploadForm');
    uploadForm.addEventListener('submit', function (event) {
        // Prevent default form submission
        event.preventDefault();

        // Create a FormData object and append files to it
        var formData = new FormData();
        for (var i = 0; i < filesToUpload.length; i++) {
            formData.append('files[]', filesToUpload[i]);
        }

        // Append destination to FormData
        formData.append('destination', document.getElementById('destination').value);

        // Create a new XMLHttpRequest object
        var xhr = new XMLHttpRequest();
        xhr.open('POST', this.action, true);

        // Define the onload function
        xhr.onload = function () {
            if (xhr.status === 200) {
                console.log(xhr.responseText);
                // Handle success
                alert('Upload successful!');
                // Optionally reset form after successful upload
                uploadForm.reset();
            } else {
                console.error('Error uploading files: ' + xhr.status);
                // Handle failure
                alert('Upload failed!');
            }
        };

        // Send the FormData
        xhr.send(formData);
    }, false);
</script>
