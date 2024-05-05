from django.urls import path
from . import views

urlpatterns = [
    path('alumnos/', views.AlumnoListView.as_view(), name='alumno_list'),
    path('alumnos/<int:pk>/', views.AlumnoDetailView.as_view(), name='alumno_detail'),
    path('alumnos/create/', views.AlumnoCreateView.as_view(), name='alumno_create'),
    path('alumnos/<int:pk>/update/', views.AlumnoUpdateView.as_view(), name='alumno_update'),
    path('alumnos/<int:pk>/delete/', views.AlumnoDeleteView.as_view(), name='alumno_delete'),

    path('clases/', views.ClaseListView.as_view(), name='clase_list'),  # Corregido aquí
    path('clases/<int:pk>/', views.ClaseDetailView.as_view(), name='clase_detail'),
    path('clases/create/', views.ClaseCreateView.as_view(), name='clase_create'),
    path('clases/<int:pk>/update/', views.ClaseUpdateView.as_view(), name='clase_update'),
    path('clases/<int:pk>/delete/', views.ClaseDeleteView.as_view(), name='clase_delete'),

    path('materias/', views.MateriaListView.as_view(), name='materia_list'),
    path('materias/<int:pk>/', views.MateriaDetailView.as_view(), name='materia_detail'),
    path('materias/create/', views.MateriaCreateView.as_view(), name='materia_create'),
    path('materias/<int:pk>/update/', views.MateriaUpdateView.as_view(), name='materia_update'),
    path('materias/<int:pk>/delete/', views.MateriaDeleteView.as_view(), name='materia_delete'),

    path('inscripciones/', views.InscripcionListView.as_view(), name='inscripcion_list'),
    path('inscripciones/<int:pk>/', views.InscripcionDetailView.as_view(), name='inscripcion_detail'),
    path('inscripciones/create/', views.InscripcionCreateView.as_view(), name='inscripcion_create'),
    path('inscripciones/<int:pk>/update/', views.InscripcionUpdateView.as_view(), name='inscripcion_update'),
    path('inscripciones/<int:pk>/delete/', views.InscripcionDeleteView.as_view(), name='inscripcion_delete'),
]
