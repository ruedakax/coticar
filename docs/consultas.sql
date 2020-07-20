use quoting;

--promedio
SELECT COUNT(*) AS Count,ceil(AVG(kilometros)) AS kilometros,ceil(AVG(precio)) as precio
FROM (SELECT kilometros,precio,NTILE(28) OVER (ORDER BY kilometros) AS Buckets
         FROM vehiculo         
         WHERE depto = 'bogota-dc'
	    AND marca = 'chevrolet'
	    AND modelo = 'sail'
	    AND anio > '2011'
      ) m
WHERE Buckets > 2;

--m�nimos y m�ximos
SELECT COUNT(*) AS Count,ceil(Max(kilometros)) AS max_kilometros,ceil(Max(precio)) max_precio,ceil(Min(kilometros)) AS min_kilometros,ceil(min(precio)) as min_precio
FROM (SELECT kilometros,precio,NTILE(28) OVER (ORDER BY kilometros) AS Buckets
         FROM vehiculo         
         WHERE depto = 'bogota-dc'
	    AND marca = 'chevrolet'
	    AND modelo = 'sail'
	    AND anio > '2011'
      ) m
WHERE Buckets > 2;


--color
SELECT color 
FROM vehiculo
WHERE depto = 'bogota-dc'
AND marca = 'chevrolet'
AND modelo = 'sail'
AND anio = '2016'
and color !=''
group by 1
order by count(*) DESC
limit 1;

--mismo carro otro depto
SELECT depto,count(*)
FROM vehiculo
WHERE depto != 'bogota-dc'
AND marca = 'chevrolet'
AND modelo = 'sail'
AND anio = '2016'
group by 1	
order by 2 DESC;
