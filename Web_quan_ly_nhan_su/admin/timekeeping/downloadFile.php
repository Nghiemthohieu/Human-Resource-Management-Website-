<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PDF Upload</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .drag-area {
            transition: background-color 0.3s, border-color 0.3s;
        }
        .drag-area.dragover {
            background-color: rgba(255, 255, 255, 0.1);
            border-color: #ffffff;
        }
        .file-info {
            display: flex;
            align-items: center;
            margin-top: 1rem;
        }
        .file-info img {
            width: 50px;
            height: 50px;
            margin-right: 1rem;
        }
    </style>
</head>
<body class="bg-blue-400">
    <div class="flex h-screen w-full items-center justify-center">
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <div class="drag-area text-white w-full lg:w-96 rounded-3xl border-4 border-dashed border-neutral-5 p-6 flex flex-col items-center justify-center">
                <header class="text-lg" id="dragText">Kéo và thả để tải file lên</header>
                <span class="my-3 text-sm" id="span">Hoặc</span>
                <button type="button" class="px-4 py-2 rounded bg-neutral-100 text-blue-600" id="uploadButton">Chọn file</button>
                <input type="file" hidden id="fileInput" name="pdfFile">
                <div class="file-info hidden" id="fileInfo">
                    <img src="https://play-lh.googleusercontent.com/DynUYgOThKVnORSvd0ZN2_29QcuWSo3YnbtBYbq49MM3MXol11uXERTIURFdOJ_PdA" alt="PDF Icon">
                    <span id="fileName"></span>
                </div>
                <button type="submit" class="px-4 py-2 rounded bg-neutral-100 text-blue-600 mt-4 hidden" id="savePdfButton">Lưu file PDF</button>
            </div>
        </form>
    </div>

    <script>
        const dropArea = document.querySelector('.drag-area');
        const dragText = document.getElementById('dragText');
        const button = document.getElementById('uploadButton');
        const span = document.getElementById('span')
        const input = document.getElementById('fileInput');
        const fileInfo = document.getElementById('fileInfo');
        const fileNameElement = document.getElementById('fileName');
        const savePdfButton = document.getElementById('savePdfButton');

        button.addEventListener('click', () => {
            input.click();
        });

        input.addEventListener('change', function() {
            const file = this.files[0];
            showFile(file);
        });

        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('dragover');
            dragText.textContent = "Thả để tải PDF lên";
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('dragover');
            dragText.textContent = "Kéo và thả để tải file lên";
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('dragover');
            const file = event.dataTransfer.files[0];
            input.files = event.dataTransfer.files; // Cập nhật input để form có thể gửi file này
            showFile(file);
        });

        function showFile(file) {
            let fileType = file.type;
            let validExtensions = ['application/pdf'];
            if (validExtensions.includes(fileType)) {
                fileNameElement.textContent = file.name;
                fileInfo.classList.remove('hidden');
                savePdfButton.classList.remove('hidden');
                dragText.style.display = 'none'; // Ẩn đi thông báo "Kéo và thả để tải file lên"
                button.style.display='none';
                span.style.display='none';
                
            } else {
                alert("Đây không phải là file PDF");
                dragText.textContent = "Kéo và thả để tải file lên";
            }
        }
    </script>
</body>
</html>
