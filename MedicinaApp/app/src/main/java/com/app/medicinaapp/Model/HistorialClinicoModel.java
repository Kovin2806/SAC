package com.app.medicinaapp.Model;

public class HistorialClinicoModel {
    private String nombre;
    private String cedula;
    private String fecha;

    private String notadoctor;
    private String receta;

    public HistorialClinicoModel(String nombre, String cedula, String fecha, String notadoctor, String receta) {
        this.nombre = nombre;
        this.cedula = cedula;
        this.fecha = fecha;
        this.notadoctor = notadoctor;
        this.receta = receta;
    }

    public String getNombre() {
        return nombre;
    }

    public void setNombre(String nombre) {
        this.nombre = nombre;
    }

    public String getCedula() {
        return cedula;
    }

    public void setCedula(String cedula) {
        this.cedula = cedula;
    }

    public String getFecha() {
        return fecha;
    }

    public void setFecha(String fecha) {
        this.fecha = fecha;
    }


    public String getNotadoctor() {
        return notadoctor;
    }

    public void setNotadoctor(String notadoctor) {
        this.notadoctor = notadoctor;
    }

    public String getReceta() {
        return receta;
    }

    public void setReceta(String receta) {
        this.receta = receta;
    }
}
