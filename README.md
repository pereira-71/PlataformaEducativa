# PlataformaEducativa
This repository is PlataformaEducativa (educational platform)
-------------------------------------------------------------

### Diseño de la base de datos

#### 1. **Usuarios**
La tabla `users` almacenará la información básica de los usuarios (tanto estudiantes como profesores).



#### 2. **Materias**
La tabla `courses` almacena información sobre las materias.



#### 3. **Inscripción de Estudiantes en Materias**
La tabla `course_enrollments` relaciona a los estudiantes con las materias que cursan.



#### 4. **Materiales del Curso**
La tabla `materials` almacena los materiales que los profesores suben para las materias (Word, Excel, Powerpoint, instrucciones, etc.).



#### 5. **Exámenes**
La tabla `exams` almacena la información básica sobre los exámenes.


#### 6. **Preguntas de Exámenes**
La tabla `exam_questions` almacena las preguntas de los exámenes. Cada pregunta tiene opciones de respuesta.


#### 7. **Opciones de Respuesta (para preguntas de opción múltiple)**
La tabla `question_options` almacena las opciones de respuesta para las preguntas de opción múltiple.


#### 8. **Respuestas de los Estudiantes en Exámenes**
La tabla `exam_responses` almacena las respuestas de los estudiantes a las preguntas de los exámenes.



#### 9. **Tareas**
La tabla `assignments` almacena las tareas que los profesores asignan.



#### 10. **Tareas Subidas por Estudiantes**
La tabla `assignment_submissions` almacena las tareas que los estudiantes suben.



### Relación de Tablas
- **Usuarios** se dividen en `teacher` y `student` mediante la columna `role`.
- Un **curso** tiene un único profesor (`teacher_id`) pero puede tener múltiples estudiantes, que se gestionan a través de la tabla `course_enrollments`.
- Un **examen** está asociado con un curso y tiene varias preguntas, cada una de las cuales puede tener opciones de respuesta (si es una pregunta de opción múltiple).
- Los **estudiantes** pueden responder preguntas en los exámenes y también pueden subir tareas en los cursos.

### Funcionalidades del Sistema
- Como **profesor** (teacher):
  - crear exámenes con preguntas de opción múltiple y configurar el cronómetro.
  - Puedes subir materiales como archivos de Word, Excel, PowerPoint, etc.
  - asignar tareas a los estudiantes y calificarlas.
- Como **estudiante** (student):
  -  inscribirte en un curso y ver los materiales y exámenes publicados por el profesor.
  -  resolver exámenes con límite de tiempo y ver tus calificaciones y respuestas correctas.
  -  subir tareas para ser calificadas por el profesor.


----------------------------------
bd:

CREATE DATABASE plataforma_educativa;
USE plataforma_educativa;

-- Tabla de usuarios (tanto profesores como estudiantes)
CREATE TABLE users (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    password VARCHAR(255), -- Se guardará en formato encriptado
    role ENUM('teacher', 'student'), -- Define el rol del usuario
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabla de cursos
CREATE TABLE courses (
    course_id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100),
    teacher_id INT, -- Profesor asignado al curso
    FOREIGN KEY (teacher_id) REFERENCES users(user_id)
);

-- Inscripción de estudiantes en cursos
CREATE TABLE course_enrollments (
    enrollment_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    student_id INT,
    FOREIGN KEY (course_id) REFERENCES courses(course_id),
    FOREIGN KEY (student_id) REFERENCES users(user_id)
);

-- Tabla de materiales de estudio (archivos que suben los profesores)
CREATE TABLE course_materials (
    material_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    teacher_id INT,
    title VARCHAR(255),
    file_path VARCHAR(255), -- Ruta del archivo
    upload_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (course_id) REFERENCES courses(course_id),
    FOREIGN KEY (teacher_id) REFERENCES users(user_id)
);

-- Tabla de exámenes
CREATE TABLE exams (
    exam_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    teacher_id INT,
    exam_name VARCHAR(100),
    duration INT, -- Duración en minutos
    start_time DATETIME, -- Fecha y hora de inicio
    end_time DATETIME, -- Fecha y hora de finalización
    FOREIGN KEY (course_id) REFERENCES courses(course_id),
    FOREIGN KEY (teacher_id) REFERENCES users(user_id)
);

-- Tabla de preguntas de los exámenes
CREATE TABLE exam_questions (
    question_id INT AUTO_INCREMENT PRIMARY KEY,
    exam_id INT,
    question_text TEXT, -- Pregunta del examen
    FOREIGN KEY (exam_id) REFERENCES exams(exam_id)
);

-- Tabla de opciones para cada pregunta (opciones múltiples)
CREATE TABLE question_options (
    option_id INT AUTO_INCREMENT PRIMARY KEY,
    question_id INT,
    option_text TEXT, -- Texto de la opción
    is_correct BOOLEAN, -- Indica si es la respuesta correcta
    FOREIGN KEY (question_id) REFERENCES exam_questions(question_id)
);

-- Respuestas de los estudiantes a las preguntas de los exámenes
CREATE TABLE exam_responses (
    response_id INT AUTO_INCREMENT PRIMARY KEY,
    student_id INT,
    exam_id INT,
    question_id INT,
    selected_option_id INT, -- Opción elegida por el estudiante
    is_correct BOOLEAN, -- Si la respuesta fue correcta o no
    submission_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (student_id) REFERENCES users(user_id),
    FOREIGN KEY (exam_id) REFERENCES exams(exam_id),
    FOREIGN KEY (question_id) REFERENCES exam_questions(question_id),
    FOREIGN KEY (selected_option_id) REFERENCES question_options(option_id)
);

-- Resultados finales de los exámenes
CREATE TABLE exam_results (
    result_id INT AUTO_INCREMENT PRIMARY KEY,
    exam_id INT,
    student_id INT,
    total_score FLOAT, -- Nota final del estudiante
    total_questions INT, -- Total de preguntas en el examen
    correct_answers INT, -- Respuestas correctas
    wrong_answers INT, -- Respuestas incorrectas
    completion_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (exam_id) REFERENCES exams(exam_id),
    FOREIGN KEY (student_id) REFERENCES users(user_id)
);

-- Tabla de tareas
CREATE TABLE assignments (
    assignment_id INT AUTO_INCREMENT PRIMARY KEY,
    course_id INT,
    teacher_id INT,
    title VARCHAR(255),
    description TEXT,
    due_date DATETIME, -- Fecha límite de entrega
    FOREIGN KEY (course_id) REFERENCES courses(course_id),
    FOREIGN KEY (teacher_id) REFERENCES users(user_id)
);



-- Vista para que los profesores puedan ver las calificaciones de sus estudiantes
CREATE VIEW teacher_student_grades AS
SELECT 
    c.course_id,
    c.course_name,
    u.user_id AS student_id,
    u.first_name,
    u.last_name,
    e.exam_id,
    e.exam_name,
    r.total_score
FROM users u
JOIN course_enrollments ce ON u.user_id = ce.student_id
JOIN courses c ON ce.course_id = c.course_id
LEFT JOIN exam_results r ON u.user_id = r.student_id
LEFT JOIN exams e ON r.exam_id = e.exam_id
WHERE u.role = 'student';

-- Consulta para que los estudiantes vean sus calificaciones y respuestas correctas después de un examen
CREATE VIEW student_exam_feedback AS
SELECT 
    r.student_id,
    r.exam_id,
    q.question_text, 
    qo.option_text AS correct_answer, 
    r.selected_option_id, 
    CASE 
        WHEN r.is_correct = TRUE THEN 'Correcta'
        ELSE 'Incorrecta'
    END AS resultado
FROM exam_responses r
JOIN exam_questions q ON r.question_id = q.question_id
JOIN question_options qo ON q.question_id = qo.question_id AND qo.is_correct = TRUE;

--------------
credenciales

Juan
Perez
teacher@gmail.com 
password: 123
maria 
martinez
student@gmail.com
456
teacher3@gmail.com
333