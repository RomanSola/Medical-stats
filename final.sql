1) Insertar en la relación “estrella” al astro ‘Próxima Centauri’, con estrella_id = 4 y magnitud =
11.05.
2) Crear la tabla ‘viaje’ que permita registrar los viajes realizados desde un astro a otro. Deben
quedar registrados el astro desde el que se inició el viaje (origen), el astro al que se arribó (destino),
la fecha de salida (f_salida) y la de llegada (f_llegada).
3) Insertar en la tabla creada en el punto 3 el viaje realizado en la misión Apollo 11, que partió
desde la ‘Tierra’ el ‘1969-07-16’ y arribó el ‘1969-07-20’ a la ‘Luna’.
4) Escribir una consulta que traiga el nombre y la masa de todos los astros que se encuentran a una
distancia del sol menor a 123 millones de kilómetros.
5) Escribir una consulta que muestre el nombre de cada estrella junto con su magnitud aparente.
6) Escribir una consulta que muestre el nombre de cada planeta junto con la cantidad de satélites
registrados que lo orbitan (mostrar solo los planetas que tienen satélites).
7) Escribir una consulta que muestre solo los nombres de los astros ordenados por diámetro de
mayor a menor.
8) Corregir el nombre del astro ‘Calisto’ ya que en la base de datos se cargó por error como
‘Calixto’.
9) Se desea diseñar un modelo de datos que contenga información relativa a las rutas de todo el
país.
El país está dividido en provincias, cada provincia tiene un código que la identifica. Un municipio
se encuentra dentro de una provincia. Una provincia está compuesta de al menos un municipio.
Toda ruta está dividida en tramos y un tramo pertenece a una única ruta. Un tramo puede pasar por
varios municipios, el tramo se identifica especificando el Km de entrada respecto al Km cero de la
carretera y la longitud del tramo.
Realizar un Diagrama Entidad Relación para representar el diseño de esta base de datos.

--1
INSERT INTO estrella (estrella_id, astro_id, magnitud)
VALUES (4, 20, 11.05);

SELECT estrella_id, astro.nombre AS nombre_astro, magnitud
FROM estrella
JOIN astro ON estrella.astro_id = astro.astro_id
WHERE astro.nombre = 'Próxima Centauri';


--2
CREATE TABLE viaje (
    viaje_id SERIAL PRIMARY KEY,
    origen INTEGER REFERENCES astro(astro_id),
    destino INTEGER REFERENCES astro(astro_id),
    f_salida DATE,
    f_llegada DATE
);

--3
INSERT INTO viaje (origen, destino, f_salida, f_llegada)
VALUES (
    (SELECT astro_id FROM astro WHERE nombre = 'Tierra'),
    (SELECT astro_id FROM astro WHERE nombre = 'Luna'),
    '1969-07-16',
    '1969-07-20'
);

SELECT v.viaje_id, a1.nombre AS origen, a2.nombre AS destino, f_salida, f_llegada
FROM viaje v
JOIN astro a1 ON v.origen = a1.astro_id
JOIN astro a2 ON v.destino = a2.astro_id
WHERE a1.nombre = 'Tierra' AND a2.nombre = 'Luna';


--4
SELECT nombre, masa
FROM astro
WHERE distancia < 123000000;

--5
SELECT astro.nombre AS estrella, magnitud
FROM estrella
JOIN astro ON estrella.astro_id = astro.astro_id;

--6
SELECT p.nombre AS planeta, COUNT(s.satelite_id) AS cantidad_satelites
FROM planeta
JOIN astro p ON planeta.astro_id = p.astro_id
JOIN satelite s ON planeta.planeta_id = s.planeta_id
GROUP BY p.nombre
HAVING COUNT(s.satelite_id) > 0;

--7
SELECT nombre
FROM astro
ORDER BY diametro DESC;

--8
UPDATE astro
SET nombre = 'Calisto'
WHERE nombre = 'Calixto';

SELECT nombre
FROM astro
WHERE nombre = 'Calisto';
