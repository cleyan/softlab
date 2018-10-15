<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Grid id="2" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" dataSource="equipos, estados, pacientes, peticiones, peticiones_detalle, prioridades, procedencias, secciones, test" name="equipos_estados_pacientes" pageSizeLimit="100" wizardCaption="Lista de Equipos, Estados, Pacientes, Peticiones, Peticiones Detalle, Prioridades, Procedencias, Secciones, Test " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardSortingType="SimpleDir" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" orderBy="fecha" activeCollection="TableParameters" activeTableType="dataSource" PathID="equipos_estados_pacientes">
			<Components>
				<Label id="397" fieldSourceType="DBColumn" dataType="Text" html="True" editable="False" name="op_filtro" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="260" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="equipos_estados_pacientes_TotalRecords" wizardTheme="Inline" wizardThemeType="File" wizardUseTemplateBlock="False">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Retrieve number of records" actionCategory="Database" id="261"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Sorter id="282" visible="True" name="Sorter_signo_prioridad" column="signo_prioridad" wizardCaption="Signo Prioridad" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="signo_prioridad" PathID="equipos_estados_pacientesSorter_signo_prioridad">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="279" visible="True" name="Sorter_fecha" column="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="fecha" PathID="equipos_estados_pacientesSorter_fecha">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="275" visible="True" name="Sorter_rut" column="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="rut" PathID="equipos_estados_pacientesSorter_rut">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="277" visible="True" name="Sorter_nombres" column="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nombres" PathID="equipos_estados_pacientesSorter_nombres">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="278" visible="True" name="Sorter_apellidos" column="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="apellidos" PathID="equipos_estados_pacientesSorter_apellidos">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="284" visible="True" name="Sorter_cod_test" column="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="cod_test" PathID="equipos_estados_pacientesSorter_cod_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<Sorter id="285" visible="True" name="Sorter_nom_test" column="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSortingType="SimpleDir" wizardControl="nom_test" PathID="equipos_estados_pacientesSorter_nom_test">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Sorter>
				<ImageLink id="401" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="ingresar_resultado" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_resultado.ccp" visible="Yes" PathID="equipos_estados_pacientesingresar_resultado">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="403" sourceType="DataField" name="test_id" source="peticiones_detalle_test_id"/>
						<LinkParameter id="404" sourceType="DataField" name="muestra_id" source="muestra_id"/>
						<LinkParameter id="405" sourceType="DataField" name="fecha" source="fecha"/>
						<LinkParameter id="409" sourceType="DataField" name="peticion_id" source="peticiones_peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="294" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="signo_prioridad" fieldSource="signo_prioridad" wizardCaption="Signo Prioridad" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="291" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="287" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="289" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="290" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="296" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="cod_test" fieldSource="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="297" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="402" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="GET" editable="False" name="alt_ingresar_resultado" wizardTheme="Inline" wizardThemeType="File" hrefSource="add_resultado.ccp" visible="Yes" PathID="equipos_estados_pacientesalt_ingresar_resultado">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="406" sourceType="DataField" name="fecha" source="fecha"/>
						<LinkParameter id="407" sourceType="DataField" name="test_id" source="peticiones_detalle_test_id"/>
						<LinkParameter id="408" sourceType="DataField" name="muestra_id" source="muestra_id"/>
						<LinkParameter id="410" sourceType="DataField" name="peticion_id" source="peticiones_peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Label id="306" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_signo_prioridad" fieldSource="signo_prioridad" wizardCaption="Signo Prioridad" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="303" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="Alt_fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="299" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="301" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="302" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="308" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_cod_test" fieldSource="cod_test" wizardCaption="Cod Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="30" wizardMaxLength="30" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="309" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="400" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="volver" wizardTheme="Inline" wizardThemeType="File" hrefSource="filtrar_resultados.ccp" visible="Yes" PathID="equipos_estados_pacientesvolver">
					<Components/>
					<Events/>
					<LinkParameters/>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Navigator id="311" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="equipos_estados_pacientesNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
			</Components>
			<Events>
				<Event name="BeforeShow" type="Server">
					<Actions>
						<Action actionName="Custom Code" actionCategory="General" id="399"/>
					</Actions>
				</Event>
			</Events>
			<TableParameters>
				<TableParameter id="262" conditionType="Parameter" useIsNull="False" field="rut" parameterSource="s_rut" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="1"/>
				<TableParameter id="263" conditionType="Parameter" useIsNull="False" field="ficha" parameterSource="s_ficha" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="2"/>
				<TableParameter id="264" conditionType="Parameter" useIsNull="False" field="nombres" parameterSource="s_nombres" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="3"/>
				<TableParameter id="265" conditionType="Parameter" useIsNull="False" field="apellidos" parameterSource="s_apellidos" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="4"/>
				<TableParameter id="266" conditionType="Parameter" useIsNull="False" field="peticiones.procedencia_id" parameterSource="s_peticiones_procedencia_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="5"/>
				<TableParameter id="267" conditionType="Parameter" useIsNull="False" field="peticiones.estado_id" parameterSource="s_peticiones_estado_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="6"/>
				<TableParameter id="268" conditionType="Parameter" useIsNull="False" field="fecha" parameterSource="s_fecha" dataType="Date" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="7"/>
				<TableParameter id="269" conditionType="Parameter" useIsNull="False" field="muestra_id" parameterSource="s_muestra_id" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="8"/>
				<TableParameter id="270" conditionType="Parameter" useIsNull="False" field="peticiones_detalle.prioridad_id" parameterSource="s_peticiones_detalle_prioridad_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="9"/>
				<TableParameter id="271" conditionType="Parameter" useIsNull="False" field="test.equipo_id" parameterSource="s_test_equipo_id" dataType="Integer" logicOperator="And" searchConditionType="Equal" parameterType="URL" orderNumber="10"/>
				<TableParameter id="272" conditionType="Parameter" useIsNull="False" field="codigo_fonasa" parameterSource="s_codigo_fonasa" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="11"/>
				<TableParameter id="273" conditionType="Parameter" useIsNull="False" field="cod_test" parameterSource="s_cod_test" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="12"/>
				<TableParameter id="274" conditionType="Parameter" useIsNull="False" field="nom_test" parameterSource="s_nom_test" dataType="Text" logicOperator="And" searchConditionType="Contains" parameterType="URL" orderNumber="13"/>
				<TableParameter id="396" conditionType="Parameter" useIsNull="False" field="secciones.seccion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="s_seccion_id" orderNumber="14"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="411" tableName="equipos" posWidth="130" posHeight="162" posLeft="1029" posTop="213"/>
				<JoinTable id="413" tableName="estados" posWidth="120" posHeight="179" posLeft="275" posTop="651"/>
				<JoinTable id="415" tableName="pacientes" posWidth="150" posHeight="326" posLeft="429" posTop="257"/>
				<JoinTable id="420" tableName="peticiones" posWidth="239" posHeight="193" posLeft="0" posTop="191"/>
				<JoinTable id="427" tableName="peticiones_detalle" posWidth="253" posHeight="219" posLeft="429" posTop="21"/>
				<JoinTable id="432" tableName="prioridades" posWidth="134" posHeight="141" posLeft="722" posTop="426"/>
				<JoinTable id="435" tableName="procedencias" posWidth="140" posHeight="135" posLeft="424" posTop="614"/>
				<JoinTable id="437" tableName="secciones" posWidth="133" posHeight="125" posLeft="1028" posTop="55"/>
				<JoinTable id="439" tableName="test" posWidth="142" posHeight="346" posLeft="712" posTop="32"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="446" fieldLeft="peticiones.estado_id" fieldRight="estados.estado_id" tableLeft="peticiones" tableRight="estados" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="447" fieldLeft="peticiones.procedencia_id" fieldRight="procedencias.procedencia_id" tableLeft="peticiones" tableRight="procedencias" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="448" fieldLeft="peticiones.paciente_id" fieldRight="pacientes.paciente_id" tableLeft="peticiones" tableRight="pacientes" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="449" fieldLeft="peticiones.peticion_id" fieldRight="peticiones_detalle.peticion_id" tableLeft="peticiones" tableRight="peticiones_detalle" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="450" fieldLeft="peticiones_detalle.test_id" fieldRight="test.test_id" tableLeft="peticiones_detalle" tableRight="test" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="451" fieldLeft="peticiones_detalle.prioridad_id" fieldRight="prioridades.prioridad_id" tableLeft="peticiones_detalle" tableRight="prioridades" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="452" fieldLeft="test.secciones_id" fieldRight="secciones.seccion_id" tableLeft="test" tableRight="secciones" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="453" fieldLeft="test.equipo_id" fieldRight="equipos.equipo_id" tableLeft="test" tableRight="equipos" conditionType="Equal" joinType="inner"/>
			</JoinLinks>
			<Fields>
				<Field id="412" tableName="equipos" fieldName="nom_equipo"/>
				<Field id="414" tableName="estados" fieldName="nom_estado"/>
				<Field id="416" tableName="pacientes" fieldName="rut"/>
				<Field id="417" tableName="pacientes" fieldName="ficha"/>
				<Field id="418" tableName="pacientes" fieldName="nombres"/>
				<Field id="419" tableName="pacientes" fieldName="apellidos"/>
				<Field id="421" tableName="peticiones" alias="peticiones_peticion_id" fieldName="peticiones.peticion_id"/>
				<Field id="422" tableName="peticiones" alias="peticiones_paciente_id" fieldName="peticiones.paciente_id"/>
				<Field id="423" tableName="peticiones" alias="peticiones_procedencia_id" fieldName="peticiones.procedencia_id"/>
				<Field id="424" tableName="peticiones" alias="peticiones_estado_id" fieldName="peticiones.estado_id"/>
				<Field id="425" tableName="peticiones" fieldName="fecha"/>
				<Field id="426" tableName="peticiones" fieldName="hora"/>
				<Field id="428" tableName="peticiones_detalle" fieldName="detalle_peticion_id"/>
				<Field id="429" tableName="peticiones_detalle" fieldName="muestra_id"/>
				<Field id="430" tableName="peticiones_detalle" alias="peticiones_detalle_test_id" fieldName="peticiones_detalle.test_id"/>
				<Field id="431" tableName="peticiones_detalle" alias="peticiones_detalle_prioridad_id" fieldName="peticiones_detalle.prioridad_id"/>
				<Field id="433" tableName="prioridades" fieldName="nom_prioridad"/>
				<Field id="434" tableName="prioridades" fieldName="signo_prioridad"/>
				<Field id="436" tableName="procedencias" fieldName="nom_procedencia"/>
				<Field id="438" tableName="secciones" fieldName="nom_seccion"/>
				<Field id="440" tableName="test" fieldName="secciones_id"/>
				<Field id="441" tableName="test" alias="test_equipo_id" fieldName="test.equipo_id"/>
				<Field id="442" tableName="test" fieldName="codigo_fonasa"/>
				<Field id="443" tableName="test" fieldName="cod_test"/>
				<Field id="444" tableName="test" fieldName="nom_test"/>
				<Field id="445" tableName="test" fieldName="compuesto"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Events" language="PHPTemplates" name="list_resultados_events.php" comment="//" codePage="utf-8" forShow="False"/>
		<CodeFile id="Code" language="PHPTemplates" name="list_resultados.php" comment="//" codePage="utf-8" forShow="True" url="list_resultados.php"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="454"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
