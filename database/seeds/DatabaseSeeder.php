<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Limpiar tablas para evitar duplicados en re-seed
        // El orden importa al limpiar debido a las FKs
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('sesion_bloque')->truncate();
        DB::table('entrenamiento')->truncate();
        DB::table('componentes_bicicleta')->truncate();
        DB::table('sesion_entrenamiento')->truncate();
        DB::table('bloque_entrenamiento')->truncate();
        DB::table('plan_entrenamiento')->truncate();
        DB::table('historico_ciclista')->truncate();
        DB::table('bicicleta')->truncate();
        DB::table('tipo_componente')->truncate();
        DB::table('ciclista')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // 1. Ciclistas
        DB::table('ciclista')->insert([
            ['nombre' => 'Juan', 'apellidos' => 'Pérez', 'fecha_nacimiento' => '1990-05-10', 'peso_base' => 70.5, 'altura_base' => 175, 'email' => 'test1@prueba.com', 'password' => Hash::make('prueba')],
            ['nombre' => 'Ana', 'apellidos' => 'Rodríguez', 'fecha_nacimiento' => '1992-08-20', 'peso_base' => 60.0, 'altura_base' => 165, 'email' => 'test2@prueba.com', 'password' => Hash::make('prueba')],
            ['nombre' => 'Pedro', 'apellidos' => 'García', 'fecha_nacimiento' => '1995-03-15', 'peso_base' => 80.0, 'altura_base' => 180, 'email' => 'test3@prueba.com', 'password' => Hash::make('prueba')],
            ['nombre' => 'Carmen', 'apellidos' => 'García', 'fecha_nacimiento' => '1998-09-05', 'peso_base' => 55.0, 'altura_base' => 160, 'email' => 'test4@prueba.com', 'password' => Hash::make('prueba')],
            ['nombre' => 'Luis', 'apellidos' => 'Rodríguez', 'fecha_nacimiento' => '1972-09-15', 'peso_base' => 62.0, 'altura_base' => 170, 'email' => 'test5@prueba.com', 'password' => Hash::make('prueba')],
            ['nombre' => 'Maria', 'apellidos' => 'Rodríguez', 'fecha_nacimiento' => '1972-09-15', 'peso_base' => 62.0, 'altura_base' => 170, 'email' => 'test6@prueba.com', 'password' => Hash::make('prueba')],
            ['nombre' => 'Ricardo', 'apellidos' => 'García', 'fecha_nacimiento' => '1982-09-15', 'peso_base' => 72.0, 'altura_base' => 170, 'email' => 'test7@prueba.com', 'password' => Hash::make('prueba')],
            ['nombre' => 'user', 'apellidos' => 'test', 'fecha_nacimiento' => '1990-01-01', 'peso_base' => NULL, 'altura_base' => NULL, 'email' => 'test@test.com', 'password' => Hash::make('12345678')],
        ]);

        // 2. Histórico
        DB::table('historico_ciclista')->insert([
            ['id_ciclista' => 1, 'fecha' => '2026-01-01', 'peso' => 72.5, 'ftp' => 280, 'pulso_max' => 185, 'pulso_reposo' => 48, 'potencia_max' => 1050, 'grasa_corporal' => 14.5, 'vo2max' => 62.3, 'comentario' => 'Inicio de temporada'],
            ['id_ciclista' => 1, 'fecha' => '2026-02-01', 'peso' => 71.8, 'ftp' => 290, 'pulso_max' => 185, 'pulso_reposo' => 46, 'potencia_max' => 1100, 'grasa_corporal' => 14.0, 'vo2max' => 63.5, 'comentario' => 'Mejora tras bloque base'],
            ['id_ciclista' => 1, 'fecha' => '2026-03-01', 'peso' => 70.9, 'ftp' => 300, 'pulso_max' => 186, 'pulso_reposo' => 45, 'potencia_max' => 1150, 'grasa_corporal' => 13.6, 'vo2max' => 65.0, 'comentario' => 'Pico de forma'],
            ['id_ciclista' => 2, 'fecha' => '2026-01-15', 'peso' => 78.2, 'ftp' => 250, 'pulso_max' => 180, 'pulso_reposo' => 52, 'potencia_max' => 980, 'grasa_corporal' => 16.8, 'vo2max' => 58.0, 'comentario' => 'Inicio plan umbral'],
            ['id_ciclista' => 2, 'fecha' => '2026-02-15', 'peso' => 77.5, 'ftp' => 265, 'pulso_max' => 181, 'pulso_reposo' => 50, 'potencia_max' => 1020, 'grasa_corporal' => 16.0, 'vo2max' => 59.5, 'comentario' => 'Mejora progresiva'],
        ]);

        // 3. Planes
        DB::table('plan_entrenamiento')->insert([
            ['id_ciclista' => 1, 'nombre' => 'Plan Base Aeróbica 2026', 'descripcion' => 'Mejora de resistencia y base aeróbica', 'fecha_inicio' => '2026-01-01', 'fecha_fin' => '2026-03-31', 'objetivo' => 'Base aeróbica', 'activo' => 1],
            ['id_ciclista' => 2, 'nombre' => 'Plan Umbral 2026', 'descripcion' => 'Trabajo de umbral y sweet spot', 'fecha_inicio' => '2026-01-15', 'fecha_fin' => '2026-04-15', 'objetivo' => 'Mejorar FTP', 'activo' => 1],
        ]);

        // 4. Bloques
        DB::table('bloque_entrenamiento')->insert([
            ['nombre' => 'Calentamiento', 'descripcion' => 'Rodaje suave progresivo', 'tipo' => 'rodaje', 'duracion_estimada' => '00:15:00', 'potencia_pct_min' => 55.0, 'potencia_pct_max' => 65.0, 'pulso_pct_max' => 70.0, 'pulso_reserva_pct' => 50.0, 'comentario' => 'Subir pulsaciones gradualmente'],
            ['nombre' => 'Rodaje Z2', 'descripcion' => 'Resistencia aeróbica', 'tipo' => 'rodaje', 'duracion_estimada' => '01:00:00', 'potencia_pct_min' => 65.0, 'potencia_pct_max' => 75.0, 'pulso_pct_max' => 80.0, 'pulso_reserva_pct' => 65.0, 'comentario' => 'Base aeróbica'],
            ['nombre' => 'Sweet Spot 8 min', 'descripcion' => 'Intervalos Sweet Spot', 'tipo' => 'intervalos', 'duracion_estimada' => '00:08:00', 'potencia_pct_min' => 88.0, 'potencia_pct_max' => 94.0, 'pulso_pct_max' => 90.0, 'pulso_reserva_pct' => 80.0, 'comentario' => 'Trabajo de umbral submáximo'],
            ['nombre' => 'Recuperación', 'descripcion' => 'Pedaleo muy suave', 'tipo' => 'recuperacion', 'duracion_estimada' => '00:05:00', 'potencia_pct_min' => 45.0, 'potencia_pct_max' => 55.0, 'pulso_pct_max' => 65.0, 'pulso_reserva_pct' => 45.0, 'comentario' => 'Eliminar fatiga'],
            ['nombre' => 'Enfriamiento', 'descripcion' => 'Vuelta a la calma', 'tipo' => 'recuperacion', 'duracion_estimada' => '00:10:00', 'potencia_pct_min' => 50.0, 'potencia_pct_max' => 60.0, 'pulso_pct_max' => 70.0, 'pulso_reserva_pct' => 50.0, 'comentario' => 'Normalizar pulsaciones'],
        ]);

        // 5. Sesiones
        DB::table('sesion_entrenamiento')->insert([
            ['id_plan' => 1, 'fecha' => '2026-01-03', 'nombre' => 'Rodaje aeróbico', 'descripcion' => 'Sesión continua de resistencia', 'completada' => 1],
            ['id_plan' => 1, 'fecha' => '2026-01-05', 'nombre' => 'Sweet Spot corto', 'descripcion' => 'Intervalos controlados', 'completada' => 1],
            ['id_plan' => 2, 'fecha' => '2026-01-20', 'nombre' => 'Sweet Spot progresivo', 'descripcion' => 'Trabajo de umbral', 'completada' => 0],
        ]);

        // 6. Sesión-Bloque
        DB::table('sesion_bloque')->insert([
            ['id_sesion_entrenamiento' => 1, 'id_bloque_entrenamiento' => 1, 'orden' => 1, 'repeticiones' => 1],
            ['id_sesion_entrenamiento' => 1, 'id_bloque_entrenamiento' => 2, 'orden' => 2, 'repeticiones' => 1],
            ['id_sesion_entrenamiento' => 1, 'id_bloque_entrenamiento' => 5, 'orden' => 3, 'repeticiones' => 1],
            ['id_sesion_entrenamiento' => 2, 'id_bloque_entrenamiento' => 1, 'orden' => 1, 'repeticiones' => 1],
            ['id_sesion_entrenamiento' => 2, 'id_bloque_entrenamiento' => 3, 'orden' => 2, 'repeticiones' => 4],
            ['id_sesion_entrenamiento' => 2, 'id_bloque_entrenamiento' => 4, 'orden' => 3, 'repeticiones' => 3],
            ['id_sesion_entrenamiento' => 2, 'id_bloque_entrenamiento' => 5, 'orden' => 4, 'repeticiones' => 1],
        ]);

        // 7. Tipos Componente
        DB::table('tipo_componente')->insert([
            ['nombre' => 'Cadena', 'descripcion' => 'Cadena de la bicicleta'],
            ['nombre' => 'Bielas', 'descripcion' => 'Bielas del pedalier'],
            ['nombre' => 'Pedales', 'descripcion' => 'Pedales de la bicicleta'],
            ['nombre' => 'Ruedas', 'descripcion' => 'Juego de ruedas completo'],
            ['nombre' => 'Sillín', 'descripcion' => 'Sillín o asiento'],
            ['nombre' => 'Manillar', 'descripcion' => 'Manillar y potencia'],
            ['nombre' => 'Cassette', 'descripcion' => 'Piñón o conjunto de piñones trasero'],
        ]);

        // 8. Bicicletas
        DB::table('bicicleta')->insert([
            ['nombre' => 'Tacx NEO2', 'tipo' => 'rodillo', 'comentario' => 'Rodillo inteligente'],
            ['nombre' => 'Stevens A', 'tipo' => 'carretera', 'comentario' => 'Carretera de entrenamiento'],
            ['nombre' => 'Stevens B', 'tipo' => 'carretera', 'comentario' => 'Carretera competición'],
            ['nombre' => 'Kuota', 'tipo' => 'carretera', 'comentario' => 'Carretera ligera'],
            ['nombre' => 'MTB', 'tipo' => 'mtb', 'comentario' => 'Mountain bike estándar'],
            ['nombre' => 'MTB Electrica', 'tipo' => 'mtb', 'comentario' => 'Mountain bike eléctrica'],
        ]);

        // 9. Componentes Bicicleta
        DB::table('componentes_bicicleta')->insert([
            // Tacx NEO2 (Bici 1)
            ['id_bicicleta' => 1, 'id_tipo_componente' => 1, 'marca' => 'Shimano', 'modelo' => 'XT', 'especificacion' => NULL, 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 5000, 'activo' => 1],
            ['id_bicicleta' => 1, 'id_tipo_componente' => 7, 'marca' => 'Shimano', 'modelo' => 'XT', 'especificacion' => '11-28', 'velocidad' => '11v', 'posicion' => 'trasera', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 15000, 'activo' => 1],
            ['id_bicicleta' => 1, 'id_tipo_componente' => 4, 'marca' => 'Tacx', 'modelo' => 'NeoWheel', 'especificacion' => NULL, 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 20000, 'activo' => 1],

            // Stevens A (Bici 2)
            ['id_bicicleta' => 2, 'id_tipo_componente' => 1, 'marca' => 'Shimano', 'modelo' => 'Durace', 'especificacion' => NULL, 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 4000, 'activo' => 1],
            ['id_bicicleta' => 2, 'id_tipo_componente' => 7, 'marca' => 'Shimano', 'modelo' => 'Durace', 'especificacion' => '11-25', 'velocidad' => '11v', 'posicion' => 'trasera', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 12000, 'activo' => 1],
            ['id_bicicleta' => 2, 'id_tipo_componente' => 4, 'marca' => 'Campagnolo', 'modelo' => 'Shamal', 'especificacion' => '700c', 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 20000, 'activo' => 1],

            // Stevens B (Bici 3)
            ['id_bicicleta' => 3, 'id_tipo_componente' => 1, 'marca' => 'Shimano', 'modelo' => 'Durace', 'especificacion' => NULL, 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 4000, 'activo' => 1],
            ['id_bicicleta' => 3, 'id_tipo_componente' => 7, 'marca' => 'Shimano', 'modelo' => 'Durace', 'especificacion' => '11-28', 'velocidad' => '11v', 'posicion' => 'trasera', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 12000, 'activo' => 1],
            ['id_bicicleta' => 3, 'id_tipo_componente' => 4, 'marca' => 'Velozer', 'modelo' => 'Tubular', 'especificacion' => '700c', 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 20000, 'activo' => 1],

            // Kuota (Bici 4)
            ['id_bicicleta' => 4, 'id_tipo_componente' => 1, 'marca' => 'Shimano', 'modelo' => 'Tiagra', 'especificacion' => NULL, 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 3500, 'activo' => 1],
            ['id_bicicleta' => 4, 'id_tipo_componente' => 7, 'marca' => 'Shimano', 'modelo' => 'Tiagra', 'especificacion' => '12-28', 'velocidad' => '10v', 'posicion' => 'trasera', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 10000, 'activo' => 1],
            ['id_bicicleta' => 4, 'id_tipo_componente' => 4, 'marca' => 'Mavic', 'modelo' => 'Ksyrium', 'especificacion' => '700c', 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 20000, 'activo' => 1],

            // MTB y Electrica (Bici 5 y 6)
            ['id_bicicleta' => 5, 'id_tipo_componente' => 1, 'marca' => 'Shimano', 'modelo' => 'Alivio', 'especificacion' => NULL, 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 3000, 'activo' => 1],
            ['id_bicicleta' => 5, 'id_tipo_componente' => 7, 'marca' => 'Shimano', 'modelo' => 'Alivio', 'especificacion' => '32-12', 'velocidad' => '9v', 'posicion' => 'trasera', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 10000, 'activo' => 1],
            ['id_bicicleta' => 5, 'id_tipo_componente' => 4, 'marca' => 'Diamondback', 'modelo' => '26', 'especificacion' => '26', 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 20000, 'activo' => 1],
            ['id_bicicleta' => 6, 'id_tipo_componente' => 1, 'marca' => 'Shimano', 'modelo' => 'Alivio', 'especificacion' => NULL, 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 3000, 'activo' => 1],
            ['id_bicicleta' => 6, 'id_tipo_componente' => 7, 'marca' => 'Shimano', 'modelo' => 'Alivio', 'especificacion' => '32-12', 'velocidad' => '9v', 'posicion' => 'trasera', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 10000, 'activo' => 1],
            ['id_bicicleta' => 6, 'id_tipo_componente' => 4, 'marca' => 'Diamondback', 'modelo' => '26', 'especificacion' => '26', 'velocidad' => NULL, 'posicion' => 'ambas', 'fecha_montaje' => '2026-01-01', 'km_actuales' => 0, 'km_max_recomendado' => 20000, 'activo' => 1],
        ]);

        // 10. Entrenamientos
        DB::table('entrenamiento')->insert([
            [
                'id_ciclista' => 1,
                'id_bicicleta' => 1,
                'fecha' => '2026-01-01 07:30:00',
                'duracion' => '01:45:00',
                'kilometros' => 55.2,
                'recorrido' => 'Ruta Valle',
                'pulso_medio' => 140,
                'pulso_max' => 170,
                'potencia_media' => 200,
                'potencia_normalizada' => 210,
                'velocidad_media' => 31.5,
                'puntos_estres_tss' => 60.5,
                'factor_intensidad_if' => 0.88,
                'ascenso_metros' => 800,
                'comentario' => 'Buen ritmo matutino'
            ],
            [
                'id_ciclista' => 2,
                'id_bicicleta' => 2,
                'fecha' => '2026-01-02 08:00:00',
                'duracion' => '02:10:00',
                'kilometros' => 72.0,
                'recorrido' => 'Sierra Norte',
                'pulso_medio' => 145,
                'pulso_max' => 175,
                'potencia_media' => 210,
                'potencia_normalizada' => 220,
                'velocidad_media' => 32.0,
                'puntos_estres_tss' => 80.0,
                'factor_intensidad_if' => 0.91,
                'ascenso_metros' => 1200,
                'comentario' => 'Sensaciones normales'
            ],
            [
                'id_ciclista' => 3,
                'id_bicicleta' => 3,
                'fecha' => '2026-01-03 07:00:00',
                'duracion' => '01:30:00',
                'kilometros' => 48.5,
                'recorrido' => 'Ruta Lago',
                'pulso_medio' => 138,
                'pulso_max' => 165,
                'potencia_media' => 190,
                'potencia_normalizada' => 200,
                'velocidad_media' => 30.2,
                'puntos_estres_tss' => 55.0,
                'factor_intensidad_if' => 0.85,
                'ascenso_metros' => 500,
                'comentario' => 'Entrenamiento suave'
            ],
        ]);
    }
}