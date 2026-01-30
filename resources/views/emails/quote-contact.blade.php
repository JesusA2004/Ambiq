<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Nueva solicitud de cotización</title>
</head>
<body style="margin:0; padding:0; background:#f4f7fb; font-family: Arial, Helvetica, sans-serif; color:#0f172a;">
  <!-- Wrapper -->
  <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="background:#f4f7fb; padding:24px 12px;">
    <tr>
      <td align="center">
        <!-- Card -->
        <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="max-width:680px; background:#ffffff; border-radius:18px; overflow:hidden; border:1px solid #e6eef8; box-shadow:0 10px 30px rgba(15,23,42,.08);">
          <!-- Header -->
          <tr>
            <td style="padding:0;">
              <div style="background: linear-gradient(135deg, #0B2C4A, #0A2540, #081B2E); padding:22px 22px;">
                <div style="font-size:12px; letter-spacing:.18em; text-transform:uppercase; color:rgba(255,255,255,.75); font-weight:700;">
                  Solicitud recibida
                </div>
                <div style="margin-top:6px; font-size:22px; line-height:1.25; color:#ffffff; font-weight:900;">
                  Se ha recibido una cotización desde el sitio web
                </div>
                <div style="margin-top:8px; font-size:14px; color:rgba(255,255,255,.80); line-height:1.6;">
                  Por favor, contacta al cliente lo antes posible para confirmar requisitos, tiempos y alcance.
                </div>
              </div>
            </td>
          </tr>

          <!-- Content -->
          <tr>
            <td style="padding:22px;">
              <!-- Info grid -->
              <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate; border-spacing:0;">
                <tr>
                  <td style="padding:0 0 14px 0;">
                    <div style="font-size:12px; color:#64748b; font-weight:700; text-transform:uppercase; letter-spacing:.12em;">
                      Datos del cliente
                    </div>
                  </td>
                </tr>

                <tr>
                  <td style="padding:0;">
                    <table role="presentation" cellpadding="0" cellspacing="0" width="100%" style="border-collapse:separate; border-spacing:0;">
                      <tr>
                        <!-- Nombre -->
                        <td style="width:50%; padding:10px 10px 10px 0;">
                          <div style="border:1px solid #e6eef8; border-radius:14px; padding:12px 14px; background:#f8fbff;">
                            <div style="font-size:12px; color:#0B2C4A; font-weight:900; margin-bottom:6px;">
                              Nombre
                            </div>
                            <div style="font-size:14px; color:#0f172a; font-weight:700;">
                              {{ $data['nombre'] ?? '—' }}
                            </div>
                          </div>
                        </td>

                        <!-- Correo -->
                        <td style="width:50%; padding:10px 0 10px 10px;">
                          <div style="border:1px solid #e6eef8; border-radius:14px; padding:12px 14px; background:#f8fbff;">
                            <div style="font-size:12px; color:#0B2C4A; font-weight:900; margin-bottom:6px;">
                              Correo
                            </div>
                            <div style="font-size:14px; color:#0f172a; font-weight:700;">
                              @if(!empty($data['correo']))
                                <a href="mailto:{{ $data['correo'] }}" style="color:#0ea5e9; text-decoration:none; font-weight:800;">
                                  {{ $data['correo'] }}
                                </a>
                              @else
                                —
                              @endif
                            </div>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </td>
                </tr>

                <!-- Mensaje -->
                <tr>
                  <td style="padding:10px 0 0 0;">
                    <div style="border:1px solid #e6eef8; border-radius:14px; padding:14px 14px; background:#ffffff;">
                      <div style="font-size:12px; color:#0B2C4A; font-weight:900; margin-bottom:8px; text-transform:uppercase; letter-spacing:.12em;">
                        Mensaje del cliente
                      </div>

                      <div style="font-size:14px; color:#0f172a; line-height:1.7; white-space:pre-line;">
                        {{ trim($data['mensaje'] ?? '') !== '' ? $data['mensaje'] : '—' }}
                      </div>
                    </div>
                  </td>
                </tr>

                <!-- Meta -->
                <tr>
                  <td style="padding:16px 0 0 0;">
                    <div style="font-size:12px; color:#64748b; line-height:1.6;">
                      <strong style="color:#0f172a;">Origen:</strong> Formulario de contacto / cotización del sitio web.
                      @if(!empty($data['url']))
                        <br><strong style="color:#0f172a;">URL:</strong> {{ $data['url'] }}
                      @endif
                      @if(!empty($data['ip']))
                        <br><strong style="color:#0f172a;">IP:</strong> {{ $data['ip'] }}
                      @endif
                      @if(!empty($data['fecha']))
                        <br><strong style="color:#0f172a;">Fecha:</strong> {{ $data['fecha'] }}
                      @endif
                    </div>
                  </td>
                </tr>

                <!-- CTA -->
                <tr>
                  <td style="padding:18px 0 0 0;">
                    <table role="presentation" cellpadding="0" cellspacing="0">
                      <tr>
                        <td style="border-radius:14px; background:#0B2C4A;">
                          <a
                            href="mailto:{{ $data['correo'] ?? '' }}"
                            style="display:inline-block; padding:12px 16px; color:#ffffff; text-decoration:none; font-weight:900; font-size:14px;"
                          >
                            Responder al cliente
                          </a>
                        </td>
                      </tr>
                    </table>
                    <div style="margin-top:10px; font-size:12px; color:#64748b;">
                      Nota: este correo es automático. Responde directamente al cliente usando el botón.
                    </div>
                  </td>
                </tr>
              </table>
            </td>
          </tr>

          <!-- Footer -->
          <tr>
            <td style="padding:18px 22px; background:#f8fbff; border-top:1px solid #e6eef8;">
              <div style="font-size:12px; color:#64748b; line-height:1.6;">
                {{ config('app.name') }} · Notificación de cotización<br>
                <span style="color:#94a3b8;">Este mensaje fue generado desde el formulario del sitio.</span>
              </div>
            </td>
          </tr>
        </table>

        <!-- Spacer -->
        <div style="height:14px;"></div>
      </td>
    </tr>
  </table>
</body>
</html>