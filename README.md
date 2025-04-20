<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

## 📂 Navegación rápida

- [📘 Manual de Usuario](./Manual_de_usuario.md)
- [🛠 Instalación](#https://github.com/JhinFz/RebretecApp?tab=readme-ov-file#%EF%B8%8F-instalaci%C3%B3n)
- [🚀 Uso](#https://github.com/JhinFz/RebretecApp?tab=readme-ov-file#%EF%B8%8F-uso)

## 📌 RebretecAPP

RebretecAPP es una aplicación web basada en Laravel 10 que permite gestionar las solicitudes del servicio de mantenimiento de la organización REBRETEC.

## 🚀 Funcionalidades principales

- Enviar y recibir solicitudes de mantenimiento para instituciones educativas del cantón morona.
- Verificar el estado de atención de una solicitud enviada (aprobada/en proceso/rechazada)
- Asignar personal técnico para la atención de una solicitud.
- Administrar la información de usuario del personal técnico.
- Registrar las actividades de diagnóstico y mantenimiento para cada dispositivo identificado en una solicitud.
- Realizar un seguimiento del actividades que se registren en cada evento de atención.
- Generación de reportes de actividades para cada rol de usuario.

## ⚙️ Instalación

### Requisitos previos

Instalar Composer, Node.js y XAMPP (MySQL y Apache)

### Procedimiento

1. Mediante terminal, clonar el repositorio y seleccionarlo (debe estar dentro de la carpeta htdocs de XAMPP)

```shell
git clone https://github.com/JhinFz/RebretecApp.git
```
```shell
cd RebretecAPP
```

2. Configurar archivo `.env`:
   
Laravel ya trae uno, solo asegúrese de configurar las siguientes variables para conexión con la base de datos:

- `DB_DATABASE`

- `DB_USERNAME`

- `DB_PASSWORD`

3. Ejecutar la migración de la estructura de la base de datos mediante:

```shell
php artisan migrate
```

Si desea migrar los datos de prueba de la aplicación, ejecutar:

```shell
php artisan migrate --seed
```

## ▶️ Uso

- Ejecutar el servicio de MySQL y Apache mediante XAMPP.

Alternativa a Apache:

```shell
php artisan serve
```

📌 Levanta un servidor web local para que puedas ejecutar y probar tu aplicación Laravel en tu navegador.

## 🛠 Tecnologías principales

- Node.js
- Composer
- PHP
- Blade

Paquetes utilizados:

- `"barryvdh/laravel-dompdf": "^2.0"`
- `"guzzlehttp/guzzle": "^7.2"`
- `"jeroennoten/laravel-adminlte": "^3.9"`
- `"laravel/framework": "^10.10"`
- `"laravel/jetstream": "^3.2"`
- `"laravel/sanctum": "^3.2"`
- `"laravelcollective/html": "^6.4"`
- `"livewire/livewire": "^2.11"`
- `"spatie/laravel-permission": "^6.10"`
- `"itsgoingd/clockwork": "^5.3"`

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
