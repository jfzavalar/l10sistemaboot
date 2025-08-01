<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Acta de entrega</title>
        <style>
            @import url('./css/body.css');
            @import url('./css/pagina.css');
            @import url('./css/tabla.css');
            /* @import url('./css/text.css'); */
        </style>
        <style>
            .justificar {
                text-align: justify;
            }
            .cursiva {
                font-style: italic;
            }
            .negrita {
                font-weight: bold;
            }
        </style>
    </head>
    <body>
        <div class="header">
            <table class="tabla-firma" width="100%">
                <thead>
                    <tr>
                        <th style="text-align: left;">
                            <img src="{{ public_path('img/mpfn_encabezado.png') }}"  width="200">
                        </th>
                        <th style="text-align: right;">
                            <br>"Año de la recuperación y consolidación de la economía peruana"
                            <br>GERENCIA CENTRAL DE TECNOLOGÍA DE LA INFORMACIÓN
                            <br>OFICINA DE SOPORTE
                        </th>
                    </tr>
                </thead>
            </table>
        </div>

        {{-- <hr> --}}
        
        <div class="content">
            <h3>ACTA DE  {{ $instanciaTbl->asignacion }} - TOKEN USB</h3>
            <h5>PERSONAL&nbsp;: {{ $instanciaTbl->datos }}</h5>
            <h5>DNI&nbsp;: {{ $instanciaTbl->dni }}</h5>
            <h5>SEDE: {{ $instanciaTbl->sede }}</h5>
            <h5>DEPENDENCIA: {{ $instanciaTbl->dependencia }}</h5>
            <h5>CARGO: {{ $instanciaTbl->cargo }}</h5>
            <h5>REGIMEN: {{ $instanciaTbl->regimen }}</h5>
            <h4>El {{ date('d/m/Y') }}, la Oficina de Informática del Distrito Fiscal de Junín, registra la {{ $instanciaTbl->asignacion }} de un TOKEN USB</h4>
            <h5>Detalles del bien:</h5>
            <table class="tabla">
                <thead>
                    <tr>
                        <th>N°</th>
                        <th>DESCRIPCIÓN</th>
                        <th>MARCA</th>
                        {{-- <th>ASIGNACIÓN</th> --}}
                        <th>ESTADO</th>
                        <th>CANTIDAD</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td>TOKEN</td>
                        <td>CryptoIDE</td>
                        {{-- <td></td> --}}
                        <td>BUENO</td>
                        <td>1</td>
                    </tr>
                </tbody>
            </table>
            <h5>
                Se precisa, que se debe dar estricto cumplimiento de la Resolución de la Gerencia General N° 1537-2014-MP-FN-GG, “Reglamento Interno para el Acceso y Uso de las Herramientas y Servicios Informáticos en el Ministerio Publico”, para el cuidado y uso de los bienes de la entidad.
            </h5>

            <h6>
                Observación: 
                <br>En caso que cese sus funciones, sírvase a realizar la Transferencia del dispositivo a su sucesor o lo contrario, realizar la devolución en las Oficinas de Soporte Técnico, ubicado en el quinto piso de la Av. Isabel Flores de Oliva 3ra-cdra. Urbanización Sala, El Tambo Huancayo.
            </h6>
        </div>
        <div class="footer">
            <table class="tabla-firma">
                <tbody>
                    <tr>
                        @if ( $instanciaTbl->asignacion === "ASIGNACION")
                            <td class="borde-superior">Entregué Conforme<br>CARHUAMACA VILCHEZ DENIS<br>DNI : 10708588</td>
                        @else
                            <td class="borde-superior">Entregué Conforme<br>{{ $instanciaTbl->datos }}<br>{{ $instanciaTbl->dni }}</td>
                        @endif
                        <td></td>
                        <td></td>
                        <td></td>
                        @if ( $instanciaTbl->asignacion === "DEVOLUCION")
                            <td class="borde-superior">Recibí Conforme<br>CARHUAMACA VILCHEZ DENIS<br>DNI : 10708588</td>    
                        @else
                            <td class="borde-superior">RecibíConforme<br>{{ $instanciaTbl->datos }}<br>{{ $instanciaTbl->dni }}</td>
                        @endif
                    </tr>
                </tbody>
            </table>

            <p></p>
            <hr>
            Ministerio Público - Fiscalía de Nación - Distrito Fiscal Junín
        </div>
    </body>
</html>
