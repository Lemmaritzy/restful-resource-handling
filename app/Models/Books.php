<?php

namespace App\Models;

use CodeIgniter\Model;

class Books extends Model
{
    protected $table      = 'books';
    protected $primaryKey = 'id';

    protected $useAutoIncrement = true;

    protected $returnType     = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'barcode',
        'book_name',
        'author',
        'publisher',
        'book_description',
        'summary',
        'translator',
        'created_at'
    ];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'barcode' => 'required|is_unique[books.barcode]|max_length[25]',
        'book_name' => 'required|is_unique[books.book_name]|max_length[50]',
        'author' => 'required|max_length[50]',
        'publisher' => 'required|max_length[50]',
        'book_description' => 'required',
        'summary' => 'required',
        'translator' => 'required|max_length[50]'
    ];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getBooks()
    {
        $query = $this->db->query("SELECT * FROM books ");
        return $query->getResultArray();
    }
    public function insertBook($data)
    {
        $query = $this->db->query("INSERT INTO books set barcode=:barcode: , book_name=:book_name:, author=:author: , publisher=:publisher:, book_description=:book_description:, summary=:summary:, translator=:translator:", [
            'barcode' => $data["barcode"],
            'book_name' => $data["book_name"],
            'author' => $data["author"],
            'publisher' => $data["publisher"],
            'book_description' => $data["book_description"],
            'summary' => $data['summary'],
            'translator' => $data['translator']
        ]);
    }
    public function findBook($id)
    {
        $query = $this->db->query("SELECT * FROM books where id = :id:", ['id' => $id]);
        return $query->getRow();
    }
    public function deleteBook($id)
    {
        $query = $this->db->query("DELETE FROM books where id = :id:", ['id' => $id]);
        return $this->db->affectedRows();
    }
}
