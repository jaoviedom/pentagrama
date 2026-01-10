# 📘 Requerimientos del Sistema
## App Web Educativa Gamificada – Exploradores del Pentagrama

---

## 🎯 Objetivo del sistema
Permitir que niños de 9 a 11 años aprendan los nombres de las notas musicales en el pentagrama, en clave de sol y clave de fa, incluyendo notas dentro y fuera de las cinco líneas principales, mediante una experiencia gamificada, visual y progresiva, guardando su avance para continuar en sesiones posteriores.

---

# 🧩 ÉPICA 1 – Gestión de jugadores (cuentas infantiles)

## HU-01 Crear jugador infantil
**Como** niño jugador  
**Quiero** crear un perfil con un apodo y un avatar  
**Para** que el juego recuerde mi progreso

### Criterios de aceptación
- El sistema permite ingresar un apodo
- El sistema permite seleccionar un avatar
- No se solicita correo electrónico ni contraseña
- El jugador queda almacenado en la base de datos
- El sistema asigna una fecha de creación automáticamente

---

## HU-02 Acceder a un jugador existente
**Como** niño jugador  
**Quiero** seleccionar mi avatar  
**Para** entrar directamente a mi juego

### Criterios de aceptación
- Se muestra una lista de jugadores existentes
- Al tocar un avatar, el sistema inicia sesión
- El sistema registra la fecha de último acceso
- El jugador accede a su progreso guardado

---

## HU-03 Acceso con PIN opcional
**Como** niño jugador  
**Quiero** usar un PIN sencillo  
**Para** proteger mi progreso si comparto el dispositivo

### Criterios de aceptación
- El PIN es opcional
- El PIN es de 4 dígitos
- El PIN se valida antes de ingresar
- El PIN se almacena de forma segura (hash)

---

# 🗺️ ÉPICA 2 – Progresión por mundos y niveles

## HU-04 Ver mapa de niveles
**Como** jugador  
**Quiero** ver un mapa con los niveles  
**Para** saber qué he completado y qué sigue

### Criterios de aceptación
- El mapa muestra dos mundos: clave de sol y clave de fa
- Los niveles completados muestran estrellas
- Los niveles bloqueados no son accesibles
- El nivel actual se destaca visualmente

---

## HU-05 Desbloqueo automático de niveles
**Como** jugador  
**Quiero** que los niveles se desbloqueen automáticamente  
**Para** avanzar sin configuraciones manuales

### Criterios de aceptación
- Al completar un nivel, el siguiente se desbloquea
- El sistema guarda el avance automáticamente
- El progreso se conserva al cerrar la aplicación

---

# 🎼 ÉPICA 3 – Renderizado del pentagrama

## HU-06 Visualizar pentagrama interactivo
**Como** jugador  
**Quiero** ver un pentagrama grande y claro  
**Para** identificar visualmente las notas

### Criterios de aceptación
- El pentagrama ocupa la mayor parte de la pantalla
- Se muestra la clave correspondiente (sol o fa)
- El diseño es limpio y sin distracciones

---

## HU-07 Mostrar notas en líneas y espacios
**Como** jugador  
**Quiero** ver notas en líneas y espacios  
**Para** aprender su ubicación correctamente

### Criterios de aceptación
- Las notas se renderizan correctamente
- Se diferencian líneas y espacios
- El tamaño de la nota es adecuado para niños

---

## HU-08 Mostrar notas fuera del pentagrama
**Como** jugador  
**Quiero** ver notas fuera de las cinco líneas  
**Para** aprender a reconocer líneas adicionales

### Criterios de aceptación
- Las líneas adicionales se muestran siempre
- Las líneas adicionales se animan al aparecer
- Las líneas se iluminan una por una para facilitar el conteo
- Aplica tanto arriba como abajo del pentagrama

---

# 🎮 ÉPICA 4 – Minijuegos musicales

## HU-09 Identificar el nombre de la nota
**Como** jugador  
**Quiero** seleccionar el nombre correcto de una nota  
**Para** aprender cómo se llama

### Criterios de aceptación
- Se muestran opciones de respuesta claras
- Al acertar se muestra animación positiva
- Al fallar se permite reintentar
- Nunca se penaliza el error

---

## HU-10 Arrastrar y soltar notas
**Como** jugador  
**Quiero** arrastrar una nota hacia su nombre  
**Para** aprender jugando

### Criterios de aceptación
- La nota puede arrastrarse
- El sistema detecta la respuesta correcta
- Se muestra feedback visual inmediato

---

## HU-11 Identificar si la nota sube o baja
**Como** jugador  
**Quiero** saber si una nota sube o baja  
**Para** entender la secuencia musical

### Criterios de aceptación
- El sistema muestra dos opciones: subir o bajar
- El resultado se explica visualmente
- No se usa texto largo

---

## HU-12 Contar líneas adicionales
**Como** jugador  
**Quiero** contar líneas adicionales  
**Para** identificar notas fuera del pentagrama

### Criterios de aceptación
- Las líneas adicionales se iluminan una por una
- El ritmo es lento y comprensible
- El jugador puede tomarse su tiempo

---

# ⚡ ÉPICA 5 – Minijuego de velocidad

## HU-13 Juego contrarreloj
**Como** jugador  
**Quiero** responder rápido  
**Para** mejorar mi agilidad visual

### Criterios de aceptación
- El sistema muestra un temporizador
- Se cuentan rachas de aciertos
- Los errores no restan puntos
- El juego es opcional por nivel

---

# 🎁 ÉPICA 6 – Gamificación y recompensas

## HU-14 Recibir recompensas
**Como** jugador  
**Quiero** recibir premios visuales  
**Para** sentirme motivado a continuar

### Criterios de aceptación
- Se entregan medallas o stickers
- Se muestra una animación de celebración
- Las recompensas quedan guardadas

---

# 👦 ÉPICA 7 – Perfil del jugador

## HU-15 Ver mi progreso
**Como** jugador  
**Quiero** ver mi avance  
**Para** sentir orgullo de lo que he aprendido

### Criterios de aceptación
- Se muestra avatar y nombre
- Se muestran niveles completados
- Se muestran logros obtenidos

---

# ⏸️ ÉPICA 8 – Pausa y guardado automático

## HU-16 Salir sin perder progreso
**Como** jugador  
**Quiero** salir del juego sin perder lo que hice  
**Para** continuar luego

### Criterios de aceptación
- El sistema guarda automáticamente
- Se muestra un mensaje tranquilizador
- No existe botón manual de guardado

---

# 👨‍👩‍👧 ÉPICA 9 – Panel adulto / docente

## HU-17 Ver progreso de estudiantes
**Como** adulto o docente  
**Quiero** ver el progreso de los niños  
**Para** acompañar su aprendizaje

### Criterios de aceptación
- Acceso protegido por PIN
- Lista de jugadores
- Progreso por mundo y nivel

---

## HU-18 Identificar dificultades
**Como** docente  
**Quiero** saber qué notas fallan más  
**Para** reforzar esos contenidos

### Criterios de aceptación
- Se muestran estadísticas por nota
- Se muestran intentos y aciertos
- La información es clara y resumida

---

## 📌 Notas finales
- El sistema debe ser responsive
- Diseñado para tablets y computadores
- Enfoque lúdico, no académico tradicional
- Código mantenible y modular