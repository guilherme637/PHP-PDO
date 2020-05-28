<?php

use Alura\Pdo\Domain\Model\Student;
use Alura\Pdo\Infrastructure\Persistence\ConnectionCreator;

require_once 'vendor/autoload.php';

$pdo =  ConnectionCreator::createConnection();

$student = new Student(
    null,
    "Guilherme",
    new DateTimeImmutable('1999-09-30')
);

$anotherStudent = new Student(
    null,
    'Júlia',
    new DateTimeImmutable('2000-08-25')
);

$sqlInsert = "INSERT INTO students (name, birth_date) VALUES (:name, :birth_date);";
$statement = $pdo->prepare($sqlInsert);
$statement->bindValue(':name', $student->name());
$statement->bindValue(':birth_date', $student->birthDate()->format('Y-m-d'));

if ($statement->execute()) {
    echo "Aluno incluído";
}
