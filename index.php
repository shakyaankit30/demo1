<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assignment </title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/izitoast/dist/css/iziToast.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <button class="tablinks" onclick="openPage(event, 'ImageUpload')" id="defaultOpen">Image Upload</button>
    <button class="tablinks" onclick="openPage(event, 'Form')">Form</button>
    <button class="tablinks" onclick="openPage(event, 'ShowData')">Show Data</button>
</div>

<div class="content">
    <h2>Image Upload and Form</h2>


	<div class="tabcontent" id="ImageUpload">
		<h3>Upload an Image</h3>
		<div class="upload-container">
			<input type="file" id="imageInput" accept="image/jpeg, image/png">
			<button onclick="uploadImage()" class="upload-btn">Upload Image</button>
		</div>
		<img id="imagePreview" class="image-preview" src="No_Image_Available.jpg" alt="Image Preview">
	</div>
	
	
    <div id="Form" class="tabcontent">
        <h3>Input Form</h3>
        <form id="dataForm">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required><br><br>
            <input type="submit" value="Submit">
        </form>
        <div id="formData">
            <h3>Form Data</h3>
            <p id="displayName"></p>
            <p id="displayPrice"></p>
        </div>
    </div>
    <!-- Show Data Tab -->
<div id="ShowData" class="tabcontent">
    <h3>Submitted Form Data</h3>
    <div class="table-container">
        <table id="formDataTable">
            <thead>
                <tr>
					<th>#</th>
                    <th>Name</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody id="productTableBody">
            </tbody>
        </table>
        <div class="pagination">
            <button onclick="prevPage()">Previous</button>
            <span id="currentPage">1</span>
            <button onclick="nextPage()">Next</button>
        </div>
    </div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/izitoast/dist/js/iziToast.min.js"></script>
<script src="script.js"></script>

</body>
</html>
