# 🚌 BusChile - Sistema de Reservas de Autobuses

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white)
![Bootstrap](https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white)
![License](https://img.shields.io/badge/License-MIT-green.svg?style=for-the-badge)

## 📋 Descripción

BusChile es un sistema completo de reservas de autobuses desarrollado en PHP puro con arquitectura MVC. Permite a los usuarios buscar viajes, seleccionar asientos y realizar reservas de manera intuitiva, mientras que los administradores pueden gestionar destinos, horarios, buses y reservas desde un panel de control.

## ✨ Características Principales

### Para Usuarios
- 🔍 **Búsqueda de Viajes**: Buscar por origen, destino y fecha
- 🪑 **Selección de Asientos**: Mapa visual interactivo del bus
- 📧 **Confirmación por Email**: Detalles de la reserva enviados automáticamente
- 💰 **Precios Transparentes**: Visualización clara de tarifas
- 📱 **Diseño Responsivo**: Compatible con dispositivos móviles

### Para Administradores
- 🏢 **Panel de Control**: Dashboard con estadísticas en tiempo real
- 🚌 **Gestión de Buses**: Configuración de asientos y capacidad
- 📍 **Gestión de Destinos**: Rutas, precios y duración de viajes
- ⏰ **Gestión de Horarios**: Programación de salidas y llegadas
- 📊 **Gestión de Reservas**: Visualización y administración de reservas
- 🔐 **Sistema de Autenticación**: Login seguro para administradores

## 🛠️ Tecnologías Utilizadas

- **Backend**: PHP 7.4+
- **Base de Datos**: MySQL 5.7+
- **Frontend**: HTML5, CSS3, JavaScript
- **Framework CSS**: Bootstrap 5
- **Iconos**: Font Awesome
- **Arquitectura**: MVC (Modelo-Vista-Controlador)

## 📁 Estructura del Proyecto

```
conduc/
├── config/
│   └── database.php          # Configuración de base de datos
├── controllers/
│   ├── AdminController.php   # Controlador del panel administrativo
│   ├── HomeController.php    # Controlador de la página principal
│   └── ReservationController.php # Controlador de reservas
├── database/
│   └── schema.sql            # Esquema de base de datos
├── models/
│   ├── Admin.php             # Modelo de administradores
│   ├── Bus.php               # Modelo de buses
│   ├── Destination.php       # Modelo de destinos
│   ├── Reservation.php       # Modelo de reservas
│   └── Schedule.php          # Modelo de horarios
├── views/
│   ├── admin/                # Vistas del panel administrativo
│   ├── reservation/          # Vistas de reservas
│   ├── home.php              # Página principal
│   └── layout.php            # Layout principal
└── index.php                 # Punto de entrada de la aplicación
```

## 🚀 Instalación

### Prerrequisitos
- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- Composer (opcional)

### Pasos de Instalación

1. **Clonar el repositorio**
   ```bash
   git clone https://github.com/tu-usuario/buschile.git
   cd buschile
   ```

2. **Configurar la base de datos**
   - Crear una base de datos MySQL
   - Importar el archivo `database/schema.sql`
   - Actualizar las credenciales en `config/database.php`

3. **Configurar el servidor web**
   - Apuntar el document root a la carpeta del proyecto
   - Asegurar que PHP tenga permisos de escritura

4. **Acceder a la aplicación**
   - Usuario: `http://tu-dominio.com`
   - Admin: `http://tu-dominio.com/index.php?controller=admin`

### Credenciales por Defecto
- **Usuario**: admin
- **Contraseña**: password

## 🗄️ Base de Datos

El sistema utiliza las siguientes tablas principales:

- **admins**: Usuarios administradores
- **destinations**: Rutas disponibles con precios
- **buses**: Configuración de vehículos y asientos
- **schedules**: Horarios de salida y llegada
- **reservations**: Reservas realizadas por usuarios

## 🎯 Funcionalidades Detalladas

### Sistema de Reservas
1. **Búsqueda**: Los usuarios seleccionan origen, destino y fecha
2. **Selección**: Visualización de horarios disponibles con precios
3. **Asientos**: Mapa interactivo del bus para elegir asiento
4. **Confirmación**: Formulario con datos del pasajero
5. **Validación**: Verificación de disponibilidad en tiempo real

### Panel Administrativo
- **Dashboard**: Estadísticas de reservas, ingresos y ocupación
- **CRUD Completo**: Para destinos, buses, horarios y reservas
- **Reportes**: Visualización de datos en tiempo real
- **Seguridad**: Sistema de autenticación con sesiones

## 🔧 Configuración

### Base de Datos
Editar `config/database.php`:
```php
private $host = 'localhost';
private $db_name = 'tu_base_de_datos';
private $username = 'tu_usuario';
private $password = 'tu_contraseña';
```

### Personalización
- **Colores**: Modificar variables CSS en los archivos de vista
- **Logo**: Reemplazar imágenes en la carpeta de assets
- **Textos**: Editar directamente en las vistas PHP

## 🤝 Contribuir

1. Fork el proyecto
2. Crear una rama para tu feature (`git checkout -b feature/AmazingFeature`)
3. Commit tus cambios (`git commit -m 'Add some AmazingFeature'`)
4. Push a la rama (`git push origin feature/AmazingFeature`)
5. Abrir un Pull Request

## 📝 Roadmap

- [ ] Sistema de pagos en línea
- [ ] Notificaciones push
- [ ] API REST
- [ ] App móvil
- [ ] Sistema de puntos/fidelización
- [ ] Integración con mapas
- [ ] Reportes avanzados
- [ ] Multi-idioma

## 🐛 Reportar Bugs

Si encuentras algún error, por favor:
1. Verifica que no haya sido reportado anteriormente
2. Crea un issue detallado con pasos para reproducir el error
3. Incluye información del entorno (PHP version, MySQL version, etc.)

## 📄 Licencia

Este proyecto está bajo la Licencia MIT - ver el archivo [LICENSE](LICENSE) para más detalles.

## 👨‍💻 Autor

**Francisco** - *Desarrollo inicial* - [Tu GitHub](https://github.com/ranserott)

## 🙏 Agradecimientos

- Bootstrap por el framework CSS
- Font Awesome por los iconos
- La comunidad PHP por las mejores prácticas
- Todos los contribuidores del proyecto

---

⭐ **¡Si te gusta este proyecto, dale una estrella!** ⭐

📧 **Contacto**: francisco.cerda.escobar@gmail.com

🌐 **Demo**: [Ver demo en vivo](https://bytea.cl/portafolio/conduc/index.php)
