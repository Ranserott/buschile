# 🤝 Guía de Contribución - BusChile

¡Gracias por tu interés en contribuir a BusChile! Este documento te guiará a través del proceso de contribución.

## 📋 Tabla de Contenidos

- [Código de Conducta](#código-de-conducta)
- [¿Cómo puedo contribuir?](#cómo-puedo-contribuir)
- [Configuración del Entorno de Desarrollo](#configuración-del-entorno-de-desarrollo)
- [Proceso de Contribución](#proceso-de-contribución)
- [Estándares de Código](#estándares-de-código)
- [Reportar Bugs](#reportar-bugs)
- [Solicitar Nuevas Características](#solicitar-nuevas-características)

## 📜 Código de Conducta

Este proyecto se adhiere a un código de conducta. Al participar, se espera que mantengas este código. Por favor reporta comportamientos inaceptables.

## 🛠️ ¿Cómo puedo contribuir?

Hay muchas formas de contribuir a BusChile:

- 🐛 **Reportar bugs**
- 💡 **Sugerir nuevas características**
- 📝 **Mejorar la documentación**
- 🔧 **Escribir código**
- 🧪 **Escribir pruebas**
- 🎨 **Mejorar el diseño UI/UX**

## 🚀 Configuración del Entorno de Desarrollo

### Prerrequisitos

- PHP 7.4 o superior
- MySQL 5.7 o superior
- Servidor web (Apache/Nginx)
- Git

### Configuración

1. **Fork el repositorio**
   ```bash
   # Haz fork del repositorio en GitHub, luego clona tu fork
   git clone https://github.com/TU_USUARIO/buschile.git
   cd buschile
   ```

2. **Configura el upstream**
   ```bash
   git remote add upstream https://github.com/Ranserott/buschile.git
   ```

3. **Configura la base de datos**
   ```bash
   # Copia el archivo de configuración de ejemplo
   cp config/database.example.php config/database.php
   
   # Edita config/database.php con tus credenciales
   # Importa database/schema.sql a tu base de datos MySQL
   ```

4. **Verifica que todo funcione**
   - Accede a la aplicación en tu navegador
   - Prueba el login de administrador (admin/password)

## 🔄 Proceso de Contribución

### Para Cambios Menores (documentación, pequeños fixes)

1. **Crea una rama**
   ```bash
   git checkout -b fix/descripcion-corta
   ```

2. **Realiza tus cambios**
   - Mantén los commits pequeños y enfocados
   - Escribe mensajes de commit descriptivos

3. **Envía un Pull Request**
   - Describe claramente qué cambios realizaste
   - Referencia cualquier issue relacionado

### Para Cambios Mayores (nuevas características)

1. **Abre un Issue primero**
   - Describe la característica que quieres agregar
   - Discute la implementación con los mantenedores

2. **Espera aprobación**
   - Los mantenedores revisarán y aprobarán la propuesta

3. **Sigue el proceso normal**
   - Crea una rama feature/nombre-caracteristica
   - Desarrolla la característica
   - Envía el Pull Request

## 📏 Estándares de Código

### PHP

- Sigue PSR-12 para el estilo de código
- Usa nombres descriptivos para variables y funciones
- Comenta código complejo
- Usa type hints cuando sea posible

```php
// ✅ Bueno
public function createReservation(int $scheduleId, string $customerName): bool
{
    // Lógica clara y comentada
    return $this->reservationModel->create($scheduleId, $customerName);
}

// ❌ Malo
function cr($s, $n) {
    return $this->rm->c($s, $n);
}
```

### HTML/CSS

- Usa indentación consistente (4 espacios)
- Nombres de clases descriptivos
- Mantén la estructura semántica

### JavaScript

- Usa ES6+ cuando sea posible
- Nombres de variables en camelCase
- Funciones pequeñas y enfocadas

### Base de Datos

- Nombres de tablas en plural y snake_case
- Nombres de columnas descriptivos
- Siempre incluye timestamps (created_at, updated_at)

## 🐛 Reportar Bugs

Antes de reportar un bug:

1. **Busca issues existentes** para evitar duplicados
2. **Reproduce el bug** en la última versión
3. **Recopila información**:
   - Versión de PHP
   - Versión de MySQL
   - Navegador y versión
   - Pasos para reproducir
   - Comportamiento esperado vs actual

### Template para Bug Reports

```markdown
**Descripción del Bug**
Descripción clara y concisa del bug.

**Pasos para Reproducir**
1. Ve a '...'
2. Haz clic en '...'
3. Desplázate hacia '...'
4. Ve el error

**Comportamiento Esperado**
Descripción de lo que esperabas que pasara.

**Screenshots**
Si aplica, agrega screenshots para ayudar a explicar el problema.

**Información del Entorno**
- OS: [ej. iOS]
- Navegador: [ej. chrome, safari]
- Versión: [ej. 22]
- PHP: [ej. 7.4]
- MySQL: [ej. 5.7]
```

## 💡 Solicitar Nuevas Características

Para solicitar una nueva característica:

1. **Verifica que no exista** una solicitud similar
2. **Describe el problema** que resuelve la característica
3. **Propón una solución** detallada
4. **Considera alternativas** y menciónalas

### Template para Feature Requests

```markdown
**¿Tu solicitud está relacionada con un problema?**
Descripción clara del problema. Ej. "Estoy frustrado cuando..."

**Describe la solución que te gustaría**
Descripción clara de lo que quieres que pase.

**Describe alternativas que has considerado**
Descripción de soluciones o características alternativas.

**Contexto adicional**
Agrega cualquier otro contexto o screenshots sobre la solicitud.
```

## 🔍 Proceso de Revisión

1. **Revisión automática**: Los tests y linters se ejecutan automáticamente
2. **Revisión por pares**: Al menos un mantenedor revisará tu código
3. **Feedback**: Podrías recibir comentarios para mejorar
4. **Aprobación**: Una vez aprobado, tu PR será merged

## 📝 Mensajes de Commit

Usa mensajes de commit descriptivos:

```bash
# ✅ Bueno
git commit -m "feat: agregar validación de asientos duplicados"
git commit -m "fix: corregir error en cálculo de precios"
git commit -m "docs: actualizar README con instrucciones de instalación"

# ❌ Malo
git commit -m "fix"
git commit -m "cambios"
git commit -m "wip"
```

### Prefijos Recomendados

- `feat:` Nueva característica
- `fix:` Corrección de bug
- `docs:` Cambios en documentación
- `style:` Cambios de formato (no afectan funcionalidad)
- `refactor:` Refactorización de código
- `test:` Agregar o modificar tests
- `chore:` Tareas de mantenimiento

## 🎉 Reconocimiento

Todos los contribuidores serán reconocidos en:

- El archivo README.md
- Las notas de release
- La página de contribuidores del proyecto

## 📞 ¿Necesitas Ayuda?

Si tienes preguntas:

1. Revisa la documentación existente
2. Busca en issues cerrados
3. Abre un nuevo issue con la etiqueta "question"
4. Contacta a los mantenedores

---

¡Gracias por contribuir a BusChile! 🚌✨
