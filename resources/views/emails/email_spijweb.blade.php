<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>DFjunín: Correo Informática </title>
        <style>
            /* ======= TABLA ======= */
            .table {
                border: 1px solid black; 
                border-collapse: collapse; 
                width: 100%;
            }

            .table td {
                border: 1px solid black;
                font-size: 10px;
                padding: 8px;
            }
            .table th{
                background-color: rgb(207, 207, 209);
                border: 1px solid black;
                font-size: 11px;
                padding: 8px;
            }
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
            <table width="50%">
                <thead>
                    <tr>
                        <th style="text-align: left;">
                            <img src="https://www.ccpancash.org/images/news/u5OdLjPLDAQf5acRUXorl6nsF5Oo7H98sU4bpe8v.png"  width="200">
                        </th>
                        <th style="text-align: right;">
                            <br>"Año de la recuperación y consolidación de la economía peruana"
                            <br>OFICINA DE INFORMÁTICA DFJUNÍN
                            {{-- <br>OFICINA DE SOPORTE --}}
                        </th>
                    </tr>
                </thead>
            </table>
        </div>

        <hr>
        
        <div class="content">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2" class="text-center">INFORMACIÓN DEL USUARIO</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><strong>DNI:</strong></td>
                        <td>{{ $dni }}</td>
                    </tr>
                    <tr>
                        <td><strong>DATOS:</strong></td>
                        <td>{{ $datos }}</td>
                    </tr>
                    <tr>
                        <td><strong>SEDE:</strong></td>
                        <td>{{ $sede }}</td>
                    </tr>
                    <tr>
                        <td><strong>DEPENDENCIA:</strong></td>
                        <td>{{ $dependencia }}</td>
                    </tr>
                </tbody>
            </table> 
        </div>

        <hr>

        <div class="footer">
            <table>
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td></td>
                        <td>Ministerio Público - Fiscalía de Nación - Distrito Fiscal Junín - Oficina de Tecnologías de la Información</td>
                        <td></td>
                    </tr>
                </tbody>
            </table> 
        </div>
    </body>
</html>