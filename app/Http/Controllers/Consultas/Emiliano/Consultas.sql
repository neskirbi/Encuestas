
SELECT gen.razonsocial,concat(gen.nombresfisica,' ',gen.apellidosfisica) as cliente,concat(gen.nombresrepre,' ',gen.apellidosrepre) as representante,gen.rfc,obr.obra,
concat(gen.calle,', ',gen.numeroext,', ',gen.numeroint,', ',gen.colonia,', ',gen.cp,', ',gen.municipio,', ',gen.entidad) as direccionfiscal,
concat(obr.calle,', ',obr.numeroext,', ',obr.numeroint,', ',obr.colonia,', ',obr.cp,', ',obr.municipio,', ',obr.entidad) as direccionobra,
obr.contacto,obr.correo,obr.telefono,obr.celular,
obr.fechainicio,obr.fechafin,
((select sum(mat.cantidad*mat.precio)+(sum(mat.cantidad*mat.precio)*(obr.ivaobra/100)) from materialesobra as mat where mat.id_obra=obr.id),2) as monto,
obr.superficie as volumendeclarado,
(select created_at  from citas where id_obra=obr.id  order by created_at desc limit 0,1) as ultima,
(select sum(cantidad) from citas where id_obra=obr.id and confirmacion=1) as entregado
FROM `clientes` as cli
join generadores as gen on gen.id_cliente=cli.id
JOIN obras as obr on obr.id_generador=gen.id
where obr.id_planta='0e8332117ef04888838b4037b7e99ee3'



//////////////////////////

Sacar madera por mes 

SELECT month(created_at),sum(cantidad) FROM `citas` where planta like '%CIREC%' and  material   like '%madera%' and year(created_at)=2022 and confirmacion=1 group by month(created_at) order by month(created_at)

//////////////////
Materiales por anio agrupados por mes 
select material,month(fechacita) as mes ,sum(cantidad) from citas where id_obra in (select id from obras where id_planta = '0e8332117ef04888838b4037b7e99ee3') and year(fechacita)='2022' group by material,mes order by mes asc ,material asc





/////////////////
cantidad por delegacion y obras por anio



SELECT mun.municipio,(select razonsocial from generadores where id=obr.id_generador) as generador,obr.obra, 
(select sum(cantidad) from citas where id_obra=obr.id and year(created_at)='2022' and confirmacion=1 )  as cantidad,
(select sum(cantidad) from citas where id_obra=obr.id and year(created_at)='2022'  )  as cantidad2
FROM municipios as mun
join obras as obr on obr.municipio = mun.municipio
where id_entidad='8' and  obr.id_planta='0e8332117ef04888838b4037b7e99ee3' 
order by mun.municipio,generador,obr.obra




///////////
consulta valor obras 

SELECT (select planta from plantas where id = obr.id_planta) as planta,obra, 
tipoobra,cantidadobra,(cantidadobra*14000) as valor 
FROM `obras` as obr
 where id_planta='0e8332117ef04888838b4037b7e99ee3' or id_planta='e500460066c94495b7de1f0c0a8204d9'