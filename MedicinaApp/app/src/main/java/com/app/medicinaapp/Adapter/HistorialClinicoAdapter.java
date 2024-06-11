package com.app.medicinaapp.Adapter;

import android.content.Context;
import android.graphics.Color;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.TextView;

import androidx.annotation.NonNull;
import androidx.annotation.Nullable;

import com.app.medicinaapp.Model.HistorialClinicoModel;
import com.app.medicinaapp.R;

import java.util.List;

public class HistorialClinicoAdapter extends ArrayAdapter<HistorialClinicoModel> {
    private List<HistorialClinicoModel> informationList;
    Context context;

    public HistorialClinicoAdapter(Context context, List<HistorialClinicoModel> cardInformationList) {
        super(context, R.layout.historialclinico_template, cardInformationList);

        informationList = cardInformationList;
        this.context = context;
    }

    @NonNull
    @Override
    public View getView(int position, @Nullable View convertView, @NonNull ViewGroup parent) {
        LayoutInflater inflater = LayoutInflater.from(getContext());

        View item = inflater.inflate(R.layout.historialclinico_template, null);

        TextView fecha = (TextView) item.findViewById(R.id.txtFechaclinico);
        TextView motivo = (TextView) item.findViewById(R.id.txtMotivoclinico);
        TextView nota = (TextView) item.findViewById(R.id.txtNotaclinico);
        TextView receta = (TextView) item.findViewById(R.id.txtRecetaclinico);

        fecha.setText("Fecha: " + informationList.get(position).getFecha());
        nota.setText("Nota del doctor: " + informationList.get(position).getNotadoctor());
        receta.setText("Receta: " + informationList.get(position).getReceta());

        return item;
    }
}
