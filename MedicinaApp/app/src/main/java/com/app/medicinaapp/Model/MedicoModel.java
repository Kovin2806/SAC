package com.app.medicinaapp.Model;

public class MedicoModel {
    private String cedula;
    private String medico;

    public MedicoModel(String cedula, String medico) {
        this.cedula = cedula;
        this.medico = medico;
    }

    public String getCedula() {
        return cedula;
    }

    public void setCedula(String cedula) {
        this.cedula = cedula;
    }

    public String getMedico() {
        return medico;
    }

    public void setMedico(String medico) {
        this.medico = medico;
    }
}
