
import org.junit.jupiter.api.Test;
import static org.junit.jupiter.api.Assertions.*;

public class StudentTest {

    @Test
    public void testCreateStudent() {
        Student student = new Student(1, "Amine", 15);

        assertEquals(1, student.getId());
        assertEquals("Amine", student.getName());
        assertEquals(15, student.getGrade());
    }
}
