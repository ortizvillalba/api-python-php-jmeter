from rest_framework.views import APIView
from rest_framework.response import Response
from rest_framework import status
from drf_yasg.utils import swagger_auto_schema
from .models import Clase, Materia, Inscripcion, Alumno
from .serializers import ClaseSerializer, MateriaSerializer, InscripcionSerializer, AlumnoSerializer
from drf_yasg import openapi

# ClaseListView, ClaseDetailView, ClaseCreateView, ClaseUpdateView, ClaseDeleteView
class ClaseListView(APIView):
    """
    Vista para listar todas las clases.
    """
    @swagger_auto_schema(
        operation_summary="Lista todas las clases",
        operation_description="Endpoint para obtener una lista de todas las clases.",
        responses={200: ClaseSerializer(many=True)}
    )
    def get(self, request):
        clases = Clase.objects.all()
        serializer = ClaseSerializer(clases, many=True)
        return Response(serializer.data)

class ClaseDetailView(APIView):
    """
    Vista para obtener detalles de una clase específica.
    """
    @swagger_auto_schema(
        operation_summary="Obtener detalles de una clase",
        operation_description="Endpoint para obtener detalles de una clase específica.",
        responses={200: ClaseSerializer(), 404: "Not Found"}
    )
    def get(self, request, pk):
        try:
            clase = Clase.objects.get(pk=pk)
            serializer = ClaseSerializer(clase)
            return Response(serializer.data)
        except Clase.DoesNotExist:
            return Response({"error": "La clase no existe"}, status=status.HTTP_404_NOT_FOUND)

class ClaseCreateView(APIView):
    """
    Vista para crear una nueva clase.
    """
    @swagger_auto_schema(
        operation_summary="Crear una nueva clase",
        operation_description="Endpoint para crear una nueva clase.",
        request_body=ClaseSerializer,
        responses={201: ClaseSerializer(), 400: "Bad Request"}
    )
    def post(self, request):
        serializer = ClaseSerializer(data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data, status=status.HTTP_201_CREATED)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

class ClaseUpdateView(APIView):
    """
    Vista para actualizar una clase existente.
    """
    @swagger_auto_schema(
        operation_summary="Actualizar una clase existente",
        operation_description="Endpoint para actualizar una clase existente.",
        request_body=ClaseSerializer,
        responses={200: ClaseSerializer(), 400: "Bad Request", 404: "Not Found"}
    )
    def put(self, request, pk):
        try:
            clase = Clase.objects.get(pk=pk)
        except Clase.DoesNotExist:
            return Response({"error": "La clase no existe"}, status=status.HTTP_404_NOT_FOUND)

        serializer = ClaseSerializer(clase, data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

class ClaseDeleteView(APIView):
    """
    Vista para eliminar una clase existente.
    """
    @swagger_auto_schema(
        operation_summary="Eliminar una clase existente",
        operation_description="Endpoint para eliminar una clase existente.",
        responses={204: "No Content", 404: "Not Found"}
    )
    def delete(self, request, pk):
        try:
            clase = Clase.objects.get(pk=pk)
        except Clase.DoesNotExist:
            return Response({"error": "La clase no existe"}, status=status.HTTP_404_NOT_FOUND)

        clase.delete()
        return Response(status=status.HTTP_204_NO_CONTENT)

# MateriaListView, MateriaDetailView, MateriaCreateView, MateriaUpdateView, MateriaDeleteView
class MateriaListView(APIView):
    """
    Vista para listar todas las materias.
    """
    @swagger_auto_schema(
        operation_summary="Lista todas las materias",
        operation_description="Endpoint para obtener una lista de todas las materias.",
        responses={200: MateriaSerializer(many=True)}
    )
    def get(self, request):
        materias = Materia.objects.all()
        serializer = MateriaSerializer(materias, many=True)
        return Response(serializer.data)

class MateriaDetailView(APIView):
    """
    Vista para obtener detalles de una materia específica.
    """
    @swagger_auto_schema(
        operation_summary="Obtener detalles de una materia",
        operation_description="Endpoint para obtener detalles de una materia específica.",
        responses={200: MateriaSerializer(), 404: "Not Found"}
    )
    def get(self, request, pk):
        try:
            materia = Materia.objects.get(pk=pk)
            serializer = MateriaSerializer(materia)
            return Response(serializer.data)
        except Materia.DoesNotExist:
            return Response({"error": "La materia no existe"}, status=status.HTTP_404_NOT_FOUND)

class MateriaCreateView(APIView):
    """
    Vista para crear una nueva materia.
    """
    @swagger_auto_schema(
        operation_summary="Crear una nueva materia",
        operation_description="Endpoint para crear una nueva materia.",
        request_body=MateriaSerializer,
        responses={201: MateriaSerializer(), 400: "Bad Request"}
    )
    def post(self, request):
        serializer = MateriaSerializer(data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data, status=status.HTTP_201_CREATED)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

class MateriaUpdateView(APIView):
    """
    Vista para actualizar una materia existente.
    """
    @swagger_auto_schema(
        operation_summary="Actualizar una materia existente",
        operation_description="Endpoint para actualizar una materia existente.",
        request_body=MateriaSerializer,
        responses={200: MateriaSerializer(), 400: "Bad Request", 404: "Not Found"}
    )
    def put(self, request, pk):
        try:
            materia = Materia.objects.get(pk=pk)
        except Materia.DoesNotExist:
            return Response({"error": "La materia no existe"}, status=status.HTTP_404_NOT_FOUND)

        serializer = MateriaSerializer(materia, data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

class MateriaDeleteView(APIView):
    """
    Vista para eliminar una materia existente.
    """
    @swagger_auto_schema(
        operation_summary="Eliminar una materia existente",
        operation_description="Endpoint para eliminar una materia existente.",
        responses={204: "No Content", 404: "Not Found"}
    )
    def delete(self, request, pk):
        try:
            materia = Materia.objects.get(pk=pk)
        except Materia.DoesNotExist:
            return Response({"error": "La materia no existe"}, status=status.HTTP_404_NOT_FOUND)

        materia.delete()
        return Response(status=status.HTTP_204_NO_CONTENT)
# InscripcionListView, InscripcionDetailView, InscripcionCreateView, InscripcionUpdateView, InscripcionDeleteView
class InscripcionListView(APIView):
    """
    Vista para listar todas las inscripciones.
    """
    @swagger_auto_schema(
        operation_summary="Lista todas las inscripciones",
        operation_description="Endpoint para obtener una lista de todas las inscripciones.",
        responses={200: InscripcionSerializer(many=True)}
    )
    def get(self, request):
        inscripciones = Inscripcion.objects.all()
        serializer = InscripcionSerializer(inscripciones, many=True)
        return Response(serializer.data)

class InscripcionDetailView(APIView):
    """
    Vista para obtener detalles de una inscripción específica.
    """
    @swagger_auto_schema(
        operation_summary="Obtener detalles de una inscripción",
        operation_description="Endpoint para obtener detalles de una inscripción específica.",
        responses={200: InscripcionSerializer(), 404: "Not Found"}
    )
    def get(self, request, pk):
        try:
            inscripcion = Inscripcion.objects.get(pk=pk)
            serializer = InscripcionSerializer(inscripcion)
            return Response(serializer.data)
        except Inscripcion.DoesNotExist:
            return Response({"error": "La inscripción no existe"}, status=status.HTTP_404_NOT_FOUND)

class InscripcionCreateView(APIView):
    """
    Vista para crear una nueva inscripción.
    """
    @swagger_auto_schema(
        operation_summary="Crear una nueva inscripción",
        operation_description="Endpoint para crear una nueva inscripción.",
        request_body=InscripcionSerializer,
        responses={201: InscripcionSerializer(), 400: "Bad Request"}
    )
    def post(self, request):
        serializer = InscripcionSerializer(data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data, status=status.HTTP_201_CREATED)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

class InscripcionUpdateView(APIView):
    """
    Vista para actualizar una inscripción existente.
    """
    @swagger_auto_schema(
        operation_summary="Actualizar una inscripción existente",
        operation_description="Endpoint para actualizar una inscripción existente.",
        request_body=InscripcionSerializer,
        responses={200: InscripcionSerializer(), 400: "Bad Request", 404: "Not Found"}
    )
    def put(self, request, pk):
        try:
            inscripcion = Inscripcion.objects.get(pk=pk)
        except Inscripcion.DoesNotExist:
            return Response({"error": "La inscripción no existe"}, status=status.HTTP_404_NOT_FOUND)

        serializer = InscripcionSerializer(inscripcion, data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)

class InscripcionDeleteView(APIView):
    """
    Vista para eliminar una inscripción existente.
    """
    @swagger_auto_schema(
        operation_summary="Eliminar una inscripción existente",
        operation_description="Endpoint para eliminar una inscripción existente.",
        responses={204: "No Content", 404: "Not Found"}
    )
    def delete(self, request, pk):
        try:
            inscripcion = Inscripcion.objects.get(pk=pk)
        except Inscripcion.DoesNotExist:
            return Response({"error": "La inscripción no existe"}, status=status.HTTP_404_NOT_FOUND)

        inscripcion.delete()
        return Response(status=status.HTTP_204_NO_CONTENT)

class AlumnoListView(APIView):
    """
    Vista para listar todos los alumnos.
    """
    @swagger_auto_schema(
        operation_summary="Lista todos los alumnos",
        operation_description="Endpoint para obtener una lista de todos los alumnos.",
        responses={200: AlumnoSerializer(many=True)}
    )
    def get(self, request):
        alumnos = Alumno.objects.all()
        serializer = AlumnoSerializer(alumnos, many=True)
        return Response(serializer.data)

class AlumnoDetailView(APIView):
    """
    Vista para obtener detalles de un alumno específico.
    """
    @swagger_auto_schema(
        operation_summary="Obtener detalles de un alumno",
        operation_description="Endpoint para obtener detalles de un alumno específico.",
        responses={200: AlumnoSerializer(), 404: "Not Found"}
    )
    def get(self, request, pk):
        try:
            alumno = Alumno.objects.get(pk=pk)
            serializer = AlumnoSerializer(alumno)
            return Response(serializer.data)
        except Alumno.DoesNotExist:
            return Response({"error": "El alumno no existe"}, status=status.HTTP_404_NOT_FOUND)

class AlumnoCreateView(APIView):
    """
    Vista para crear un nuevo alumno.
    """
    @swagger_auto_schema(
        operation_summary="Crear un nuevo alumno",
        operation_description="Endpoint para crear un nuevo alumno.",
        request_body=openapi.Schema(
            type=openapi.TYPE_OBJECT,
            required=['nombre', 'edad', 'correo', 'direccion', 'telefono'],
            properties={
                'nombre': openapi.Schema(type=openapi.TYPE_STRING, description='Nombre del alumno'),
                'edad': openapi.Schema(type=openapi.TYPE_INTEGER, description='Edad del alumno'),
                'correo': openapi.Schema(type=openapi.TYPE_STRING, description='Correo electrónico del alumno'),
                'direccion': openapi.Schema(type=openapi.TYPE_STRING, description='Dirección del alumno'),
                'telefono': openapi.Schema(type=openapi.TYPE_STRING, description='Número de teléfono del alumno'),
            },
        ),
        responses={201: AlumnoSerializer(), 400: "Bad Request"}
    )
    def post(self, request):
        serializer = AlumnoSerializer(data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data, status=status.HTTP_201_CREATED)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)


class AlumnoUpdateView(APIView):
    """
    Vista para actualizar un alumno existente.
    """
    @swagger_auto_schema(
        operation_summary="Actualizar un alumno existente",
        operation_description="Endpoint para actualizar un alumno existente.",
        request_body=AlumnoSerializer,
        responses={200: AlumnoSerializer(), 400: "Bad Request", 404: "Not Found"}
    )
    def put(self, request, pk):
        try:
            alumno = Alumno.objects.get(pk=pk)
        except Alumno.DoesNotExist:
            return Response({"error": "El alumno no existe"}, status=status.HTTP_404_NOT_FOUND)

        serializer = AlumnoSerializer(alumno, data=request.data)
        if serializer.is_valid():
            serializer.save()
            return Response(serializer.data)
        return Response(serializer.errors, status=status.HTTP_400_BAD_REQUEST)


class AlumnoDeleteView(APIView):
    """
    Vista para eliminar un alumno existente.
    """
    @swagger_auto_schema(
        operation_summary="Eliminar un alumno existente",
        operation_description="Endpoint para eliminar un alumno existente.",
        responses={204: "No Content", 404: "Not Found"}
    )
    def delete(self, request, pk):
        try:
            alumno = Alumno.objects.get(pk=pk)
        except Alumno.DoesNotExist:
            return Response({"error": "El alumno no existe"}, status=status.HTTP_404_NOT_FOUND)

        alumno.delete()
        return Response(status=status.HTTP_204_NO_CONTENT)

