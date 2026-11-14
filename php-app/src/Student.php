
<?php

class Student
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function addStudent($name, $grade)
    {
        $sql = "INSERT INTO students (name, grade) VALUES (:name, :grade)";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([
            ':name' => $name,
            ':grade' => $grade
        ]);
    }

    public function getStudent($id)
    {
        $sql = "SELECT id, name, grade FROM students WHERE id = :id";
        $stmt = $this->pdo->prepare($sql);

        $stmt->execute([':id' => $id]);

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
