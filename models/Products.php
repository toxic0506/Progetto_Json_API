<?php
require_once __DIR__ . '/../connections/database.php';
class Product
{
    private $id;
    private $nome;
    private $prezzo;
    private $marca;

    public function getId()
    {
        return $this-> id;
    }
    public function getNome()
    {
        return $this->nome;
    }
    public function getPrezzo()
    {
        return $this-> prezzo;
    }
    public function getMarca()
    {
        return $this->marca;
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function setNome($name)
    {
        $this->name = $name;
    }
    public function set_Prezzo($pre)
    {
        $this->prezzo = $pre;
    }
    public function setMarca($marca)
    {
        $this->marca = $marca;
    }

    public static function ConnectTo()
    {
        return Database::Connect("ecommerce");
    }
    public static function Find($id)
    {
        $pdo = self::ConnectTo();
        $stmt = $pdo-> prepare("select * from products where id =:id");
        $stmt-> bindParam(":id",$id);
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    public static function FindId($id)
    {
        $pdo = self::connectTo();
        $stmt = $pdo->prepare("select * from ecommerce.products where id= :id");
        $stmt->bindParam(":id", $id);
        if (!$stmt->execute()) {
            return false;
        }
        return $stmt->fetchObject('Product');
    }

    public static function FindAll()
    {
        $pdo = self::ConnectTo();
        $stmt = $pdo-> query("select * from ecommerce.products");
        return $stmt->fetchAll(PDO::FETCH_CLASS, 'Product');
    }

    static function getProdotto($id)
    {
        $pdo= self::ConnectTo();
        $stmt = $pdo-> prepare("select * from products where id =:id");
        $stmt-> bindParam(":id",$id);
        if($stmt-> execute())
        {
            return $stmt-> fetchObject('Product');
        }else{
            exit();
        }
    }

    public static function Create($params)
    {
        $pdo= self::ConnectTo();
        $stmt = $pdo-> prepare("insert into ecommerce.products (marca,nome,prezzo) values (:marca, :nome, :prezzo)");
        $stmt->bindParam(":marca", $params["marca"]);
        $stmt->bindParam(":nome", $params["nome"]);
        $stmt->bindParam(":prezzo", $params["prezzo"]);
        if ($stmt->execute()) {
            $stmt = $pdo->prepare("select * from ecommerce.products order by id desc limit 1");
            $stmt->execute();
            return $stmt->fetchObject("Product");
        } else {
            throw new PDOException("Errore Nella Creazione");
        }

    }

}