# Banner API plugin

Este es un plugin sencillo para WordPress que permite gestionar de manera fácil y rápida las URL de imágenes a través del panel de administración. Las URLs de las imágenes pueden ser consultadas mediante un endpoint de la API REST, lo que lo hace ideal para sitios headless o para componentes del frontend que cambian con frecuencia y necesitan ser gestionados de forma eficiente por los usuarios.

## Características

1. Gestión de imágenes desde el panel de administración: Permite añadir y actualizar URLs de imágenes desde el área de administración de WordPress sin necesidad de editar código.
2. Acceso a través de una API REST: Expone un endpoint GET que devuelve las URLs de las imágenes configuradas, ideal para integraciones con aplicaciones frontend o sitios headless.
3. Fácil de integrar: Perfecto para proyectos donde se requieren cambios frecuentes en las imágenes (como banners, promociones, etc.) sin intervención técnica.

## Instalación
Instala el plugin subiendo el .zip del plugin desde el panel de administracion de wordpress -> plugins -> Añadir nuevo plugin

## Configuración
Una vez activado, aparecerá una opción en el menú de administración de WordPress para añadir las URLs de las imágenes del banner.

El endpoint estará disponible en la siguiente ruta:

https://tusitio.com/wp-json/banner-api/v1/banner/
Este endpoint devolverá un JSON con las URL de las imágenes configuradas.
