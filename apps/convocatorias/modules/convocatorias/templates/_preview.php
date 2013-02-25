<h1>CONVOCATORIA A CONCURSO DE MERITOS Y PRUEBAS DE CONOCIMIENTOS PARA OPTAR A
AUXILIATURAS EN LABORATORIO DE COMPUTACION, DE MANTENIMIENTO Y DESARROLLO
<br />==========<br />
<?php echo $convocatoria->getNombre() ?></h1>

<p>El Departamento de Informática y Sistemas junto a las Carreras de Ing.
Informática e Ing. de Sistemas, de la Facultad de Ciencias y Tecnología, convoca
al concurso de meritos y examen de competencia para la provisión de Auxiliares
del Departamento, tomando como base los requerimientos que se tienen programados
para la gestión I/2012 y II/2012.</p>

<h2>1. REQUERIMIENTOS</h2>

<table>
    <tr>
        <th>Ítem</th>
        <th>Cant.</th>
        <th>Hrs. Académicas</th>
        <th>Nombre de la Auxiliatura</th>
        <th>Código de la Auxiliatura</th>
    </tr>
<?php foreach ($convocatoria->getConvocatoriaRequerimientos() as $r): ?>
    <tr>
        <td class="text-right"><?php echo $r->numero_item ?></td>
        <td class="text-center"><?php echo $r->cantidad_requerida ?> Aux.</td>
        <td class="text-center"><?php echo $r->Requerimiento->getHorasAcademicas() ?> Hrs/mes</td>
        <td><?php echo $r->Requerimiento->getNombre() ?></td>
        <td class="text-center"><?php echo $r->Requerimiento->getCodigo() ?></td>
    </tr>
<?php endforeach; ?>
    <tr>
        <td class="text-right">Total</td>
        <td><?php echo $convocatoria->getTotalRequerimientos() ?> Aux.</td>
    </tr>
</table>

<h2>2. REQUISITOS</h2>

<ol>
<?php foreach ($convocatoria->getRequisitos() as $r): ?>
    <li>
        <p><?php echo $r->getTexto() ?></p>
    </li>
<?php endforeach; ?>
</ol>

<p>NOTA: Se considera conclusión del plan de materias, el haber cursado el
número de las materias requeridas en la curricula de la Carrera respectiva,
exceptuando la materia titulación.</p>

<h2>3. DOCUMENTOS REQUISITOS A PRESENTAR</h2>

<ol>
<?php foreach ($convocatoria->getDocumentos() as $d): ?>
    <li>
        <p><?php echo $d->getTexto() ?></p>
    </li>
<?php endforeach; ?>
</ol>

<p>NOTA: La documentación y las fotocopias de certificados, deben ser validadas
gratuitamente en Secretaria del Departamento de Informática y Sistemas.
(Presentar original y fotocopia). Se deberá presentar documentación separada por
CADA UNA de las postulaciones, debidamente FOLIADA. La documentación no será
devuelta.</p>

<h2>4. FECHA Y LUGAR DE PRESENTACION DE DOCUMENTOS</h2>

<h3>4.1. DE LA FORMA</h3>

<p>Presentación de la documentación en sobre manila cerrado y rotulado con:
<ul>
    <li><p>Nombre y apellidos completos, dirección, teléfono(s) y e-mail del
postulante.</p></li>
    <li><p>Código de item de la auxiliatura a la que se postula.</p></li>
    <li><p>Nombre de la auxiliatura a la que se presenta.</p></li>
</ul>

<h3>4.2. DE LA FECHA Y LUGAR</h3>

<p>La documentación deberá ser presentada hasta horas 11:30 del día 11 de Junio
del 2012, en Secretaria del Departamento con la Sra. Fabiola Rojas
Caballero.</p>

<h2>5. CALIFICACION DE MERITOS</h2>

<p>La calificación de meritos se basará en los documentos presentados por el
postulante y se realizará sobre la base de 100 puntos que representa el 20% del
puntaje final y se pondera de la siguiente manera.</p>

<table>
    <tr>
        <td><strong>RENDIMIENTO ACADEMICO</strong></td>
        <td>65</td>
    </tr>
    <tr>
        <td>Promedio general de las materias cursadas</td>
        <td>35</td>
    </tr>
    <tr>
        <td>Promedio general de materias del anterior semestre</td>
        <td>30</td>
    </tr>
    <tr>
        <td><strong>EXPERIENCIA GENERAL</strong></td>
        <td>35</td>
    </tr>
    <tr>
        <td>Documentos de experiencia en laboratorios</td>
        <td>20</td>
    </tr>
    <tr>
        <td>Auxiliar de Laboratorio Departamento de Informática - Sistemas del
item respectivo:</td>
        <td>12</td>
    </tr>
    <tr>
        <td>2 pts/semestre Auxiliar titular.</td>
    </tr>
    <tr>
        <td>1 pts/semestre Auxiliar Invitado.</td>
    </tr>
    <tr>
        <td>Auxiliares AdHonorem Laboratorio Departamento de Informática -
Sistemas:</td>
        <td>6</td>
    </tr>
    <tr>
        <td>1 pts/semestre Auxiliar.</td>
    </tr>
    <tr>
        <td>Otros auxiliares en laboratorios de computación:</td>
        <td>2</td>
    </tr>
    <tr>
        <td>1 pts/semestre Auxiliar.</td>
    </tr>
    <tr>
        <td>Producción</td>
        <td>5</td>
    </tr>
    <tr>
        <td>Disertación cursos y/o participación en Proyectos:</td>
        <td>5</td>
    </tr>
    <tr>
        <td>2.5 pto/certificado</td>
    </tr>
    <tr>
        <td>Documentos de experiencia extrauniversitaria y de capacitación</td>
        <td>10</td>
    </tr>
    <tr>
        <td>Experiencia como operador, programador, analista de sistemas, cargo
directivo en centro de cómputo:</td>
        <td>6</td>
    </tr>
    <tr>
        <td>2 puntos por certificado</td>
    </tr>
    <tr>
        <td>Certificación de capacitación en el área especifica expedidos por el
sistema universitario</td>
        <td>4</td>
    </tr>
    <tr>
        <td>2 ptos/certificado aprobación</td>
    </tr>
    <tr>
        <td>1 pto/certificado asistencia</td>
    </tr>
</table>
<p>NOTA: Todo certificado será ponderado hasta el valor del puntaje especificado
en la tabla.</p>

<h2>6. CALIFICACION DE CONOCIMIENTOS</h2>

<p>La calificación de conocimientos se realiza sobre la base de 100 puntos,
equivalentes al 80% de la calificación final. Las pruebas para los auxiliares
sobre conocimientos se realizaran de acuerdo al temario y tabla siguiente.</p>

<h3>6.1. PORCENTAJES DE CALIFICACION PARA CADA TIPO DE AUXILIAR</h3>

<h3>6.1.1. PRUEBAS ESCRITAS</h3>

<p>Los postulantes deben de forma obligatoria rendir todas las pruebas escritas
en el (los) item(es) a los que se postulan.</p>

<table>
    <tr>
        <th>#</th>
        <th>Temática</th>
        <th colspan="7">Código de Auxiliatura</th>
    </tr>
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td><strong><strong>LCO-ADM</strong></strong></td>
        <td><strong>LDS-ADM</strong></td>
        <td><strong>LDS-AUX</strong></td>
        <td><strong>LM-ADM-SW</strong></td>
        <td><strong>LM-AUX-SW</strong></td>
        <td><strong>LM-ADM-HW</strong></td>
        <td><strong>LM-AUX-HW</strong></td>
    </tr>
    <tr>
        <td>1</td>
        <td>ADM LINUX  BASICO - AVANZADO</td>
        <td class="text-center">25</td>
        <td class="text-center">10</td>
        <td class="text-center">10</td>
        <td class="text-center">10</td>
        <td class="text-center">10</td>
        <td class="text-center">10</td>
        <td class="text-center">10</td>
    </tr>
    <tr>
        <td>2</td>
        <td>REDES NIVEL INTERMEDIO</td>
        <td class="text-center">25</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">10</td>
        <td class="text-center">10</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
    </tr>
    <tr>
        <td>3</td>
        <td>POSTGRES, MYSQL NIVEL INTERMEDIO</td>
        <td class="text-center">20</td>
        <td class="text-center">20</td>
        <td class="text-center">30</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
    </tr>
    <tr>
        <td>4</td>
        <td>PROGRAMACION PARA INTERNET, LENGUAJES DE PROGRAMACION (JSP, JAVASCRIPT, CSS, HTML, PHP, DELPHI)</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">40</td>
        <td class="text-center">40</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
    </tr>
    <tr>
        <td>5</td>
        <td>MODELAJE DE APLICACIONES WEB (UML),PROCESO UNIFICADO ESTRUCTURADO</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">20</td>
        <td class="text-center">20</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
    </tr>
    <tr>
        <td>6</td>
        <td>ENSAMBLAJE Y MANTENIMIENTO DE COMPUTADORA EN HARDWARE Y SOFTWARE</td>
        <td class="text-center">20</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">25</td>
        <td class="text-center">25</td>
        <td class="text-center">30</td>
        <td class="text-center">25</td>
    </tr>
    <tr>
        <td rowspan="3">7</td>
        <td>ELECTRONICA  APLICADA</td>
        <td colspan="7">&nbsp;</td>
    </tr>
    <tr>
        <td>Teórico</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">20</td>
        <td class="text-center">30</td>
        <td class="text-center">25</td>
        <td class="text-center">30</td>
    </tr>
    <tr>
        <td>Practico</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">25</td>
        <td class="text-center">25</td>
        <td class="text-center">25</td>
        <td class="text-center">25</td>
    </tr>
    <tr>
        <td>8</td>
        <td>DIDACTICA</td>
        <td class="text-center">10</td>
        <td class="text-center">10</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">10</td>
        <td class="text-center">&nbsp;</td>
        <td class="text-center">10</td>
        <td class="text-center">10</td>
    </tr>
</table>

<h2>7. DE LOS TRIBUNALES</h2>

<p>Los Honorables Consejos de Carrera de Informática y Sistemas designarán
respectivamente; para la calificación de méritos 1 docente y 1 delegado
estudiante, de la misma manera para la comisión de conocimientos cada consejo
designará 1 docente y un estudiante veedor por cada temática.</p>

<h2>8. CRONOGRAMA GENERAL</h2>

<table>
    <tr>
        <th>Eventos</th>
        <th>Fechas</th>
    </tr>
<?php foreach ($convocatoria->getConvocatoriaEventos() as $e): ?>
    <tr>
        <td><?php echo $e->Evento->getDescripcion() ?></td>
        <td class="text-center"><?php echo $e->getFecha() ?></td>
    </tr>
<?php endforeach; ?>
</table>

<h2>9. SELECCIÓN</h2>
<p>Una vez concluido el proceso la jefatura  decidirá qué auxiliares serán
seleccionados para cada item, considerando los resultados finales y  las
necesidades propias de cada laboratorio.</p>

<div class="fecha">
    <p>Cochabamba, 24 de Mayo de 2012.</p>
</div>

<div class="firmas">
    <div class="firma">
        <div class="nombre">Lic. Rolando Jaldin Rosales</div>
        <div class="cargo">Dir. Carr. Informática</div>
    </div>
    <div class="firma">
        <div class="nombre">Lic. Yony Richard Montoya Burgos</div>
        <div class="cargo">Dir. Carr. Ing. Sistemas</div>
    </div>
    <div class="firma">
        <div class="nombre">Lic. Henrry Frank Villarroel Tapia</div>
        <div class="cargo">Jefe Dpto. Informática-Sistemas</div>
    </div>
    <div class="firma">
        <div class="nombre">Ing. Hernan Flores Garcia</div>
        <div class="cargo">Decano FCyT-UMSS</div>
    </div>
</div>
