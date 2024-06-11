package com.app.medicinaapp;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.RetryPolicy;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.JsonArrayRequest;
import com.android.volley.toolbox.Volley;
import com.app.medicinaapp.vistas.PrincipalActivity;
import com.app.medicinaapp.vistas.RecuperarActivity;

import org.json.JSONArray;
import org.json.JSONObject;

import java.util.ArrayList;
import java.util.List;
import java.util.Locale;

public class MainActivity extends AppCompatActivity {
    //DECLARACION DE CONTROLES
    EditText txtCorreo, txtContra;
    Button btnEntrar;
    TextView linkRecuperar;

    //DECLARACION DE VARIABLES
    String BaseURL = "http://172.29.34.91/SAC/API_DS7/vistas/"; //cambiar 192.168.0.7 por la IP de su PC local (cmd->ipconfig->ipv4)

    //VARIABLE QUE TRAE LA CEDULA
    List<String> credenciales = new ArrayList<>();
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);

        //Metodo para inicializar controles
        InicializarControles();
        //Metodo para el boton de iniciar sesion
        IniciarSesion();
        //Metodo para ir a la pantalla de recuperar
        RecuperarUsuario();
    }

    private void InicializarControles() {
        txtCorreo = (EditText) findViewById(R.id.txtCorreo);
        txtContra = (EditText) findViewById(R.id.txtContra);
        btnEntrar = (Button) findViewById(R.id.btnEntrar);
        linkRecuperar = (TextView) findViewById(R.id.linkRecuperar);
    }

    private void IniciarSesion() {
        btnEntrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                String correo  = txtCorreo.getText().toString();
                String contrasena = txtContra.getText().toString();
                //Valido los datos e inicio sesion
                ValidarCredenciales(correo, contrasena);
            }
        });
    }

    //Valido los datos e inicio sesion
    private void ValidarCredenciales(String correo, String contrasena) {
        JsonArrayRequest jsonArrayRequest = new JsonArrayRequest(BaseURL + "ValidarSesion.php?correo="+correo+"&contrasena="+contrasena, new Response.Listener<JSONArray>() {
            @Override
            public void onResponse(JSONArray response) {
                try {
                    for (int i = 0; i < response.length(); i++) {
                        JSONObject jsonObject = response.getJSONObject(i);

                        credenciales.add(jsonObject.getString("cedula"));
                        credenciales.add(jsonObject.getString("nombre"));
                        credenciales.add(jsonObject.getString("apellido"));
                    }

                    Toast.makeText(MainActivity.this, "BIENVENIDO AL SISTEMA "+credenciales.get(1).toUpperCase(Locale.ROOT)+" "+credenciales.get(2).toUpperCase(Locale.ROOT), Toast.LENGTH_SHORT).show();
                    Intent intent = new Intent(MainActivity.this, PrincipalActivity.class);
                    intent.putExtra("cedula", credenciales.get(0));
                    intent.putExtra("nombre", credenciales.get(1));
                    intent.putExtra("apellido", credenciales.get(2));
                    startActivity(intent);
                } catch (Exception e) {
                    Toast.makeText(getApplicationContext(), "ERROR: " + e.getMessage(), Toast.LENGTH_SHORT).show();
                }
            }
        }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Toast.makeText(getApplicationContext(), "USUARIO Y CONTRASEÑA INCORRECTAS", Toast.LENGTH_SHORT).show();
                int x = 1;
            }
        });

        RequestQueue requestQueue = Volley.newRequestQueue(getApplicationContext());
        requestQueue.add(jsonArrayRequest);
    }

    private void RecuperarUsuario() {
        linkRecuperar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(view.getContext(), RecuperarActivity.class);
                startActivity(intent);
            }
        });
    }
}