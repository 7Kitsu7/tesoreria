<?php

namespace App\Http\Controllers;

use App\Services\GeminiService;
use Illuminate\Http\Request;
use App\Models\Alumno;

class ChatbotController extends Controller
{
    public function index()
    {
        return view('chat');
    }

    public function preguntar(Request $request, GeminiService $gemini)
    {
        $mensaje = $request->input('mensaje');
        $alumno = null;

        // Verificar si hay coincidencia con algún patrón
        $tieneCoincidencia = false;
        $query = Alumno::query();

        // Buscar por código (Ej: A123)
        if (preg_match('/[aA]\d{3,}/', $mensaje, $match)) {
            $query->orWhere('CodigoAlumno', $match[0]);
            $tieneCoincidencia = true;
        }

        // Buscar por DNI (Ej: 12345678)
        if (preg_match('/\b\d{8}\b/', $mensaje, $match)) {
            $query->orWhere('Dni', $match[0]);
            $tieneCoincidencia = true;
        }

        // Buscar por nombre y apellido (Ej: Juan Pérez)
        if (preg_match('/\b([A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)\s+([A-ZÁÉÍÓÚÑ][a-záéíóúñ]+)\b/', $mensaje, $match)) {
            $query->orWhere('Nombres', 'like', '%' . $match[1] . '%')
                ->where('Apellidos', 'like', '%' . $match[2] . '%');
            $tieneCoincidencia = true;
        }

        // Solo obtener el alumno si hubo coincidencia
        $alumno = $tieneCoincidencia ? $query->first() : null;

        if (!$alumno) {
            // Si no se encontró alumno, enviar pregunta directa a Gemini
            $respuesta = $gemini->enviarMensaje($mensaje);
            return response()->json(['respuesta' => $respuesta]);
        }

        // ➤ Datos del alumno
        $datosAlumno = [
            //'Código' => $alumno->CodigoAlumno,
            'Nombre' => $alumno->Nombres . ' ' . $alumno->Apellidos,
            'DNI' => $alumno->Dni,
            'Email' => $alumno->Email,
            'Teléfono' => $alumno->Telefono,
            'Dirección' => $alumno->Direccion,
            'Fecha de Nacimiento' => $alumno->FechaNacimiento,
            'Apoderado' => $alumno->NombreApoderado,
        ];

        // ➤ Matrículas del alumno (últimas primero)
        $matriculas = $alumno->matriculas()->with('cabeceraPago')->orderByDesc('FechaMatricula')->take(3)->get();

        $resumenMatriculas = "Historial de matrículas recientes y pagos:\n";

        if ($matriculas->isEmpty()) {
            $resumenMatriculas .= "- No se encontraron matrículas registradas.\n";
        } else {
            foreach ($matriculas as $i => $matricula) {
                $resumenMatriculas .= "- Matrícula #" . ($i + 1) . ":\n";
                $resumenMatriculas .= "  • Fecha: {$matricula->FechaMatricula}\n";
                $resumenMatriculas .= "  • Nivel: {$matricula->Nivel}\n";
                $resumenMatriculas .= "  • Grado: {$matricula->Grado} {$matricula->Seccion}\n";
                $resumenMatriculas .= "  • Periodo: {$matricula->CodigoPeriodo}\n";
                $resumenMatriculas .= "  • Estado: {$matricula->Estado}\n";
                $resumenMatriculas .= "  • Monto: S/. {$matricula->MontoMatricula}\n";

                // Resumen de pagos
                $pagos = $matricula->cabeceraPago->sortByDesc('FechaPago');
                if ($pagos->isEmpty()) {
                    $resumenMatriculas .= "  • Pagos: No se han registrado pagos.\n";
                } else {
                    $resumenMatriculas .= "  • Pagos recientes:\n";
                    foreach ($pagos->take(2) as $pago) {
                        $resumenMatriculas .= "     - Pago el {$pago->FechaPago}, Total: S/. {$pago->Total}, Estado: {$pago->Estado}\n";
                    }
                }
            }
        }

        // ➤ Prompt completo para Gemini
        $contexto = "Datos del alumno:\n";
        foreach ($datosAlumno as $clave => $valor) {
            $contexto .= "- $clave: $valor\n";
        }

        $prompt = "Eres un asistente profesional que responde consultas administrativas.\n";
        $prompt .= "Pregunta: \"$mensaje\"\n";
        $prompt .= "Contexto:\n$contexto\n$resumenMatriculas\n";
        $prompt .= "Responde de forma clara, corta, precisa y profesional, usando los datos proporcionados, si te despides puedes usar el nombre con frase de TesoBot - ¡Gracias por consultar!  .";

        // Enviar prompt a Gemini y obtener respuesta
        $respuesta = $gemini->enviarMensaje($prompt);

        return response()->json(['respuesta' => $respuesta]);
    }
}
