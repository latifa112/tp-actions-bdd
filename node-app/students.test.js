
const {
    pool,
    addStudent,
    getStudent,
    averageGrade
} = require("./students");

beforeEach(async () => {
    await pool.query("TRUNCATE TABLE students RESTART IDENTITY");
});

afterAll(async () => {
    await pool.end();
});

test("Ajouter et récupérer un étudiant", async () => {
    await addStudent("Amine", 15);

    const student = await getStudent(1);

    expect(student.name).toBe("Amine");
    expect(Number(student.grade)).toBe(15);
});

test("Vérifier un étudiant inexistant", async () => {
    const student = await getStudent(100);

    expect(student).toBeUndefined();
});

test("Calculer la moyenne des notes", async () => {
    await addStudent("Amine", 10);
    await addStudent("Sara", 14);

    const average = await averageGrade();

    expect(average).toBe(12);
});
