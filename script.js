    function openPage(evt, pageName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(pageName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    document.getElementById("defaultOpen").click();

    function uploadImage() {
        const fileInput = document.getElementById('imageInput');
        const file = fileInput.files[0];

        if (!file) {
            iziToast.error({ title: 'Error', message: 'Please select an image to upload' });
            return;
        }

        if (!['image/jpeg', 'image/png'].includes(file.type)) {
            iziToast.error({ title: 'Error', message: 'Only JPEG and PNG images are allowed' });
            return;
        }

        if (file.size > 2 * 1024 * 1024) { // 2MB
            iziToast.error({ title: 'Error', message: 'File size must be less than 2MB' });
            return;
        }

        const formData = new FormData();
        formData.append('image', file);

        fetch('upload.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                iziToast.success({ title: 'Success', message: 'Image uploaded successfully' });
                document.getElementById('imagePreview').src = data.url;
            } else {
                iziToast.error({ title: 'Error', message: data.message });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            iziToast.error({ title: 'Error', message: 'An error occurred during the upload' });
        });
    }

    document.getElementById('dataForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(event.target);

        fetch('submit.php', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                iziToast.success({ title: 'Success', message: 'Form submitted successfully' });
                document.getElementById('displayName').innerText = 'Name: ' + formData.get('name');
                document.getElementById('displayPrice').innerText = 'Price: ' + formData.get('price');
            } else {
                iziToast.error({ title: 'Error', message: data.message });
            }
        })
        .catch(error => {
            console.error('Error:', error);
            iziToast.error({ title: 'Error', message: 'An error occurred during form submission' });
        });
    });
	
	
	
function fetchData(page) {
    fetch('fetch_data.php?page=' + page)
        .then(response => response.json())
        .then(data => {
            const tableBody = document.getElementById('productTableBody');
            tableBody.innerHTML = '';

            if (data.length > 0) {
                data.forEach(product => {
                    const row = document.createElement('tr');
                    row.innerHTML = `<td>${product.id}</td><td>${product.name}</td><td>${product.price}</td>`;
                    tableBody.appendChild(row);
                });
            } else {
                const row = document.createElement('tr');
                row.innerHTML = '<td colspan="3">No products found</td>';
                tableBody.appendChild(row);
            }
        })
        .catch(error => console.error('Error fetching data:', error));
}

function prevPage() {
    currentPage--;
    if (currentPage < 1) {
        currentPage = 1;
    }
    fetchData(currentPage);
}

function nextPage() {
    currentPage++;
    fetchData(currentPage);
}

let currentPage = 1;
fetchData(currentPage); 
