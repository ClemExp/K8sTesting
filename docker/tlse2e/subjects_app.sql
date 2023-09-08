CREATE TABLE subjects (
  SubjectID int(2) NOT NULL AUTO_INCREMENT,
  Title varchar(255),
  PRIMARY KEY (SubjectID)
);

INSERT INTO subjects (Title) VALUES ('Secure Architecture');
INSERT INTO subjects (Title) VALUES ('Cyber Attack');
INSERT INTO subjects (Title) VALUES ('Cyber Defence');
INSERT INTO subjects (Title) VALUES ('Data Protection');

SELECT * FROM subjects;
SELECT * FROM students;

CREATE TABLE students (
  studentID int(9) NOT NULL AUTO_INCREMENT,
  subject int(2),
  name varchar(255),
  email varchar(200),
  motivational_letter varchar(4000),
  PRIMARY KEY (studentID),
  FOREIGN KEY (subject) REFERENCES subjects(SubjectID)
);

DROP table subjects;
DROP table students;

INSERT into students (subject, name, email, motivational_letter) VALUES (1, 'Bob Smith', 'bob@uc3m.es', 'random letter text');
INSERT into students (subject, name, email, motivational_letter) VALUES (1, 'Jane Smith', 'jane@uc3m.es', 'more letter text');


SELECT su.title, COUNT(1) AS studentnum FROM subjects su LEFT JOIN students st ON su.subjectid = st.subject GROUP BY su.title