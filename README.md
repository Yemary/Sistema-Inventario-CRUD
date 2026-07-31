# Sistema de Inventario - CRUD + Git Flow
Proyecto académico que implementa un gestor de inventario complete siguiendo el flujo de trabajo Git Flow.

## Funcionalidades
- Crear nuevos productos
- Listar todos los productos registrados
- Editar y actualizar datos de productos
- Eliminar productos
- Cálculo automático de resumen: total de productos, unidades y valor total de inventario

## Estructura de archivos
| Archivo | Descripción |
|---|---|
| registrar.php | Formulario para agregar productos |
| listar.php | Visualización de todos los productos |
| editar.php | Modificación de datos existentes |
| eliminar.php | Eliminación de registros |
| calcular_stock.php | Cálculos y resumen general |

## Flujo Git Flow utilizado
- main: Versión final en producción
- dev: Rama principal de desarrollo
- qa: Rama de control de calidad y pruebas
- Ramas de características: feature/*
- Ramas de correcciones: hotfix/*

## Requisitos
- Servidor local (XAMPP, WAMP o similar)
- Base de datos MySQL con nombre inventario_db
- PHP 7.0 o superior