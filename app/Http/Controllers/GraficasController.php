<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class GraficasController extends Controller
{
    public function index(Request $request)
    {
        $consultaUno = DB::select("
        SELECT e.nombre AS estado, COUNT(*) AS cantidad
        FROM ocupaciones AS o
        INNER JOIN clientes AS c ON o.cve_clientes = c.cve_clientes
        INNER JOIN municipios AS m ON c.cve_municipios = m.cve_municipios AND c.cve_estados = m.cve_estados
        INNER JOIN estados AS e ON c.cve_estados = e.cve_estados
        GROUP BY e.nombre
        ORDER BY e.nombre
        ");
        $consultaDos = DB::select("
        Select e.nombre as estado, year(dv.fecha_hora_salida) as anio, COUNT(*) as cantidad
        from ocupaciones as o
        inner join detalles_vuelos as dv on o.cve_detalles_vuelos=dv.cve_detalles_vuelos
        inner join clientes as c on o.cve_clientes=c.cve_clientes
        inner join municipios as m on c.cve_municipios = m.cve_municipios and c.cve_estados = m.cve_estados
        inner join estados as e on c.cve_estados=e.cve_estados
        group by e.nombre, year(dv.fecha_hora_salida)
        order by e.nombre, year(dv.fecha_hora_salida)
        ");

        $consultaTresEstado = $request->query('estado', 'Tabasco'); // valor por defecto opcional

        $consultaTres = DB::select("
        SELECT m.nombre AS municipio, COUNT(*) AS cantidad
        FROM ocupaciones AS o
        INNER JOIN clientes AS c ON o.cve_clientes = c.cve_clientes
        INNER JOIN municipios AS m ON c.cve_municipios = m.cve_municipios AND c.cve_estados = m.cve_estados
        INNER JOIN estados AS e ON c.cve_estados = e.cve_estados
        WHERE e.nombre = ?
        GROUP BY m.nombre
        ORDER BY cantidad DESC
        ", [$consultaTresEstado]);

        $estados = Estado::get();

        $consultaCuatro = DB::select("
        Select year(dv.fecha_hora_salida) as anio, COUNT(*) as cantidad 
        from ocupaciones as o
            inner join detalles_vuelos as dv on o.cve_detalles_vuelos=dv.cve_detalles_vuelos
            inner join clientes as c on o.cve_clientes=c.cve_clientes
            inner join municipios as m on c.cve_municipios = m.cve_municipios and c.cve_estados = m.cve_estados
            inner join estados as e on c.cve_estados=e.cve_estados
        group by year(dv.fecha_hora_salida)
        order by year(dv.fecha_hora_salida)
        ");
        $consultaCinco = DB::select("
        SELECT 
            MONTH(dv.fecha_hora_salida) AS mes_id,
            YEAR(dv.fecha_hora_salida) AS anio,
            DATENAME(month, dv.fecha_hora_salida) AS mes,
            COUNT(*) AS cantidad
        FROM ocupaciones AS o
        JOIN detalles_vuelos AS dv ON o.cve_detalles_vuelos = dv.cve_detalles_vuelos
        JOIN clientes AS c ON o.cve_clientes = c.cve_clientes
        JOIN municipios AS m ON c.cve_municipios = m.cve_municipios AND c.cve_estados = m.cve_estados
        JOIN estados AS e ON c.cve_estados = e.cve_estados
        GROUP BY MONTH(dv.fecha_hora_salida), YEAR(dv.fecha_hora_salida), DATENAME(month, dv.fecha_hora_salida)
        ORDER BY mes_id
        ");
        $consultaSeis = DB::select("
        with categoriaEdad as (
            Select 
                    Case 
                        when DATEDIFF(year, c.fecha_nacimiento, dv.fecha_hora_salida) > 4 and DATEDIFF(year, c.fecha_nacimiento, dv.fecha_hora_salida) < 13 then 'Niños'
                        when DATEDIFF(year, c.fecha_nacimiento, dv.fecha_hora_salida) > 12 and DATEDIFF(year, c.fecha_nacimiento, dv.fecha_hora_salida) < 18 then 'Adolescentes'
                        when DATEDIFF(year, c.fecha_nacimiento, dv.fecha_hora_salida) > 17 and DATEDIFF(year, c.fecha_nacimiento, dv.fecha_hora_salida) < 31 then 'Jóvenes'
                        when DATEDIFF(year, c.fecha_nacimiento, dv.fecha_hora_salida) > 30 and DATEDIFF(year, c.fecha_nacimiento, dv.fecha_hora_salida) < 60 then 'Adultos'
                        when DATEDIFF(year, c.fecha_nacimiento, dv.fecha_hora_salida) >= 60 then 'Adultos Mayores'
                    else 'Otros'
                    end as categoria
            from ocupaciones as o
                inner join detalles_vuelos as dv on o.cve_detalles_vuelos=dv.cve_detalles_vuelos
                inner join clientes as c on o.cve_clientes=c.cve_clientes
                inner join municipios as m on c.cve_municipios = m.cve_municipios and c.cve_estados = m.cve_estados
                inner join estados as e on c.cve_estados=e.cve_estados
        )
        Select
                categoria,
                count(*) as cantidad 
        from categoriaEdad
        group by Categoria
        order by Categoria desc
        ");
        $consultaSiete = DB::select("
        Select
            year(dv.fecha_hora_salida) as anio,
            a.clave_internacional as aeropuerto,
            p.clave_internacional as pais,
            count(*) as cantidad
        from detalles_vuelos as dv
            inner join vuelos as v on dv.cve_vuelos=v.cve_vuelos
            inner join aeropuertos as a on v.cve_aeropuertos__origen=a.cve_aeropuertos
            inner join ciudades as c on a.cve_ciudades=c.cve_ciudades
            inner join paises as p on c.cve_paises=p.cve_paises
        group by year(dv.fecha_hora_salida),a.clave_internacional, p.clave_internacional
        ");
        $consultaOcho = DB::select("
        Select
            a.nombre as aerolinea,
            count(*) as cantidad
        from detalles_vuelos as dv
            inner join vuelos as v on dv.cve_vuelos=v.cve_vuelos
            inner join aerolineas as a on v.cve_aerolineas=a.cve_aerolineas
        group by a.nombre
        ");
        $consultaNueve = DB::select("
        Select
            a.nombre as aerolinea,
            year(dv.fecha_hora_salida) as anio,
            count(*) as cantidad
        from detalles_vuelos as dv
            inner join vuelos as v on dv.cve_vuelos=v.cve_vuelos
            inner join aerolineas as a on v.cve_aerolineas=a.cve_aerolineas
        group by year(dv.fecha_hora_salida),a.nombre
        ");
        $consultaDiez = DB::select("
        Select top 10 with ties 
            e.nombre as estado, COUNT(*) as cantidad
        from ocupaciones as o
            inner join clientes as c on o.cve_clientes=c.cve_clientes
            inner join municipios as m on c.cve_municipios = m.cve_municipios and c.cve_estados = m.cve_estados
            inner join estados as e on c.cve_estados=e.cve_estados
        group by e.nombre
        order by COUNT(*) desc
        ");
        $consultaOnce = DB::select("
        Select year(dv.fecha_hora_salida) as anio, COUNT(*) as cantidad 
        from ocupaciones as o
            inner join detalles_vuelos as dv on o.cve_detalles_vuelos=dv.cve_detalles_vuelos
            inner join clientes as c on o.cve_clientes=c.cve_clientes
            inner join municipios as m on c.cve_municipios = m.cve_municipios and c.cve_estados = m.cve_estados
            inner join estados as e on c.cve_estados=e.cve_estados
        group by year(dv.fecha_hora_salida)
        order by year(dv.fecha_hora_salida)
        ");
        $consultaDoce = DB::select("
        Select top 10 with ties
            a.nombre as aereopuerto,
            c.nombre as ciudad,
            p.nombre as pais,
            count(*) as cantidad
        from detalles_vuelos as dv
            inner join vuelos as v on dv.cve_vuelos=v.cve_vuelos
            inner join aeropuertos as a on v.cve_aeropuertos__origen=a.cve_aeropuertos
            inner join ciudades as c on a.cve_ciudades=c.cve_ciudades
            inner join paises as p on c.cve_paises=p.cve_paises
        group by a.nombre, c.nombre, p.nombre
        order by COUNT(*) desc
        ");
        $consultaTrece = DB::select("
        Select month(dv.fecha_hora_salida) id, datename(month, dv.fecha_hora_salida) as mes, COUNT(*) as cantidad
        from ocupaciones as o
            inner join detalles_vuelos as dv on o.cve_detalles_vuelos=dv.cve_detalles_vuelos
            inner join clientes as c on o.cve_clientes=c.cve_clientes
            inner join municipios as m on c.cve_municipios = m.cve_municipios and c.cve_estados = m.cve_estados
            inner join estados as e on c.cve_estados=e.cve_estados
        group by month(dv.fecha_hora_salida), datename(month, dv.fecha_hora_salida)
        order by month(dv.fecha_hora_salida)
        ");
        $consultaCatorce = DB::select("
        Select top 10 with ties 
            m.nombre as municipio,
            e.nombre as estado, 
            COUNT(*) as cantidad 
        from ocupaciones as o
            inner join clientes as c on o.cve_clientes=c.cve_clientes
            inner join municipios as m on c.cve_municipios = m.cve_municipios and c.cve_estados = m.cve_estados
            inner join estados as e on c.cve_estados=e.cve_estados
        group by m.nombre, e.nombre
        order by COUNT(*) desc
        ");
        $consultaQuince = DB::select("
        Select top 10 with ties 
            m.nombre as municipio,
            e.nombre as estado, 
            COUNT(*) as cantidad
        from ocupaciones as o
            inner join clientes as c on o.cve_clientes=c.cve_clientes
            inner join municipios as m on c.cve_municipios = m.cve_municipios and c.cve_estados = m.cve_estados
            inner join estados as e on c.cve_estados=e.cve_estados
        group by m.nombre, e.nombre
        order by COUNT(*) asc
        ");
        $consultaDieciseis = DB::select("
        Select top 1 with ties
            a.nombre as aereopuerto,
            c.nombre as ciudad,
            p.nombre as pais,
            count(*) as cantidad
        from detalles_vuelos as dv
            inner join vuelos as v on dv.cve_vuelos=v.cve_vuelos
            inner join aeropuertos as a on v.cve_aeropuertos__origen=a.cve_aeropuertos
            inner join ciudades as c on a.cve_ciudades=c.cve_ciudades
            inner join paises as p on c.cve_paises=p.cve_paises
        group by a.nombre, c.nombre, p.nombre
        order by COUNT(*) asc
        ");

        return inertia('Graficas/Index', [
            'estados' => $estados,
            'consultaUno' => $consultaUno,
            'consultaDos' => $consultaDos,
            'consultaTres' => $consultaTres,
            'consultaTresEstado' => $consultaTresEstado,
            'consultaCuatro' => $consultaCuatro,
            'consultaCinco' => $consultaCinco,
            'consultaSeis' => $consultaSeis,
            'consultaSiete' => $consultaSiete,
            'consultaOcho' => $consultaOcho,
            'consultaNueve' => $consultaNueve,
            'consultaDiez' => $consultaDiez,
            'consultaOnce' => $consultaOnce,
            'consultaDoce' => $consultaDoce,
            'consultaTrece' => $consultaTrece,
            'consultaCatorce' => $consultaCatorce,
            'consultaQuince' => $consultaQuince,
            'consultaDieciseis' => $consultaDieciseis,
        ]);
    }

    public function firstQuery()
    {
        $consultaUno = DB::select("
        SELECT e.nombre AS estado, COUNT(*) AS cantidad
        FROM ocupaciones AS o
        INNER JOIN clientes AS c ON o.cve_clientes = c.cve_clientes
        INNER JOIN municipios AS m ON c.cve_municipios = m.cve_municipios AND c.cve_estados = m.cve_estados
        INNER JOIN estados AS e ON c.cve_estados = e.cve_estados
        GROUP BY e.nombre
        ORDER BY e.nombre
        ");

        return inertia('Graficas/ConsultaUno', [
            'consultaUno' => $consultaUno
        ]);
    }

    public function secondQuery()
    {
        $consultaDos = DB::select("
        Select e.nombre as estado, year(dv.fecha_hora_salida) as anio, COUNT(*) as cantidad
        from ocupaciones as o
        inner join detalles_vuelos as dv on o.cve_detalles_vuelos=dv.cve_detalles_vuelos
        inner join clientes as c on o.cve_clientes=c.cve_clientes
        inner join municipios as m on c.cve_municipios = m.cve_municipios and c.cve_estados = m.cve_estados
        inner join estados as e on c.cve_estados=e.cve_estados
        group by e.nombre, year(dv.fecha_hora_salida)
        order by e.nombre, year(dv.fecha_hora_salida)
        ");

        return inertia('Graficas/ConsultaDos', [
            'consultaDos' => $consultaDos
        ]);
    }

    public function thirdQuery(Request $request)
    {
        $consultaTresEstado = $request->query('estado', 'Tabasco'); // valor por defecto opcional

        $consultaTres = DB::select("
        SELECT m.nombre AS municipio, COUNT(*) AS cantidad
        FROM ocupaciones AS o
        INNER JOIN clientes AS c ON o.cve_clientes = c.cve_clientes
        INNER JOIN municipios AS m ON c.cve_municipios = m.cve_municipios AND c.cve_estados = m.cve_estados
        INNER JOIN estados AS e ON c.cve_estados = e.cve_estados
        WHERE e.nombre = ?
        GROUP BY m.nombre
        ORDER BY cantidad DESC
        ", [$consultaTresEstado]);

        $estados = Estado::get();

        return inertia('Graficas/ConsultaTres', [
            'estadosDisponibles' => $estados,
            'data' => $consultaTres,
            'estado' => $consultaTresEstado,
        ]);
    }
}
