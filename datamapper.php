<?php

class book{
    private $id;
    private $name_b;
    private $author;

    public function __construct($id, $name_b, $author){
        $this->id = $id;
        $this->name_b = $name_b;
        $this->author=$author;
    }
}

class bookMapper{
    private $connection;

    function __construct(){
        $connection = new PDO("sqlite:dbname=mysql;host=localhost", "denis200210", "");
    }

    public function save(book $book){        
        
        $sql = $this->connection->prepare("Inser into book (id, name_b, author) VALUES (?,?,?);");
        $data = array ($book->id,$book->name_b,$book->author);
        $sql->execute($data);  
    }

    public function remove(book $book){
        
        $sql = $this->connection->prepare("Delete from book where id=?,author=? ");
        $data = array ($book->id,$book->name_b,$book->author);
        $sql->execute($data);  
    }

    public function getById($id): book{

        $sql = $this->connection->prepare("Select * from book where id = ? ");
        $sql->execute();
        $row = $sql->fetch(\PDO::FETCH_ASSOC);
        return new book($row['id'],$row['name_b'],$row['author']);
    }

    public function all(): array {
    
        $sql = $this->connection->prepare("Select * from book");
        $sql->execute();
        $rows = $sql->fetchAll();
        return $rows;
    }

    public function getByAuthor($author): array {
        
        $sql = $this->connection->prepare("Select * from book where author = ? ");
        $sql->execute();
        $rows = $sql->fetchAll();
        return $rows;
    }


    
}
?>