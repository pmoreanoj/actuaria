USE actuaria;

#Tab 1
#Distribución de género
SELECT COUNT(id) as count,gender FROM employee 
	WHERE campaign_id=1 GROUP BY gender order by gender;

#Distribución de edades
SELECT count(id) as count, age FROM employee
WHERE campaign_id= 1 GROUP BY age order by age;

#Distribución de salarios
SELECT count(id) as count, income FROM employee
WHERE campaign_id= 1 GROUP BY income order by income;

#TAB 2

#Rendimiento por tipo de pregunta, los 5 niveles (puntaje promedio) SOLO TRANSV.
#e.level va cambiando 1,2,3....n
SELECT avg(score) as score, qt.name as name, chq.level_id FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
JOIN question_type qt ON qt.id = chq.question_type_id
JOIN level lev ON chq.level_id = lev.id
WHERE lev.level = 0 AND e.level = 2
GROUP BY chq.question_type_id ORDER BY qt.name;

SELECT * FROM campaign_has_question;
SELECT * FROM level;

#Rendimiento por tipo de pregunta, todas las areas (punt. promedio) SOLO TRANSV.
#ar.id va cambiando 1,2,3....n
SELECT avg(score) as score, qt.name as name, ar.name as area_name FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
JOIN question_type qt ON qt.id = chq.question_type_id
JOIN area ar ON e.area = ar.name
WHERE chq.level_id = 1 AND ar.id = 1
GROUP BY chq.question_type_id ORDER BY qt.name;

SELECT * FROM area;

#Rendimiento por tipo de pregunta, todos los géneros (punt.promedio) SOLO TRANS.
SELECT avg(score) as score, qt.name as name, e.gender FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
JOIN question_type qt ON qt.id = chq.question_type_id
WHERE chq.level_id = 1 AND e.gender = 'F'
GROUP BY chq.question_type_id ORDER BY qt.name;

#Rendimiento por tipo de pregunta, todas las edades (punt.promedio) SOLO TRANS.
SELECT avg(score) as score, qt.name as name, e.age FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
JOIN question_type qt ON qt.id = chq.question_type_id
WHERE chq.level_id = 1 AND e.age = '35'
GROUP BY chq.question_type_id ORDER BY qt.name;

#Rendimiento por edades (punt.promedio) SOLO TRANS. 
SELECT avg(score) as score, e.age FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
WHERE chq.level_id = 1
GROUP BY e.age ORDER BY e.age;

#Rendimiento por salarios (punt.promedio) SOLO TRANS. 
SELECT avg(score) as score, e.income FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
WHERE chq.level_id = 1
GROUP BY e.income ORDER BY e.income;

#Rendimiento por áreas (punt.promedio) SOLO TRANS. 
SELECT avg(score) as score, ar.name FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
JOIN area ar ON e.area = ar.name
WHERE chq.level_id = 1
GROUP BY ar.name ORDER BY ar.name;

SELECT * FROM area;

#Rendimiento por niveles (punt.promedio) SOLO TRANS.
SELECT avg(score) as score, l.level FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
JOIN level l ON e.level = l.level
WHERE chq.level_id = 1 
GROUP BY l.name ORDER BY l.name;

SELECT * FROM level;

#TAB 3
#Desempeño individual por nivel (todas las personas del nivel)
#Nivel 1
#Solo cambiar e.level = 2,3,4,5 y ya está listo
#chq.level_id siempre debe ser un número más que el e.level
#Si e.level = 3 entonces chq.level_id = 4
SELECT avg(a.score), e.name FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
WHERE e.level = 3 AND chq.level_id = 4
GROUP BY a.evaluated_id ORDER BY e.name;

DESC campaign_has_question;
SELECT * FROM employee
WHERE employee.level = 1 ORDER BY employee.name;

#Desempeño por niveles
SELECT avg(score), e.level FROM answer a
JOIN employee e ON a.evaluated_id = e.id
GROUP BY e.level;

#Desempeño por edades
SELECT avg(score) as score, e.age as age FROM answer a
JOIN employee e ON a.evaluated_id = e.id 
GROUP BY e.age;

#TAB 4
#Desempeño individual (cada empleado) TODAS LAS PREGUNTAS Y RESPUESTAS
SELECT avg(a.score) as score, e.name as name, qt.name as qtname FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
JOIN question_type qt ON qt.id = chq.question_type_id
WHERE e.id = 1
GROUP BY qt.id ORDER BY qt.id;

SELECT avg(a.score) as score, e.name as name, qt.name as qtname FROM answer a 
JOIN employee e ON a.evaluated_id = e.id 
JOIN campaign_has_question chq ON a.question_id = chq.id 
JOIN question_type qt ON qt.id = chq.question_type_id 
WHERE e.id = 1 GROUP BY qt.id ORDER BY qt.id;

#solo los nombres de las preguntas...
SELECT qt.name as qtname FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
JOIN question_type qt ON qt.id = chq.question_type_id
WHERE e.id = 1
GROUP BY qtname ORDER BY qtname;

#Desempeño individual (cada empleado) SOLO COMPETENCIAS ESPECIFICAS
SELECT avg(a.score) as score, e.name as name, qt.name as qtname FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
JOIN question_type qt ON qt.id = chq.question_type_id
WHERE e.id = 1 AND chq.level_id = (e.level + 1)
GROUP BY qtname ORDER BY qtname;

#Desempeño individual (cada empleado) SOLO COMPETENCIAS GENERALES
SELECT avg(a.score) as score, e.name as name, qt.name as qtname FROM answer a
JOIN employee e ON a.evaluated_id = e.id
JOIN campaign_has_question chq ON a.question_id = chq.id
JOIN question_type qt ON qt.id = chq.question_type_id
WHERE e.id = 1 AND chq.level_id = 1
GROUP BY qtname ORDER BY qtname;



