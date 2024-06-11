package com.app.medicinaapp.Adapter;

import android.content.Context;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ImageButton;
import android.widget.ImageView;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;
import androidx.appcompat.app.AlertDialog;

import com.app.medicinaapp.Model.HistorialCitasModel;
import com.app.medicinaapp.R;

import java.util.List;

public class HistorialCitaAdapter extends ArrayAdapter<HistorialCitasModel> {
    private List<HistorialCitasModel> informationList;
    Context context;

    public HistorialCitaAdapter(Context context, List<HistorialCitasModel> cardInformationList) {
        super(context, R.layout.historialcitas_template, cardInformationList);

        informationList = cardInformationList;
        this.context = context;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        LayoutInflater inflater = LayoutInflater.from(getContext());

        View item = inflater.inflate(R.layout.historialcitas_template, null);

        TextView estado = (TextView) item.findViewById(R.id.txtEstadocita);
        TextView nombre = (TextView) item.findViewById(R.id.txtNombrecita);
        TextView descripcion = (TextView) item.findViewById(R.id.txtDescripcioncita);
        TextView fecha = (TextView) item.findViewById(R.id.txtFechacita);
        TextView hora = (TextView) item.findViewById(R.id.txtHoracita);

        estado.setText("CITA " + informationList.get(position).getEstado());
        nombre.setText("Nombre del doctor: " + informationList.get(position).getNombre());
        descripcion.setText("Descripcion: " + informationList.get(position).getDescripcion());
        fecha.setText("Fecha de cita: " + informationList.get(position).getFecha());
        hora.setText("Hora de cita: " + informationList.get(position).getHora());

        if (informationList.get(position).getEstado().equals("PENDIENTE")) {
            estado.setTextColor(Color.parseColor("#00FF22"));
        } else {
            estado.setTextColor(Color.parseColor("#FF0000"));
        }

        return item;
    }
}
