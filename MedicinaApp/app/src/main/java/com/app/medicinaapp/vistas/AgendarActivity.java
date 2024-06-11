package com.app.medicinaapp.vistas;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.EditText;
import android.widget.ImageButton;
import android.widget.Spinner;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.RetryPolicy;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.app.medicinaapp.ApiUrl;
import com.app.medicinaapp.Model.MedicoModel;
import com.app.medicinaapp.R;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.Date;
import java.util.HashMap;
import java.util.List;
import java.util.Map;

public class AgendarActivity extends AppCompatActivity {
    Spinner spinHora, spinMedico;
    EditText txtDescripcion;
    DatePicker spinFecha;
    Button btnGuardarcita;
    ImageButton btnHome;

    String cedula = null;
    String cedulaD = null;

    List<String> listHora = new ArrayList<>();
    List<MedicoModel> listMedico = new ArrayList<>();
    List<String> listMedico2 = new ArrayList<>();

    ApiUrl api = new ApiUrl();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_agendar);

        spinFecha = (DatePicker) findViewById(R.id.spinFecha);
        txtDescripcion = (EditText) findViewById(R.id.txtDescripcion);
        spinHora = (Spinner) findViewById(R.id.spinHora);
        spinMedico = (Spinner) findViewById(R.id.spinMedico);
        btnGuardarcita = (Button) findViewById(R.id.btnGuardarcita);
        btnHome = (ImageButton) findViewById(R.id.btnHome);

        btnHome.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onBackPressed();
            }
        });

        listHora.add("09:00 AM - 10:00 AM");
        listHora.add("10:00 PM - 11:00 AM");
        listHora.add("11:00 AM - 12:00 PM");
        listHora.add("13:00 PM - 14:00 PM");
        listHora.add("14:00 PM - 15:00 PM");
        listHora.add("15:00 PM - 16:00 PM");
        spinHora.setAdapter(new ArrayAdapter<String>(getApplicationContext(), R.layout.simple_spinner, listHora));

        Intent intent = getIntent();
        cedula = intent.getStringExtra("cedula");
        AgendarCita(cedula);
        ObtenerMedicos();
        ObtenerCedulaMedico();
    }

    private void AgendarCita(String cedula) {
        btnGuardarcita.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if(txtDescripcion.getText().toString().isEmpty()){
                    Toast.makeText(AgendarActivity.this, "Debe llenar todos los campos", Toast.LENGTH_SHORT).show();
                }else{
                    StringRequest stringRequest = new StringRequest(Request.Method.POST, api.getBaseURL() + "AgregarCita.php", new Response.Listener<String>() {
                        @Override
                        public void onResponse(String response) {
                            Toast.makeText(getApplicationContext(), "Cita agendada con exito", Toast.LENGTH_LONG).show();
                        }
                    }, new Response.ErrorListener() {
                        @Override
                        public void onErrorResponse(VolleyError error) {
                            Toast.makeText(getApplicationContext(), "ERROR UPDATE INFORMACION" + error.getMessage(), Toast.LENGTH_SHORT).show();
                        }
                    }) {
                        @Override
                        public Map<String, String> getParams() throws AuthFailureError {
                            Map<String, String> parametros = new HashMap<String, String>();
                            parametros.put("cedulaP", cedula);
                            parametros.put("cedulaD", cedulaD);
                            parametros.put("descripcion", txtDescripcion.getText().toString());
                            parametros.put("fechaCita", spinFecha.getYear()+"-"+spinFecha.getMonth()+"-"+spinFecha.getDayOfMonth());
                            parametros.put("horaCita", spinHora.getSelectedItem().toString());

                            return parametros;
                        }
                    };
                    RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
                    requestQueue.add(stringRequest);
                }
            }
        });
    }

    private void ObtenerMedicos() {
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(api.getBaseURL() + "MostrarMedicos.php", new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                try {
                    for (int i = 0; i < response.length(); i++) {
                        JSONObject jsonObject = response.getJSONObject(i);

                        listMedico.add(new MedicoModel(jsonObject.getString("cedula"), jsonObject.getString("nombre")));
                        listMedico2.add(jsonObject.getString("nombre") + " " + jsonObject.getString("apellido"));
                    }
                    spinMedico.setAdapter(new ArrayAdapter<String>(getApplicationContext(), R.layout.simple_spinner, listMedico2));
                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), "ERROR: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "VOLLEY ERROR: " + error.getMessage(), Toast.LENGTH_SHORT).show();
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
                Toast.makeText(getApplicationContext(), "VOLLEY RETRY ERROR: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(jsonArrayRequest);
    }

    private void ObtenerCedulaMedico(){
        spinMedico.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> adapterView, View view, int i, long l) {
                cedulaD = listMedico.get(i).getCedula();
            }

            @Override
            public void onNothingSelected(AdapterView<?> adapterView) {

            }
        });
    }
}