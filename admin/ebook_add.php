<?php 
include('authentication.php');
include('includes/header.php'); 
include('./includes/sidebar.php'); 
?>
<main id="main" class="main">
     <div class="pagetitle">
          <h1>Add Book</h1>
          <nav>
               <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href=".">Home</a></li>
                    <li class="breadcrumb-item"><a href="books.php">Ebooks</a></li>
                    <li class="breadcrumb-item active">Add Book</li>
               </ol>
          </nav>
     </div>
     <section class="section">
          <div class="row">
               <div class="col-lg-12">
                    <div class="card">
                         <div class="card-header d-flex justify-content-end">

                         </div>
                         <div class="card-body">

                              <form action="ebooks_code.php" method="POST" enctype="multipart/form-data">

                                   <div class="row d-flex justify-content-center mt-4">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Title</label>
                                                  <input type="text" id="title" name="title" class="form-control" required>
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Author</label>
                                                  <input type="text" id="author" name="author" class="form-control" required>
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Copyright Date</label>
                                                  <input type="text" id="copyright_date" name="copyright_date" class="form-control"
                                                       required>
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Publisher</label>
                                                  <input type="text" id="publisher" name="publisher" class="form-control" required>
                                             </div>
                                        </div>

                                   </div>

                                   <div class="row d-flex justify-content-center">

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <label for="">Book File</label>
                                                  <input type="file" id="book_file" name="ebook" accept=".pdf" class="form-control" required>
                                             </div>
                                        </div>

                                        <div class="col-12 col-md-5">
                                             <div class="mb-3 mt-2">
                                                  <div class="d-flex justify-content-between">
                                                       <label for="">Book Image</label>
                                                       <span class=" text-muted"><small>(Optional)</small></span>
                                                  </div>
                                                  <input type="file" name="opac_image" id="book_image_input" class="form-control" required>
                                             </div>
                                        </div>

                                   </div>


                         </div>
                         <div class="card-footer d-flex justify-content-end">
                              <div>
                                   <a href="books.php" class="btn btn-secondary">Cancel</a>
                                   <button type="submit" name="upload_book" class="btn btn-primary">Upload Book</button>
                              </div>
                         </div>
                         </form>
                         <div class="card-footer"></div>

                    </div>
               </div>
          </div>
     </section>
</main>
<script>
     document.getElementById('title').addEventListener('input', function () {
        var titleInput = this.value.trim();
        
        var dangerousCharsPattern = /[<>\"\']/;
        
        if (titleInput === "") {
            this.setCustomValidity('Title name cannot be empty or just spaces.');
        } else if (this.value !== titleInput) {
            this.setCustomValidity('Title name cannot start with a space.');
        } else if (dangerousCharsPattern.test(titleInput)) {
            this.setCustomValidity('Title name cannot contain HTML special characters like <, >, ", \'.');
        } else {
            this.setCustomValidity('');
        }
        
        var isValid = titleInput !== "" && this.value === titleInput && !dangerousCharsPattern.test(titleInput);
        this.classList.toggle('is-invalid', !isValid);
    });

    document.getElementById('author').addEventListener('input', function () {
          var authorInput = this.value.trim();
          
          var alphabetPattern = /^[A-Za-z\s]+$/;
          
          if (this.value !== authorInput) {
               this.setCustomValidity('Name cannot start with a space.');
          } else if (alphabetPattern.test(authorInput)) {
               this.setCustomValidity('');
          } else {
               this.setCustomValidity('Please enter a valid name with only letters and no leading/trailing spaces.');
          }
          
          var isValid = alphabetPattern.test(authorInput) && this.value === authorInput;
          this.classList.toggle('is-invalid', !isValid);
     });

     document.getElementById('copyright_date').addEventListener('input', function () {
     var currentYear = new Date().getFullYear();
     var copyrightYearInput = this.value.trim();
     
     var yearPattern = /^\d{4}$/;

     // Check if the input is a valid 4-digit year
     if (!yearPattern.test(copyrightYearInput)) {
          this.setCustomValidity('Please enter a valid 4-digit year.');
     } 
     // Check if the input year is the current year
     else if (parseInt(copyrightYearInput) === currentYear) {
          this.setCustomValidity('Copyright year cannot be the current year.');
     } 
     // Check if the input year is greater than the current year
     else if (parseInt(copyrightYearInput) > currentYear) {
          this.setCustomValidity('Copyright year cannot be in the future.');
     } 
     // Valid case: a past year
     else {
          this.setCustomValidity('');
     }

     var isValid = yearPattern.test(copyrightYearInput) && parseInt(copyrightYearInput) < currentYear;
     this.classList.toggle('is-invalid', !isValid);
     });

    document.getElementById('pdf_file').addEventListener('change', function () {
     var file = this.files[0]; // Get the selected file

     // Check if a file was selected
     if (file) {
          // Check if the file is a PDF by examining its extension and MIME type
          var isValidPdf = file.type === 'application/pdf' || file.name.toLowerCase().endsWith('.pdf');

          if (!isValidPdf) {
               this.setCustomValidity('Please upload a PDF file.');
          } else {
               this.setCustomValidity(''); // Clear any previous error message
          }

          // Check validity and toggle the invalid class
          this.classList.toggle('is-invalid', !isValidPdf);
     }
     });

    $(document).ready(function() {
     // Restrict input to numeric values only
     $('#copyright_date').on('keypress', function(event) {
          var key = String.fromCharCode(event.which);
          if (!/[0-9]/.test(key)) {
               event.preventDefault();
          }
     });

     // Ensure the year is not greater than the current year
     $('#copyright_date').on('change', function() {
          var inputYear = parseInt($(this).val(), 10);
          var currentYear = new Date().getFullYear();
          if (inputYear > currentYear) {
               Swal.fire({
                    icon: 'warning',
                    title: 'Invalid Year',
                    text: 'Year cannot be greater than the current year.',
                    confirmButtonText: 'OK'
               });
               $(this).val(''); // Clear the input
          }
     });

     // Validate book image file type
     $('#book_image_input').on('change', function() {
          const file = this.files[0];
          const allowedTypes = ['image/jpeg', 'image/png', 'image/jpg'];
          if (file && !allowedTypes.includes(file.type)) {
               Swal.fire({
                    icon: 'error',
                    title: 'Invalid File Type',
                    text: 'Only JPG, JPEG, and PNG files are allowed.',
                    confirmButtonText: 'OK'
               });
               $(this).val(''); // Clear the input
               $('#book_image_name').val(''); // Clear the filename input
          } else {
               $('#book_image_name').val(file ? file.name : '');
          }
     });

     $('#book_file').on('change', function() {
     const file = this.files[0];
     const allowedTypes = ['application/pdf'];  // Allow only PDFs
     if (file && !allowedTypes.includes(file.type)) {
          Swal.fire({
               icon: 'error',
               title: 'Invalid File Type',
               text: 'Only PDF files are allowed.',
               confirmButtonText: 'OK'
          });
          $(this).val(''); // Clear the input
          $('#book_file_name').val(''); // Clear the filename input
     } else {
          $('#book_file_name').val(file ? file.name : ''); // Set the file name if valid
     }
     });
     });
</script>
<?php 
include('./includes/footer.php');
include('./includes/script.php');
include('../message.php');
?>