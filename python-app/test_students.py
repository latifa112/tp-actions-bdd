import pytest
import psycopg2
from students import add_student, get_student, average_grade


@pytest.fixture
def conn():
    connection = psycopg2.connect(
        host="localhost",
        database="tp",
        user="postgres",
        password="postgres"
    )

    with connection.cursor() as cur:
        cur.execute("DELETE FROM students")
        connection.commit()

    yield connection

    connection.close()


def test_add_student(conn):
    add_student(conn, "Latifa", 15)

    student = get_student(conn, 1)

    assert student is not None
    assert student[1] == "Latifa"
    assert float(student[2]) == 15.0


def test_student_not_found(conn):
    student = get_student(conn, 999)

    assert student is None


def test_average_grade(conn):
    add_student(conn, "Amel", 10)
    add_student(conn, "Karim", 14)

    moyenne = average_grade(conn)

    assert moyenne == 12.0
