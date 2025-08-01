<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>DFjunín: Correo Informática</title>
    <style>
        .table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        .table td, .table th {
            border: 1px solid black;
            font-size: 12px;
            padding: 6px;
        }
        .table th {
            background-color: #e1e1e1;
            text-align: left;
        }
        .justificar {
            text-align: justify;
        }
        .cursiva {
            font-style: italic;
        }
        .negrita {
            font-weight: bold;
        }
        .header, .footer {
            margin-bottom: 20px;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>

    <div class="header">
        <table width="100%">
            <tr>
                <td width="50%">
                    <img src="https://www.ccpancash.org/images/news/u5OdLjPLDAQf5acRUXorl6nsF5Oo7H98sU4bpe8v.png" width="180">
                </td>
                <td width="50%" style="text-align: right; font-size: 12px;">
                    "Año de la recuperación y consolidación de la economía peruana"<br>
                    <strong>OFICINA DE INFORMÁTICA DFJUNÍN</strong>
                </td>
            </tr>
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
                    <td><strong>DNI: </strong></td>
                    <td>{{ $dni }}</td>
                </tr>
                <tr>
                    <td><strong>DATOS: </strong></td>
                    <td>{{ $datos }}</td>
                </tr>
                <tr>
                    <td><strong>SEDE: </strong></td>
                    <td>{{ $sede }}</td>
                </tr>
                <tr>
                    <td><strong>DEPENDENCIA: </strong></td>
                    <td>{{ $dependencia }}</td>
                </tr>
                <tr>
                    <th colspan="2" class="text-center">CREDENCIALES DEL SPIJWEB</th>
                </tr>
                <tr>
                    <td><strong>USUARIO: </strong></td>
                    <td>{{ $usuariospijweb }}</td>
                </tr>
                <tr>
                    <td><strong>CONTRASEÑA: </strong></td>
                    <td>{{ $passwordspijweb }}</td>
                </tr>
                <tr>
                    <td><strong>ENLACE WEB: </strong></td>
                    <td>https://spij.minjus.gob.pe/spij-ext-web/#/inicio</td>
                </tr>
            </tbody>
        </table>
    </div>

    <hr>

    <div class="footer">
        <p style="font-size: 11px; text-align: center; color: #333;">
            Ministerio Público - Fiscalía de la Nación - Distrito Fiscal Junín
            <br>Oficina de Tecnologías de la Información
        </p>
    </div>

</body>
</html>
