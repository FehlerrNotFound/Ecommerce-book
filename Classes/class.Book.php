<?php
class Book
{
    private $db; // PDO instance
    private $conn;
    private $book_id;
    private $title;
    private $category;
    private $tags;
    private $book_image;
    private $price;
    private $book_details;

    // Constructor
    public function __construct()
    {
        $this->conn = Utility::getDBConnection();
        /*
        $this->title = $title;
        $this->category = $category;
        $this->tags = $tags;
        $this->book_image = $book_image;
        $this->price = $price;
        $this->book_details = $book_details;
        */
    }

    // Getters
    public function getBookId()
    {
        return $this->book_id;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function getCategory()
    {
        return $this->category;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function getBookImage()
    {
        return $this->book_image;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function getBookDetails()
    {
        return $this->book_details;
    }

    // Setters
    public function setTitle($title)
    {
        $this->title = $title;
    }

    public function setCategory($category)
    {
        $this->category = $category;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }

    public function setBookImage($book_image)
    {
        $this->book_image = $book_image;
    }

    public function setPrice($price)
    {
        $this->price = $price;
    }

    public function setBookDetails($book_details)
    {
        $this->book_details = $book_details;
    }

    // CRUD Operations
    public function create()
    {

        /**
         * Please change this method so it can adhere to the norms that we are using in this project.
         */
        $query = "INSERT INTO books (title, category, tags, book_image, price, book_details) VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $this->db->prepare($query);
        $stmt->execute([$this->title, $this->category, $this->tags, $this->book_image, $this->price, $this->book_details]);
        $this->book_id = $this->db->lastInsertId();
    }

    public function getBookById($book_id)
    {
        $Query = "SELECT * FROM books WHERE book_id = $book_id";
        $result = $this->conn->query($Query);
        if ($result) {
            return $result->fetch_assoc();
        } else {
            return false;
        }
    }

    public function update()
    {
        $Query = "UPDATE books SET title = ?, category = ?, tags = ?, book_image = ?, price = ?, book_details = ? WHERE book_id = ?";
        $result = $this->conn->query($Query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }

    public function getBooks($howMany = -1, $start = 0)
    {
        $howMany = (int)$howMany;
        if ($howMany == -1) {
            $Query = "SELECT * FROM `books`";
        } else {
            $Query = "SELECT * FROM `books` LIMIT $start, $howMany";
        }

        $result = $this->conn->query($Query);
        if ($result) {
            $Books = array();
            while ($row = $result->fetch_assoc()) {
                $Books[] = $row;
            }
            return $Books;
        } else {
            return false;
        }
    }

    public function delete()
    {
        $Query = "DELETE FROM books WHERE book_id = ?";
        $result = $this->conn->query($Query);
        if ($result) {
            return true;
        } else {
            return false;
        }
    }
}
