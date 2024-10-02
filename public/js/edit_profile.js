const inputImage = document.getElementById('inputImage');
const previewImage = document.getElementById('previewImage');

inputImage.addEventListener('change', function () {
  const file = this.files[0];
  const reader = new FileReader();

  reader.onload = function (e) {
    previewImage.src = e.target.result;
  }

  if (file) {
    reader.readAsDataURL(file);
  }
});