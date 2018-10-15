<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" wizardTheme="InLine" wizardThemeType="File" needGeneration="0" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Grid id="36" secured="False" sourceType="Table" returnValueType="Number" defaultPageSize="10" connection="Datos" name="peticiones_pacientes_proc" dataSource="peticiones, pacientes, procedencias, estados" pageSizeLimit="100" wizardCaption="Lista de Peticiones, Pacientes, Procedencias, Estados " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="TableParameters" activeTableType="dataSource" PathID="peticiones_pacientes_proc">
			<Components>
				<Label id="60" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" fieldSource="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="62" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="63" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="ficha" fieldSource="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="64" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="65" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="68" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="61" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_estado" fieldSource="nom_estado" wizardCaption="Nom Estado" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="69" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="observaciones" fieldSource="observaciones" wizardCaption="Observaciones" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="66" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="67" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="hora" fieldSource="hora" wizardCaption="Hora" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="H:nn" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="70" conditionType="Parameter" useIsNull="False" field="peticiones.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" defaultValue="0" parameterSource="peticion_id" orderNumber="1"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="37" tableName="peticiones" posWidth="150" posHeight="188" posLeft="10" posTop="10"/>
				<JoinTable id="45" tableName="pacientes" posWidth="100" posHeight="454" posLeft="211" posTop="0"/>
				<JoinTable id="51" tableName="procedencias" posWidth="198" posHeight="169" posLeft="167" posTop="538"/>
				<JoinTable id="54" tableName="estados" posWidth="220" posHeight="167" posLeft="447" posTop="483"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="57" fieldLeft="peticiones.paciente_id" fieldRight="pacientes.paciente_id" tableLeft="peticiones" tableRight="pacientes" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="58" fieldLeft="peticiones.procedencia_id" fieldRight="procedencias.procedencia_id" tableLeft="peticiones" tableRight="procedencias" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="59" fieldLeft="peticiones.estado_id" fieldRight="estados.estado_id" tableLeft="peticiones" tableRight="estados" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="38" tableName="peticiones" fieldName="peticion_id"/>
				<Field id="39" tableName="peticiones" alias="peticiones_paciente_id" fieldName="peticiones.paciente_id"/>
				<Field id="40" tableName="peticiones" alias="peticiones_procedencia_id" fieldName="peticiones.procedencia_id"/>
				<Field id="41" tableName="peticiones" alias="peticiones_estado_id" fieldName="peticiones.estado_id"/>
				<Field id="42" tableName="peticiones" fieldName="fecha"/>
				<Field id="43" tableName="peticiones" fieldName="hora"/>
				<Field id="44" tableName="peticiones" fieldName="observaciones"/>
				<Field id="46" tableName="pacientes" alias="pacientes_paciente_id" fieldName="pacientes.paciente_id"/>
				<Field id="47" tableName="pacientes" fieldName="rut"/>
				<Field id="48" tableName="pacientes" fieldName="ficha"/>
				<Field id="49" tableName="pacientes" fieldName="nombres"/>
				<Field id="50" tableName="pacientes" fieldName="apellidos"/>
				<Field id="52" tableName="procedencias" alias="procedencias_procedencia_id" fieldName="procedencias.procedencia_id"/>
				<Field id="53" tableName="procedencias" fieldName="nom_procedencia"/>
				<Field id="55" tableName="estados" alias="estados_estado_id" fieldName="estados.estado_id"/>
				<Field id="56" tableName="estados" fieldName="nom_estado"/>
			</Fields>
			<SPParameters/>
			<SQLParameters/>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="Datos" name="peticiones_peticiones_det" dataSource="SELECT DISTINCTROW 
  peticiones.peticion_id,
  peticiones_detalle.muestra_id,
  tipos_muestra.nom_tipo_muestra,
  indicaciones_muestra.nom_indicacion,
  indicaciones_muestra.cuerpo_indicacion,
  peticiones_detalle.test_id,
  test.cod_test,
  test.nom_test
FROM
  peticiones
  LEFT OUTER JOIN peticiones_detalle ON (peticiones.peticion_id = peticiones_detalle.peticion_id)
  LEFT OUTER JOIN test ON (peticiones_detalle.test_id = test.test_id)
  LEFT OUTER JOIN tipos_muestra ON (test.tipo_muestra_id = tipos_muestra.tipo_muestra_id)
  LEFT OUTER JOIN indicaciones_muestra ON (tipos_muestra.indicacion_id = indicaciones_muestra.indicacion_muestra_id)
WHERE
  peticiones.peticion_id = {peticion_id}" pageSizeLimit="100" wizardCaption="Lista de Peticiones, Peticiones Detalle, Test, Tipos Muestra, Indicaciones Muestra " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" parameterTypeListName="ParameterTypeList" activeCollection="SQLParameters" PathID="peticiones_peticiones_det">
			<Components>
				<Label id="18" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="muestra_id" fieldSource="muestra_id" wizardCaption="Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="20" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="74" fieldSourceType="DBColumn" dataType="Text" html="False" name="nom_tipo_muestra" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_tipo_muestra">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="23" fieldSourceType="DBColumn" dataType="Memo" html="True" editable="False" name="cuerpo_indicacion" fieldSource="cuerpo_indicacion" wizardCaption="Cuerpo Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="25" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_muestra_id" fieldSource="muestra_id" wizardCaption="Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="27" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_test" fieldSource="nom_test" wizardCaption="Nom Test" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="75" fieldSourceType="DBColumn" dataType="Text" html="False" name="Alt_nom_tipo_muestra" wizardTheme="Inline" wizardThemeType="File" fieldSource="nom_tipo_muestra">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="30" fieldSourceType="DBColumn" dataType="Memo" html="True" editable="False" name="Alt_cuerpo_indicacion" fieldSource="cuerpo_indicacion" wizardCaption="Cuerpo Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Navigator id="31" type="Centered" name="Navigator" size="10" wizardPagingType="Centered" wizardFirst="True" wizardFirstText="Inicio" wizardPrev="True" wizardPrevText="Anterior" wizardNext="True" wizardNextText="Siguiente" wizardLast="True" wizardLastText="Final" wizardImages="False" wizardPageNumbers="Centered" wizardSize="10" wizardTotalPages="True" wizardHideDisabled="False" wizardOfText="de" wizardTheme="Inline" wizardThemeType="File" wizardImagesScheme="Inline" pageSizes="1;5;10;25;50" PathID="peticiones_peticiones_detNavigator">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Navigator>
				<ImageLink id="71" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="ver_tomademuestra.ccp" visible="Yes" PathID="peticiones_peticiones_detImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="72" sourceType="URL" name="peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
			</Components>
			<Events/>
			<TableParameters/>
			<JoinTables>
				<JoinTable id="11" tableName="indicaciones_muestra" posWidth="100" posHeight="100" posLeft="450" posTop="10"/>
				<JoinTable id="9" tableName="tipos_muestra" posWidth="100" posHeight="100" posLeft="340" posTop="10"/>
				<JoinTable id="7" tableName="test" posWidth="100" posHeight="100" posLeft="230" posTop="10"/>
				<JoinTable id="5" tableName="peticiones_detalle" posWidth="100" posHeight="100" posLeft="120" posTop="10"/>
				<JoinTable id="3" tableName="peticiones" posWidth="100" posHeight="100" posLeft="10" posTop="10"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="16" tableLeft="tipos_muestra" fieldLeft="tipos_muestra.indicacion_id" tableRight="indicaciones_muestra" fieldRight="indicaciones_muestra.indicacion_muestra_id" joinType="inner"/>
				<JoinTable2 id="15" tableLeft="test" fieldLeft="test.tipo_muestra_id" tableRight="tipos_muestra" fieldRight="tipos_muestra.tipo_muestra_id" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="14" tableLeft="peticiones_detalle" fieldLeft="peticiones_detalle.test_id" tableRight="test" fieldRight="test.test_id" joinType="inner" conditionType="Equal"/>
				<JoinTable2 id="13" tableLeft="peticiones_detalle" fieldLeft="peticiones_detalle.peticion_id" tableRight="peticiones" fieldRight="peticiones.peticion_id" joinType="inner" conditionType="Equal"/>
			</JoinLinks>
			<Fields>
				<Field id="12" tableName="indicaciones_muestra" fieldName="indicaciones_muestra.*"/>
				<Field id="10" tableName="tipos_muestra" fieldName="tipos_muestra.*"/>
				<Field id="8" tableName="test" fieldName="test.*"/>
				<Field id="6" tableName="peticiones_detalle" fieldName="peticiones_detalle.*"/>
				<Field id="4" tableName="peticiones" fieldName="peticiones.*"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="32" variable="peticion_id" parameterType="URL" defaultValue="0" dataType="Integer" parameterSource="peticion_id"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="ver_detalletomamuestra.php" comment="//" forShow="True" url="ver_detalletomamuestra.php" codePage="utf-8"/>
		<CodeFile id="Events" language="PHPTemplates" name="ver_detalletomamuestra_events.php" forShow="False" comment="//" codePage="utf-8"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="73"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
