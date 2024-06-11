# SAC
# Sistema de Administración Clínica (SAC)
Proyecto Universitario Sistema de Administración Clinica
Este es un proyecto semestral universitario para un Sistema de Administración Clínica (SAC). Consiste en una aplicación web y una aplicación móvil diseñadas para gestionar citas médicas y registros clínicos.

## Descripción del Proyecto
Aplicación web para el manejo del personal médico, tanto doctores como secretaria o enfermera, para llevar un control de las citas y el registro médico y aplicación móvil para agilizar el proceso de solicitud de una cita médica por parte de los usuarios y revisar su propio registro médico que ha llevado a cabo.

### Aplicación Web

La aplicación web está diseñada para el uso del personal médico (doctores, secretarias, enfermeras) y permite:

- Iniciar sesión.
- Ver las citas agendadas.
- Crear consultas (con y sin cita).
- Revisar el historial médico de los pacientes.

### Aplicación Móvil

La aplicación móvil está destinada a los usuarios/pacientes y permite:

- Iniciar sesión.
- Agendar citas médicas.
- Ver el historial de citas.
- Gestionar su perfil.
- Revisar su historial clínico.

## Imágenes de la Aplicación

### Aplicación Web

#### Pantalla de Inicio de Sesión
![Pantalla de Inicio de Sesión](imgREADME/login.png)

#### Pantalla de Página Principal
![Pantalla de Página Principal](imgREADME/principal.png)

#### Pantalla de Citas del doctor
![Pantalla de Citas del doctor](imgREADME/citas.png)

#### Pantalla de Consulta
![Pantalla de Consulta sin cita](imgREADME/consulta.png)

#### Pantalla de Historial Principal
![Pantalla de Historial Principal](imgREADME/historialA.png)

### Aplicación Móvil

#### Pantalla de Login
![Pantalla de Login](imgREADME/loginM.png)

#### Pantalla principal
![Pantalla principal](imgREADME/principalM.png)

#### Pantalla de Agendar cita
![Pantalla de Agendar cita](imgREADME/citaM.png)

#### Pantalla de Historial de Citas
![Pantalla de Historial de Citas](imgREADME/historialMC.png)

#### Pantalla de Historial Clinico
![Pantalla de Historial Clinico](imgREADME/historialM.png)

## Instalación y Uso

1. Clonar este repositorio:
   ```bash
   git clone https://github.com/<tu-usuario>/SAC-Project.git
2. Configurar la base de datos importando SAC completa.sql en tu servidor MySQL.

3. Configurar las constantes de base de datos en Config/config.php.

4. Levantar el servidor web para la aplicación web (e.g., XAMPP, WAMP).

5. Abrir Android Studio y cargar el proyecto móvil desde la carpeta MedicinaApp.

6. Ejecutar la aplicación móvil en un emulador o dispositivo físico.
