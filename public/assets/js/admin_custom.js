/** Preview images before form submit */

let filesInput = document.querySelector('.files-input');
if(filesInput) {
	filesInput.addEventListener('change', handleFilePreview);
}

function handleFilePreview(e, files) {
	let target = e.target;
	files = target.files;
	let previewContainer = target.parentNode.querySelector('#input-preview');
	var imageType = /^image\//;
	for (var i = 0; i < files.length; i++) {
		var file = files[i];
		if (!imageType.test(file.type)) {
			alert("Veuillez sélectionner une image");
		}
		else{
			if(i == 0){
				previewContainer.innerHTML = '';
			}
			var img = document.createElement("img");
			img.classList.add("obj");
			img.file = file;
			previewContainer.appendChild(img);
			var reader = new FileReader();
			reader.onload = ( function(aImg) { 
			return function(e) { 
			aImg.src = e.target.result; 
			}; 
		})(img);

		reader.readAsDataURL(file);
		}

	}
}


// MULTIPLE SELECT FORM
$(document).ready(function() {
$('.basic-multiple-select').select2();
});

// WYSIWYG wysibb
// $(document).ready(function() {
// 	$(function() {
// 		$("#editor").wysibb();
// 	})
// });

//WYSIWYG TinyMCE
tinymce.init({
	selector: '#mytextarea'
});