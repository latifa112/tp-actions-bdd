
<?php

use PHPUnit\Framework\TestCase;

require_once __DIR__ . '/../src/Student.php';

class StudentTest extends TestCase
{
    private $pdo;
    private $student;

    protected function setUp(): void
    {
        $this->pdo = new PDO(
            "pgsql:host=localhost;port=5432;dbname=tp",
            "postgres",
            "postgres"
        );

        $this->pdo->exec("TRUNCATE TABLE students RESTART IDENTITY");

        $this->student = new Student($this->pdo);
    }

    public function testAddAndGetStudent(): void
    {
        $this->student->addStudent("Amine", 15);

        $student = $this->student->getStudent(1);

        $this->assertEquals("Amine", $student['name']);
        $this->assertEquals(15, (float) $student['grade']);
    }

    public function testGetNonExistingStudent(): void
    {
        $student = $this->student->getStudent(100);

        $this->assertFalse($student);
    }
}
