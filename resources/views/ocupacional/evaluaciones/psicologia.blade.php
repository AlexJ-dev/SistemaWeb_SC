<form class="max-w-7xl mx-auto bg-white rounded-lg shadow-lg space-y-4 p-4">

    <!-- CONTENEDOR PRINCIPAL DE 2 COLUMNAS -->
    <div class="flex flex-col lg:flex-row gap-4">

        <!-- ============================= -->
        <!-- COLUMNA IZQUIERDA -->
        <!-- ============================= -->
        <div class="lg:w-1/2 p-4 border border-gray-300 rounded bg-white">

            <!-- Presentación y discurso -->
            <h2 class="text-xl font-bold text-red-800 mb-6">OBSERVACIÓN DE CONDUCTAS</h2>

            <!-- Presentación y Postura -->
            <div class="mb-4">

                <div class="grid grid-cols-4 gap-x-2 gap-y-2 items-center">
                    <!-- Fila 1: Presentación -->
                    <h3 class="text-gray-700 font-medium">Presentación :</h3>

                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="presentacion"
                            value="adecuado"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('presentacion', $psicologia->presentacion ?? '') == 'adecuado' ? 'checked' : '' }}>
                        Adecuado
                    </label>

                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="presentacion"
                            value="inadecuado"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('presentacion', $psicologia->presentacion ?? '') == 'inadecuado' ? 'checked' : '' }}>
                        Inadecuado
                    </label>

                    <div></div>

                    <!-- Fila 2: Postura -->
                    <h3 class="text-gray-700 font-medium">Postura :</h3>

                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="postura"
                            value="adecuado"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('postura', $psicologia->postura ?? '') == 'adecuado' ? 'checked' : '' }}>
                        Adecuado
                    </label>

                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="postura"
                            value="inadecuado"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('postura', $psicologia->postura ?? '') == 'inadecuado' ? 'checked' : '' }}>
                        Inadecuado
                    </label>

                    <div></div>
                </div>
            </div>


            <!-- Discurso -->
            <div class="mb-4">
                <h3 class="text-gray-700 font-medium">Discurso</h3>

                <div class="grid grid-cols-4 gap-x-2 gap-y-2 items-center">
                    <!-- Ritmo -->
                    <h3 class="ml-2">- Ritmo :</h3>

                    @foreach (['adecuado','inadecuado','fluido'] as $op)
                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="ritmo"
                            value="{{ $op }}"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('ritmo', $psicologia->ritmo ?? '') == $op ? 'checked' : '' }}>
                        {{ ucfirst($op) }}
                    </label>
                    @endforeach

                    <!-- Tono -->
                    <h3 class="ml-2">- Tono :</h3>

                    @foreach (['bajo','moderado','alto'] as $op)
                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="tono"
                            value="{{ $op }}"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('tono', $psicologia->tono ?? '') == $op ? 'checked' : '' }}>
                        {{ ucfirst($op) }}
                    </label>
                    @endforeach

                    <!-- Articulación -->
                    <h3 class="ml-2">- Articulación :</h3>

                    @foreach (['con_dificultad'=>'Con dificultad', 'sin_dificultad'=>'Sin dificultad'] as $value=>$label)
                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="articulacion"
                            value="{{ $value }}"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('articulacion', $psicologia->articulacion ?? '') == $value ? 'checked' : '' }}>
                        {{ $label }}
                    </label>
                    @endforeach

                    <div></div>
                </div>
            </div>


            <!-- Orientación -->
            <div class="mb-4">
                <h3 class="text-gray-700 font-medium">Orientación</h3>

                <div class="grid grid-cols-4 gap-x-2 gap-y-2 items-center">

                    <!-- Tiempo -->
                    <h3 class="ml-2">- Tiempo :</h3>

                    @foreach (['orientado','desorientado'] as $op)
                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="tiempo"
                            value="{{ $op }}"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('tiempo', $psicologia->tiempo ?? '') == $op ? 'checked' : '' }}>
                        {{ ucfirst($op) }}
                    </label>
                    @endforeach

                    <div></div>

                    <!-- Espacio -->
                    <h3 class="ml-2">- Espacio :</h3>

                    @foreach (['orientado','desorientado'] as $op)
                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="espacio"
                            value="{{ $op }}"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('espacio', $psicologia->espacio ?? '') == $op ? 'checked' : '' }}>
                        {{ ucfirst($op) }}
                    </label>
                    @endforeach

                    <div></div>

                    <!-- Persona -->
                    <h3 class="ml-2">- Persona :</h3>

                    @foreach (['orientado','desorientado'] as $op)
                    <label class="flex items-center gap-2">
                        <input
                            type="radio"
                            name="persona"
                            value="{{ $op }}"
                            class="text-[#9C1C2A] focus:ring-[#9C1C2A]"
                            {{ old('persona', $psicologia->persona ?? '') == $op ? 'checked' : '' }}>
                        {{ ucfirst($op) }}
                    </label>
                    @endforeach

                    <div></div>
                </div>
            </div>

            <!-- Conclusiones -->
            <h2 class="text-lg font-semibold my-6">CONCLUSIONES</h2>


            <div>
                <label>Área Cognitiva</label>
                <textarea name="conclusiones_area_congnitiva" class="w-full border rounded p-2 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">{{ old('conclusiones_area_congnitiva', $psicologia->conclusiones_area_congnitiva ?? '') }}</textarea>
            </div>
            <div>
                <label>Área Emocional</label>
                <textarea name="conclusiones_area_emocional" class="w-full border rounded p-2 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">{{ old('conclusiones_area_emocional', $psicologia->conclusiones_area_emocional ?? '') }}</textarea>
            </div>


            <div class="mt-4">
                <label>Recomendaciones</label>
                <textarea name="recomendaciones" class="w-full border rounded p-2 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]">{{ old('recomendaciones', $psicologia->recomendaciones ?? '') }}</textarea>
            </div>


        </div> <!-- FIN COLUMNA IZQUIERDA -->


        <!-- ============================= -->
        <!-- COLUMNA DERECHA -->
        <!-- ============================= -->
        <div class="lg:w-1/2 p-4 border border-gray-300 rounded bg-white">

            <!-- Evaluación cognitiva -->
            <h2 class="text-xl font-bold text-red-800 mb-6">
                RESULTADO DE EVALUACIÓN
            </h2>

            <div class="space-y-3">

                <!-- Nivel Intelectual -->
                <div class="flex items-center space-x-2">
                    <label class="w-72">Nivel Intelectual :</label>
                    <input type="text" name="nivel_intelectual"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        value="{{ old('nivel_intelectual', $psicologia->nivel_intelectual ?? '') }}">
                </div>

                <!-- Coordinación Visomotriz -->
                <div class="flex items-center space-x-2">
                    <label class="w-72">Coordinación Visomotriz :</label>
                    <input type="text" name="coordinacion_visomotriz"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        value="{{ old('coordinacion_visomotriz', $psicologia->coordinacion_visomotriz ?? '') }}">
                </div>

                <!-- Nivel de Memoria -->
                <div class="flex items-center space-x-2">
                    <label class="w-72">Nivel de Memoria :</label>
                    <input type="text" name="nivel_memoria"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        value="{{ old('nivel_memoria', $psicologia->nivel_memoria ?? '') }}">
                </div>

                <!-- Personalidad -->
                <div class="flex items-center space-x-2">
                    <label class="w-72">Personalidad :</label>
                    <input type="text" name="personalidad"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        value="{{ old('personalidad', $psicologia->personalidad ?? '') }}">
                </div>

                <!-- Medividad -->
                <div class="flex items-center space-x-2">
                    <label class="w-72">Medividad :</label>
                    <input type="text" name="medividad"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        value="{{ old('medividad', $psicologia->medividad ?? '') }}">
                </div>

                <!-- Altura -->
                <div class="flex items-center space-x-2">
                    <label class="w-72">Altura :</label>
                    <input type="text" name="altura"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        value="{{ old('altura', $psicologia->altura ?? '') }}">
                </div>

                <!-- Estado emocional -->
                @foreach (['estres'=>'Estrés', 'ansiedad'=>'Ansiedad', 'depresion'=>'Depresión',
                'fatiga'=>'Fatiga', 'somnolencia'=>'Somnolencia'] as $field => $label)
                <div class="flex items-center space-x-2">
                    <label class="w-72">{{ $label }} :</label>
                    <input type="text" name="{{ $field }}"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        value="{{ old($field, ($psicologia->$field ?? false) ? 'Sí' : 'No') }}">
                </div>
                @endforeach

                <!-- Otros factores -->
                @foreach (['espacios_confinados'=>'Espacios Confinados', 'fobias'=>'Fobias'] as $field=>$label)
                <div class="flex items-center space-x-2">
                    <label class="w-72">{{ $label }} :</label>
                    <input type="text" name="{{ $field }}"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        value="{{ old($field, ($psicologia->$field ?? false) ? 'Sí' : 'No') }}">
                </div>
                @endforeach

                <!-- Minisiquiátrico -->
                <div class="flex items-center space-x-2">
                    <label class="w-72">Minisiquiátrico :</label>
                    <input type="text" name="minisiquiatrico"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        value="{{ old('minisiquiatrico', $psicologia->minisiquiatrico ?? '') }}">
                </div>

                <!-- Audit -->
                <div class="flex items-center space-x-2">
                    <label class="w-72">Audit :</label>
                    <input type="text" name="audit"
                        class="w-full border rounded p-1 focus:ring-[#9C1C2A] focus:border-[#9C1C2A]"
                        value="{{ old('audit', $psicologia->audit ?? '') }}">
                </div>

            </div>


        </div> <!-- FIN COLUMNA DERECHA -->

    </div> <!-- FIN FLEX -->

</form>