<Page id="1" templateExtension="html" relativePath="." fullRelativePath="." secured="False" urlType="Relative" isIncluded="False" SSLAccess="False" needGeneration="0" wizardTheme="InLine" wizardThemeType="File" cachingEnabled="False" cachingDuration="1 minutes" isService="False">
	<Components>
		<Grid id="125" secured="False" sourceType="SQL" returnValueType="Number" defaultPageSize="10" connection="Datos" name="peticiones_pacientes_proc" dataSource="SELECT peticion_id, peticiones.paciente_id AS peticiones_paciente_id, peticiones.procedencia_id AS peticiones_procedencia_id, peticiones.estado_id AS peticiones_estado_id,
fecha, hora, observaciones, pacientes.paciente_id, rut, fecha_nacimiento, ficha, nombres, apellidos, procedencias.procedencia_id AS procedencias_procedencia_id,
nom_procedencia, estados.estado_id AS estados_estado_id, nom_estado 
FROM ((peticiones LEFT JOIN pacientes ON
peticiones.paciente_id = pacientes.paciente_id) LEFT JOIN procedencias ON
peticiones.procedencia_id = procedencias.procedencia_id) LEFT JOIN estados ON
peticiones.estado_id = estados.estado_id
WHERE peticiones.peticion_id = {peticion_id}" pageSizeLimit="100" wizardCaption="Lista de Peticiones, Pacientes, Procedencias, Estados " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Columnar" wizardAllowInsert="False" wizardAltRecord="False" wizardRecordSeparator="False" activeCollection="SQLParameters" activeTableType="dataSource" parameterTypeListName="ParameterTypeList" PathID="peticiones_pacientes_proc">
			<Components>
				<Label id="148" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="False" name="peticion_id" fieldSource="peticion_id" wizardCaption="Peticion Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="152" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nombres" fieldSource="nombres" wizardCaption="Nombres" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="153" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="apellidos" fieldSource="apellidos" wizardCaption="Apellidos" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="150" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="rut" fieldSource="rut" wizardCaption="Rut" wizardTheme="Inline" wizardThemeType="File" wizardSize="12" wizardMaxLength="12" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="151" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="ficha" fieldSource="ficha" wizardCaption="Ficha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="154" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha" fieldSource="fecha" wizardCaption="Fecha" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="155" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="hora" fieldSource="hora" wizardCaption="Hora" wizardTheme="Inline" wizardThemeType="File" wizardSize="10" wizardMaxLength="10" wizardIsPassword="False" wizardUseTemplateBlock="False" format="H:nn" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="157" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_procedencia" fieldSource="nom_procedencia" wizardCaption="Nom Procedencia" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="200" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="161" fieldSourceType="DBColumn" dataType="Date" html="False" editable="False" name="fecha_nacimiento" wizardTheme="Inline" wizardThemeType="File" fieldSource="fecha_nacimiento" format="dd/mm/yyyy" DBFormat="yyyy-mm-dd HH:nn:ss">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="162" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="edad" wizardTheme="Inline" wizardThemeType="File">
					<Components/>
					<Events>
						<Event name="BeforeShow" type="Server">
							<Actions>
								<Action actionName="Custom Code" actionCategory="General" id="164"/>
							</Actions>
						</Event>
					</Events>
					<Attributes/>
					<Features/>
				</Label>
				<Hidden id="163" fieldSourceType="DBColumn" dataType="Integer" html="False" editable="True" hasErrorCollection="True" name="paciente_id" wizardTheme="Inline" wizardThemeType="File" fieldSource="paciente_id" PathID="peticiones_pacientes_procpaciente_id">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Hidden>
				<Label id="156" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="observaciones" fieldSource="observaciones" wizardCaption="Observaciones" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="250" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="159" conditionType="Parameter" useIsNull="False" field="peticiones.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="peticion_id" orderNumber="1" defaultValue="0"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="126" tableName="peticiones" posWidth="303" posHeight="219" posLeft="10" posTop="10"/>
				<JoinTable id="134" tableName="pacientes" posWidth="230" posHeight="369" posLeft="366" posTop="10"/>
				<JoinTable id="139" tableName="procedencias" posWidth="100" posHeight="100" posLeft="322" posTop="396"/>
				<JoinTable id="142" tableName="estados" posWidth="100" posHeight="100" posLeft="531" posTop="483"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="145" fieldLeft="peticiones.paciente_id" fieldRight="pacientes.paciente_id" tableLeft="peticiones" tableRight="pacientes" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="146" fieldLeft="peticiones.procedencia_id" fieldRight="procedencias.procedencia_id" tableLeft="peticiones" tableRight="procedencias" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="147" fieldLeft="peticiones.estado_id" fieldRight="estados.estado_id" tableLeft="peticiones" tableRight="estados" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="127" tableName="peticiones" fieldName="peticion_id"/>
				<Field id="128" tableName="peticiones" alias="peticiones_paciente_id" fieldName="peticiones.paciente_id"/>
				<Field id="129" tableName="peticiones" alias="peticiones_procedencia_id" fieldName="peticiones.procedencia_id"/>
				<Field id="130" tableName="peticiones" alias="peticiones_estado_id" fieldName="peticiones.estado_id"/>
				<Field id="131" tableName="peticiones" fieldName="fecha"/>
				<Field id="132" tableName="peticiones" fieldName="hora"/>
				<Field id="133" tableName="peticiones" fieldName="observaciones"/>
				<Field id="135" tableName="pacientes" fieldName="rut"/>
				<Field id="136" tableName="pacientes" fieldName="ficha"/>
				<Field id="137" tableName="pacientes" fieldName="nombres"/>
				<Field id="138" tableName="pacientes" fieldName="apellidos"/>
				<Field id="140" tableName="procedencias" alias="procedencias_procedencia_id" fieldName="procedencias.procedencia_id"/>
				<Field id="141" tableName="procedencias" fieldName="nom_procedencia"/>
				<Field id="143" tableName="estados" alias="estados_estado_id" fieldName="estados.estado_id"/>
				<Field id="144" tableName="estados" fieldName="nom_estado"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="160" variable="peticion_id" parameterType="URL" dataType="Integer" parameterSource="peticion_id" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
		<Grid id="2" secured="False" sourceType="SQL" returnValueType="Number" connection="Datos" dataSource="SELECT DISTINCTROW 
  peticiones.peticion_id,
  peticiones_detalle.peticion_id,
  peticiones_detalle.muestra_id,
  tipos_muestra.nom_tipo_muestra,
  indicaciones_muestra.nom_indicacion,
  indicaciones_muestra.cuerpo_indicacion
FROM
  peticiones
  LEFT OUTER JOIN peticiones_detalle ON (peticiones.peticion_id = peticiones_detalle.peticion_id)
  LEFT OUTER JOIN test ON (peticiones_detalle.test_id = test.test_id)
  LEFT OUTER JOIN tipos_muestra ON (test.tipo_muestra_id = tipos_muestra.tipo_muestra_id)
  LEFT OUTER JOIN indicaciones_muestra ON (tipos_muestra.indicacion_id = indicaciones_muestra.indicacion_muestra_id)
WHERE
  peticiones.peticion_id = {peticion_id}" name="peticiones_peticiones_det" wizardCaption="Lista de Peticiones, Peticiones Detalle, Test, Tipos Muestra, Indicaciones Muestra " wizardTheme="Inline" wizardThemeType="File" wizardGridType="Tabular" wizardAllowInsert="False" wizardAltRecord="True" wizardRecordSeparator="False" activeCollection="SQLParameters" activeTableType="dataSource" orderBy="test.tipo_muestra_id, detalle_peticion_id" parameterTypeListName="ParameterTypeList" PathID="peticiones_peticiones_det">
			<Components>
				<Label id="29" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="muestra_id" fieldSource="muestra_id" wizardCaption="Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="32" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="nom_tipo_muestra" fieldSource="nom_tipo_muestra" wizardCaption="Nom Tipo Muestra" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="34" fieldSourceType="DBColumn" dataType="Memo" html="True" editable="False" name="cuerpo_indicacion" fieldSource="cuerpo_indicacion" wizardCaption="Cuerpo Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="36" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_muestra_id" fieldSource="muestra_id" wizardCaption="Muestra Id" wizardTheme="Inline" wizardThemeType="File" wizardSize="20" wizardMaxLength="20" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="39" fieldSourceType="DBColumn" dataType="Text" html="False" editable="False" name="Alt_nom_tipo_muestra" fieldSource="nom_tipo_muestra" wizardCaption="Nom Tipo Muestra" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardMaxLength="100" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<Label id="41" fieldSourceType="DBColumn" dataType="Memo" html="True" editable="False" name="Alt_cuerpo_indicacion" fieldSource="cuerpo_indicacion" wizardCaption="Cuerpo Indicacion" wizardTheme="Inline" wizardThemeType="File" wizardSize="50" wizardIsPassword="False" wizardUseTemplateBlock="False">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Label>
				<ImageLink id="120" fieldSourceType="DBColumn" dataType="Text" hrefType="Page" urlType="Relative" preserveParameters="None" editable="False" name="ImageLink1" wizardTheme="Inline" wizardThemeType="File" hrefSource="ver_detalletomamuestra.ccp" visible="Yes" PathID="peticiones_peticiones_detImageLink1">
					<Components/>
					<Events/>
					<LinkParameters>
						<LinkParameter id="121" sourceType="URL" name="peticion_id" source="peticion_id"/>
					</LinkParameters>
					<Attributes/>
					<Features/>
				</ImageLink>
				<Button id="158" urlType="Relative" enableValidation="False" isDefault="False" name="Cancelar" wizardTheme="Inline" wizardThemeType="File" PathID="peticiones_peticiones_detCancelar">
					<Components/>
					<Events/>
					<Attributes/>
					<Features/>
				</Button>
			</Components>
			<Events/>
			<TableParameters>
				<TableParameter id="43" conditionType="Parameter" useIsNull="False" field="peticiones.peticion_id" dataType="Integer" searchConditionType="Equal" parameterType="URL" logicOperator="And" parameterSource="peticion_id" orderNumber="1" defaultValue="0"/>
			</TableParameters>
			<JoinTables>
				<JoinTable id="94" tableName="peticiones" posWidth="171" posHeight="209" posLeft="10" posTop="10"/>
				<JoinTable id="97" tableName="peticiones_detalle" posWidth="149" posHeight="244" posLeft="196" posTop="12"/>
				<JoinTable id="102" tableName="test" posWidth="155" posHeight="345" posLeft="417" posTop="8"/>
				<JoinTable id="107" tableName="tipos_muestra" posWidth="168" posHeight="196" posLeft="596" posTop="6"/>
				<JoinTable id="111" tableName="indicaciones_muestra" posWidth="187" posHeight="128" posLeft="782" posTop="7"/>
			</JoinTables>
			<JoinLinks>
				<JoinTable2 id="115" fieldLeft="peticiones_detalle.peticion_id" fieldRight="peticiones.peticion_id" tableLeft="peticiones_detalle" tableRight="peticiones" conditionType="Equal" joinType="right"/>
				<JoinTable2 id="116" fieldLeft="peticiones_detalle.test_id" fieldRight="test.test_id" tableLeft="peticiones_detalle" tableRight="test" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="117" fieldLeft="test.tipo_muestra_id" fieldRight="tipos_muestra.tipo_muestra_id" tableLeft="test" tableRight="tipos_muestra" conditionType="Equal" joinType="left"/>
				<JoinTable2 id="118" fieldLeft="tipos_muestra.indicacion_id" fieldRight="indicaciones_muestra.indicacion_muestra_id" tableLeft="tipos_muestra" tableRight="indicaciones_muestra" conditionType="Equal" joinType="left"/>
			</JoinLinks>
			<Fields>
				<Field id="95" tableName="peticiones" alias="peticiones_peticion_id" fieldName="peticiones.peticion_id"/>
				<Field id="96" tableName="peticiones" fieldName="paciente_id"/>
				<Field id="98" tableName="peticiones_detalle" fieldName="detalle_peticion_id"/>
				<Field id="99" tableName="peticiones_detalle" alias="peticiones_detalle_peticion_id" fieldName="peticiones_detalle.peticion_id"/>
				<Field id="100" tableName="peticiones_detalle" fieldName="muestra_id"/>
				<Field id="101" tableName="peticiones_detalle" alias="peticiones_detalle_test_id" fieldName="peticiones_detalle.test_id"/>
				<Field id="103" tableName="test" alias="test_test_id" fieldName="test.test_id"/>
				<Field id="104" tableName="test" alias="test_tipo_muestra_id" fieldName="test.tipo_muestra_id"/>
				<Field id="105" tableName="test" fieldName="cod_test"/>
				<Field id="106" tableName="test" fieldName="nom_test"/>
				<Field id="108" tableName="tipos_muestra" alias="tipos_muestra_tipo_muestra_id" fieldName="tipos_muestra.tipo_muestra_id"/>
				<Field id="109" tableName="tipos_muestra" fieldName="nom_tipo_muestra"/>
				<Field id="110" tableName="tipos_muestra" alias="tipos_muestra_indicacion_id" fieldName="tipos_muestra.indicacion_id"/>
				<Field id="112" tableName="indicaciones_muestra" fieldName="indicacion_muestra_id"/>
				<Field id="113" tableName="indicaciones_muestra" fieldName="nom_indicacion"/>
				<Field id="114" tableName="indicaciones_muestra" fieldName="cuerpo_indicacion"/>
			</Fields>
			<SPParameters/>
			<SQLParameters>
				<SQLParameter id="119" variable="peticion_id" parameterType="URL" dataType="Integer" parameterSource="peticion_id" defaultValue="0"/>
			</SQLParameters>
			<SecurityGroups/>
			<Attributes/>
			<Features/>
			<PKFields/>
		</Grid>
	</Components>
	<CodeFiles>
		<CodeFile id="Code" language="PHPTemplates" name="ver_tomademuestra.php" comment="//" codePage="utf-8" forShow="True" url="ver_tomademuestra.php"/>
		<CodeFile id="Events" language="PHPTemplates" forShow="False" name="ver_tomademuestra_events.php" codePage="utf-8" comment="//"/>
	</CodeFiles>
	<SecurityGroups/>
	<Events>
		<Event name="BeforeOutput" type="Server">
			<Actions>
				<Action actionName="Custom Code" actionCategory="General" id="165"/>
			</Actions>
		</Event>
	</Events>
	<CachingParameters/>
	<Attributes/>
	<Features/>
</Page>
