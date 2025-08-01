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
            <table width="100%">
                <thead>
                    <tr>
                        <th style="text-align: left;">
                            <img src="{{ public_path('img/mpfn_encabezado.png') }}"  width="200">
                        </th>
                        <th style="text-align: right;">
                            <h6 class="cursiva">"Año de la recuperación y consolidación de la economía peruana"</h6>
                            <h6>GERENCIA DE LA OFICINA DE REDES Y COMUNICACIONES</h6>
                            <p></p>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>

        {{-- <hr> --}}
        
        <div class="content">

            <h3>CARTA DE RIESGO PARA USUARIOS FINALES
                <br>"SPIJ WEB - 2025"
            </h3>

            <div>
                <p><strong>IDENTIFICACIÓN:</strong></p>
                <p class="justificar">Yo  {{ $datos }} ,identificado con DNI N° {{ $dni }}, que ejerzo el cargo de {{ $cargo }}, en el Área de {{ $dependencia }}.</p>
                <p class="justificar">
                    DECLARO que me encuentro debidamente informado que al tener las licencias, compuesta por un código
                    de Usuario y Contraseña que me permite acceder al “SPIJ WEB”, Sistema Peruano de Información Jurídica
                    Web, del periodo 2025 para realizar las consultas sobre normas legales, jurisprudencia administrativa,
                    códigos, leyes orgánicas, directorio de asesorías jurídicas y otras informaciones de interés legal; a mérito
                    del “CONVENIO ESPECIFICO DE COOPERACION INTERINSTITUCIONAL ENTRE EL MINISTERIO DE
                    JUSTICIA Y DERECHOS HUMANOS Y EL MINISTERIO PÚBLICO”, suscrito el 10 de Mayo del 2022 y
                    aprobada mediante Resolución de la Fiscalía de la Nación N° 844-2022-MP-FN; asumo la responsabilidad
                    que pueda derivar por el mal uso de esta información.
                </p>
                <strong>OBLIGACIONES Y COMPROMISOS:</strong>
                <br>
                <ul class="justificar">
                    <li>No compartir las cuentas de usuario y contraseñas con personal ajenos a la institución.</li>
                    <li>No realizar captura –todo tipo- y/o exponer la información (impresión de pantalla, foto celular/Tablet/cámara digital y/o otra forma) de las cuentas asignadas.</li>
                    <li>No incurrir en tráfico / venta / comercialización de datos o información de las consultas realizadas a personas no autorizadas.</li>
                    <li>No cambiar las contraseñas asignadas, ya que no será responsabilidad del MINJUS ni de la Oficina de Redes y Comunicaciones.</li>
                </ul>

                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>

                <strong>RESPONSABILIDADES:</strong>
                <br>
                <ul>
                    <li>Afectar negativamente al Ministerio Público</li>
                    <li>Afectar negativamente los convenios interinstitucionales</li>
                </ul>

                <p><strong>DECLARACIÓN:</strong></p>
                <p class="justificar">
                    Comprendo las implicancias que pueden generar en caso de que se concrete el incumplimiento de algunas
                    de las obligaciones y/o compromisos.
                    Por mi cargo y funciones designados asumo la responsabilidad penal, civil y administrativa, por los
                    perjuicios, económicos, administrativos, legales, interrupción de los procesos, seguridad de la información,
                    deterioro de la imagen institucional y otras, que se generen como consecuencia de incurrir en
                    incumplimiento de las obligaciones y/o compromisos señalados, que afecten al Ministerio Público.
                </p>

                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>
                <p></p>

                <p><strong>Firma:</strong></p>
                <p><strong>Nombres y Apellidos:</strong> {{ $datos }}</p>
                <p><strong>DNI:</strong> {{ $dni }}</p>
                <p><strong>Lima:</strong> {{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
            </div>

        </div>
        <div class="footer">
            {{-- <table class="tabla-firma">
                <tbody>
                    <tr>
                        <td class="borde-superior">Entregué Conforme</td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td class="borde-superior">Recibí Conforme</td>
                    </tr>
                </tbody>
            </table> --}}
            {{-- <p></p>
            <hr>
            Ministerio Público - Fiscalía de Nación - Distrito Fiscal Junín --}}
        </div>
    </body>
</html>
