from django.db import models

class Alumno(models.Model):
    nombre = models.CharField(max_length=100)
    edad = models.IntegerField()
    correo = models.EmailField()
    direccion = models.CharField(max_length=200)
    telefono = models.CharField(max_length=15)
    fecha_inscripcion = models.DateField(auto_now_add=True)
    # Otros campos relevantes para el alumno

    def __str__(self):
        return self.nombre

class Clase(models.Model):
    nombre = models.CharField(max_length=100)
    descripcion = models.TextField()
    profesor = models.CharField(max_length=100)
    horario = models.CharField(max_length=50)
    sala = models.CharField(max_length=50)
    # Otros campos relevantes para la clase

    def __str__(self):
        return self.nombre

class Materia(models.Model):
    nombre = models.CharField(max_length=100)
    nivel = models.CharField(max_length=50)
    # Otros campos relevantes para la materia

    def __str__(self):
        return self.nombre

class Inscripcion(models.Model):
    alumno = models.ForeignKey(Alumno, on_delete=models.CASCADE)
    clase = models.ForeignKey(Clase, on_delete=models.CASCADE)
    materia = models.ForeignKey(Materia, on_delete=models.CASCADE)
    fecha_inscripcion = models.DateField(auto_now_add=True)
    estado_pago = models.BooleanField(default=False)
    # Otros campos relevantes para la inscripción

    def __str__(self):
        return f"{self.alumno} inscrito en {self.clase} para la materia {self.materia}"
