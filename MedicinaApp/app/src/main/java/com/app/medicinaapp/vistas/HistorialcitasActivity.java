package com.app.medicinaapp.vistas;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;
import android.widget.ListView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.RetryPolicy;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.app.medicinaapp.Adapter.HistorialCitaAdapter;
import com.app.medicinaapp.ApiUrl;
import com.app.medicinaapp.Model.HistorialCitasModel;
import com.app.medicinaapp.R;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;

public class HistorialcitasActivity extends AppCompatActivity {

    ListView lstHistorialcita;
    List<HistorialCitasModel> informacion = new ArrayList<>();
    String cedula;
    ApiUrl api  = new ApiUrl();
    HistorialCitaAdapter historialCitaAdapter;
    ImageButton btnHome;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_historialcitas);

        btnHome = (ImageButton) findViewById(R.id.btnHome);

        btnHome.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onBackPressed();
            }
        });

        lstHistorialcita = (ListView) findViewById(R.id.lstHistorial);

        Intent intent = getIntent();
        cedula = intent.getStringExtra("cedula");

        InformacionHistorialcitas(cedula);
    }

    private void InformacionHistorialcitas(String cedula) {
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(api.getBaseURL() + "HistorialCitas.php?cedulaP=" + cedula, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                try {
                    for (int i = 0; i < response.length(); i++) {
                        JSONObject jsonObject = response.getJSONObject(i);

                        informacion.add(new HistorialCitasModel(jsonObject.getString("Estado"),
                                jsonObject.getString("NombreDoctor"),jsonObject.getString("Descripcion"),
                                jsonObject.getString("Fecha"), jsonObject.getString("Hora")));
                    }

                    historialCitaAdapter = new HistorialCitaAdapter(getApplicationContext(), informacion);
                    lstHistorialcita.setAdapter(historialCitaAdapter);
                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), "ERROR: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "No tiene historial de citas", Toast.LENGTH_SHORT).show();
            }
        });

        jsonArrayRequest.setRetryPolicy(new RetryPolicy() {
            @Override
            public int getCurrentTimeout() {
                return 50000;
            }

            @Override
            public int getCurrentRetryCount() {
                return 50000;
            }

            @Override
            public void retry(VolleyError error) throws VolleyError {
                Toast.makeText(HistorialcitasActivity.this, "VOLLEY RETRY ERROR: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(jsonArrayRequest);
    }
}