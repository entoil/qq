INSERT INTO users (username, password, email) VALUES ('tom', 'bahbah', 'tomacoin@gmail.com');
INSERT INTO users (username, password, email) VALUES ('jerry', 'bahbah', 'jerry@gmail.com');

INSERT INTO surveys (uid, name) VALUES (1, 'Tom\'s Survey');
INSERT INTO surveys (uid, name) VALUES (2, 'Expectations for School');
INSERT INTO surveys (uid, name) VALUES (2, 'Experience at School');

INSERT INTO questions (sid, number, question, type) VALUES (1, 1, "My name is Tom.", 'tf');
INSERT INTO questions (sid, number, question, type) VALUES (1, 2, "I am a great person.", 'opinion');
INSERT INTO questions (sid, number, question, type) VALUES (1, 3, "Is your name Tom?.", 'tf');
INSERT INTO questions (sid, number, question, type) VALUES (2, 1, "On a scale, how do you rate your school?", 'scale');
INSERT INTO questions (sid, number, question, type) VALUES (2, 2, "You plan to have the highest attendance possible.", 'yn');
INSERT INTO questions (sid, number, question, type) VALUES (2, 3, "You expect to be able to be able to contact teachers 24/7", 'yn');
INSERT INTO questions (sid, number, question, type) VALUES (2, 4, "How often will you purchase food at the cafeteria?", 'often');
INSERT INTO questions (sid, number, question, type) VALUES (2, 5, "There be security cameras on campus.", 'opinion');
INSERT INTO questions (sid, number, question, type) VALUES (2, 6, "You have attended more than one school previously.", 'tf');
INSERT INTO questions (sid, number, question, type) VALUES (3, 1, "On a scale, how do you rate your day at school?", 'scale');
INSERT INTO questions (sid, number, question, type) VALUES (3, 2, "Do you receive above average grades?", 'yn');
INSERT INTO questions (sid, number, question, type) VALUES (3, 3, "Do you find it hard to concentrate at school?", 'yn');
INSERT INTO questions (sid, number, question, type) VALUES (3, 4, "The teachers are friendly and approachable.", 'tf');
INSERT INTO questions (sid, number, question, type) VALUES (3, 5, "How do you rate the food at the cafeteria?", 'scale');
INSERT INTO questions (sid, number, question, type) VALUES (3, 6, "How often did you feel lost about what to do?", 'often');