<?php
include('authentication.php');

                                if (isset($_POST['borrow'])) {
                                    $user_id = $_POST['user_id'];
                                    $book_id = $_POST['book_id'];
                                    $date_borrowed = date('Y-m-d');
                                    
                                    $restricted_categories = [3, 4, 6];
                                    $book_details_query = mysqli_query($con, "SELECT title, category_id FROM book WHERE book_id = $book_id");
                                    $book_details = mysqli_fetch_assoc($book_details_query);
                                    $book_title = $book_details['title'];
                                    $category_id = $book_details['category_id'];
                                    
                                    if (in_array($category_id, $restricted_categories)) {
                                        echo "<script>
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Not Allowed',
                                                text: 'Books from this section cannot be borrowed!',
                                                confirmButtonText: 'OK'
                                            }).then(() => {
                                                window.location = 'circulation_borrowing?student_id=" . $student_id . "';
                                            });
                                        </script>";
                                    } else {
                                        $title_check_query = mysqli_query($con, "SELECT * FROM borrow_book 
                                            INNER JOIN book ON borrow_book.book_id = book.book_id 
                                            WHERE borrow_book.user_id = '$user_id' AND book.title = '$book_title' AND borrow_book.borrowed_status = 'borrowed'");
                                        if (mysqli_num_rows($title_check_query) > 0) {
                                            echo "<script>
                                                Swal.fire({
                                                    icon: 'error',
                                                    title: 'Oops...',
                                                    text: 'You have already borrowed a book with the same title!',
                                                    confirmButtonText: 'OK'
                                                }).then(() => {
                                                    window.location = 'circulation_borrowing?student_id=" . $student_id . "';
                                                });
                                            </script>";
                                        } else {
                                            // Calculate due date based on category
                                            if ($category_id == 5) {
                                                $due_date = date('Y-m-d', strtotime($date_borrowed . ' + 7 days'));
                                            } elseif ($category_id == 1 || $category_id == 2) {
                                                $due_date = date('Y-m-d', strtotime($date_borrowed . ' + 3 days'));
                                            }

                                            $trapBookCount = mysqli_query($con, "SELECT count(*) AS books_allowed FROM borrow_book WHERE user_id = '$user_id' AND borrowed_status = 'borrowed'");
                                            $countBorrowed = mysqli_fetch_assoc($trapBookCount);
                                            
                                            $bookCountQuery = mysqli_query($con, "SELECT count(*) AS book_count FROM borrow_book WHERE user_id = '$user_id' AND borrowed_status = 'borrowed' AND book_id = $book_id");
                                            $bookCount = mysqli_fetch_assoc($bookCountQuery);
                                            
                                            $allowed_book_query = mysqli_query($con, "SELECT * FROM allowed_book WHERE allowed_book_id = 1");
                                            $allowed = mysqli_fetch_assoc($allowed_book_query);
                                            if ($countBorrowed['books_allowed'] == $allowed['qntty_books']) {
                                                $_SESSION['status'] = "You are allowed up to " . $allowed['qntty_books'] . " books!";
                                                $_SESSION['status_code'] = "warning";
                                                header('Location: circulation_borrowing?student_id=" . $student_id . "');
                                                exit(0);
                                            } elseif ($bookCount['book_count'] == 1) {
                                                $_SESSION['status'] = "This book has already been borrowed!";
                                                $_SESSION['status_code'] = "warning";
                                                header('Location: circulation_borrowing?student_id=" . $student_id . "');
                                                exit(0);
                                            } else {
                                                mysqli_query($con, "UPDATE book SET status = 'Borrowed' WHERE book_id = '$book_id'");
                                                mysqli_query($con, "INSERT INTO borrow_book(user_id, book_id, date_borrowed, due_date, borrowed_status)
                                                VALUES ('$user_id', '$book_id', '$date_borrowed', '$due_date', 'borrowed')");

                                                $report_history = mysqli_query($con, "SELECT * FROM admin WHERE admin_id = $id_session");
                                                $report_history_row = mysqli_fetch_array($report_history);
                                                $admin_row = $report_history_row['firstname'] . " " . $report_history_row['middlename'] . " " . $report_history_row['lastname'];    
                                                
                                                mysqli_query($con, "INSERT INTO report 
                                                (book_id, user_id, admin_name, detail_action, date_transaction)
                                                VALUES ('$book_id', '$user_id', '$admin_row', 'Borrowed Book', NOW())");
                                                $_SESSION['status'] = "Book Borrowed Successfully";
                                                $_SESSION['status_code'] = "success";
                                                header('Location: circulation_borrowing?student_id=" . $student_id . "');
                                                exit(0);
                                            }
                                        }
                                    }
                                }
                                ?>