package com.app.medicinaapp.vistas;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ImageButton;
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
import com.app.medicinaapp.MainActivity;
import com.app.medicinaapp.R;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.HashMap;
import java.util.List;
import java.util.Locale;
import java.util.Map;

public class PerfilActivity extends AppCompatActivity {
    EditText txtNombre, txtApellido, txtFechanac, txtCedula, txtProvincia, txtCiudad,
            txtDireccion, txtCelular, txtContrasenaactual, txtContrasenanueva1, txtContrasenanueva2;

    Button btnGuardarinfo, btnGuardarcontra;

    //VARIABLE QUE TRAE LA CEDULA
    List<String> informacion = new ArrayList<>();
    List<String> contrasena = new ArrayList<>();
    ApiUrl api = new ApiUrl();

    String cedula = null;
    ImageButton btnHome;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_perfil);

        txtNombre = (EditText) findViewById(R.id.txtNombre);
        txtApellido = (EditText) findViewById(R.id.txtApellido);
        txtFechanac = (EditText) findViewById(R.id.txtFechanac);
        txtCedula = (EditText) findViewById(R.id.txtCedula);
        txtProvincia = (EditText) findViewById(R.id.txtProvincia);
        txtCiudad = (EditText) findViewById(R.id.txtCiudad);
        txtDireccion = (EditText) findViewById(R.id.txtDireccion);
        txtCelular = (EditText) findViewById(R.id.txtCelular);

        btnGuardarinfo = (Button) findViewById(R.id.btnGuardarinfo);
        btnGuardarcontra = (Button) findViewById(R.id.btnguardarcontra);

        btnHome = (ImageButton) findViewById(R.id.btnHome);

        btnHome.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                onBackPressed();
            }
        });

        Intent intent = getIntent();
        cedula = intent.getStringExtra("cedula");
        MostrarInformacionPersonal(intent.getStringExtra("cedula"));
        GuardarInformacionPersonal();
        CambiarContraseña();
    }

    private void CambiarContraseña() {
        btnGuardarcontra.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent();
                intent.setAction(intent.ACTION_VIEW);
                intent.setData(Uri.parse("https://matricula.utp.ac.pa"));
                startActivity(intent);
            }
        });
    }

    private void MostrarInformacionPersonal(String ced) {
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(api.getBaseURL() + "InformacionPac.php?cedula=" + ced, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                try {
                    for (int i = 0; i < response.length(); i++) {
                        JSONObject jsonObject = response.getJSONObject(i);

                        informacion.add(jsonObject.getString("cedula"));
                        informacion.add(jsonObject.getString("nombre"));
                        informacion.add(jsonObject.getString("apellido"));
                        informacion.add(jsonObject.getString("fechaNacimiento"));
                        informacion.add(jsonObject.getString("celular"));
                        informacion.add(jsonObject.getString("provincia"));
                        informacion.add(jsonObject.getString("ciudad"));
                        informacion.add(jsonObject.getString("direccion"));
                    }

                    txtCedula.setText(informacion.get(0));
                    txtNombre.setText(informacion.get(1));
                    txtApellido.setText(informacion.get(2));
                    txtFechanac.setText(informacion.get(3));
                    txtCelular.setText(informacion.get(4));
                    txtProvincia.setText(informacion.get(5));
                    txtCiudad.setText(informacion.get(6));
                    txtDireccion.setText(informacion.get(7));

                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), "ERROR: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "Ocurrio un error al traer la informacion", Toast.LENGTH_SHORT).show();
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
                Toast.makeText(PerfilActivity.this, "VOLLEY RETRY ERROR: " + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        });

        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(jsonArrayRequest);
    }

    private void GuardarInformacionPersonal() {
        btnGuardarinfo.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                StringRequest stringRequest = new StringRequest(Request.Method.POST, api.getBaseURL() + "GuardarInformacionPac.php", new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Toast.makeText(getApplicationContext(), "Informacion personal actualizada", Toast.LENGTH_LONG).show();
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
                        parametros.put("celular", txtCelular.getText().toString());
                        parametros.put("provincia", txtProvincia.getText().toString());
                        parametros.put("ciudad", txtCiudad.getText().toString());
                        parametros.put("direccion", txtDireccion.getText().toString());
                        parametros.put("cedula", cedula);

                        return parametros;
                    }
                };
                RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
                requestQueue.add(stringRequest);
            }
        });
    }

    /*
    private void ValidarContrasena() {
        btnGuardarcontra.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                if (txtContrasenaactual.getText().toString().isEmpty() || txtContrasenanueva1.getText().toString().isEmpty() || txtContrasenanueva2.getText().toString().isEmpty()) {
                    Toast.makeText(PerfilActivity.this, "Debe llenar los campos", Toast.LENGTH_SHORT).show();
                } else {
                    if (txtContrasenanueva1.getText().toString().equals(txtContrasenanueva2.getText().toString())) {
                        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(api.getBaseURL() + "ValidarContrasena.php?cedula="+cedula+"&contrasena="+txtContrasenaactual.getText().toString(), new Response.Listener<JSONArray>() {
                            @Override
                            public void onResponse(JSONArray response) {
                                try {
                                    for (int i = 0; i < response.length(); i++) {
                                        JSONObject jsonObject = response.getJSONObject(i);

                                        contrasena.add(jsonObject.getString("cedula"));
                                    }
                                    CambiarContrasena(cedula, txtContrasenanueva1.getText().toString());
                                } catch (Exception e) {
                                    Toast.makeText(getApplicationContext(), "ERROR: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                                }
                            }
                        }, new Response.ErrorListener() {
                            @Override
                            public void onErrorResponse(VolleyError error) {
                                Toast.makeText(getApplicationContext(), "LA CONTRASEÑA ACTUAL ES INCORRECTA", Toast.LENGTH_SHORT).show();
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
                    } else {
                        Toast.makeText(PerfilActivity.this, "La nueva contraseña debe coincidir", Toast.LENGTH_SHORT).show();
                    }
                }
            }
        });
    }

    private void CambiarContrasena(String cedula, String pass) {
        StringRequest stringRequest = new StringRequest(Request.Method.POST, api.getBaseURL() + "CambiarContrasena.php", new Response.Listener<String>() {
            @Override
            public void onResponse(String response) {
                Toast.makeText(getApplicationContext(), "Contraseña actualizada", Toast.LENGTH_LONG).show();
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "ERROR UPDATE CONTRASEÑA" + error.getMessage(), Toast.LENGTH_SHORT).show();
            }
        }) {
            @Override
            public Map<String, String> getParams() throws AuthFailureError {
                Map<String, String> parametros = new HashMap<String, String>();
                parametros.put("cedula", cedula);
                parametros.put("contrasena", pass);

                return parametros;
            }
        };
        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(stringRequest);
    }
     */
}