<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/7.2.1/tinymce.min.js"></script>
<script src="https://unpkg.com/axios/dist/axios.min.js"></script>

<script>
  tinymce.init({
    selector: 'textarea#content',
    height: 600,
    plugins: [
      'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
      'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
      'insertdatetime', 'media', 'table', 'help', 'wordcount'
    ],
    toolbar: 'undo redo | blocks | ' +
      'bold italic backcolor | alignleft aligncenter ' +
      'alignright alignjustify | bullist numlist outdent indent | ' +
      'removeformat | help',
    content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:16px }'
  });
</script>
<script>
  let currentImage = null;

  function saveCurrentImage() {
    const fileInput = document.querySelector('#main_image');
    if (fileInput.files[0]) {
      currentImage = fileInput.files[0];
    }
  }

  function handleFileChange() {
    const fileInput = document.querySelector('#main_image');
    const previewMainImage = document.querySelector('#main_image_preview');
    const file = fileInput.files[0];

    if (!file && currentImage) {
      // No new file selected, restore the previous file
      fileInput.files = new DataTransfer().files;
      const dataTransfer = new DataTransfer();
      dataTransfer.items.add(currentImage);
      fileInput.files = dataTransfer.files;
      previewMainImage.src = URL.createObjectURL(currentImage);
      return;
    }

    const reader = new FileReader();
    reader.addEventListener("load", function() {
      previewMainImage.src = reader.result;
    }, false);

    if (file) {
      reader.readAsDataURL(file);
    }
  }
</script>
<script>
  let selectedFiles = [];

  function handleFiles(files) {
    selectedFiles = Array.from(files);
    previewFiles();
  }

  function previewFiles() {
    const previewContainer = document.querySelector('#image_preview_container');
    previewContainer.innerHTML = ''; // Clear existing previews

    selectedFiles.forEach((file, index) => {
      const reader = new FileReader();
      reader.onload = function(event) {
        const imgContainer = document.createElement('div');
        imgContainer.className = 'image-container';

        const img = document.createElement('img');
        img.src = event.target.result;

        const removeButton = document.createElement('button');
        removeButton.className = 'remove-button';
        removeButton.innerHTML = '<i class="fas fa-times-circle" style="color: #dd0000;"></i>';
        removeButton.onclick = function() {
          removeImage(index);
        };

        imgContainer.appendChild(img);
        imgContainer.appendChild(removeButton);
        previewContainer.appendChild(imgContainer);
      }
      reader.readAsDataURL(file);
    });
  }

  function removeImage(index) {
    selectedFiles.splice(index, 1);
    updateFileInput();
    previewFiles(); // Re-render the previews
  }

  function updateFileInput() {
    const dataTransfer = new DataTransfer();
    selectedFiles.forEach(file => dataTransfer.items.add(file));
    document.querySelector('#images').files = dataTransfer.files;

  }
</script>