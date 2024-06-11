package com.app.medicinaapp.vistas;

import androidx.appcompat.app.AppCompatActivity;

import android.annotation.SuppressLint;
import android.content.Intent;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.app.medicinaapp.MainActivity;
import com.app.medicinaapp.R;

import java.util.Locale;

public class PrincipalActivity extends AppCompatActivity {
    TextView lblBienvenido;
    ImageButton btnAgendar, btnHistorialCitas, btnPerfil, btnCerrar, btnHistorialClinico;

    String cedula = null;

    @SuppressLint("SetTextI18n")
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_principal);

        lblBienvenido = (TextView) findViewById(R.id.lblBienvenido);
        btnAgendar = (ImageButton) findViewById(R.id.btnAgendar);
        btnHistorialCitas = (ImageButton) findViewById(R.id.btnHistorial);
        btnPerfil = (ImageButton) findViewById(R.id.btnPerfil);
        btnCerrar = (ImageButton) findViewById(R.id.btnCerrar);
        btnHistorialClinico = (ImageButton) findViewById(R.id.btnHistorialMedico);

        Intent intent = getIntent();
        cedula = intent.getStringExtra("cedula");
        lblBienvenido.setText("BIENVENIDO " +
                intent.getStringExtra("nombre").toUpperCase(Locale.ROOT) +
                " " +intent.getStringExtra("apellido").toUpperCase(Locale.ROOT));

        CerrarSesion();
        AgendarCita();
        VerPerfil();
        VerHistorialCitas();
        VerHistorialClinico();
    }

    private void VerHistorialClinico() {
        btnHistorialClinico.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(PrincipalActivity.this, HistorialclinicoActivity.class);
                intent.putExtra("cedula", cedula);
                startActivity(intent);
            }
        });
    }

    private void VerHistorialCitas() {
        btnHistorialCitas.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(PrincipalActivity.this, HistorialcitasActivity.class);
                intent.putExtra("cedula", cedula);
                startActivity(intent);
            }
        });
    }

    private void AgendarCita() {
        btnAgendar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(PrincipalActivity.this, AgendarActivity.class);
                intent.putExtra("cedula", cedula);
                startActivity(intent);
            }
        });
    }

    private void VerPerfil() {
        btnPerfil.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(PrincipalActivity.this, PerfilActivity.class);
                intent.putExtra("cedula", cedula);
                startActivity(intent);
            }
        });
    }

    private void CerrarSesion() {
        btnCerrar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Toast.makeText(PrincipalActivity.this, "Adios, Vuelva pronto", Toast.LENGTH_SHORT).show();
                finish();
                Intent intent = new Intent(PrincipalActivity.this, MainActivity.class);
                startActivity(intent);
            }
        });
    }

    //Evita salir del programa sin cerrar sesion
    @Override
    public void onBackPressed() {

    }
}