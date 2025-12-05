<!doctype html>
<html lang="es">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Página en construcción</title>
  <!-- Si usas Tailwind ya en tu proyecto, puedes quitar el CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="min-h-screen bg-gradient-to-b from-gray-50 to-white flex items-center justify-center p-6">
  <div class="max-w-4xl w-full bg-white rounded-2xl shadow-lg overflow-hidden flex flex-col md:flex-row items-center">
    <!-- Ilustración -->
    <div class="w-full md:w-1/2 p-8 flex items-center justify-center bg-[#F9FAFB]">
      <!-- SVG ilustrativo: persona trabajando -->
      <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512" class="w-64 h-64" fill="none">
        <defs>
          <linearGradient id="g1" x1="0" x2="1">
            <stop offset="0" stop-color="#F97316" />
            <stop offset="1" stop-color="#FB923C" />
          </linearGradient>
        </defs>
        <rect width="640" height="512" rx="16" fill="url(#g1)" opacity="0.06"/>
        <!-- Simplified construction worker icon -->
        <g transform="translate(120,64)">
          <circle cx="200" cy="80" r="48" fill="#FFD79E" />
          <path d="M152 140c0-26 40-26 40 0v80h-40v-80z" fill="#374151" opacity="0.9" />
          <rect x="120" y="200" width="160" height="16" rx="8" fill="#9CA3AF" />
          <path d="M0 280h320v16H0z" fill="#D1D5DB" />
          <!-- Casco -->
          <path d="M168 52c24-6 56-6 80 0l-12 28c-18-6-44-6-68 0l-12-28z" fill="#F59E0B" />
          <path d="M152 80h144v16H152z" fill="#FCD34D" opacity="0.6" />
          <!-- Herramienta: martillo -->
          <g transform="translate(20,150) rotate(-10)">
            <rect x="0" y="0" width="120" height="16" rx="8" fill="#374151"/>
            <rect x="100" y="-22" width="40" height="40" rx="6" fill="#111827"/>
          </g>
        </g>
      </svg>
    </div>

    <!-- Texto y acciones -->
    <div class="w-full md:w-1/2 p-8">
      <h1 class="text-3xl font-extrabold text-gray-800 mb-3">Página en construcción</h1>
      <p class="text-gray-600 mb-6">Estamos trabajando en esta sección para ofrecerte la mejor experiencia. Volveremos muy pronto con mejoras y nuevas funcionalidades.</p>

      <div class="flex gap-3">
        <a href="{{ route('inicio') }}" class="inline-block px-5 py-3 bg-[#9C1C2A] text-white rounded-lg shadow hover:opacity-90">Volver al inicio</a>

        <a href="javascript:history.back()" class="inline-block px-5 py-3 border border-gray-200 rounded-lg text-gray-700 hover:bg-gray-50">Volver atrás</a>
      </div>

      <div class="mt-6 text-sm text-gray-400">Si crees que deberías ver contenido aquí, contacta con el administrador del sistema.</div>
    </div>
  </div>
    
 
</body>
</html>
