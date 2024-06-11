package com.app.medicinaapp.vistas;

import androidx.appcompat.app.AppCompatActivity;

import android.content.Intent;
import android.net.Uri;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;

import com.app.medicinaapp.MainActivity;
import com.app.medicinaapp.R;

public class RecuperarActivity extends AppCompatActivity {

    //DECLARACION DE CONTROLES
    Button btnInicio;
    Button btnRecuperar;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_recuperar);

        InicializarControles();
        Volver();
        Recuperar();
    }

    private void Recuperar() {
        btnRecuperar.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent();
                intent.setAction(intent.ACTION_VIEW);
                intent.setData(Uri.parse("https://matricula.utp.ac.pa/solpwd/cuenta/reset/2022/84909f0HJI5RSedQbbOn3O$G5HaP3bggFBGKHF12UFQ2JEhY"));
                startActivity(intent);
            }
        });
    }

    private void InicializarControles() {
        btnInicio = (Button) findViewById(R.id.btnInicio);
        btnRecuperar = (Button) findViewById(R.id.btnRecuperar);
    }

    private void Volver() {
        btnInicio.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(RecuperarActivity.this, MainActivity.class);
                startActivity(intent);
            }
        });
    }
}