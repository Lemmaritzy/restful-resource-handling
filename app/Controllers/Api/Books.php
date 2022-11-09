<?php

namespace App\Controllers\Api;

use App\Models\Books as ModelsBooks;
use CodeIgniter\RESTful\ResourceController;

class Books extends ResourceController
{
    protected $modelName = 'App\Models\Books';
    protected $format    = 'json';
    private $book_model;

    public function __construct()
    {
        $this->book_model = new ModelsBooks();
    }
    public function index()
    {
        $data["books"] = $this->book_model->getBooks();
        return $this->respond($data);
    }
    public function new()
    {
        $data["books"] = [
            'barcode' => $this->request->getVar('barcode'),
            'book_name' => $this->request->getVar('book_name'),
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'book_description' => $this->request->getVar('book_description'),
            'summary' => $this->request->getVar('summary'),
            'translator' => $this->request->getVar('translator')
        ];
        $valid = $this->book_model->validate($data["books"]);
        if ($valid) {
            $stmt = $this->book_model->insertBook($data["books"]);
            return $this->respondCreated($stmt, "book successfully added");
        } else {
            $data["errors"] = $this->book_model->errors();
            return $this->failValidationErrors($data["errors"]);
        }
    }
    public function create()
    {
        $data["books"] = [
            'barcode' => $this->request->getVar('barcode'),
            'book_name' => $this->request->getVar('book_name'),
            'author' => $this->request->getVar('author'),
            'publisher' => $this->request->getVar('publisher'),
            'book_description' => $this->request->getVar('book_description'),
            'summary' => $this->request->getVar('summary'),
            'translator' => $this->request->getVar('translator')
        ];
        $valid = $this->book_model->validate($data["books"]);
        if ($valid) {
            $stmt = $this->book_model->insertBook($data);
            return $this->respond(["status" => 200, "message" => 'Book created successfully']);
        } else {
            $data["errors"] = $this->book_model->errors();
            return $this->failValidationErrors($data["errors"]);
        }
    }

    public function show($id = null)
    {
        $book = $this->book_model->findBook($id);
        if ($book == null) {
            return $this->fail("there is no record with this id", 400, 'no data no data');
        }
        return $this->respond($book, 200, "we found it!!");
    }
    public function edit($id = null)
    {
        echo "edit";
    }
    public function update($id = null)
    {
        echo "update";
    }
    public function delete($id = null)
    {
        $stmt = $this->book_model->deleteBook($id);
        if ($stmt > 0) {
            return $this->respond("book deleted successfully", 200, 'ohhheyy its goneeee.. finally.');
        } else {
            return $this->fail("uppss an error occurred", 400, 'something went wrong while trying to delete data');
        }
    }
}
